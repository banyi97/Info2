<?php
return [ 
        
        'driver' => 'smtp',
        
        'host' => 'smtp.sendgrid.net',
        
        'port' => 587,
        
            'encryption' => 'tls', 
        
        'username' => '',
        
        'password' => '',
        
        'sendmail' => '/usr/sbin/sendmail -bs' ,

        'from' => [
            'address' => 'from@example.com',
            'name' => 'John Smith',
        ]
];