<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    ?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>User Profile</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!--<?php echo validation_errors(); ?>-->
        <!--  <div class="x_content">-->
        <form class="form-horizontal form-label-left" method="POST" action="<?= site_url('user-profile/update') ?>" enctype="multipart/form-data" >
            <span class="section">Personal Info</span>
            <div class="item form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >UserName <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" class="form-control col-md-7 col-xs-12"  name="user_username" required="required"  value="<?php echo !empty(set_value('user_username')) ? set_value('user_username') : $record->user_username ?>">
                    <div style="color:red"><?php echo form_error('user_username'); ?></div>
                </div>
            </div>
            <div class="item form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >FirstName <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div style="color:red"><?php echo form_error('user_firstname'); ?></div>
                    <input type="text" name="user_firstname" required="required"  class="form-control col-md-7 col-xs-12" value="<?php echo !empty(set_value('user_firstname'))? set_value('user_firstname') :$record->user_firstname ?>">
                </div>
            </div>
            <div class="item form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >LastName <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div style="color:red"><?php  echo form_error('user_lastname');?> </div>
                    <input type="text"  name="user_lastname" required="required"  qqdata-validate-length="8" qqdata-validate-words="1" class="form-control col-md-7 col-xs-12" value="<?php echo !empty(set_value('user_lastname'))?set_value('user_lastname'):$record->user_lastname ?>">
                </div>
            </div>
            <div class="item form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Email<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div style="color:red"><?php echo form_error('user_email'); ?> </div>
                    <input type="email" name="user_email" required="required"   class="form-control col-md-7 col-xs-12" value="<?php echo !empty(set_value('user_email'))? set_value('user_email') :$record->user_email ?>">
                </div>
            </div>
            <div class="item form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Phone Number<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div style="color:red"><?php  echo form_error('user_phonenumber'); ?></div>
                    <input type="number" name="user_phonenumber" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo !empty(set_value('user_phonenumber'))? set_value('user_phonenumber'):$record->user_phonenumber ?>">
                </div>
            </div>
            <div class="item form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Address<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div style="color:red"><?php  echo form_error('user_address'); ?></div>
                    <input type="text" name="user_address" required="required"  class="form-control col-md-7 col-xs-12" value="<?php echo !empty(set_value('user_address'))? set_value('user_address') :$record->user_address  ?>">
                </div>
            </div>
            <div class="form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Current Password<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div style="color:red"><?php  echo form_error('user_password'); ?></div>
                    <input type="password"  qqdata-validate-length="6,8" class="form-control col-md-7 col-xs-12" name="user_password">
                </div>
            </div>



            <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Profile Picture</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="dropzone-cust" data-dz-url="<?php echo base_url('index.php/user_profile/file_upload');?>" data-dz-file-name="user_profile_picture">
                        <?php if(!empty($record->user_profile_picture)):?>
                            <div class="dz-image"><img src="<?php echo base_url('uploads/user/').$record->user_profile_picture;?>">
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>

            <div class="form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">                    
                    <button type="button" class="btn btn-success changepwbtn">Change Password</button>
                </div>
            </div>





            <div class="form-group changepw" style="display:none;">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >New Password<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div style="color:red"><?php  echo form_error('newpassword'); ?></div>
                    <input type="password"  class="form-control col-md-7 col-xs-12" name="newpassword">
                </div>
            </div>
            <div class="form-group changepw " style="display:none;">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm New Password</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div style="color:red"><?php  echo form_error('confirm_newpassword'); ?></div>
                    <input class="form-control col-md-7 col-xs-12" type="password" name="confirm_newpassword" >
                </div>
            </div>



            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <div class="ln_solid"></div>
                    <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                    <!--  <button  type="submit" class="btn btn-success" value="submit" name="insert">Insert</button>-->
                    <button  type="submit" class="btn btn-success" value="submit" name="update">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<!-- /page content -->