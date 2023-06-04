<?php $tab_num = 1; $page_name = 'Owners'; ?>
<?php include "../petvet/layouts/header.php";?>
<?php confirm_logged_in(); ?>
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
          <i class="icon-users font-green"></i>
          <span class="caption-subject font-green bold uppercase"><?php echo $page_name; ?></span>
        </div>
      </div>
      <div class="portlet-body">

        <?php if($arr['view_p']=="Yes"){ ?>
        <?php if($arr['insert_p']=="Yes"){ ?>
        <div class="table-toolbar">
          <div class="row">
            <div class="col-md-12">
              <div class="btn-group">
                <button data-toggle="modal" href="#addmodal" class="btn yellow"> <i class="fa fa-plus"></i> Add Owner
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
              <th width="5%"> Prefix </th>
              <th width="20%"> Fullname </th>
              <th width="10%"> Mobile </th>
              <th width="15%"> Email </th>
              <th width="15%"> Address </th>
              <th width="15%"> Description </th>
              <th width="15%"> Actions </th>
            </tr>
          </thead>
          <tbody>
            <?php
            $class_set = get_owners();
            $counter   = 1;
            while ($aset = mysqli_fetch_assoc($class_set))
            {
              echo "<tr>";
              echo "<td width='5%'>" . $counter . "</td>";
              echo "<td width='5%'>" . $aset['prefix'] . "</td>";
              echo "<td width='20%'>" . $aset['fullname'] . "</td>";
              echo "<td width='10%'>" . $aset['mobile'] . "</td>";
              echo "<td width='15%'>" . $aset['email'] . "</td>";
              echo "<td width='15%'>" . $aset['address'] . "</td>";
              echo "<td width='15%'>" . $aset['description'] . "</td>";
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
        <h4 class="modal-title">Add Owner</h4>
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
                    <label class="control-label col-md-3">Prefix
                    </label>
                    <div class="col-md-3">
                      <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control" id="aprefix" name="aprefix">
                          <option>Mr.</option>
                          <option>Mrs.</option>
                          <option>Ms.</option>
                          <option>Miss</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Fullname</label>
                    <div class="col-md-6">
                      <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" id="afullname" name="afullname" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Mobile
                    </label>
                    <div class="col-md-5">
                      <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" id="amobile" name="amobile" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Email
                    </label>
                    <div class="col-md-5">
                      <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" id="aemail" name="aemail" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Address
                    </label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="aaddress" name="aaddress" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Description
                    </label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="adescription" name="adescription" />
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-offset-4 col-md-8">
                      <button type="submit" class="btn green" >Save</button>
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
        <h4 class="modal-title">Edit Owner</h4>
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

                  <input type="hidden" id="updateOwnerID" name="updateOwnerID" />
                  <div class="form-group">
                    <label class="control-label col-md-3">Prefix</label>
                    <div class="col-md-3">
                      <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control" id="eprefix" name="eprefix">
                          <option>Mr.</option>
                          <option>Mrs.</option>
                          <option>Ms.</option>
                          <option>Miss</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Fullname</label>
                    <div class="col-md-7">
                      <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" id="efullname" name="efullname" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Mobile</label>
                    <div class="col-md-5">
                      <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" id="emobile" name="emobile" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Email
                    </label>
                    <div class="col-md-5">
                      <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" id="eemail" name="eemail" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Address
                    </label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="eaddress" name="eaddress" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Description
                    </label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="edescription" name="edescription" />
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
<div id="viewmodal" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">View Owner</h4>
      </div>
      <div class="modal-body">
        <div class="scroller" style="height:100%" data-always-visible="1" data-rail-visible1="1">
          <div class="row">
            <div class="col-md-12">
              <form class="form-horizontal" role="form">
                <div class="form-group">
                  <label class="control-label col-md-3">Prefix</label>
                  <div class="col-md-8">
                    <p class="form-control-static" id="vprefix" name="vprefix"> </p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Fullname</label>
                  <div class="col-md-8">
                    <p class="form-control-static" id="vfullname" name="vfullname"> </p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Mobile</label>
                  <div class="col-md-8">
                    <p class="form-control-static" id="vmobile" name="vmobile"> </p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Email</label>
                  <div class="col-md-8">
                    <p class="form-control-static" id="vemail" name="vemail"> </p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Address</label>
                  <div class="col-md-8">
                    <p class="form-control-static" id="vaddress" name="vaddress"> </p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Description</label>
                  <div class="col-md-8">
                    <p class="form-control-static" id="vdescription" name="vdescription"> </p>
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
        <h4 class="modal-title">Delete Owner</h4>
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
                  <input type="hidden" id="deleteOwnerID" name="deleteOwnerID" />
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label col-md-8">Do you want to delete this owner?
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

<script src="../petvet/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="../petvet/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>

<script src="../petvet/scripts/owners/datatables-owners.js" type="text/javascript"></script>
<script src="../petvet/scripts/owners/crud-owners.js" type="text/javascript"></script>
<script src="../petvet/scripts/owners/view-owners.js" type="text/javascript"></script>

<?php include("../petvet/layouts/footer2.php"); ?>