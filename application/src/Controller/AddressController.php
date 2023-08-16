<?php

namespace App\Controller;


use App\Lib;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Class AddressController
 * @package App\Controller
 *
 * That idiot depends too heavily on annotations - remove Swagger from regular usage
 * @IgnoreAnnotation("OA\Get")
 * @IgnoreAnnotation("OA\RequestBody")
 * @IgnoreAnnotation("OA\Response")
 * @IgnoreAnnotation("OA\JsonContent")
 */
class AddressController extends AbstractController
{
    /** @var Lib\Lookup */
    protected $lookup = null;

    public function __construct(Lib\Lookup $lookup)
    {
        $this->lookup = $lookup;
    }

    /**
     * Get available addresses by sent parts
     *
     * @OA\Get(
     *     path="/routing/{country1}/{country2}",
     *     @OA\RequestBody(),
     *     @OA\Response(response="200", description="Available path", @OA\JsonContent()),
     *     @OA\Response(response="400", description="No path found", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthorized", @OA\JsonContent()),
     *     @OA\Response(response="404", description="Not Found", @OA\JsonContent()),
     *     @OA\Response(response="419", description="Error", @OA\JsonContent()),
     *     @OA\Response(response="500", description="Server error", @OA\JsonContent())
     * )
     *
     * @param string $country1
     * @param string $country2
     * @return JsonResponse
     */
    public function paths(string $country1, string $country2): JsonResponse
    {
        try {
            $path = $this->lookup->processing(strtoupper($country1), strtoupper($country2));
            if (empty($path)) {
                return new JsonResponse(['error' => 'path not found'], 400);
            }
            return $this->json($path);
        } catch (\InvalidArgumentException $ex) {
            return $this->json(['error' => $ex->getMessage()], 419);
        }
    }
}
