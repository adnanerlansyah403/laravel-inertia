<?php

return [
    'features' => [
        'dark_mode' => function () {
            return session('dark_mode', false); // Default: false jika tidak disimpan
        },
        'beta_features' => false,
    ]
];
