<?php $tab_num = 6; $page_name = "Owner Test Vaccination Report"; ?>
<?php include "../petvet/layouts/header.php";?>
<?php confirm_logged_in(); ?>
<?php
  if (isset($_POST['submitBtn']))
  {
    if(get_owner_id($_POST['search_input']) != 0)
    {
      $_SESSION['owner_fullname'] = $_POST['search_input'];
      $_SESSION['owner_id'] = get_owner_id($_POST['search_input']);
    }
  }
?>
<?php
  $user_id = $_SESSION['p_user_id'];
  $cls_set = get_crud_by_user_id($user_id, $page_name);
  $arr = mysqli_fetch_assoc($cls_set)
?>
<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit">
      <div class="portlet-title">
        <div class="caption">
          <i class="icon-book-open font-green"></i>
          <span class="caption-subject font-green bold uppercase"><?php echo $page_name; ?></span>
        </div>
        <?php if($arr['view_p']=="Yes"){ ?>
        <div class="actions">
          <div class="btn-group">
            <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                <i class="fa fa-share"></i>
                <span class="hidden-xs"> Actions </span>
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu pull-right" id="sample_1_tools">
              <li>
                  <a href="javascript:;" data-action="0" class="tool-action">
                  <i class="icon-printer"></i> Print </a>
              </li>
              <li>
                  <a href="javascript:;" data-action="1" class="tool-action">
                  <i class="icon-check"></i> Copy </a>
              </li>
              <li>
                  <a href="javascript:;" data-action="2" class="tool-action">
                  <i class="icon-doc"></i> PDF</a>
              </li>
              <li>
                  <a href="javascript:;" data-action="3" class="tool-action">
                  <i class="icon-paper-clip"></i> Excel </a>
              </li>
              <li class="divider"> </li>
              <li>
                  <a href="javascript:;" data-action="5" class="tool-action">
                  <i class="icon-refresh"></i> Columns </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="portlet-body">
          <form class="form-inline" role="form" method="post" enctype="multipart/form-data" action="owner_test_vac_report.php">
            <div class="form-group">
              <label class="control-label">Owner Fullname: </label>
              <div class="input-group">
                <input class="form-control input-large" id="search_input" name="search_input" value="<?php if(isset($_SESSION['owner_fullname'])){ echo $_SESSION['owner_fullname'];} ?>">
              </div>
            </div>
            <button type="submit" class="btn red btn-outline" id="submitBtn" name="submitBtn">Search</button>
          </form>
          <p class="help-block"> E.g: Ahmed, Sara </p>

          <table class="table table-striped table-bordered table-hover dataTable dtr-inline collapsed" id="sample_1" role="grid" aria-describedby="sample_1_info" style="width: 1268px;">
            <thead>
              <tr>
                <th width="5%"> No </th>
                <th width="20%"> Owner Fullname </th>
                <th width="15%"> Owner Mobile </th>
                <th width="10%"> Pet Name </th>
                <th width="5%"> Species </th>
                <th width="10%"> Test Date </th>
                <th width="20%"> Test Category </th>
                <th width="20%"> User Fullname </th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th width="5%"> No </th>
                <th width="20%"> Owner Fullname </th>
                <th width="10%"> Owner Mobile </th>
                <th width="10%"> Pet Name </th>
                <th width="5%"> Species </th>
                <th width="10%"> Test Date </th>
                <th width="20%"> Test Category </th>
                <th width="20%"> User Fullname </th>
              </tr>
            </tfoot>
            <tbody>
              <?php
                if(isset($_SESSION['owner_id']))
                {
                  $class_set = get_tests_by_owner_id($_SESSION['owner_id']);
                  $counter   = 1;
                  while ($aset = mysqli_fetch_assoc($class_set))
                  {
                    echo "<tr>";
                    echo "<td width='5%'>" . $counter . "</td>";
                    echo "<td width='20%'>" . $aset['ofname'] . "</td>";
                    echo "<td width='10%'>" . $aset['mobile'] . "</td>";
                    echo "<td width='10%'>" . $aset['p_name'] . "</td>";
                    echo "<td width='5%'>" . $aset['species'] . "</td>";
                    echo "<td width='10%'>" . $aset['t_date'] . "</td>";
                    echo "<td width='20%'>" . $aset['c_name'] . "</td>";
                    echo "<td width='20%'>" . $aset['ufname'] . "</td>";

                    $counter++;
                    echo "</tr>";
                  }
                }
              ?>
            </tbody>
          </table>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php include("../petvet/layouts/footer1.php"); ?>
<script src="../petvet/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="../petvet/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="../petvet/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<script src="../petvet/assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="../petvet/assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>

<script src="../petvet/scripts/owners/autocomplete-owners.js" type="text/javascript"></script>

<script src="../petvet/scripts/reports/datatables-owner_test_vac_reports.js" type="text/javascript"></script>
<?php include("../petvet/layouts/footer2.php"); ?>