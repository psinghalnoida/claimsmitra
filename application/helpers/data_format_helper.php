
<?php
 /**
*  CREATED BY KAJAL
*/
// Format Numbers with Decimal Points
if (!function_exists('format_number')) {
    function format_number($number, $decimals = 2) {
        return number_format($number, $decimals);
    }
}

// Format Date to a Specific Format
if (!function_exists('format_date')) {    
    function format_date($date, $format = 'Y-m-d') {
        if (preg_match('/^\d{8}$/', $date)) {
            $date = DateTime::createFromFormat('dmY', $date);
            if ($date) {
                $date = $date->format('Y-m-d');
            } else {
                return '-'; 
            }
        }
        return date($format, strtotime($date));
    }
}

// Format Currency (with optional currency symbol)
if (!function_exists('format_currency')) {  
    function format_currency($amount, $currency_symbol = '₹') {
        return $currency_symbol . ' ' . number_format($amount, 2);
    }
}

// Capitalize First Letter of Each Word
if (!function_exists('capitalize_words')) {
    function capitalize_words($str) {
        return ucwords(strtolower($str));
    }
}

// Format Contact Number
if (!function_exists('format_contact_number')) {
    function format_contact_number($contact, $country_code = '+91') {
        $contact = preg_replace('/\D/', '', $contact);
        if (strpos($contact, ltrim($country_code, '+')) === 0) {
            $contact = substr($contact, strlen($country_code) - 1);
        }
        if (strlen($contact) == 10) {
            return $country_code . '-' . substr($contact, 0, 5) . '-' . substr($contact, 5, 5);
        }
        return $contact;
    }
}

?>
