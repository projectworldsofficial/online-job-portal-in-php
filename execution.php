<?php 
    include("dbconfig.php");
?>
<?php
    if(isset($_GET["yesdelete"]))
    {

         $del_id=$_GET["yesdelete"];
         $result=mysqli_query($con,"delete from notification where noti_id='$del_id'");	

        
         if($result)
         {       echo '<script>alert("delete successfully");<script>';
                 header("location:notification.php");

         }

    }

?>