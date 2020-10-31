<?php
require "header1.php";
$todayDate = date('Y-m-d');
$lastYearDate = date("Y-m-d", strtotime("-1 year"));

$res_active_users = mysqli_fetch_array(mysqli_query($conn, "SELECT count(*) as totalUsers FROM users WHERE status='1' AND email_check='1'"));
$active_users = $res_active_users['totalUsers'];

$res_active_frusers = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) as totalFrusers FROM `franchise_users` WHERE status = '1'"));
$active_frusers = $res_active_frusers['totalFrusers'];

$sql_app = "SELECT COUNT(*) as totalLeads FROM leads l,users u, chapters ch, countries co, uoms uo WHERE l.status='1' and l.posted_by=u.id and l.chapter_id=ch.id and l.uom_id=uo.id and l.country_id=co.country_id AND l.expiry_date >= '$todayDate'";
$res_active_leads = mysqli_fetch_array(mysqli_query($conn,$sql_app));
$active_leads = $res_active_leads['totalLeads'];

$total_income_sql = "SELECT SUM(fa.amount) as totalIncome FROM `frachise_accounts` fa, franchise_users  fu WHERE fa.franchise_id = fu.id AND fa.payment_date >= '$lastYearDate'";
$res_total_income = mysqli_fetch_array(mysqli_query($conn, $total_income_sql));
$total_income = $res_total_income['totalIncome'] * 0.013;


?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $active_users; ?></h3>

                <p>Total Active users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="active_users.php" class="small-box-footer"> More info  <i class="fas fa-arrow-circle-right"></i> </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $active_leads; ?></h3>

                <p>Total Active Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="active_leads.php" class="small-box-footer"> More info  <i class="fas fa-arrow-circle-right"></i> </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $active_frusers; ?></h3>

                <p>Total Franchise Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="active_frusers.php" class="small-box-footer"> More info  <i class="fas fa-arrow-circle-right"></i> </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><span style="font-size: 35px">$</span><?= number_format($total_income,'2'); ?></h3>

                <p>Total income</p>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
              <a href="total_income.php" class="small-box-footer"> More info  <i class="fas fa-arrow-circle-right"></i> </a>
            </div>
          </div>
          <!-- ./col -->

        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
<section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <!-- BAR CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">User Resgistration Chart</h3>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Posted Leads Chart</h3>
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
  
 
           
           <section class="col-lg-12">

            <!-- Map card -->
            <div class="card bg-gradient-primary">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Country Franchise 
                </h3> 
              </div>
              <div class="card-body">
                <div id="map1" style="height: 450px; width: 100%;"></div>
                <input type="hidden" id="sparkline-1" />
                <input type="hidden" id="sparkline-2" />
                <input type="hidden" id="sparkline-3" />
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->

          </section>

        </div>
        <!-- /.row (main row) -->
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
                  label               : 'Sellers',
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
                  label               : 'Buyers',
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
                  label               : 'Both',
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
                  label               : 'Others',
                  backgroundColor     : 'rgba(0, 192, 239, 1)',
                  borderColor         : 'rgba(0, 192, 239, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(0, 192, 239, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(0, 192, 239, 1)',
                  data                : json['other']
                },
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
            //- User Registration BAR CHART -
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
        
	    }
        
    });
	
});
    </script>


<script>

$( document ).ready(function() {
    // 
     $.ajax({
        url: "https://eximbni.com/api/getChartLeadlist.php", 
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
                  label               : 'Sell Leads',
                  backgroundColor     : 'rgba(0, 166, 90, 1)',
                  borderColor         : 'rgba(0, 166, 90, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(0, 166, 90, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(0, 166, 90, 1)',
                  data                : json['sell']
                },
                {
                  label               : 'Buy Leads',
                  backgroundColor     : 'rgba(243, 156, 18, 1)',
                  borderColor         : 'rgba(243, 156, 18, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(243, 156, 18, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(243, 156, 18, 1)',
                  data                : json['buy']
                },
                 
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
            //- User Registration BAR CHART -
            //-------------
            var barChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
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
        
        
           
	    }
        
    });
	
});
    </script>


<script>
$( document ).ready(function() {
    //var cat_id = $_POST["cat_id"];
    $.ajax({
         url: "https://eximbni.com/api/getCountryFranchiseUserList.php", 
         success: function(result){
       
    var mdata = result;
    console.log(result);
    
var json =  JSON.parse(mdata);


// Creating a new map
var map = new google.maps.Map(document.getElementById("map1"), {
  center: new google.maps.LatLng(20.593683, 78.962883),
  zoom: 2,
  mapTypeId: google.maps.MapTypeId.ROADMAP
});

for (var i = 0, length = json.length; i < length; i++) {
    //console.log(json.length);
  var data = json[i],
      latLng = new google.maps.LatLng(data.latitude, data.longitude); 
      console.log(latLng);
      
      

  // Creating a marker and putting it on the map
  var marker = new google.maps.Marker({
    position: latLng,
    map: map,
    title: data.country_name+" Country Franchise"
  });
}

var infoWindow = new google.maps.InfoWindow();

// Attaching a click event to the current marker
google.maps.event.addListener(marker, "click", function(e) {
  infoWindow.setContent(data.description);
  //infoWindow.open(map, marker);
});


// Creating a closure to retain the correct data 
//Note how I pass the current data in the loop into the closure (marker, data)
(function(marker, data) {

  // Attaching a click event to the current marker
  google.maps.event.addListener(marker, "click", function(e) {
    infoWindow.setContent(data.description);
    //infoWindow.open(map, marker);
  });

})(marker, data);

}});



});
    </script>
    <!-- Replace following script src -->
   <!--  <script src="/maps/documentation/javascript/examples/markerclusterer/markerclustererplus@4.0.1.min.js">
    </script> -->
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js" ></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPuQadZpFuDF9KOWFrlthnPRdRJb-QlrI&callback=initMap">
    </script>
