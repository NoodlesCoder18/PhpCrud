
<?php

require_once "dbconfig.php";

if(isset($_POST['submit']))
{
    $uid = $_GET['id'];
    // echo "<script>console.log($uid)</script>";
    $ppic=$_FILES["imagefile"]["name"];
    
    $oldpic = $_POST['oldpic'];
    $oldprofilepic = "imagefile"."/".$oldpic;
    // echo "<script>console.log($oldprofilepic)</script>";
    $extension = substr($ppic,strlen($ppic)-4,strlen($ppic));

    $allowed_extensions = array(".jpg","jpeg",".png",".gif");

    if(!in_array($extension,$allowed_extensions))
    {
        echo "<script>alert('Invalid format. Only jpg / jpeg / png / gif format allowed');</script>";        
    }
    else{
        $imgnewfile = md5($imgfile).time().$extension;

        move_uploaded_file($_FILES["imagefile"]["tmp_name"],"image/".$imgnewfile);

        $query = mysqli_query($conn,"update harveedesign set image='$imgnewfile' where id='$uid'");

        if($query)
        {
            unlink($oldprofilepic);
            echo "<script>alert('Profile pic updated successfully');</script>";
            echo "<script type='text/javascript'> document.location ='index.php'; </script>";          
        }
        else{
            echo "<script>alert('Something Went Wrong. Please try again');</script>";
        }
    }
}

?>



<form  method="POST" enctype="multipart/form-data">
<?php


$eid=$_GET['id'];
$ret=mysqli_query($conn,"select * from harveedesign where ID='$eid'");
while ($row=mysqli_fetch_array($ret)) {
?>
 
<h2>Update </h2>
<p class="hint-text">Update your profile pic.</p>
<input type="hidden" name="oldpic" value="<?php  echo $row['Image'];?>">
<div class="form-group">
<img src="image/<?php  echo $row['Image'];?>" width="100" height="80">
</div>
 
<div class="form-group">
<input type="file" class="form-control" name="imagefile"  required="true">
<!-- <span style="color:red; font-size:12px;">Only jpg / jpeg/ png /gif format allowed.</span> -->
</div> 
 
<div class="form-group">
<button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Update</button>
</div>
<?php }?>
</form>