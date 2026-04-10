<?php
    
	



// use wordwrap() if lines are longer than 70 characters
if( function_exists( 'mail' ) ) 
	{ 
		echo 'mail() is available'; 
	} 
	else 
		{ 
			echo 'mail() has been disabled'; 
		}
            

// send email
	$headers = array("From: sangeetamalviya08@gmail.com", "Reply-To: sangeetamalviya08@gmail.com", "X-Mailer: PHP/" . PHP_VERSION );
	 $headers = implode("\r\n", $headers); 
	 mail($to, $subject, $message, $headers);


             
              

  	
?>