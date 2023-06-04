<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Pet Vet System</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for blank page layout" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../petvet/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../petvet/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../petvet/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../petvet/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../petvet/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../petvet/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="../petvet/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../petvet/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="../petvet/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <!-- PAGE STYLES -->
        <link href="../petvet/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="../petvet/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

        <link href="../petvet/assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />

        <link href="../petvet/assets/global/plugins/typeahead/typeahead.css" rel="stylesheet" type="text/css" />
        <link href="../petvet/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />

        <link href="../petvet/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="index.php">
                            <img src="../petvet/images/petvet-logo.png" height="36px" width="145px" alt="logo" class="logo-default" /> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <?php if (isset($_SESSION["p_user_id"])){ ?>
                        <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar"> <!-- LEFT-->
                            <?php
                                $class_set = get_next_vacs_by_current_month();
                                $counter = 0;

                                while ($aset = mysqli_fetch_assoc($class_set)){ $counter++; }

                                echo "
                                <a href='javascript:;' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-close-others='true'>
                                    <i class='icon-bell'></i>
                                    <span class='badge badge-default'> " . $counter . " </span>
                                </a>
                                <ul class='dropdown-menu'>
                                    <li class='external'>
                                        <h3><span class='bold'>" . $counter . " pending</span> notifications</h3>
                                        <a href='page_user_profile_1.html'>view all</a>
                                    </li>
                                    <li>
                                        <ul class='dropdown-menu-list scroller' style='height: 250px;' data-handle-color='#637283'>";

                                $class_set = get_next_vacs_by_current_month();

                                while ($aset = mysqli_fetch_assoc($class_set))
                                { 
                                    echo "<li><a href='javascript:;'>";
                                    echo "<span class='time'>" . $aset['next_vaccination'] . "</span>";
                                    echo "<span class='details'><span class='label label-sm label-icon label-success'><i class='fa fa-shield'></i></span>" . $aset['p_name'] . " [" . $aset['species'] . "]" . "</span>";
                                    echo "</a></li>";
                                }

                                echo "</ul></li></ul>";
                            ?>
                            </li>
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar"> <!-- LEFT-->
                            <?php
                                $class_set = get_next_vacs_by_last_month();
                                $counter = 0;

                                while ($aset = mysqli_fetch_assoc($class_set)){ $counter++; }

                                echo "
                                <a href='javascript:;' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-close-others='true'>
                                    <i class='icon-bell'></i>
                                    <span class='badge badge-default'> " . $counter . " </span>
                                </a>
                                <ul class='dropdown-menu'>
                                    <li class='external'>
                                        <h3><span class='bold'>" . $counter . " pending</span> notifications</h3>
                                        <a href='page_user_profile_1.html'>view all</a>
                                    </li>
                                    <li>
                                        <ul class='dropdown-menu-list scroller' style='height: 250px;' data-handle-color='#637283'>";

                                $class_set = get_next_vacs_by_last_month();

                                while ($aset = mysqli_fetch_assoc($class_set))
                                { 
                                    echo "<li><a href='javascript:;'>";
                                    echo "<span class='time'>" . $aset['next_vaccination'] . "</span>";
                                    echo "<span class='details'><span class='label label-sm label-icon label-danger'><i class='fa fa-exclamation-circle'></i></span>" . $aset['p_name'] . " [" . $aset['species'] . "]" . "</span>";
                                    echo "</a></li>";
                                }

                                echo "</ul></li></ul>";
                            ?>
                            </li>
                            <!-- END NOTIFICATION DROPDOWN -->
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="../petvet/assets/layouts/layout/img/avatar3_small.jpg" />
                                    <span class="username username-hide-on-mobile"> <?php echo $_SESSION['p_username']; ?> </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="profile.php"> <i class="icon-user"></i> My Profile </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="logout.php"> <i class="icon-key"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                        </ul>
                        </div>
                    <?php } ?>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                            <li class="nav-item start <?php if($tab_num===0) { echo "active open"; } ?>"> <!--If con for active tab-->
                                <a href="index.php" class="nav-link nav-toggle">
                                    <i class="icon-home"></i>
                                    <span class="title">Home</span>
                                    <span class="<?php if($tab_num===0) { echo "selected"; } else { echo ""; } ?>"></span>
                                </a>                    <!--If con for active tab-->
                            </li>
                            <li class="nav-item <?php if($tab_num===1) { echo "active open"; } ?>"> <!--If con for active tab-->
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-users"></i>
                                    <span class="title">Owners</span>
                                    <span class="<?php if($tab_num===1) { echo "selected"; } else { echo "arrow"; } ?>"></span>
                                </a>                    <!--If con for active tab-->
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="owner.php" class="nav-link ">
                                            <span class="title">Owner</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item <?php if($tab_num===2) { echo "active open"; } ?>"> <!--If con for active tab-->
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-eye"></i>
                                    <span class="title">Pets</span>
                                    <span class="<?php if($tab_num===2) { echo "selected"; } else { echo "arrow"; } ?>"></span>
                                </a>                    <!--If con for active tab-->
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="pet.php" class="nav-link ">
                                            <span class="title">Pet</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item <?php if($tab_num===3) { echo "active open"; } ?>"> <!--If con for active tab-->
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-layers"></i>
                                    <span class="title">Tests</span>
                                    <span class="selected"></span>
                                    <span class="<?php if($tab_num===3) { echo "selected"; } else { echo "arrow"; } ?>"></span>
                                </a>                    <!--If con for active tab-->
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="test.php" class="nav-link ">
                                            <span class="title">Pet Test</span>
                                            <span class="title"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="category.php" class="nav-link ">
                                            <span class="title">Category</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item <?php if($tab_num===4) { echo "active open"; } ?>"> <!--If con for active tab-->
                                <a href="role.php" class="nav-link nav-toggle">
                                    <i class="fa fa-user-md"></i>
                                    <span class="title">Roles</span>
                                    <span class="<?php if($tab_num===4) { echo "selected"; } else { echo ""; } ?>"></span>
                                </a>                    <!--If con for active tab-->
                            </li>
                            <li class="nav-item <?php if($tab_num===5) { echo "active open"; } ?>"> <!--If con for active tab-->
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-users"></i>
                                    <span class="title">Users</span>
                                    <span class="<?php if($tab_num===5) { echo "selected"; } else { echo "arrow"; } ?>"></span>
                                </a>                    <!--If con for active tab-->
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="user.php" class="nav-link ">
                                            <span class="title">User</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="privilege.php" class="nav-link ">
                                            <span class="title">Privilege</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item <?php if($tab_num===6) { echo "active open"; } ?>"> <!--If con for active tab-->
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-book-open"></i>
                                    <span class="title">Reports</span>
                                    <span class="<?php if($tab_num===6) { echo "selected"; } else { echo "arrow"; } ?>"></span>
                                </a>                    <!--If con for active tab-->
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="test_report.php" class="nav-link ">
                                            <span class="title">Tests report</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="next_vac_report.php" class="nav-link ">
                                            <span class="title">Next vaccinations report</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="owner_test_vac_report.php" class="nav-link ">
                                            <span class="title">Owner's test vaccinations report</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-settings"></i>
                                    <span class="title">Settings</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="profile.php" class="nav-link ">
                                            <span class="title">Profile</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            </li>
                        </ul>
                        <!-- END SIDEBAR MENU -->
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
