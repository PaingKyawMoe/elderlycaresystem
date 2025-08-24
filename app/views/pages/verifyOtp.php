<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                sans-serif;
            background: radial-gradient(rgb(219, 234, 254),
                    rgb(147, 197, 253),
                    rgb(59, 130, 246));
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 28px;
            font-weight: 600;
        }

        .form-subtitle {
            text-align: center;
            margin-bottom: 30px;
            color: #666;
            font-size: 16px;
        }

        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            z-index: 2;
            color: #667eea;
        }

        input[type="email"] {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        input[type="email"]:focus {
            outline: none;
            border-color: #667eea;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .otp-label {
            display: block;
            margin-bottom: 15px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
            text-align: center;
        }

        .otp-container {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 25px;
        }

        .otp-input {
            width: 50px;
            height: 60px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            color: #333;
            background: #f8f9fa;
            transition: all 0.3s ease;
        }

        .otp-input:focus {
            outline: none;
            border-color: #667eea;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .otp-input:not(:placeholder-shown) {
            border-color: #28a745;
            background: #f8fff9;
        }

        /* Hidden actual OTP input */
        input[name="otp"] {
            display: none;
        }

        .submit-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 30px 20px;
                margin: 10px;
            }

            .otp-container {
                gap: 8px;
            }

            .otp-input {
                width: 42px;
                height: 50px;
                font-size: 20px;
            }

            .form-title {
                font-size: 24px;
            }
        }

        .resend-link {
            text-align: center;
            margin-top: 20px;
        }

        .resend-link a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .resend-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2 class="form-title">Verify Your Account</h2>
        <p class="form-subtitle">Enter your email and code sent to your inbox</p>

        <form method="POST" action="<?= URLROOT ?>/users/verifyOtp">
            <div class="input-group">
                <label for="email">Email Address</label>
                <div class="input-wrapper">
                    <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <polyline points="22,6 12,13 2,6" />
                    </svg>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                </div>
            </div>

            <div class="input-group">
                <label class="otp-label">Verification Code</label>
                <div class="otp-container">
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                </div>
                <!-- Hidden input for backend -->
                <input type="text" name="otp" required readonly>
            </div>

            <button type="submit" class="submit-btn">
                <svg style="display: inline-block; margin-right: 8px;" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20,6 9,17 4,12" />
                </svg>
                Verify Account
            </button>
        </form>

        <div class="resend-link">
            <a href="#" onclick="resendOtp()">Didn't receive code? Resend</a>
        </div>
    </div>

    <script>
        const otpInputs = document.querySelectorAll('.otp-input');
        const hiddenOtpInput = document.querySelector('input[name="otp"]');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', function(e) {
                const value = e.target.value;

                // Only allow numbers
                if (!/^\d*$/.test(value)) {
                    e.target.value = '';
                    return;
                }

                // Move to next input
                if (value && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }

                // Update hidden input
                updateHiddenOtpInput();
            });

            input.addEventListener('keydown', function(e) {
                // Move to previous input on backspace
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    otpInputs[index - 1].focus();
                }

                // Move between inputs with arrow keys
                if (e.key === 'ArrowLeft' && index > 0) {
                    otpInputs[index - 1].focus();
                }
                if (e.key === 'ArrowRight' && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });

            input.addEventListener('paste', function(e) {
                e.preventDefault();
                const paste = (e.clipboardData || window.clipboardData).getData('text');
                const digits = paste.replace(/\D/g, '').split('').slice(0, 6);

                digits.forEach((digit, i) => {
                    if (otpInputs[i]) {
                        otpInputs[i].value = digit;
                    }
                });

                updateHiddenOtpInput();

                // Focus on the last filled input or the next empty one
                const lastIndex = Math.min(digits.length - 1, 5);
                otpInputs[lastIndex].focus();
            });
        });

        function updateHiddenOtpInput() {
            const otp = Array.from(otpInputs).map(input => input.value).join('');
            hiddenOtpInput.value = otp;
        }

        function resendOtp() {
            // Clear OTP inputs
            otpInputs.forEach(input => input.value = '');
            updateHiddenOtpInput();
            otpInputs[0].focus();

            // You can add AJAX call here to resend OTP
            alert('Verification code has been resent to your email!');
        }

        // Auto-focus first OTP input when page loads
        window.addEventListener('load', function() {
            otpInputs[0].focus();
        });
    </script>
</body>

</html>