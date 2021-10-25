<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "stefan.schmitt@s5-tech.com,peter.schmitt@s5-tech.com,cesar.bandera@s5-tech.com";
    // $email_to = "daniel.strano@s5-tech.com";
    $email_subject = "Cellpodium Purchase Form";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['beaconno']) ||
        !isset($_POST['address']) ||
        !isset($_POST['usage'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $phone = $_POST['phone']; // required
    $beaconno = $_POST['beaconno']; // required
    $address = $_POST['address']; // required
    $usage = $_POST['usage']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(strlen($address) < 2) {
    $error_message .= 'The street address you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Phone: ".clean_string($phone)."\n";
    $email_message .= "Address: ".clean_string($address)."\n";
    $email_message .= "# of Beacons: ".clean_string($beaconno)."\n";
    $email_message .= "Usage: ".clean_string($usage)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
<head>
<title>Cellpodium - Thank you!</title>
</head>
<body>
<div style="text-align:center;margin-top:100px;margin-bottom:50px;""><a href="/"><img src="../img/logo_transparent.png" alt="Cellpodium Logo" style="height:300px;"></a></div>
<h1 style="text-align:center; color:black; font-family: Courier New; font-weight:bold;">Thank You!</h1>
<h2 style="margin-left:400px;margin-right:400px;text-align:center; color:black; font-family: Courier New;">Thank you for reaching out to us! Your message has been sent, and a representative will contact you soon!</h3>
<br/>
<h2 style="margin-left:400px;margin-right:400px;text-align:center; color:black; font-family: Courier New; font-style: normal;"><a href="/">Back to site</a>
</body>
 
<?php
 
}
?>