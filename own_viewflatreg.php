<?php
error_reporting(E_ERROR | E_PARSE);
// setup some variables/arrays
$action = array();
$action['result'] = null;
$text = array();
// check if the form has been submitted
if (isset($_POST['submitflatadd'])) {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // cleanup the variables
    // prevent mysql injection
    $flatno = mysqli_real_escape_string($link, $_POST['flatno']);
    $aptname = mysqli_real_escape_string($link, $_POST['aptname']);
    $societyname = mysqli_real_escape_string($link, $_POST['societyname']);
    $locality = mysqli_real_escape_string($link, $_POST['locality']);
    $street = mysqli_real_escape_string($link, $_POST['street']);
    $address2 = mysqli_real_escape_string($link, $_POST['address2']);
    $town = mysqli_real_escape_string($link, $_POST['town']);
    $state = mysqli_real_escape_string($link, $_POST['state']);
    $pincode = mysqli_real_escape_string($link, $_POST['pincode']);
    $country = mysqli_real_escape_string($link, $_POST['country']);
    $tocc = mysqli_real_escape_string($link, $_POST['tocc']);
	$dth = isset($_POST['dth']) ? 1 : 0;
	$wifi = isset($_POST['wifi']) ? 1 : 0;
	$maidcook = isset($_POST['maidcook']) ? 1 : 0;
	$maidclean = isset($_POST['maidclean']) ? 1 : 0;
	$wash = isset($_POST['wash']) ? 1 : 0;
	$hotwater = isset($_POST['hotwater']) ? 1 : 0;
    // quick and simple validation
    if (empty($flatno)) {$action['result'] = 'alert-danger'; array_push($text, 'Please enter the Flat Number');}
    else {
      $flatno = clean($flatno);
      // check if Flat Number only contains alphanumerics or hyphen
      if (!preg_match("/^[a-zA-Z\-0-9 ]*$/", $flatno)) {
        $action['result'] = 'alert-danger'; array_push($text, 'Only Alphanumerics and Hyphen allowed in Flat No.');
      }
    }
    if (empty($aptname)) {$action['result'] = 'alert-danger'; array_push($text, 'Please enter the Apartment Name');}
    else {
      $aptname = clean($aptname);
      // check if Apartment name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/", $aptname)) {
        $action['result'] = 'alert-danger'; array_push($text, 'Only letters and white space allowed in Apartment Name');
      }
    }
    if (empty($societyname)) {$action['result'] = 'alert-danger'; array_push($text, 'Please enter the Society Name');}
    else {
      $societyname = clean($societyname);
      // check if Society name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/", $societyname)) {
        $action['result'] = 'alert-danger'; array_push($text, 'Only letters and white space allowed in Society Name');
      }
    }
    if (empty($locality)) {$action['result'] = 'alert-danger'; array_push($text, 'Please enter the Locality');}
    else {
      $locality = clean($locality);
      // check if Locality only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/", $locality)) {
        $action['result'] = 'alert-danger'; array_push($text, 'Only letters and white space allowed in Locality');
      }
    }
    if (empty($street)) {$action['result'] = 'alert-danger'; array_push($text, 'Please enter the Street Name');}
    else {
      $street = htmlspecialchars($street);
      // check if Street only contains Alphanumeric, /,-,_ and whitespace
      if (!preg_match("/^[a-zA-Z0-9#\-.:, \/]*$/", $street)) {
        $action['result'] = 'alert-danger'; array_push($text, 'Only Alphanumerics, hyphen, hash, comma, dot, colon, slash and Space allowed in Street Name');
      }
    }
    $address2 = htmlspecialchars($address2);
    // check if Address2 only contains Alphanumeric, /,-,_ and whitespace
    if (!preg_match("/^[a-zA-Z0-9#\-.:, \/]*$/", $address2)) {
      $action['result'] = 'alert-danger'; array_push($text, 'Only Alphanumerics, hyphen, hash, comma, dot, colon, slash and Space allowed in Address2');
    }
    if (empty($town)) {$action['result'] = 'alert-danger'; array_push($text, 'Please enter the Town');}
    else {
      $town = clean($town);
      // check if Town only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/", $town)) {
        $action['result'] = 'alert-danger'; array_push($text, 'Only letters and white space allowed in Town Name');
      }
    }
    if (empty($state)) {$action['result'] = 'alert-danger'; array_push($text, 'Please enter the State');}
    else {
      $state = clean($state);
      // check if State only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/", $state)) {
        $action['result'] = 'alert-danger'; array_push($text, 'Only letters and white space allowed in State');
      }
    }
    if (empty($pincode)) {$action['result'] = 'alert-danger'; array_push($text, 'Please enter the Pincode');}
    else {
      $pincode = clean($pincode);
      // check if Pincode is a number only
      if (!preg_match("/^[0-9]{6}/", $pincode)) {$action['result'] = 'alert-danger'; array_push($text, 'Invalid Pincode');}
    }
    if (empty($tocc)) {$action['result'] = 'alert-danger'; array_push($text, 'Please Select the Total Occupancy');}
    else {
      $tocc = clean($tocc);
      // check if Total Occupancy is a number only
      if (!preg_match("/^[0-9]/", $tocc)) {$action['result'] = 'alert-danger'; array_push($text, 'Invalid Total Occupancy');}
    }
    if ($action['result'] != 'alert-danger') {
      // add to the database
      $add = mysqli_query($link, "INSERT INTO `test_flats` VALUES('$flatno','$aptname','$societyname','$locality','$street','$address2','$town','$state','$pincode','INDIA','$dth','$wifi','$maidcook','$maidclean','$wash','$hotwater','$tocc')");
      if ($add) {
		$action['result'] = 'alert-success'; array_push($text, 'Flat successfully Added!');
      }
      else {
        $action['result'] = 'alert-danger'; array_push($text, 'Flat Was not Added. Reason: ' . mysqli_error($link));
      }
    }
    $action['text'] = $text;
  }
}
mysqli_close($link);
?>
<?= show_errors($action); ?>
<form id="regflat" role="form" enctype="multipart/form-data" method="post" action="">
  <div class="row">
      <div class="form-group has-feedback col-sm-6">
        <label class="control-label" for="flatno">Flat No.</label>
        <input name="flatno" id="flatno" type="text" maxlength="40"  class="form-control" placeholder="G-103" disabled="disabled" />
      </div>
      <div class="form-group has-feedback col-sm-6">
        <label class="control-label" for="aptname">Apartment Name</label>
        <input name="aptname" id="aptname" type="text" maxlength="70" class="form-control" placeholder="Omega Paradise" disabled="disabled"/>
      </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group has-feedback">
        <label class="control-label" for="societyname">Society Name</label>
        <input name="societyname" id="societyname" type="text" maxlength="70"  class="form-control" placeholder="Omega Paradise" disabled="disabled"/>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group has-feedback">
        <label class="control-label" for="locality">Locality</label>
        <input name="locality" id="locality" type="text" maxlength="70"  class="form-control" placeholder="Wakad" disabled="disabled"/>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="form-group has-feedback">
        <label class="control-label" for="street">Postal Address</label>
        <input name="street" id="street" type="text" maxlength="70"  class="form-control" placeholder="Street Name" disabled="disabled"/>
        </div>
         <div class="form-group has-feedback">
        <input name="address2" id="address2" type="text" maxlength="70"  class="form-control" placeholder="Address 2 (Optional)" disabled="disabled"/>
        </div>
         <div class="form-group has-feedback">
        <input name="town" id="town" type="text" maxlength="70"  class="form-control" placeholder="Village/Town/City" disabled="disabled"/>
		</div>
        <div class="form-group has-feedback">
        <input name="state" id="state" type="text" maxlength="70"  class="form-control" placeholder="State" disabled="disabled"/>
        </div>
         <div class="form-group has-feedback">        
        <label class="control-label sr-only" for="pincode">Hidden PinCode</label>
        <input name="pincode" id="pincode" type="text" maxlength="6"  class="form-control" placeholder="Pincode" disabled="disabled"/>
        </div>
         <div class="form-group has-feedback">        
        <label class="control-label sr-only" for="country">Hidden Country</label>
        <input name="country" id="country" type="text" class="form-control" value="India" readonly/>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <i class="fa fa-home fa-fw"></i> Facilities Available
        </div>
        <div class="panel-body">
          <div class="form-group">
            <label class="checkbox-inline">
            <input type="checkbox" name="dth" checked disabled> <i class="fa fa-video-camera fa-fw"></i> DTH Television</label>
          </div>
          <div class="form-group">
            <label class="checkbox-inline">
            <input type="checkbox" name="wifi" checked disabled> <i class="fa fa-rss fa-fw"></i> Wifi Connectivity</label>
          </div>
          <div class="form-group">
            <label class="checkbox-inline">
            <input type="checkbox" name="maidcook" disabled="disabled"> <i class="fa fa-female fa-fw"></i> Maid for Cooking</label>
          </div>
          <div class="form-group">
            <label class="checkbox-inline">
            <input type="checkbox" name="maidclean" disabled="disabled"> <i class="fa fa-male fa-fw"></i> Maid for Cleaning</label>
          </div>
          <div class="form-group">
            <label class="checkbox-inline">
            <input type="checkbox" name="wash" checked disabled> <i class="fa fa-hand-o-right fa-fw"></i> Washing Machine</label>
          </div>
          <div class="form-group">
            <label class="checkbox-inline">
            <input type="checkbox" name="hotwater" checked disabled> <i class="fa fa-steam fa-fw"></i> Geyser</label>
          </div>
          <div class="form-group">
            <label class="checkbox-inline">
            <input type="checkbox" value="power" checked disabled> <i class="fa fa-bolt fa-fw"></i> Power Supply</label>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="row">
    <div class="col-md-4">
      <div class="form-group ">
        <label class="control-label" for="flatrent">Tenant Base Rent</label>  
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-inr fa-fw"></i></span>
          <input name="flatrent" id="flatrent" type="text" maxlength="6" class="form-control" disabled="disabled" value="5000" />
          <span class="input-group-addon"> .00</span>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group ">
        <label class="control-label" for="preocc">Present Occupancy</label>  
        <select name="preocc" class="form-control" id="preocc" disabled="disabled">
          <option value=""></option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option selected="selected">4</option>
          <option>5</option>
          <option>6</option>
          <option>7</option>
          <option>8</option>
          <option>9</option>
          <option>10</option>
          <option>11</option>
          <option>12</option>
          <option>13</option>
          <option>14</option>
          <option>15</option>
        </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group ">
        <label class="control-label" for="tocc">Total Occupancy</label>  
        <select name="tocc" class="form-control" id="tocc" disabled="disabled">
          <option value="" ></option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option selected="selected">6</option>
          <option>7</option>
          <option>8</option>
          <option>9</option>
          <option>10</option>
          <option>11</option>
          <option>12</option>
          <option>13</option>
          <option>14</option>
          <option>15</option>
        </select>
      </div>
    </div>
  </div>
  <!--Row End-->
  <br>
  <div class="panel panel-default">
    <div class="panel-heading">
      <p class="panel-title"><strong>Lease Details</strong></p>
    </div>
    <div class="panel-body" style="background-color:#f5f5f5">
      <div class="row">
        <div class="col-md-4 col-sm-6">
          <div class="form-group">
            <label class="control-label" for="leasestart">Start Date</label>  
            <div class="input-group">
              <input name="leasestart" id="leasestart" type="text" class="form-control" disabled="disabled" value="01/Jun/2014" />
              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="form-group">
            <label class="control-label" for="leaseend">End Date</label>  
            <div class="input-group">
              <input name="leaseend" id="leaseend" type="text" class="form-control" disabled="disabled" value="31/May/2015"/>
              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="form-group">
            <label class="control-label" for="leasedays">Days Remaining</label>  
            <input name="leasedays" id="leasedays" type="text" class="form-control" value="267" readonly="readonly"/>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="form-group ">
            <label class="control-label" for="leaserentdue">Rental Cycle</label>  
            <select name="leaserentdue" class="form-control" id="leaserentdue" disabled="disabled">
              <option value=""></option>
              <option selected="selected">Monthly</option>
              <option>Quarterly</option>
              <option>Half Yearly</option>
              <option>Yearly</option>
            </select>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="form-group">
            <label class="control-label" for="leaserent">Rental</label>  
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-inr fa-fw"></i></span>
              <input name="leaserent" id="leaserent" type="text" maxlength="7" class="form-control" value="16000" readonly="readonly"/>
              <span class="input-group-addon"> .00</span>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="form-group ">
            <label class="control-label" for="leaserentduedate">Rental Due Date</label>  
            <div class="input-group">
              <input name="leaserentduedate" id="leaserentduedate" type="text" class="form-control" value="1" disabled="disabled" />
              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
          </div>
        </div>
      </div>
      <!--Row End-->
    </div>
  </div>
  <!--Lease Panel End -->
  <div class="form-group">
    <span class="help-block">Re-Verify All the above Details before Submitting.</span>
  </div>
  <button type="submit" id="changepreocc" name="changepreocc" class="btn btn-primary">Change Present Occupancy</button>
  <p class="pull-right">
  <button type="submit" id="submitflatedit" name="submitflatedit" class="btn btn-warning">Edit Flat</button>
  <button type="submit" id="submitflatdelete" name="submitflatdelete" class="btn btn-danger">Delete Flat</button>
    </p>
    
</form>