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
            <h1 class="m-0 text-dark">Total Franchise Users List</h1>
            <h4 style="color:red"><?= $message; ?></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Dashboard </li>
              <li class="breadcrumb-item active">Total Franchise Users</li>
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
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Franchise Type</th>
                  <th> Status </th>
                </tr>
                </thead>
                <tbody>
				<?php
				$srno = 0;
				$sql_franch = "SELECT * FROM `franchise_users` WHERE status='1' ORDER BY id DESC";
				$res_franch = mysqli_query($conn,$sql_franch);
				while($row_franch=mysqli_fetch_array($res_franch))
				{  $srno++;
				
				    if($row_franch['status'] =='1'){
				        $status = "<span class='text-success'> Active </span> ";
				    }else{
				        $status = "<span class='text-danger'> Inactive </span> ";
				    }
				?>
                <tr>
                  <td><?= $srno; ?></td>
                  <td><?= $row_franch['name']; ?></td>
                  <td><?= $row_franch['mobile']; ?></td>
                  <td><?= $row_franch['email']; ?></td>
                  <td><?= $row_franch['franchise_type']; ?></td>
                  <td><?= $status; ?></td>
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