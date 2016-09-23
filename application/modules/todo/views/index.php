<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Todo example
                <small>AJAX (fake)</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a>
                </li>
                <li class="active">Todo example</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    
	<?php echo $pagelet_todo; ?>

	<?php
	// As it was designed to be an independent component,
	// you can try to use the todo pagelet anywhere.
	// echo '<hr>';
	// echo Modules::run('todo/_pagelet_todo');
	?>

</div>
<!-- /.container -->