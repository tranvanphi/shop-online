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
            <a class="h5 text-white" href="<?php echo Admin_url('dashboard');?>">
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
                        <!-- <li>
                            <a href="<?php //echo Admin_url('order')?>">Đơn hàng sản phẩm</a>
                        </li> -->
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
                        <!-- <li>
                            <a href="#">Phản hồi</a>
                        </li> -->
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
                            <a href="#">Hỗ trợ</a>
                        </li>
                        <li>
                            <a href="#">Liên hệ</a>
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
                        
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END Side Content -->
    </div>
    <!-- Sidebar Content -->
</div>