<?php

if( !function_exists('mask_string') ){
    /**
     * Mask String
     * @param  string $string String to mask
     * @param  string $mask   Mask to put in the empty string
     * @author Joel A. Jaime Blandino <joel.alexander.jaime@gmail.com> */
    function mask_string( $string, $mask = "-" ){
        return ( $string == null || $string == false || $string == "" ) ? $mask : $string;
    }
}

if( !function_exists('format_number') ){
    /**
     * Format Number
     * @param  Int    $number Number to format
     * @param  string $type   Type of format (PHONE, ID, MONEY)
     * @author Joel A. Jaime Blandino <joel.alexander.jaime@gmail.com> */
    function format_number( Int $number, $type = 'PHONE' ){
        // generate local instance
        $local_instance =& get_instance();

        // obtain patterns index in the custom config file
        $configuration  = $local_instance->config->config['patterns'];
        
        $return_values  = "";

        // ¿What type?
        switch( strtoupper($type) ){
            case 'PHONE':   // (000) 000-0000
                $return_values = preg_replace(
                    $configuration['phone']['pattern'],
                    $configuration['phone']['return'], $number
                );
            break;
            case 'ID':      // 000-0000000-0
                $return_values = preg_replace(
                    $configuration['id']['pattern'],
                    $configuration['id']['return'], $number
                );
            break;
            case 'MONEY':   // $00.00
                $return_values = "$ " . number_format( $number, 2 );
            break;
            default:
                $return_values = $number;
            break;
        }
        return $return_values;
    }
}