<!doctype html>
<html lang="en">
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    
}
?>
<head>

    <!-- Basic Page Needs
================================================== -->
    <title>Dissertation management system</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
================================================== -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/colors/blue.css">

</head>

<body class="gray">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header Container
================================================== -->
        <header id="header-container" class="fullwidth dashboard-header not-sticky">

            <!-- Header -->
            <div id="header">
                <div class="container">

                    <!-- Left Side Content -->
                    <div class="left-side">

                        <!-- Logo -->
                        <div id="logo">
                            <a href="/"><img src="/images/logo.png" alt=""></a>
                        </div>

                        <!-- Main Navigation -->
                        <nav id="navigation">
                            <ul id="responsive">

                                <li><a href="/" class="current">Home</a></li>
                                <li><a href="/about-us.php" class="current">About Us</a></li>
                                <li><a href="/searchprojects.php" class="current">Projects</a></li>
                                <li><a href="/contact.php" class="current">Contact Us</a></li>

                            </ul>
                        </nav>
                        <div class="clearfix"></div>
                        <!-- Main Navigation / End -->

                    </div>
                    <!-- Left Side Content / End -->


                    <!-- Right Side Content / End -->
                    <div class="right-side">

                        <!-- User Menu -->
                        <div class="header-widget">

                            <!-- Messages -->
                            <div class="header-notifications user-menu">
                                <div class="header-notifications-trigger">
                                    <a href="#">
                                        <div class="user-avatar status-online"><img
                                                src="/<?php echo $_SESSION['img'];?>" alt=""></div>
                                    </a>
                                </div>

                                <!-- Dropdown -->
                                <div class="header-notifications-dropdown">

                                    <!-- User Status -->
                                    <div class="user-status">

                                        <!-- User Name / Avatar -->
                                        <div class="user-details">
                                            <div class="user-avatar status-online"><img
                                                    src="/<?php echo $_SESSION['img'];?>" alt=""></div>
                                            <div class="user-name">
                                            <?php echo $_SESSION['name'];?> <span>Student</span>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="user-menu-small-nav">
                                        <li><a href="/user/changepassword.php"><i class="icon-material-outline-dashboard"></i>
                                                Change Password</a></li>
                                        <li><a href="/user/profile.php"><i
                                                    class="icon-material-outline-settings"></i> My Profile</a></li>
                                        <li><a href="/user/logout.php"><i
                                                    class="icon-material-outline-power-settings-new"></i> Logout</a>
                                        </li>
                                    </ul>

                                </div>
                            </div>

                        </div>
                        <!-- User Menu / End -->

                        <!-- Mobile Navigation Button -->
                        <span class="mmenu-trigger">
                            <button class="hamburger hamburger--collapse" type="button">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </span>

                    </div>
                    <!-- Right Side Content / End -->

                </div>
            </div>
            <!-- Header / End -->

        </header>
        <div class="clearfix"></div>
        <!-- Header Container / End -->


        <!-- Dashboard Container -->
        <div class="dashboard-container">

            <!-- Dashboard Sidebar
    ================================================== -->
            <div class="dashboard-sidebar">
                <div class="dashboard-sidebar-inner" data-simplebar>
                    <div class="dashboard-nav-container">

                        <!-- Responsive Navigation Trigger -->
                        <a href="#" class="dashboard-responsive-nav-trigger">
                            <span class="hamburger hamburger--collapse">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </span>
                            <span class="trigger-title">Dashboard Navigation</span>
                        </a>

                        <!-- Navigation -->
                        <div class="dashboard-nav">
                            <div class="dashboard-nav-inner">

                                <ul data-submenu-title="">
                                    <li class="active"><a href="/user/userlogin.php"><i
                                                class="icon-material-outline-dashboard"></i> Dashboard</a></li>
                                                <li><a href="#"><i class="icon-material-outline-business-center"></i>Messages</a>
                                        <ul>
                                            <li><a href="/user/inbox.php">Inbox</a></li>
                                            <li><a href="/user/sent_messages.php">Sent Messages</a></li>
                                            <li><a href="/user/messages.php">Send New</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="#"><i class="icon-material-outline-business-center"></i>Projects</a>
                                        <ul>
                                            <li><a href="/user/viewprojects.php">View All</a></li>
                                            <li><a href="/user/viewgroupproject.php">Manage Group Projects</a></li>
                                            <li><a href="/user/addproject.php">Add New</a></li>
                                        </ul>
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <!-- Navigation / End -->

                    </div>
                </div>
            </div>
            <!-- Dashboard Sidebar / End -->
            <!-- Dashboard Content
    ================================================== -->
            <div class="dashboard-content-container" data-simplebar>
                <div class="dashboard-content-inner">