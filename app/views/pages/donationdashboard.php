<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Dashboard - Elder Care Support</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --secondary: #06b6d4;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --white: #ffffff;
            --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --radius: 12px;
            --radius-lg: 16px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, var(--gray-50) 0%, #e0e7ff 100%);
            color: var(--gray-800);
            line-height: 1.6;
            min-height: 100vh;
        }

        .dashboard {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 2px;
        }

        .header h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .header p {
            font-size: 1.1rem;
            color: var(--gray-600);
            max-width: 600px;
            margin: 0 auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: var(--white);
            padding: 2rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-icon.primary {
            background: rgba(79, 70, 229, 0.1);
            color: var(--primary);
        }

        .stat-icon.success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .stat-icon.warning {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .stat-icon.secondary {
            background: rgba(6, 182, 212, 0.1);
            color: var(--secondary);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--gray-600);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-trend {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-100);
        }

        .trend-positive {
            color: var(--success);
        }

        .trend-negative {
            color: var(--danger);
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 1024px) {
            .content-grid {
                grid-template-columns: 2fr 1fr;
            }
        }

        .donations-table {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .table-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--gray-200);
            background: var(--gray-50);
        }

        .table-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 0.5rem;
        }

        .table-subtitle {
            color: var(--gray-600);
            font-size: 0.875rem;
        }

        .table-container {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            text-align: left;
            padding: 1rem 1.5rem;
            font-weight: 600;
            color: var(--gray-700);
            background: var(--gray-50);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--gray-100);
            font-size: 0.875rem;
        }

        .table tbody tr:hover {
            background: var(--gray-50);
        }

        .donation-amount {
            font-weight: 700;
            color: var(--primary);
        }

        .payment-method {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .payment-card {
            background: rgba(79, 70, 229, 0.1);
            color: var(--primary);
        }

        .payment-paypal {
            background: rgba(6, 182, 212, 0.1);
            color: var(--secondary);
        }

        .payment-kpay {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .payment-wave {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-completed {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .status-failed {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .chart-card {
            background: var(--white);
            padding: 2rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
        }

        .chart-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 1.5rem;
        }

        .chart-placeholder {
            height: 200px;
            background: linear-gradient(135deg, var(--gray-100) 0%, var(--gray-50) 100%);
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-600);
            font-weight: 500;
        }

        .recent-donors {
            background: var(--white);
            padding: 2rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
        }

        .donor-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid var(--gray-100);
        }

        .donor-item:last-child {
            border-bottom: none;
        }

        .donor-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 600;
            font-size: 0.875rem;
        }

        .donor-info {
            flex: 1;
        }

        .donor-name {
            font-weight: 600;
            color: var(--gray-800);
            font-size: 0.875rem;
        }

        .donor-date {
            color: var(--gray-600);
            font-size: 0.75rem;
        }

        .donor-amount {
            font-weight: 700;
            color: var(--primary);
            font-size: 0.875rem;
        }

        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-700);
        }

        .filter-select {
            padding: 0.5rem 1rem;
            border: 1px solid var(--gray-300);
            border-radius: var(--radius);
            background: var(--white);
            font-size: 0.875rem;
            min-width: 140px;
            transition: border-color 0.2s;
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid var(--gray-300);
            border-radius: 50%;
            border-top-color: var(--primary);
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .dashboard {
                padding: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .stat-card {
                padding: 1.5rem;
            }

            .table th,
            .table td {
                padding: 0.75rem 1rem;
            }

            .filters {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <header class="header">
            <h1>Donation Dashboard</h1>
            <p>Monitor and analyze donations for Elder Care Support with real-time insights and comprehensive reporting</p>
        </header>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-value" id="totalDonations">$24,847</div>
                        <div class="stat-label">Total Donations</div>
                    </div>
                    <div class="stat-icon primary">💰</div>
                </div>
                <div class="stat-trend">
                    <span class="trend-positive">↗ +12.5%</span>
                    <span>vs last month</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-value" id="totalDonors">847</div>
                        <div class="stat-label">Total Donors</div>
                    </div>
                    <div class="stat-icon success">👥</div>
                </div>
                <div class="stat-trend">
                    <span class="trend-positive">↗ +8.3%</span>
                    <span>vs last month</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-value" id="avgDonation">$127</div>
                        <div class="stat-label">Average Donation</div>
                    </div>
                    <div class="stat-icon warning">📊</div>
                </div>
                <div class="stat-trend">
                    <span class="trend-positive">↗ +3.7%</span>
                    <span>vs last month</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-value" id="thisMonth">$3,421</div>
                        <div class="stat-label">This Month</div>
                    </div>
                    <div class="stat-icon secondary">📈</div>
                </div>
                <div class="stat-trend">
                    <span class="trend-positive">↗ +15.2%</span>
                    <span>vs last month</span>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="filters">
            <div class="filter-group">
                <label class="filter-label">Date Range</label>
                <select class="filter-select" id="dateFilter">
                    <option value="7">Last 7 days</option>
                    <option value="30" selected>Last 30 days</option>
                    <option value="90">Last 90 days</option>
                    <option value="365">Last year</option>
                    <option value="all">All time</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">Payment Method</label>
                <select class="filter-select" id="paymentFilter">
                    <option value="all">All Methods</option>
                    <option value="card">Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="kpay">KBZ Pay</option>
                    <option value="wave">Wave Pay</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">Amount Range</label>
                <select class="filter-select" id="amountFilter">
                    <option value="all">All Amounts</option>
                    <option value="0-50">$0 - $50</option>
                    <option value="51-100">$51 - $100</option>
                    <option value="101-250">$101 - $250</option>
                    <option value="251+">$251+</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">Status</label>
                <select class="filter-select" id="statusFilter">
                    <option value="all">All Status</option>
                    <option value="completed">Completed</option>
                    <option value="pending">Pending</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="content-grid">
            <!-- Donations Table -->
            <div class="donations-table">
                <div class="table-header">
                    <h2 class="table-title">Recent Donations</h2>
                    <p class="table-subtitle">Latest donation transactions and their details</p>
                </div>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Donor</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="donationsTableBody">
                            <!-- Table content will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Chart -->
                <div class="chart-card">
                    <h3 class="chart-title">Monthly Donation Trends</h3>
                    <div class="chart-placeholder">
                        📊 Chart visualization would be integrated here
                    </div>
                </div>

                <!-- Recent Donors -->
                <div class="recent-donors">
                    <h3 class="chart-title">Top Donors</h3>
                    <div id="topDonors">
                        <!-- Top donors will be populated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample donation data - replace with actual database calls
        const sampleDonations = [{
                id: 1,
                name: 'Sarah Johnson',
                email: 'sarah@email.com',
                amount: 250,
                payment: 'card',
                date: '2025-07-24',
                status: 'completed'
            },
            {
                id: 2,
                name: 'Michael Chen',
                email: 'michael@email.com',
                amount: 100,
                payment: 'paypal',
                date: '2025-07-24',
                status: 'completed'
            },
            {
                id: 3,
                name: 'Emily Davis',
                email: 'emily@email.com',
                amount: 75,
                payment: 'kpay',
                date: '2025-07-23',
                status: 'pending'
            },
            {
                id: 4,
                name: 'David Wilson',
                email: 'david@email.com',
                amount: 500,
                payment: 'card',
                date: '2025-07-23',
                status: 'completed'
            },
            {
                id: 5,
                name: 'Lisa Anderson',
                email: 'lisa@email.com',
                amount: 125,
                payment: 'wave',
                date: '2025-07-22',
                status: 'completed'
            },
            {
                id: 6,
                name: 'James Miller',
                email: 'james@email.com',
                amount: 200,
                payment: 'card',
                date: '2025-07-22',
                status: 'failed'
            },
            {
                id: 7,
                name: 'Anna Thompson',
                email: 'anna@email.com',
                amount: 85,
                payment: 'paypal',
                date: '2025-07-21',
                status: 'completed'
            },
            {
                id: 8,
                name: 'Robert Garcia',
                email: 'robert@email.com',
                amount: 300,
                payment: 'card',
                date: '2025-07-21',
                status: 'completed'
            },
            {
                id: 9,
                name: 'Jessica White',
                email: 'jessica@email.com',
                amount: 150,
                payment: 'kpay',
                date: '2025-07-20',
                status: 'completed'
            },
            {
                id: 10,
                name: 'Christopher Lee',
                email: 'chris@email.com',
                amount: 175,
                payment: 'wave',
                date: '2025-07-20',
                status: 'completed'
            }
        ];

        let filteredDonations = [...sampleDonations];

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            updateDashboard();
            setupFilters();
        });

        function updateDashboard() {
            updateStats();
            updateTable();
            updateTopDonors();
        }

        function updateStats() {
            const total = filteredDonations.reduce((sum, d) => sum + d.amount, 0);
            const donors = new Set(filteredDonations.map(d => d.email)).size;
            const average = total / filteredDonations.length || 0;

            document.getElementById('totalDonations').textContent = `$${total.toLocaleString()}`;
            document.getElementById('totalDonors').textContent = donors.toLocaleString();
            document.getElementById('avgDonation').textContent = `$${Math.round(average)}`;
        }

        function updateTable() {
            const tbody = document.getElementById('donationsTableBody');
            tbody.innerHTML = '';

            filteredDonations.slice(0, 10).forEach(donation => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <div style="font-weight: 600;">${donation.name}</div>
                        <div style="color: var(--gray-600); font-size: 0.75rem;">${donation.email}</div>
                    </td>
                    <td><span class="donation-amount">$${donation.amount}</span></td>
                    <td><span class="payment-method payment-${donation.payment}">${getPaymentIcon(donation.payment)} ${donation.payment.toUpperCase()}</span></td>
                    <td>${formatDate(donation.date)}</td>
                    <td><span class="status status-${donation.status}">${getStatusIcon(donation.status)} ${donation.status.toUpperCase()}</span></td>
                `;
                tbody.appendChild(row);
            });
        }

        function updateTopDonors() {
            const donorTotals = {};
            filteredDonations.forEach(donation => {
                if (!donorTotals[donation.email]) {
                    donorTotals[donation.email] = {
                        name: donation.name,
                        total: 0,
                        count: 0
                    };
                }
                donorTotals[donation.email].total += donation.amount;
                donorTotals[donation.email].count++;
            });

            const topDonors = Object.values(donorTotals)
                .sort((a, b) => b.total - a.total)
                .slice(0, 5);

            const container = document.getElementById('topDonors');
            container.innerHTML = '';

            topDonors.forEach(donor => {
                const item = document.createElement('div');
                item.className = 'donor-item';
                item.innerHTML = `
                    <div class="donor-avatar">${donor.name.split(' ').map(n => n[0]).join('')}</div>
                    <div class="donor-info">
                        <div class="donor-name">${donor.name}</div>
                        <div class="donor-date">${donor.count} donation${donor.count > 1 ? 's' : ''}</div>
                    </div>
                    <div class="donor-amount">$${donor.total}</div>
                `;
                container.appendChild(item);
            });
        }

        function setupFilters() {
            const filters = ['dateFilter', 'paymentFilter', 'amountFilter', 'statusFilter'];
            filters.forEach(filterId => {
                document.getElementById(filterId).addEventListener('change', applyFilters);
            });
        }

        function applyFilters() {
            const dateFilter = document.getElementById('dateFilter').value;
            const paymentFilter = document.getElementById('paymentFilter').value;
            const amountFilter = document.getElementById('amountFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;

            filteredDonations = sampleDonations.filter(donation => {
                // Date filter
                if (dateFilter !== 'all') {
                    const donationDate = new Date(donation.date);
                    const daysDiff = Math.floor((new Date() - donationDate) / (1000 * 60 * 60 * 24));
                    if (daysDiff > parseInt(dateFilter)) return false;
                }

                // Payment filter
                if (paymentFilter !== 'all' && donation.payment !== paymentFilter) return false;

                // Amount filter
                if (amountFilter !== 'all') {
                    const [min, max] = amountFilter.split('-').map(v => v.replace('+', ''));
                    if (max) {
                        if (donation.amount < parseInt(min) || donation.amount > parseInt(max)) return false;
                    } else {
                        if (donation.amount < parseInt(min)) return false;
                    }
                }

                // Status filter
                if (statusFilter !== 'all' && donation.status !== statusFilter) return false;

                return true;
            });

            updateDashboard();
        }

        function getPaymentIcon(method) {
            const icons = {
                card: '💳',
                paypal: '🅿️',
                kpay: '🏦',
                wave: '🌊'
            };
            return icons[method] || '💳';
        }

        function getStatusIcon(status) {
            const icons = {
                completed: '✅',
                pending: '⏳',
                failed: '❌'
            };
            return icons[status] || '⏳';
        }

        function formatDate(dateStr) {
            const date = new Date(dateStr);
            return date.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
        }

        // Auto-refresh data every 30 seconds (uncomment when connected to real database)
        // setInterval(() => {
        //     // Fetch fresh data from your database
        //     // updateDashboard();
        // }, 30000);
    </script>
</body>

</html>