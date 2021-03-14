<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Add New User</h3>
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

      <form class="form-horizontal form-label-left" method="POST" action="<?= site_url('user/insert') ?>" >


        <span class="section">User Info</span>




        <div class="item form-group ">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" >Department Name <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="item form-group ">
            <select name="department_id" class="form-control">
              <?php if(!empty($deptrecords)):foreach($deptrecords as $deptrecord):?>
                <option value="<?php echo $deptrecord->department_id; ?>"><?php echo $deptrecord->department_name; ?></option>
              <?php endforeach;endif;?>
            </select>
          </div>
          <div style="color:red"><?php echo form_error('department_id'); ?></div>
        </div>
      </div>


      <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">User Type <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="item form-group ">
            <select name="user_type" class="form-control">
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>
          <div style="color:red"><?php echo form_error('user_type'); ?></div>
        </div>
      </div>


      <div class="item form-group ">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" >User Name <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
         <input type="text" class="form-control col-md-7 col-xs-12"  name="user_username" required="required"  value="">
         <div style="color:red"><?php echo form_error('user_username'); ?></div>
       </div>
     </div>
     <div class="item form-group ">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" >First Name <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
       <div style="color:red"><?php echo form_error('user_firstname'); ?></div>
       <input type="text" name="user_firstname" required="required"  class="form-control col-md-7 col-xs-12" value="">
     </div>
   </div>
   <div class="item form-group ">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Last Name <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
     <div style="color:red"><?php  echo form_error('user_lastname');?> </div>
     <input type="text"  name="user_lastname" required="required"  qqdata-validate-length="8" qqdata-validate-words="1" class="form-control col-md-7 col-xs-12" value="">
   </div>
 </div>

 <div class="item form-group ">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Email<span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div style="color:red"><?php echo form_error('user_email'); ?> </div>
    <input type="email" name="user_email" required="required"   class="form-control col-md-7 col-xs-12" value="">
  </div>
</div>

<div class="item form-group ">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Phone Number<span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div style="color:red"><?php  echo form_error('user_phonenumber'); ?></div>
    <input type="number" name="user_phonenumber" required="required" class="form-control col-md-7 col-xs-12" value="">
  </div>
</div>
<div class="item form-group ">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Address<span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
   <div style="color:red"><?php  echo form_error('user_address'); ?></div>
   <input type="text" name="user_address" required="required"  class="form-control col-md-7 col-xs-12" value="">
 </div>
</div>


<div class="item form-group ">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Module Rights<span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Module</th>
          <th>Read</th>
          <th>Add</th>
          <th>Update</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach(json_decode($this->session->userdata('user_module')) as $user_module):?>
          <?php if($user_module->modules_slug !== '' && $user_module->modules_slug !== 'dashboard'):?>
          <tr>
            <td><button type="button" class="btn-success check_all float-right">Check All</button> <b><?php echo $user_module->modules_name; ?></b> </td>
            <td>
              <?php if($user_module->user_module_read == 1):?>
                <input type="checkbox" value="1" name="user_module[<?php echo $user_module->module_id; ?>][user_module_read]">
              <?php endif;?>
            </td>
            <td>
              <?php if($user_module->user_module_create == 1):?>
                <input type="checkbox" value="1" name="user_module[<?php echo $user_module->module_id; ?>][user_module_create]">
              <?php endif;?>
            </td>
            <td>
              <?php if($user_module->user_module_update == 1):?>
                <input type="checkbox" value="1" name="user_module[<?php echo $user_module->module_id; ?>][user_module_update]">
              <?php endif;?>
            </td>
            <td>
              <?php if($user_module->user_module_delete == 1):?>
                <input type="checkbox" value="1" name="user_module[<?php echo $user_module->module_id; ?>][user_module_delete]">
              <?php endif;?>
            </td>                    
          </tr>
          <?php endif;?>
        <?php endforeach;?>
      </tbody>      
    </table> 
  </div>
</div>

<div class="form-group">
  <div class="col-md-6 col-md-offset-3">
    <div class="ln_solid"></div>
    <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
    <!--  <button  type="submit" class="btn btn-success" value="submit" name="insert">Insert</button>-->
    <button  type="submit" class="btn btn-success" value="submit" name="insert">Add New User</button>

  </div>
</div>


</form>

</div>
</div>
</div>

<!-- /page content -->


