<?php
return [ 
        
        'driver' => 'smtp',
        
        'host' => 'smtp.sendgrid.net',
        
        'port' => 587,
        
            'encryption' => 'tls', 
        
        'username' => env('MAIL_USERNAME', null),
        
        'password' => env('MAIL_PASSWORD', null),
        
        'sendmail' => '/usr/sbin/sendmail -bs' ,

        'from' => [
            'address' => 'from@example.com',
            'name' => 'John Smith',
        ]
];