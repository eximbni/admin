<?php
require "header1.php";
$todayDate = date('Y-m-d');
$lastYearDate = date("Y-m-d", strtotime("-1 year"));

$res_active_users = mysqli_fetch_array(mysqli_query($conn, "SELECT count(*) as totalUsers FROM users WHERE status='1' AND email_check='1'"));
$active_users = $res_active_users['totalUsers'];

$res_active_frusers = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) as totalFrusers FROM `franchise_users` WHERE status = '1'"));
$active_frusers = $res_active_frusers['totalFrusers'];

$res_active_leads = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) as totalLeads FROM `leads` WHERE expiry_date >= '$todayDate' AND status ='1'"));
$active_leads = $res_active_leads['totalLeads'];

$res_total_income = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(amount) as totalIncome FROM `frachise_accounts` WHERE payment_date >= '$lastYearDate'"));
$total_income = $res_total_income['totalIncome'];


?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ChartJS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ChartJS</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Bar Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
              
            </div>
          <!-- /.col (LEFT) -->
          <div class="col-12"> 
            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Stacked Bar Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
<?php 
 require "footer1.php";
?>
<script>

$( document ).ready(function() {
    
     $.ajax({
        url: "https://eximbni.com/api/getChartUserlist.php", 
        success: function(result){
        var mdata = result;
		console.log(result);
		var json =  JSON.parse(mdata);
	    console.log("json : ",json['lables']);
		
        // console.log("labels : ",result=>lables );
            // Get context with jQuery - using jQuery's .get() method.
             
            var areaChartData = {
              labels  : json['labels'], //['January', 'February', 'March', 'April', 'May', 'June', 'July'],
              datasets: [
                {
                  label               : 'Seller Users',
                  backgroundColor     : 'rgba(245, 105, 84, 1)',
                  borderColor         : 'rgba(245, 105, 84, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(245, 105, 84, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(245, 105, 84, 1)',
                  data                : json['seller']
                },
                {
                  label               : 'Buyer Users',
                  backgroundColor     : 'rgba(243, 156, 18, 1)',
                  borderColor         : 'rgba(243, 156, 18, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(243, 156, 18, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(243, 156, 18, 1)',
                  data                : json['buyer']
                },
                {
                  label               : 'Both Users',
                  backgroundColor     : 'rgba(0, 166, 90, 1)',
                  borderColor         : 'rgba(0, 166, 90, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(0, 166, 90, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(0, 166, 90, 1)',
                  data                : json['both']
                },
                {
                  label               : 'Other Users',
                  backgroundColor     : 'rgba(0, 192, 239, 1)',
                  borderColor         : 'rgba(0, 192, 239, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(0, 192, 239, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(0, 192, 239, 1)',
                  data                : json['other']
                },
                /*{
                  label               : 'Total Users',
                  backgroundColor     : 'rgba(60,141,188,0.9)',
                  borderColor         : 'rgba(60,141,188,0.8)',
                  pointRadius          : false,
                  pointColor          : '#3b8bba',
                  pointStrokeColor    : 'rgba(60,141,188,1)',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data                : json['points']
                },*/
              ]
            }
        
            var areaChartOptions = {
              maintainAspectRatio : false,
              responsive : true,
              legend: {
                display: false
              },
              scales: {
                xAxes: [{
                  gridLines : {
                    display : false,
                  }
                }],
                yAxes: [{
                  gridLines : {
                    display : false,
                  }
                }]
              }
            }
        
            // This will get the first returned node in the jQuery collection.
            
           
            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = jQuery.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0
        
            var barChartOptions = {
              responsive              : true,
              maintainAspectRatio     : false,
              datasetFill             : false
            }
        
            var barChart = new Chart(barChartCanvas, {
              type: 'bar', 
              data: barChartData,
              options: barChartOptions
            })
        
            //---------------------
            //- STACKED BAR CHART -
            //---------------------
            var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
            var stackedBarChartData = jQuery.extend(true, {}, barChartData)
        
            var stackedBarChartOptions = {
              responsive              : true,
              maintainAspectRatio     : false,
              scales: {
                xAxes: [{
                  stacked: true,
                }],
                yAxes: [{
                  stacked: true
                }]
              }
            }
        
            var stackedBarChart = new Chart(stackedBarChartCanvas, {
              type: 'bar', 
              data: stackedBarChartData,
              options: stackedBarChartOptions
            })
          
    		
    		
	    }
        
    });
	
});
    </script>