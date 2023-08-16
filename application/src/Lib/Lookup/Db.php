<?php

namespace App\Lib\Lookup;

use App\Entity\CountryData;
use App\Repository\CountryDataRepository;

/**
 * Class Db
 * @package App\Lib\Lookup
 * Just adapting things from Laravel...
 */
class Db
{
    /** @var CountryDataRepository */
    protected $repo = null;

    public function __construct(CountryDataRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return array<string, CountryData>
     */
    public function getAllCountries(): array
    {
        $entries = $this->repo->findAll();
        return array_combine(array_map(function (CountryData $country) {
            return strtoupper($country->getCountryCode());
        }, $entries), $entries);
    }
}
