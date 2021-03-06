<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="viewTicketModal" data-ticketing-id="">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close closeBtn" data-dismiss="modal"><span aria-hidden="true">×</span>
                <button type="button" class="close minimize minimizeBtn" data-dismiss="modal"><span aria-hidden="true">-</span>
                </button>
                <div class="modal-title">
                    <div class="col-md-11 text-left"><span class="ticketing_id"></span> <span class="ticketing_titile"></span> <span class="ticketing_current_status"></span>
                    <div class="ticketing_current_statuses">
                        
                    </div>
                    </div>
                </div>
            </div>


            <div class="modal-body">

                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><b>Priorty</b></td>
                                    <td class="text-capitalize"><span class="priority"></span></td>
                                </tr>
                                <tr>
                                    <td><b>Min Resolve Time</b></td>
                                    <td>
                                        <h3 class="label label-warning ticketing_min_resolve_time"></h3></td>
                                </tr>
                                <tr>
                                    <td><b>Max Resolve Time</b></td>
                                    <td>
                                        <h3 class="label label-danger ticketing_max_resolve_time"></h3></td>
                                </tr>
                                <tr>
                                    <td><b>Type</b></td>
                                    <td class="ticketing_query_type text-capitalize"></td>
                                </tr>
                                <tr>
                                    <td><b>Query From</b></td>
                                    <td class="query_generated_by text-capitalize"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><b>School</b></td>
                                    <td class="school_name"></td>
                                </tr>
                                <tr>
                                    <td><b>Campus</b></td>
                                    <td class="campus_name"></td>
                                </tr>
                                <tr>
                                    <td><b>Port</b></td>
                                    <td class="port_reference"></td>
                                </tr>
                                <tr>
                                    <td><b>Product Name</b></td>
                                    <td class="product_name"></td>
                                </tr>
                                <tr>
                                    <td><b>Module Name</b></td>
                                    <td class="module_name"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><b>Generated by</b></td>
                                    <td class="generated_by_user_name"></td>
                                </tr>
                                <tr>
                                    <td><b>Generated by Dept.</b></td>
                                    <td class="generated_by_department_name"></td>
                                </tr>
                                <tr>
                                    <td><b>Assigned to Dept.</b></td>
                                    <td class="assigned_to_department_name"></td>
                                </tr>
                                <tr>
                                    <td><b>Preferred User</b></td>
                                    <td class="preferred_user_name"></td>
                                </tr>
                                <tr>
                                    <td><b>Assigned to</b></td>
                                    <td class="assigned_to_user_name"></td>
                                </tr>

                                <tr>
                                    <td><b>School Representative</b></td>
                                    <td class="user_school_name"></td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-8">
                        <h2><i class="fa fa-question"></i> Query</h2>
                        <div class="ticketing_query">
                        </div>
                    </div>

                    <div class="col-md-4">

                        <h2><i class="fa fa-paperclip"></i> Media &amp; Attachments</h2>
                        <ul class="media-ul">
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <h2><i class="fa fa-comments"></i> Discussion</h2>
                    </div>
                </div>
                <div class="row discussion-cont">
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
                <form action="#" target="_blank" method="post" id="commentForm">
                  <div class="row">
                      <div class="col-md-9">
                          <textarea name="" class="form-control commentText" placeholder="Your comment goes here.." rows="6"></textarea>
                      </div>
                      <div class="col-md-3"> 
                            <div class="dropzone-cust-cont">
                              <div class="dropzone-cust" data-dz-url="<?php echo base_url('dashboard/file_upload');?>" data-dz-file-name="filename2">
                              </div>
                            </div>                            
                            <hr>
                          <button class="btn btn-success addComment">Add comment</button>
                      </div>
                  </div>
                </form>
            </div>

        </div>
    </div>
</div>




 <footer>
          <div class="clearfix"></div>
        </footer>


        


   


	
