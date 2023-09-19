<html lang="en">
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<head>

    <!-- Basic Page Needs
================================================== -->
    <title>GCU FYP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
================================================== -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/colors/blue.css">

</head>

<body>

    <!-- Wrapper -->
    <div id="wrapper">

<!-- Header Container
================================================== -->
<header id="header-container" class="fullwidth">

            <!-- Header -->
            <div id="header">
                <div class="container">

                    <!-- Left Side Content -->
                    <div class="left-side">

                        <!-- Logo -->
                        <div id="logo">
                            <a href="/"><img src="/images/logo2.png" data-sticky-logo="/images/logo.png"
                                    data-transparent-logo="/images/logo2.png" alt=""></a>
                        </div>

                        <!-- Main Navigation -->
                        <nav id="navigation">
                            <ul id="responsive">

                                <li><a href="/" class="current">Home</a></li>
                                <li><a href="/about-us" class="current">About Us</a></li>
                                <li><a href="/searchprojects" class="current">Projects</a></li>
                                <li><a href="/contact" class="current">Contact Us</a></li>
                                <?php

                                if (isset($_SESSION['name'])) {
                                    echo '<li><a href="/login" class="current">Dashboard</a></li>';
                                } else {
                                    echo '<li><a href="/login" class="current">Login</a></li>
                                <li><a href="/register" class="current">Register</a></li>';

                                } ?>




                            </ul>
                        </nav>
                        <div class="clearfix"></div>
                        <!-- Main Navigation / End -->

                    </div>
                    <!-- Left Side Content / End -->


                    <!-- Right Side Content / End -->
                    <div class="right-side">


                        <?php
                        if (isset($_SESSION['name']) && isset($_SESSION['img'])) {
                            echo ' <!-- User Menu -->
                            <div class="header-widget">

                            <!-- Messages -->
                            <div class="header-notifications user-menu">
                                <div class="header-notifications-trigger">
                                    <a href="#">
                                        <div class="user-avatar status-online"><img
                                                src="/'.$_SESSION['img'].'" alt=""></div>
                                    </a>
                                </div>

                                <!-- Dropdown -->
                                <div class="header-notifications-dropdown">

                                    <!-- User Status -->
                                    <div class="user-status">

                                        <!-- User Name / Avatar -->
                                        <div class="user-details">
                                            <div class="user-avatar status-online"><img
                                                    src="/'.$_SESSION['img'].'" alt=""></div>
                                            <div class="user-name">'.$_SESSION['name'].' <span></span>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="user-menu-small-nav">
                                        <li><a href="/user/changepassword"><i class="icon-material-outline-dashboard"></i>
                                                Change Password</a></li>
                                        <li><a href="/user/profile"><i
                                                    class="icon-material-outline-settings"></i> My Profile</a></li>
                                        <li><a href="/user/logout"><i
                                                    class="icon-material-outline-power-settings-new"></i> Logout</a>
                                        </li>
                                    </ul>

                                </div>
                            </div>

                        </div>
                        <!-- User Menu / End -->';
                        }
                        ?>
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