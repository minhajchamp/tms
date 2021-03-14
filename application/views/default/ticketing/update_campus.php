<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">

            <span class="input-group-btn">

            </span>
          </div>
        </div>
      </div>
    </div>




    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

       <h3>Update Campus</h3>
       <div class="x_content">
       <form class="form-horizontal form-label-left" method="POST" action="<?= site_url('campus/update/').$this->uri->segment(3).'/'.$this->uri->segment(4)?>" >

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" >Campus Name<span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
           <input type="text" class="form-control col-md-7 col-xs-12"  name="campus_name" required="required"  value="<?php echo !empty(set_value('campus_name')) ? set_value('campus_name') : $record->campus_name ?>">
           <div style="color:red"><?php echo form_error('campus_name'); ?></div>
         </div>
       </div>

        <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Campus Logo</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="dropzone-cust" data-dz-url="<?php echo base_url('campus/file_upload');?>" data-dz-file-name="campus_logo">
                    <?php if(!empty($record->campus_logo)):?>
                        <div class="dz-image"><img src="<?php echo base_url('uploads/campus/').$record->campus_logo;?>"></div>
                    <?php endif;?>
                </div>
            </div>
        </div>

       <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" >Campus Port Reference<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
           <input type="text" class="form-control col-md-7 col-xs-12"  name="campus_port_reference" required="required"  value="<?php echo !empty(set_value('campus_port_reference')) ? set_value('campus_port_reference') : $record->campus_port_reference ?>">
           <div style="color:red"><?php echo form_error('campus_port_reference'); ?></div>
         </div>
       </div>

  

       <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" >Campus Contact No<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
           <input type="text" class="form-control col-md-7 col-xs-12"  name="campus_contact_no" required="required"  value="<?php echo !empty(set_value('campus_contact_no')) ? set_value('campus_contact_no') : $record->campus_contact_no ?>">
           <div style="color:red"><?php echo form_error('campus_contact_no'); ?></div>
         </div>
       </div>

       <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" >Campus Email<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
           <input type="text" class="form-control col-md-7 col-xs-12"  name="campus_email" required="required"  value="<?php echo !empty(set_value('campus_email')) ? set_value('campus_email') : $record->campus_email ?>">
           <div style="color:red"><?php echo form_error('campus_email'); ?></div>
         </div>
       </div>

       <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" >Campus Address<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
           <textarea class="form-control col-md-7 col-xs-12"  name="campus_address" required="required"><?php echo !empty(set_value('campus_address')) ? set_value('campus_address') : $record->campus_address ?></textarea>
           <div style="color:red"><?php echo form_error('campus_address'); ?></div>
         </div>
       </div>                     


       <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" >Campus Contact Person Name<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
           <input type="text" class="form-control col-md-7 col-xs-12"  name="campus_contact_person_name" required="required"  value="<?php echo !empty(set_value('campus_contact_person_name')) ? set_value('campus_contact_person_name') : $record->campus_contact_person_name ?>">
           <div style="color:red"><?php echo form_error('campus_contact_person_name'); ?></div>
         </div>
       </div>

       <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" >Campus Contact Person Number<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
           <input type="text" class="form-control col-md-7 col-xs-12"  name="campus_contact_person_contact_no" required="required"  value="<?php echo !empty(set_value('campus_contact_person_contact_no')) ? set_value('campus_contact_person_contact_no') : $record->campus_contact_person_contact_no ?>">
           <div style="color:red"><?php echo form_error('campus_contact_person_contact_no'); ?></div>
         </div>
       </div>       

     </div>
     <div class="x_title">
      <button  type="submit" class="btn btn-success mr-6" value="submit" name="update">Update</button>
    </div>


  </form>

</div>
</div>
</div>
</div>
</div>
</div>
