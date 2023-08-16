<?php

namespace App\Tests\Controller;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class AddressControllerTest extends ApiTestCase
{
    /**
     * Test routes - this one exists
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @return void
     */
    public function test_route_exists_0(): void
    {
        $response = static::createClient()->request('GET', '/routing/FRA/FRA');
        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['FRA']);
    }

    /**
     * Test routes - this one exists
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @return void
     */
    public function test_route_exists_1(): void
    {
        $response = static::createClient()->request('GET', '/routing/CZE/ITA');
        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['CZE', 'AUT', 'ITA']);
    }

    /**
     * Test routes - this one exists
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @return void
     */
    public function test_route_exists_2(): void
    {
        $response = static::createClient()->request('GET', '/routing/POL/ISR');
        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['POL', 'DEU', 'FRA', 'ESP', 'MAR', 'DZA', 'LBY', 'EGY', 'ISR']);
        // ... -> Cetua -> ...
    }

    /**
     * Test routes - this one does not exist
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @return void
     */
    public function test_route_not_exists(): void
    {
        $response = static::createClient()->request('GET', '/routing/ARG/EGY');
        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonContains(['error' => 'path not found']);
    }

    /**
     * Test routes - this one does not exist
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @return void
     */
    public function test_country_not_exists_1(): void
    {
        $response = static::createClient()->request('GET', '/routing/JOR/EGY');
        $this->assertResponseStatusCodeSame(419);
        $this->assertJsonContains(['error' => 'Unknown country of origin']);
    }

    /**
     * Test routes - this one does not exist
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @return void
     */
    public function test_country_not_exists_2(): void
    {
        $response = static::createClient()->request('GET', '/routing/EGY/JOR');
        $this->assertResponseStatusCodeSame(419);
        $this->assertJsonContains(['error' => 'Unknown country of destination']);
    }
}
