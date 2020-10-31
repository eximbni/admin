<?php 
require "header1.php";
?>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">HSN Code Request</h1>
            <h4 style="color:red"><?php echo $message; ?></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Franchise </li>
              <li class="breadcrumb-item active">HSN Code Request</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <section class="content">
        <div class="container-fluid">
 
            <div class="card">
                <div class="card-body table-responsive"> 
                    <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>User Name</th>
						  <th>Country</th>
						  <th>Category</th>
						  <th>Chapter</th>
						  <th>Product</th>
						  <th>Description</th>
						  <th>Date</th>
						  <th>Action</th>
						</tr>
						</thead>
						<tbody>
							<?php
								include("config.php");
								//$sql_hsreq = "SELECT hr.*, u.name as username, c.name,cat.category_name,ch.chapter_name FROM hscode_requests hr, users u, countries c, categories cat, chapters ch WHERE hr.user_id = u.id AND c.country_id = hr.country_id AND hr.chapter = ch.id AND hr.category = cat.id";
								$srno=0;
								$sql_hsreq = "SELECT hr.*, u.name as username ,c.name FROM hscode_requests hr, users u, countries c WHERE hr.user_id = u.id AND c.country_id = hr.country_id";
								$res_hsreq = mysqli_query($conn,$sql_hsreq);
								while($row_hsreq=mysqli_fetch_array($res_hsreq))
								{
									$srno++;
									//print_r($row_hsreq);
								?>
								<tr>
								  <td><?php echo $srno; ?></td>
								  <td><?php echo $row_hsreq['username']; ?></td>
								  <td><?php echo $row_hsreq['name']; ?></td>
								  <td><?php echo $row_hsreq['category']; ?></td>
								  <td><?php echo $row_hsreq['chapter']; ?></td>
								  <td><?php echo $row_hsreq['product']; ?></td>
								  <td><?php echo $row_hsreq['description']; ?></td>
								  <td><?php echo $row_hsreq['created_date']; ?></td>
								  <td><button class="btn btn-primary">Check</button></td>
								</tr>
							<?php } ?>
						  
						</tbody>
						
						
					  </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
require "footer1.php"
?>  

<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>