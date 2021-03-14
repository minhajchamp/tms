<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('random_char_gen')){	
	function random_char_gen($count){        
		$ci =& get_instance();
		$ci->load->library('encryption');				
		return substr($ci->encryption->encrypt(sha1(mt_rand().uniqid())),0,$count);  
	}
}


if(!function_exists('single_image_upload')){	
	function single_image_upload($image,$path,$type=""){         
	$_FILES['image']['name']= $image['name'];
	$_FILES['image']['type']= $image['type'];
	$_FILES['image']['tmp_name']= $image['tmp_name'];
	$_FILES['image']['error']= $image['error'];
	$_FILES['image']['size']= $image['size']; 
    if(!file_exists($path)){
      mkdir($path, 0777, true);
    }
    $ci =& get_instance();
    $config['upload_path'] = ''.$path.'';
    if(!empty($type)){
        $config['allowed_types'] = $type;
    }
    else{
        $config['allowed_types'] = 'gif|jpg|png';
    }
    $ci->load->library('upload', $config);
    $ci->upload->initialize($config);
    if(!$ci->upload->do_upload('image')){ 
      return array('error' => $ci->upload->display_errors());
    }else{
        $file_detail = $ci->upload->data();				
		return	$file_detail['file_name'];			
    }
    return FALSE;
	}
}

if(!function_exists('single_file_upload')){    
    function single_file_upload($image,$path,$type=""){         
    $_FILES['image']['name']= $image['name'];
    $_FILES['image']['type']= $image['type'];
    $_FILES['image']['tmp_name']= $image['tmp_name'];
    $_FILES['image']['error']= $image['error'];
    $_FILES['image']['size'] = $image['size']; 
    if(!file_exists($path)){
      mkdir($path, 0777, true);
    }
    $ci =& get_instance();
    $config['upload_path'] = ''.$path.'';
    if(!empty($type)){
        $config['allowed_types'] = $type;
    }
    else{
        $config['allowed_types'] = 'gif|jpg|png';
    }
    $ci->load->library('upload', $config);
    $ci->upload->initialize($config);
    if(!$ci->upload->do_upload('image')){ 
      return array('error' => $ci->upload->display_errors());
    }else{
        $file_detail = $ci->upload->data();             
        return  $file_detail['file_name'];          
    }
    return FALSE;
    }
}

if(!function_exists('get_db_timestamp')){ 
    function get_db_timestamp($datetime){   
        $originalDate = $datetime;
        $date_array = explode(' ', $originalDate);
        $date = $date_array[0];
        $time = $date_array[1].' '.$date_array[2];
        $newTime = date("H:i:s", strtotime($time));

        $new_timestamp = $date.' '.$newTime;
        return $new_timestamp;
    }
}
// if(!function_exists('send_email')){ 
//     function send_email($to="",$subject,$body){
//         // $ci =& get_instance();
//         // $config['protocol'] = 'smtp';
//         // $config['mailpath'] = '/usr/sbin/sendmail';
//         // $config['charset'] = 'iso-8859-1';
//         // $config['wordwrap'] = TRUE;
//         // $config['smtp_host'] = 'ssl://smtp.googlemail.com';
//         // $config['smtp_port'] = '465';
//         // $config['smtp_user'] = 'muhammadahsanali.arwaj@gmail.com';
//         // $config['smtp_pass'] = 'arwaj@12345';
//         // $config['mailtype'] = 'html';
//         // $config['starttls'] = true;
//         // $config['newline'] = '\r\n';
//         // $ci->email->initialize($config);     
//         // $ci->email->from('muhammadahsanali.arwaj@gmail.com','Ticketing Management System');
//         // $ci->email->to('muhammadahsanali.arwaj@gmail.com');   
//         // if(!empty($send_cc)){
//         //    $ci->email->cc($send_cc);    
//         // }
//         // $ci->email->subject($subject);
//         // $ci->email->message($body);
//         // if($ci->email->send()){
//         //     return TRUE;    
//         //     }else{     
//         //     return $this->email->print_debugger();
//         // }

//         // $ci =& get_instance();


//         // $config = array(
//         //     'protocol'  => 'smtp',
//         //     'smtp_host' => 'ssl://smtp.googlemail.com',
//         //     'smtp_port' => '465',
//         //     'smtp_user' => 'muhammadahsanali.arwaj@gmail.com',
//         //     'smtp_pass' => 'arwaj@12345',
//         //     'mailtype'  => 'html',
//         //     'starttls'  => true,
//         //     'newline'   => "\r\n"
//         // );

//         // $ci->load->library('email', $config);

//         // $ci->email->from('muhammadahsanali.arwaj@gmail.com', $subject);
//         // $ci->email->to('muhammadahsanali.arwaj@gmail.com');
//         // $ci->email->subject($subject);
//         // $ci->email->message($body);

//         // $ci->email->send();

//     //}




//     {
//         require_once(APPPATH.'third_party/PHPMailer-master/src/PHPMailer.php');
//         $mail = new PHPMailer();
//         $mail->IsSMTP(); // we are going to use SMTP
//         $mail->SMTPAuth   = true; // enabled SMTP authentication
//         $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
//         $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
//         $mail->Port       = 465;                   // SMTP port to connect to GMail
//         $mail->Username   = "muhammadahsanali.arwaj@gmail.com";  // user email address
//         $mail->Password   = "arwaj@12345";            // password in GMail
//         $mail->SetFrom('mail@gmail.com', 'Mail');  //Who is sending 
//         $mail->isHTML(true);
//         $mail->Subject    = "Mail Subject";
//         $mail->Body      = '
//             <html>
//             <head>
//                 <title>Title</title>
//             </head>
//             <body>
//             <h3>Heading</h3>
//             <p>Message Body</p><br>
//             <p>With Regards</p>
//             <p>Your Name</p>
//             </body>
//             </html>
//         ';
//         $destino = 'muhammadahsanali.arwaj@gmail.com'; // Who is addressed the email to
//         $mail->AddAddress($destino, "Receiver");
//         if(!$mail->Send()) {
//             return false;
//         } else {
//             return true;
//         }
//     }    
    
// }


?>
