<div class="fluid-container">
<div class="row" style="clear:both">
 <div class="col-lg-12">
 	    <div class="col-lg-4">
		<div class="list-group" style="margin-left:0px">
 
   <a href="user.php" class="list-group-item active" style="background-color:black;">
    All task</a>
  
 <a href="ourskill.php" class="list-group-item">Profile
  </a>

  
  </a>
  <a href="my_task.php" class="list-group-item">My task
  </a>
  <a href="" data-toggle="modal" data-target="#squarespaceModal" class="list-group-item">
  	Post Task
  </a>
  <a href="notification.php" class="list-group-item">
  	Notification(<?php echo $count; ?>)
  </a>
  
  <a href="changepass.php" class="list-group-item">Change Password
  </a>
  <a href="logout1.php" class="list-group-item">Log Out
  </a>
</div>
</div>
 	     <div class="col-lg-8">

          
						<?php 
						$num_rec_per_page=10;
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
                          $start_from = ($page-1) * $num_rec_per_page; 
                            $sql=mysqli_query($con,"select * from posts join registration where posts.usr_id_p=registration.usr_id order by posts.status_time desc limit  $start_from, $num_rec_per_page");
                             while($row=mysqli_fetch_array($sql))
                               {
     	                           $id=$row["post_id"];
     	                           $time=$row["status_time"];

						echo '<div class="post-show" style="width:90%;border-radius:5px">
									<div class="post-show-inner">
										<div class="post-header">
											<div class="post-left-box">
												<div class="id-img-box"><a href="otheruser.php?userid='.$row['usr_id'].'"><img src="user_images/'.$row['image'].'"></a></img></div>
												<div class="id-name">
													<ul>
													<b><a href="otheruser.php?userid='.$row['usr_id'].'">	'.$row['name'].'</a> </b>
														<li><small>'.timeAgo($time).'</small></li>
													</ul>
												</div>
											</div>
											<div class="post-right-box"></div>
										</div>
									
											<div class="post-body">
											<div class="post-header-text">
							 <a href="project_description.php?id='.$id.'&s_title=' . $row['status'] . '">
							  '.$row['status_title'].'</a>
							  
							                 <p>'.$row['status'].'</p>

											 <br/><br/>';
										$sql1=mysqli_query($con,"select * from comments where post_id_c='$id'");
										while($row1=mysqli_fetch_array($sql1))
										{	 
                                            $ct=$row1["comment_time"];
                                            $c=$row1["comment"];
                                            $uid=$row1["user_id_c"];
                                            $sql2=mysqli_query($con,"select * from registration where usr_id='$uid'");
                                            while($row2=mysqli_fetch_array($sql2))
										     {
                                                 $n=$row2["name"];
                                                 $img=$row2["image"];
                                                 echo '<div style="margin-left:50px">
										<a href="otheruser.php?userid='.$uid.'"><img style="height:20px; width="20px" src="user_images/'.$img.'"></img></a>
										&nbsp; &nbsp;'.$c.'
											 </div>
											 <div style="margin-left:50px"><div class="id-name">
													<ul>
													
														<small>'.timeAgo($ct).'</small> &nbsp; &nbsp; &nbsp;<font style="color:blue"> comment by :</font> <font style="font-size:12px"><a href="otheruser.php?userid='.$uid.'"> '.$n.'</a></font>
													</ul>
											</div>
										</div>
										
										';
										     }
										
									   }
							echo '<a href="project_description.php?id='.$id.'&s_title=' . $row['status'] . '" class="btn btn-default">Post Your Comment</a></div>

								</div>
								</div></div><br/> ';	
     	                           
                               }
     
                     
$sql = "select * from posts join registration where posts.usr_id_p=registration.usr_id order by posts.status_time desc"; 
$rs_result = mysqli_query($con,$sql); //run the query
$total_records = mysqli_num_rows($rs_result);  //count number of records
$total_pages = ceil($total_records / $num_rec_per_page);
echo '<div class="col-lg-8" style="text-align:center; font-size:20px">'; 

echo "<a href='user.php?page=1'>".'|< Prev '."</a> "; // Goto 1st page  

for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='user.php?page=".$i."'>" .$i. "</a> "; 
}; 
echo "<a href='user.php?page=$total_pages'>".' Next >|'."</a> "; // Goto last page
echo '</div>'; 

?>
                            

</div>

		<!--content -->
			
						




</div>

</div>

</div>
