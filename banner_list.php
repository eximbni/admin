
<style>
/*Style For Modal*/

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
  color:black;
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 65px;
  right: 325px;
  color: #007bff;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
/*Style For Modal*/
</style>
		  <!-- /.navbar -->
<?php
include "header.php";

?>
		  <!-- Main Sidebar Container -->
		  <aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<?php include("sidemenu.php");?>
		  </aside>
			<div class="content-wrapper">
 			<section class="content-header">
				  <div class="container-fluid">
					<div class="row mb-2">
					  <div class="col-sm-12">
						<ol class="breadcrumb float-sm-left">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item"><a href="">Banner Module</a></li>
						  <li class="breadcrumb-item active">Banner List</li>
						</ol>
						<?php echo $message; ?>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>Banner List</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->

				</section>
			<section class="content">
			<div class="row">
			<div class="col-12">
			<div class="card">
         
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Banner Image</th>
                      <th>Category</th>
                      <th>Chapter</th>
                      <th>Start Date</th>
                      <th>End Date</th>
    				  <th>Posted By</th>
    				  <th>Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
    				<?php
    				$srno = 0;
    				include("config.php");
    				$sql_banner = "SELECT b.*, c.category_name, ch.chapter_name, u.name FROM banner b, categories c, chapters ch, users u WHERE b.category_id = c.id and b.chapter_id = ch.id and b.posted_by=u.id";
    				$res_banner = mysqli_query($conn,$sql_banner);
    				while($row_banner=mysqli_fetch_array($res_banner))
    				{
    					$srno++;
    				?>
                    <tr>
                      <td><?php echo $srno; ?></td>
                      <td><img id="img<?php echo $srno; ?>" src="uploads/banner/<?php echo $row_banner['banner_image']; ?>" class="img-circle" width="50" height="50" onclick="showImage(<?php echo $srno; ?>);"></td>
                      <td><?php echo $row_banner['category_name']; ?></td>
                      <td><?php echo $row_banner['chapter_name']; ?></td>
                      <td><?php echo $row_banner['start_date']; ?></td>
                      <td><?php echo $row_banner['end_date']; ?></td>
                      <td><?php echo $row_banner['name']; ?></td>
    				  <td><?php if($row_banner['status']==0){echo "Pending";} else{ echo "Approved";}?></td>
                      <td><a href="approve_banner.php?id=<?php echo $row_banner['id']; ?>" class="btn btn-warning">Approve</a></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
            </div>
          </div>
          </div>
          </section>

			<!-- Modal For Image-->
				  <div id="imgmodal" class="modal">
                      <span class="close">&times;</span>
                      <img class="modal-content" id="image">
                      <div id="caption"></div>
                  </div>
			<!-- Modal For Image-->
			
			
				</div>
		 

<!-- DataTables -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
		 

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>	 
<script>
  $(function () {
    $("#example1").DataTable();

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });

// Get the modal
function showImage(id)
{
    //alert(id);
    var id = id;
var modal = document.getElementById("imgmodal");

// Get the image and insert it inside the modal - use its "alt" text as a caption

var img = document.getElementById("img"+id+"");
var modalImg = document.getElementById("image");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
}
</script>
