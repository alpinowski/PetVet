<?php $tab_num = 6; $page_name = 'Test Report'; ?>
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
      </div>
      <div class="portlet-body">
        <?php if($arr != 0 &&$arr['view_p']=="Yes"){ ?>
        <table class="table table-striped table-bordered table-hover dataTable dtr-inline collapsed" id="sample_1">
          <thead>
            <tr>
              <th width="5%"> No </th>
              <th width="20%"> Pet Name </th>
              <th width="15%"> Species </th>
              <th width="8%"> Gender </th>
              <th width="50%"> Owner Fullname </th>
              <th width="50%"> Owner Mobile </th>
              <th width="20%"> Test Category </th>
              <th width="8%"> Test Date </th>
              <th width="10%"> Vaccination Label </th>
              <th width="10%"> Barcode </th>
              <th width="15%"> Next Vaccination </th>
              <th width="15%"> User Fullname </th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th width="5%"> No </th>
              <th width="20%"> Pet Name </th>
              <th width="15%"></th>
              <th width="8%"> Gender </th>
              <th width="50%"> Owner Fullname </th>
              <th width="50%"> Owner Mobile </th>
              <th width="20%"></th>
              <th width="8%"> Test Date </th>
              <th width="10%"> Vaccination Label </th>
              <th width="10%"> Barcode </th>
              <th width="15%"> Next Vaccination </th>
              <th width="15%"></th>
            </tr>
          </tfoot>
          <tbody>
            <?php
                $class_set = get_tests();
                $counter   = 1;
                while ($aset = mysqli_fetch_assoc($class_set))
                {
                  echo "<tr>";
                  echo "<td width='5%'>" . $counter . "</td>";
                  echo "<td width='20%'>" . $aset['p_name'] . "</td>";
                  echo "<td width='15%'>" . $aset['species'] . "</td>";
                  echo "<td width='8%'>" . $aset['gender'] . "</td>";
                  echo "<td width='50%'>" . $aset['ofname'] . "</td>";
                  echo "<td width='50%'>" . $aset['mobile'] . "</td>";
                  echo "<td width='20%'>" . $aset['c_name'] . "</td>";
                  echo "<td width='8%'>" . $aset['t_date'] . "</td>";
                  echo "<td width='10%'>" . $aset['vaccine_label'] . "</td>";
                  echo "<td width='10%'>" . $aset['barcode'] . "</td>";
                  echo "<td width='15%'>" . $aset['next_vaccination'] . "</td>";
                  echo "<td width='15%'>" . $aset['ufname'] . "</td>";
                
                $counter++;
                echo "</tr>";
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
<script src="../petvet/scripts/reports/datatables-test_reports.js" type="text/javascript"></script>
<?php include("../petvet/layouts/footer2.php"); ?>