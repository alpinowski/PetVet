<?php $tab_num = 3; $page_name = 'Tests'; ?>
<?php include "../petvet/layouts/header.php";?>
<?php confirm_logged_in(); ?>
<?php
  if (isset($_POST['submitBtn']))
  {
    if(get_pet_id($_POST['search_input']) != 0)
    { 
      $_SESSION['pet_name'] = $_POST['search_input'];
      $_SESSION['pet_id'] = get_pet_id($_POST['search_input']);
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
    <div class="portlet light portlet-fit ">
      <div class="portlet-title">
        <div class="caption">
          <i class="icon-layers font-green"></i>
          <span class="caption-subject font-green bold uppercase"><?php echo $page_name; ?></span>
        </div>
      </div>
      <div class="portlet-body">
        <?php if($arr['view_p']=="Yes"){ ?>
        
        <form class="form-inline" role="form" method="post" enctype="multipart/form-data" action="test.php">
          <?php /*if($arr['insert']=="Yes"){*/ ?>
          <div class="form-group">
            <label class="control-label">Pet name: </label>
            <div class="input-group">
              <input class="form-control input-large" id="search_input" name="search_input" value="<?php if(isset($_SESSION['pet_name'])){ echo $_SESSION['pet_name'];} ?>">
            </div>
          </div>
          <button type="submit" class="btn red btn-outline" id="submitBtn" name="submitBtn">Search</button>
        </form>
        <p class="help-block"> E.g: Charly, Mr. Betills </p>
        <br>
         <?php if($arr['insert_p']=="Yes"){ ?>
        <div class="table-toolbar">
          <div class="row">
            <div class="col-md-12">
              <div class="btn-group">
                <button data-toggle="modal" href="#addmodal" class="btn yellow"> <i class="fa fa-plus"></i> Add Test
                </button>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
          <thead>
            <tr>
              <th width="5%"> No </th>
              <th width="20%"> Date </th>
              <th width="20%"> Vaccine Label </th>
              <th width="20%"> Barcode </th>
              <th width="20%"> Next Vaccination </th>
              <th width="15%"> Actions </th>
            </tr>
          </thead>
          <tbody>
            <?php
              if(isset($_SESSION['pet_id']))
              {
                $class_set = get_tests_by_pet_id($_SESSION['pet_id']);
                $counter   = 1;
                while ($aset = mysqli_fetch_assoc($class_set))
                {
                  echo "<tr>";
                  echo "<td width='5%'>" . $counter . "</td>";
                  echo "<td width='20%'>" . $aset['t_date'] . "</td>";
                  echo "<td width='20%'>" . $aset['vaccine_label'] . "</td>";
                  echo "<td width='20%'>" . $aset['barcode'] . "</td>";
                  echo "<td width='20%'>" . $aset['next_vaccination'] . "</td>";
                  echo '<td width="15%"><a data-toggle="modal" data-vclassid="' . $aset['ID'] . '" href="#viewmodal" class="view btn btn-icon-only green" href="javascript:;"><i class="fa fa-eye"></i></a>';
                  
                  if($arr['update_p']=="Yes"){
                  echo '<a data-toggle="modal" data-classid="' . $aset['ID'] . '" href="#updatemodal" class="edit btn btn-icon-only blue" href="javascript:;"><i class="fa fa-edit"></i></a>';
                  }

                  if($arr['delete_p']=="Yes"){
                    echo '<a data-toggle="modal" data-dclassid="' . $aset['ID'] . '" href="#deletemodal" class="delete btn btn-icon-only red" href="javascript:;"><i class="fa fa-trash"></i></a></td>';
                  }

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
<div id="addmodal" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add Test</h4>
      </div>
      <div class="modal-body">
        <div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">
          <div class="row">
            <div class="col-md-12">
              <form action="#" class="form-horizontal" id="form_add">
                <div class="form-body">
                  <div class="alert alert-danger display-hide">
                  <button class="close" data-close="alert"></button> Please fix the errors </div>
                  <div class="alert alert-success display-hide">
                  <button class="close" data-close="alert"></button> Data saved successfully </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">Date</label>
                    <div class="col-md-4">
                        <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                          <input class="form-control" readonly="" aria-required="true" aria-invalid="false" aria-describedby="datepicker-error" type="text" id="adate" name="adate">
                          <span class="input-group-btn">
                              <button class="btn default" type="button">
                                  <i class="fa fa-calendar"></i>
                              </button>
                          </span>
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">Vaccine Label
                    </label>
                    <div class="col-md-3">
                      <div class="input-icon right">
                        <i class="fa"></i>
                      <input type="text" class="form-control" id="avac_lab" name="avac_lab" />
                    </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">Barcode
                    </label>
                    <div class="col-md-3">
                      <div class="input-icon right">
                        <i class="fa"></i>
                      <input type="text" class="form-control" id="abarcode" name="abarcode" />
                    </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">Next Vaccination</label>
                    <div class="col-md-4">
                        <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                          <input class="form-control" readonly="" aria-required="true" aria-invalid="false" aria-describedby="datepicker-error" type="text" id="anext_vac" name="anext_vac">
                          <span class="input-group-btn">
                              <button class="btn default" type="button">
                                  <i class="fa fa-calendar"></i>
                              </button>
                          </span>
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">Category</label>
                    <div class="col-md-6">
                      <select class="form-control" id="acategory" name="acategory">
                        <?php
                        $class_set = get_categories();
                        while ($aset = mysqli_fetch_assoc($class_set))
                        { echo "<option value=" . $aset['ID'] .">" . $aset['c_name'] . "</option>"; }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-offset-4 col-md-8">
                      <button type="submit" class="btn green">Save</button>
                      <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancel</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="updatemodal" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Test</h4>
      </div>
      <div class="modal-body">
        <div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">
          <div class="row">
            <div class="col-md-12">
              <form class="form-horizontal" role="form" id="form_update">
                <div class="form-body">
                  <div class="alert alert-danger display-hide">
                  <button class="close" data-close="alert"></button> Please fix the errors </div>
                  <div class="alert alert-success display-hide">
                  <button class="close" data-close="alert"></button> Data saved successfully </div>
                  <input type="hidden" id="updateTestID" name="updateTestID" />

                  <div class="form-group">
                    <label class="control-label col-md-4">Date</label>
                    <div class="col-md-4">
                        <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                          <input class="form-control" readonly="" aria-required="true" aria-invalid="false" aria-describedby="datepicker-error" type="text" id="edate" name="edate">
                          <span class="input-group-btn">
                              <button class="btn default" type="button">
                                  <i class="fa fa-calendar"></i>
                              </button>
                          </span>
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">Vaccine Label
                    </label>
                    <div class="col-md-3">
                      <input type="text" class="form-control" id="evac_lab" name="evac_lab" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">Barcode
                    </label>
                    <div class="col-md-3">
                      <input type="text" class="form-control" id="ebarcode" name="ebarcode" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">Next Vaccination</label>
                    <div class="col-md-4">
                        <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                          <input class="form-control" readonly="" aria-required="true" aria-invalid="false" aria-describedby="datepicker-error" type="text" id="enext_vac" name="enext_vac">
                          <span class="input-group-btn">
                              <button class="btn default" type="button">
                                  <i class="fa fa-calendar"></i>
                              </button>
                          </span>
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">Category</label>
                    <div class="col-md-6">
                      <select class="form-control" id="ecategory" name="ecategory">
                        <?php
                        $class_set = get_categories();
                        while ($aset = mysqli_fetch_assoc($class_set))
                        { echo "<option value=" . $aset['ID'] .">" . $aset['c_name'] . "</option>"; }
                        ?>
                      </select>
                    </div>
                  </div>
                
                </div>
              </div>
            </div>
            <div class="form-actions">
              <div class="row">
                <div class="col-md-offset-4 col-md-8">
                  <button type="submit" class="btn green">Update</button>
                  <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancel</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<div id="viewmodal" class="modal fade" tabindex="-1" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">View Test</h4>
  </div>
  <div class="modal-body">
    <div class="scroller" style="height:100%" data-always-visible="1" data-rail-visible1="1">
      <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" role="form">
            <div class="form-group">
              <label class="control-label col-md-4">Date</label>
              <div class="col-md-4">
                <p class="form-control-static" id="vdate" name="vdate"> </p>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Vaccine Label</label>
              <div class="col-md-6">
                <p class="form-control-static" id="vvac_lab" name="vvac_lab"> </p>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Barcode</label>
              <div class="col-md-6">
                <p class="form-control-static" id="vbarcode" name="vbarcode"> </p>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Next Vaccination</label>
              <div class="col-md-4">
                <p class="form-control-static" id="vnext_vac" name="vnext_vac"> </p>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Category</label>
              <div class="col-md-8">
                <p class="form-control-static" id="vcategory" name="vcategory"> </p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<div id="deletemodal" class="modal fade" tabindex="-1" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Delete Test</h4>
  </div>
  <div class="modal-body">
    <div class="scroller" style="height:100%" data-always-visible="1" data-rail-visible1="1">
      <div class="row">
        <div class="col-md-12">
          <form action="#" class="form-horizontal" id="form_delete">
            <div class="form-body">
              <div class="alert alert-danger display-hide">
              <button class="close" data-close="alert"></button> Please fix the errors </div>
              <div class="alert alert-success display-hide">
              <button class="close" data-close="alert"></button> Data deleted successfully </div>
              <input type="hidden" id="deleteTestID" name="deleteTestID" />
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label col-md-8">Do you want to delete this test?
                  </label>
                </div>
              </div>
            </div>
            <div class="form-actions">
              <div class="row">
                <div class="col-md-offset-2 col-md-10">
                  <button type="submit" class="btn red">Yes</button>
                  <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancel</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
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
<script src="../petvet/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

<script src="../petvet/scripts/pets/autocomplete-pets.js" type="text/javascript"></script>

<script src="../petvet/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="../petvet/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="../petvet/scripts/tests/datatables-tests.js" type="text/javascript"></script>
<script src="../petvet/scripts/tests/crud-tests.js" type="text/javascript"></script>
<script src="../petvet/scripts/tests/view-tests.js" type="text/javascript"></script>
<?php include("../petvet/layouts/footer2.php"); ?>