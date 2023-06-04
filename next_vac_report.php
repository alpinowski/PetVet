<?php $tab_num = 6; $page_name = 'Next Vaccination Report'; ?>
<?php include "../petvet/layouts/header.php";?>
<?php confirm_logged_in(); ?>
<?php
  $user_id = $_SESSION['p_user_id'];
  $cls_set = get_crud_by_user_id($user_id, $page_name);
  $arr = 0;
  if(mysqli_num_rows($cls_set) > 0)
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
        <?php if($arr != 0 &&$arr['view_p']=="Yes") { ?>
          <form class="form-inline" role="form" method="post" enctype="multipart/form-data" action="next_vac_report.php">
            <div class="form-group"></div>
              <div class="form-group">
                <label class="control-label">Next Vaccination: </label>
                <div class="input-group">
                  <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                    <input class="form-control" readonly="" aria-required="true" aria-invalid="false" aria-describedby="datepicker-error" type="text" id="fnext_vac" name="fnext_vac" value="<?php echo date("Y-m-d"); ?>">
                    <span class="input-group-btn">
                      <button class="btn default" type="button">
                        <i class="fa fa-calendar"></i>
                      </button>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label"><i class="fa fa-angle-double-right"></i></label>
                <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                  <input class="form-control" readonly="" aria-required="true" aria-invalid="false" aria-describedby="datepicker-error" type="text" id="snext_vac" name="snext_vac">
                  <span class="input-group-btn">
                    <button class="btn default" type="button">
                      <i class="fa fa-calendar"></i>
                    </button>
                  </span>
                </div>
              </div>
              <div class="btn-group">
                <div class="form-group">
                  <button type="submit" class="btn red btn-outline" id="submitBtn" name="submitBtn">Search</button>
                </div>
              </div>
          </form>
          <br/>
        <table class="table table-striped table-bordered table-hover dataTable dtr-inline collapsed" id="sample_1" role="grid" aria-describedby="sample_1_info" style="width: 1268px;">
          <thead>
            <tr>
              <th width="5%"> No </th>
              <th width="10%"> Next Vaccination </th>
              <th width="10%"> Pet Name </th>
              <th width="8%"> Species </th>
              <th width="8%"> Gender </th>
              <th width="15%"> Owner Fullname </th>
              <th width="10%"> Owner Mobile </th>
              <th width="20%"> Test Category </th>
              <th width="15%"> User Fullname </th>
            </tr>
          </thead>
          <tfoot>
          <tr>
            <th width="5%"> No </th>
            <th width="10%"></th>
            <th width="10%"> Pet Name </th>
            <th></th>
            <th width="8%"> Gender </th>
            <th width="15%"> Owner Fullname </th>
            <th width="10%"> Owner Mobile </th>
            <th width="20%"> Test Category </th>
            <th width="15%"></th>
          </tr>
          </tfoot>
          <tbody>
            <?php
              if (isset($_POST['submitBtn']))
              {
                if(get_next_vacs_by_dates($_POST['fnext_vac'], $_POST['snext_vac']) !== 0)
                {
                  $cls_set = get_next_vacs_by_dates($_POST['fnext_vac'], $_POST['snext_vac']);
                  $counter   = 1;
                  while ($nvarry = mysqli_fetch_assoc($cls_set))
                  {
                    echo "<tr>";
                    echo "<td width='5%'>" . $counter . "</td>";
                    echo "<td width='10%'>" . $nvarry['next_vaccination'] . "</td>";
                    echo "<td width='10%'>" . $nvarry['p_name'] . "</td>";
                    echo "<td width='8%'>" . $nvarry['species'] . "</td>";
                    echo "<td width='8%'>" . $nvarry['gender'] . "</td>";
                    echo "<td width='15%'>" . $nvarry['ofname'] . "</td>";
                    echo "<td width='10%'>" . $nvarry['mobile'] . "</td>";
                    echo "<td width='20%'>" . $nvarry['c_name'] . "</td>";
                    echo "<td width='15%'>" . $nvarry['ufname'] . "</td>";
                    
                    $counter++;
                    echo "</tr>";
                  }
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
<script src="../petvet/scripts/reports/datatables-next_vac_reports.js" type="text/javascript"></script>
<?php include("../petvet/layouts/footer2.php"); ?>