<?php

namespace App\Entity;

use App\Repository\CountryDataRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryDataRepository::class)]
class CountryData
{
    /** @var int|null */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /** @var string|null */
    #[ORM\Column(length: 8)]
    private ?string $country_code = null;

    /** @var array<string|int, string|int|float|bool|array<string|int, string|int|float|bool|array<string|int, string|int|float|bool>>> */
    #[ORM\Column]
    private array $json_data = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    public function setCountryCode(string $country_code): static
    {
        $this->country_code = $country_code;

        return $this;
    }

    /**
     * @return array<string|int, string|int|float|bool|array<string|int, string|int|float|bool|array<string|int, string|int|float|bool>>>
     */
    public function getJsonData(): array
    {
        return $this->json_data;
    }

    /**
     * @param array<string|int, string|int|float|bool|array<string|int, string|int|float|bool|array<string|int, string|int|float|bool>>> $json_data
     * @return $this
     */
    public function setJsonData(array $json_data): static
    {
        $this->json_data = $json_data;

        return $this;
    }
}
