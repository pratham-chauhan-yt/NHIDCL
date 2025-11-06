<?php

return [
    'disable' => env('CAPTCHA_DISABLE', false),
    'characters' => ['2', '3', '4', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'j', 'm', 'n', 'p', 'q', 'r', 't', 'u', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'M', 'N', 'P', 'Q', 'R', 'T', 'U', 'X', 'Y', 'Z'],
    'default' => [
        'length' => 6,
        'width' => 150,
        'height' => 40,
        'quality' => 100,
        'math' => true,
        'expire' => 600,
        'encrypt' => false,
    ],
    'math' => [
        'length' => 9,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
        'math' => true,
        'contrast' => -5,
    ],

    'flat' => [
       'length' => 6,
        'width' => 150,
        'height' => 40,
        'quality' => 100,
        'expire' => 600,
        'bgImage' => false,
        'bgColor' => '#ecf2f4',
        'fontColors' => ['#2c3e50', '#c0392b', '#16a085'],
        'contrast' => 0,
        'format' => 'png',
    ],

    'mini' => [
        'length' => 3,
        'width' => 60,
        'height' => 32,
    ],
    'inverse' => [
        'length' => 5,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
        'sensitive' => true,
        'angle' => 12,
        'sharpen' => 10,
        'blur' => 2,
        'invert' => true,
        'contrast' => -5,
    ],
   'audio' => [
        'enabled' => true,  // This is correct, audio is enabled.
        'locale' => 'en',   // The locale is set to 'en' for English audio.
        'voices' => [
            'en' => 'en',   // 'en' is the only voice specified for English.
        ],
    ]

];
