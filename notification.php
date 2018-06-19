<?php 
    include("dbconfig.php");
?>
<?php
  session_start();
  if($_SESSION['name']=='')
  {
     header('location:reg.php');
  }

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
  if(isset($_POST["submit"]))
  {  
  	 $status_tit=$_POST["status_title"];
     $sta=$_POST["status"];
     $uid=$_SESSION["id"];
     $sql=mysqli_query($con,"insert into posts(usr_id_p,status_title,status,status_image,status_time) 
     	values('$uid','$status_tit','$sta','',now());");
     if($sql)
     {
     	echo '<script>alert("post inserted successfully..");</script>';
     }
  }


?>
<script>
	function delete_student(id)
	{
		if(confirm("You want to delete comment ?"))
		{
		window.location.href='execution.php?yesdelete='+id;
		}
	}
</script>


<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="">
 <meta name="author" content="">
 <link rel="icon" href="../../favicon.ico">
 
 <!-- http://draganzlatkovski.com/code-projects/toggle-jquery-side-bar-menu-in-bootstrap-free-template/ -->
 
 <title>Job Post Pannel</title>
 
 <!-- jQuery -->
 
 <script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="components/bootstrap/dist/js/jquery.js"></script>
 
  
 
 <!-- Bootstrap core CSS -->
 <link href="components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
 
 <!-- Custom styles for this template -->
 <link href="components/bootstrap/dist/css/simple-sidebar.css" rel="stylesheet">
  <link href="components/bootstrap/dist/css/postmodal.css" rel="stylesheet">
  <link href="components/bootstrap/dist/css/fbbox.css" rel="stylesheet">

 

 

 
 
</head>

<body>
 
 
 


 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
 <div class="container-fluid">
 <div class="navbar-header">
 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
 <span class="sr-only">Toggle navigation</span>
 <span class="icon-bar"></span>
 <span class="icon-bar"></span>
 <span class="icon-bar"></span>
 </button>
 <a class="navbar-brand" href="#menu-toggle" id="menu-toggle"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
 </div>
 <div id="navbar" class="navbar-collapse collapse">
  
  
    <label class="navbar-text text-center text-primary" style="vertical-align:10px;font-size:medium ">HelpEachOther </label>
    <label class="navbar-text text-center text-primary" style="vertical-align:10px;font-size:medium ">Hello! <font style="font-size:13px"> <?php echo $_SESSION["name"]; ?></font> </label>


   <?php  include("header1.php"); ?>

    


 
 </div>
 </nav>
 
 
 
 <!--
<div class="center"><button data-toggle="modal" data-target="#squarespaceModal" class="btn btn-primary center-block">Post Task</button></div>
-->

 


<!-- line modal -->
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h3 class="modal-title" id="lineModalLabel">What's your Task?</h3>
		</div>
		<div class="modal-body">
			
            <!-- content goes here -->
			  <form action="" method="post" enctype="multipart/form-data">

			   						
              <div class="form-group">
                <label for="exampleInputEmail1">Task Title</label>
                <textarea   name="status_title" class="form-control" placeholder="eg:need a cleaner"></textarea>
                  
              </div>
              
              <div class="form-group">
                <label for="exampleInputPassword1">Describe your task in more detail</label>
         <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <textarea style="resize:vertical;" class="form-control" placeholder="Message..." rows="6" name="status" required></textarea>
                                </div>
                            </div>
                                          </div>

		
		<div class="modal-footer">
			<div class="btn-group btn-group-justified" role="group" aria-label="group button">
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
				</div>
				<div class="btn-group btn-delete hidden" role="group">
					<button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>
				</div>
				<div class="btn-group" role="group">
					<button type="submit" name="submit"  class="btn btn-default btn-hover-green" value="Post">Post</button>
				</div>
			</div>
		</div>
	
		

					

		</div>
		

		
	</div>
  </div>
</div>

  		</form>
 
 
 
 
 
 
 
 <div id="wrapper" class="toggled">
 <div class="container-fluid">
 <!-- Sidebar -->
 <div id="sidebar-wrapper">
 <ul class="sidebar-nav">
 <li class="sidebar-brand">
 <br>
 </li>
 <li class="sidebar-brand">
 <a href="#" class="navbar-brand">
  
  
               
 <span class="glyphicon glyphicon-user" aria-hidden="true"></span><?php echo $userRow['name']; ?>
 
 </a>
 </li>
 <li>
 <a href="home.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <font style="color:white"> Home </font></a>
 </li>
 <!--
 <li>
 <a href="#"><span  class="glyphicon glyphicon-comment"  aria-hidden="true"></span> Notification</a>
 </li> 
 
 -->
 <li>
  <a href="mytask.php"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> My Task</a>
 </li>
 
 <li>
 
 <li>
 
 </ul>
 </div>
 <!-- /#sidebar-wrapper -->
 

 
 
 
 <!-- /#page-content-wrapper -->
 </div>
 </div>
 <!-- /#wrapper -->

  
  <!-- Page Content -->
 <div id="page-content-wrapper">
 <div class="container-fluid">
 <div class="row">
 <div class="col-lg-12">
 <br>

 </div>
 </div>
 <div class="row">
 <div class="col-lg-12">

     <div>
</div>
 </div>
 </div>
 </div>
 </div>
  
  
  <!-- this is div for user post -->
<div class="fluid-container">
<div class="row" style="clear:both">
 <div class="col-lg-12">
 	    <div class="col-lg-4">
		<div class="list-group" style="margin-left:0px">
  <a href="user.php" class="list-group-item">
    All task
  </a>
     <a href="ourskill.php" class="list-group-item ">Profile
  </a>

  <a href="my_task.php" class="list-group-item">My task
  </a>
  <a href="" data-toggle="modal" data-target="#squarespaceModal" class="list-group-item">
  	Post Task
  </a>
  <a href="notification.php" class="list-group-item active" style="background-color:black;">
  	Notification(<?php echo $count; ?>)
  </a>
  
  <a href="changepass.php" class="list-group-item">Change Password
  </a>
  <a href="logout1.php" class="list-group-item">Log Out
  </a>
</div>
</div>
 	     <div class="col-lg-8" >
            <div class="table-responsive" >
  <table class="table table-bordered table-hover table-striped" style="background-color:#FFF">
	<tr class="active">
	  <th style="text-align:center">Sr No</th>
	  <th style="text-align:center">Sender</th>
	  <th style="text-align:center">Comment</th>
	  <th style="text-align:center">Date</th>
	  <th style="text-align:center">Reply</th>
	  <th style="text-align:center">Delete</th>
	</tr>
<?php 


    $uid=$_SESSION["id"];
    $sql1="select * from notification where post_usr='$uid'";
    $re=mysqli_query($con,$sql1);
    $count=mysqli_num_rows($re);
    $i=1;
    while($row=mysqli_fetch_array($re))
    {
        $no_id=$row["noti_id"];
        $po_id=$row["pos_id"];
        $post_user_id=$row["post_usr"];
        $comment_user_id=$row["comm_user"];
        $co=$row["comment"];
        $ti=$row["time"];
        $post_id=$_SESSION["id"];
        echo '<tr class="default">';
           echo '<td style="text-align:center">'.$i.'</td>';
           
		
    $user=mysqli_query($con,"select * from registration where usr_id='".$comment_user_id."'");
		$userRes=mysqli_fetch_array($user);
		
		   echo '<td>'.$userRes['name'].'</td>';
           echo '<td>'.$co.'</td>';
           echo '<td>'.$ti.'</td>';
           echo '<td><form method="post" action="reply.php">
           <input type="hidden" name="comment" value="'.$co.'" />
           <input type="hidden" name="po_id" value="'.$post_id.'" />
           <input type="hidden" name="commenter_id" value="'.$comment_user_id.'" />
           <input type="submit" name="reply" class="btn btn-success" value="Reply"/>
           </form></td>';
           echo '<td><a href="javascript:delete_student('.$no_id.')" class="btn btn-danger">delete</a></td>';
        echo '</tr>'; 
        $i++;  
        
    }
?>

	
  </table>
</div>
          
						
                            

        </div>

		<!--content -->
			
						




</div>

</div>

</div>



 
<!-- Bootstrap Core JavaScript -->
<script src="components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Menu Toggle Script -->
<script>
 $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>


	<script type="text/javascript">
		$(document).ready(function(){
			$('.status').click(function() { $('.arrow').css("left", 0);});
			$('.photos').click(function() { $('.arrow').css("left", 146);});
		});
	</script>
	

</body>
</html>