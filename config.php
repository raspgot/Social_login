<?php
$config = [
    'callback' => 'http://localhost/social_login/callback.php',
    'providers' => [
        'GitHub' => [ 
            'enabled' => true,
            'keys'    => [ 'id' => 'd9cb5fdd8ff7e8c67cfb', 'secret' => '309582db7b938f6f83975166000e137a799f5301' ], 
        ],
        'Google' => [ 
            'enabled' => true,
            'keys'    => [ 'id' => '21131952167-brh3vmbfe4rej08dnbihg0ru98os02lq.apps.googleusercontent.com', 'secret' => 'CcWnrDCu9eMquGPQEsZLY5YI' ],
        ],
        'Facebook' => [ 
            'enabled' => true,
            'keys'    => [ 'id' => '748138102280525', 'secret' => 'ae67b9487e5cb846bec8837ac03b9acf' ],
        ]
    ]
];