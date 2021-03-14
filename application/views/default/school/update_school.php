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

       <h3>Update School</h3>
       <div class="x_content">
        <form class="form-horizontal form-label-left" method="POST" action="<?= site_url('school/update/').$this->uri->segment(3)?>" >

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" >School Name<span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
           <input type="text" class="form-control col-md-7 col-xs-12"  name="school_name" required="required"  value="<?php echo !empty(set_value('school_name')) ? set_value('school_name') : $record->school_name ?>">
           <div style="color:red"><?php echo form_error('school_name'); ?></div>
         </div>
       </div>

        <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">School Logo</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="dropzone-cust" data-dz-url="<?php echo base_url('school/file_upload');?>" data-dz-file-name="school_logo">
                    <?php if(!empty($record->school_logo)):?>
                        <div class="dz-image"><img src="<?php echo base_url('uploads/school/').$record->school_logo;?>"></div>
                    <?php endif;?>
                </div>
            </div>
        </div>

       <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" >School Port Reference
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
           <input type="text" class="form-control col-md-7 col-xs-12"  name="school_port_reference" value="<?php echo !empty(set_value('school_port_reference')) ? set_value('school_port_reference') : $record->school_port_reference ?>">
           <div style="color:red"><?php echo form_error('school_port_reference'); ?></div>
         </div>
       </div>

  

       <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" >School Contact No<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
           <input type="text" class="form-control col-md-7 col-xs-12"  name="school_contact_no"  value="<?php echo !empty(set_value('school_contact_no')) ? set_value('school_contact_no') : $record->school_contact_no ?>">
           <div style="color:red"><?php echo form_error('school_contact_no'); ?></div>
         </div>
       </div>

       <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" >School Email
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
           <input type="text" class="form-control col-md-7 col-xs-12"  name="school_email"  value="<?php echo !empty(set_value('school_email')) ? set_value('school_email') : $record->school_email ?>">
           <div style="color:red"><?php echo form_error('school_email'); ?></div>
         </div>
       </div>

       <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" >School Address
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
           <textasrea class="form-control col-md-7 col-xs-12"  name="school_address"><?php echo !empty(set_value('school_address')) ? set_value('school_address') : $record->school_address ?></textarea>
           <div style="color:red"><?php echo form_error('school_address'); ?></div>
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
