<?php

namespace App\Utils;

// mocking DB map of partners
final class PartnersMap
{
    public static array $partners = [
        'BBC' => [
            'active' => true,
            'path' => '/srv/app/public/data-sources/temps.csv',
        ],
        'WeatherCom' => [
            'active' => true,
            'path' => '/srv/app/public/data-sources/temps.xml',
        ],
        'Buin' => [
            'active' => false,
            'path' => '/srv/app/public/data-sources/temps.csv',
        ],
        'IAmsterdam' => [
            'active' => true,
            'path' => '/srv/app/public/data-sources/temps.json',
        ],
    ];

    public static function getPartners(): array
    {
        $partners = self::$partners;

        $active = array_filter($partners, fn($partner) => true === $partner['active']);

        return $active;
    }
}
