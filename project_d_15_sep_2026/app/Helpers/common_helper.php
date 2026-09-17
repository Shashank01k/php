<?php

if (! function_exists('commonData')) {
    function commonData(?string $key = null)
    {
        $data = [
            'siteName'    => 'My Website',
            'companyName' => 'SHREE T N',
            'stnLogoPath' => asset('assets/images/stn/shree_t_n.svg'),

            'menuItems' => [
                'Home',
                'About',
                'Contact',
            ],
            'footerDetails' => [
                'contactUs' => [
                    'email' => '19167shashankpandey@gmail.com',
                    'phone' => '+91 99999 99999',
                    'address' => 'Kandivali (E), Mumbai , India 400101',
                ]
            ],
        ];

        if ($key !== null) {
            return $data[$key] ?? null;
        }

        return $data;
    }
}