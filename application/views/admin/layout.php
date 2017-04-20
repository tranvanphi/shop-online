
<!-- new layout-->
<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('admin/head');?>
	</head>


	<body>
		<div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">

			<!-- Side Overlay-->
            <aside id="side-overlay">
            	<?php $this->load->view('admin/side-overlay/index');?>
            </aside>

            <!-- Sidebar -->
            <nav id="sidebar">
            	<?php $this->load->view('admin/sidebar/index');?>
            </nav>

            <!-- Header -->
            <header id="header-navbar" class="content-mini content-mini-full">
            	<?php $this->load->view('admin/header/index')?>
            </header>

            <!-- Main Container -->
            <main id="main-container">
            	<?php  $this->load->view($temp, $this->data)?>
            </main>

            <!-- Footer -->
            <footer id="page-footer" class="content-mini content-mini-full font-s12 bg-gray-lighter clearfix">
            	<?php $this->load->view('admin/footer/index')?>
            </footer>
		</div>
        
	</body>
</html>
