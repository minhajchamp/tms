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

       <h3>Add School</h3>

       <div class="x_content">
        <form class="form-horizontal form-label-left" method="POST" action="<?= site_url('school/insert')?>" >
         <div class="item-main">  
           <div class="item form-group ">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" >School Name<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <input type="text" class="form-control col-md-7 col-xs-12"  name="schooldata[0][school_name]" required="required"  value="">
               <div style="color:red"><?php echo form_error('school_name'); ?></div>
             </div>
           </div>


           <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">School Logo</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="dropzone-cust dropzone-cust-multiple" data-dz-url="<?php echo base_url('school/file_upload');?>" data-dz-file-array="schooldata" data-dz-file-array-index="0" data-dz-file-name="school_logo">
                        <?php if(!empty($record->school_logo)):?>
                            <div class="dz-image"><img src="<?php echo base_url('uploads/school/').$record->school_logo;?>"></div>
                        <?php endif;?>
                    </div>
                </div>
            </div>


           <div class="item form-group ">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" >School Port Reference
             </label>
             <div class="col-md-6 col-sm-6 col-xs-12">
               <input type="text" class="form-control col-md-7 col-xs-12"  name="schooldata[0][school_port_reference]"  value="">
               <div style="color:red"><?php echo form_error('school_port_reference'); ?></div>
             </div>
           </div>


           <div class="item form-group ">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" >School Contact No
             </label>
             <div class="col-md-6 col-sm-6 col-xs-12">
               <input type="text" class="form-control col-md-7 col-xs-12"  name="schooldata[0][school_contact_no]" value="">
               <div style="color:red"><?php echo form_error('school_contact_no'); ?></div>
             </div>
           </div>

           <div class="item form-group ">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" >School Email
             </label>
             <div class="col-md-6 col-sm-6 col-xs-12">
               <input type="text" class="form-control col-md-7 col-xs-12"  name="schooldata[0][school_email]"  value="">
               <div style="color:red"><?php echo form_error('school_email'); ?></div>
             </div>
           </div>

           <div class="item form-group ">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" >School Address
             </label>
             <div class="col-md-6 col-sm-6 col-xs-12">
               <textarea class="form-control col-md-7 col-xs-12" name="schooldata[0][school_address]" value=""></textarea>
               <div style="color:red"><?php echo form_error('school_address'); ?></div>
             </div>
           </div>
                           
         </div>      
       </div>
       <div class="x_title">
        <button  type="button" class="btn btn-warning mr-6 addschools">Add More Schools</button>
        <button  type="submit" class="btn btn-success mr-6" value="submit" name="insert">Insert Schools</button>
      </div>


    </form>


  </div>
</div>
</div>
</div>
</div>
</div>


  
