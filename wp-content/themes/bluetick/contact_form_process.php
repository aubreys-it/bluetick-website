<?php

define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require ('../../../wp-blog-header.php');

if (verifyContactFormToken('contact_form')) {

   if(isset($_POST['hiddenRecaptcha'])) {
     
        // CHANGE THE TWO LINES BELOW
        //$email_to = "SugarloafSummit.PPML@lead2lease.com";
        $email_to = "csarvis@matrixresidential.com";

        $email_subject = "‐‐New Email Lead For Olea at Viera‐‐";


        function died($error) {
            // your error code can go here
            echo "We are very sorry, but there were error(s) found with the form you submitted. ";
            echo "These errors appear below.<br /><br />";
            echo $error."<br /><br />";
            echo "Please go back and fix these errors.<br /><br />";
            die();
        }

        // validation expected data exists
        if(!isset($_POST['FullName']) ||
            !isset($_POST['EmailAddr'])) {
            died('We are sorry, but there appears to be a problem with the form you submitted.');       
        }

        $first_name = $_POST['FirstName']; // not required
        $last_name = $_POST['LastName']; // not required
        $email_from = $_POST['EmailAddr']; // required
        $phone_number = $_POST['PhoneNumber']; // required        
        $move_in_date = $_POST['MoveInDate']; // not required
        $bedrooms = $_POST['Bedrooms']; // not required
        $pets = $_POST['Pets']; // not required
        $how_did_you_hear_about_us = $_POST['HowDidYouHearAboutUs']; // not required
        
        $message = $_POST['Message']; // not required

        $error_message = "";
        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
      if(!preg_match($email_exp,$email_from)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
      }

      if(strlen($error_message) > 0) {
        died($error_message);
      }
        $email_message = "I'm interested in more information about The Catherine!\n\n";

        function clean_string($string) {
          $bad = array("content-type","bcc:","to:","cc:","href");
          return str_replace($bad,"",$string);
        }        

        $email_message .= "First Name: ".clean_string($first_name)."\n"; 
        $email_message .= "Last Name: ".clean_string($last_name)."\n";
        $email_message .= "Address: "."\n";
        $email_message .= "Address2: "."\n";
        $email_message .= "City: "."\n";
        $email_message .= "State: "."\n";
        $email_message .= "Zip: "."\n";
        $email_message .= "Home Phone: ".clean_string($phone_number)."\n";
        $email_message .= "Cell Phone: "."\n";
        $email_message .= "Work Phone: "."\n";
        $email_message .= "Email Address: ".clean_string($email_from)."\n";        
        $email_message .= "Lead Channel: "."\n";
        $email_message .= "Lead Priority: "."\n";
        $email_message .= "Desired Move In: ".clean_string($move_in_date)."\n";
        $email_message .= "Desired Lease Term: "."\n";
        $email_message .= "Desired Unit Type: "."\n";
        $email_message .= "Desired Bedrooms: ".clean_string($bedrooms)."\n";
        $email_message .= "Desired Bathrooms: "."\n";
        $email_message .= "Pets: ".clean_string($pets)."\n";
        $email_message .= "Pet Types: "."\n";
        $email_message .= "How did you hear about us?: ".clean_string($how_did_you_hear_about_us)."\n";
        $email_message .= "Comments: ".clean_string($message)."\n";


        // create email headers
        $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
        @mail($email_to, $email_subject, $email_message, $headers);  
        return true;
    }
    else
    {
        return false;
    }

} else {
   
   echo "Hack-Attempt detected. Got ya!.";
   //writeLog('Formtoken');
   return false;

}



    
?>