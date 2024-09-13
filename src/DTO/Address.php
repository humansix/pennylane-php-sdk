<?php

namespace Pennylane\Sdk\DTO;

use Symfony\Component\Serializer\Annotation\Groups;

class Address
{
    #[Groups(['customer_list'])]
    private ?string $address = null;

    #[Groups(['customer_list'])]
    private ?string $postalCode = null;

    #[Groups(['customer_list'])]
    private ?string $city = null;

    #[Groups(['customer_list'])]
    private ?string $countryAlpha2 = null;

    public function __construct(?array $data = null)
    {
        if (null !== $data) {
            $this->setAddress($data['address'] ?? null);
            $this->setPostalCode($data['postal_code'] ?? null);
            $this->setCity($data['city'] ?? null);
            $this->setCountryAlpha2($data['country_alpha2'] ?? null);
        }
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function getCountryAlpha2(): ?string
    {
        return $this->countryAlpha2;
    }

    public function setCountryAlpha2(?string $countryAlpha2): void
    {
        $this->countryAlpha2 = $countryAlpha2;
    }
}
