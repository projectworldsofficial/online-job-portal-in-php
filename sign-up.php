<?php 
    include("dbconfig.php");
?>
<?php
if(isset($_POST['btn-signup']))
{
	$uname = strip_tags($_POST['txt_uname']);
	$umail = strip_tags($_POST['txt_umail']);
	$upass = strip_tags($_POST['txt_upass']);
	$pic=$_FILES["img"]["name"];
    $tmp=$_FILES["img"]["tmp_name"];
    $type=$_FILES["img"]["type"];
   
      
    $path="user_images/".$pic;
	$icon="warning";
	$class="danger";
	
	if($uname=="")	{
		$error[] = "provide username !";	
	}
	else if($type=="application/pdf" || $type=="application/pdf" || $type=="application/x-zip-compressed")	{
		$error[] = "this type of file does not supported !";	
	}
	else if($pic=="")	{
		$error[] = "Select Image !";	
	}
	else if($umail=="")	{
		$error[] = "provide email id !";	
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please enter a valid email address !';
	}
	else if($upass=="")	{
		$error[] = "provide password !";
	}
	else if(strlen($upass) < 6){
		$error[] = "Password must be atleast 6 characters";	
	}
	else
	{
		//$sql="insert into registration values();"
		$sql= mysqli_query($con,"insert into registration(name,email,image,password) values('$uname','$umail','$pic','$upass')");
		if($sql)
		{  
            move_uploaded_file($tmp,$path);
		   $error[] = "Registration successfully for login click on sign button";
		   $icon="success";
	       $class="success";	
		}
	}	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coding Cage : Sign up</title>
<link href="components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="components/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
 <link rel="stylesheet" href="components/bootstrap/dist/css/style.css" />
</head>
<body>

<div class="signin-form">

<div class="container">
    	
        <form method="post" class="form-signin" enctype="multipart/form-data">
            <h2 class="form-signin-heading">Sign up.</h2><hr />
            <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-<?php echo $class; ?>">
                        <i class="glyphicon glyphicon-<?php echo $icon; ?>-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			else if(isset($_GET['joined']))
			{
				 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_uname" placeholder="Enter Username" value="<?php if(isset($error)){echo $uname;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_umail" placeholder="Enter E-Mail ID" value="<?php if(isset($error)){echo $umail;}?>" />
            </div>
            <div class="form-group">
            	<input type="password" class="form-control" name="txt_upass" placeholder="Enter Password" />
            </div>
            <div class="form-group">
            	<input type="file"  name="img"  />
            </div>


            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;SIGN UP
                </button>
            </div>
            <br />
            <label>have an account ! <a href="reg.php">Sign In</a></label>
        </form>
       </div>
</div>

</div>

</body>
</html>