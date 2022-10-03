

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CURD Operations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="bootstrap-5.1.3-dist\css\bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
			html {
				font-family: Tahoma, Geneva, sans-serif;
				padding: 20px;
				background-color: #F8F9F9;
			}
			table {
				border-collapse: collapse;
				width: 500px;
			}
			td, th {
				padding: 10px;
			}
			th {
				background-color: #54585d;				
				font-weight: bold;
				font-size: 13px;
				border: 1px solid #54585d;
			}
			td {
				color: #636363;
				border: 1px solid #dddfe1;
			}
			tr {
				background-color: #f9fafb;
			}
			tr:nth-child(odd) {
				background-color: #ffffff;
			}
            a{
                
               text-decoration:none;
            }
			.pagination {
				list-style-type: none;
				padding: 10px 0;
				display: inline-flex;
				justify-content: space-between;
				box-sizing: border-box;
			}
			.pagination li {
				box-sizing: border-box;
				padding-right: 10px;
			}
			.pagination li a {
				box-sizing: border-box;
				background-color: #e2e6e6;
				padding: 8px;
				text-decoration: none;
				font-size: 12px;
				font-weight: bold;
				color: #616872;
				border-radius: 4px;
			}
			.pagination li a:hover {
				background-color: #d4dada;
			}
			.pagination .next a, .pagination .prev a {
				text-transform: uppercase;
				font-size: 12px;
			}
			.pagination .currentpage a {
				background-color: #518acb;
				color: #fff;
			}
			.pagination .currentpage a:hover {
				background-color: #518acb;
			}
			</style>
</head>
<body>
    
    <div class="container-fluid" >
        <div class="row">
            <h2 class="text-center">PHP CRUD Operations</h2>
            <div class="col-md-12">
               <div style="display:flex; align-items: center; justify-content: space-between;">
            <div class="page-header clearfix">
                    <h2 class="pull-left">Users</h2>
                    <a href="create.php" class="btn btn-success pull-right mb-2">Add New User</a>
              </div>
                <div>
            <form class="form-horizontal" action="search.php" method="post">
            <div class="row">
                <div class="col-12 d-flex">
                <input type="text" class="form-control" name="search" placeholder="search here">
              <button type="submit" name="save" class="btn btn-success btn-sm">Submit</button>
                </div>
             </div>
             </form>
             </div>
             </div>
                
                <?php
                    require_once "dbconfig.php";

                  if(!isset($_GET['page']))
                  {
                    $page = 1;
                  }
                  else{
                    $page = $_GET['page'];
                  }

                    $num_results_on_page  = 4;
                    $offset = ($page-1) * $num_results_on_page ;

                    $total_pages_sql = "SELECT COUNT(*) FROM harveedesign";

                    $result = mysqli_query($conn,$total_pages_sql);

                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $num_results_on_page );

                    $prev = $page - 1;
                    $next = $page + 1;

                    $columns = array('id','Name','Phone','Email');


                    $column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];


                    $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

                    
                    $sql = "SELECT * FROM harveedesign ORDER BY $column $sort_order LIMIT $offset, $num_results_on_page ";

                    $res_data = mysqli_query($conn,$sql);

                    $up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	                $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	                $add_class = ' class="highlight"';

                    if($total_rows > 0)
                    {
                            echo "<table class='table table-bordered table-striped'>
                            <thead>
                            <tr>                       
                            <th>". "<a href='index.php?column=id&order=<?php echo $asc_or_desc; ?>'>id<i class='fa-solid fa-sort-up<?php echo $column == 'id' ? '-' . $up_or_down : ''; ?></i></a>". "</th> 
                            <th>". "<a href='index.php?column=Name&order=<?php echo $asc_or_desc; ?>'>Name<i class='fa-solid fa-sort-up<?php echo $column == 'Name' ? '-' . $up_or_down : '';' ?></i></a>". "</th> 
                            <th>". "<a href='index.php?column=Phone&order=<?php echo $asc_or_desc; ?>'>Phone<i class='fa-solid fa-sort-up<?php echo $column == 'Phone' ? '-' . $up_or_down : '';' ?></i></a>". "</th>                     
                            <th>". "<a href='index.php?column=Email&order=<?php echo $asc_or_desc; ?>'>Email<i class='fa-solid fa-sort-up<?php echo $column == 'Email' ? '-' . $up_or_down : '';' ?></i></a>". "</th>                                               
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

                           while($har = mysqli_fetch_array($res_data))
                           {
                            echo " 
                            <tr>
                            <td>" . $har['id'] . " </td>
                            <td>" . $har['Name'] . " </td>
                            <td>" . $har['Phone'] . " </td>
                            <td>" . $har['Email'] . "</td>
                            <td>".  $har['Address1'] . "</td>
                            <td>".  $har['Address2'] . "</td>
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
                           mysqli_free_result($res_data);
                                      
                        }


                    mysqli_close($conn);

                ?>

         <nav aria-label="Page navigation example mt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link"
                        href="<?php if($page <= 1){ echo '#'; } else { echo "?page=" . $prev; } ?>">Previous</a>
                </li>
                <?php for($i = 1; $i <= $total_pages; $i++ ): ?>
                <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
                    <a class="page-link" href="index.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                </li>
                <?php endfor; ?>
                <li class="page-item <?php if($page >= $total_pages) { echo 'disabled'; } ?>">
                    <a class="page-link"
                        href="<?php if($page >= $total_pages){ echo '#'; } else {echo "?page=". $next; } ?>">Next</a>
                </li>
            </ul>
        </nav>

                <!-- <ul class="pagination">
                    <li><a href ="?pageno=1">First</a></li>

                    <li class="<?php if($pageno <= 1) {echo 'disabled';}?>">
                        <a href="<?php if($pageno <=1){echo '#' ;} else {echo "?pageno=".($pageno-1);} ?>">Prev</a>
                    </li>

                    <li class="<?php if($pageno >= $total_pages) {echo 'disabled';}?>">
                        <a href="<?php if($pageno >= $total_pages) {echo "#" ;} else {echo "?pageno=".($pageno + 1);} ?>">Next</a>
                    </li>
                    <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
                    </ul> -->
            </div>

        </div>
    </div>

    <script src="bootstrap-5.1.3-dist\js\bootstrap.bundle.min.js"></script>
</body>
</html>