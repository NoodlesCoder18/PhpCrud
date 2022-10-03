<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.1.3-dist\css\bootstrap.min.css">
    <title>Read Employee</title>
</head>
<body>
    <?php

    if(isset($_GET["id"]) && !empty(trim($_GET["id"])))
    {
        require_once "dbconfig.php";

        $id = trim($_GET["id"]);

        $query = mysqli_query($conn,"SELECT * FROM harveedesign WHERE id ='$id'");

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
            header("location:read.php");
            exit();
        }

        mysqli_close($conn);
    }
    else{
        header("location:read.php");
        exit();
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>User View</h1>
                </div>

                <div class="form-group">
                    <label>Name</label>
                    <p class="form-control-static"><?php echo $Name ?></p>
                </div>
                <hr>
                <div class="form-group">
                    <label>Phone</label>
                    <p class="form-control-static"><?php echo $Phone ?></p>
                </div>
                <hr>
             <div class="form-group">
             <label>Email</label>
             <p class="form-control-static"><?php echo $Email?></p>    
             </div>
             <hr>
             <div class="form-group">
             <label>Address1</label>
             <p class="form-control-static"><?php echo $Address1 ?></p>
              </div>
              <hr>
             <div class="form-group">
             <label>Address2</label>
             <p class="form-control-static"><?php echo $Address2 ?></p>
              </div>
              <hr>
             <div class="form-group">
             <label>City</label>
             <p class="form-control-static"><?php echo $City ?></p>
              </div>
              <hr>
             <div class="form-group">
             <label>State</label>
             <p class="form-control-static"><?php echo $State ?></p>
              </div>
              <hr>
             <div class="form-group">
             <label>Country</label>
             <p class="form-control-static"><?php echo $Country ?></p>
              </div>
             <hr>
              <div class="form-group">
                        <label>Image</label>
                           <img src="image/<?php echo $Image;?>" width="120" height="80">
                         
             </div>
              

               <p><a href="index.php" class="btn btn-primary">Back</a></p>
           
            </div>
        </div>
    </div>


<script src="bootstrap-5.1.3-dist\js\bootstrap.bundle.min.js"></script>
</body>
</html>