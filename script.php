<?php
   
   $file = "data/index.html";
   $arr_data = array(); // create empty array

   $email = $_POST['email'];
   
   $dt = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
   $now = $dt->format("Y-m-d H:i:s");

  try
  {

    // Function to get the client ip address
    function get_client_ip_server() {
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
     
        return $ipaddress;
    }

    $dir = 'data';
    $clientIp = get_client_ip_server();

     // create new directory with 744 permissions if it does not exist yet
     // owner will be the user/group the PHP script is run under
     if ( !file_exists($dir) ) {
         $oldmask = umask(0);  // helpful when used in linux server  
         mkdir ($dir, 0744);
     }

       //Get form data
       $formdata = array(
          'email'=>$email
       );

       $json = json_decode(file_get_contents($file), true);

        $json[$email] = array(
            "email"=>$email, 
            "date" => $now, 
            "ip_address"=>$clientIp
        );
        
        if(file_put_contents($file, json_encode($json))) {
            echo 'Thank you. We\'ll be in touch.';
        }
       else {
            echo "Error happens. Please try again.";
       }
   }
   catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
   }

?>