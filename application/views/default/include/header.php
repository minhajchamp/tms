


  <body class="nav-md">









    <div class="taskbar" style="display: none;">
      <ul>
      </ul>
    </div>
	   <div class="x_content alert-custom bs-example-popovers">
				<?php if($this->session->has_userdata('success')):?>
                  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Success!</strong> <?= $this->session->flashdata('success');?>
                  </div>	

                  <?php if($this->session->flashdata('success') == 'Sucessfully Login.'):?>
                  <script type="text/javascript">
                    window.sessionStorage.minimzedItems = '';
                  </script>	
                  <?php endif;?>

				<?php endif;?>
	
                <?php if($this->session->has_userdata('Deleted')):?>
				   <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong></strong> <?= $this->session->flashdata('Deleted');?>
                  </div>		
				<?php endif;?>
				
				<?php if($this->session->has_userdata('errossssr')):?>                
                  <div class="alert alert-warning alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
                  </div>		
				<?php endif;?>
                  
				<?php if($this->session->has_userdata('error')):?>
                  <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>ERROR!</strong> <?= $this->session->flashdata('error');?>                    
                  </div>		
				<?php endif;?>

                </div>
  


    <div class="container body">



      <div class="main_container">




