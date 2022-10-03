<?php

require_once "dbconfig.php";

$Name = $Phone = $Email = $Address1 = $Address2 = $City = $State = $Country = $Image ="";

$Name_error = $Phone_error = $Email_error = $Address1_error = $Address2_error = $City_error = $State_error = $Country_error = $Image_error = "";

if(isset($_POST["id"]) && !empty($_POST["id"]))
{
    $id = $_POST["id"];

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
        $sql = "UPDATE `harveedesign` SET `Name` ='$Name',
        `Phone` = '$Phone', `Email` = '$Email', 
        `Address1` = '$Address1', `Address2` = '$Address2',
        `City` = '$City', `State` = '$State',
        `Country` = '$Country',
        `Image`='$imgnewfile'
        WHERE id = '$id'";

        if(mysqli_query($conn,$sql))
        {
            header("location:index.php");
        }
        else{
            echo "Something Went Wrong . Please try again later.";
        }
    }
    mysqli_close($conn);

}
else{
   if(isset($_GET["id"]) && !empty(trim($_GET["id"])))
   {
    $id = trim($_GET["id"]);
    $query = mysqli_query($conn,"SELECT * FROM harveedesign WHERE id = '$id'");

    if($har = mysqli_fetch_assoc($query))
    {
        $Name = $har["Name"];
        $Phone = $har["Phone"];
        $Email = $har["Email"];
        $Address1 = $har["Address1"];
        $Address2 = $har["Address2"];
        $City = $har["City"];
        $State = $har["State"];
        $Country = $har["Country"];
        $Image = $har["Image"];
        
    }
    else{
        echo "Something went wrong . Please Try again later.";
        header("location:edit.php");
        exit();
    }
    mysqli_close($conn);
   }
   else{
    echo "Something went wrong. Please try again later.";
    header("location:edit.php");
    exit();
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="bootstrap-5.1.3-dist\css\bootstrap.min.css">
    <style type="text/css">
        .wrapper {
            width: 1200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update User</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?php echo $id; ?>"/>

                        <div class="form-group <?php echo (!empty($Name_error)) ? 'has-error' : ''; ?>">
                            <label> Name</label>
                            <input type="text" name="Name" class="form-control" value="<?php echo $Name; ?>">
                            <span style="color:red"><?php echo $Name_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($Phone_error)) ? 'has-error' : ''; ?>">
                            <label>Phone</label>
                            <input type="text" name="Phone" class="form-control" value="<?php echo $Phone; ?>">
                            <span style="color:red"><?php echo $Phone_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($Email_error)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <input type="email" name="Email" class="form-control" value="<?php echo $Email; ?>">
                            <span style="color:red"><?php echo $Email_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($Address1_error)) ? 'has-error' : ''; ?>">
                            <label>Address1</label>
                            <input type="text" name="Address1" class="form-control" value="<?php echo $Address1; ?>">
                            <span style="color:red"><?php echo $Address1_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($Address2_error)) ? 'has-error' : ''; ?>">
                            <label>Address2</label>
                            <input type="text" name="Address2" class="form-control" value="<?php echo $Address2; ?>">
                            <span style="color:red"><?php echo $Address2_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($City_error)) ? 'has-error' : ''; ?>">
                            <label>City</label>
                            <input type="text" name="City" class="form-control" value="<?php echo $City; ?>">
                            <span style="color:red"><?php echo $City_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($State_error)) ? 'has-error' : ''; ?>">
                            <label>State</label>
                            <input type="text" name="State" class="form-control" value="<?php echo $State; ?>">
                            <span style="color:red"><?php echo $State_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($Country_error)) ? 'has-error' : ''; ?>">
                            <label>Country</label>
                            <input type="text" name="Country" class="form-control" value="<?php echo $Country; ?>">
                            <span style="color:red"><?php echo $Country_error;?></span>
                        </div>
                       
                        <div class="form-group" <?php echo (!empty($Image_error));?>>
                        <label>Image</label>
                           <img src="image/<?php echo $Image;?>" width="120" height="80">
                           <a href="change-image.php?id=<?php echo $id; ?>">Change Image</a>
                        </div>

                      

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap-5.1.3-dist\js\bootstrap.bundle.min.js"></script>

</body>
</html>