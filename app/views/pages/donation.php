<?php
// (file top) — session + CSRF
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // 64-char token
}

// Helper for safe echo
function e($v)
{
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Elder Care - Make a Difference Today</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/donation.css?v=<?= time(); ?>">
</head>

<body>
    <header class="header" id="header">
        <div class="header-container">
            <a href="#" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-heart-pulse"></i>
                </div>
                Elderly Care System
            </a>

            <nav id="nav">
                <a href="<?= e(URLROOT) ?>/pages/home">Home</a>
                <a href="<?= e(URLROOT) ?>/pages/donate" class="active">Donate</a>
                <a href="<?= e(URLROOT) ?>/pages/about">About Us</a>
                <a href="<?= e(URLROOT) ?>/pages/signin">Admin</a>
                <button class="call-now">Call Now</button>
            </nav>
        </div>
    </header>
    <header class="header1">
        <h1>Support Our Elders with Love</h1>
        <p>Your generosity brings comfort, dignity, and joy to elderly lives. Together, we create a caring community where every senior feels valued and supported.</p>
    </header>

    <!-- Cause Cards -->
    <div class="causes-grid">
        <div class="cause-card">
            <div class="cause-icon">
                <!-- Food/Utensils Icon -->
                <svg viewBox="0 0 24 24">
                    <path d="M3 2v7c0 1.1.9 2 2 2h4v9a1 1 0 0 0 2 0V11h4c1.1 0 2-.9 2-2V2M5 2v5h2V2m4 0v5h2V2m4 0v5h2V2M19 15v6a1 1 0 0 1-2 0v-6h-1a1 1 0 0 1-1-1V8a6 6 0 0 1 6 6 1 1 0 0 1-1 1h-1Z" />
                </svg>
            </div>
            <h3 class="cause-title">Nutritious Food</h3>
            <p class="cause-description">Provide healthy, home-cooked meals that nourish body and soul</p>
            <div class="cause-amount">$25</div>
            <p class="cause-impact">Feeds one elder for a day</p>
        </div>

        <div class="cause-card">
            <div class="cause-icon">
                <!-- Healthcare/Heart Icon -->
                <svg viewBox="0 0 24 24">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                    <path d="M12 2v6m0 4v10" />
                    <path d="M5 12h14" />
                </svg>
            </div>
            <h3 class="cause-title">Healthcare</h3>
            <p class="cause-description">Essential medical care, medications, and regular health checkups</p>
            <div class="cause-amount">$100</div>
            <p class="cause-impact">Covers monthly medical needs</p>
        </div>

        <div class="cause-card">
            <div class="cause-icon">
                <!-- Home Icon -->
                <svg viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <path d="M9 22V12h6v10" />
                </svg>
            </div>
            <h3 class="cause-title">Safe Housing</h3>
            <p class="cause-description">Comfortable shelter with 24/7 care and support services</p>
            <div class="cause-amount">$250</div>
            <p class="cause-impact">Provides weekly accommodation</p>
        </div>

        <div class="cause-card">
            <div class="cause-icon">
                <!-- Shield Icon -->
                <svg viewBox="0 0 24 24">
                    <path d="M12 2l9 4v6c0 5.5-3.5 10.5-9 12-5.5-1.5-9-6.5-9-12V6l9-4z" />
                    <path d="M9 12l2 2 4-4" />
                </svg>
            </div>
            <h3 class="cause-title">Safety & Security</h3>
            <p class="cause-description">Emergency response systems and protective services</p>
            <div class="cause-amount">$50</div>
            <p class="cause-impact">Ensures 24/7 safety monitoring</p>
        </div>
    </div>

    <!-- Donation Form -->
    <div class="donation-form" id="donationFormContainer">
        <div class="form-header">
            <h2>Make Your Impact Today</h2>
            <p>Choose how you'd like to help</p>
        </div>

        <form method="POST" action="<?= e(URLROOT) ?>/Donations/donate" id="donationForm">
            <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">

            <!-- Amount Selection -->
            <div class="form-section">
                <h3 class="section-title">Select Donation Amount</h3>
                <div class="amount-grid">
                    <div class="amount-btn">
                        <input type="radio" id="amount25" name="amount" value="25">
                        <label for="amount25">$25</label>
                    </div>
                    <div class="amount-btn">
                        <input type="radio" id="amount50" name="amount" value="50">
                        <label for="amount50">$50</label>
                    </div>
                    <div class="amount-btn">
                        <input type="radio" id="amount100" name="amount" value="100" checked>
                        <label for="amount100">$100</label>
                    </div>
                    <div class="amount-btn">
                        <input type="radio" id="amount250" name="amount" value="250">
                        <label for="amount250">$250</label>
                    </div>
                    <div class="amount-btn">
                        <input type="radio" id="amount500" name="amount" value="500">
                        <label for="amount500">$500</label>
                    </div>
                    <div class="amount-btn">
                        <input type="radio" id="amountCustom" name="amount" value="custom">
                        <label for="amountCustom">Other</label>
                    </div>
                </div>
                <div class="custom-amount-container" id="customAmountContainer">
                    <input type="number" class="custom-amount-input" id="customAmount" name="customAmount" placeholder="Enter custom amount" min="1">
                </div>
            </div>

            <!-- Personal Information -->
            <div class="form-section">
                <h3 class="section-title">Your Information</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="fullName">Full Name *</label>
                        <input type="text" class="form-input" id="fullName" name="fullName" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email Address *</label>
                        <input type="email" class="form-input" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone">Phone Number *</label>
                        <input type="tel" class="form-input" id="phone" name="phone" required>
                    </div>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="form-section">
                <h3 class="section-title">Payment Method</h3>
                <div class="payment-methods">
                    <div class="payment-method">
                        <input type="radio" id="payCard" name="paymentMethod" value="card" checked>
                        <label for="payCard">
                            <div class="payment-icon">
                                <svg width="50" height="40" viewBox="0 0 50 40" fill="currentColor">
                                    <rect x="5" y="8" width="40" height="24" rx="3" fill="#4f46e5" />
                                    <rect x="5" y="14" width="40" height="4" fill="#6366f1" />
                                    <rect x="10" y="24" width="15" height="2" fill="white" />
                                    <circle cx="38" cy="25" r="3" fill="white" />
                                </svg>
                            </div>
                            <span class="payment-name">Card</span>
                        </label>
                    </div>
                    <div class="payment-method">
                        <input type="radio" id="payPaypal" name="paymentMethod" value="paypal">
                        <label for="payPaypal">
                            <div class="payment-icon">
                                <svg width="50" height="40" viewBox="0 0 50 40" fill="none">
                                    <path d="M15 10h10c4 0 7 3 7 7s-3 7-7 7h-5l-1 6h-5l3-20z" fill="#003087" />
                                    <path d="M20 15h10c4 0 7 3 7 7s-3 7-7 7h-5l-1 6h-5l3-20z" fill="#009cde" />
                                </svg>
                            </div>
                            <span class="payment-name">PayPal</span>
                        </label>
                    </div>
                    <div class="payment-method">
                        <input type="radio" id="payKpay" name="paymentMethod" value="kpay">
                        <label for="payKpay">
                            <div class="payment-icon">
                                <svg width="50" height="40" viewBox="0 0 50 40" fill="none">
                                    <rect x="5" y="5" width="40" height="30" rx="5" fill="#1565C0" />
                                    <text x="12" y="22" fill="white" font-size="12" font-weight="bold">KBZ</text>
                                    <text x="12" y="30" fill="white" font-size="8">Pay</text>
                                </svg>
                            </div>
                            <span class="payment-name">KBZ Pay</span>
                        </label>
                    </div>
                    <div class="payment-method">
                        <input type="radio" id="payWave" name="paymentMethod" value="wave">
                        <label for="payWave">
                            <div class="payment-icon">
                                <svg width="50" height="40" viewBox="0 0 50 40" fill="none">
                                    <rect x="5" y="5" width="40" height="30" rx="5" fill="#FFD700" />
                                    <circle cx="25" cy="20" r="8" fill="#1E88E5" />
                                    <path d="M17 20 Q21 15 25 20 Q29 25 33 20" stroke="#1E88E5" stroke-width="2" fill="none" />
                                </svg>
                            </div>
                            <span class="payment-name">Wave Pay</span>
                        </label>
                    </div>
                </div>
                <p class="fee-notice" id="feeNotice">* A small processing fee applies to Card and PayPal payments</p>

                <!-- Card Details -->
                <div class="card-details active" id="cardDetails">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="cardNumber">Card Number *</label>
                            <input type="text" class="form-input" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="cardName">Cardholder Name *</label>
                            <input type="text" class="form-input" id="cardName" name="cardName" placeholder="Paing Kyaw Moe">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="expiry">Expiry Date *</label>
                            <input type="text" class="form-input" id="expiry" name="expiry" placeholder="MM/YY" maxlength="5">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="cvv">CVV *</label>
                            <input type="text" class="form-input" id="cvv" name="cvv" placeholder="123" maxlength="4">
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
                <div class="summary-row fee-row" id="feeRow">
                    <span>Processing Fee:</span>
                    <span id="summaryFee">$3.30</span>
                </div>
                <div class="summary-row">
                    <span>Total Amount:</span>
                    <span id="summaryTotal">$103.30</span>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn" id="submitBtn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                </svg>
                Complete Donation
            </button>

            <div class="security-badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="10" rx="2" ry="2" />
                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
                Your payment is secured with 256-bit SSL encryption
            </div>
        </form>
    </div>

    <!-- Success Message -->
    <div class="success-message" id="successMessage" style="display: none;">
        <div class="success-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                <polyline points="20 6 9 17 4 12" />
            </svg>
        </div>
        <h2 class="success-title">Thank You for Your Generosity!</h2>
        <p class="success-text">Your donation has been successfully processed. You'll receive a confirmation email shortly with your receipt. Thank you for making a difference in the lives of our elderly community members.</p>
        <button class="btn-primary" onclick="resetForm()">Make Another Donation</button>
    </div>
    </div>

    <?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
        <script>
            // Show success message if redirected with success parameter
            document.getElementById('donationFormContainer').style.display = 'none';
            document.getElementById('successMessage').style.display = 'block';
            document.getElementById('successMessage').classList.add('active');
        </script>
    <?php endif; ?>

    <script>
        // State Management
        const state = {
            amount: 100,
            paymentMethod: 'card',
            processingFee: 0,
            total: 0
        };

        // DOM Elements
        const elements = {
            customAmountContainer: document.getElementById('customAmountContainer'),
            customAmount: document.getElementById('customAmount'),
            cardDetails: document.getElementById('cardDetails'),
            summaryAmount: document.getElementById('summaryAmount'),
            summaryFee: document.getElementById('summaryFee'),
            summaryTotal: document.getElementById('summaryTotal'),
            donationForm: document.getElementById('donationForm'),
            submitBtn: document.getElementById('submitBtn'),
            feeRow: document.getElementById('feeRow'),
            feeNotice: document.getElementById('feeNotice'),
            donationFormContainer: document.getElementById('donationFormContainer'),
            successMessage: document.getElementById('successMessage')
        };

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            setupEventListeners();
            updateSummary();
            setupCardFormatting();
        });

        // Event Listeners
        function setupEventListeners() {
            // Amount selection
            document.querySelectorAll('input[name="amount"]').forEach(input => {
                input.addEventListener('change', handleAmountChange);
            });

            // Custom amount
            elements.customAmount.addEventListener('input', handleCustomAmount);

            // Payment method
            document.querySelectorAll('input[name="paymentMethod"]').forEach(input => {
                input.addEventListener('change', handlePaymentMethod);
            });

            // Form submission - AJAX
            elements.donationForm.addEventListener('submit', handleAjaxSubmit);

            // Cause card clicks
            document.querySelectorAll('.cause-card').forEach(card => {
                card.addEventListener('click', function() {
                    const amount = parseInt(this.querySelector('.cause-amount').textContent.replace('$', ''));
                    const amountInput = document.querySelector(`input[name="amount"][value="${amount}"]`);
                    if (amountInput) {
                        amountInput.checked = true;
                        handleAmountChange({
                            target: amountInput
                        });
                        document.querySelector('.donation-form').scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        }

        // Amount Handling
        function handleAmountChange(e) {
            const value = e.target.value;

            if (value === 'custom') {
                elements.customAmountContainer.classList.add('active');
                elements.customAmount.focus();
                state.amount = parseInt(elements.customAmount.value) || 0;
            } else {
                elements.customAmountContainer.classList.remove('active');
                state.amount = parseInt(value);
            }

            updateSummary();
        }

        function handleCustomAmount(e) {
            state.amount = parseInt(e.target.value) || 0;
            updateSummary();
        }

        // Payment Method Handling
        function handlePaymentMethod(e) {
            state.paymentMethod = e.target.value;

            // Show/hide card details
            if (state.paymentMethod === 'card') {
                elements.cardDetails.classList.add('active');
            } else {
                elements.cardDetails.classList.remove('active');
            }

            // Show/hide fee notice
            if (state.paymentMethod === 'card' || state.paymentMethod === 'paypal') {
                elements.feeNotice.classList.add('show');
            } else {
                elements.feeNotice.classList.remove('show');
            }

            updateSummary();
        }

        // Update Summary
        function updateSummary() {
            // Calculate processing fee only for card and PayPal
            if (state.paymentMethod === 'card' || state.paymentMethod === 'paypal') {
                state.processingFee = Math.round((state.amount * 0.033 + 0.30) * 100) / 100;
                elements.feeRow.classList.add('show');
            } else {
                state.processingFee = 0;
                elements.feeRow.classList.remove('show');
            }

            state.total = state.amount + state.processingFee;

            elements.summaryAmount.textContent = `$${state.amount.toFixed(2)}`;
            elements.summaryFee.textContent = `$${state.processingFee.toFixed(2)}`;
            elements.summaryTotal.textContent = `$${state.total.toFixed(2)}`;
        }

        // Card Formatting
        function setupCardFormatting() {
            const cardNumber = document.getElementById('cardNumber');
            const expiry = document.getElementById('expiry');
            const cvv = document.getElementById('cvv');

            // Format card number
            cardNumber.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\s/g, '');
                let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
                e.target.value = formattedValue;
            });

            // Format expiry
            expiry.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length >= 2) {
                    value = value.substring(0, 2) + '/' + value.substring(2, 4);
                }
                e.target.value = value;
            });

            // Format CVV
            cvv.addEventListener('input', (e) => {
                e.target.value = e.target.value.replace(/\D/g, '');
            });
        }

        // AJAX Form Submission
        function handleAjaxSubmit(e) {
            e.preventDefault(); // Prevent normal form submission

            // Show loading state
            elements.submitBtn.disabled = true;
            elements.submitBtn.innerHTML = '<span class="loading"></span> Processing...';

            // Get form data
            const formData = new FormData(elements.donationForm);

            fetch(elements.donationForm.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        showSuccessMessage();
                    } else {
                        throw new Error('Network response was not ok');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an error processing your donation. Please try again.');
                });


        }

        // Show Success Message
        function showSuccessMessage() {
            elements.donationFormContainer.style.display = 'none';
            elements.successMessage.style.display = 'block';

            // Trigger animation
            setTimeout(() => {
                elements.successMessage.classList.add('active');
            }, 100);
        }

        // Reset Form for Another Donation
        function resetForm() {
            elements.successMessage.style.display = 'none';
            elements.successMessage.classList.remove('active');
            elements.donationFormContainer.style.display = 'block';

            // Reset form
            elements.donationForm.reset();

            // Reset state
            state.amount = 100;
            state.paymentMethod = 'card';

            // Reset UI
            document.getElementById('amount100').checked = true;
            document.getElementById('payCard').checked = true;
            elements.customAmountContainer.classList.remove('active');
            elements.cardDetails.classList.add('active');

            // Reset button
            elements.submitBtn.disabled = false;
            elements.submitBtn.innerHTML = `
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                </svg>
                Complete Donation
            `;

            updateSummary();
        }
    </script>
</body>

</html>