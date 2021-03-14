<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Add New School User</h3>
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

      <form class="form-horizontal form-label-left" method="POST" action="<?= site_url('user_school/insert') ?>" >


        <span class="section">User Info</span>




            <div class="item form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >School Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                 <div class="item form-group ">
                  <select name="school_id" id="school_id" class="form-control">
                    <option value="" class="">Select School</option>
                    <?php if(!empty($schoolrecords)):foreach($schoolrecords as $schoolrecord):?>
                      <option value="<?php echo $schoolrecord->school_id; ?>"><?php echo $schoolrecord->school_name; ?></option>
                    <?php endforeach;endif;?>
                  </select>
                </div>
                <div style="color:red"><?php echo form_error('school_id'); ?></div>
              </div>
            </div>



            <div class="item form-group campus_selection " style="display: none;">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Campus Name </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                 <div class="item form-group ">
                  <select name="campus_id" id="campus_id" class="form-control" >
                    <option value="" class="">All Campuses</option>
                    <?php if(!empty($campusrecords)):foreach($campusrecords as $campusrecord):?>
                      <option class="options" data-school-id="<?php echo $campusrecord->school_id; ?>" value="<?php echo $campusrecord->campus_id; ?>"><?php echo $campusrecord->campus_name; ?></option>
                    <?php endforeach;endif;?>
                  </select>
                </div>
                <div style="color:red"><?php echo form_error('campus_id'); ?></div>
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
    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Last Name </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
     <div style="color:red"><?php  echo form_error('user_lastname');?> </div>
     <input type="text"  name="user_lastname" class="form-control col-md-7 col-xs-12" value="">
   </div>
 </div>

 <div class="item form-group ">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Email
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div style="color:red"><?php echo form_error('user_email'); ?> </div>
    <input type="email" name="user_email" class="form-control col-md-7 col-xs-12" value="">
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


