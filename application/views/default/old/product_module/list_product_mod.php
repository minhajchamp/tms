<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



   <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Product Module</h3>
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
			
			<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <a href="<?= site_url('product_mod/add')?>" class="btn btn-success">Add New Record</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>S.NO</th>
                          <th>Product Module Name</th>
                          <th>Product Module Details</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
						  <?php if(!empty($records)): $i=0; foreach($records as $record): $i++;?>
                        <tr>
                          <td><?= $i;?></td>
                          <td><?= $record->product_mod_name;?></td>
                           <td><?= $record->product_mod_details;?></td>
                          <td><a href="<?= site_url('product_mod/delete/').$record->product_mod_id ?>" class="fa fa-trash"></a>  <a href="<?= site_url('product_mod/edit/').$record->product_mod_id?>" class="fa fa-edit"></a></td>
                        </tr>
                        <?php endforeach; endif;?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>        
