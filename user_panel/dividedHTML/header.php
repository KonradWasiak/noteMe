<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader"> 
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="userpanel.php">
                    <a class="navbar-brand" href="userpanel.php">
                        <!-- Logo icon -->
                        <span>
                            <img src="../assets/header-logo-text.png" alt="homepage" class="dark-logo" />
                        </span>                        
                        <b>
                            <img src="../assets/header-logo.png" alt="homepage" class="dark-logo" />
                        </b>
                    </a>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item">
                            <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)">
                                <i class="mdi mdi-menu"></i>
                            </a>
                        </li>
                        <li class="nav-item m-l-10">
                            <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)">
                                <i class="ti-menu"></i>
                            </a>
                        </li>
                        <!-- Search -->
                        
                    </ul>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- Comment -->
                        
                        <!-- End Comment -->
                        <!-- Messages -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                <div class="notify">
                                <?php 
                                    if($pane->countMailsReturn($pdo, $_SESSION['userID'])>0)
                                    {
                                        echo'
                                  <span class="heartbit"></span>
                                    <span class="point"></span>';
                                    }
                                    ?>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn" aria-labelledby="2">
                                <ul>
                                    <li>
                                     
                                           <?php $pane->showMailsRounded($pdo,$_SESSION['userID']); ?>
                                       
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- End Messages -->
                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted" href="app-profile.php">
                                <div class="profile-pic">
                                <?php  
                                $login= substr($_SESSION['userID'], 0, -5); 
                                $pane->getUserAvatar($pdo, $login); ?>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div id="sessionNumber" data-name="<?php  echo($_SESSION['userID']);?>"></div>