<?php $tab_num = 5; $page_name = 'Privileges'; ?>
<?php include "../petvet/layouts/header.php";?>
<?php confirm_logged_in(); ?>
<?php
  if (isset($_POST['submitBtn']))
  {
    if(get_user_id($_POST['search_input']) != 0)
    {
      $_SESSION['user_name'] = $_POST['search_input'];
      $_SESSION['user_id'] = get_user_id($_POST['search_input']);
    }
  }
?>
<?php 
  $user_id = $_SESSION['p_user_id'];
  $cls_set = get_crud_by_user_id($user_id, $page_name);
  $arr = 0;
  if(mysqli_num_rows($cls_set) > 0)
    $arr = mysqli_fetch_assoc($cls_set)
?>

<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit ">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-users font-green"></i>
          <span class="caption-subject font-green bold uppercase"><?php echo $page_name; ?></span>
        </div>
      </div>
      <div class="portlet-body">
        <?php if($arr != 0 &&$arr['view_p']=="Yes"){ ?>

        <form class="form-inline" role="form" method="post" enctype="multipart/form-data" action="privilege.php">
          <div class="form-group">
            <label class="control-label">User Name: </label>
            <div class="input-group">
              <input class="form-control input-large" id="search_input" name="search_input" value="<?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name'];} ?>">
            </div>
          </div>
          <button type="submit" class="btn red btn-outline" id="submitBtn" name="submitBtn">Search</button>
        </form>
        <p class="help-block"> E.g: Alp, Gokcen </p>
        <br>
        <?php if($arr['insert_p']=="Yes"){ ?>
        <div class="table-toolbar">
          <div class="row">
            <div class="col-md-12">
              <div class="btn-group">
                <button data-toggle="modal" href="#addmodal" class="btn yellow"> <i class="fa fa-plus"></i> Add Privilege
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
              <th width="15%"> Page Name </th>
              <th width="15%"> View </th>
              <th width="15%"> Insert </th>
              <th width="15%"> Update </th>
              <th width="15%"> Delete </th>          
              <th width="15%"> Actions </th>
            </tr>
          </thead>
          <tbody>
            <?php
              if(isset($_SESSION['user_id']))
              {
                $class_set = get_privileges_by_user_id($_SESSION['user_id']);
                $counter   = 1;
                while ($aset = mysqli_fetch_assoc($class_set))
                {
                  echo "<tr>";
                  echo "<td width='5%'>" . $counter . "</td>";
                  echo "<td width='15%'>" . $aset['p_name'] . "</td>";
                  echo "<td width='15%'>" . $aset['view_p'] . "</td>";
                  echo "<td width='15%'>" . $aset['insert_p'] . "</td>";
                  echo "<td width='15%'>" . $aset['update_p'] . "</td>";
                  echo "<td width='15%'>" . $aset['delete_p'] . "</td>";

                  echo '<td width="15%">';
                  if($arr['update_p']=="Yes"){
                  echo '<a data-toggle="modal" data-classid="' . $aset['ID'] . '" href="#updatemodal" class="edit btn btn-icon-only blue" href="javascript:;"><i class="fa fa-edit"></i></a>';
                  }

                  if($arr['delete_p']=="Yes"){
                    echo '<a data-toggle="modal" data-dclassid="' . $aset['ID'] . '" href="#deletemodal" class="delete btn btn-icon-only red" href="javascript:;"><i class="fa fa-trash"></i></a>';
                  }
                  echo '</td>';

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
        <h4 class="modal-title">Add Privilege</h4>
      </div>
      <div class="modal-body">
        <div class="scroller" style="height:100%" data-always-visible="1" data-rail-visible1="1">
          <div class="row">
            <div class="col-md-12">
              <form action="#" class="form-horizontal" id="form_add">
                <div class="form-body">
                  <div class="alert alert-danger display-hide">
                  <button class="close" data-close="alert"></button> Please fix the errors </div>
                  <div class="alert alert-success display-hide">
                  <button class="close" data-close="alert"></button> Data saved successfully </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3">Page Name</label>
                    <div class="col-md-6">
                      <select class="form-control" id="ap_name" name="ap_name">
                        <option>Categories</option>
                        <option>Privileges</option>
                        <option>Owners</option>
                        <option>Roles</option>
                        <option>Pets</option>
                        <option>Tests</option>
                        <option>Test Report</option>
                        <option>Next Vaccination Report</option>
                        <option>Owner's Test Vaccination Report</option>
                        <option>Users</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">View
                    </label>
                    <div class="col-md-3">
                        <select class="form-control" id="aview" name="aview">
                          <option>Yes</option>
                          <option>No</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Insert
                    </label>
                    <div class="col-md-3">
                      <select class="form-control" id="ainsert" name="ainsert">
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Update
                    </label>
                    <div class="col-md-3">
                      <select class="form-control" id="aupdate" name="aupdate">
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Delete
                    </label>
                    <div class="col-md-3">
                      <select class="form-control" id="adelete" name="adelete">
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-actions">
                    <div class="row">
                      <div class="col-md-offset-3 col-md-10">
                        <button type="submit" class="btn green" >Save</button>
                        <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancel</button>
                      </div>
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
        <h4 class="modal-title">Edit Privilege</h4>
      </div>
      <div class="modal-body">
        <div class="scroller" style="height:100%" data-always-visible="1" data-rail-visible1="1">
          <div class="row">
            <div class="col-md-12">
              <form class="form-horizontal" role="form" id="form_update">
                <div class="form-body">
                  <div class="alert alert-danger display-hide">
                  <button class="close" data-close="alert"></button> Please fix the errors </div>
                  <div class="alert alert-success display-hide">
                  <button class="close" data-close="alert"></button> Data saved successfully </div>
                  <input type="hidden" id="updatePrivilegeID" name="updatePrivilegeID" />

                  <div class="form-group">
                    <label class="control-label col-md-3">Page Name</label>
                    <div class="col-md-6">
                      <select class="form-control" id="ep_name" name="ep_name">
                        <option>Categories</option>
                        <option>Privileges</option>
                        <option>Owners</option>
                        <option>Roles</option>
                        <option>Pets</option>
                        <option>Tests</option>
                        <option>Test Report</option>
                        <option>Next Vaccination Report</option>
                        <option>Owner's Test Vaccination Report</option>
                        <option>Users</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">View
                    </label>
                    <div class="col-md-3">
                      <select class="form-control" id="eview" name="eview">
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Insert
                    </label>
                    <div class="col-md-3">
                      <select class="form-control" id="einsert" name="einsert">
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Update
                    </label>
                    <div class="col-md-3">
                      <select class="form-control" id="eupdate" name="eupdate">
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Delete
                    </label>
                    <div class="col-md-3">
                      <select class="form-control" id="edelete" name="edelete">
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </div>
                  </div>

                </div>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-offset-4 col-md-8">
                      <button type="submit" class="btn green" >Update</button>
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
<div id="deletemodal" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Delete Privilege</h4>
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
                  <input type="hidden" id="deletePrivilegeID" name="deletePrivilegeID" />
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label col-md-8">Do you want to delete this Privilege?
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-offset-2 col-md-10">
                      <button type="submit" class="btn green" >Yes</button>
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

<script src="../petvet/scripts/privileges/autocomplete-privilege.js" type="text/javascript"></script>

<script src="../petvet/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="../petvet/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="../petvet/scripts/privileges/datatables-privileges.js" type="text/javascript"></script>
<script src="../petvet/scripts/privileges/crud-privileges.js" type="text/javascript"></script>
<script src="../petvet/scripts/privileges/view-privileges.js" type="text/javascript"></script>
<?php include("../petvet/layouts/footer2.php"); ?>