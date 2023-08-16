<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;


class DefaultController extends AbstractController
{
    /**
     * Default route
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->json('It Works.');
    }
}
