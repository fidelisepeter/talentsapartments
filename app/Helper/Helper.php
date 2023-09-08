<?php

namespace App\Helper;

class Helper
{
    public static function currency($price)
    {
        // $price = str_replace(',', '', $price);
        $price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);
        return '₦ '.number_format($price, 2);
    }

    public static function percentage($total, $number)
    {
        if ( $total > 0 ) {
            return round(($number * 100) / $total, 2).'%';
           } else {
             return '0%';
           }
        }
    }

