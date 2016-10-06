<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
            <header class="main-header">
                <a href="<?php echo site_url('admin/dashboard'); ?>" class="logo">
                    <span class="logo-mini"><b>A</b><?php echo $title_mini; ?></span>
                    <span class="logo-lg"><b>Admin</b><?php echo $title_lg; ?></span>
                </a>

                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
<?php if ($admin_prefs['messages_menu'] == TRUE): ?>
                            <!-- Messages -->
                            <li class="dropdown messages-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="label label-success">0</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header"><?php echo lang('header_you_have'); ?> 0 <?php echo lang('header_message'); ?></li>
                                    <li>
                                        <ul class="menu">
                                            <li><!-- start message -->
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="<?php echo base_url($avatar_dir . '/m_002.png'); ?>" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>Support Team<small><i class="fa fa-clock-o"></i> 5 mins</small></h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li><!-- end message -->
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#"><?php echo lang('header_view_all'); ?></a></li>
                                </ul>
                            </li>

<?php endif; ?>

<?php echo $header_alert_file_install; ?>

<?php if ($admin_prefs['notifications_menu'] == TRUE): ?>
                            <!-- Notifications -->
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning">0</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header"><?php echo lang('header_you_have'); ?> 0 <?php echo lang('header_notification'); ?></li>
                                    <li>
                                        <ul class="menu">
                                            <li><!-- start notification -->
                                                <a href="#"><i class="fa fa-users text-aqua"></i> 5 new members joined today</a>
                                            </li><!-- end notification -->
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#"><?php echo lang('header_view_all'); ?></a></li>
                                </ul>
                            </li>

<?php endif; ?>
<?php if ($admin_prefs['tasks_menu'] == TRUE): ?>
                            <!-- Tasks -->
                            <li class="dropdown tasks-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-flag-o"></i>
                                    <span class="label label-danger">0</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header"><?php echo lang('header_you_have'); ?> 0 <?php echo lang('header_task'); ?></li>
                                    <li>
                                        <ul class="menu">
                                            <li><!-- start task -->
                                                <a href="#">
                                                    <h3>Design some buttons<small class="pull-right">20%</small></h3>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">20% <?php echo lang('header_complete'); ?></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li><!-- end task -->
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#"><?php echo lang('header_view_all'); ?></a></li>
                                </ul>
                            </li>

<?php endif; ?>
<?php if ($admin_prefs['user_menu'] == TRUE): ?>
                            <!-- User Account -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url($avatar_dir . '/m_001.png'); ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo $user_login['username']; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="<?php echo base_url($avatar_dir . '/m_001.png'); ?>" class="img-circle" alt="User Image">
                                        <p><?php echo $user_login['firstname'].$user_login['lastname']; ?><small><?php echo lang('header_member_since'); ?> <?php echo date('d-m-Y', $user_login['created_on']); ?></small></p>
                                    </li>
                                    <li class="user-body">
                                        <div class="row">
                                            <div class="col-xs-4 text-center">
                                                <a href="#"><?php echo lang('header_followers'); ?></a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#"><?php echo lang('header_sales'); ?></a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#"><?php echo lang('header_friends'); ?></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo site_url('admin/users/profile/'.$user_login['id']); ?>" class="btn btn-default btn-flat"><?php echo lang('header_profile'); ?></a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo site_url('auth/logout/admin'); ?>" class="btn btn-default btn-flat"><?php echo lang('header_sign_out'); ?></a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

<?php endif; ?>
<?php if ($admin_prefs['ctrl_sidebar'] == TRUE): ?>
                            <!-- Control Sidebar Toggle Button -->
                            <li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>
<?php endif; ?>
                        </ul>
                    </div>
                </nav>
            </header>



            <aside class="main-sidebar">
                <section class="sidebar">
<?php if ($admin_prefs['user_panel'] == TRUE): ?>
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url($avatar_dir . '/m_001.png'); ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $user_login['firstname'].$user_login['lastname']; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> <?php echo lang('menu_online'); ?></a>
                        </div>
                    </div>

<?php endif; ?>
<?php if ($admin_prefs['sidebar_form'] == TRUE): ?>
                    <!-- Search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="<?php echo lang('menu_search'); ?>...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>

<?php endif; ?>
                    <!-- Sidebar menu -->
                    <ul class="sidebar-menu">

                        <li class="header text-uppercase">AdminLTE</li>
                        <li class="treeview <?=active_link_controller('dash')?>">
                          <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li class="<?=active_link_function('v1')?>">
                                <a href="<?php echo site_url('admin_lte/dash/v1') ?>">
                                    <i class="fa fa-circle-o"></i> Dashboard v1
                                </a>
                            </li>
                            <li class="<?=active_link_function('v2')?>">
                                <a href="<?php echo site_url('admin_lte/dash/v2') ?>">
                                    <i class="fa fa-circle-o"></i> Dashboard v2
                                </a>
                            </li>
                          </ul>
                        </li>
                        <li class="<?=active_link_controller('widgets')?>">
                          <a href="<?php echo site_url('admin_lte/widgets') ?>">
                            <i class="fa fa-th"></i> <span>Widgets</span>
                            <span class="pull-right-container">
                              <small class="label pull-right bg-green">new</small>
                            </span>
                          </a>
                        </li>
                        <li class="treeview <?=active_link_controller('charts')?>">
                          <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>Charts</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li class="<?=active_link_function('chartjs')?>">
                                <a href="<?php echo site_url('admin_lte/charts/chartjs') ?>">
                                    <i class="fa fa-circle-o"></i> ChartJS
                                </a>
                            </li>
                            <li class="<?=active_link_function('morris')?>">
                                <a href="<?php echo site_url('admin_lte/charts/morris') ?>">
                                    <i class="fa fa-circle-o"></i> Morris
                                </a>
                            </li>
                            <li class="<?=active_link_function('flot')?>">
                                <a href="<?php echo site_url('admin_lte/charts/flot') ?>">
                                    <i class="fa fa-circle-o"></i> Flot
                                </a>
                            </li>
                            <li class="<?=active_link_function('inline')?>">
                                <a href="<?php echo site_url('admin_lte/charts/inline') ?>">
                                    <i class="fa fa-circle-o"></i> Inline charts
                                </a>
                            </li>
                          </ul>
                        </li>
                        <li class="treeview <?=active_link_controller('ui')?>">
                          <a href="#">
                            <i class="fa fa-laptop"></i>
                            <span>UI Elements</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li class="<?=active_link_function('general')?>">
                                <a href="<?php echo site_url('admin_lte/ui/general') ?>">
                                    <i class="fa fa-circle-o"></i> General
                                </a>
                            </li>
                            <li class="<?=active_link_function('icons')?>">
                                <a href="<?php echo site_url('admin_lte/ui/icons') ?>">
                                    <i class="fa fa-circle-o"></i> Icons
                                </a>
                            </li>
                            <li class="<?=active_link_function('buttons')?>">
                                <a href="<?php echo site_url('admin_lte/ui/buttons') ?>">
                                    <i class="fa fa-circle-o"></i> Buttons
                                </a>
                            </li>
                            <li class="<?=active_link_function('sliders')?>">
                                <a href="<?php echo site_url('admin_lte/ui/sliders') ?>">
                                    <i class="fa fa-circle-o"></i> Sliders
                                </a>
                            </li>
                            <li class="<?=active_link_function('timeline')?>">
                                <a href="<?php echo site_url('admin_lte/ui/timeline') ?>">
                                    <i class="fa fa-circle-o"></i> Timeline
                                </a>
                            </li>
                            <li class="<?=active_link_function('modals')?>">
                                <a href="<?php echo site_url('admin_lte/ui/modals') ?>">
                                    <i class="fa fa-circle-o"></i> Modals
                                </a>
                            </li>
                          </ul>
                        </li>
                        <li class="treeview <?=active_link_controller('forms')?>">
                          <a href="#">
                            <i class="fa fa-edit"></i> <span>Forms</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li class="<?=active_link_function('general')?>">
                                <a href="<?php echo site_url('admin_lte/forms/general') ?>">
                                    <i class="fa fa-circle-o"></i> General Elements
                                </a>
                            </li>
                            <li class="<?=active_link_function('advanced')?>">
                                <a href="<?php echo site_url('admin_lte/forms/advanced') ?>">
                                    <i class="fa fa-circle-o"></i> Advanced Elements
                                </a>
                            </li>
                            <li class="<?=active_link_function('editors')?>">
                                <a href="<?php echo site_url('admin_lte/forms/editors') ?>">
                                    <i class="fa fa-circle-o"></i> Editors
                                </a>
                            </li>
                          </ul>
                        </li>
                        <li class="treeview <?=active_link_controller('tables')?>">
                          <a href="#">
                            <i class="fa fa-table"></i> <span>Tables</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li class="<?=active_link_function('simple')?>">
                                <a href="<?php echo site_url('admin_lte/tables/simple') ?>">
                                    <i class="fa fa-circle-o"></i> Simple tables
                                </a>
                            </li>
                            <li class="<?=active_link_function('data')?>">
                                <a href="<?php echo site_url('admin_lte/tables/data') ?>">
                                    <i class="fa fa-circle-o"></i> Data tables
                                </a>
                            </li>
                          </ul>
                        </li>
                        <li class="<?=active_link_controller('calendar')?>">
                          <a href="<?php echo site_url('admin_lte/calendar') ?>">
                            <i class="fa fa-calendar"></i> <span>Calendar</span>
                            <span class="pull-right-container">
                              <small class="label pull-right bg-red">3</small>
                              <small class="label pull-right bg-blue">17</small>
                            </span>
                          </a>
                        </li>
                        <li class="<?=active_link_controller('mailbox')?>">
                          <a href="<?php echo site_url('admin_lte/mailbox') ?>">
                            <i class="fa fa-envelope"></i> <span>Mailbox</span>
                            <span class="pull-right-container">
                              <small class="label pull-right bg-yellow">12</small>
                              <small class="label pull-right bg-green">16</small>
                              <small class="label pull-right bg-red">5</small>
                            </span>
                          </a>
                        </li>
                        <li class="treeview <?=active_link_controller('examples')?>">
                          <a href="#">
                            <i class="fa fa-folder"></i> <span>Examples</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li class="<?=active_link_function('invoice')?>">
                                <a href="<?php echo site_url('admin_lte/examples/invoice') ?>">
                                    <i class="fa fa-circle-o"></i> Invoice
                                </a>
                            </li>
                            <li class="<?=active_link_function('profile')?>">
                                <a href="<?php echo site_url('admin_lte/examples/profile') ?>">
                                    <i class="fa fa-circle-o"></i> Profile
                                </a>
                            </li>
                            <li class="<?=active_link_function('blank')?>">
                                <a href="<?php echo site_url('admin_lte/examples/blank') ?>">
                                    <i class="fa fa-circle-o"></i> Blank Page
                                </a>
                            </li>
                            <li class="<?=active_link_function('pace')?>">
                                <a href="<?php echo site_url('admin_lte/examples/pace') ?>">
                                    <i class="fa fa-circle-o"></i> Pace Page
                                </a>
                            </li>
                          </ul>
                        </li>
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-share"></i> <span>Multilevel</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                            <li>
                              <a href="#"><i class="fa fa-circle-o"></i> Level One
                                <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                                </span>
                              </a>
                              <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                                <li>
                                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                                    <span class="pull-right-container">
                                      <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                  </a>
                                  <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                  </ul>
                                </li>
                              </ul>
                            </li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                          </ul>
                        </li>
                        <li class="header">LABELS</li>
                        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
                        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
                        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>

                    </ul>
                </section>
            </aside>