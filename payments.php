  

			<?php include("header.php")?>
		  <!-- /.navbar -->

		  <!-- Main Sidebar Container -->
		  <aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<?php include("sidemenu.php");?>
		  </aside>
			<div class="content-wrapper">
				<div class="container">
				<section class="content-header">
				  <div class="container-fluid">
					<div class="row mb-2">
					  <div class="col-sm-12">
						<ol class="breadcrumb float-sm-left">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item"><a href="">Franchise Module</a></li>
						  <li class="breadcrumb-item active">Payments</li>
						</ol>
						<?php echo $message; ?>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>Payments</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
	
				</section>
			<section class="content">
			<div class="row">
			<div class="col-12">
			<div class="card">
            
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Franchise</th>
                   <th>Country</th>
                    <th>email</th>
                  <th>Payment</th>
                  <th>Payment Type </th>
                  <th>Payment Date</th>
                </tr>
                </thead>
                <tbody>
                    <?php
								include("config.php");
								$sql_franch = "SELECT fa.*, fr.email, fr.amount as payment,fr.country_id,fr.name, c.name as country from frachise_accounts fa, franchise_users fr,countries c  where fa.franchise_id=fr.id and fr.country_id=c.country_id";
								$res_franch = mysqli_query($conn,$sql_franch);
								while($row_franch=mysqli_fetch_array($res_franch))
								{
								?>
                <tr>
                  <td><?php echo $row_franch["name"];?></td>
                  <td><?php echo $row_franch["country"];?></td>
                  <td><?php echo $row_franch["email"];?></td>
                  <td><?php echo $row_franch["amount"];?></td>
                   <td><?php echo $row_franch["payment_for"];?></td>
                  <td> <?php echo $row_franch["payment_date"];?></td>
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

				</div>
			</div>
</div>
 </body>

<!-- DataTables -->

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script> 

 <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
 </html>