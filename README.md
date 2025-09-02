# paymentGatewatIntegration

# 📌 Razorpay Payment Gateway Integration (PHP)

This project demonstrates how to integrate **Razorpay Checkout** in PHP with dynamic amount entry, order creation, and payment verification.

---

## 🚀 Features
- Enter custom amount via input box
- Create Razorpay order dynamically from backend
- Open Razorpay Checkout on button click
- Verify payment signature with Razorpay PHP SDK
- Easy to extend for database storage

---

## 📂 Project Structure
```
project-folder/
│── index.php              # Frontend with input box and PAY button
│── config.php             # Razorpay API configuration
│── payment_process.php    # Creates order with Razorpay API
│── verify.php             # Verifies payment signature
│── composer.json          # Composer dependencies
│── vendor/                # Razorpay PHP SDK (installed via composer)
```
---

## 🔧 Installation Steps

### 1. Clone / Copy Project
```bash
git clone <your-repo-url>
cd project-folder
```

### 2. Install Razorpay PHP SDK
Make sure you have **Composer** installed, then run:
```bash
composer require razorpay/razorpay
```

This will create a `vendor/` folder with the SDK.

---

## ⚙️ Configuration

Edit `config.php` and add your Razorpay API keys:

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Razorpay\Api\Api;

$keyId     = "rzp_test_xxxxxxxxx";   // Your Razorpay Test Key ID
$keySecret = "xxxxxxxxxxxxxxxx";     // Your Razorpay Secret Key

$api = new Api($keyId, $keySecret);
```

🔑 **Note:**  
- Use `rzp_test_...` keys for testing.  
- Replace with **live keys** from Razorpay Dashboard before production.  
- Keep these keys **safe** (never expose in frontend).

---

## ▶️ Usage

1. Open `index.php` in your browser.  
2. Enter the amount (in ₹).  
3. Click **PAY**.  
4. Razorpay Checkout popup will appear.  
5. Complete the payment using test card details from Razorpay docs.  
6. Payment will be verified by `verify.php`.

---

## ✅ Files Explained

### `index.php`
- Provides input box for amount
- Calls `payment_process.php` to create Razorpay order
- Opens Razorpay Checkout
- Calls `verify.php` after payment success

### `payment_process.php`
- Accepts amount from frontend
- Creates Razorpay order using SDK
- Returns `order_id`, `amount`, `currency`

### `verify.php`
- Verifies Razorpay signature
- Ensures payment is genuine
- Can be extended to store payments in DB

---

## 💳 Test Cards
Use these cards for **testing** (Razorpay Sandbox):
- **Card Number:** `4111 1111 1111 1111`
- **Expiry:** Any future date
- **CVV:** Any 3 digits
- **OTP:** 123456

---

## 🔒 Security Notes
- Never expose **Secret Key** in frontend (only in `config.php`).
- Always verify payment with `verify.php`.
- Use HTTPS in production.
