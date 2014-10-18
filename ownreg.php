<?php
error_reporting(E_ERROR | E_PARSE);
//setup some variables/arrays
$action = array();
$action['result'] = null;
$text = array();

//check if the form has been submitted
if(isset($_POST['submit'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
	//cleanup the variables
	//prevent mysql injection
	$fname = mysqli_real_escape_string($link,$_POST['fname']);
	$lname = mysqli_real_escape_string($link,$_POST['lname']);
	$mnum = mysqli_real_escape_string($link,$_POST['mnum']);
	$uemail = mysqli_real_escape_string($link,$_POST['uemail']);
	$reuemail = mysqli_real_escape_string($link,$_POST['reuemail']);
	$passwd = mysqli_real_escape_string($link,$_POST['passwd']);
	$repasswd = mysqli_real_escape_string($link,$_POST['repasswd']);
	//quick and simple validation
	if(empty($fname)){$action['result'] = 'alert-danger'; array_push($text,'Please enter your First Name');}
	else {
     $fname = clean($fname);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
     $action['result'] = 'alert-danger'; array_push($text,'Only letters and white space allowed in First Name');
     }
   }
	if(empty($lname)){ $action['result'] = 'alert-danger'; array_push($text,'Please enter your Last Name'); }
	else {
     $lname = clean($lname);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
     $action['result'] = 'alert-danger'; array_push($text,'Only letters and white space allowed in Last Name');
     }
   }
	if(empty($mnum)){ $action['result'] = 'alert-danger'; array_push($text,'Please enter your Mobile Number'); }
	else {
		$mnum = clean($mnum);
		// check if Mobile is a number only
		if (!preg_match("/^[0-9]{10}/", $mnum)){
        $action['result'] = 'alert-danger'; array_push($text,'Invalid Mobile Number'); }
	}
	if(empty($uemail)){ $action['result'] = 'alert-danger'; array_push($text,'Please enter your email'); }
	else {
		$uemail = clean($uemail);
		$uemail = strtolower ($uemail);
		// check if e-mail address syntax is valid
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$uemail)){
        $action['result'] = 'alert-danger'; array_push($text,'Invalid email format'); }
	}
	if(empty($reuemail)){ $action['result'] = 'alert-danger'; array_push($text,'Please re-enter your email'); }
	else {
		$reuemail = clean($reuemail);
		$reuemail = strtolower ($reuemail);
		// check if equal to uemail
		if ($uemail != $reuemail){
        $action['result'] = 'alert-danger'; array_push($text,'Emails do not match'); }
	}
	if(empty($passwd)){ $action['result'] = 'alert-danger'; array_push($text,'Please enter a password '); }
	if(empty($repasswd)){ $action['result'] = 'alert-danger'; array_push($text,'Please re-enter the password'); }
	if ($passwd != $repasswd){$action['result'] = 'alert-danger'; array_push($text,'Passwords Donot Match'); }
	if($action['result'] != 'alert-danger'){
		$passwd = password_hash($passwd, PASSWORD_DEFAULT);
		//add to the database
    	$add = mysqli_query($link,"INSERT INTO `pg_user` VALUES('$fname','$lname','$mnum','$uemail','$passwd','0')");	
		if($add){
			//create a random key
			$key = $fname . $uemail . date('mY');
			$key = md5($key);
			//add confirm row
			$confirm = mysqli_query($link,"INSERT INTO `confirm` VALUES('$key','$uemail')");	
			if($confirm){
				$action['result'] = 'alert-success';
				array_push($text,'You have been successfully Registered!');
				/*
				//include the swift class
				include_once 'php/swift/swift_required.php';
				//put info into an array to send to the function
				$info = array(
					'fname' => $fname,
					'uemail' => $uemail,
					'key' => $key);	
				//send the email
				if(send_email($info)){					
					//email sent
					$action['result'] = 'alert-success';
					array_push($text,'Thanks for signing up. Please check your email for confirmation!');	
				}else{		
					$action['result'] = 'alert-danger';
					array_push($text,'Could not send confirm email');
				}
				*/
			}else{	
				$action['result'] = 'alert-danger';
				array_push($text,'Confirm row was not added to the database. Reason: ' . mysqli_error($link));	
			}	
		}else{
			$action['result'] = 'alert-danger';
			$err=mysqli_errno($link);
			if($err='1062'){
				array_push($text,'Your Email is already Registered with us. Please Sign In.');}
				else{
			    array_push($text,'Confirm row was not added to the database. Reason: ' . mysqli_error($link));
				}
		}
	}
	$action['text'] = $text;
}
}
mysqli_close($link);
?>
<?= show_errors($action); ?>
<form id="regowner" role="form" class="col-xs-10" enctype="multipart/form-data" method="post" action="">
  <div class="form-group has-feedback">
    <label class="control-label" for="fname">First Name</label>
    <input name="fname" id="fname" type="text" maxlength="40"  class="form-control" />
    <span class="glyphicon form-control-feedback" id="fname1"></span>
  </div>
  <div class="form-group has-feedback">
    <label class="control-label" for="lname">Last Name</label>
    <input name="lname" id="lname" type="text" maxlength="40" class="form-control" />
    <span class="glyphicon form-control-feedback" id="lname1"></span>
  </div>
  <div class="form-group has-feedback">
    <label class="control-label" for="mnum">Mobile</label>  
    <div class="input-group">
      <span class="input-group-addon">+91 -</span>
      <input name="mnum" id="mnum" type="text" maxlength="10" class="form-control" />
    </div>
    <span class="glyphicon form-control-feedback" id="mnum1"></span>
  </div>
  <div class="form-group has-feedback">
    <label class="control-label" for="uemail">Email</label>
    <input name="uemail" id="uemail" type="email" placeholder="@" maxlength="70" class="form-control" />
    <span class="glyphicon form-control-feedback" id="uemail1"></span>
  </div>
  <div class="form-group has-feedback">
    <label class="control-label" for="reuemail">Re-enter Email</label>
    <input name="reuemail" id="reuemail" type="email" placeholder="@" maxlength="70" class="form-control" />
    <span class="glyphicon form-control-feedback" id="reuemail1"></span>
  </div>
  <div class="form-group has-feedback">
    <label class="control-label" for="passwd">Password</label>
    <input name="passwd" id="passwd" type="password" class="form-control" />
    <span class="glyphicon form-control-feedback" id="passwd1"></span>  
  </div>
  <div class="form-group has-feedback">
    <label class="control-label" for="repasswd">Re-enter Password</label>
    <input name="repasswd" id="repasswd" type="password" class="form-control" />
    <span class="glyphicon form-control-feedback" id="repasswd1"></span>
  </div>
  <div class="form-group">
    <span class="help-block">By clicking on "Register Me" below, you are agreeing to the <a href="#">Terms of Service</a> and the <a href="#">Privacy Policy</a>.</span>
  </div>
  <button type="submit" id="submit" name="submit" class="btn btn-primary">Register Me</button>
</form>
