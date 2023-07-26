<?php
namespace IntimateTales\Classes;

use IntimateTales\PaymentGateways\Stripe\StripeHandler;
use IntimateTales\PaymentGateways\PayPal\PayPalHandler;

class Monetization {
    private $stripe_handler;
    private $paypal_handler;

    public function __construct() {
        // Initialize the Stripe and PayPal handlers
        $this->stripe_handler = new StripeHandler();
        $this->paypal_handler = new PayPalHandler();
    }

    /**
     * Handle in-app purchases for premium scenarios.
     *
     * @param string $gateway The payment gateway used for the purchase (e.g., "stripe" or "paypal").
     * @param int $amount The amount to charge for the premium scenario (in cents or the currency of choice).
     * @param string $payment_token The payment token (e.g., "stripeToken" for Stripe or "paypalToken" for PayPal).
     * @param int $duration The duration of the premium scenario (e.g., number of days).
     * @return bool True if the purchase is successful, false otherwise.
     */
    public function handle_purchase($gateway, $amount, $payment_token, $duration) {
        if ($gateway === 'stripe') {
            return $this->stripe_handler->handle_purchase($amount, $payment_token, $duration);
        } elseif ($gateway === 'paypal') {
            return $this->paypal_handler->handle_purchase($amount, $payment_token, $duration);
        } else {
            // Invalid gateway
            return false;
        }
    }

    /**
     * Handle subscriptions for premium scenarios.
     *
     * @param string $gateway The payment gateway used for the subscription (e.g., "stripe" or "paypal").
     * @param int $amount The amount to charge for the subscription (in cents or the currency of choice).
     * @param string $payment_token The payment token (e.g., "stripeToken" for Stripe or "paypalToken" for PayPal).
     * @param int $duration The duration of the subscription (e.g., number of days).
     * @return bool True if the subscription is successful, false otherwise.
     */
    public function handle_subscription($gateway, $amount, $payment_token, $duration) {
        if ($gateway === 'stripe') {
            return $this->stripe_handler->handle_subscription($amount, $payment_token, $duration);
        } elseif ($gateway === 'paypal') {
            return $this->paypal_handler->handle_subscription($amount, $payment_token, $duration);
        } else {
            // Invalid gateway
            return false;
        }
    }
}