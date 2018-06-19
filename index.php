<?php 
    include("dbconfig.php");
?>

<?php
function timeAgo($time_ago){

			$time_ago = strtotime($time_ago);
			$cur_time   = time();
			$time_elapsed   = $cur_time - $time_ago;
			$seconds    = $time_elapsed ;
			$minutes    = round($time_elapsed / 60 );
			$hours      = round($time_elapsed / 3600);
			$days       = round($time_elapsed / 86400 );
			$weeks      = round($time_elapsed / 604800);
			$months     = round($time_elapsed / 2600640 );
			$years      = round($time_elapsed / 31207680 );
			// Seconds
			if($seconds <= 60){
			    return "just now";
			}
			//Minutes
			else if($minutes <=60){
			    if($minutes==1){
			        return "one minute ago";
			    }
			    else{
			        return "$minutes minutes ago";
			    }
			}
			//Hours
			else if($hours <=24){
			    if($hours==1){
			        return "an hour ago";
			    }else{
			        return "$hours hrs ago";
			    }
			}
			//Days
			else if($days <= 7){
			    if($days==1){
			        return "yesterday";
			    }else{
			        return "$days days ago";
			    }
			}
			//Weeks
			else if($weeks <= 4.3){
			    if($weeks==1){
			        return "a week ago";
			    }else{
			        return "$weeks weeks ago";
			    }
			}
			//Months
			else if($months <=12){
			    if($months==1){
			        return "a month ago";
			    }else{
			        return "$months months ago";
			    }
			}
			//Years
			else{
			    if($years==1){
			        return "one year ago";
			    }else{
			        return "$years years ago";
			    }
			}
		} 
?>
<?php 
  if(isset($_POST["btn-login"]))
  {
      $email=$_POST["txt_uname_email"];
      $pass=$_POST["txt_password"];
      
      $sql=mysqli_query($con,"select * from registration where email='$email' and password='$pass'");
      if(mysqli_num_rows($sql))
      {
          while($row=mysqli_fetch_array($sql))
          {   
              $name=$row["name"];
              $id=$row["usr_id"];
              session_start();
              $_SESSION["name"]=$name;
              $_SESSION["id"]=$id;
              $_SESSION["email"]=$email;
              
          }
        header("location:user.php");
      }
      else{
         //$error="";
         echo '<script>alert("plz inter valid password");</script>';


      }

  }

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
		echo '<script>alert("this type of file does not supported !");</script>';	
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

	else
	{
		//$sql="insert into registration values();"
		$sql= mysqli_query($con,"insert into registration(name,email,image,password) values('$uname','$umail','$pic','$upass')");
		if($sql)
		{  
            move_uploaded_file($tmp,$path);
		   $error[] = "Registration successfully for login click on sign button";
		   echo '<script>alert("Registration successfully for login click on sign button");</script>';
		   $icon="success";
	       $class="success";	
		}
	}	
}

?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<!-- Mirrored from www.vasterad.com/themes/workscout/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Jun 2017 06:31:38 GMT -->
<head>

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Work Scout</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="css1/style.css">
<link rel="stylesheet" href="css1/colors/green.css" id="colors">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css" id="colors">


<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body>
<div id="wrapper">


<!-- Header
================================================== -->
<header class="transparent sticky-header full-width">
<div class="container">
	<div class="sixteen columns">
	
		<!-- Logo -->
		<div id="logo" style="margin-top:15px">
			<h1><a href="index.php"><font style="font-size:25px; color:white">Help Each Other</font></a></h1>
		</div>

		<!-- Menu -->
		<nav id="navigation" class="menu">
			<ul id="responsive">

				<li><a data-toggle = "modal" data-target = "#myModal" id="current">Post</a>
					
				</li>
			</ul>


			<ul class="float-right">
				
				<li><a data-toggle = "modal" data-target = "#signupModal"><i class="fa fa-user" ></i> Sign Up</a></li>
				<li><a data-toggle = "modal" data-target = "#myModal"><i class="fa fa-lock"></i> Log In</a></li>
			</ul>

		</nav>

		<!-- Navigation -->
		<div id="mobile-navigation">
			<a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
		</div>

	</div>
</div>
</header>
<div class="clearfix"></div>


<!-- Banner
================================================== -->
<div id="banner" class="with-transparent-header parallax background" style="background-image: url(images/banner-home-02.jpg)" data-img-width="2000" data-img-height="1330" data-diff="300">
	<div class="container">
		<div class="sixteen columns">
			
			<div class="search-container">

				
				
				<!-- Announce -->
				<div class="announce">
					We’ve over <strong>15 000</strong> Post offers for you!
				</div>

			</div>

		</div>
	</div>
</div>


<!-- Content
================================================== -->


<!-- Modal for login -->
<div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog">
      <div class = "modal-content">
         
         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
            
            <h4 class = "modal-title" id = "myModalLabel">
               Fill Detail here
            </h4>
         </div>
         <form class="form-signin" method="post" id="login-form">
         
         <div class = "modal-body">
            <input type="email" name="txt_uname_email" placeholder="Enter Your email here" />
         </div>
         <div class = "modal-body">
            <input type="password" name="txt_password" placeholder="Enter Your password" />
         </div>
         
         <div class = "modal-footer">
            
            <input type = "submit" class = "btn btn-primary" name="btn-login" value="LOG IN">
               
            </input>
			<button type = "button" class = "btn btn-default" data-dismiss = "modal">
               Close
            </button>
            
        </form>
         </div>
         
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->

<!-- Modal for login -->
<div class = "modal fade" id = "signupModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog">
      <div class = "modal-content">
         
         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
            
            <h4 class = "modal-title" id = "myModalLabel">
               Fill Detail here
            </h4>
            <form method="post" class="form-signin" enctype="multipart/form-data">
         </div>
         <div class = "modal-body">
            Name: <input type="text" name="txt_uname" placeholder="Enter Your name" required/>
         </div>
         
         <div class = "modal-body">
            Email : <input type="email" name="txt_umail" placeholder="Enter Your email here" required/>
         </div>
         <div class = "modal-body">
            Password: <input type="password" name="txt_upass" placeholder="Enter Your password" required/>
         </div>
         <div class = "modal-body">
            Slect Your Photo: <input type="file" name="img" required/>
         </div>
         
         <div class = "modal-footer">
            
            <input type = "submit" class = "btn btn-primary" value="SIGN UP" name="btn-signup">
			 <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               Close
            </button>
           
		   
            </input>
         </div>
         </form>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->

<!-- Content
================================================== -->
<div class="container">
	<!-- Recent Jobs -->
	<h1 class="text-center">Newly Posted Job</h1>
	<div class="eleven columns">
	<div class="padding-right">
		
		

		<ul class="job-list full">
			<?php 
           $sql=mysqli_query($con,"select * from posts join registration where posts.usr_id_p=registration.usr_id order by posts.status_time desc limit 1,6");
                             while($row=mysqli_fetch_array($sql))
                               {
                                        $title=$row["status_title"];
                                        $status=$row["status"];
                                        $img=$row["image"];
                                        $name=$row["name"];
                                        $time=$row["name"];
                                        $time_ago=$row["status_time"];
                                      echo '<li><a href="#">';
				                          echo '<img src="user_images/'.$img.'" alt="">';
				                             echo '<div class="job-list-content">';
					                           echo '<h4>'.$title.'</h4>';
					                            
					                           echo '</div>';
					                           echo '<p>'.$status.'sdjgfj kjdsaghfj jhdgshj hjagsda gshads sjagdj</p>';
					                           echo '<div class="job-icons" style="margin-left:100px">';
					                            	echo '<span><i class=""></i><strong>Posted by:<strong> '.$name.'</span>';
						                           echo '<span><i class=""></i> </span><br>';
						                          echo '<span><i class=""></i><font style="color:blue">'.timeAgo($time_ago).'</font></span>';
				                               echo '</div>';
				                                echo '</a>';
				                          echo '<a data-toggle = "modal" data-target = "#myModal" class="btn btn-default" >comment</a>';
				                          echo '<br/><br/>';
			                            echo '</li>';

                               }
           ?>
			
		</ul>
		<div class="clearfix"></div>

		<div class="pagination-container">
			
			
		</div>

	</div>
	</div>


	<!-- Widgets -->
	<div class="five columns">
          
		<!-- Sort by -->
		<div class="widget">
            
			<img src="images/post_a_job.jpg" height="100px" width="100px"/>


		</div>

		<!-- Location -->
		<div class="widget">
			
			
		</div>

		<!-- Job Type -->
		<div class="widget">
			<h2>Find Jobs & Post Jobs</h2>

			<ul class="checkboxes">
				<li>
					<img src="images/fb-jobs.png" height="100px" width="100px"/>
					
				</li>
				
			</ul>

		</div>

		


	</div>
	<!-- Widgets / End -->


</div>






<!-- Footer
================================================== -->
<div class="margin-top-15"></div>

<div id="footer">
	

	<!-- Bottom -->
	<div class="container">
		<div class="footer-bottom">
			<div class="sixteen columns">
				<h4>Follow Us</h4>
				<ul class="social-icons">
					<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
					<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
					<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
				</ul>
				<div class="copyrights">©  Copyright 2018 by <a href="#">Projectworlds</a>. All Rights Reserved.</div>
			</div>
		</div>
	</div>

</div>

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>

</div>
<!-- Wrapper / End -->


<!-- Scripts
================================================== -->
<script src="scripts/jquery-2.1.3.min.js"></script>
<script src="scripts/custom.js"></script>
<script src="scripts/jquery.superfish.js"></script>
<script src="scripts/jquery.themepunch.tools.min.js"></script>
<script src="scripts/jquery.themepunch.revolution.min.js"></script>
<script src="scripts/jquery.themepunch.showbizpro.min.js"></script>
<script src="scripts/jquery.flexslider-min.js"></script>
<script src="scripts/chosen.jquery.min.js"></script>
<script src="scripts/jquery.magnific-popup.min.js"></script>
<script src="scripts/waypoints.min.js"></script>
<script src="scripts/jquery.counterup.min.js"></script>
<script src="scripts/jquery.jpanelmenu.js"></script>
<script src="scripts/stacktable.js"></script>
<script src="scripts/headroom.min.js"></script>
<script src="bootstrap/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>





		
		
			
		
	
		
		
	
	
		
</div>


</body>

<!-- Mirrored from www.vasterad.com/themes/workscout/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Jun 2017 06:32:06 GMT -->
</html>