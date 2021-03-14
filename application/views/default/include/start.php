<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TMS</title>

    <!-- Bootstrap -->
    <link href="<?= ASSETS_PATH ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= ASSETS_PATH ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= ASSETS_PATH ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?= ASSETS_PATH ?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="<?= ASSETS_PATH ?>/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?= ASSETS_PATH ?>/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?= ASSETS_PATH ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
     <!-- Animate.css -->
    <link href="<?= ASSETS_PATH ?>/vendors/animate.css/animate.min.css" rel="stylesheet">
     <!-- Datatables -->
    <link href="<?= ASSETS_PATH?>/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?= ASSETS_PATH?>/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?= ASSETS_PATH?>/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?= ASSETS_PATH?>/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?= ASSETS_PATH?>/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />  
    <link href="<?= ASSETS_PATH ?>/vendors/jodit/build/jodit.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400&display=swap" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?= ASSETS_PATH ?>/css/custom.min.css" rel="stylesheet">
    <script type="text/javascript">
        var base_url = '<?php echo base_url();?>';
        var user_id = '<?php echo (!empty($this->userdata->user_id))?$this->userdata->user_id:'';?>';
        var uri_segment1 = '<?php echo $this->uri->segment(1);?>';
        var uri_segment2 = '<?php echo $this->uri->segment(2);?>';
        var uri_segment3 = '<?php echo $this->uri->segment(3);?>';
        var uri_segment4 = '<?php echo $this->uri->segment(4);?>';

        var modules = <?php echo !empty($this->session->userdata('modules'))?$this->session->userdata('modules'):'""'; ?>;
        var user_module = <?php echo !empty($this->session->userdata('user_module'))?$this->session->userdata('user_module'):'""'; ?>;
        var user_type = '<?php echo !empty($this->userdata->user_type)?$this->userdata->user_type:''; ?>';
        var user_department_id = '<?php echo !empty($this->userdata->department_id)?$this->userdata->department_id:''; ?>';

	<?php if(!empty($this->userstatuses)):?>
        var user_statuses = JSON.parse('<?php echo json_encode($this->userstatuses); ?>');
	<?php endif;?>
    </script>





<!--     <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "645c5fbe-f4c8-4438-8feb-c4e8e1b04f20",
            });
        });



        OneSignal.push(function() {
            OneSignal.on('subscriptionChange', function(isSubscribed) {
                if (isSubscribed) {
                // The user is subscribed
                //   Either the user subscribed for the first time
                //   Or the user was subscribed -> unsubscribed -> subscribed
                OneSignal.getUserId( function(userId) {
                // Make a POST call to your server with the user ID
});
}
});
        });
    </script>   
 -->

        <?php if(!empty($this->userdata)):?>
        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>            
        <script>
            var OneSignal = window.OneSignal || [];
            OneSignal.push(["init", {
                appId: "645c5fbe-f4c8-4438-8feb-c4e8e1b04f20",
            }]);
        </script>
        <script>
            function subscribe() {
                // OneSignal.push(["registerForPushNotifications"]);
                OneSignal.push(["registerForPushNotifications"]);
                event.preventDefault();
            }
            function unsubscribe(){
                OneSignal.setSubscription(true);
            }
            var OneSignal = OneSignal || [];
            OneSignal.push(function() {
                /* These examples are all valid */
                // Occurs when the user's subscription changes to a new value.
                OneSignal.on('subscriptionChange', function (isSubscribed) {
                    console.log("The user's subscription state is now:", isSubscribed);
                    OneSignal.sendTag("user_id","<?php echo $this->userdata->user_id;?>", function(tagsSent)
                    {
                        // Callback called when tags have finished sending
                        console.log("Tags have finished sending!");
                    });
                });
                var isPushSupported = OneSignal.isPushNotificationsSupported();
                if (isPushSupported)
                {
                    // Push notifications are supported
                    OneSignal.isPushNotificationsEnabled().then(function(isEnabled)
                    {
                        if (isEnabled)
                        {
                            console.log("Push notifications are enabled!");
                        } else {
                            OneSignal.showHttpPrompt();
                            console.log("Push notifications are not enabled yet.");
                        }
                    });
                } else {
                    console.log("Push notifications are not supported.");
                }
            });
        </script>
        <?php endif;?>



  </head>




