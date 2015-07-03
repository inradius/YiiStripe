<?php

// Tested on PHP 5.2, 5.3

// This snippet (and some of the curl code) due to the Facebook SDK.
if (!function_exists('curl_init')) {
  throw new Exception('Stripe needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
  throw new Exception('Stripe needs the JSON PHP extension.');
}
if (!function_exists('mb_detect_encoding')) {
  throw new Exception('Stripe needs the Multibyte String PHP extension.');
}

// Stripe singleton
require(dirname(__FILE__) . '/Stripe/Stripe.php');

// Utilities
require(dirname(__FILE__) . '/Stripe/Stripe_Util.php');
require(dirname(__FILE__) . '/Stripe/Util/Stripe_Util_Set.php');

// Errors
require(dirname(__FILE__) . '/Stripe/Stripe_Error.php');
require(dirname(__FILE__) . '/Stripe/Stripe_ApiError.php');
require(dirname(__FILE__) . '/Stripe/Stripe_ApiConnectionError.php');
require(dirname(__FILE__) . '/Stripe/Stripe_AuthenticationError.php');
require(dirname(__FILE__) . '/Stripe/Stripe_CardError.php');
require(dirname(__FILE__) . '/Stripe/Stripe_InvalidRequestError.php');
require(dirname(__FILE__) . '/Stripe/Stripe_RateLimitError.php');

// Plumbing
require(dirname(__FILE__) . '/Stripe/Stripe_Object.php');
require(dirname(__FILE__) . '/Stripe/Stripe_ApiRequestor.php');
require(dirname(__FILE__) . '/Stripe/Stripe_ApiResource.php');
require(dirname(__FILE__) . '/Stripe/Stripe_SingletonApiResource.php');
require(dirname(__FILE__) . '/Stripe/Stripe_AttachedObject.php');
require(dirname(__FILE__) . '/Stripe/Stripe_List.php');

// Stripe API Resources
require(dirname(__FILE__) . '/Stripe/Stripe_Account.php');
require(dirname(__FILE__) . '/Stripe/Stripe_Card.php');
require(dirname(__FILE__) . '/Stripe/Stripe_Balance.php');
require(dirname(__FILE__) . '/Stripe/Stripe_BalanceTransaction.php');
require(dirname(__FILE__) . '/Stripe/Stripe_Charge.php');
require(dirname(__FILE__) . '/Stripe/Stripe_Customer.php');
require(dirname(__FILE__) . '/Stripe/Stripe_Invoice.php');
require(dirname(__FILE__) . '/Stripe/Stripe_InvoiceItem.php');
require(dirname(__FILE__) . '/Stripe/Stripe_Plan.php');
require(dirname(__FILE__) . '/Stripe/Stripe_Subscription.php');
require(dirname(__FILE__) . '/Stripe/Stripe_Token.php');
require(dirname(__FILE__) . '/Stripe/Stripe_Coupon.php');
require(dirname(__FILE__) . '/Stripe/Stripe_Event.php');
require(dirname(__FILE__) . '/Stripe/Stripe_Transfer.php');
require(dirname(__FILE__) . '/Stripe/Stripe_Recipient.php');
require(dirname(__FILE__) . '/Stripe/Stripe_Refund.php');
require(dirname(__FILE__) . '/Stripe/Stripe_ApplicationFee.php');
require(dirname(__FILE__) . '/Stripe/Stripe_ApplicationFeeRefund.php');
