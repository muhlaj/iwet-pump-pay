<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IWET LTD - Farmer Support Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #1a5276;
            --secondary: #117a65;
            --accent: #d4af37;
            --light: #f8f9fa;
            --dark: #2c3e50;
            --success: #28a745;
            --info: #17a2b8;
            --warning: #ffc107;
            --danger: #dc3545;
        }
        
        * {
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        /* Login Page */
        .login-container {
            background: linear-gradient(135deg, var(--primary) 0%, #0e3a52 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
        }
        
        .login-header {
            background-color: var(--primary);
            color: white;
            padding: 25px 20px;
            text-align: center;
        }
        
        .login-body {
            padding: 25px 20px;
        }
        
        .partner-logos {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        
        .partner-logo {
            height: 35px;
            filter: grayscale(100%);
            opacity: 0.7;
            transition: all 0.3s;
        }
        
        /* Main App Layout */
        #app-container {
            display: none;
        }
        
        /* Desktop Header - FIXED POSITIONING */
        .desktop-header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 280px; /* Match sidebar width */
            right: 0;
            height: 70px;
            z-index: 999; /* Lower than sidebar but above content */
        }
        
        .desktop-logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .logo-img {
            height: 40px;
        }
        
        .logo-text {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.2rem;
        }
        
        .desktop-user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .desktop-logout-btn {
            background: none;
            border: none;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        
        .desktop-logout-btn:hover {
            background-color: #f8f9fa;
        }
        
        /* Mobile Header */
        .mobile-header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }
        
        .mobile-menu-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary);
            padding: 5px 10px;
        }
        
        .mobile-logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .mobile-logo-img {
            height: 30px;
        }
        
        .mobile-logo-text {
            font-weight: 700;
            color: var(--primary);
            font-size: 1rem;
        }
        
        .user-dropdown {
            position: relative;
        }
        
        .user-dropdown-btn {
            background: none;
            border: none;
            display: flex;
            align-items: center;
            color: var(--dark);
            font-weight: 500;
        }
        
        .user-dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
            min-width: 180px;
            display: none;
            z-index: 1000;
        }
        
        .user-dropdown-menu.active {
            display: block;
        }
        
        .user-dropdown-item {
            display: block;
            padding: 8px 20px;
            color: var(--dark);
            text-decoration: none;
            transition: background-color 0.2s;
        }
        
        .user-dropdown-item:hover {
            background-color: #f8f9fa;
        }
        
        /* Sidebar */
        .sidebar {
            background: linear-gradient(180deg, var(--primary) 0%, #0e3a52 100%);
            color: white;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            transition: all 0.3s;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000; /* Higher than desktop header */
            overflow-y: auto;
        }
        
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: none;
        }
        
        .sidebar-overlay.active {
            display: block;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 5px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }
        
        .sidebar-logo {
            padding: 20px 15px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background-color: rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-logo-img {
            height: 40px;
            margin-bottom: 10px;
        }
        
        .sidebar-logo-text {
            font-size: 1rem;
            font-weight: 600;
            color: white;
            line-height: 1.2;
        }
        
        /* Main Content - ADJUSTED FOR FIXED HEADER */
        .main-content {
            padding: 90px 20px 20px 300px; /* Adjusted for desktop header height and sidebar */
            width: 100%;
            transition: all 0.3s;
            min-height: 100vh;
        }
        
        /* Cards and UI Elements */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid #eaeaea;
            font-weight: 600;
            padding: 15px;
            border-radius: 10px 10px 0 0 !important;
        }
        
        .stat-card {
            text-align: center;
            padding: 15px;
        }
        
        .stat-card .value {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 10px 0;
        }
        
        .stat-card .label {
            color: #6c757d;
            font-size: 0.85rem;
        }
        
        .bg-primary-light {
            background-color: rgba(26, 82, 118, 0.1);
        }
        
        .bg-secondary-light {
            background-color: rgba(17, 122, 101, 0.1);
        }
        
        .bg-accent-light {
            background-color: rgba(212, 175, 55, 0.1);
        }
        
        .bg-success-light {
            background-color: rgba(40, 167, 69, 0.1);
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-secondary {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }
        
        .btn-accent {
            background-color: var(--accent);
            border-color: var(--accent);
            color: white;
        }
        
        .table th {
            border-top: none;
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
        }
        
        .table td {
            font-size: 0.85rem;
        }
        
        .badge-primary {
            background-color: var(--primary);
        }
        
        .badge-secondary {
            background-color: var(--secondary);
        }
        
        .form-control {
            border-radius: 5px;
            padding: 12px 15px;
            border: 1px solid #e1e5eb;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(26, 82, 118, 0.25);
        }
        
        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }
        
        .payment-method {
            border: 1px solid #e1e5eb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .payment-method:hover {
            border-color: var(--primary);
            background-color: rgba(26, 82, 118, 0.05);
        }
        
        .payment-method.selected {
            border-color: var(--primary);
            background-color: rgba(26, 82, 118, 0.1);
        }
        
        .payment-icon {
            font-size: 1.5rem;
            color: var(--primary);
            margin-right: 15px;
        }
        
        .page-title {
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        /* Responsive adjustments */
        @media (min-width: 768px) {
            .sidebar-overlay {
                display: none !important;
            }
            
            .mobile-header {
                display: none;
            }
            
            .main-content {
                padding: 90px 20px 20px 300px;
            }
            
            .stat-card .value {
                font-size: 2rem;
            }
            
            .table td {
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 767px) {
            .desktop-header {
                display: none;
            }
            
            .mobile-header {
                display: flex;
            }
            
            .sidebar {
                left: -280px;
                padding-top: 70px;
            }
            
            .sidebar.active {
                left: 0;
            }
            
            .main-content {
                padding: 80px 15px 20px;
            }
        }
        
        @media (max-width: 576px) {
            .login-header {
                padding: 20px 15px;
            }
            
            .login-body {
                padding: 20px 15px;
            }
            
            .partner-logo {
                height: 30px;
            }
            
            .page-title {
                font-size: 1.3rem;
            }
            
            .chart-container {
                height: 200px;
            }
        }
        
        /* Ensure tables are scrollable on mobile */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        /* Improve button sizing on mobile */
        .btn {
            padding: 10px 15px;
            font-size: 0.9rem;
        }
        
        /* Improve form elements on mobile */
        .form-control {
            font-size: 16px; /* Prevents zoom on iOS */
        }
    </style>
</head>
<body>
    <!-- Login Page -->
    <div id="login-page" class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-placeholder" style="color: white; font-size: 2rem; margin-bottom: 10px;">
<!--                     <i class="fas fa-tint"></i>
                    <i class="fas fa-bolt"></i> -->
                    <img src="logo IWET.jpg">
                </div>
                <h3>INTEGRATED</h3>
                <p class="mb-0">WATER AND ENERGY TECHNOLOGIES LIMITED COMPANY</p>
            </div>
            <div class="login-body">
                <form id="login-form">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter your username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Login As</label>
                        <select class="form-control" id="role">
                            <option value="farmer">Farmer</option>
                            <option value="manager">Manager</option>
                            <option value="user">User</option>
                            <option value="partner">Partner (GIZ/Standard Bank)</option>
                        </select>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                <div class="partner-logos">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7d/GIZ_Logo.svg/1200px-GIZ_Logo.svg.png" alt="GIZ" class="partner-logo">
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/3/30/Standard_Bank_Group.svg/1200px-Standard_Bank_Group.svg.png" alt="Standard Bank" class="partner-logo">
                </div>
            </div>
        </div>
    </div>

    <!-- Main Application (initially hidden) -->
    <div id="app-container" style="display: none;">
        <!-- Desktop Header - NOW PROPERLY POSITIONED -->
        <div class="desktop-header">
            <div class="desktop-logo">
                <div class="logo-img-placeholder" style="color: var(--primary); font-size: 1.8rem;">
                    <!-- i class="fas fa-tint"></i>
                    <i class="fas fa-bolt"></i> -->
                    <img src="logo IWET.jpg" width="60" height="60">
                </div>
                <div class="logo-text">IWET Pump, Pay</div>
            </div>
            <div class="desktop-user-menu">
                <span id="current-user">John Farmer</span>
                <button class="desktop-logout-btn" id="desktop-logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </div>
        </div>

        <!-- Mobile Header -->
        <div class="mobile-header">
            <button class="mobile-menu-btn" id="mobile-menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="mobile-logo">
                <div class="mobile-logo-img-placeholder" style="color: var(--primary); font-size: 1.5rem;">
                    <!-- <i class="fas fa-tint"></i>
                    <i class="fas fa-bolt"></i> -->
                    <img src="logo IWET.jpg" width="60" height="60">
                </div>
                <div class="mobile-logo-text">IWET Pump, Pay</div>
            </div>
            <div class="user-dropdown">
                <button class="user-dropdown-btn" id="user-dropdown-toggle">
                    <i class="fas fa-user-circle"></i>
                </button>
                <div class="user-dropdown-menu" id="user-dropdown-menu">
                    <a class="user-dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a>
                    <a class="user-dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="user-dropdown-item" href="#" id="mobile-logout-btn"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                </div>
            </div>
        </div>

        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebar-overlay"></div>

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <!-- <div class="sidebar-logo">
                <div class="sidebar-logo-img-placeholder" style="color: white; font-size: 2rem;">
                     <i class="fas fa-tint"></i>
                    <i class="fas fa-bolt"></i> 
                </div>
                <div class="sidebar-logo-text">INTEGRATED<br>WATER AND ENERGY<br>TECHNOLOGIES</div>
            </div> -->
            <ul class="nav flex-column mt-3">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-page="dashboard">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item farmer-only manager-only user-only">
                    <a class="nav-link" href="#" data-page="loan-balance">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>Loan Balance</span>
                    </a>
                </li>
                <li class="nav-item farmer-only">
                    <a class="nav-link" href="#" data-page="messages">
                        <i class="fas fa-envelope"></i>
                        <span>Messages</span>
                    </a>
                </li>
                <li class="nav-item farmer-only manager-only user-only">
                    <a class="nav-link" href="#" data-page="payment-history">
                        <i class="fas fa-history"></i>
                        <span>Payment History</span>
                    </a>
                </li>
                <li class="nav-item farmer-only">
                    <a class="nav-link" href="#" data-page="make-payment">
                        <i class="fas fa-credit-card"></i>
                        <span>Make Payment</span>
                    </a>
                </li>
                <li class="nav-item manager-only user-only">
                    <a class="nav-link" href="#" data-page="farmers">
                        <i class="fas fa-users"></i>
                        <span>Farmers</span>
                    </a>
                </li>
                <li class="nav-item manager-only">
                    <a class="nav-link" href="#" data-page="partners">
                        <i class="fas fa-handshake"></i>
                        <span>Partners</span>
                    </a>
                </li>
                <li class="nav-item manager-only partner-only">
                    <a class="nav-link" href="#" data-page="reports">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reports</span>
                    </a>
                </li>
                <li class="nav-item manager-only">
                    <a class="nav-link" href="#" data-page="settings">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content - NOW PROPERLY ALIGNED -->
        <div class="main-content" id="main-content">
            <!-- Page Content -->
            <div id="page-content">
                <!-- Dashboard Page -->
                <div class="page" id="dashboard-page">
                    <h3 class="page-title">Dashboard</h3>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="btn-group w-100">
                            <button class="btn btn-outline-primary active flex-fill">Today</button>
                            <button class="btn btn-outline-primary flex-fill">Week</button>
                            <button class="btn btn-outline-primary flex-fill">Month</button>
                            <button class="btn btn-outline-primary flex-fill">Year</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 col-md-3">
                            <div class="card stat-card bg-primary-light">
                                <div class="card-body">
                                    <i class="fas fa-users fa-2x text-primary"></i>
                                    <div class="value text-primary" id="total-farmers">1,000</div>
                                    <div class="label">Total Farmers</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card stat-card bg-secondary-light">
                                <div class="card-body">
                                    <i class="fas fa-money-bill-wave fa-2x text-secondary"></i>
                                    <div class="value text-secondary" id="total-loans">MWK56.7M</div>
                                    <div class="label">Total Loans</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card stat-card bg-accent-light">
                                <div class="card-body">
                                    <i class="fas fa-handshake fa-2x" style="color: var(--accent);"></i>
                                    <div class="value" style="color: var(--accent);" id="active-partners">2</div>
                                    <div class="label">Active Partners</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card stat-card bg-success-light">
                                <div class="card-body">
                                    <i class="fas fa-chart-line fa-2x text-success"></i>
                                    <div class="value text-success" id="repayment-rate">77%</div>
                                    <div class="label">Repayment Rate</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    Loan Distribution by Region
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="regionChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                            <div class="card">
                                <div class="card-header">
                                    Partner Funding Distribution
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="partnerChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 col-lg-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <span>Recent Farmers</span>
                                    <a href="#" class="btn btn-sm btn-primary">View All</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Region</th>
                                                    <th>Loan Amount</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>John Farmer</td>
                                                    <td>Eastern</td>
                                                    <td>MWK300,000</td>
                                                    <td><span class="badge bg-success">Active</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Mary Agric</td>
                                                    <td>Western</td>
                                                    <td>MWK30,500</td>
                                                    <td><span class="badge bg-success">Active</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Robert Grower</td>
                                                    <td>Northern</td>
                                                    <td>MWK75,200</td>
                                                    <td><span class="badge bg-warning">Pending</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Sarah Planter</td>
                                                    <td>Southern</td>
                                                    <td>MWK45,800</td>
                                                    <td><span class="badge bg-success">Active</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-4 mt-lg-0">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <span>Recent Payments</span>
                                    <a href="#" class="btn btn-sm btn-primary">View All</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Farmer</th>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th>Method</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>John Farmer</td>
                                                    <td>12 May 2023</td>
                                                    <td>MWK25,000</td>
                                                    <td>Bank Transfer</td>
                                                </tr>
                                                <tr>
                                                    <td>Mary Agric</td>
                                                    <td>11 May 2023</td>
                                                    <td>MWK180,000</td>
                                                    <td>Mobile Money</td>
                                                </tr>
                                                <tr>
                                                    <td>Robert Grower</td>
                                                    <td>10 May 2023</td>
                                                    <td>MWK150,000</td>
                                                    <td>Bank Transfer</td>
                                                </tr>
                                                <tr>
                                                    <td>Sarah Planter</td>
                                                    <td>9 May 2023</td>
                                                    <td>MWK67,000</td>
                                                    <td>Cash</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Make Payment Page -->
                <div class="page" id="make-payment-page" style="display: none;">
                    <h3 class="page-title">Make a Payment</h3>
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Payment Method</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        <div class="payment-method" data-method="bank">
                                            <div class="d-flex align-items-center">
                                                <div class="payment-icon">
                                                    <i class="fas fa-university"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Bank Transfer</h6>
                                                    <p class="mb-0 text-muted">Transfer directly from your bank account</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="payment-method" data-method="mobile">
                                            <div class="d-flex align-items-center">
                                                <div class="payment-icon">
                                                    <i class="fas fa-mobile-alt"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Mobile Money</h6>
                                                    <p class="mb-0 text-muted">Pay using your mobile money account</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="payment-method" data-method="card">
                                            <div class="d-flex align-items-center">
                                                <div class="payment-icon">
                                                    <i class="fas fa-credit-card"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Credit/Debit Card</h6>
                                                    <p class="mb-0 text-muted">Pay with Visa, Mastercard or other cards</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="payment-method" data-method="cash">
                                            <div class="d-flex align-items-center">
                                                <div class="payment-icon">
                                                    <i class="fas fa-money-bill-wave"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Cash Payment</h6>
                                                    <p class="mb-0 text-muted">Pay in cash at designated locations</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="payment-form">
                                        <h5 class="mb-3">Payment Details</h5>
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="amount" class="form-label">Amount (MWK)</label>
                                                    <input type="number" class="form-control" id="amount" placeholder="Enter amount">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="payment-date" class="form-label">Payment Date</label>
                                                    <input type="date" class="form-control" id="payment-date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="reference" class="form-label">Reference (Optional)</label>
                                            <input type="text" class="form-control" id="reference" placeholder="Enter payment reference">
                                        </div>
                                        <div class="d-grid">
                                            <button class="btn btn-primary" id="submit-payment">Submit Payment</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Payment Summary</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>Current Loan Balance:</strong>
                                        <div class="h4 text-primary">MWK24,500.00</div>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Next Payment Due:</strong>
                                        <div>May 30, 2023</div>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Minimum Payment:</strong>
                                        <div>MWK18,000.00</div>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <strong>Selected Amount:</strong>
                                        <div id="selected-amount">MWK0.00</div>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Payment Method:</strong>
                                        <div id="selected-method">None selected</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Other pages would be implemented similarly -->
                <div class="page" id="loan-balance-page" style="display: none;">
                    <h3 class="page-title">Loan Balance</h3>
                    <!-- Loan balance content -->
                </div>

                <div class="page" id="messages-page" style="display: none;">
                    <h3 class="page-title">Messages</h3>
                    <!-- Messages content -->
                </div>

                <div class="page" id="payment-history-page" style="display: none;">
                    <h3 class="page-title">Payment History</h3>
                    <!-- Payment history content -->
                </div>

                <div class="page" id="farmers-page" style="display: none;">
                    <h3 class="page-title">Farmers Management</h3>
                    <!-- Farmers management content -->
                </div>

                <div class="page" id="partners-page" style="display: none;">
                    <h3 class="page-title">Partners</h3>
                    <!-- Partners content -->
                </div>

                <div class="page" id="reports-page" style="display: none;">
                    <h3 class="page-title">Reports & Analytics</h3>
                    <!-- Reports content -->
                </div>

                <div class="page" id="settings-page" style="display: none;">
                    <h3 class="page-title">Settings</h3>
                    <!-- Settings content -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sample data for charts
        const regionData = {
            labels: ['Eastern', 'Northern', 'Southern', 'Central'],
            datasets: [{
                label: 'Loan Amount (MWK)',
                data: [1200000, 800000, 600000, 400000],
                backgroundColor: [
                    'rgba(26, 82, 118, 0.7)',
                    'rgba(212, 175, 55, 0.7)',
                    'rgba(40, 167, 69, 0.7)',
                    'rgba(108, 117, 125, 0.7)'
                ],
                borderColor: [
                    'rgba(26, 82, 118, 1)',
                    'rgba(212, 175, 55, 1)',
                    'rgba(40, 167, 69, 1)',
                    'rgba(108, 117, 125, 1)'
                ],
                borderWidth: 1
            }]
        };

        const partnerData = {
            labels: ['GIZ', 'Standard Bank'],
            datasets: [{
                data: [60, 30],
                backgroundColor: [
                    'rgb(177, 53, 35)',
                    'rgb(17, 53, 132)'
                ],
                borderColor: [
                    'rgb(177, 53, 35)',
                    'rgb(17, 53, 132)'
                ],
                borderWidth: 1
            }]
        };

        // Initialize charts when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Region Chart
            const regionCtx = document.getElementById('regionChart').getContext('2d');
            const regionChart = new Chart(regionCtx, {
                type: 'bar',
                data: regionData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'MWK' + (value / 1000) + 'K';
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Partner Chart
            const partnerCtx = document.getElementById('partnerChart').getContext('2d');
            const partnerChart = new Chart(partnerCtx, {
                type: 'doughnut',
                data: partnerData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Login form handler
            document.getElementById('login-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const username = document.getElementById('username').value;
                const role = document.getElementById('role').value;
                
                // Hide login page and show main app
                document.getElementById('login-page').style.display = 'none';
                document.getElementById('app-container').style.display = 'block';
                
                // Update user display
                document.getElementById('current-user').textContent = username;
                
                // Set user role and update UI accordingly
                setUserRole(role);
                
                // Show dashboard by default
                showPage('dashboard');
            });

            // Logout handlers
            document.getElementById('desktop-logout-btn').addEventListener('click', function() {
                document.getElementById('app-container').style.display = 'none';
                document.getElementById('login-page').style.display = 'flex';
            });

            document.getElementById('mobile-logout-btn').addEventListener('click', function() {
                document.getElementById('app-container').style.display = 'none';
                document.getElementById('login-page').style.display = 'flex';
            });

            // Mobile menu toggle
            document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
                document.getElementById('sidebar').classList.add('active');
                document.getElementById('sidebar-overlay').classList.add('active');
            });

            // Sidebar overlay click to close sidebar
            document.getElementById('sidebar-overlay').addEventListener('click', function() {
                document.getElementById('sidebar').classList.remove('active');
                this.classList.remove('active');
            });

            // User dropdown toggle
            document.getElementById('user-dropdown-toggle').addEventListener('click', function() {
                document.getElementById('user-dropdown-menu').classList.toggle('active');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.user-dropdown')) {
                    document.getElementById('user-dropdown-menu').classList.remove('active');
                }
            });

            // Page navigation
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const page = this.getAttribute('data-page');
                    showPage(page);
                    
                    // Update active nav link
                    document.querySelectorAll('.nav-link').forEach(item => {
                        item.classList.remove('active');
                    });
                    this.classList.add('active');
                    
                    // Close sidebar on mobile after navigation
                    if (window.innerWidth < 768) {
                        document.getElementById('sidebar').classList.remove('active');
                        document.getElementById('sidebar-overlay').classList.remove('active');
                    }
                });
            });

            // Payment method selection
            document.querySelectorAll('.payment-method').forEach(method => {
                method.addEventListener('click', function() {
                    document.querySelectorAll('.payment-method').forEach(m => {
                        m.classList.remove('selected');
                    });
                    this.classList.add('selected');
                    
                    const methodName = this.getAttribute('data-method');
                    let displayName = '';
                    
                    switch(methodName) {
                        case 'bank':
                            displayName = 'Bank Transfer';
                            break;
                        case 'mobile':
                            displayName = 'Mobile Money';
                            break;
                        case 'card':
                            displayName = 'Credit/Debit Card';
                            break;
                        case 'cash':
                            displayName = 'Cash Payment';
                            break;
                    }
                    
                    document.getElementById('selected-method').textContent = displayName;
                });
            });

            // Amount input update
            document.getElementById('amount').addEventListener('input', function() {
                const amount = this.value ? 'MWK' + parseFloat(this.value).toFixed(2) : 'MWK0.00';
                document.getElementById('selected-amount').textContent = amount;
            });

            // Submit payment
            document.getElementById('submit-payment').addEventListener('click', function() {
                const amount = document.getElementById('amount').value;
                const method = document.querySelector('.payment-method.selected');
                
                if (!amount || amount <= 0) {
                    alert('Please enter a valid payment amount');
                    return;
                }
                
                if (!method) {
                    alert('Please select a payment method');
                    return;
                }
                
                alert(`Payment of $${amount} submitted successfully!`);
                // In a real application, you would submit the payment data to the server here
            });
        });

        function setUserRole(role) {
            // Hide all role-specific elements first
            document.querySelectorAll('.farmer-only, .manager-only, .user-only, .partner-only').forEach(el => {
                el.style.display = 'none';
            });
            
            // Show elements based on role
            if (role === 'farmer') {
                document.querySelectorAll('.farmer-only').forEach(el => {
                    el.style.display = 'block';
                });
            } else if (role === 'manager') {
                document.querySelectorAll('.manager-only').forEach(el => {
                    el.style.display = 'block';
                });
            } else if (role === 'user') {
                document.querySelectorAll('.user-only').forEach(el => {
                    el.style.display = 'block';
                });
            } else if (role === 'partner') {
                document.querySelectorAll('.partner-only').forEach(el => {
                    el.style.display = 'block';
                });
            }
        }

        function showPage(pageId) {
            // Hide all pages
            document.querySelectorAll('.page').forEach(page => {
                page.style.display = 'none';
            });
            
            // Show the selected page
            document.getElementById(`${pageId}-page`).style.display = 'block';
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                document.getElementById('sidebar').classList.remove('active');
                document.getElementById('sidebar-overlay').classList.remove('active');
            }
        });
    </script>
</body>
</html>