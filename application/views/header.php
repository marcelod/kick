<header class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<?php echo site_url(); ?>" class="navbar-brand">Kick</a>
        </div>
        <nav class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="<?php echo $nav_active === 'services' ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('services'); ?>">Services</a>
                </li>
                <li class="<?php echo $nav_active === 'about' ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('about'); ?>">About</a>
                </li>
                <li class="dropdown <?php echo $nav_active === 'portfolio' ? 'active' : ''; ?>">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Portfolio <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo site_url('portfolio/col_1'); ?>">1 Column Portfolio</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('portfolio/col_2'); ?>">2 Column Portfolio</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('portfolio/col_3'); ?>">3 Column Portfolio</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('portfolio/col_4'); ?>">4 Column Portfolio</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('portfolio/item'); ?>">Single Portfolio Item</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown <?php echo $nav_active === 'blog' ? 'active' : ''; ?>">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Blog <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url('blog/home_1'); ?>">Blog Home 1</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('blog/home_2'); ?>">Blog Home 2</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('blog/post'); ?>">Blog Post</a>
                        </li>
                    </ul>
                </li>
                <li class="<?php echo $nav_active === 'contact' ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('contact'); ?>">Contact</a>
                </li>
                <li class="dropdown <?php echo $nav_active === 'other' ? 'active' : ''; ?>">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Other Pages <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo site_url('todo'); ?>">Todo</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('full_width'); ?>">Full Width Page</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('sidebar'); ?>">Sidebar Page</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('faq'); ?>">FAQ</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('Error_404'); ?>">404</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('pricing'); ?>">Pricing Table</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo site_url('auth'); ?>">Access</a></li>
                <li><a target="_blank" href="https://github.com/marcelod/kick"><i class="fa fa-github-alt"></i></a></li>
            </ul>
        </nav>
    </div>
</header>