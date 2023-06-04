<?php $tab_num = 3; $page_name = 'Categories'; ?>
<?php include "../petvet/layouts/header.php";?>
<?php confirm_logged_in(); ?>
<?php if (isset($_SESSION["p_user_id"])){ ?>

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
                    <i class="icon-tag font-green"></i>
                    <span class="caption-subject font-green bold uppercase"><?php echo $page_name; ?></span>
                </div>
            </div>
            <div class="portlet-body">

              <?php if($arr != 0 &&$arr['view_p']=="Yes"){ ?>
                <?php if($arr['insert_p']=="Yes"){ ?>
                <div class="table-toolbar">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="btn-group">
                        <button data-toggle="modal" href="#addmodal" class="btn yellow"> <i class="fa fa-plus"></i> Add Category
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
                      <th width="35%"> Name </th>
                      <th width="45%"> Description </th>
                      <th width="15%"> Actions </th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    $class_set = get_categories();
                    $counter   = 1;

                    while ($aset = mysqli_fetch_assoc($class_set))
                    {
                      echo "<tr>";
                      echo "<td width='5%'>" . $counter . "</td>";
                      echo "<td width='35%'>" . $aset['c_name'] . "</td>";
                      echo "<td width='45%'>" . $aset['description'] . "</td>";
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

<?php } else { ?>

<h1 class="page-title"> Please Sign in to view</h1>
<div class="note note-danger"><p> You need to sign in in order to view, add, delete records! </p></div>

<?php } ?>

<div id="addmodal" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add Category</h4>
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
                    <label class="control-label col-md-3">Name
                    </label>
                    <div class="col-md-6">
                      <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" id="aname" name="aname" />
                      </div>
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
        <h4 class="modal-title">Edit Category</h4>
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

                <input type="hidden" id="updateCategoryID" name="updateCategoryID" />

                <div class="form-group">
                  <label class="control-label col-md-3">Name</label>
                  <div class="col-md-7">
                    <div class="input-icon right">
                      <i class="fa"></i>
                      <input type="text" class="form-control" id="ename" name="ename" />
                    </div>
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
        <h4 class="modal-title">View Category</h4>
      </div>
      <div class="modal-body">
        <div class="scroller" style="height:100%" data-always-visible="1" data-rail-visible1="1">
          <div class="row">
            <div class="col-md-12">
              <form class="form-horizontal" role="form">

                <div class="form-group">
                  <label class="control-label col-md-3">Name</label>
                  <div class="col-md-8">
                    <p class="form-control-static" id="vname" name="vname"> </p>
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
        <h4 class="modal-title">Delete Category</h4>
      </div>
      <div class="modal-body">
        <div class="scroller" style="height:100%" data-always-visible="1" data-rail-visible1="1">
          <div class="row">
            <div class="col-md-12">
              <form action="#" class="form-horizontal" id="form_delete">
                <div class="form-body">
                  <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button> 
                    Category might be in use! Please take action.
                  </div>
                  <div class="alert alert-success display-hide">
                    <button class="close" data-close="alert"></button>
                    Data deleted successfully
                  </div>
                  <input type="hidden" id="deleteCategoryID" name="deleteCategoryID" />
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label col-md-8">Do you want to delete this category?
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

<script src="../petvet/scripts/categories/datatables-categories.js" type="text/javascript"></script>
<script src="../petvet/scripts/categories/crud-categories.js" type="text/javascript"></script>
<script src="../petvet/scripts/categories/view-categories.js" type="text/javascript"></script>

<?php include("../petvet/layouts/footer2.php"); ?>
