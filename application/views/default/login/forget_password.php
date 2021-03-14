<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$this->load->view('default/include/header');
 

?>

 
 
  <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST" action="" >
              <h1>Forget Password</h1>
              <div>
                <input type="email" class="form-control" placeholder="Enter Email" name="email_forget_pass" autocomplete="off" required="required" value="<?php echo set_value('email_forget_pass')?>"/>
              </div>

              <div>
                <button class="btn btn-default submit" type="submit" value="submit" name="send_email">Send Email</button>
              
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

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="required" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="required" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="required" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
          </div>
        </div>
        

     </div>
    </div>

  
