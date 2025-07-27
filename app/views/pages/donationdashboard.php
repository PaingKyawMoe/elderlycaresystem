<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
            overflow-x: hidden;
        }

        .background-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 119, 198, 0.2) 0%, transparent 50%);
            z-index: -1;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
            color: white;
        }

        .header h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background: linear-gradient(45deg, #fff, #f0f0f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header p {
            font-size: 1.2rem;
            opacity: 0.9;
            font-weight: 300;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            box-shadow:
                0 8px 32px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.3);
        }

        .stat-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1rem;
            color: #718096;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .donations-table-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow:
                0 8px 32px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .donations-table {
            width: 100%;
            border-collapse: collapse;
        }

        .donations-table th {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 1.5rem 1rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .donations-table td {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            color: #2d3748;
            vertical-align: middle;
        }

        .donations-table tbody tr {
            transition: all 0.3s ease;
        }

        .donations-table tbody tr:hover {
            background: rgba(102, 126, 234, 0.05);
        }

        .id-cell {
            font-weight: 600;
            color: #667eea;
        }

        .name-cell {
            font-weight: 600;
            color: #2d3748;
        }

        .email-cell {
            color: #718096;
            font-size: 0.9rem;
        }

        .phone-cell {
            color: #4a5568;
            font-size: 0.9rem;
        }

        .amount-cell {
            font-weight: 700;
            color: #38a169;
            font-size: 1.1rem;
        }

        .payment-cell {
            display: inline-flex;
            align-items: center;
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #718096;
            font-style: italic;
        }

        .empty-state-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            opacity: 0.5;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            gap: 0.5rem;
        }

        .pagination-btn {
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            min-width: 45px;
            text-align: center;
        }

        .pagination-btn:hover:not(:disabled) {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-btn.active {
            background: rgba(255, 255, 255, 0.95);
            color: #667eea;
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .pagination-info {
            color: white;
            font-size: 0.9rem;
            margin: 0 1rem;
            opacity: 0.9;
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .header h1 {
                font-size: 2rem;
            }

            .stat-card {
                padding: 1.5rem;
            }

            .donations-table th,
            .donations-table td {
                padding: 1rem 0.5rem;
                font-size: 0.8rem;
            }

            .pagination {
                flex-wrap: wrap;
            }

            .pagination-btn {
                padding: 0.5rem 0.75rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="background-overlay"></div>

    <div class="container">
        <div class="header">
            <h1>Donation Dashboard</h1>
            <p>Celebrating generosity and making impact together</p>
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
                    echo !empty($data['donationData']) ? count($data['donationData']) : 0;
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
                    if (!empty($data['donationData'])) {
                        $total = array_sum(array_column($data['donationData'], 'amount'));
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
                    if (!empty($data['donationData'])) {
                        $total = array_sum(array_column($data['donationData'], 'amount'));
                        $count = count($data['donationData']);
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
        const donationData = <?php echo json_encode(!empty($data['donationData']) ? $data['donationData'] : []); ?>;

        // Pagination variables
        const itemsPerPage = 10;
        let currentPage = 1;
        const totalPages = Math.ceil(donationData.length / itemsPerPage);

        function displayTable(page) {
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';

            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const pageData = donationData.slice(start, end);

            if (pageData.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="empty-state">
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
                    <td><span class="payment-cell">${escapeHtml(donation.payment_method)}</span></td>
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
                    <td colspan="6" class="empty-state">
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