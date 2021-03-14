
  <!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row tile_count">
        <?php if(!empty($total_count)):?>
        <div class="tile_stats_count tile_stats_count_active" data-status="all">
            <span class="count_top">Total Tickets</span>
            <div class="count"><?php echo $total_count;?></div>
        </div>
        <?php endif;?>

        <?php if(!empty($total_count_today)):?>
        <div class="tile_stats_count" data-status="today">
            <span class="count_top">Total Tickets Today</span>
            <div class="count"><?php echo $total_count_today;?></div>
        </div>
        <?php endif;?>

        <?php if(!empty($total_completed_count_today)):?>
        <div class="tile_stats_count" data-status="completedtoday">
            <span class="count_top">Total Tickets Completed Today</span>
            <div class="count"><?php echo $total_completed_count_today;?></div>
        </div>
        <?php endif;?>        

        <?php if(!empty($this->userstatuses)):foreach($this->userstatuses as $userstatuses):?>
          <div class="tile_stats_count" data-status="<?php echo $userstatuses->ticketing_current_status_id;?>">
              <span class="count_top">Total Tickets <?php echo $userstatuses->ticketing_current_status_text;?></span>
              <div class="count"><?php echo $this->usercount[$userstatuses->ticketing_current_status_id];?></div>
          </div>          
        <?php endforeach;endif;?>
    </div>
    <!-- /top tiles -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">
                <div class="row x_title">
                    <div class="col-md-2">            
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#newTicketModal"><i class="fa fa-plus"></i> New Ticket</a>
                    </div>

                    <div class="col-md-3 col-md-offset-7 text-right">
                        <div class="form-group">
                            <input type="text" name="" id="searchTicket" placeholder="Search..." class="form-control">
                        </div>
                    </div>

                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="ticket-main">

                        <div class="ticket">
                            <div class="top-bar">
                                <h2><span style="color: #eea239;"></span></h2>
                            </div>
                            <div class="middle-bar">
                                <div class="">
                                    <h4><a href="#" class="ticketShowBtn"></a></h4>
                                </div>
                            </div>
                            <div class="bottom-bar">
                                <p><b></b></p>
                                <p> <b></b></p>
                            </div>
                        </div>                        
                    </div>

                    <div class="text-center">
                      <a href="#" data-offset="5" class="loadMoreTicket btn btn-success" data-status="all">Load More... </a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="newTicketModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title text-center" id="myModalLabel">Create new ticket</h4>
            </div>
            <div class="modal-body">
                <div class="">
                    <br>
                    <form id="demo-form2" target="_blank" data-parsley-validate="" action="<?php echo base_url('dashboard/submit_ticket');?>" method="post" class="form-horizontal addTicket form-label-left" novalidate="">
                        <div class="col-md-6 col-sm-6">  

                          <div class="item form-group">
                              <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Ticket Task Name <span class="required">*</span>
                              </label>
                              <div class="col-md-8 col-sm-8">
                                  <input type="text" id="first-name" name="ticketing_titile" required="required" class="form-control ">
                              </div>
                          </div>

                          <div class="item form-group ">
                              <label class="control-label col-md-4 col-sm-4 col-xs-12" >School Name<span class="required">*</span>
                              </label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                  <div class="item form-group ">
                                      <select id="school_id" name="school_id" class="form-control" required="required">
                                          <option value="" class="">Select School</option>
                                          <?php if(!empty($schoolrecords)):foreach($schoolrecords as $schoolrecord):?>
                                          <option data-school-port-reference="<?php echo $schoolrecord->school_port_reference;?>" value="<?php echo $schoolrecord->school_id;?>"><?php echo $schoolrecord->school_name; ?><?php echo !empty($schoolrecord->school_port_reference)?' - '.$schoolrecord->school_port_reference:'';?></option>
                                          <?php endforeach;endif;?>
                                      </select>
                                      <small id="school_port_reference"></small>
                                  </div>
                              </div>
                          </div>


                          <div class="item form-group campus_selection" style="display: none;">
                              <label class="control-label col-md-4 col-sm-4 col-xs-12" >Campus Name<span class="required">*</span>
                              </label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                  <div class="item form-group ">
                                      <select id="campus_id" name="campus_id" class="form-control">
                                          <option value="" class="">Select Campus</option>
                                          <?php if(!empty($campusrecords)):foreach($campusrecords as $campusrecord):?>
                                          <option data-campus-port-reference="<?php echo $campusrecord->campus_port_reference;?>" data-school-id="<?php echo $campusrecord->school_id; ?>" value="<?php echo $campusrecord->campus_id; ?>" class="options hidden"><?php echo $campusrecord->campus_name; ?></option>
                                          <?php endforeach;endif;?>
                                      </select>
                                      <small id="campus_port_reference"></small>
                                  </div>
                              </div>
                          </div>    

                          <div class="item form-group representative_selection" style="display: none;">
                              <label class="control-label col-md-4 col-sm-4 col-xs-12" >School Representative </span>
                              </label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                  <div class="item form-group ">
                                      <select id="user_school_id" name="user_school_id" class="form-control">

                                          <option value="" class="">School Representative</option>
                                          <?php foreach($userschoolrecords as $userschoolrecord):?>
                                          <option class="options hidden" data-campus-id="<?php echo $userschoolrecord->user_school_campus_id;?>" data-school-id="<?php echo $userschoolrecord->user_school_school_id;?>" value="<?php echo $userschoolrecord->user_id;?>"><?php echo $userschoolrecord->user_firstname.' '.$userschoolrecord->user_lastname;?></option>
                                          <?php endforeach;?>
                                      </select>
                                  </div>
                              </div>
                          </div>


                          <div class="item form-group ">
                              <label class="control-label col-md-4 col-sm-4 col-xs-12" >Department Name <span class="required">*</span>
                              </label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                  <div class="item form-group ">
                                      <select id="department_id" name="assigned_to_department_id" class="form-control" required="required">
                                          <option value="" class="">Select Department</option>
                                          <?php if(!empty($deptrecords)):foreach($deptrecords as $deptrecord):?>
                                          <option value="<?php echo $deptrecord->department_id; ?>"><?php echo $deptrecord->department_name; ?></option>
                                          <?php endforeach;endif;?>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="item form-group user_selection" style="display: none;">
                              <label class="control-label col-md-4 col-sm-4 col-xs-12" >Preferred User<span class="required">*</span>
                              </label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                  <div class="item form-group ">
                                      <select id="user_id" name="preferred_user_id" class="form-control">
                                          <option value="" class="">Select Preferred User</option>
                                          <?php if(!empty($userrecords)):foreach($userrecords as $userrecord):?>
                                          <option data-department-id="<?php echo $userrecord->department_id; ?>" value="<?php echo $userrecord->user_id; ?>" class="options hidden"><?php echo $userrecord->user_firstname.' '.$userrecord->user_lastname; ?></option>
                                          <?php endforeach;endif;?>
                                      </select>
                                  </div>
                              </div>
                          </div> 
 
                        </div>

                        <div class="col-md-6 col-sm-6">



                          <div class="item form-group ">
                              <label class="control-label col-md-4 col-sm-4 col-xs-12" >Product Name<span class="required">*</span>
                              </label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                  <div class="item form-group ">
                                      <select id="product_id" name="product_id" class="form-control" required="required">
                                          <option value="" class="">Select Product</option>
                                          <?php if(!empty($productrecords)):foreach($productrecords as $productrecord):?>
                                          <option value="<?php echo $productrecord->product_id;?>"><?php echo $productrecord->product_name; ?></option>
                                          <?php endforeach;endif;?>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="item form-group module_selection" style="display: none;">
                              <label class="control-label col-md-4 col-sm-4 col-xs-12" >Module Name<span class="required">*</span>
                              </label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                  <div class="item form-group ">
                                      <select id="module_id" name="module_id" class="form-control">
                                          <option value="" class="">Select Module</option>
                                          <?php if(!empty($modulerecords)):foreach($modulerecords as $modulerecord):?>
                                          <option data-product-id="<?php echo $modulerecord->product_id; ?>" value="<?php echo $modulerecord->module_id; ?>" class="options hidden"><?php echo $modulerecord->module_name; ?></option>
                                          <?php endforeach;endif;?>
                                      </select>
                                  </div>
                              </div>
                          </div> 


                          <div class="item form-group ">
                              <label class="control-label col-md-4 col-sm-4 col-xs-12">Query Deadline <span class="required">*</span>
                              </label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                  <div class="item form-group ">
                                      <input type="datetimepicker" name="ticketing_min_resolve_time" class="form-control" required="required">
                                  </div>
                              </div>
                          </div>
                          <div class="item form-group ">
                              <label class="control-label col-md-4 col-sm-4 col-xs-12">Query Max Deadline <span class="required">*</span>
                              </label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                  <div class="item form-group ">
                                      <input type="datetimepicker" name="ticketing_max_resolve_time" class="form-control" required="required">
                                  </div>
                              </div>
                          </div>
                          <div class="item form-group">
                              <label class="control-label col-md-4 col-sm-4 col-xs-12" >Query Type<span class="required">*</span>
                              </label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                  <div class="item form-group ">
                                      <select id="ticketing_query_type" name="query_type_id" class="form-control" required="required">
                                          <option value="" class="">Select Query Type</option>
                                          <?php if(!empty($get_dropdowns['query_type'])):foreach($get_dropdowns['query_type'] as $query_type_data):?>
                                          <option value="<?php echo $query_type_data->query_type_id; ?>" class=""><?php echo $query_type_data->query_type_text; ?></option>
                                          <?php endforeach;endif;?>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="item form-group">
                              <label class="control-label col-md-4 col-sm-4 col-xs-12" >Priority<span class="required">*</span>
                              </label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                  <div class="item form-group ">
                                      <select id="priority" name="priority_id" class="form-control" required="required">
                                          <option value="" class="">Select Priority</option>
                                          <?php if(!empty($get_dropdowns['priority'])):foreach($get_dropdowns['priority'] as $priority_data):?>
                                          <option value="<?php echo $priority_data->priority_id; ?>" class=""><?php echo $priority_data->priority_text; ?></option>
                                          <?php endforeach;endif;?>
                                        </select>
                                  </div>
                              </div>
                          </div>

                          <div class="item form-group ">
                              <label class="control-label col-md-4 col-sm-4 col-xs-12" >Query Generated By <span class="required">*</span>
                              </label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                  <div class="item form-group ">
                                      <select id="query_generated_by" name="query_generated_by_id" class="form-control" required="required">
                                          <option value="" class="">Select Generated By</option>
                                          <?php if(!empty($get_dropdowns['query_generated_by'])):foreach($get_dropdowns['query_generated_by'] as $query_generated_by_data):?>
                                          <option value="<?php echo $query_generated_by_data->query_generated_by_id; ?>" class=""><?php echo $query_generated_by_data->query_generated_by_text; ?></option>
                                          <?php endforeach;endif;?>
                                      </select>
                                  </div>
                              </div>
                          </div>



                          

                        </div>                        



                        <div class="col-md-12 col-sm-12">   
                          <hr>
                          <div class="item form-group">
                              <div class="col-md-9 col-sm-9">
                                  <textarea  rows="10" id="middle-name" placeholder="Your query goes here.." class="form-control editor" type="text" name="ticketing_query"></textarea>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <div class="dropzone-cust" data-dz-url="<?php echo base_url('dashboard/file_upload');?>" data-dz-file-name="filename">
                                  </div>
                              </div>
                          </div>
                          <div class="ln_solid"></div>
                          <div class="item form-group">
                              <div class="col-md-6 col-sm-6 offset-md-3">
                                  <button class="btn btn-danger closeBtn" type="button" data-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn submitBtn btn-success">Submit</button>
                              </div>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



