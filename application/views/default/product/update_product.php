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

       <h3>Update Product</h3>
       <div class="x_content">
        <form class="form-horizontal form-label-left" method="POST" action="<?= site_url('product/update/').$this->uri->segment(3)?>" >

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Name<span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
           <input type="text" class="form-control col-md-7 col-xs-12"  name="product_name" required="required"  value="<?php echo !empty(set_value('product_name')) ? set_value('product_name') : $record->product_name ?>">
           <div style="color:red"><?php echo form_error('product_name'); ?></div>
         </div>
       </div>

        <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Logo</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="dropzone-cust" data-dz-url="<?php echo base_url('product/file_upload');?>" data-dz-file-name="product_logo">
                    <?php if(!empty($record->product_logo)):?>
                        <div class="dz-image"><img src="<?php echo base_url('uploads/product/').$record->product_logo;?>"></div>
                    <?php endif;?>
                </div>
            </div>
        </div>

       <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Version<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
           <input type="text" class="form-control col-md-7 col-xs-12"  name="product_version" required="required"  value="<?php echo !empty(set_value('product_version')) ? set_value('product_version') : $record->product_version ?>">
           <div style="color:red"><?php echo form_error('product_version'); ?></div>
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
