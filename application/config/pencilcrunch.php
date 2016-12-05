<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|-------------------------------------------
| Site Under Maintenance
|-------------------------------------------
| This index serves to put the system in
| maintenance mode before loading any
| class or the maintenance mode
| driver is executed. */
$config['maintenance_mode'] = false;


/*
|-------------------------------------------
| Regular Expressions
|--------------------------------------------
| Different regular expressions in the system
| driver is executed. */
$config['patterns']  =  [
    // for document id
    'id'    =>  [
        'pattern'   =>  '/([0-9]{3})([0-9]{7})([0-9]{1})/',
        'return'    =>  '$1-$2-$3'
    ],

    // for phone numbers
    'phone' =>  [
        'pattern'   =>  '/([0-9]{3})([0-9]{3})([0-9]{4})/',
        'return'    =>  '($1) $2-$3'
    ]
];