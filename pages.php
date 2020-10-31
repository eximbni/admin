<?php 
$message="";
 require "header1.php";

?>  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pages</h1>
            <h4 ><?php echo $message; ?></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">CMS Module </li>
              <li class="breadcrumb-item active">Pages </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>   
			
				
			<section class="content">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>Page Name</th>
						  <th>Description</th>
						  <th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$i=1;
							$sql_page = "select * from pages";
							$res_page = mysqli_query($conn,$sql_page);
							while($row_page=mysqli_fetch_array($res_page))
							{
					    ?>
					   <tr>
						  <td><?php echo $i; ?></td>
						  <td><?php echo $row_page['title']; ?></td>
						  <td><?php echo $row_page['description']; ?></td>
						  <td><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal">Reply</button></td>
						</tr>
						<?php $i++; } ?>
						</tbody>
					  </table>
					</div>
				 
			</div>
			</section>
		 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Reply</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<textarea class="form-control" placeholder="Reply Here.." name="desc"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Ok</button>
      </div>
    </div>
  </div>
</div>


 </div>
<?php
require "footer1.php"
?>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
 		
