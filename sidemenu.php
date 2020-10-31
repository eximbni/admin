<?php session_start(); ?>
<a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Exim BNI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
		<?php
		include("config.php");
		$user_id = $_SESSION['user_id']; 
		$cmd = "select * from admin_users where id = '$user_id'";
		$result = mysqli_query($conn,$cmd);
		 
		while($row = mysqli_fetch_array($result))
		{
		    $permission=explode(",",$row['permissions']);
		    //print_r($permission);
		}
		if(in_array("franchise" , $permission)) 
		{
			$franchise = "franchise";
		}
		else
		{
			$franchise = "";
		}
		if(in_array("ad_user",$permission)) 
		{
			$ad_user = "ad_user";
		}
		else
		{
			$ad_user = "";
		}
		if(in_array("leads",$permission)) 
		{
			$leads = "leads";
		}
		else
		{
			$leads = "";
		}
		if(in_array("package",$permission)) 
		{
			$package = "package";
		}
		else
		{
			$package = "";
		}
		if(in_array("accounts",$permission)) 
		{
			$accounts = "accounts";
		}
		else
		{
			$accounts = "";
		}
		if(in_array("cms",$permission)) 
		{
			$cms = "cms";
		}
		else
		{
			$cms = "";
		}
		if(in_array("notification",$permission)) 
		{
			$notification = "notification";
		}
		else
		{
			$notification = "";
		}
		if(in_array("banner",$permission)) 
		{
			$banner = "banner";
		}
		else
		{
			$banner = "";
		}
		if(in_array("schedular",$permission)) 
		{
			$schedular = "schedular";
		}
		else
		{
			$schedular = "";
		}
		if(in_array("system",$permission)) 
		{
			$system = "system";
		}
		else
		{
			$system = "";
		}
		?>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Home
             </p>
            </a>
          </li>
		  <?php
			if($franchise=="franchise")
			{
		  ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Franchise Module
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
			 <li class="nav-item">
                <a href="add_franchise_request.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Franchise</p>
                </a>
              </li>
			 <!--li class="nav-item">
                <a href="add_continent_franchise.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Continent Franchise</p>
                </a>
              </li>
			  
			  <li class="nav-item">
                <a href="add_region_franchise.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Region Franchise</p>
                </a>
              </li>
			    <li class="nav-item">
                <a href="add_zone_franchise.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Zone Franchise</p>
                </a>
              </li>
			    <li class="nav-item">
                <a href="add_state_franchise.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add State Franchise</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="add_country_chapter_franchise.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Country Chapter Franchise</p>
                </a>
              </li-->
              <li class="nav-item">
                <a href="franchise_request.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Requests</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="franchise_list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
			                <li class="nav-item">
                <a href="franchise_payout.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Franchise Payouts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="payments.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="assign_target_franchise.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Target</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="target_report.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Target Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="event_request.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Event Request</p>
                </a>
              </li>
             </ul>
          </li>
			<?php } ?>
			<?php
			if($ad_user=="ad_user")
			{
		  ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Admin User Module
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
			 <li class="nav-item">
                <a href="add_roles.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User Roles</p>
                </a>
              </li>


       <li class="nav-item">
                <a href="create_users.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create users</p>
                </a>
              </li>
			 
			  <li class="nav-item">
                <a href="user_list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User List</p>
                </a>
              </li>
			  
			  <li class="nav-item">
                <a href="message.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Send Message</p>
                </a>
              </li>
        
              <li class="nav-item">
                <a href="getOtplist.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>OTP LIst</p>
                </a>
              </li>
              
              </ul>
          </li>
			<?php } ?>
			<?php
			if($leads=="leads")
			{
		  ?>
		  
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Leads Module
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
			 <li class="nav-item">
                <a href="post_lead.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Post Lead</p>
                </a>
              </li>
			 <li class="nav-item">
                <a href="lead_request.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lead Requests</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="lead_banners.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lead Banners</p>
                </a>
              </li>
			  
              <li class="nav-item">
                <a href="lead_reports.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lead Reports</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="all_lead_reports.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Posted Lead Reports</p>
                </a>
              </li>
              
              </ul>
          </li>
		  <?php } ?>
			<?php
			if($package=="package")
			{
		  ?>
		  
		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Packages Module
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
			<li class="nav-item">
                <a href="subscriptionPackages.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subscription</p>
                </a>
              </li>
			<li class="nav-item">
                <a href="add_subscription.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Subscription</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="subscribed_users.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List of Subscribed Users</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="recharge_package.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Recharge</p>
                </a>
              </li>
              </ul>
          </li>
		  <?php } ?>
			<?php
			if($accounts=="accounts")
			{
		  ?>
      <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Accounts Module
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
       <li class="nav-item">
                <a href="lead_income.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lead Income</p>
                </a>
              </li>
        <li class="nav-item">
                <a href="subscription.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subscriptions List</p>
                </a>
              </li>
        <li class="nav-item">
                <a href="subscription_income.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subscriptions Income</p>
                </a>
              </li>
			  
		<li class="nav-item">
                <a href="admin_income.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin Income</p>
                </a>
              </li>	  

		<li class="nav-item">
                <a href="franchise_commission.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Franchise Commission</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="exim_fund.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exim Fund</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="rnd_fund.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>RND Fund</p>
                </a>
              </li>
      <li class="nav-item">
                <a href="recharge.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Recharge</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="advertisement.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Advertisement</p>
                </a>
              </li>
              </ul>
          </li>
		  <?php } ?>
			<?php
			if($cms=="cms")
			{
		  ?>
		  
		    <li class="nav-item has-treeview">
            <a href="franchise.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                CMS Module
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
			<li class="nav-item">
             	                
				<a href="pages.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>		                  
    	          <p>Pages</p>
                </a>		    
              </li>		            
			 <li class="nav-item">					 
             	<a href="add_newpage.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
					<p>Add New Page</p>
                </a>		         
              </li>
			 <li class="nav-item">
				<a href="upload_banner.php" class="nav-link">
				  <i class="far fa-circle nav-icon"></i>
				  <p>Upload Banners</p>
				</a>
              </li>
			   <li class="nav-item">
				<a href="gallery.php" class="nav-link">
				  <i class="far fa-circle nav-icon"></i>
				  <p>Gallery</p>
				</a>
              </li>		        
              </ul>		              
          </li>
		  <?php } ?>
			<?php
			if($notification=="notification")
			{
		  ?>
		    <li class="nav-item has-treeview">
            <a href="franchise.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Notification Module
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
			 <li class="nav-item">
                <a href="feedback.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Feedback</p>
                </a>
              </li>
			 <li class="nav-item">
                <a href="notification.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Notification</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Notice Board</p>
                </a>
              </li>
              </ul>
          </li>
		  <!--li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Set Commission	
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
			<li class="nav-item">
                <a href="continent_franchise.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>continent franchise</p>
                </a>
             </li>
			 <li class="nav-item">
                <a href="cf.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>cf</p>
                </a>
              </li>
			 <li class="nav-item">
                <a href="ccf.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ccf</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="csf.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>csf</p>
                </a>
              </li>
			  	  <li class="nav-item">
                <a href="crf.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>crf</p>
                </a>
              </li>
              </ul>
          </li-->
		  <?php } ?>
			<?php
			if($banner=="banner")
			{
		  ?>
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Banner Module
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
				<li class="nav-item">
					<a href="banner_list.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Banner</p>
					</a>
				</li>
            </ul>
          </li>
		  <?php } ?>
			<?php
			if($schedular=="schedular")
			{
		  ?>
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Schedular Module
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
			 <li class="nav-item">
                <a href="add_meeting.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Meetings</p>
                </a>
              </li>
			 <li class="nav-item">
                <a href="meetings.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Meetings</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="add_webinar_schedule.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Webinars</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="start_webinars.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Start & End Webinars</p>
                </a>
              </li> 
			  <li class="nav-item">
                <a href="add_gateway.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Payment Gateway</p>
                </a>
              </li>                
			  <li class="nav-item">
                <a href="webinars.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Webinars</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="add_expo.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Expos</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="expo.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expos</p>
                </a>
              </li>
            </ul>
          </li>
		  <?php } ?>
		  
		  <li class="nav-item has-treeview">
            <a href="hsncode_requests.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Hs Code Request
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
		  </li>
		  
		  <li class="nav-item has-treeview">
            <a href="add_policy.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Add Policy
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
		  </li>
		  
			<?php
			if($system=="system")
			{
		  ?>
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                System Data
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
			 <li class="nav-item">
                <a href="continents.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Continents</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="regions.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Regions</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="countries.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Countries</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="states.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>States</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="zones.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Zones</p>
                </a>
              </li>
			   <li class="nav-item">
                <a href="categories.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
			   <li class="nav-item">
                <a href="chapters.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Chapters</p>
                </a>
              </li>
			   <li class="nav-item">
                <a href="hsncodes.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>HSN Codes</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="templates.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Templates</p>
                </a>
              </li>
              </ul>
          </li>
			<?php } ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Webniar
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="webinarlist.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Webinar Approval</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="web_completed.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed Webinars</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="web_todays_schedular.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Todays Webinars  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="web_upload_videos.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Upload Videos  </p>
                </a>
              </li>

            </ul>
          </li>
      
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
	<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<!-- AdminLTE for demo purposes -->


<script src="dist/js/demo.js"></script>
    <!-- /.sidebar -->