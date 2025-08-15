<?php
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<script>
    const csrfToken = "<?php echo $_SESSION['csrf_token']; ?>";
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/donationdash.css?v=<?= time(); ?>">
</head>

<body>
    <div class="background-overlay"></div>

    <div class="container">
        <div class="header">
            <h1>
                <i class="fas fa-calendar-check header-icon"></i>
                <span class="header-title">Donation Data</span>
            </h1>
            <div class="header-actions">
                <button class="btn btn-primary" onclick="window.location.href='<?= URLROOT; ?>/Users/userlist'">
                    ViewUsers
                </button>
                <button class="btn btn-primary" onclick="window.location.href='<?= URLROOT; ?>/pages/emplist'">
                    EmpList
                </button>
                <button class="btn btn-primary" onclick="window.location.href='<?= URLROOT; ?>/Appointment/list'">
                    AppointmentData
                </button>
                <a href="<?= URLROOT ?>/Auth/logout" class="btn logout-btn">
                    Logout
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="stats-row">
            <div class="stat-card fade-in">
                <div class="stat-icon">
                    <svg width="32" height="32" fill="white" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    </svg>
                </div>
                <div class="stat-value">
                    <?php
                    echo !empty($data['Donation']) ? count($data['Donation']) : 0;
                    ?>
                </div>
                <div class="stat-label">Total Donations</div>
            </div>

            <div class="stat-card fade-in" style="animation-delay: 0.1s">
                <div class="stat-icon">
                    <svg width="32" height="32" fill="white" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                    </svg>
                </div>
                <div class="stat-value">
                    <?php
                    if (!empty($data['Donation'])) {
                        $total = array_sum(array_column($data['Donation'], 'amount'));
                        echo '$' . number_format($total, 2);
                    } else {
                        echo '$0';
                    }
                    ?>
                </div>
                <div class="stat-label">Total Amount</div>
            </div>

            <div class="stat-card fade-in" style="animation-delay: 0.2s">
                <div class="stat-icon">
                    <svg width="32" height="32" fill="white" viewBox="0 0 24 24">
                        <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z" />
                    </svg>
                </div>
                <div class="stat-value">
                    <?php
                    if (!empty($data['Donation'])) {
                        $total = array_sum(array_column($data['Donation'], 'amount'));
                        $count = count($data['Donation']);
                        $average = $total / $count;
                        echo '$' . number_format($average, 2);
                    } else {
                        echo '$0';
                    }
                    ?>
                </div>
                <div class="stat-label">Average Donation</div>
            </div>
        </div>

        <div class="donations-table-container">
            <div class="table-wrapper">
                <table class="donations-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Table rows will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>

        <div class="pagination" id="pagination">
            <!-- Pagination will be populated by JavaScript -->
        </div>
    </div>

    <script>
        // PHP data passed to JavaScript
        const donationData = <?php echo json_encode(!empty($data['Donation']) ? $data['Donation'] : []); ?>;

        // Pagination variables
        const itemsPerPage = 10;
        let currentPage = 1;
        const totalPages = Math.ceil(donationData.length / itemsPerPage);

        function getPaymentMethodIcon(paymentMethod) {
            const method = paymentMethod.toLowerCase();

            if (method.includes('paypal')) {
                return {
                    class: 'paypal',
                    icon: `<svg viewBox="0 0 24 24" fill="none">
                        <path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 0 0-.469-.06c-.762-.01-1.467.056-2.16.171-.06 3.06-1.44 5.264-4.314 6.394L12.87 21.337h3.585a.641.641 0 0 0 .633-.74l.9-5.71h1.52c3.585 0 6.187-1.425 7.016-5.91z" fill="#003087"/>
                        <path d="M6.03 21.337H1.424a.641.641 0 0 1-.633-.74L3.898.901C3.98.382 4.428 0 4.952 0h7.46c2.57 0 4.578.543 5.69 1.81.85.97 1.213 2.115 1.012 3.537-.983 5.05-4.349 6.797-8.647 6.797H8.277c-.524 0-.968.382-1.05.9L6.03 21.337z" fill="#0070ba"/>
                        <path d="M20.176 6.917c-.762-.01-1.467.056-2.16.171-.06 3.06-1.44 5.264-4.314 6.394L12.293 21.337h3.585a.641.641 0 0 0 .633-.74l.9-5.71h1.52c3.585 0 6.187-1.425 7.016-5.91a3.35 3.35 0 0 0-.469-.06z" fill="#00a9e0"/>
                    </svg>`
                };
            } else if (method.includes('wave') || method.includes('wavepay')) {
                return {
                    class: 'wave-pay',
                    icon: `<svg viewBox="0 0 100 100" fill="none">
                        <rect width="100" height="100" fill="#FFD500"/>
                        <g transform="translate(20, 20)">
                            <circle cx="30" cy="30" r="28" fill="#0099CC"/>
                            <circle cx="35" cy="25" r="23" fill="#0088BB"/>
                            <circle cx="30" cy="30" r="8" fill="#FFD500"/>
                            <path d="M10 30 Q20 10, 30 30 Q40 50, 50 30" stroke="#FFD500" stroke-width="3" fill="none"/>
                        </g>
                    </svg>`
                };
            } else if (method.includes('kbz') || method.includes('kpay')) {
                return {
                    class: 'kbz-pay',
                    icon: `<svg viewBox="0 0 100 100" fill="none">
                        <rect width="100" height="100" rx="12" ry="12" fill="#1e5aa8"/>
                        <text x="50" y="40" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-weight="bold" font-size="20">KBZ</text>
                        <text x="50" y="65" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-weight="normal" font-size="16">Pay</text>
                        <path d="M15 15 L25 25 M85 15 L75 25 M15 85 L25 75 M85 85 L75 75" stroke="white" stroke-width="2"/>
                    </svg>`
                };
            } else if (method.includes('credit') || method.includes('card') || method.includes('visa') || method.includes('mastercard')) {
                return {
                    class: 'credit-card',
                    icon: `<svg viewBox="0 0 100 60" fill="none">
                        <!-- Main card -->
                        <rect x="5" y="8" width="90" height="44" rx="4" ry="4" fill="#1a1a1a"/>
                        <!-- Chip -->
                        <rect x="12" y="18" width="12" height="10" rx="2" ry="2" fill="white" opacity="0.9"/>
                        <rect x="14" y="20" width="8" height="6" rx="1" ry="1" fill="#1a1a1a"/>
                        <!-- Card number dots -->
                        <circle cx="30" cy="32" r="1" fill="white" opacity="0.8"/>
                        <circle cx="34" cy="32" r="1" fill="white" opacity="0.8"/>
                        <circle cx="38" cy="32" r="1" fill="white" opacity="0.8"/>
                        <circle cx="42" cy="32" r="1" fill="white" opacity="0.8"/>
                        <circle cx="48" cy="32" r="1" fill="white" opacity="0.8"/>
                        <circle cx="52" cy="32" r="1" fill="white" opacity="0.8"/>
                        <circle cx="56" cy="32" r="1" fill="white" opacity="0.8"/>
                        <circle cx="60" cy="32" r="1" fill="white" opacity="0.8"/>
                        <!-- Second card (overlapped) -->
                        <rect x="10" y="3" width="90" height="44" rx="4" ry="4" fill="#1a1a1a" opacity="0.7"/>
                        <!-- Credit card text -->
                        <text x="85" y="15" text-anchor="end" fill="white" font-family="Arial, sans-serif" font-size="6" opacity="0.9">CREDIT CARD</text>
                    </svg>`
                };
            } else if (method.includes('bank') || method.includes('transfer')) {
                return {
                    class: 'bank-transfer',
                    icon: `<svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 1L21 6v2H3V6l9-5zm7 8v8h2v1H3v-1h2V9h14zm-2 0h-3v8h3V9zm-5 0H9v8h3V9zm-5 0H4v8h3V9z"/>
                    </svg>`
                };
            } else if (method.includes('cash')) {
                return {
                    class: 'cash',
                    icon: `<svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z"/>
                    </svg>`
                };
            } else {
                return {
                    class: 'default',
                    icon: `<svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>`
                };
            }
        }

        function createPaymentMethodDisplay(paymentMethod) {
            const iconData = getPaymentMethodIcon(paymentMethod);
            return `
                <div class="payment-method-container">
                    <div class="payment-icon ${iconData.class}">
                        ${iconData.icon}
                    </div>
                    <span class="payment-text">${escapeHtml(paymentMethod)}</span>
                </div>
            `;
        }

        function updateDonationStatus(donationId, newStatus) {
            fetch('<?php echo URLROOT; ?>/donations/updateStatus', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-Token': csrfToken // send token
                    },
                    body: JSON.stringify({
                        donation_id: donationId,
                        status: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const donationIndex = donationData.findIndex(d => d.id == donationId);
                        if (donationIndex !== -1) {
                            donationData[donationIndex].status = newStatus;
                            displayTable(currentPage);
                        }
                    } else {
                        alert('Error updating status: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error updating status');
                });
        }


        function createStatusButtons(donation) {
            const statusButtonsHtml = `
                <div class="status-buttons">
                    <button class="status-btn complete ${donation.status === 'complete' ? 'active' : ''}" 
                            onclick="updateDonationStatus(${donation.id}, 'complete')">
                        Complete
                    </button>
                    <button class="status-btn pending ${donation.status === 'pending' ? 'active' : ''}" 
                            onclick="updateDonationStatus(${donation.id}, 'pending')">
                        Pending
                    </button>
                    <button class="status-btn not ${donation.status === 'not' ? 'active' : ''}" 
                            onclick="updateDonationStatus(${donation.id}, 'not')">
                        Not
                    </button>
                </div>
            `;
            return statusButtonsHtml;
        }

        function displayTable(page) {
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';

            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const pageData = donationData.slice(start, end);

            if (pageData.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="7" class="empty-state">
                            <div>
                                <svg class="empty-state-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                                <div>No donations found</div>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            pageData.forEach(donation => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><span class="id-cell">${escapeHtml(donation.id)}</span></td>
                    <td><span class="name-cell">${escapeHtml(donation.full_name)}</span></td>
                    <td><span class="email-cell">${escapeHtml(donation.email)}</span></td>
                    <td><span class="phone-cell">${escapeHtml(donation.phone)}</span></td>
                    <td><span class="amount-cell">$${parseFloat(donation.amount).toFixed(2)}</span></td>
                   <td>${createPaymentMethodDisplay(escapeHtml(donation.payment_method))}</td>
                    <td>${createStatusButtons(donation)}</td>
                `;
                tableBody.appendChild(row);
            });
        }

        function displayPagination() {
            const paginationDiv = document.getElementById('pagination');
            paginationDiv.innerHTML = '';

            if (totalPages <= 1) return;

            // Previous button
            const prevBtn = document.createElement('button');
            prevBtn.className = 'pagination-btn';
            prevBtn.innerHTML = '‹';
            prevBtn.disabled = currentPage === 1;
            prevBtn.onclick = () => {
                if (currentPage > 1) {
                    currentPage--;
                    displayTable(currentPage);
                    displayPagination();
                }
            };
            paginationDiv.appendChild(prevBtn);

            // Page numbers
            const maxButtons = 7; // Maximum number of page buttons to show
            let startPage = 1;
            let endPage = totalPages;

            if (totalPages > maxButtons) {
                const halfButtons = Math.floor(maxButtons / 2);
                if (currentPage <= halfButtons) {
                    endPage = maxButtons;
                } else if (currentPage >= totalPages - halfButtons) {
                    startPage = totalPages - maxButtons + 1;
                } else {
                    startPage = currentPage - halfButtons;
                    endPage = currentPage + halfButtons;
                }
            }

            // First page + ellipsis
            if (startPage > 1) {
                const firstBtn = createPageButton(1);
                paginationDiv.appendChild(firstBtn);

                if (startPage > 2) {
                    const ellipsis = document.createElement('span');
                    ellipsis.className = 'pagination-info';
                    ellipsis.textContent = '...';
                    paginationDiv.appendChild(ellipsis);
                }
            }

            // Page buttons
            for (let i = startPage; i <= endPage; i++) {
                const pageBtn = createPageButton(i);
                paginationDiv.appendChild(pageBtn);
            }

            // Ellipsis + last page
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const ellipsis = document.createElement('span');
                    ellipsis.className = 'pagination-info';
                    ellipsis.textContent = '...';
                    paginationDiv.appendChild(ellipsis);
                }

                const lastBtn = createPageButton(totalPages);
                paginationDiv.appendChild(lastBtn);
            }

            // Next button
            const nextBtn = document.createElement('button');
            nextBtn.className = 'pagination-btn';
            nextBtn.innerHTML = '›';
            nextBtn.disabled = currentPage === totalPages;
            nextBtn.onclick = () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    displayTable(currentPage);
                    displayPagination();
                }
            };
            paginationDiv.appendChild(nextBtn);

            // Page info
            const pageInfo = document.createElement('span');
            pageInfo.className = 'pagination-info';
            pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
            paginationDiv.appendChild(pageInfo);
        }

        function createPageButton(pageNum) {
            const btn = document.createElement('button');
            btn.className = 'pagination-btn';
            if (pageNum === currentPage) {
                btn.classList.add('active');
            }
            btn.textContent = pageNum;
            btn.onclick = () => {
                currentPage = pageNum;
                displayTable(currentPage);
                displayPagination();
            };
            return btn;
        }

        function escapeHtml(unsafe) {
            return unsafe
                .toString()
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        // Initialize table and pagination
        if (donationData.length > 0) {
            displayTable(currentPage);
            displayPagination();
        } else {
            // Show empty state
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = `
                <tr>
                    <td colspan="7" class="empty-state">
                        <div>
                            <svg class="empty-state-icon" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <div>No donations found</div>
                        </div>
                    </td>
                </tr>
            `;
        }
    </script>
</body>

</html>