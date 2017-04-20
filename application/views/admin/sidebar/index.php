<div id="sidebar-scroll">
    <!-- Sidebar Content -->
    <!-- Adding .sidebar-mini-hide to an element will hide it when the sidebar is in mini mode -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="side-header side-content bg-white-op">
            <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
            <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close">
                <i class="fa fa-times"></i>
            </button>
            <!-- Themes functionality initialized in App() -> uiHandleTheme() -->
            <div class="btn-group pull-right">
                <button class="btn btn-link text-gray dropdown-toggle" data-toggle="dropdown" type="button">
                    <i class="si si-drop"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-right font-s13 sidebar-mini-hide">
                    <li>
                        <a data-toggle="theme" data-theme="default" tabindex="-1" href="javascript:void(0)">
                            <i class="fa fa-circle text-default pull-right"></i> <span class="font-w600">Default</span>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="theme" data-theme="assets/css/themes/amethyst.min.css" tabindex="-1" href="javascript:void(0)">
                            <i class="fa fa-circle text-amethyst pull-right"></i> <span class="font-w600">Amethyst</span>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="theme" data-theme="assets/css/themes/city.min.css" tabindex="-1" href="javascript:void(0)">
                            <i class="fa fa-circle text-city pull-right"></i> <span class="font-w600">City</span>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="theme" data-theme="assets/css/themes/flat.min.css" tabindex="-1" href="javascript:void(0)">
                            <i class="fa fa-circle text-flat pull-right"></i> <span class="font-w600">Flat</span>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="theme" data-theme="assets/css/themes/modern.min.css" tabindex="-1" href="javascript:void(0)">
                            <i class="fa fa-circle text-modern pull-right"></i> <span class="font-w600">Modern</span>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="theme" data-theme="assets/css/themes/smooth.min.css" tabindex="-1" href="javascript:void(0)">
                            <i class="fa fa-circle text-smooth pull-right"></i> <span class="font-w600">Smooth</span>
                        </a>
                    </li>
                </ul>
            </div>
            <a class="h5 text-white" href="index.html">
                <i class="fa fa-circle-o-notch text-primary"></i> <span class="h4 font-w600 sidebar-mini-hide">ne</span>
            </a>
        </div>
        <!-- END Side Header -->

        <!-- Side Content -->
        <div class="side-content">
            <ul class="nav-main">
                <li>
                    <a href="<?php echo Admin_url('dashboard');?>"><i class="si si-speedometer"></i><span class="sidebar-mini-hide">Bảng điều khiển</span></a>
                </li>
                
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-badge"></i><span class="sidebar-mini-hide">Quản lý bán hàng</span></a>
                    <ul>
                        <li>
                            <a href="<?php echo Admin_url('transaction')?>">Giao dịch</a>
                        </li>
                        <li>
                            <a href="<?php echo Admin_url('order')?>">Đơn hàng sản phẩm</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-grid"></i><span class="sidebar-mini-hide">Sản phẩm</span></a>
                    <ul>
                        <li>
                            <a href="<?php echo Admin_url('product');?>">Sản phẩm</a>
                        </li>
                        <li>
                            <a href="<?php echo Admin_url('catalog');?>">Danh mục</a>
                        </li>
                        <li>
                            <a href="admin/comment.html">Phản hồi</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-note"></i><span class="sidebar-mini-hide">Tài khoản</span></a>
                    <ul>
                        <li>
                            <a href="<?php echo Admin_url('admin')?>">Ban quản trị</a>
                        </li>
                        <!-- <li>
                            <a href="<?php //echo Admin_url('adminGroup')?>">Nhóm quản trị</a>
                        </li> -->
                        <li>
                            <a href="<?php echo Admin_url('user')?>">Thành viên</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-wrench"></i><span class="sidebar-mini-hide">Hỗ trợ và liên hệ</span></a>
                    <ul>
                        <li>
                            <a href="admin/support.html">Hỗ trợ</a>
                        </li>
                        <li>
                            <a href="admin/contact.html">Liên hệ</a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-magic-wand"></i><span class="sidebar-mini-hide">Nội dung</span></a>
                    <ul>
                        <li>
                            <a href="<?php echo Admin_url('slide');?>">Slide</a>
                        </li>
                        <li>
                            <a href="<?php echo Admin_url('news');?>">Tin tức</a>
                        </li>
                        <li>
                            <a href="admin/info.html">Trang thông tin</a>
                        </li>
                        <li>
                            <a href="admin/video.html">Video</a>
                        </li>
                        
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END Side Content -->
    </div>
    <!-- Sidebar Content -->
</div>