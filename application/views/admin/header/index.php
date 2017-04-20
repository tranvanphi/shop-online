<!-- Header Navigation Right -->
<ul class="nav-header pull-right">
    <li>
        <div class="btn-group">
            <button class="btn btn-default btn-image dropdown-toggle" data-toggle="dropdown" type="button">
                <img src="<?php echo PUBLIC_URL('admin')?>assets/img/avatars/avatar10.jpg" alt="Avatar">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                <li>
                    <a tabindex="-1" href="<?php echo Admin_url('admin/logout');?>">
                        <i class="si si-logout pull-right"></i>Thoát
                    </a>
                </li>
            </ul>
        </div>
    </li>
</ul>
<!-- END Header Navigation Right -->

<!-- Header Navigation Left -->
<ul class="nav-header pull-left">
    <li class="hidden-md hidden-lg">
        <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
        <button class="btn btn-default" data-toggle="layout" data-action="sidebar_toggle" type="button">
            <i class="fa fa-navicon"></i>
        </button>
    </li>
    <li class="hidden-xs hidden-sm">
        <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
        <button class="btn btn-default" data-toggle="layout" data-action="sidebar_mini_toggle" type="button">
            <i class="fa fa-ellipsis-v"></i>
        </button>
    </li>
    
</ul>