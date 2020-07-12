  <?php

  $title  = "No Name";
  $setrv  = "B";
  $res    = $this->db->query("
                          SELECT  SetupName, SetupImageDasbor, SetupImage
                          FROM    M_Setupprofile
                          ");
 	if ($res->num_rows() > 0) {
    $settl  = $res->row();
    $setrv  = substr($settl->SetupName, 0,2);
    
      $title = $settl->SetupName;
 
      if(file_exists("./upload/profile/".$settl->SetupImage)){
        $imgurl = base_url()."upload/profile/".$settl->SetupImage;
      }
      else{
        $imgurl = base_url()."upload/profile/default.jpeg";
      }
    }

  

  ?>


	<nav class="main-menu">
		<ul>
			<li>
				<a href="#dasbor">
					<i class="fa fa-home nav_icon"></i>
					<span class="nav-text">
					Dashboard
					</span>
				</a>
			</li>
			<li class="has-subnav">
				<a href="javascript:;">
				<i class="fa fa-cogs" aria-hidden="true"></i>
				<span class="nav-text">
					Master Data
				</span>
				<i class="icon-angle-right"></i><i class="icon-angle-down"></i>
				</a>
				<ul>
					<li>
					<a class="subnav-text" href="#page-group">
					Data Group
					</a>
					</li>
					<li>
					<a class="subnav-text" href="#page-supplier">
					Data Supplier
					</a>
					</li>
					<li>
					<a class="subnav-text" href="#page-item">
					Data Item
					</a>
					</li>
				</ul>
			</li>
			<li class="has-subnav">
				<a href="javascript:;">
				<i class="fa fa-check-square-o nav_icon"></i>
				<span class="nav-text">
				Transaction
				</span>
				<i class="icon-angle-right"></i><i class="icon-angle-down"></i>
				</a>
				<ul>
					<li>
						<a class="subnav-text" href="#page-purchaseorder">Purchase Order</a>
					</li>
					<li>
						<a class="subnav-text" href="#page-sale">Sale</a>
					</li>
				</ul>
			</li>
			<li class="has-subnav">
				<a href="javascript:;">
					<i class="fa fa-file-text-o nav_icon"></i>
						<span class="nav-text">Report</span>
					<i class="icon-angle-right"></i><i class="icon-angle-down"></i>
				</a>
				<ul>
					<li>
						<a class="subnav-text" href="#page-reportstock">
							Item Stock
						</a>
					</li>
					<li>
						<a class="subnav-text" href="#page-reportpurchase">
							Purchase Order
						</a>
					</li>
					<li>
						<a class="subnav-text" href="#page-reportsale">
							Sale
						</a>
					</li>
					<!-- <li>
						<a class="subnav-text" href="login.html">
							Login Page
						</a>
					</li> -->
				</ul>
			</li>
			<li class="has-subnav">
				<a href="javascript:;">
					<i class="fa fa-cogs nav_icon"></i>
						<span class="nav-text">Setting</span>
					<i class="icon-angle-right"></i><i class="icon-angle-down"></i>
				</a>
				<ul>
					<li>
						<a class="subnav-text" href="#page-setupprofile">
							Setup Profile
						</a>
					</li>
					<li>
						<a class="subnav-text" href="#page-setuplogo">
							Setup Logo
						</a>
					</li>
					<li>
						<a class="subnav-text" href="#page-setupprint">
							Setup Print
						</a>
					</li>
					
				</ul>
			</li>
	
		</ul>
		<ul class="logout">
			<li>
			<a href="<?php echo base_url('login/logout'); ?>">
			<i class="icon-off nav-icon"></i>
			<span class="nav-text">
			Logout
			</span>
			</a>
			</li>
		</ul>
	</nav>


<!-- head -->

	<section class="wrapper scrollable">
		<nav class="user-menu">
			<a href="javascript:;" class="main-menu-access">
			<i class="icon-proton-logo"></i>
			<i class="icon-reorder"></i>
			</a>
		</nav>
		<section class="title-bar">
			<div class="logo">
				<h1><a href="#dasbor"><img src="<?php echo $imgurl; ?>" width="50" height="50" alt="" /><?php echo $title; ?></a></h1>
			</div>
			<div class="full-screen">
				<section class="full-top">
					<button id="toggle"><i class="fa fa-arrows-alt" aria-hidden="true"></i></button>	
				</section>
			</div>
			<div class="w3l_search">
				<form action="#" method="post">
					<input type="text" name="search" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}" required="">
					<button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
				</form>
			</div>
			<div class="header-right">
				<div class="profile_details_left">
					<div class="header-right-left">
						<!--notifications of menu start -->
						<ul class="nofitications-dropdown">
							
							
							<li class="dropdown head-dpdn">
								<a href="#" ><?php echo $this->session->userdata('nama');?></a>
								
							</li>	
							<div class="clearfix"> </div>
						</ul>
					</div>	
					<div class="profile_details">		
						<ul>
							<li class="dropdown profile_details_drop"> 
								<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="cursor:pointer;"> 
									<div class="profile_img">	
										<span class="prfil-img"><i class="fa fa-user" aria-hidden="true"></i></span> 
										<div class="clearfix"></div>	
									</div>	
								</a>
								<ul class="dropdown-menu drp-mnu">
									<li> <a href="#page-user"><i class="fa fa-cog"></i> Settings</a> </li> 
									<li> <a href="#page-profile"><i class="fa fa-user"></i> Profile</a> </li> 
									<li> <a href="<?php echo base_url('login/logout'); ?>"><i class="fa fa-sign-out"></i> Logout</a> </li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</section>
