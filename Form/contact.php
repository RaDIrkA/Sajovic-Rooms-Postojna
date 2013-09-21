

<?php
error_reporting(0);
@session_start();

function validateEmail($email)
{
   if(preg_match('^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}(\.[a-zA-Z]{2,3})?(\.[a-zA-Z]{2,3})?^', $email))
      return true;
   else
      return false;
}
// Validation
$error='';
if($_POST['name']=='')
{
	$error.="<li>You must enter your name.</li>";
}

if($_POST['email']=='')
{
	$error.="<li>You must enter your email.</li>";
}else if(validateEmail($_POST['email']) == false ) {
	$error.="<li>You have entered an invalid e-mail address.</li>";
	}


if($_POST['message']=='')
{
	$error.="<li>You must enter your message.</li>";
}

if($_POST['verify']!=$_SESSION['captcha_total'])
{
	$error.="<li>The verification number you entered is incorrect.</li>";
}

if($error!='')
{
	echo '<div id="valid">';
	echo $error;
	echo '</div>';	
}else{
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: SSajovic / Sobe / Rooms / Camere / Zimmer\r\n";
$headers .= "From: <".$_POST['email'].">" . "\r\n";





$message_to_send.="Ime Pošiljatelja : ".$_POST['name']. "<br>";
$message_to_send.="Elektronski naslov : ".$_POST['email']. "<br>";
$message_to_send.="Telefon  : ".$_POST['phone']. "<br/>";
$message_to_send.="Sporočilo : ".$_POST['message']. "<br/>";

mail("ssajovic@hotmail.com", "Informacije  ",$message_to_send,$headers);

/* Prepare autoresponder subject */
$respond_subject = "Thank you for your e-mail! / Zahvaljujemo se vam za poslano sporočilo!";

/* Prepare autoresponder message */
$respond_message = "Hello!<br> Pozdravljeni!<br>
					

<br>
<br>
Thank you for contacting us! We will get back to you
as soon as possible! <br>
<br>
Hvala, ker ste nas kontaktirali. Odgovorili vam bomo v najkrajšem možnem času.<br>
<br> 
Best regards!<br>
<br>
Lep pozdrav!<br>
<br>
Silvana Sajovic<br>
Kosovelova ulica 10<br>
6230, Postojna<br>
Slovenija<br>
www.postojna-rooms-sajovic.si/<br>
Phone:+386 (0)5 726 55 02/<br>
";

/* Send the message using mail() function */
mail($email, $respond_subject, $respond_message, $headers);


echo '<div class="successmessage">Email Sent Successfully.</div>';
	
	
}

?>