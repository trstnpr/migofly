<!DOCTYPE html>

<html lang="en">

    <head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1, width=device-width">

        <title><?php echo $title; ?></title>

        <!-- Favicon -->
        <link rel = "shortcut icon" type = "image / x-icon" href = "<?php echo base_url('build/images/favicon/favicon-128x128.png'); ?>">
        <link rel = "shortcut icon" type = "image / x-icon" href = "<?php echo base_url('build/images/favicon/favicon-64x64.png'); ?>">
        <link rel = "shortcut icon" type = "image / x-icon" href = "<?php echo base_url('build/images/favicon/favicon-32x32.png'); ?>">
        <link rel = "shortcut icon" type = "image / x-icon" href = "<?php echo base_url('build/images/favicon/favicon-16x16.png'); ?>">

        <link href="<?php echo base_url('build/css/admin_styles.css?v=1'); ?>" rel="stylesheet">

    </head>

    <body>

    	<div class="page-wrap">

	        <!-- Sidebar -->
	        <div class="sidebar-wrapper">

	            <ul class="sidebar-nav">
	                <li class="sidebar-brand">
	                    <a href="#menu-toggle" class="btn btn-lg menu-toggle">
	                        Admin
	                    </a>
	                </li>
	                <li>
	                	<a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
	                </li>
	                <li>
	                	<a href="<?php echo base_url(); ?>" target="_blank"><i class="fa fa-eye"></i> View Site</a>
	                </li>
	                <li>
	                    <a href="#page-dropdown" data-toggle="collapse"><i class="fa fa-file-text"></i> Pages</a>
	                    <ul id="page-dropdown" class="collapse list-unstyled side-dropdown">
		                	<li><a href="<?php echo base_url('admin/pages'); ?>"><i class="fa fa-clipboard"></i>All Pages</a></li>
		                	<li><a href="<?php echo base_url('admin/pages/new'); ?>"><i class="fa fa-pencil-square-o"></i> New</a></li>
			            </ul>
	                </li>
	                <li>
	                    <a href="#post-dropdown" data-toggle="collapse"><i class="fa fa-thumb-tack"></i> Posts</a>
	                    <ul id="post-dropdown" class="collapse list-unstyled side-dropdown">
		                	<li><a href="<?php echo base_url('admin/posts'); ?>"><i class="fa fa-clipboard"></i>All Posts</a></li>
		                	<li><a href="<?php echo base_url('admin/posts/new'); ?>"><i class="fa fa-pencil-square-o"></i> New</a></li>
			            </ul>
	                </li>
	                <li>
	                	<a href="<?php echo base_url('admin/category'); ?>"><i class="fa fa-sitemap"></i> Category</a>
	                </li>
	                <li>
	                    <a href="#cities-dropdown" data-toggle="collapse"><i class="fa fa-location-arrow"></i> City</a>
	                    <ul id="cities-dropdown" class="collapse list-unstyled side-dropdown">
		                	<li><a href="<?php echo base_url('admin/cities'); ?>"><i class="fa fa-list"></i>All Cities</a></li>
		                	<li><a href="<?php echo base_url('admin/cities/new'); ?>"><i class="fa fa-pencil-square-o"></i> New</a></li>
			            </ul>
	                </li>
	                <li>
	                    <a href="#countries-dropdown" data-toggle="collapse"><i class="fa fa-globe"></i> Country</a>
	                    <ul id="countries-dropdown" class="collapse list-unstyled side-dropdown">
		                	<li><a href="<?php echo base_url('admin/countries'); ?>"><i class="fa fa-list"></i>All Countries</a></li>
		                	<li><a href="<?php echo base_url('admin/countries/new'); ?>"><i class="fa fa-pencil-square-o"></i> New</a></li>
			            </ul>
	                </li>
	                <li>
	                    <a href="#airline-dropdown" data-toggle="collapse"><i class="fa fa-building-o"></i> Airline</a>
	                    <ul id="airline-dropdown" class="collapse list-unstyled side-dropdown">
		                	<li><a href="<?php echo base_url('admin/airlines'); ?>"><i class="fa fa-list"></i>All Airlines</a></li>
		                	<li><a href="<?php echo base_url('admin/airlines/new'); ?>"><i class="fa fa-pencil-square-o"></i> New</a></li>
			            </ul>
	                </li>
	                <li>
	                    <a href="#aircraft-dropdown" data-toggle="collapse"><i class="fa fa-plane"></i> Aircraft</a>
	                    <ul id="aircraft-dropdown" class="collapse list-unstyled side-dropdown">
		                	<li><a href="<?php echo base_url('admin/aircrafts'); ?>"><i class="fa fa-list"></i>All Aircrafts</a></li>
		                	<li><a href="<?php echo base_url('admin/aircrafts/new'); ?>"><i class="fa fa-pencil-square-o"></i> New</a></li>
			            </ul>
	                </li>
	                <li>
	                    <a href="#tools-dropdown" data-toggle="collapse"><i class="fa fa-wrench"></i> Tools</a>
	                    <ul id="tools-dropdown" class="collapse list-unstyled side-dropdown">
	                    	<li><a href="<?php echo base_url('admin/cities/import'); ?>"><i class="fa fa-upload"></i> Import City</a></li>
		                	<li><a href="<?php echo base_url('admin/countries/import'); ?>"><i class="fa fa-upload"></i> Import Country</a></li>
		                	<li><a href="<?php echo base_url('admin/airlines/import'); ?>"><i class="fa fa-upload"></i> Import Airline</a></li>
		                	<li><a href="<?php echo base_url('admin/aircrafts/import'); ?>"><i class="fa fa-upload"></i> Import Aircraft</a></li>
			            </ul>
	                </li>
	                <li>
	                    <a href="#settings-dropdown" data-toggle="collapse"><i class="fa fa-cogs"></i> Settings</a>
	                    <ul id="settings-dropdown" class="collapse list-unstyled side-dropdown">
	                    	<li><a href="<?php echo base_url('admin/configuration'); ?>"><i class="fa fa-sliders"></i>Configurations</a></li>
		                	<li><a href="<?php echo base_url('admin/user'); ?>"><i class="fa fa-user"></i>User Account</a></li>
			            </ul>
	                </li>
	                <li>
	                    <a href="<?php echo base_url('admin/logout'); ?>"><i class="fa fa-sign-out"></i> Logout</a>
	                </li>
	            </ul>

	        </div>
	        <!-- /#sidebar-wrapper -->

	        <div class="page-content-wrapper">

	        	<section class="menu-drawer-section visible-xs">
		        	<div class="container-fluid">
		        		<a href="#menu-toggle" class="btn btn-success menu-toggle"><i class="fa fa-bars"></i> Menu</a>
		        	</div>
		        </section>