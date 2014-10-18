<?php
session_start();
if(!isset($_SESSION['fname'])){ header("Location:index.php"); }
include "config.php";
$qry = $dbh->prepare("SELECT * FROM pg_user WHERE  email = :username");
$qry->execute(array('username' => $_SESSION['username']));
$row = $qry->fetch(PDO::FETCH_ASSOC);
if (count($row)){
$fname=$row["first_name"];
$lname=$row["last_name"];
$mnum=$row["mobile_no"];
$email=$row["email"];
$mnum=$row["mobile_no"];
}else{
	echo "Issue with user Profile";
}

$dbh = NULL;
?>

<form id="userprofile" role="form" class="col-md-5" enctype="multipart/form-data" method="post" action="">
  <div class="form-group has-feedback">
    <label class="control-label" for="fname">First Name</label>
    <input name="fname" id="fname" type="text" maxlength="40"  class="form-control" value="<?php echo $fname ?>" disabled="disabled" />
    <span class="glyphicon form-control-feedback" id="fname1"></span>
  </div>
  <div class="form-group has-feedback">
    <label class="control-label" for="lname">Last Name</label>
    <input name="lname" id="lname" type="text" maxlength="40" class="form-control" value="<?php echo $lname ?>" disabled="disabled"/>
    <span class="glyphicon form-control-feedback" id="lname1"></span>
  </div>
  <div class="form-group has-feedback">
    <label class="control-label" for="mnum">Mobile</label>  
    <div class="input-group">
      <span class="input-group-addon">+91 -</span>
      <input name="mnum" id="mnum" type="text" maxlength="10" class="form-control" value="<?php echo $mnum ?>" disabled="disabled" />
    </div>
    <span class="glyphicon form-control-feedback" id="mnum1"></span>
  </div>
  <div class="form-group has-feedback">
    <label class="control-label" for="uemail">Email</label>
    <input name="uemail" id="uemail" type="email" placeholder="@" maxlength="70" class="form-control" value="<?php echo $email ?>" disabled="disabled" />
    <span class="glyphicon form-control-feedback" id="uemail1"></span>
  </div>
  <div class="form-group has-feedback">
    <label class="control-label" for="passwd">Password</label>
    <input name="passwd" id="passwd" type="password" class="form-control" disabled="disabled" />
    <span class="glyphicon form-control-feedback" id="passwd1"></span>  
  </div>
  <div class="form-group has-feedback">
    <label class="control-label" for="repasswd">Re-enter Password</label>
    <input name="repasswd" id="repasswd" type="password" class="form-control" disabled="disabled" />
    <span class="glyphicon form-control-feedback" id="repasswd1"></span>
  </div>
  <button type="button" id="userprofilebtn" name="userprofilebtn" class="btn btn-primary">Edit Profile</button>
  <button type="submit" id="saveuserprofile" name="saveuserprofile" class="btn btn-primary sr-only">Submit</button> 
</form>