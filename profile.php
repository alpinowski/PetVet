<?php include "../petvet/layouts/header.php";?>
<?php confirm_logged_in(); ?>

<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit ">

      <div class="portlet-title">
        <div class="caption">
          <i class="icon-key  font-green"></i>
          <span class="caption-subject font-green bold uppercase">Change Password</span>
        </div>
      </div>

      <div class="portlet-body">
        <div class="table-toolbar">
          <div class="row">          	
              <div class="col-md-8">
              <form  class="form-horizontal change_password-form" action="login.php" method="post">
                <div class="form-body">
                  	<div class="alert alert-danger display-hide">
                    	<button class="close" data-close="alert"></button>
                    	<span> Passwords doesn't match </span>
                	</div>

					<div class="form-group">
                    	<label class="control-label col-md-2">New Password</label>
                    	<div class="col-md-4">
	                    	<div class="input-icon right">
	                        	<i class="fa"></i> 
	                        	<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="New Password" name="npassword" id="npassword" />
	                    	</div>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-md-2">Repeat Password</label>
	                    <div class="col-md-4">
		                    <div class="input-icon right">
		                        <i class="fa"></i> 
		                        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Repeat Password" name="rpassword" id="rpassword" />
		                    </div>
	                	</div>
	                </div>
                </div>
                <div class="form-actions">
                	<div class="form-actions">
	                	<button type="submit" class="btn green uppercase">Change Password</button>
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
</div>

<?php include("../petvet/layouts/footer1.php"); ?>
<script src="../petvet/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="../petvet/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>

<script src="../petvet/scripts/change_password.js" type="text/javascript"></script>
<?php include("../petvet/layouts/footer2.php"); ?>
