<?php $tab_num = 2; $page_name = 'Pets'; ?>
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
  $arr = 0;
  if(mysqli_num_rows($cls_set) > 0)
    $arr = mysqli_fetch_assoc($cls_set)
?>

<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit ">
      <div class="portlet-title">
        <div class="caption">
          <i class="icon-eye font-green"></i>
          <span class="caption-subject font-green bold uppercase"><?php echo $page_name; ?></span>
        </div>
      </div>
      <div class="portlet-body">

        <?php if($arr != 0 &&$arr['view_p']=="Yes"){ ?>

        <form class="form-inline" role="form" method="post" enctype="multipart/form-data" action="pet.php">
          <div class="form-group">
            <label class="control-label">Owner Fullname: </label>
            <div class="input-group">
              <input class="form-control input-large" id="search_input" name="search_input" value="<?php if(isset($_SESSION['owner_fullname'])){ echo $_SESSION['owner_fullname'];} ?>">
            </div>
          </div>
          <button type="submit" class="btn red btn-outline" id="submitBtn" name="submitBtn">Search</button>
        </form>
        <?php if($arr['insert_p']=="Yes"){ ?>
        <div class="table-toolbar">
          <div class="row">
            <div class="col-md-12">
              <div class="btn-group">
                <button data-toggle="modal" href="#addmodal" class="btn yellow"> <i class="fa fa-plus"></i> Add Pet
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
              <th width="10%"> Name </th>
              <th width="8%"> Birthday </th>
              <th width="10%"> Gender </th>
              <th width="10%"> Species </th>
              <th width="15%"> Breed </th>
              <th width="15%"> Coat Color </th>
              <th width="8%"> Date Inserted </th>
              <th width="15%"> Actions </th>
            </tr>
          </thead>
          <tbody>
            <?php
              if(isset($_SESSION['owner_id']))
              {
                $class_set = get_pets_by_owner_id($_SESSION['owner_id']);
                $counter   = 1;
                while ($aset = mysqli_fetch_assoc($class_set))
                {
                  echo "<tr>";
                  echo "<td width='5%'>" . $counter . "</td>";
                  echo "<td width='10%'>" . $aset['p_name'] . "</td>";
                  echo "<td width='8%'>" . $aset['birthdate'] . "</td>";
                  echo "<td width='10%'>" . $aset['gender'] . "</td>";
                  echo "<td width='10%'>" . $aset['species'] . "</td>";
                  echo "<td width='15%'>" . $aset['breed'] . "</td>";
                  echo "<td width='15%'>" . $aset['coat_color'] . "</td>";
                  echo "<td width='8%'>" . $aset['inserted_date'] . "</td>";
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
<div id="addmodal" class="modal fade bs-modal-lg" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add Pet</h4>
      </div>
      <div class="modal-body">
        <div class="scroller" style="height:500px" data-always-visible="1" data-rail-visible1="1">
          <div class="row">
            <div class="col-md-6">
              <form action="#" class="form-horizontal" id="form_add">
                <div class="form-body">
                  <div class="alert alert-danger display-hide">
                  <button class="close" data-close="alert"></button> Please fix the errors </div>
                  <div class="alert alert-success display-hide">
                  <button class="close" data-close="alert"></button> Data saved successfully </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-5">Name</label>
                    <div class="col-md-5">
                      <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" id="ap_name" name="ap_name" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5">Birthday</label>
                    <div class="col-md-5">
                        <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                            <input class="form-control" readonly="" aria-required="true" aria-invalid="false" aria-describedby="datepicker-error" type="text" id="abirthdate" name="abirthdate" value="<?php echo date('Y-m-d'); ?>">
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5">Gender
                    </label>
                    <div class="col-md-3">
                      <select class="form-control" id="agender" name="agender">
                        <option>Male</option>
                        <option>Female</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5">Species
                    </label>
                    <div class="col-md-4">
                      <input type="text" class="form-control" id="aspecies" name="aspecies" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5">Breed
                    </label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="abreed" name="abreed" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5">Coat Color
                    </label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="acoat_color" name="acoat_color" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5">Microchip Number
                    </label>
                    <div class="col-md-4">
                      <div class="input-icon right">
                        <i class="fa"></i> 
                        <input class="form-control" type="text" id="amicro_num" name="amicro_num">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5">Microchip Date
                    </label>
                    <div class="col-md-5">
                      <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                        <input class="form-control" readonly="" aria-required="true" aria-invalid="false" aria-describedby="datepicker-error" type="text" id="amicro_date" name="amicro_date">
                        <span class="input-group-btn">
                            <button class="btn default" type="button">
                                <i class="fa fa-calendar"></i>
                            </button>
                        </span>
                      </div>
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
            <div class="col-md-6">
              <form action="#" class="form-horizontal" id="form_add">
                <div class="form-body">

                  <div class="form-group">
                    <label class="control-label col-md-3">Rabies</label>
                    <div class="col-md-3">
                      <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="input-group input-small">
                            <div class="form-control input-fixed input-small" data-trigger="fileinput">
                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                <span class="fileinput-filename"> </span>
                            </div>
                            <span class="input-group-addon btn default btn-file">
                                <span class="fileinput-new"> Select file </span>
                                <span class="fileinput-exists"> Change </span>
                                <input type="hidden"><input name="arabies" id="arabies" type="file"> </span>
                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Result</label>
                    <div class="col-md-3">
                      <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="input-group input-small">
                            <div class="form-control input-fixed input-small" data-trigger="fileinput">
                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                <span class="fileinput-filename"> </span>
                            </div>
                            <span class="input-group-addon btn default btn-file">
                                <span class="fileinput-new"> Select file </span>
                                <span class="fileinput-exists"> Change </span>
                                <input type="hidden"><input name="aresult" id="aresult" type="file"> </span>
                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Reference Lab</label>
                    <div class="col-md-6">
                      <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" id="aref_lab" name="aref_lab" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Health Certificate</label>
                    <div class="col-md-6">
                      <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" id="ahealth_cer" name="ahealth_cer" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Photo</label>
                    <div class="col-md-8">
                      <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 170px; height: 135px;">
                        <img src="../petvet/images/noimage.png" alt="" id="avphoto" name="avphoto" /> </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 170px; max-height: 135px;"> </div>
                        <div>
                          <span class="btn default btn-file">
                            <span class="fileinput-new"> Select image </span>
                            <span class="fileinput-exists"> Change </span>
                            <input type="file" name="aphoto" id="aphoto" accept="image/jpeg, image/jpg" />
                          </span>
                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                          </div>
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
<div id="updatemodal" class="modal fade bs-modal-lg" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Pet</h4>
      </div>
      <div class="modal-body">
        <div class="scroller" style="height:500px" data-always-visible="1" data-rail-visible1="1">
          <div class="row">
            <div class="col-md-6">
              <form class="form-horizontal" role="form" id="form_update">
                <div class="form-body">
                  <div class="alert alert-danger display-hide">
                  <button class="close" data-close="alert"></button> Please fix the errors </div>
                  <div class="alert alert-success display-hide">
                  <button class="close" data-close="alert"></button> Data saved successfully </div>

                  <input type="hidden" id="updatePetID" name="updatePetID" />

                  <div class="form-group">
                    <label class="control-label col-md-5">Name</label>
                    <div class="col-md-5">
                      <div class="input-icon right">
                      <i class="fa"></i>
                      <input type="text" class="form-control" id="ep_name" name="ep_name" />
                    </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5">Birthday</label>
                    <div class="col-md-5">
                      <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                          <input class="form-control" readonly="" aria-required="true" aria-invalid="false" aria-describedby="datepicker-error" type="text" id="ebirthdate" name="ebirthdate">
                          <span class="input-group-btn">
                            <button class="btn default" type="button">
                                <i class="fa fa-calendar"></i>
                            </button>
                          </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5">Gender
                    </label>
                    <div class="col-md-3">
                      <select class="form-control" id="egender" name="egender">
                        <option>Male</option>
                        <option>Female</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5">Species</label>
                    <div class="col-md-4">
                      <input type="text" class="form-control" id="especies" name="especies" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5">Breed
                    </label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="ebreed" name="ebreed" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5">Coat Color
                    </label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="ecoat_color" name="ecoat_color" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5">Microchip Number
                    </label>
                    <div class="col-md-4">
                      <div class="input-icon right">
                      <i class="fa"></i>
                      <input class="form-control" type="text" id="emicro_num" name="emicro_num">
                    </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-5">Microchip Date</label>
                    <div class="col-md-5">
                      <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                        <input class="form-control" readonly="" aria-required="true" aria-invalid="false" aria-describedby="datepicker-error" type="text" id="emicro_date" name="emicro_date">
                        <span class="input-group-btn">
                            <button class="btn default" type="button">
                                <i class="fa fa-calendar"></i>
                            </button>
                        </span>
                      </div>
                    </div>
                  </div>                   
                </div>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-offset-4 col-md-10">
                      <button type="submit" class="btn green" >Update</button>
                      <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancel</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <div class="col-md-6">
              <form class="form-horizontal" role="form" id="form_update">
                <div class="form-body">
                                      <div class="form-group">
                  <label class="control-label col-md-3">Rabies</label>
                  <div class="col-md-3">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="input-group input-small">
                          <div class="form-control input-fixed input-small" data-trigger="fileinput">
                              <i class="fa fa-file fileinput-exists"></i>&nbsp;
                              <span class="fileinput-filename"> </span>
                          </div>
                          <span class="input-group-addon btn default btn-file">
                              <span class="fileinput-new"> Select file </span>
                              <span class="fileinput-exists"> Change </span>
                              <input type="hidden"><input name="erabies" id="erabies" type="file"> </span>
                          <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Result</label>
                  <div class="col-md-3">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="input-group input-small">
                          <div class="form-control input-fixed input-small" data-trigger="fileinput">
                              <i class="fa fa-file fileinput-exists"></i>&nbsp;
                              <span class="fileinput-filename"> </span>
                          </div>
                          <span class="input-group-addon btn default btn-file">
                              <span class="fileinput-new"> Select file </span>
                              <span class="fileinput-exists"> Change </span>
                              <input type="hidden"><input name="eresult" id="eresult" type="file"> </span>
                          <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                      </div>
                    </div>
                  </div>
                </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Reference Lab
                    </label>
                    <div class="col-md-6">
                      <div class="input-icon right">
                      <i class="fa"></i>
                      <input type="text" class="form-control" id="eref_lab" name="eref_lab" />
                    </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Health Certificate
                    </label>
                    <div class="col-md-6">
                      <div class="input-icon right">
                      <i class="fa"></i>
                      <input type="text" class="form-control" id="ehealth_cer" name="ehealth_cer" />
                    </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Photo</label>
                    <div class="col-md-8">
                      <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div class="fileinput-new thumbnail" style="width: 170px; height: 135px;">
                              <img src="" alt="" id="evphoto" name="evphoto" /> </div>
                          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 170px; max-height: 135px;"> </div>
                          <div>
                              <span class="btn default btn-file">
                                  <span class="fileinput-new"> Select image </span>
                                  <span class="fileinput-exists"> Change </span>
                                  <input type="file" name="ephoto" id="ephoto" accept="image/jpeg, image/jpg" />
                              </span>
                              <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                          </div>
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
<div id="viewmodal" class="modal fade bs-modal-lg" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">View Pet</h4>
      </div>
      <div class="modal-body">
        <div class="scroller" style="height:500px" data-always-visible="1" data-rail-visible1="1">
          <div class="row">
            <div class="col-md-6">
              <form class="form-horizontal" role="form">
                <div class="form-group">
                  <label class="control-label col-md-5">Photo</label>
                  <div class="col-md-4">
                    <img src="" id="vphoto" name="vphoto" alt="avatar" height="170" width="135" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-5">Name</label>
                  <div class="col-md-4">
                    <p class="form-control-static" id="vp_name" name="vp_name"> </p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-5">Birthday</label>
                  <div class="col-md-4">
                    <p class="form-control-static" id="vbirthdate" name="vbirthdate"> </p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-5">Gender</label>
                  <div class="col-md-4">
                    <p class="form-control-static" id="vgender" name="vgender"> </p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-5">Species</label>
                  <div class="col-md-6">
                    <p class="form-control-static" id="vspecies" name="vspecies"> </p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-5">Breed</label>
                  <div class="col-md-6">
                    <p class="form-control-static" id="vbreed" name="vbreed"> </p>
                  </div>
                </div>
            
              </form>
            </div>

            <div class="col-md-6">
              <form class="form-horizontal" role="form">
                <div class="form-group">
                  <label class="control-label col-md-3">Coat Color</label>
                  <div class="col-md-6">
                    <p class="form-control-static" id="vcoat_color" name="vcoat_color"> </p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Microchip Number</label>
                  <div class="col-md-4">
                    <p class="form-control-static" id="vmicro_num" name="vmicro_num"> </p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Microchip date</label>
                  <div class="col-md-4">
                    <p class="form-control-static" id="vmicro_date" name="vmicro_date"> </p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Rabies</label>
                  <div class="col-md-6">
                    <a class="view2 btn btn-sm green" data-toggle="modal" href="#stack2"> VIEW </a>
                    <a target="_blank" id="vd_rabies" name="vd_rabiess" class="btn btn-sm blue"> DOWNLOAD </a>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Result</label>
                  <div class="col-md-6">
                    <a class="view3 btn btn-sm green" data-toggle="modal" href="#stack3"> VIEW </a>
                    <a target="_blank" id="vd_result" name="vd_result" class="btn btn-sm blue"> DOWNLOAD </a>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Reference Lab</label>
                  <div class="col-md-8">
                    <p class="form-control-static" id="vref_lab" name="vref_lab"> </p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Health Certificate</label>
                  <div class="col-md-6">
                    <p class="form-control-static" id="vhealth_cer" name="vhealth_cer"> </p>
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
        <h4 class="modal-title">Delete Pet</h4>
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
                  <input type="hidden" id="deletePetID" name="deletePetID" />
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label col-md-8">Do you want to delete the pet?</label>
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
<div id="stack2" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">File Preview</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <iframe id="vrabies" name="vrabies" src="" width="100%" height="500px"></iframe>
                        <input type="hidden" id="chargo" name="chargo" /> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="stack3" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">File Preview</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <iframe id="vresult" name="vresult" src="" width="100%" height="500px"></iframe>
                        <input type="hidden" id="chargo" name="chargo" /> 
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

<script src="../petvet/scripts/owners/autocomplete-owners.js" type="text/javascript"></script>

<script src="../petvet/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="../petvet/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="../petvet/scripts/pets/datatables-pets.js" type="text/javascript"></script>
<script src="../petvet/scripts/pets/crud-pets.js" type="text/javascript"></script>
<script src="../petvet/scripts/pets/view-pets.js" type="text/javascript"></script>
<?php include("../petvet/layouts/footer2.php"); ?>