<?php

require_once "dbconfig.php";

$Name = $Phone = $Email = $Address1 = $Address2 = $City = $State = $Country = $Image ="";

$Name_error = $Phone_error = $Email_error = $Address1_error = $Address2_error = $City_error = $State_error = $Country_error = $Image_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $Name = trim($_POST["Name"]);
    if(empty($Name))
    {
        $Name_error = "First Name is Required.";
    }
    elseif(!filter_var($Name,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
     $Name_error = "First Name is Invalid.";   
    }
    else{
        $Name = $Name;
    }

    $Phone = trim($_POST["Phone"]);
    if(empty($Phone))
    {
        $Phone_error = "Phone Number is Required.";
    }
    elseif(!filter_var($Phone,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^\d{10}$/")))){
     $Phone_error = "Phone Number is Invalid.";   
    }
    else{
        $Phone = $Phone;
    }

    $Email = trim($_POST["Email"]);

    if(empty($Email))
    {
        $Email_error = "Email is Required.";
    }
    elseif(!filter_var($Email,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/"))))
    {
        $Email_error = "Email is Invalid.";
    }
    else{
        $Email = $Email;
    }

    $Address1 = trim($_POST["Address1"]);

    if(empty($Address1))
    {
        $Address1_error = "Address2 is Required.";
    }
    else{
        $Address1 = $Address1;
    }

    $Address2 = trim($_POST["Address2"]);
    if(empty($Address2))
    {
        $Address2_error = "Address2 is Required.";
    }
    else{
        $Address2 = $Address2;
    }

    $City = trim($_POST["City"]);
    if(empty($City))
    {
        $City_error = "City is Required.";
    }
    else{
        $City = $City;
    }

    $State = trim($_POST["State"]);
    if(empty($State))
    {
        $State_error = "State is Required.";
    }
    else{
        $State = $State;
    }

    $Country = trim($_POST["Country"]);
    if(empty($Country))
    {
        $Country_error = "Country is Required.";
    }
    else{
        $Country = $Country;
    }


  

//    if(getimagesize($_FILES['imagefile']['tmp_name']) == false)
//    {
//     setcookie("error","Please Select An Image",time() + 3600, "/");
//    }
if(empty($Image))
{
    $filename = $_FILES["imagefile"]["name"];
    $tempname = $_FILES["imagefile"]["tmp_name"];
    $folder = "./image/" . $filename;
}
else{
    $Image = $tempname;
}

    if(empty($Name_error) && empty($Phone_error)  && empty($Email_error)  && empty($Address1_error) &&
    empty($Address2_error) && empty($City_error) && empty($State_error)  &&  empty($Country_error) &&
    empty($Image_error))
    {
        $sql = "INSERT INTO `harveedesign` (`Name`,`Phone`,`Email`,`Address1`,`Address2`,
        `City`,`State`,`Country`,`Image`)
        VALUES ('$Name','$Phone','$Email','$Address1','$Address2','$City','$State','$Country','$filename')";

        if(mysqli_query($conn,$sql))
        {
            header("location:index.php");
        }
        else{
            echo "Something went Wrong. Please try again later.";
        }
    }
    if(move_uploaded_file($tempname,$folder))
    {
        echo "<h3>Image uploaded successfully! </h3>";
    }
    else{
        echo "<h3>Faild to Upload image! </h3>";
    }
    mysqli_close($conn);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.1.3-dist\css\bootstrap.min.css">
    <title>Create User</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Create User</h2>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group <?php echo (!empty($Name_error)) ? 'has-error' : '';?>">
            <label>Name</label>
            <input type="text" name="Name" class="form-control" value="">
            <span style="color:red"><?php echo $Name_error; ?></span>       
            </div>
            
            <div class="form-group <?php echo (!empty($Phone_error)) ? 'has-error' : '';?>">
            <label>Phone</label>
            <input type="text" name="Phone" class="form-control" value="">
            <span style="color:red"><?php echo $Phone_error; ?></span>  
            </div>

           <div class="form-group <?php echo (!empty($Email_error)) ? 'has-error' : '' ?>">
           <label>Email</label>
            <input type="email" name="Email" class="form-control" value="">
            <span style="color:red"><?php echo $Email_error;?></span>
           </div>

         <div class="form-group <?php echo(!empty($Address1_error)) ? 'has-error' : ''; ?>">
            <label>Address1</label>
            <input type="text" name="Address1" class="form-control" value="">
             <span style="color:red"><?php echo $Address1_error;?></span>
          </div>

          <div class="form-group <?php echo(!empty($Address2_error)) ? 'has-error' : ''; ?>">
            <label>Address2</label>
            <input type="text" name="Address2" class="form-control" value="">
             <span style="color:red"><?php echo $Address2_error;?></span>
          </div>

            <div class="form-group <?php echo(!empty($City_error)) ? 'has-error' : ''; ?>">
             <label>City</label>
           <input type="text" name="City" class="form-control" value="">
          <span style="color:red"><?php echo $City_error ?></span>
         </div>

         <div class="form-group <?php echo(!empty($State_error)) ? 'has-error' : ''; ?>">
             <label>State</label>
           <input type="text" name="State" class="form-control" value="">
          <span style="color:red"><?php echo $State_error ?></span>
         </div>

         <div class="form-group <?php echo(!empty($Country_error)) ? 'has-error' : ''; ?>">
             <label>Country</label>
           <input type="text" name="Country" class="form-control" value="">
          <span style="color:red"><?php echo $Country_error ?></span>
         </div>

           <div class="form-group">
                <input class="form-control" type="file" name="imagefile" value="" />
            </div>

           <!-- <div class="form-group">
           <label>Created</label>
            <input type="datetime-local" name="created" class="form-control" value="">
             </div> -->

          <div class="d-flex justify-content-center pt-5">
          <input type="submit" class="btn btn-primary px-5 mx-4" value="Submit" name="upload">
          <a href="index.php" class="btn btn-warning px-5">Cancel</a>
          </div>  

            </form>
        </div>
    </div>
</div>

<script src="bootstrap-5.1.3-dist\js\bootstrap.bundle.min.js"></script>
</body>
</html>