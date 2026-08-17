<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stripe_library {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
        // Load necessary libraries and helpers here if needed
    }

    public function create_checkout_session($amount, $currency, $success_url, $cancel_url) {
        $stripe_secret_key = 'pk_test_51NquQISFIquGKwPGYhQlYNousvy9tLLmsbBpsyJxSXyYSK3a9180SYoGnfJGzVseHoCM0YNmaPjbYiApOwXGVSbt00GwE70SWO';//'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';
        $api_url = 'https://api.stripe.com/v1/checkout/sessions';
        $stripeamount = $amount * 100;
        $data = [
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => $currency,
                        'product_data' => [
                            'name' => 'Document Translation',
                        ],
                        'unit_amount' => $stripeamount,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => $success_url,
            'cancel_url' => $cancel_url,
        ];

        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_USERPWD, $stripe_secret_key . ':');

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
?>
