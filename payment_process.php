<?php
require('config.php');

header("Content-Type: application/json");

// Get amount from frontend
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['amount']) || $data['amount'] <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid amount']);
    exit;
}

$orderAmount   = $data['amount'] * 100; // Convert ₹ to paise
$orderCurrency = "INR";
$orderReceipt  = "order_rcptid_" . rand(1000, 9999);

try {
    $order = $api->order->create([
        'receipt'         => $orderReceipt,
        'amount'          => $orderAmount,
        'currency'        => $orderCurrency,
        'payment_capture' => 1
    ]);

    echo json_encode([
        'status'   => 'success',
        'id'       => $order['id'],
        'amount'   => $order['amount'],
        'currency' => $order['currency']
    ]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
