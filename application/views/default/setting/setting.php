<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

   <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Settings</h3>
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

            
                 
                <!--  <div class="x_content">-->

                    <form class="form-horizontal form-label-left" method="POST" action="<?= site_url('settings/update')?>" >

                     

                      <div class="item form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Project Title<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" class="form-control col-md-7 col-xs-12"  name="setting_proj_title" required="required"  value="<?php echo !empty(set_value('setting_proj_title')) ? set_value('setting_proj_title') : $record->setting_proj_title ?>">
                     <div style="color:red"><?php echo form_error('setting_proj_title'); ?></div>
                      </div>
                      </div>
                      <div class="item form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Address<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="setting_address" required="required"  class="form-control col-md-7 col-xs-12" value="<?php echo !empty(set_value('setting_address')) ? set_value('setting_address') : $record->setting_address ?>">
                          	<div style="color:red"><?php echo form_error('setting_address'); ?></div>
                        </div>
                      </div>
                      <div class="item form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Phone Number<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<input type="number"  name="setting_phonenumber" required="required"   class="form-control col-md-7 col-xs-12" value="<?php echo !empty(set_value('setting_phonenumber')) ? set_value('setting_phonenumber') : $record->setting_phonenumber ?>">
							<div style="color:red"><?php  echo form_error('setting_phonenumber');?> </div>
                        </div>
                      </div>

                       <div class="item form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Email<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" name="setting_email" required="required"   class="form-control col-md-7 col-xs-12" value="<?php echo !empty(set_value('setting_email')) ? set_value('setting_email') : $record->setting_email ?>">
                          <div style="color:red"><?php echo form_error('setting_email'); ?> </div>
                        </div>
                      </div>

                      <div class="item form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Logo<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="setting_logo" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo !empty(set_value('setting_logo')) ? set_value('setting_logo') : $record->setting_logo ?>">
                          <div style="color:red"><?php  echo form_error('setting_logo'); ?></div>
                        </div>
                      </div>
                      <div class="item form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email From<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="email" name="setting_email_from" required="required"  class="form-control col-md-7 col-xs-12" value="<?php echo !empty(set_value('setting_email_from')) ? set_value('setting_email_from') : $record->setting_email_from ?>">
                       <div style="color:red"><?php  echo form_error('setting_email_from'); ?></div>
                        </div>
                      </div>
                       <div class="item form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email to<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="email" name="setting_email_to" required="required"  class="form-control col-md-7 col-xs-12" value="<?php echo !empty(set_value('setting_email_to')) ? set_value('setting_email_to') : $record->setting_email_to ?>">
                        <div style="color:red"><?php  echo form_error('setting_email_to'); ?></div>
                        </div>
                      </div>
                      
                    

                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
							   <div class="ln_solid"></div>
                           <button  type="submit" class="btn btn-success" value="submit" name="update">Update</button>
                     
                        </div>
                      </div>
                      
                    
                    </form>
                 
                </div>
              </div>
            </div>
