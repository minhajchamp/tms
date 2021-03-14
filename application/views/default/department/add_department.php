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

       <h3>Add Department</h3>

       <div class="x_content">
        <form class="form-horizontal form-label-left" method="POST" action="<?= site_url('department/insert')?>" >
         <div class="item-main">  
           <div class="item form-group ">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Department Name<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <input type="text" class="form-control col-md-7 col-xs-12"  name="departmentdata[0][department_name]" required="required"  value="">
               <div style="color:red"><?php echo form_error('department_name'); ?></div>
             </div>
           </div>

         </div>      
       </div>
       <div class="x_title">
        <button  type="button" class="btn btn-warning mr-6 adddepartments">Add More Departments</button>
        <button  type="submit" class="btn btn-success mr-6" value="submit" name="insert">Insert Departments</button>
      </div>


    </form>


  </div>
</div>
</div>
</div>
</div>
</div>


  