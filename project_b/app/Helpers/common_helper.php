<?php

if (! function_exists('commonData')) {
    function commonData(?string $key = null)
    {
        $data = [
            'siteName'    => 'My Website',
            'companyName' => 'SHREE TADAK NATH',

            'menuItems' => [
                'Home',
                'About',
                'Contact',
            ],
        ];

        if ($key !== null) {
            return $data[$key] ?? null;
        }

        return $data;
    }
}