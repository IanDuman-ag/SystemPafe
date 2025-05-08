<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Sidebar</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #212529;
            color: white;
            transition: all 0.3s;
            width: 250px;
        }
        
        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .sidebar.collapsed .sidebar-header h3 {
            display: none;
        }

        .sidebar.collapsed .nav-link {
            text-align: center;
            padding: 0.8rem 0;
        }

        .sidebar.collapsed .nav-link i {
            margin: 0;
            font-size: 1.2rem;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.8rem 1rem;
            margin: 0.2rem 0;
            border-radius: 0.3rem;
            display: flex;
            align-items: center;
        }
        
        .sidebar .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: white;
        }
        
        .sidebar .nav-link i {
            margin-right: 0.5rem;
            font-size: 1.1rem;
        }

        .sidebar-toggle {
            position: absolute;
            right: -12px;
            top: 20px;
            background: #0d6efd;
            border: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            z-index: 1000;
        }

        .sidebar-toggle:hover {
            background: #0b5ed7;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
            }
            .sidebar.active {
                margin-left: 0;
            }
            .sidebar.collapsed {
                margin-left: -70px;
            }
        }

        /* Header Styles */
        .header {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .header .notifications {
            position: relative;
        }

        .header .notifications .badge {
            position: absolute;
            top: -5px;
            right: -5px;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding-left: 2.5rem;
            border-radius: 20px;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        /* Logo Styles */
        .logo-container {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: inherit;
        }

        .logo-container img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 600;
            color: #0d6efd;
            margin: 0;
        }

        .logo-text span {
            color: #212529;
        }

        /* Main content adjustment */
        .main-content {
            transition: all 0.3s;
            margin-left: 250px;
            width: calc(100% - 250px);
        }

        .main-content.expanded {
            margin-left: 70px;
            width: calc(100% - 70px);
        }

        @media (max-width: 768px) {
            .main-content,
            .main-content.expanded {
                margin-left: 0;
                width: 100%;
            }
        }

        /* Modern Calendar Styles */
        .calendar-container {
            background: white;
            border-radius: 16px;
            padding: 1.5rem 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .calendar-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            font-weight: 600;
            color: #b0b0b0;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.5rem;
        }
        .calendar-day {
            min-height: 80px;
            background: #faf9f6;
            border-radius: 12px;
            padding: 0.5rem 0.3rem 0.3rem 0.3rem;
            position: relative;
            font-size: 1rem;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            transition: background 0.2s;
            overflow: visible;
        }
        .calendar-day.today {
            border: 2px solid #0d6efd;
            background: #e7f1ff;
        }
        .calendar-day.other-month {
            background: transparent;
            color: #e0e0e0;
        }
        .calendar-day .day-number {
            font-weight: 600;
            margin-bottom: 0.2rem;
            font-size: 1rem;
        }
        .calendar-event-card {
            display: flex;
            flex-direction: column;
            background: #f3f3f3;
            border-radius: 8px;
            padding: 0.3rem 0.5rem;
            margin-bottom: 0.2rem;
            font-size: 0.92rem;
            box-shadow: 0 1px 2px rgba(0,0,0,0.03);
            border-left: 4px solid #0d6efd;
            width: 100%;
            min-width: 0;
            word-break: break-word;
        }
        .calendar-event-card .event-title {
            font-weight: 600;
            font-size: 0.98rem;
            margin-bottom: 0.1rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        .calendar-event-card .event-desc {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 0.1rem;
        }
        .calendar-event-card .event-time {
            font-size: 0.8rem;
            color: #999;
        }
        /* Colorful event types */
        .calendar-event-card.event-instagram { border-left-color: #8a3ab9; background: #f6f0fa; }
        .calendar-event-card.event-youtube { border-left-color: #ff0000; background: #fff0f0; }
        .calendar-event-card.event-blog { border-left-color: #0d6efd; background: #e7f1ff; }
        .calendar-event-card.event-linkedin { border-left-color: #0077b5; background: #eaf6fb; }
        .calendar-event-card.event-newsletter { border-left-color: #e14d2a; background: #fff3f0; }
        /* Default color for other events */
        .calendar-event-card.event-default { border-left-color: #0d6efd; background: #f3f8ff; }

        @media (max-width: 768px) {
            .calendar-container { padding: 1rem 0.2rem; }
            .calendar-day { min-height: 60px; font-size: 0.95rem; }
            .calendar-event-card { font-size: 0.85rem; }
        }
        @media (max-width: 576px) {
            .calendar-container { padding: 0.5rem 0; }
            .calendar-day { min-height: 48px; font-size: 0.9rem; }
            .calendar-event-card { font-size: 0.8rem; }
        }

        /* Event Styles */
        .event-date {
            background-color: #f8f9fa;
            padding: 8px;
            border-radius: 8px;
            min-width: 50px;
        }

        .event-date .date-day {
            font-size: 1.2rem;
            font-weight: bold;
            color: #0d6efd;
        }

        .event-date .date-month {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .event-item {
            padding: 10px;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .event-item:hover {
            background-color: #f8f9fa;
        }

        /* Event Form Styles */
        .event-item {
            transition: all 0.2s;
        }

        .event-item:hover {
            background-color: #f8f9fa;
        }

        .event-actions {
            opacity: 0;
            transition: opacity 0.2s;
        }

        .event-item:hover .event-actions {
            opacity: 1;
        }

        .stat-item {
            padding: 10px;
            border-radius: 8px;
            background-color: #f8f9fa;
        }

        .stat-item:hover {
            background-color: #e9ecef;
        }

        /* Notification Styles */
        .notification-dropdown {
            width: 300px;
            padding: 0;
        }

        .notification-dropdown .dropdown-header {
            background-color: #f8f9fa;
            padding: 10px 15px;
        }

        .notification-item {
            padding: 10px 15px;
            border-bottom: 1px solid #dee2e6;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .notification-item:hover {
            background-color: #f8f9fa;
        }

        .notification-item .notification-title {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .notification-item .notification-time {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .notification-item.unread {
            background-color: #e7f1ff;
        }

        .notification-item.unread:hover {
            background-color: #d8e7ff;
        }

        @keyframes bellShake {
            0% { transform: rotate(0); }
            15% { transform: rotate(5deg); }
            30% { transform: rotate(-5deg); }
            45% { transform: rotate(4deg); }
            60% { transform: rotate(-4deg); }
            75% { transform: rotate(2deg); }
            85% { transform: rotate(-2deg); }
            92% { transform: rotate(1deg); }
            100% { transform: rotate(0); }
        }

        .bell-shake {
            animation: bellShake 0.5s ease-in-out;
        }

        /* Event Dropdown Styles */
        .nav-item.dropdown .nav-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-item.dropdown .nav-link::after {
            margin-left: auto;
        }

        #eventSubmenu {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 0.3rem;
            margin: 0.2rem 0;
        }

        #eventSubmenu .nav-link {
            padding-left: 2.5rem;
            font-size: 0.9rem;
        }

        #eventSubmenu .nav-link i {
            font-size: 0.9rem;
        }

        .sidebar.collapsed #eventSubmenu {
            position: absolute;
            left: 100%;
            top: 0;
            width: 200px;
            background-color: #212529;
            border-radius: 0.3rem;
            margin-left: 0.5rem;
            display: none;
        }

        .sidebar.collapsed .nav-item.dropdown:hover #eventSubmenu {
            display: block;
        }

        /* Responsive Styles */
        @media (max-width: 1200px) {
            .main-content {
                margin-left: 70px;
            }
            
            .sidebar {
                width: 70px;
            }
            
            .sidebar .nav-link span {
                display: none;
            }
            
            .sidebar .sidebar-header h3 {
                display: none;
            }
            
            .sidebar .nav-link {
                text-align: center;
                padding: 0.8rem 0;
            }
            
            .sidebar .nav-link i {
                margin: 0;
                font-size: 1.2rem;
            }
        }

        @media (max-width: 992px) {
            .header .search-box {
                max-width: 200px;
            }
            
            .event-date {
                min-width: 40px;
            }
            
            .event-date .date-day {
                font-size: 1rem;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -250px;
                z-index: 1040;
                height: 100vh;
                transition: left 0.3s ease;
            }
            
            .sidebar.active {
                left: 0;
            }
            
            .main-content {
                margin-left: 0 !important;
                width: 100%;
            }
            
            .header {
                padding: 0.5rem;
            }
            
            .header .search-box {
                display: none;
            }
            
            .header .user-profile .text-end {
                display: none;
            }
            
            .notification-dropdown {
                width: 280px;
            }
            
            .calendar-container {
                margin-bottom: 1rem;
            }
            
            .event-item {
                flex-direction: column;
                text-align: center;
            }
            
            .event-date {
                margin-bottom: 0.5rem;
            }
            
            .table-responsive {
                margin: 0 -0.5rem;
            }
            
            .table th, .table td {
                white-space: nowrap;
            }
            
            .btn-sm {
                padding: 0.25rem 0.4rem;
            }
        }

        @media (max-width: 576px) {
            .header {
                flex-wrap: wrap;
            }
            
            .header > div {
                width: 100%;
                justify-content: space-between;
                margin-bottom: 0.5rem;
            }
            
            .notification-dropdown {
                width: 100%;
                max-width: 280px;
            }
            
            .card-body {
                padding: 1rem;
            }
            
            .form-group {
                margin-bottom: 0.75rem;
            }
            
            .btn-group-sm > .btn, .btn-sm {
                padding: 0.25rem 0.4rem;
                font-size: 0.75rem;
            }
            
            .calendar-weekdays {
                font-size: 0.8rem;
            }
            
            .calendar-day {
                font-size: 0.9rem;
            }
        }

        /* Responsive Table Styles */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table th, .table td {
            min-width: 120px;
        }

        .table td:last-child {
            min-width: 100px;
        }

        /* Responsive Form Styles */
        .form-control {
            max-width: 100%;
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }
            
            .form-row > div {
                width: 100%;
                margin-bottom: 1rem;
            }
        }

        /* Responsive Calendar Styles */
        .calendar-container {
            overflow-x: auto;
        }

        .calendar-weekdays, .calendar-days {
            min-width: 100%;
        }

        @media (max-width: 576px) {
            .calendar-weekdays div, .calendar-day {
                padding: 0.25rem;
                font-size: 0.8rem;
            }
        }

        /* Responsive Event Form */
        @media (max-width: 768px) {
            #eventForm .row {
                margin: 0;
            }
            
            #eventForm .col-md-6 {
                padding: 0;
                margin-bottom: 1rem;
            }
            
            #eventForm .d-flex {
                flex-direction: column;
            }
            
            #eventForm .btn {
                width: 100%;
                margin: 0.25rem 0;
            }
        }

        /* Responsive Notification Styles */
        @media (max-width: 576px) {
            .notification-item {
                padding: 0.75rem;
            }
            
            .notification-title {
                font-size: 0.9rem;
            }
            
            .notification-message {
                font-size: 0.8rem;
            }
        }

        /* Responsive Logo Styles */
        @media (max-width: 768px) {
            .logo-text {
                font-size: 1.2rem;
            }
            
            .logo-container img {
                width: 30px;
                height: 30px;
            }
        }

        /* Responsive Button Styles */
        @media (max-width: 576px) {
            .btn {
                padding: 0.375rem 0.75rem;
                font-size: 0.875rem;
            }
            
            .btn-group-sm > .btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }
        }

        /* Responsive Card Styles */
        @media (max-width: 768px) {
            .card {
                margin-bottom: 1rem;
            }
            
            .card-body {
                padding: 1rem;
            }
            
            .card-title {
                font-size: 1.1rem;
                margin-bottom: 1rem;
            }
        }

        /* Responsive Navigation Styles */
        @media (max-width: 768px) {
            .nav-link {
                padding: 0.5rem 0.75rem;
            }
            
            .nav-link i {
                font-size: 1rem;
            }
        }

        /* Responsive Modal Styles */
        @media (max-width: 576px) {
            .modal-dialog {
                margin: 0.5rem;
            }
            
            .modal-body {
                padding: 1rem;
            }
        }

        /* Responsive Utility Classes */
        .d-flex-responsive {
            display: flex;
        }

        @media (max-width: 768px) {
            .d-flex-responsive {
                flex-direction: column;
            }
            
            .d-flex-responsive > * {
                margin-bottom: 0.5rem;
            }
        }

        /* Card Styles for Stats */
        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card .fs-1 {
            opacity: 0.8;
        }

        .card .card-title {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card h2 {
            font-size: 2rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .card h2 {
                font-size: 1.5rem;
            }
            
            .card .fs-1 {
                font-size: 2rem !important;
            }
        }

        .status-badge {
            display: inline-block;
            padding: 0.2em 0.7em;
            border-radius: 1em;
            font-size: 0.8em;
            font-weight: 600;
            color: #fff;
            margin-right: 0.3em;
        }
        .status-upcoming { background: #0d6efd; }
        .status-completed { background: #198754; }
        .status-canceled { background: #dc3545; }
        @media (max-width: 768px) {
            .pagination { flex-wrap: wrap; }
            .status-badge { font-size: 0.7em; }
        }

        .table th, .table td {
            padding: 0.4rem 0.6rem;
            font-size: 0.95rem;
        }
        .table th {
            background: #f8f9fa;
        }
        @media (max-width: 768px) {
            .mb-3.d-flex.align-items-center.justify-content-between.flex-wrap.gap-2 {
                flex-direction: column;
                align-items: stretch;
            }
            .mb-3.d-flex.align-items-center.justify-content-between.flex-wrap.gap-2 > div {
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 position-fixed sidebar" id="sidebar">
                <button class="sidebar-toggle" id="sidebarToggleBtn">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <div class="p-3">
                    <div class="sidebar-header">
                        <h3 class="text-center mb-4">Dashboard</h3>
                    </div>
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="#">
                            <i class="bi bi-house-door"></i>
                            <span>Home</span>
                        </a>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="collapse" data-bs-target="#eventSubmenu" aria-expanded="false">
                                <i class="bi bi-calendar-event"></i>
                                <span>Event</span>
                            </a>
                            <div class="collapse" id="eventSubmenu">
                                <div class="nav flex-column ms-3">
                                    <a class="nav-link" href="#" id="createEventLink">
                                        <i class="bi bi-plus-circle"></i>
                                        <span>Create Event</span>
                                    </a>
                                    <a class="nav-link" href="#" id="viewEventLink">
                                        <i class="bi bi-eye"></i>
                                        <span>View Event</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a class="nav-link" href="#">
                            <i class="bi bi-person-check"></i>
                            <span>Attendance</span>
                        </a>
                        <a class="nav-link" href="#">
                            <i class="bi bi-chat-dots"></i>
                            <span>Feedback</span>
                        </a>
                        <a class="nav-link" href="#">
                            <i class="bi bi-people"></i>
                            <span>Users</span>
                        </a>
                        <a class="nav-link" href="#">
                            <i class="bi bi-file-earmark-text"></i>
                            <span>Generate Report</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 ms-auto px-0 main-content" id="mainContent">
                <!-- Header -->
                <header class="header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-4">
                            <button class="btn btn-primary d-md-none" id="mobileSidebarToggle">
                                <i class="bi bi-list"></i>
                            </button>
                            <a href="#" class="logo-container">
                                <img src="pafenobg.png" alt="Company Logo">
                                <h1 class="logo-text"><span>Prime Assocation of Future Educators</span></h1>
                            </a>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="notifications">
                                <div class="dropdown">
                                    <button class="btn btn-light position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-bell"></i>
                                        <span class="badge bg-danger rounded-pill" id="notificationBadge">0</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="notificationDropdown">
                                        <li><h6 class="dropdown-header">Notifications</h6></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <div id="notificationList">
                                            <!-- Notifications will be added here -->
                                        </div>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-center" href="#" id="clearNotifications">Clear all</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user-profile dropdown">
                                <div class="text-end d-none d-md-block">
                                    <h6 class="mb-0">John Doe</h6>
                                    <small class="text-muted">Administrator</small>
                                </div>
                                <a href="#" class="d-flex align-items-center ms-2" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="https://via.placeholder.com/40" alt="User Profile" class="dropdown-toggle" style="cursor:pointer;">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="#">Manage Account</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Log Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Content Area -->
                <div class="p-4">
                    <!-- Home Section -->
                    <div class="row" id="homeSection">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Calendar</h5>
                                    <div class="calendar-container">
                                        <div class="calendar-header d-flex justify-content-between align-items-center mb-3">
                                            <button class="btn btn-outline-primary btn-sm" id="prevMonth">
                                                <i class="bi bi-chevron-left"></i>
                                            </button>
                                            <h4 class="mb-0" id="currentMonth">September 2023</h4>
                                            <button class="btn btn-outline-primary btn-sm" id="nextMonth">
                                                <i class="bi bi-chevron-right"></i>
                                            </button>
                                        </div>
                                        <div class="calendar-weekdays d-flex mb-2">
                                            <div class="weekday">Sun</div>
                                            <div class="weekday">Mon</div>
                                            <div class="weekday">Tue</div>
                                            <div class="weekday">Wed</div>
                                            <div class="weekday">Thu</div>
                                            <div class="weekday">Fri</div>
                                            <div class="weekday">Sat</div>
                                        </div>
                                        <div class="calendar-days" id="calendarDays">
                                            <!-- Days will be populated by JavaScript -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="card bg-primary text-white">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="card-title mb-0">Total Events</h6>
                                                    <h2 class="mt-2 mb-0" id="totalEvents">0</h2>
                                                </div>
                                                <div class="fs-1">
                                                    <i class="bi bi-calendar-event"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="card bg-success text-white">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="card-title mb-0">Total Feedback</h6>
                                                    <h2 class="mt-2 mb-0" id="totalFeedback">0</h2>
                                                </div>
                                                <div class="fs-1">
                                                    <i class="bi bi-chat-dots"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card bg-info text-white">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="card-title mb-0">Total Users</h6>
                                                    <h2 class="mt-2 mb-0" id="totalUsers">0</h2>
                                                </div>
                                                <div class="fs-1">
                                                    <i class="bi bi-people"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event Section -->
                    <div class="row" id="eventSection" style="display: none;">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Create New Event</h5>
                                    <form id="eventForm">
                                        <div class="mb-3">
                                            <label for="eventName" class="form-label">Event Name</label>
                                            <input type="text" class="form-control" id="eventName" placeholder="Enter event name" required>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="eventDate" class="form-label">Date</label>
                                                <input type="date" class="form-control" id="eventDate" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="eventTime" class="form-label">Time</label>
                                                <input type="time" class="form-control" id="eventTime" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="eventDescription" class="form-label">Description</label>
                                            <textarea class="form-control" id="eventDescription" rows="4" placeholder="Enter event description" required></textarea>
                                        </div>
                                        <div class="d-flex justify-content-end gap-2">
                                            <button type="reset" class="btn btn-outline-secondary">Clear</button>
                                            <button type="submit" class="btn btn-primary">Create Event</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on desktop
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
        const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');

        sidebarToggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            // Rotate the chevron icon
            this.querySelector('i').classList.toggle('bi-chevron-left');
            this.querySelector('i').classList.toggle('bi-chevron-right');
        });

        // Toggle sidebar on mobile
        mobileSidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });

        // Helper: assign color class based on event name/type
        function getEventTypeClass(eventName) {
            if (!eventName) return 'event-default';
            const name = eventName.toLowerCase();
            if (name.includes('instagram')) return 'event-instagram';
            if (name.includes('youtube')) return 'event-youtube';
            if (name.includes('blog')) return 'event-blog';
            if (name.includes('linkedin')) return 'event-linkedin';
            if (name.includes('newsletter')) return 'event-newsletter';
            return 'event-default';
        }

        // Modern calendar rendering
        document.addEventListener('DOMContentLoaded', function() {
            const calendarDays = document.getElementById('calendarDays');
            const currentMonthElement = document.getElementById('currentMonth');
            const prevMonthBtn = document.getElementById('prevMonth');
            const nextMonthBtn = document.getElementById('nextMonth');
            
            let currentDate = new Date();
            let currentMonth = currentDate.getMonth();
            let currentYear = currentDate.getFullYear();

            function updateCalendar() {
                const firstDay = new Date(currentYear, currentMonth, 1);
                const lastDay = new Date(currentYear, currentMonth + 1, 0);
                const startingDay = firstDay.getDay();
                const totalDays = lastDay.getDate();
                
                // Update month and year display
                currentMonthElement.textContent = `${firstDay.toLocaleString('default', { month: 'long' })} ${currentYear}`;
                
                // Clear previous calendar days
                calendarDays.innerHTML = '';
                
                // Add empty cells for days before the first day of the month
                for (let i = 0; i < startingDay; i++) {
                    const emptyDay = document.createElement('div');
                    emptyDay.className = 'calendar-day other-month';
                    calendarDays.appendChild(emptyDay);
                }
                
                // Add days of the current month
                for (let day = 1; day <= totalDays; day++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day';
                    
                    // Highlight today
                    if (day === currentDate.getDate() && 
                        currentMonth === currentDate.getMonth() && 
                        currentYear === currentDate.getFullYear()) {
                        dayElement.classList.add('today');
                    }
                    
                    // Day number
                    const dayNumber = document.createElement('div');
                    dayNumber.className = 'day-number';
                    dayNumber.textContent = day;
                    dayElement.appendChild(dayNumber);
                    
                    // Events for this day
                    const dayEvents = events.filter(event => {
                        const eventDate = new Date(event.date);
                        return eventDate.getDate() === day && 
                               eventDate.getMonth() === currentMonth && 
                               eventDate.getFullYear() === currentYear;
                    });
                    
                    dayEvents.forEach(event => {
                        const eventCard = document.createElement('div');
                        const typeClass = getEventTypeClass(event.name);
                        eventCard.className = `calendar-event-card ${typeClass}`;
                        eventCard.innerHTML = `
                            <div class="event-title">
                                <i class="bi bi-calendar-event"></i> ${event.name}
                            </div>
                            <div class="event-desc">${event.description || ''}</div>
                            <div class="event-time">${event.time || ''}</div>
                        `;
                        dayElement.appendChild(eventCard);
                    });
                    
                    calendarDays.appendChild(dayElement);
                }
            }

            // Initialize calendar
            updateCalendar();

            // Add event listeners for month navigation
            prevMonthBtn.addEventListener('click', function() {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                updateCalendar();
            });

            nextMonthBtn.addEventListener('click', function() {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                updateCalendar();
            });

            // Update calendar when events change
            const originalAddEvent = addEvent;
            addEvent = function(event) {
                originalAddEvent(event);
                updateCalendar();
            };
            const originalDeleteEvent = deleteEvent;
            deleteEvent = function(eventId) {
                originalDeleteEvent(eventId);
                updateCalendar();
            };
        });

        // Notification System
        let notifications = [];
        let unreadCount = 0;

        function addNotification(title, message) {
            const notification = {
                id: Date.now(),
                title: title,
                message: message,
                time: new Date(),
                read: false
            };
            
            notifications.unshift(notification);
            unreadCount++;
            updateNotificationBadge();
            updateNotificationList();
            shakeBell();
        }

        function updateNotificationBadge() {
            const badge = document.getElementById('notificationBadge');
            badge.textContent = unreadCount;
            badge.style.display = unreadCount > 0 ? 'block' : 'none';
        }

        function updateNotificationList() {
            const notificationList = document.getElementById('notificationList');
            notificationList.innerHTML = '';
            
            if (notifications.length === 0) {
                notificationList.innerHTML = '<li class="notification-item text-center text-muted">No notifications</li>';
                return;
            }
            
            notifications.forEach(notification => {
                const timeAgo = getTimeAgo(notification.time);
                const notificationElement = document.createElement('li');
                notificationElement.className = `notification-item ${notification.read ? '' : 'unread'}`;
                notificationElement.innerHTML = `
                    <div class="notification-title">${notification.title}</div>
                    <div class="notification-message">${notification.message}</div>
                    <div class="notification-time">${timeAgo}</div>
                `;
                
                notificationElement.addEventListener('click', () => markAsRead(notification.id));
                notificationList.appendChild(notificationElement);
            });
        }

        function markAsRead(id) {
            const notification = notifications.find(n => n.id === id);
            if (notification && !notification.read) {
                notification.read = true;
                unreadCount--;
                updateNotificationBadge();
                updateNotificationList();
            }
        }

        function clearNotifications() {
            notifications = [];
            unreadCount = 0;
            updateNotificationBadge();
            updateNotificationList();
        }

        function getTimeAgo(date) {
            const seconds = Math.floor((new Date() - date) / 1000);
            
            let interval = seconds / 31536000;
            if (interval > 1) return Math.floor(interval) + ' years ago';
            
            interval = seconds / 2592000;
            if (interval > 1) return Math.floor(interval) + ' months ago';
            
            interval = seconds / 86400;
            if (interval > 1) return Math.floor(interval) + ' days ago';
            
            interval = seconds / 3600;
            if (interval > 1) return Math.floor(interval) + ' hours ago';
            
            interval = seconds / 60;
            if (interval > 1) return Math.floor(interval) + ' minutes ago';
            
            return 'just now';
        }

        function shakeBell() {
            const bell = document.querySelector('.bi-bell');
            bell.classList.add('bell-shake');
            setTimeout(() => {
                bell.classList.remove('bell-shake');
            }, 500);
        }

        // Initialize notifications
        document.addEventListener('DOMContentLoaded', function() {
            updateNotificationList();
            
            // Clear notifications button
            document.getElementById('clearNotifications').addEventListener('click', function(e) {
                e.preventDefault();
                clearNotifications();
            });
        });

        // Event Navigation
        document.addEventListener('DOMContentLoaded', function() {
            const createEventLink = document.getElementById('createEventLink');
            const viewEventLink = document.getElementById('viewEventLink');
            const homeSection = document.getElementById('homeSection');
            const eventSection = document.getElementById('eventSection');
            const navLinks = document.querySelectorAll('.nav-link:not([data-bs-toggle])');

            // Create Event View
            createEventLink.addEventListener('click', function(e) {
                e.preventDefault();
                homeSection.style.display = 'none';
                eventSection.style.display = 'flex';
                eventSection.innerHTML = `
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Create New Event</h5>
                                <form id="eventForm">
                                    <div class="mb-3">
                                        <label for="eventName" class="form-label">Event Name</label>
                                        <input type="text" class="form-control" id="eventName" placeholder="Enter event name" required>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="eventDate" class="form-label">Date</label>
                                            <input type="date" class="form-control" id="eventDate" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="eventTime" class="form-label">Time</label>
                                            <input type="time" class="form-control" id="eventTime" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="eventDescription" class="form-label">Description</label>
                                        <textarea class="form-control" id="eventDescription" rows="4" placeholder="Enter event description" required></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="reset" class="btn btn-outline-secondary">Clear</button>
                                        <button type="submit" class="btn btn-primary">Create Event</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                `;
                
                // Reattach event form handler
                document.getElementById('eventForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    const eventName = document.getElementById('eventName').value;
                    const eventDate = document.getElementById('eventDate').value;
                    const eventTime = document.getElementById('eventTime').value;
                    const eventDescription = document.getElementById('eventDescription').value;
                    
                    addNotification(
                        'New Event Created',
                        `Event "${eventName}" has been scheduled for ${new Date(eventDate).toLocaleDateString()} at ${eventTime}`
                    );
                    
                    this.reset();
                    alert('Event created successfully!');
                });
            });

            // View Events
            viewEventLink.addEventListener('click', function(e) {
                e.preventDefault();
                homeSection.style.display = 'none';
                eventSection.style.display = 'flex';
                eventSection.innerHTML = `
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">View Events</h5>
                                <div class="mb-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <input type="text" class="form-control form-control-sm" id="eventSearchInput" placeholder="Search events..." style="max-width:220px;">
                                        <button class="btn btn-outline-primary btn-sm" id="searchEventsBtn"><i class="bi bi-search"></i></button>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <button class="btn btn-outline-success btn-sm" id="exportCSV"><i class="bi bi-download"></i> Export CSV</button>
                                        <button class="btn btn-outline-primary btn-sm" id="printEvents"><i class="bi bi-printer"></i> Print</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Event Name</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Description</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="eventTableBody">
                                            <!-- Event rows will be rendered here -->
                                        </tbody>
                                    </table>
                                </div>
                                <nav>
                                    <ul class="pagination justify-content-end mt-2" id="eventPagination"></ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                `;
                renderFilteredEvents();
                setupEventTableSorting();
            });

            // Home navigation
            navLinks.forEach(link => {
                if (link.textContent.includes('Home')) {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        homeSection.style.display = 'flex';
                        eventSection.style.display = 'none';
                        navLinks.forEach(l => l.classList.remove('active'));
                        this.classList.add('active');
                    });
                }
            });
        });

        // Event Storage and Management
        let events = [];

        function addEvent(event) {
            events.push(event);
            // Store in localStorage
            localStorage.setItem('events', JSON.stringify(events));
            updateEventView();
        }

        function deleteEvent(eventId) {
            events = events.filter(event => event.id !== eventId);
            localStorage.setItem('events', JSON.stringify(events));
            updateEventView();
        }

        function updateEventView() {
            const eventSection = document.getElementById('eventSection');
            if (eventSection.innerHTML.includes('View Events')) {
                const tableBody = eventSection.querySelector('tbody');
                if (tableBody) {
                    tableBody.innerHTML = events.length ? events.map(event => `
                        <tr>
                            <td>${event.name}</td>
                            <td>${new Date(event.date).toLocaleDateString()}</td>
                            <td>${event.time}</td>
                            <td>${event.description}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary me-2" onclick="editEvent(${event.id})"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-outline-danger" onclick="confirmDeleteEvent(${event.id})"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    `).join('') : '<tr><td colspan="5" class="text-center">No events found</td></tr>';
                }
            }
        }

        function editEvent(eventId) {
            const event = events.find(e => e.id === eventId);
            if (event) {
                // Switch to create event view with pre-filled data
                const createEventLink = document.getElementById('createEventLink');
                createEventLink.click();
                
                // Wait for the form to be rendered
                setTimeout(() => {
                    document.getElementById('eventName').value = event.name;
                    document.getElementById('eventDate').value = event.date;
                    document.getElementById('eventTime').value = event.time;
                    document.getElementById('eventDescription').value = event.description;
                    
                    // Change submit button text
                    const submitBtn = document.querySelector('#eventForm button[type="submit"]');
                    submitBtn.textContent = 'Update Event';
                    
                    // Store the event ID for update
                    submitBtn.dataset.eventId = eventId;
                }, 100);
            }
        }

        // Load events from localStorage on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedEvents = localStorage.getItem('events');
            if (savedEvents) {
                events = JSON.parse(savedEvents);
            }
            
            const createEventLink = document.getElementById('createEventLink');
            const viewEventLink = document.getElementById('viewEventLink');
            const homeSection = document.getElementById('homeSection');
            const eventSection = document.getElementById('eventSection');
            const navLinks = document.querySelectorAll('.nav-link:not([data-bs-toggle])');

            // Create Event View
            createEventLink.addEventListener('click', function(e) {
                e.preventDefault();
                homeSection.style.display = 'none';
                eventSection.style.display = 'flex';
                eventSection.innerHTML = `
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Create New Event</h5>
                                <form id="eventForm">
                                    <div class="mb-3">
                                        <label for="eventName" class="form-label">Event Name</label>
                                        <input type="text" class="form-control" id="eventName" placeholder="Enter event name" required>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="eventDate" class="form-label">Date</label>
                                            <input type="date" class="form-control" id="eventDate" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="eventTime" class="form-label">Time</label>
                                            <input type="time" class="form-control" id="eventTime" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="eventDescription" class="form-label">Description</label>
                                        <textarea class="form-control" id="eventDescription" rows="4" placeholder="Enter event description" required></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="reset" class="btn btn-outline-secondary">Clear</button>
                                        <button type="submit" class="btn btn-primary">Create Event</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                `;
                
                // Reattach event form handler
                document.getElementById('eventForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    const eventName = document.getElementById('eventName').value;
                    const eventDate = document.getElementById('eventDate').value;
                    const eventTime = document.getElementById('eventTime').value;
                    const eventDescription = document.getElementById('eventDescription').value;
                    
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const eventId = submitBtn.dataset.eventId;
                    
                    if (eventId) {
                        // Update existing event
                        const eventIndex = events.findIndex(e => e.id === parseInt(eventId));
                        if (eventIndex !== -1) {
                            events[eventIndex] = {
                                ...events[eventIndex],
                                name: eventName,
                                date: eventDate,
                                time: eventTime,
                                description: eventDescription
                            };
                            localStorage.setItem('events', JSON.stringify(events));
                            addNotification(
                                'Event Updated',
                                `Event "${eventName}" has been updated`
                            );
                        }
                    } else {
                        // Create new event
                        const newEvent = {
                            id: Date.now(),
                            name: eventName,
                            date: eventDate,
                            time: eventTime,
                            description: eventDescription
                        };
                        addEvent(newEvent);
                        addNotification(
                            'New Event Created',
                            `Event "${eventName}" has been scheduled for ${new Date(eventDate).toLocaleDateString()} at ${eventTime}`
                        );
                    }
                    
                    this.reset();
                    submitBtn.textContent = 'Create Event';
                    delete submitBtn.dataset.eventId;
                    alert(eventId ? 'Event updated successfully!' : 'Event created successfully!');
                    
                    // Switch to view events
                    viewEventLink.click();
                });
            });

            // View Events
            viewEventLink.addEventListener('click', function(e) {
                e.preventDefault();
                homeSection.style.display = 'none';
                eventSection.style.display = 'flex';
                eventSection.innerHTML = `
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">View Events</h5>
                                <div class="mb-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <input type="text" class="form-control form-control-sm" id="eventSearchInput" placeholder="Search events..." style="max-width:220px;">
                                        <button class="btn btn-outline-primary btn-sm" id="searchEventsBtn"><i class="bi bi-search"></i></button>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <button class="btn btn-outline-success btn-sm" id="exportCSV"><i class="bi bi-download"></i> Export CSV</button>
                                        <button class="btn btn-outline-primary btn-sm" id="printEvents"><i class="bi bi-printer"></i> Print</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Event Name</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Description</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="eventTableBody">
                                            <!-- Event rows will be rendered here -->
                                        </tbody>
                                    </table>
                                </div>
                                <nav>
                                    <ul class="pagination justify-content-end mt-2" id="eventPagination"></ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                `;
                renderFilteredEvents();
                setupEventTableSorting();
            });

            // Home navigation
            navLinks.forEach(link => {
                if (link.textContent.includes('Home')) {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        homeSection.style.display = 'flex';
                        eventSection.style.display = 'none';
                        navLinks.forEach(l => l.classList.remove('active'));
                        this.classList.add('active');
                    });
                }
            });
        });

        // Add this to your existing JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            // Update total events count
            function updateTotalEvents() {
                const totalEvents = events.length;
                document.getElementById('totalEvents').textContent = totalEvents;
            }

            // Initialize counts
            updateTotalEvents();
            
            // Update counts whenever events change
            const originalAddEvent = addEvent;
            addEvent = function(event) {
                originalAddEvent(event);
                updateTotalEvents();
            };

            const originalDeleteEvent = deleteEvent;
            deleteEvent = function(eventId) {
                originalDeleteEvent(eventId);
                updateTotalEvents();
            };

            // For demonstration, set some initial values
            document.getElementById('totalFeedback').textContent = '12';
            document.getElementById('totalUsers').textContent = '45';
        });

        // Helper: get event status
        function getEventStatus(event) {
            const today = new Date();
            const eventDate = new Date(event.date);
            if (event.status === 'canceled') return 'canceled';
            if (eventDate < today) return 'completed';
            return 'upcoming';
        }

        // Pagination, filtering, sorting, export, and confirmation logic
        let currentPage = 1;
        const eventsPerPage = 5;
        let currentSort = { key: 'date', asc: true };

        function renderEventTable(filteredEvents) {
            // Sort
            filteredEvents.sort((a, b) => {
                let valA = a[currentSort.key], valB = b[currentSort.key];
                if (currentSort.key === 'date') {
                    valA = new Date(valA); valB = new Date(valB);
                }
                if (valA < valB) return currentSort.asc ? -1 : 1;
                if (valA > valB) return currentSort.asc ? 1 : -1;
                return 0;
            });
            // Pagination
            const totalPages = Math.ceil(filteredEvents.length / eventsPerPage) || 1;
            if (currentPage > totalPages) currentPage = totalPages;
            const startIdx = (currentPage - 1) * eventsPerPage;
            const pageEvents = filteredEvents.slice(startIdx, startIdx + eventsPerPage);
            // Render rows
            const tbody = document.getElementById('eventTableBody');
            tbody.innerHTML =
                (pageEvents.length ? pageEvents.map(event => `
                    <tr>
                        <td>${event.name}</td>
                        <td>${new Date(event.date).toLocaleDateString()}</td>
                        <td>${event.time}</td>
                        <td>${event.description}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary me-2" onclick="editEvent(${event.id})"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-outline-danger" onclick="confirmDeleteEvent(${event.id})"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                `).join('') : '<tr><td colspan="5" class="text-center">No events found</td></tr>');
            // Pagination controls
            const pag = document.getElementById('eventPagination');
            pag.innerHTML = '';
            for (let i = 1; i <= totalPages; i++) {
                pag.innerHTML += `<li class="page-item${i === currentPage ? ' active' : ''}"><a class="page-link" href="#" onclick="goToEventPage(${i});return false;">${i}</a></li>`;
            }
        }
        window.goToEventPage = function(page) { currentPage = page; renderFilteredEvents(); };

        // Filtering
        function renderFilteredEvents() {
            const searchTerm = (document.getElementById('eventSearchInput')?.value || '').trim().toLowerCase();
            const startDate = document.getElementById('filterStartDate')?.value;
            const endDate = document.getElementById('filterEndDate')?.value;
            const status = document.getElementById('filterStatus')?.value;
            let filtered = events.filter(event =>
                (!searchTerm || event.name.toLowerCase().includes(searchTerm) || event.description.toLowerCase().includes(searchTerm) || (event.time && event.time.toLowerCase().includes(searchTerm)) || (event.date && new Date(event.date).toLocaleDateString().toLowerCase().includes(searchTerm))) &&
                (!startDate || new Date(event.date) >= new Date(startDate)) &&
                (!endDate || new Date(event.date) <= new Date(endDate)) &&
                (!status || getEventStatus(event) === status)
            );
            renderEventTable(filtered);
        }

        // Sorting
        function setupEventTableSorting() {
            document.querySelectorAll('.table th').forEach((th, idx) => {
                th.style.cursor = 'pointer';
                th.onclick = function() {
                    const keys = ['name', 'date', 'time', 'description'];
                    if (idx < keys.length) {
                        if (currentSort.key === keys[idx]) currentSort.asc = !currentSort.asc;
                        else { currentSort.key = keys[idx]; currentSort.asc = true; }
                        renderFilteredEvents();
                    }
                };
            });
        }

        // Export to CSV
        function exportEventsToCSV() {
            let csv = 'Event Name,Date,Time,Description,Status\n';
            const searchTerm = (document.getElementById('eventSearchInput')?.value || '').trim().toLowerCase();
            const startDate = document.getElementById('filterStartDate')?.value;
            const endDate = document.getElementById('filterEndDate')?.value;
            const status = document.getElementById('filterStatus')?.value;
            let filtered = events.filter(event =>
                (!searchTerm || event.name.toLowerCase().includes(searchTerm) || event.description.toLowerCase().includes(searchTerm) || (event.time && event.time.toLowerCase().includes(searchTerm)) || (event.date && new Date(event.date).toLocaleDateString().toLowerCase().includes(searchTerm))) &&
                (!startDate || new Date(event.date) >= new Date(startDate)) &&
                (!endDate || new Date(event.date) <= new Date(endDate)) &&
                (!status || getEventStatus(event) === status)
            );
            filtered.forEach(event => {
                csv += `"${event.name}","${new Date(event.date).toLocaleDateString()}","${event.time}","${event.description}","${getEventStatus(event)}"\n`;
            });
            const blob = new Blob([csv], { type: 'text/csv' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'events.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }

        // Print
        function printEvents() {
            window.print();
        }

        // Delete confirmation
        window.confirmDeleteEvent = function(eventId) {
            if (confirm('Are you sure you want to delete this event?')) {
                deleteEvent(eventId);
                renderFilteredEvents();
            }
        };

        // Event listeners
        if (document.getElementById('searchEventsBtn')) document.getElementById('searchEventsBtn').onclick = renderFilteredEvents;
        if (document.getElementById('exportCSV')) document.getElementById('exportCSV').onclick = exportEventsToCSV;
        if (document.getElementById('printEvents')) document.getElementById('printEvents').onclick = printEvents;

        // Restore live search as you type:
        if (document.getElementById('eventSearchInput')) document.getElementById('eventSearchInput').oninput = renderFilteredEvents;
        // Keep the search button as well:
        if (document.getElementById('searchEventsBtn')) document.getElementById('searchEventsBtn').onclick = renderFilteredEvents;

        // Initial render
        renderFilteredEvents();
        setupEventTableSorting();
    </script>
</body>
</html> 