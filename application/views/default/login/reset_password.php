<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$this->load->view('default/include/header');
 

?>

<div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST" action="<?= site_url('reset-password/').$this->uri->segment(2);?>" >
              <h1>Reset Password</h1>
             <div>
				 <h5 style="margin-right:245px">New Password</h5>
                <input type="password" class="form-control" placeholder="Password" name="newpassword" autocomplete="off" required="required" value="" />
                <div style="color:white"><?php echo form_error('newpassword'); ?></div>
              </div>
               <div>
				   <h5 style="margin-right:230px">Confirm Password</h5>
                <input type="password" class="form-control" placeholder="Password" name="confirmpassword" autocomplete="off" required="required" value="" />
                <div style="color:white"><?php echo form_error('confirmpassword'); ?></div>
                </div>

              <div>
                <button class="btn btn-default submit" type="submit" value="submit" name="submit">Submit</button>
              
              </div>

              <div class="clearfix"></div>
            
              <div class="separator">
                
            
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              
            </form>
          </section>
        </div>
