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
                
                   <h3>Update Product Module</h3>
          <div class="x_content">
					 <form class="form-horizontal form-label-left" method="POST" action="<?= site_url('product_mod/update/').$this->uri->segment(3)?>" >
					
                     <div class="item form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Module Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" class="form-control col-md-7 col-xs-12"  name="product_mod_name" required="required"  value="<?php echo !empty(set_value('product_mod_name')) ? set_value('product_mod_name') : $record->product_mod_name ?>">
                     <div style="color:red"><?php echo form_error('product_mod_name'); ?></div>
                      </div>
                      </div>
                       <div class="item form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Module Details<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" class="form-control col-md-7 col-xs-12"  name="product_mod_details" required="required"  value="<?php echo !empty(set_value('product_mod_details')) ? set_value('product_mod_details') : $record->product_mod_details ?>">
                     <div style="color:red"><?php echo form_error('product_mod_details'); ?></div>
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
