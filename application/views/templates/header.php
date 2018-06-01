<!DOCTYPE html>

<html lang="en">

    <head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1, width=device-width">

        <!-- Favicon -->
        <link rel = "shortcut icon" type = "image / x-icon" href = "<?php echo base_url('build/images/favicon/favicon-128x128.png'); ?>">
        <link rel = "shortcut icon" type = "image / x-icon" href = "<?php echo base_url('build/images/favicon/favicon-64x64.png'); ?>">
        <link rel = "shortcut icon" type = "image / x-icon" href = "<?php echo base_url('build/images/favicon/favicon-32x32.png'); ?>">
        <link rel = "shortcut icon" type = "image / x-icon" href = "<?php echo base_url('build/images/favicon/favicon-16x16.png'); ?>">

        <title><?php echo $title; ?></title>

        <!-- META -->
        <meta name="title" content="<?php echo $meta_title; ?>">
        <meta name="keywords" content="<?php echo $meta_keyword; ?>">
        <meta name="description" content="<?php echo $meta_description; ?>">
        <meta name="robots" content="index, follow" />
        <!-- OG META -->
        <meta property="og:site_name" content="<?php echo the_config('site_name'); ?>">
        <meta property="og:title" content="<?php echo $title; ?>" />
        <meta property="og:description" content="<?php echo $meta_description; ?>" />
        <meta property="og:image" itemprop="image" content="<?php echo base_url('build/images/og/image.jpg'); ?>">
        <meta property="og:url" content="<?php echo current_url(); ?>" />
        <meta property="og:type" content="website" />

        <link href="<?php echo base_url('build/css/styles.css?v=1.').strtotime('now'); ?>" rel="stylesheet">

        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', '<?php echo the_config('ga_id'); ?>', 'auto');
            ga('send', 'pageview');
        </script>

        <script src='https://www.google.com/recaptcha/api.js'></script>

    </head>


    <body>

		<header class="main-nav">

            <nav class="navbar navbar-default">
                <div class="container">

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo base_url(); ?>">
                            <img src="<?php echo base_url('build/images/logo.png'); ?>" alt="<?php echo the_config('site_name'); ?>" title="<?php echo the_config('site_name'); ?>" />
                        </a>
                    </div>

                    
                    <div class="collapse navbar-collapse menus" id="bs-example-navbar-collapse-1">

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?php echo base_url('about-us'); ?>">About Us</a></li>
                            <li><a href="<?php echo base_url('blog'); ?>">Blog</a></li>
                            <li><a href="<?php echo base_url('privacy-policy'); ?>">Privacy Policy</a></li>
                            <li><a href="<?php echo base_url('terms-and-conditions'); ?>">Terms and Conditions</a></li>
                            <li><a href="<?php echo base_url('contact-us'); ?>">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
			
		</header>

        <main>