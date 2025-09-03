<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> RazorPay - Secure Payment</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Animated background elements */
        .bg-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .payment-container {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 40px;
            max-width: 450px;
            width: 100%;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            position: relative;
            z-index: 1;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(76, 175, 80, 0.3);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .logo i {
            color: white;
            font-size: 24px;
        }

        .title {
            color: white;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 16px;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 30px;
            position: relative;
        }

        .input-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .input-wrapper:hover {
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .input-wrapper.focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
        }

        .input-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .amount-input {
            width: 100%;
            padding: 20px 20px 20px 60px;
            border: none;
            background: transparent;
            color: white;
            font-size: 18px;
            font-weight: 500;
            outline: none;
        }

        .amount-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .currency-symbol {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.8);
            font-size: 18px;
            font-weight: 600;
        }

        .pay-button {
            width: 100%;
            padding: 20px;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            border: none;
            border-radius: 16px;
            color: white;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 10px 25px rgba(76, 175, 80, 0.3);
        }

        .pay-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(76, 175, 80, 0.4);
        }

        .pay-button:active {
            transform: translateY(-1px);
        }

        .pay-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .pay-button:hover::before {
            left: 100%;
        }

        .pay-button.loading {
            background: linear-gradient(135deg, #95a5a6, #7f8c8d);
            cursor: not-allowed;
            pointer-events: none;
        }

        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }

        .pay-button.loading .loading-spinner {
            display: inline-block;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .security-badges {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
            gap: 20px;
        }

        .security-badge {
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.8);
            font-size: 12px;
            gap: 8px;
        }

        .security-badge i {
            color: #4CAF50;
        }

        .powered-by {
            text-align: center;
            margin-top: 25px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
        }

        .razorpay-logo {
            color: #3395ff;
            font-weight: 700;
            text-decoration: none;
        }

        /* Error state */
        .input-wrapper.error {
            border-color: #e74c3c;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Success state */
        .success-message {
            background: rgba(76, 175, 80, 0.2);
            border: 1px solid rgba(76, 175, 80, 0.3);
            color: white;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: none;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive design */
        @media (max-width: 480px) {
            .payment-container {
                padding: 30px 20px;
                margin: 10px;
            }
            
            .title {
                font-size: 24px;
            }
            
            .amount-input {
                font-size: 16px;
                padding: 18px 18px 18px 50px;
            }
            
            .pay-button {
                padding: 18px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="bg-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="payment-container">
        <div class="header">
            <div class="logo">
                <i class="fas fa-heartbeat"></i>
            </div>
            <h1 class="title">RazorPay</h1>
            <p class="subtitle">Secure Payment Gateway</p>
        </div>

        <div class="success-message" id="successMessage">
            <i class="fas fa-check-circle"></i> Payment initiated successfully!
        </div>

        <form id="paymentForm">
            <div class="form-group">
                <div class="input-wrapper" id="amountWrapper">
                    <i class="input-icon fas fa-wallet"></i>
                    <input 
                        type="number" 
                        id="amount" 
                        class="amount-input"
                        placeholder="Enter amount to pay"
                        min="1"
                        step="0.01"
                        required
                    >
                    <span class="currency-symbol">₹</span>
                </div>
            </div>

            <button type="submit" class="pay-button" id="payBtn">
                <div class="loading-spinner"></div>
                <i class="fas fa-shield-alt"></i> Pay Securely
            </button>
        </form>

        <div class="security-badges">
            <div class="security-badge">
                <i class="fas fa-lock"></i>
                <span>256-bit SSL</span>
            </div>
            <div class="security-badge">
                <i class="fas fa-shield-alt"></i>
                <span>PCI Compliant</span>
            </div>
        </div>

        <div class="powered-by">
            Powered by <a href="#" class="razorpay-logo">Razorpay</a>
        </div>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        // Enhanced form interactions
        const amountInput = document.getElementById('amount');
        const amountWrapper = document.getElementById('amountWrapper');
        const payBtn = document.getElementById('payBtn');
        const successMessage = document.getElementById('successMessage');

        // Focus and blur effects
        amountInput.addEventListener('focus', () => {
            amountWrapper.classList.add('focus');
        });

        amountInput.addEventListener('blur', () => {
            amountWrapper.classList.remove('focus');
        });

        // Real-time validation
        amountInput.addEventListener('input', () => {
            amountWrapper.classList.remove('error');
            const value = parseFloat(amountInput.value);
            if (value > 0) {
                payBtn.innerHTML = '<i class="fas fa-shield-alt"></i> Pay ₹' + value.toFixed(2);
            } else {
                payBtn.innerHTML = '<i class="fas fa-shield-alt"></i> Pay Securely';
            }
        });

        // Form submission
        document.getElementById('paymentForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const amount = parseFloat(amountInput.value);
            
            // Validation
            if (!amount || amount <= 0) {
                amountWrapper.classList.add('error');
                showNotification('Please enter a valid amount', 'error');
                return;
            }

            // Loading state
            payBtn.classList.add('loading');
            payBtn.innerHTML = '<div class="loading-spinner"></div> Processing...';

            try {
                // Send amount to server (convert to paise)
                const res = await fetch("payment_process.php", {
                    method: "POST",
                    headers: {"Content-Type": "application/json"},
                    body: JSON.stringify({amount: amount})
                });

                const orderData = await res.json();

                if (orderData.status === "success") {
                    // Show success message
                    successMessage.style.display = 'block';
                    
                    var options = {
                        "key": "rzp_test_RC0WyKcORrZXEB", // Replace with your Key ID
                        "amount": orderData.amount,
                        "currency": orderData.currency,
                        "name": "Shreya Unhale",
                        "description": "Healthcare Payment",
                        "image": "data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMzAiIGZpbGw9IiM0Q0FGNTASCZ8L2NpcmNsZT4KPHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTMuNSAxMy43NUwxMCAyMC4yNWwxMC41LTEwLjUiIHN0cm9rZT0id2hpdGUiIHN0cm9rZS13aWR0aD0iMi41IiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz4KPC9zdmc+Cjwvc3ZnPgo=",
                        "order_id": orderData.id,
                        "handler": function (response){
                            payBtn.classList.remove('loading');
                            payBtn.innerHTML = '<i class="fas fa-check"></i> Payment Successful!';
                            
                            // Verify payment
                            fetch("verify.php", {
                                method: "POST",
                                headers: {"Content-Type": "application/json"},
                                body: JSON.stringify(response)
                            })
                            .then(res => res.json())
                            .then(data => {
                                showNotification(data.message, 'success');
                                setTimeout(() => {
                                    payBtn.innerHTML = '<i class="fas fa-shield-alt"></i> Pay Securely';
                                    amountInput.value = '';
                                    successMessage.style.display = 'none';
                                }, 3000);
                            })
                            .catch(error => {
                                showNotification('Payment verification failed', 'error');
                            });
                        },
                        "prefill": {
                            "name": "Shreya Unhale",
                            "email": "test@example.com",
                            "contact": "9999999999"
                        },
                        "theme": {
                            "color": "#4CAF50"
                        },
                        "modal": {
                            "ondismiss": function(){
                                payBtn.classList.remove('loading');
                                payBtn.innerHTML = '<i class="fas fa-shield-alt"></i> Pay Securely';
                                successMessage.style.display = 'none';
                            }
                        }
                    };
                    
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                } else {
                    throw new Error(orderData.message || 'Order creation failed');
                }
            } catch (error) {
                payBtn.classList.remove('loading');
                payBtn.innerHTML = '<i class="fas fa-shield-alt"></i> Pay Securely';
                showNotification('Order creation failed: ' + error.message, 'error');
            }
        });

        // Notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                border-radius: 8px;
                color: white;
                font-weight: 500;
                z-index: 1000;
                animation: slideInRight 0.3s ease-out;
                max-width: 300px;
                word-wrap: break-word;
            `;
            
            if (type === 'success') {
                notification.style.background = 'linear-gradient(135deg, #4CAF50, #45a049)';
            } else {
                notification.style.background = 'linear-gradient(135deg, #e74c3c, #c0392b)';
            }
            
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease-in forwards';
                setTimeout(() => notification.remove(), 300);
            }, 4000);
        }

        // Add slide animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(100%);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
            
            @keyframes slideOutRight {
                from {
                    opacity: 1;
                    transform: translateX(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(100%);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>