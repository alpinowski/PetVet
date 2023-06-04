<!DOCTYPE html>
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>PetVet System</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../petvet/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../petvet/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../petvet/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../petvet/assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../petvet/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../petvet/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../petvet/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../petvet/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="../petvet/assets/pages/css/login.min.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="../petvet/images/favicon.ico" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <!-- <link rel="shortcut icon" href="favicon.ico" /> </head> -->
        <!-- END HEAD -->
        <!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
        <style>
        body {
        background-color: #d5cbe5;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='152' height='152' viewBox='0 0 152 152'%3E%3Cg fill-rule='evenodd'%3E%3Cg id='temple' fill='%23eae4f4' fill-opacity='0.11'%3E%3Cpath d='M152 150v2H0v-2h28v-8H8v-20H0v-2h8V80h42v20h20v42H30v8h90v-8H80v-42h20V80h42v40h8V30h-8v40h-42V50H80V8h40V0h2v8h20v20h8V0h2v150zm-2 0v-28h-8v20h-20v8h28zM82 30v18h18V30H82zm20 18h20v20h18V30h-20V10H82v18h20v20zm0 2v18h18V50h-18zm20-22h18V10h-18v18zm-54 92v-18H50v18h18zm-20-18H28V82H10v38h20v20h38v-18H48v-20zm0-2V82H30v18h18zm-20 22H10v18h18v-18zm54 0v18h38v-20h20V82h-18v20h-20v20H82zm18-20H82v18h18v-18zm2-2h18V82h-18v18zm20 40v-18h18v18h-18zM30 0h-2v8H8v20H0v2h8v40h42V50h20V8H30V0zm20 48h18V30H50v18zm18-20H48v20H28v20H10V30h20V10h38v18zM30 50h18v18H30V50zm-2-40H10v18h18V10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        </style>
    </head>
    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo" style="margin-top: 0px; margin-bottom: 0px;">
            <a href="index.php">
            <img src="../petvet/images/petvet-logo.png" width="15%" height="15%" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content" style="margin-top: 0px;">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="index.php" method="post">
                <h3 class="form-title font-blue">PetVet System</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Username and password are required </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" id="username" /> </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Password</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id="password" /> </div>
                        <!--<div class="g-recaptcha" data-sitekey="6LfNGzAUAAAAAMtRya5HBstM8_R7xPIc32eDwW55" id="g-recaptcha" name="g-recaptcha"></div> -->
                        <div class="form-actions">
                            <button type="submit" class="btn green uppercase">Login</button>
                        </div>
                    </form>
                    <!-- END LOGIN FORM -->
                </div>
                <div class="copyright" style="color: white;"> Copyright &copy; <?php echo date("Y")?> All rights reserved. |&nbsp;
                    Developed by <a target="_blank" style="color: orange;" href="http://www.trtechs.com">TRTech</a> </div>
                    <!-- BEGIN CORE PLUGINS -->
                    <script src="../petvet/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
                    <script src="../petvet/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
                    <script src="../petvet/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
                    <script src="../petvet/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
                    <script src="../petvet/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
                    <script src="../petvet/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
                    <!-- END CORE PLUGINS -->
                    <!-- BEGIN PAGE LEVEL PLUGINS -->
                    <script src="../petvet/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
                    <script src="../petvet/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
                    <script src="../petvet/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
                    <!-- END PAGE LEVEL PLUGINS -->
                    <!-- BEGIN THEME GLOBAL SCRIPTS -->
                    <script src="../petvet/assets/global/scripts/app.min.js" type="text/javascript"></script>
                    <!-- END THEME GLOBAL SCRIPTS -->
                    <!-- BEGIN PAGE LEVEL SCRIPTS -->
                    <script src="../petvet/scripts/login.js" type="text/javascript"></script>
                    <!-- END PAGE LEVEL SCRIPTS -->
                    <!-- BEGIN THEME LAYOUT SCRIPTS -->
                    <!-- END THEME LAYOUT SCRIPTS -->
                    <script>
                    $(document).ready(function()
                    {
                    $('#clickmewow').click(function()
                    {
                    $('#radio1003').attr('checked', 'checked');
                    });
                    })
                    </script>
                </body>
            </html>