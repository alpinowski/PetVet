<?php $tab_num = 0; ?>
<?php include "../petvet/layouts/header.php";?>
<?php confirm_logged_in(); ?>
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> PetVet System
    <small> Where makes your industry at ease</small>
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="note note-info">
    <p> 
        You can start by adding owners and their pets data to the system. Furthermore, you can collect reports through the data.
    </p>
</div>

<br />

<h1 class="page-title"> Data collection </h1>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?php
                    $counter = mysqli_fetch_assoc(count_owners());
                    echo '<span data-counter="counterup"';
                    echo 'data-value="' . $counter['c'] . '">' . $counter['c'] . '</span>';
                    ?>
                </div>
                <div class="desc"> Total Owners </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?php
                    $counter = mysqli_fetch_assoc(count_pets());
                    echo '<span data-counter="counterup"';
                    echo 'data-value="' . $counter['c'] . '">' . $counter['c'] . '</span>';
                    ?>
                </div>
                <div class="desc"> Total Pets </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 red" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?php
                    $counter = mysqli_fetch_assoc(count_tests());
                    echo '<span data-counter="counterup"';
                    echo 'data-value="' . $counter['c'] . '">' . $counter['c'] . '</span>';
                    ?>
                </div>
                <div class="desc"> Total Tests </div>
            </div>
        </a>
    </div>
</div>

<?php include("../petvet/layouts/footer1.php"); ?>
<script src="../petvet/scripts/index/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="../petvet/scripts/index/jquery.counterup.js" type="text/javascript"></script>
<?php include("../petvet/layouts/footer2.php"); ?>
