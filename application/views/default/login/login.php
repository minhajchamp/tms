<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 
 
  <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST" action="<?= site_url('login')?>" >
              <h1>Login Form</h1>
              <div>
                <input type="email" class="form-control" placeholder="Enter Email" name="email" autocomplete="off"  value="<?php echo !empty(set_value('email'))?set_value('email'):$this->input->cookie('user_email',TRUE); ?>"/>
                <div style="color:white"><?php echo form_error('email'); ?></div>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off"  value="<?php echo $this->input->cookie('user_password',TRUE);?>" />
               <div style="color:white"><?php echo form_error('password'); ?></div>
              </div>
              <div>
                <button class="btn btn-default" type="submit" value="submit" name="submit">Log in</button>
                <a class="reset_pass" href="<?= site_url('forget-password')?>">Forget your password?</a>
              </div>

              <div class="clearfix"></div>


            <div class="checkbox">
            <label><input name="remember_me" value="yes" type="checkbox"> Remember me</label>
            </div>
            
              <div class="separator">
                
            
                <div class="clearfix"></div>
                <br />

                <div>
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

  
