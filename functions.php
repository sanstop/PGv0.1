<?php

function clean($data){
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

function format_email($info, $format){

	//set the root
	$root = $_SERVER['DOCUMENT_ROOT'].'/dev/tutorials/email_signup/source_revised';

	//grab the template content
	$template = file_get_contents($root.'/signup_template.'.$format);
			
	//replace all the tags
//	$template = preg_replace('{USERNAME}', $info['username'], $template);
	$template = preg_replace('/\{EMAIL\}/', $info['email'], $template);
	$template = preg_replace('/\{KEY\}/', $info['key'], $template);
	$template = preg_replace('/\{SITEPATH\}/','http://localhost:8888', $template);
	
/*
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com',465,'ssl')
->setUsername('myusername@gmail.com')
->setPassword('mypassword');
	
*/
	
		
	//return the html of the template
	return $template;

}

//send the welcome letter
function send_email($info){
		
	//format each email
	$body = format_email($info,'html');
	$body_plain_txt = format_email($info,'txt');

	//setup the mailer
	$transport = Swift_MailTransport::newInstance();
	$mailer = Swift_Mailer::newInstance($transport);
	$message = Swift_Message::newInstance();
	$message ->setSubject('Welcome to Site Name');
	$message ->setFrom(array('noreply@sitename.com' => 'Site Name'));
	$message ->setTo(array($info['email'] => $info['username']));
	
	$message ->setBody($body_plain_txt);
	$message ->addPart($body, 'text/html');
			
	$result = $mailer->send($message);
	
	return $result;
	
}
//cleanup the errors
function show_errors($action){
	$error = false;
	if(!empty($action['result'])){
		$coun = count($action['text']);
		$error = "<div class=\"alert $action[result]\">"."\n";
		if($coun > 1){
			//loop out each error
			foreach($action['text'] as $text){
				$error .= "<span class=\"glyphicon glyphicon-remove\"></span>"." "."$text"."<br>";
			}
		}else{
			//single error
			if ($action['result'] == 'alert-danger'){
			$error .= "<span class=\"glyphicon glyphicon-remove\"></span>"." ".$action['text'][0];
			}
			else {
        	$error .= "<span class=\"glyphicon glyphicon-ok\"></span>"." ".$action['text'][0];
			}
		}
		$error .= "</div>";	
	}
	return $error;
}