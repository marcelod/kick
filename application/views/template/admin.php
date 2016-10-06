<!doctype html>
<html lang="<?php echo $lang; ?>">
    <head>
        <meta charset="<?php echo $charset; ?>">
        <title><?php echo $title; ?></title>
        <base href="<?php echo base_url(); ?>">

        <?php if ($mobile === FALSE): ?>
            <!--[if IE 8]>
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <![endif]-->
        <?php else: ?>
            <meta name="HandheldFriendly" content="true">
        <?php endif; ?>

        <?php if ($mobile == TRUE && $mobile_ie == TRUE): ?>
            <meta http-equiv="cleartype" content="on">
        <?php endif; ?>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="google" content="notranslate">
        <meta name="robots" content="noindex, nofollow">

        <?php if ($mobile == TRUE && $ios == TRUE): ?>
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="black">
            <meta name="apple-mobile-web-app-title" content="<?php echo $title; ?>">
        <?php endif; ?>

        <?php if ($mobile == TRUE && $android == TRUE): ?>
            <meta name="mobile-web-app-capable" content="yes">
        <?php endif; ?>

        <meta name="description" content="<?php echo $description; ?>">

        <!-- Extra metadata -->
        <?php echo $metadata; ?>
        <!-- / -->

        <link rel="icon" href="data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAqElEQVRYR+2WYQ6AIAiF8W7cq7oXd6v5I2eYAw2nbfivYq+vtwcUgB1EPPNbRBR4Tby2qivErYRvaEnPAdyB5AAi7gCwvSUeAA4iis/TkcKl1csBHu3HQXg7KgBUegVA7UW9AJKeA6znQKULoDcDkt46bahdHtZ1Por/54B2xmuz0uwA3wFfd0Y3gDTjhzvgANMdkGb8yAyY/ro1d4H2y7R1DuAOTHfgAn2CtjCe07uwAAAAAElFTkSuQmCC">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,700italic">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/bootstrap/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/font-awesome/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/ionicons/css/ionicons.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/adminlte/css/adminlte.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/adminlte/css/skins/skin-blue.min.css'); ?>">

        <?php if ($mobile === FALSE && $admin_prefs['transition_page'] == TRUE): ?>
            <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/animsition/animsition.min.css'); ?>">
        <?php endif; ?>

        <!-- esse nao ira mais ser passado assim, a remover -->
        <?php if ($this->router->fetch_class() == 'groups' && ($this->router->fetch_method() == 'create' OR $this->router->fetch_method() == 'edit')): ?>
            <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/colorpickersliders/colorpickersliders.min.css'); ?>">
        <?php endif; ?>

        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/domprojects/css/dp.min.css'); ?>">

        <?php echo $css; ?>

        <?php if ($mobile === FALSE): ?>
            <!--[if lt IE 9]>
                <script src="<?php echo base_url($plugins_dir . '/html5shiv/html5shiv.min.js'); ?>"></script>
                <script src="<?php echo base_url($plugins_dir . '/respond/respond.min.js'); ?>"></script>
            <![endif]-->
        <?php endif; ?>

    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini">

        <?php echo $body; ?>


        <script src="<?php echo base_url($frameworks_dir . '/jquery/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url($frameworks_dir . '/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/slimscroll/slimscroll.min.js'); ?>"></script>

        <?php if ($mobile == TRUE): ?>
            <script src="<?php echo base_url($plugins_dir . '/fastclick/fastclick.min.js'); ?>"></script>
        <?php endif; ?>

        <?php if ($admin_prefs['transition_page'] == TRUE): ?>
            <script src="<?php echo base_url($plugins_dir . '/animsition/animsition.min.js'); ?>"></script>
        <?php endif; ?>

        <?php if ($this->router->fetch_class() == 'users' && ($this->router->fetch_method() == 'create' OR $this->router->fetch_method() == 'edit')): ?>
            <script src="<?php echo base_url($plugins_dir . '/pwstrength/pwstrength.min.js'); ?>"></script>
        <?php endif; ?>

        <?php if ($this->router->fetch_class() == 'groups' && ($this->router->fetch_method() == 'create' OR $this->router->fetch_method() == 'edit')): ?>
            <script src="<?php echo base_url($plugins_dir . '/tinycolor/tinycolor.min.js'); ?>"></script>
            <script src="<?php echo base_url($plugins_dir . '/colorpickersliders/colorpickersliders.min.js'); ?>"></script>
        <?php endif; ?>

        <script src="<?php echo base_url($frameworks_dir . '/adminlte/js/adminlte.min.js'); ?>"></script>
        <script src="<?php echo base_url($frameworks_dir . '/domprojects/js/dp.min.js'); ?>"></script>

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
        <?php endif; ?>

    </body>
</html>