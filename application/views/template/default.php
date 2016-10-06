<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
    <head>
        <meta charset="<?php echo $charset; ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?></title>
        <base href="<?php echo base_url(); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo $description; ?>">

        <!-- Extra metadata -->
        <?php echo $metadata; ?>
        <!-- / -->

        <!-- favicon.ico and apple-touch-icon.png -->

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/bootstrap/css/bootstrap.min.css'); ?>">
        <!-- Font-Awesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/font-awesome/css/font-awesome.min.css'); ?>">
        <!-- Custom styles -->
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/public/css/main.css'); ?>">
        <?php echo $css; ?>
        <!-- / -->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="<?php echo assets_url('js/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo assets_url('js/respond.min.js'); ?>"></script>
        <![endif]-->

        <script>
            var BASE_URL = "<?php echo base_url(); ?>";
        </script>
    </head>
    <body>
        <?php echo $body; ?>
        <!-- / -->

        <script src="<?php echo base_url($frameworks_dir . '/jquery/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url($frameworks_dir . '/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url($frameworks_dir . '/public/js/main.js'); ?>"></script>
        <!-- Extra javascript -->
        <?php echo $js; ?>
        <!-- / -->

        <?php if ( ! empty($ga_id)): ?><!-- Google Analytics -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','<?php echo $ga_id; ?>');ga('send','pageview');
        </script>
        <?php endif; ?><!-- / -->
    </body>
</html>