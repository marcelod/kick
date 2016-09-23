<!-- Page Content -->
<div class="container" ng-app>

    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Angular Sample
                <small>Subheading</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.html">Home</a>
                </li>
                <li class="active">Angular Sample</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <!-- Content Row -->
    <div class="row">
        <!-- Sidebar Column -->
        <?php $this->load->view('angular/sidebar'); ?>
        <!-- Content Column -->
        <div class="col-md-9">
            <h2>Angular</h2>
            <input type="text" ng-model="text" class="form-control" placeholder="type here to text angular">

            <div class="well wel-sm" ng-bind="text"></div>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->