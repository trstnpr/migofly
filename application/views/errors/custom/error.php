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

        <title><?php echo 'Oh Snap! - '.the_config('site_name'); ?></title>

        <link href="<?php echo base_url('build/css/styles.css?v=1.').strtotime('now'); ?>" rel="stylesheet">

    </head>


    <body>


        <div class="error-page data-img" data-bg="<?php echo base_url('build/images/pattern.jpg'); ?>">
            

            <div class="container">
                
                <div class="row">
                    
                    <div class="col-sm-4 col-sm-offset-4">

                        <div class="error-wrapper">

                            <div class="inner">
                                <div class="icon">
                                    <img src="<?php echo base_url('build/images/err.png'); ?>" class="img-responsive" alt="Error" />
                                </div>
                                <div class="head">
                                    <h1>Oh Snap!</h1>
                                </div>
                                <div class="message">
                                    <p>Page is unavailable at the moment.</p>
                                </div>

                                <div class="action">
                                    <a href="<?php echo base_url(); ?>"><i class="fa fa-long-arrow-left"></i>  Back to Home</a>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


        </div>


        <script type="text/javascript" src="<?php echo base_url('build/js/master-scripts.js?v=1.').strtotime('now'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('build/js/scripts.js?v=1.').strtotime('now'); ?>"></script>

    </body>

</html>