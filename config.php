<?php
require __DIR__ . '/vendor/autoload.php';   // make sure path is correct

use Razorpay\Api\Api;

$keyId = "rzp_test_RC0WyKcORrZXEB";   // Your Key ID
$keySecret = "OjYOaeV8qNqw5XOwzSlrOWfZ";   // Your Secret

$api = new Api($keyId, $keySecret);
