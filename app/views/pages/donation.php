<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Donation - Elder Care Foundation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            line-height: 1.6;
            color: #2d3748;
            /* Hide scrollbar */
            overflow-x: hidden;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        body::-webkit-scrollbar {
            display: none;
        }

        html {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        html::-webkit-scrollbar {
            display: none;
        }

        .donation-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Section */
        .header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
        }

        .header h1 {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .header p {
            font-size: 1.4rem;
            color: #4a5568;
            max-width: 700px;
            margin: 0 auto;
            font-weight: 500;
        }

        /* Impact Section */
        .impact-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .impact-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .impact-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .impact-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .impact-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            display: block;
        }

        .impact-card h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .impact-card p {
            font-size: 1.1rem;
            color: #4a5568;
            line-height: 1.6;
        }

        .impact-amount {
            font-size: 2.5rem;
            font-weight: 800;
            color: #667eea;
            display: block;
            margin-top: 1rem;
        }

        /* Donation Form Section */
        .donation-form-section {
            background: white;
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            margin-bottom: 3rem;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .form-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-header p {
            font-size: 1.2rem;
            color: #4a5568;
        }

        /* Amount Selection */
        .amount-section {
            margin-bottom: 3rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .amount-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .amount-option {
            position: relative;
        }

        .amount-input {
            display: none;
        }

        .amount-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1rem;
            background: #f7fafc;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            position: relative;
        }

        .amount-value {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .amount-description {
            font-size: 0.9rem;
            color: #4a5568;
            text-align: center;
        }

        .amount-input:checked+.amount-label {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-color: #667eea;
            color: white;
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .amount-input:checked+.amount-label .amount-value {
            color: white;
        }

        .amount-input:checked+.amount-label .amount-description {
            color: rgba(255, 255, 255, 0.9);
        }

        .amount-label:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Custom Amount */
        .custom-amount {
            margin-top: 2rem;
        }

        .custom-input-container {
            position: relative;
            max-width: 300px;
            margin: 0 auto;
        }

        .custom-input {
            width: 100%;
            padding: 1.2rem 1.5rem 1.2rem 3rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1.2rem;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .custom-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .currency-symbol {
            position: absolute;
            left: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2rem;
            font-weight: 700;
            color: #667eea;
        }

        /* Personal Information Form */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            position: relative;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1.2rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-input.error {
            border-color: #f56565;
            background: #fef5f5;
        }

        /* Payment Method */
        .payment-methods {
            margin-bottom: 3rem;
        }

        .payment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1rem;
        }

        .payment-option {
            position: relative;
        }

        .payment-input {
            display: none;
        }

        .payment-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1.5rem 1rem;
            background: #f7fafc;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-icon {
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 40px;
        }

        .payment-icon svg {
            transition: transform 0.3s ease;
        }

        .payment-input:checked+.payment-label .payment-icon svg {
            transform: scale(1.1);
        }

        .payment-name {
            font-weight: 600;
            color: #4a5568;
        }

        .payment-input:checked+.payment-label {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-color: #667eea;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .payment-input:checked+.payment-label .payment-name {
            color: white;
        }

        /* Credit Card Form */
        .card-form {
            background: #f7fafc;
            padding: 2rem;
            border-radius: 16px;
            margin-top: 2rem;
            display: none;
            border: 2px solid #e2e8f0;
        }

        .card-form.active {
            display: block;
            animation: slideDown 0.3s ease-out;
        }

        .card-row {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1rem;
        }

        /* Donation Summary */
        .donation-summary {
            background: linear-gradient(135deg, #e0f2fe, #b3e5fc);
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            border-left: 4px solid #0288d1;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .summary-row:last-child {
            margin-bottom: 0;
            font-weight: 700;
            font-size: 1.3rem;
            color: #0277bd;
            border-top: 2px solid rgba(2, 119, 189, 0.2);
            padding-top: 1rem;
        }

        /* Submit Button */
        .submit-container {
            text-align: center;
        }

        .submit-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 1.5rem 4rem;
            font-size: 1.3rem;
            font-weight: 700;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.6);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .submit-btn:disabled {
            background: #cbd5e0;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Security Badge */
        .security-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
            padding: 1rem;
            background: rgba(16, 185, 129, 0.1);
            border-radius: 12px;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .security-badge span {
            color: #059669;
            font-weight: 600;
        }

        /* Thank You Message */
        .thank-you-message {
            display: none;
            text-align: center;
            padding: 3rem;
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border-radius: 20px;
            margin-top: 2rem;
            border: 2px solid #28a745;
        }

        .thank-you-message.show {
            display: block;
            animation: slideDown 0.5s ease-out;
        }

        .thank-you-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1rem;
        }

        .thank-you-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #155724;
            margin-bottom: 1rem;
        }

        .thank-you-text {
            font-size: 1.2rem;
            color: #155724;
            line-height: 1.6;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .donation-container {
                padding: 15px;
            }

            .header h1 {
                font-size: 2.5rem;
            }

            .header p {
                font-size: 1.1rem;
            }

            .donation-form-section {
                padding: 2rem 1.5rem;
            }

            .form-header h2 {
                font-size: 2rem;
            }

            .amount-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .amount-label {
                padding: 1.5rem 0.5rem;
            }

            .amount-value {
                font-size: 1.5rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .payment-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .card-row {
                grid-template-columns: 1fr;
            }

            .submit-btn {
                padding: 1.2rem 2.5rem;
                font-size: 1.1rem;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 2rem;
            }

            .impact-card {
                padding: 1.5rem;
            }

            .impact-icon {
                font-size: 3rem;
            }

            .amount-grid {
                grid-template-columns: 1fr;
            }

            .payment-grid {
                grid-template-columns: 1fr;
            }

            .donation-summary {
                padding: 1.5rem;
            }
        }

        /* Loading Animation */
        .btn-loading {
            position: relative;
            color: transparent !important;
        }

        .btn-loading::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Error Message */
        .error-message {
            background: linear-gradient(135deg, #fed7d7, #feb2b2);
            color: #c53030;
            padding: 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            margin-top: 0.5rem;
            border-left: 4px solid #f56565;
            display: none;
        }

        .error-message.show {
            display: block;
            animation: slideDown 0.3s ease-out;
        }
    </style>
</head>

<body>
    <div class="donation-container">
        <!-- Header -->
        <div class="header">
            <h1>Support Our Elders</h1>
            <p>Your generous donation helps us provide compassionate care, engaging activities, and essential services to elderly individuals in our community.</p>
        </div>

        <!-- Impact Section -->
        <div class="impact-section">
            <div class="impact-card">
                <span class="impact-icon">🏠</span>
                <h3>Safe Housing</h3>
                <p>Your donation helps provide safe, comfortable housing for elderly individuals who need support.</p>
                <span class="impact-amount">$50</span>
                <small>provides one week of housing</small>
            </div>
            <div class="impact-card">
                <span class="impact-icon">🍽️</span>
                <h3>Nutritious Meals</h3>
                <p>Ensure elderly individuals receive healthy, balanced meals prepared with love and care.</p>
                <span class="impact-amount">$25</span>
                <small>provides meals for one day</small>
            </div>
            <div class="impact-card">
                <span class="impact-icon">⚕️</span>
                <h3>Healthcare Support</h3>
                <p>Help cover essential medical care, medications, and health monitoring services.</p>
                <span class="impact-amount">$100</span>
                <small>covers basic medical needs</small>
            </div>
            <div class="impact-card">
                <span class="impact-icon">🎨</span>
                <h3>Activities & Programs</h3>
                <p>Fund engaging activities, social programs, and recreational opportunities for mental wellness.</p>
                <span class="impact-amount">$35</span>
                <small>sponsors activity programs</small>
            </div>
        </div>

        <!-- Donation Form -->
        <div class="donation-form-section">
            <div class="form-header">
                <h2>Make Your Donation</h2>
                <p>Every contribution, no matter the size, makes a meaningful difference in an elderly person's life.</p>
            </div>

            <form id="donationForm">
                <!-- Amount Selection -->
                <div class="amount-section">
                    <h3 class="section-title">Choose Your Donation Amount</h3>
                    <div class="amount-grid">
                        <div class="amount-option">
                            <input type="radio" id="amount25" name="amount" value="25" class="amount-input">
                            <label for="amount25" class="amount-label">
                                <span class="amount-value">$25</span>
                                <span class="amount-description">Daily meals</span>
                            </label>
                        </div>
                        <div class="amount-option">
                            <input type="radio" id="amount50" name="amount" value="50" class="amount-input">
                            <label for="amount50" class="amount-label">
                                <span class="amount-value">$50</span>
                                <span class="amount-description">Weekly housing</span>
                            </label>
                        </div>
                        <div class="amount-option">
                            <input type="radio" id="amount100" name="amount" value="100" class="amount-input" checked>
                            <label for="amount100" class="amount-label">
                                <span class="amount-value">$100</span>
                                <span class="amount-description">Healthcare support</span>
                            </label>
                        </div>
                        <div class="amount-option">
                            <input type="radio" id="amount250" name="amount" value="250" class="amount-input">
                            <label for="amount250" class="amount-label">
                                <span class="amount-value">$250</span>
                                <span class="amount-description">Monthly care</span>
                            </label>
                        </div>
                        <div class="amount-option">
                            <input type="radio" id="amount500" name="amount" value="500" class="amount-input">
                            <label for="amount500" class="amount-label">
                                <span class="amount-value">$500</span>
                                <span class="amount-description">Comprehensive care</span>
                            </label>
                        </div>
                        <div class="amount-option">
                            <input type="radio" id="amountCustom" name="amount" value="custom" class="amount-input">
                            <label for="amountCustom" class="amount-label">
                                <span class="amount-value">💝</span>
                                <span class="amount-description">Custom amount</span>
                            </label>
                        </div>
                    </div>

                    <div class="custom-amount" id="customAmountSection" style="display: none;">
                        <div class="custom-input-container">
                            <span class="currency-symbol">$</span>
                            <input type="number" id="customAmount" class="custom-input" placeholder="Enter amount" min="5" step="1">
                        </div>
                    </div>
                </div>

                <!-- Personal Information -->
                <div class="amount-section">
                    <h3 class="section-title">Your Information</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="fullName" class="form-label">Full Name *</label>
                            <input type="text" id="fullName" name="fullName" class="form-input" required>
                            <div class="error-message" id="fullNameError">Please enter your full name</div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" id="email" name="email" class="form-input" required>
                            <div class="error-message" id="emailError">Please enter a valid email address</div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" class="form-input" required>
                            <div class="error-message" id="phoneError">Please enter your phone number</div>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="payment-methods">
                    <h3 class="section-title">Payment Method</h3>
                    <div class="payment-grid">
                        <div class="payment-option">
                            <input type="radio" id="paymentCard" name="paymentMethod" value="card" class="payment-input" checked>
                            <label for="paymentCard" class="payment-label">
                                <div class="payment-icon">
                                    <svg width="40" height="30" viewBox="0 0 40 30" fill="none">
                                        <rect width="40" height="30" rx="4" fill="#1a1a1a" />
                                        <rect x="2" y="6" width="36" height="3" fill="white" />
                                        <rect x="6" y="18" width="12" height="2" rx="1" fill="white" />
                                        <rect x="6" y="22" width="8" height="1" rx="0.5" fill="white" />
                                        <text x="32" y="25" fill="white" font-size="6" font-family="monospace">CARD</text>
                                    </svg>
                                </div>
                                <span class="payment-name">Credit Card</span>
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" id="paymentPaypal" name="paymentMethod" value="paypal" class="payment-input">
                            <label for="paymentPaypal" class="payment-label">
                                <div class="payment-icon">
                                    <svg width="40" height="30" viewBox="0 0 40 30" fill="none">
                                        <path d="M8 8c0-2 1.5-3 4-3h8c3 0 5 2 5 5s-2 5-5 5h-6l-1 5h-3l2-12z" fill="#0070ba" />
                                        <path d="M12 12c0-2 1.5-3 4-3h8c3 0 5 2 5 5s-2 5-5 5h-6l-1 5h-3l2-12z" fill="#00a0d6" />
                                        <text x="8" y="25" fill="#0070ba" font-size="6" font-weight="bold">PayPal</text>
                                    </svg>
                                </div>
                                <span class="payment-name">PayPal</span>
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" id="paymentKpay" name="paymentMethod" value="kpay" class="payment-input">
                            <label for="paymentKpay" class="payment-label">
                                <div class="payment-icon">
                                    <svg width="40" height="30" viewBox="0 0 40 30" fill="none">
                                        <rect width="40" height="30" rx="6" fill="#1565C0" />
                                        <text x="4" y="12" fill="white" font-size="10" font-weight="bold">KBZ</text>
                                        <text x="4" y="24" fill="white" font-size="8">Pay</text>
                                        <path d="M32 4 L36 4 L36 8 M32 26 L36 26 L36 22 M8 4 L4 4 L4 8 M8 26 L4 26 L4 22" stroke="white" stroke-width="1" fill="none" />
                                    </svg>
                                </div>
                                <span class="payment-name">KBZ Pay</span>
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" id="paymentWave" name="paymentMethod" value="wave" class="payment-input">
                            <label for="paymentWave" class="payment-label">
                                <div class="payment-icon">
                                    <svg width="40" height="30" viewBox="0 0 40 30" fill="none">
                                        <rect width="40" height="30" rx="6" fill="#FFD700" />
                                        <circle cx="20" cy="15" r="8" fill="#1E88E5" />
                                        <circle cx="20" cy="15" r="5" fill="#FFD700" />
                                        <path d="M12 15 Q16 10 20 15 Q24 20 28 15" stroke="#1E88E5" stroke-width="2" fill="none" />
                                    </svg>
                                </div>
                                <span class="payment-name">Wave Pay</span>
                            </label>
                        </div>
                    </div>

                    <!-- Credit Card Form -->
                    <div class="card-form active" id="cardForm">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="cardNumber" class="form-label">Card Number *</label>
                                <input type="text" id="cardNumber" name="cardNumber" class="form-input" placeholder="1234 5678 9012 3456" maxlength="19">
                                <div class="error-message" id="cardNumberError">Please enter a valid card number</div>
                            </div>
                            <div class="form-group">
                                <label for="cardName" class="form-label">Cardholder Name *</label>
                                <input type="text" id="cardName" name="cardName" class="form-input" placeholder="John Doe">
                                <div class="error-message" id="cardNameError">Please enter the cardholder name</div>
                            </div>
                        </div>
                        <div class="card-row">
                            <div class="form-group">
                                <label for="cardExpiry" class="form-label">Expiry Date *</label>
                                <input type="text" id="cardExpiry" name="cardExpiry" class="form-input" placeholder="MM/YY" maxlength="5">
                                <div class="error-message" id="cardExpiryError">Please enter expiry date</div>
                            </div>
                            <div class="form-group">
                                <label for="cardCvv" class="form-label">CVV *</label>
                                <input type="text" id="cardCvv" name="cardCvv" class="form-input" placeholder="123" maxlength="4">
                                <div class="error-message" id="cardCvvError">Please enter CVV</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Donation Summary -->
                <div class="donation-summary">
                    <div class="summary-row">
                        <span>Donation Amount:</span>
                        <span id="summaryAmount">$100.00</span>
                    </div>
                    <div class="summary-row">
                        <span>Processing Fee:</span>
                        <span id="summaryFee">$3.30</span>
                    </div>
                    <div class="summary-row">
                        <span>Total:</span>
                        <span id="summaryTotal">$103.30</span>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="submit-container">
                    <button type="submit" class="submit-btn" id="submitBtn">
                        💝 Complete Donation
                    </button>
                    <div class="security-badge">
                        <span>🔒</span>
                        <span>Your payment is secured with 256-bit SSL encryption</span>
                    </div>
                </div>
            </form>
        </div>

        <!-- Thank You Message -->
        <div class="thank-you-message" id="thankYouMessage">
            <div class="thank-you-icon">🎉</div>
            <div class="thank-you-title">Thank You!</div>
            <div class="thank-you-text">
                Your generous donation has been processed successfully. You will receive a confirmation email shortly with your donation receipt. Your kindness makes a real difference in the lives of elderly individuals in our community.
            </div>
        </div>
    </div>

    <script>
        // Global variables
        let selectedAmount = 100;
        let processingFee = 0;
        let totalAmount = 0;

        // DOM Elements
        const customAmountSection = document.getElementById('customAmountSection');
        const customAmountInput = document.getElementById('customAmount');
        const summaryAmount = document.getElementById('summaryAmount');
        const summaryFee = document.getElementById('summaryFee');
        const summaryTotal = document.getElementById('summaryTotal');
        const cardForm = document.getElementById('cardForm');
        const submitBtn = document.getElementById('submitBtn');
        const thankYouMessage = document.getElementById('thankYouMessage');
        const donationForm = document.getElementById('donationForm');

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            formatCardInputs();
            // Wait a bit for DOM to be fully ready, then update summary
            setTimeout(() => {
                updateSummary();
            }, 200);
        });

        // Event Listeners Setup
        function setupEventListeners() {
            // Amount selection
            const amountInputs = document.querySelectorAll('input[name="amount"]');
            amountInputs.forEach(input => {
                input.addEventListener('change', handleAmountChange);
            });

            // Custom amount input
            customAmountInput.addEventListener('input', handleCustomAmountChange);

            // Payment method selection
            const paymentInputs = document.querySelectorAll('input[name="paymentMethod"]');
            paymentInputs.forEach(input => {
                input.addEventListener('change', handlePaymentMethodChange);
            });

            // Form submission
            donationForm.addEventListener('submit', handleFormSubmission);

            // Real-time validation
            setupRealTimeValidation();

            // Initial summary update
            setTimeout(updateSummary, 100);
        }

        // Amount Selection Handler
        function handleAmountChange(event) {
            const value = event.target.value;

            if (value === 'custom') {
                customAmountSection.style.display = 'block';
                customAmountSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });
                customAmountInput.focus();
                selectedAmount = parseInt(customAmountInput.value) || 0;
            } else {
                customAmountSection.style.display = 'none';
                selectedAmount = parseInt(value);
            }

            updateSummary();
        }

        // Custom Amount Handler
        function handleCustomAmountChange(event) {
            const value = parseInt(event.target.value) || 0;
            selectedAmount = Math.max(0, value);
            updateSummary();
        }

        // Payment Method Handler - FIXED
        function handlePaymentMethodChange(event) {
            const method = event.target.value;
            console.log('Payment method changed to:', method);

            if (method === 'card') {
                cardForm.style.display = 'block';
                cardForm.classList.add('active');
            } else {
                cardForm.style.display = 'none';
                cardForm.classList.remove('active');
            }

            // IMPORTANT: Update summary immediately when payment method changes
            setTimeout(() => {
                updateSummary();
            }, 50);
        }

        // Update Summary
        function updateSummary() {
            if (selectedAmount > 0) {
                processingFee = Math.round((selectedAmount * 0.033 + 0.30) * 100) / 100; // 3.3% + $0.30
                totalAmount = selectedAmount + processingFee;

                summaryAmount.textContent = `${selectedAmount.toFixed(2)}`;
                summaryFee.textContent = `${processingFee.toFixed(2)}`;
                summaryTotal.textContent = `${totalAmount.toFixed(2)}`;
            } else {
                summaryAmount.textContent = `$0.00`;
                summaryFee.textContent = `$0.00`;
                summaryTotal.textContent = `$0.00`;
            }
        }

        // Card Input Formatting
        function formatCardInputs() {
            const cardNumber = document.getElementById('cardNumber');
            const cardExpiry = document.getElementById('cardExpiry');
            const cardCvv = document.getElementById('cardCvv');

            // Format card number
            cardNumber.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
                e.target.value = value;
            });

            // Format expiry date
            cardExpiry.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length >= 2) {
                    value = value.substring(0, 2) + '/' + value.substring(2, 4);
                }
                e.target.value = value;
            });

            // Format CVV (numbers only)
            cardCvv.addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/\D/g, '');
            });
        }

        // Real-time Validation - Updated for 3 fields
        function setupRealTimeValidation() {
            // Email validation
            const emailInput = document.getElementById('email');
            emailInput.addEventListener('blur', function() {
                validateEmail(this.value, 'emailError');
            });

            // Phone validation
            const phoneInput = document.getElementById('phone');
            phoneInput.addEventListener('blur', function() {
                validatePhone(this.value, 'phoneError');
            });

            // Card number validation
            const cardNumber = document.getElementById('cardNumber');
            cardNumber.addEventListener('blur', function() {
                validateCardNumber(this.value.replace(/\s/g, ''), 'cardNumberError');
            });

            // Expiry validation
            const cardExpiry = document.getElementById('cardExpiry');
            cardExpiry.addEventListener('blur', function() {
                validateExpiry(this.value, 'cardExpiryError');
            });
        }

        // Validation Functions
        function validateEmail(email, errorId) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return showValidationError(errorId, !emailRegex.test(email), 'Please enter a valid email address');
        }

        function validateCardNumber(cardNumber, errorId) {
            const isValid = cardNumber.length >= 13 && cardNumber.length <= 19 && /^\d+$/.test(cardNumber);
            return showValidationError(errorId, !isValid, 'Please enter a valid card number');
        }

        function validateExpiry(expiry, errorId) {
            const expiryRegex = /^(0[1-9]|1[0-2])\/([0-9]{2})$/;
            let isValid = expiryRegex.test(expiry);

            if (isValid) {
                const [month, year] = expiry.split('/');
                const currentDate = new Date();
                const currentYear = currentDate.getFullYear() % 100;
                const currentMonth = currentDate.getMonth() + 1;
                const expYear = parseInt(year);
                const expMonth = parseInt(month);

                isValid = expYear > currentYear || (expYear === currentYear && expMonth >= currentMonth);
            }

            return showValidationError(errorId, !isValid, 'Please enter a valid expiry date');
        }

        function showValidationError(errorId, showError, message) {
            const errorElement = document.getElementById(errorId);
            const inputElement = errorElement.previousElementSibling;

            if (showError) {
                errorElement.textContent = message;
                errorElement.classList.add('show');
                inputElement.classList.add('error');
                return false;
            } else {
                errorElement.classList.remove('show');
                inputElement.classList.remove('error');
                return true;
            }
        }

        // Form Validation - Updated for 3 fields
        function validateForm() {
            let isValid = true;

            // Check if amount is selected
            if (selectedAmount <= 0) {
                alert('Please select or enter a donation amount.');
                return false;
            }

            // Check required fields - Updated to only 3 fields
            const requiredFields = ['fullName', 'email', 'phone'];
            requiredFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                const errorId = fieldId + 'Error';

                if (!field.value.trim()) {
                    showValidationError(errorId, true, 'This field is required');
                    isValid = false;
                } else {
                    showValidationError(errorId, false, '');
                }
            });

            // Validate email
            const email = document.getElementById('email').value;
            if (email && !validateEmail(email, 'emailError')) {
                isValid = false;
            }

            // Validate phone number
            const phone = document.getElementById('phone').value;
            if (phone && !validatePhone(phone, 'phoneError')) {
                isValid = false;
            }

            // Validate payment method
            const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
            if (paymentMethod === 'card') {
                const cardFields = [{
                        id: 'cardNumber',
                        validator: (val) => validateCardNumber(val.replace(/\s/g, ''), 'cardNumberError')
                    },
                    {
                        id: 'cardName',
                        validator: (val) => showValidationError('cardNameError', !val.trim(), 'Please enter cardholder name')
                    },
                    {
                        id: 'cardExpiry',
                        validator: (val) => validateExpiry(val, 'cardExpiryError')
                    },
                    {
                        id: 'cardCvv',
                        validator: (val) => showValidationError('cardCvvError', val.length < 3, 'Please enter valid CVV')
                    }
                ];

                cardFields.forEach(field => {
                    const value = document.getElementById(field.id).value;
                    if (!field.validator(value)) {
                        isValid = false;
                    }
                });
            }

            return isValid;
        }

        // Add phone validation function
        function validatePhone(phone, errorId) {
            const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
            return showValidationError(errorId, !phoneRegex.test(phone.replace(/[\s\-\(\)]/g, '')), 'Please enter a valid phone number');
        }

        // Form Submission Handler
        async function handleFormSubmission(event) {
            event.preventDefault();

            if (!validateForm()) {
                return;
            }

            // Show loading state
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            try {
                // Simulate payment processing
                await simulatePaymentProcessing();

                // Show success message
                showThankYouMessage();

            } catch (error) {
                alert('Payment processing failed. Please try again.');
                console.error('Payment error:', error);
            } finally {
                // Reset button state
                submitBtn.classList.remove('btn-loading');
                submitBtn.disabled = false;
            }
        }

        // Simulate Payment Processing
        function simulatePaymentProcessing() {
            return new Promise((resolve) => {
                setTimeout(() => {
                    console.log('Payment processed:', {
                        amount: selectedAmount,
                        fee: processingFee,
                        total: totalAmount,
                        timestamp: new Date().toISOString()
                    });
                    resolve();
                }, 2000);
            });
        }

        // Show Thank You Message
        function showThankYouMessage() {
            // Hide form
            document.querySelector('.donation-form-section').style.display = 'none';

            // Show thank you message
            thankYouMessage.classList.add('show');

            // Scroll to thank you message
            thankYouMessage.scrollIntoView({
                behavior: 'smooth'
            });

            // Send confirmation email (simulation)
            sendConfirmationEmail();
        }

        // Send Confirmation Email (Simulation)
        function sendConfirmationEmail() {
            const email = document.getElementById('email').value;
            const firstName = document.getElementById('firstName').value;

            console.log('Sending confirmation email to:', email);
            console.log('Donor name:', firstName);
            console.log('Donation amount:', `${selectedAmount.toFixed(2)}`);

            // In a real application, this would send an actual email
            setTimeout(() => {
                console.log('Confirmation email sent successfully');
            }, 1000);
        }

        // Keyboard Accessibility
        document.addEventListener('keydown', function(event) {
            // Allow ESC to clear form focus
            if (event.key === 'Escape') {
                document.activeElement.blur();
            }

            // Allow Enter to submit form when on submit button
            if (event.key === 'Enter' && document.activeElement === submitBtn) {
                event.preventDefault();
                handleFormSubmission(event);
            }
        });

        // Accessibility: Focus management
        function manageFocus() {
            const focusableElements = document.querySelectorAll(
                'input:not([disabled]), button:not([disabled]), select:not([disabled]), textarea:not([disabled])'
            );

            focusableElements.forEach((element, index) => {
                element.addEventListener('keydown', function(event) {
                    if (event.key === 'Tab') {
                        // Custom tab navigation if needed
                    }
                });
            });
        }

        // Initialize accessibility features
        manageFocus();

        // Auto-save form data - Updated for 3 fields
        function autoSaveFormData() {
            const formData = {
                fullName: document.getElementById('fullName').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                amount: selectedAmount
            };

            console.log('Auto-saving form data:', formData);
        }

        // Auto-save every 30 seconds
        setInterval(autoSaveFormData, 3000);

        // Load saved form data on page load (if available)
        function loadSavedFormData() {
            // In a real implementation, you would use:
            // const savedData = localStorage.getItem('donationFormData');
            // if (savedData) {
            //     const data = JSON.parse(savedData);
            //     // Populate form fields with saved data
            // }

            console.log('Loading saved form data...');
        }

        // Load saved data
        loadSavedFormData();
    </script>
</body>

</html>