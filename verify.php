<?php
require('config.php');

$data = json_decode(file_get_contents("php://input"), true);

$paymentId = $data['razorpay_payment_id'];
$orderId   = $data['razorpay_order_id'];
$signature = $data['razorpay_signature'];

try {
    $attributes = [
        'razorpay_order_id' => $orderId,
        'razorpay_payment_id' => $paymentId,
        'razorpay_signature' => $signature
    ];
    $api->utility->verifyPaymentSignature($attributes);

    // ✅ Payment verified
    echo json_encode(['status' => 'Payment Successful!']);
} catch (Exception $e) {
    // ❌ Verification failed
    echo json_encode(['status' => 'Payment Failed: ' . $e->getMessage()]);
}
