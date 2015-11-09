<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title><?php echo $title; ?></title>

        <base href="<?php echo base_url(); ?>">

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="<?php echo $description; ?>">

        <!-- Extra metadata -->
        <?php echo $metadata; ?>
        <!-- / -->

        <link rel="stylesheet" href="<?php echo base_url('bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
        <!-- Font-Awesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url('bower_components/font-awesome/css/font-awesome.min.css'); ?>">
        <!-- IonicIcons CSS -->
        <link rel="stylesheet" href="<?php echo base_url('bower_components/ionicons/css/ionicons.min.css'); ?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo assets_url('css/AdminLTE.min.css'); ?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo assets_url('css/skinsAdminLTE/_all-skins.min.css'); ?>">

        <?php echo $css; ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="<?php echo assets_url('js/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo assets_url('js/respond.min.js'); ?>"></script>
        <![endif]-->
    </head>

    <body class="hold-transition skin-blue sidebar-mini">

        <?php echo $body; ?>

        <script src="<?php echo base_url('bower_components/jquery/dist/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('bower_components/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
        <script src="<?php echo base_url('bower_components/fastclick/lib/fastclick.min.js'); ?>"></script>
        <script src="<?php echo assets_url('js/AdminLTE/app.min.js'); ?>"></script>
        <script src="<?php echo assets_url('js/AdminLTE/demo.js'); ?>"></script>

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
