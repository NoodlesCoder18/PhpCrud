<?php

require_once "dbconfig.php";

$searchErr = '';
$users_details = '';

if(isset($_POST['save']))
{
    if(!empty($_POST['search']))
    {
        $search = $_POST['search'];

        $sql = "select * from harveedesign where Name like '%$search%' or Name like '%$search%'";

        $users_details = mysqli_query($conn , $sql);    
    }
    else{
        $searchErr = "Please Enter the Information";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <div class="container">
 
    <h3><u>Search Result</u></h3><br/>
    <div class="table-responsive">          
    <?php

               
require_once "dbconfig.php";

if(!$users_details)
{
   echo 'No data found';
}

    if($users_details)
    {
        echo "<table class='table table-bordered table-striped'>
        <thead>
        <tr>
        <th>#</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Address1</th>
        <th>Address2</th>
        <th>City</th>
        <th>State</th>
        <th>Country</th>
        <th>Image</th>
       
        </tr>
        </thead>
        <tbody>
        ";

       while($har = mysqli_fetch_array($users_details))
       {
        echo " 
        <tr>
        <td>" . $har['id'] . " </td>
        <td>" . $har['Name'] . " </td>
        <td>" . $har['Phone'] . " </td>
        <td>" . $har['Email'] . "</td>
        <td>". $har['Address1'] . "</td>
        <td>". $har['Address2'] . "</td>
        <td>" . $har['City'] . "</td>                            
        <td>" . $har['State'] . "</td>                            
        <td>" . $har['Country'] . "</td>                            
         <td>". "<img src='./image/$har[Image] .' width='100%' height='80'>". "</td>                                 
        <td> 
        <a href='read.php?id=".$har['id'] ."' title='View Employee' data-toggle='tooltip'><span><i class='fa-solid fa-eye'></i></span></a>

        <a href='edit.php?id=". $har['id'] ."' title='Edit Employee' data-toggle='tooltip'><span><i class='fa-solid fa-pen-to-square'></i></span></a>

        <a href='delete.php?id=". $har['id'] ."' title='Delete Employee' data-toggle='tooltip'><span><i class='fa-solid fa-trash-can'></i></span></a>

        </td>
        </tr>";
       } 
       echo "</tbody>
       </table>";
       mysqli_free_result($users_details);
                  
    }

    else
    {
        echo "<p class='lead'><em>No Records Found.</em></p>";
    }                  
 
mysqli_close($conn);
?>

    </div>

    <a href="index.php" class="btn btn-success pull-right">Go Back</a>

    </div>

    </div> 
    <script src="bootstrap-5.1.3-dist\js\bootstrap.bundle.min.js"></script>
   </body>
    </html>