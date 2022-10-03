<?php

require_once "dbconfig.php";

$columns = array('id','Name','Phone');


$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];


$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

$sql = "SELECT * FROM harveedesign ORDER BY  $column  $sort_order";

$res_data = mysqli_query($conn,$sql);

if ($res_data) {
	
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	$add_class = ' class="highlight"';
	?>
	<!DOCTYPE html>
	<html>
		<head>
			<title>PHP & MySQL Table Sorting by CodeShack</title>
			<meta charset="utf-8">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
			<style>
			html {
				font-family: Tahoma, Geneva, sans-serif;
				padding: 10px;
			}
			table {
				border-collapse: collapse;
				width: 500px;
			}
			th {
				background-color: #54585d;
				border: 1px solid #54585d;
			}
			th:hover {
				background-color: #64686e;
			}
			th a {
				display: block;
				text-decoration:none;
				padding: 10px;
				color: #ffffff;
				font-weight: bold;
				font-size: 13px;
			}
			th a i {
				margin-left: 5px;
				color: rgba(255,255,255,0.4);
			}
			td {
				padding: 10px;
				color: #636363;
				border: 1px solid #dddfe1;
			}
			tr {
				background-color: #ffffff;
			}
			tr .highlight {
				background-color: #f9fafb;
			}
			</style>
		</head>
		<body>
			<table>
				<tr>
					<th><a href="tablesort.php?column=id&order=<?php echo $asc_or_desc; ?>">id<i class="fas fa-sort<?php echo $column == 'id' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="tablesort.php?column=Name&order=<?php echo $asc_or_desc; ?>">Name<i class="fas fa-sort<?php echo $column == 'Name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="tablesort.php?column=Phone&order=<?php echo $asc_or_desc; ?>">Phone<i class="fas fa-sort<?php echo $column == 'Phone' ? '-' . $up_or_down : ''; ?>"></i></a></th>
				</tr>
				<?php while ($row = mysqli_fetch_array($res_data)): ?>
				<tr>
					<td<?php echo $column == 'id' ? $add_class : ''; ?>><?php echo $row['id']; ?></td>
					<td<?php echo $column == 'Name' ? $add_class : ''; ?>><?php echo $row['Name']; ?></td>
					<td<?php echo $column == 'Phone' ? $add_class : ''; ?>><?php echo $row['Phone']; ?></td>
				</tr>
				<?php endwhile; ?>
			</table>
		</body>
	</html>
	<?php
	
}
?>