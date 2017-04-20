<!DOCTYPE html>
<html>
	<head>
		<!-- head page -->
		<?php $this->load->view('site/head'); ?>
	</head>

	<body onscroll="myFunction()">
		<section id="page-header">
			<?php $this->load->view('site/header/index'); ?>
		</section>	
		
		<section id="content">
			<div class="container">
				<?php $this->load->view($temp, $this->data);?>
			</div>
		</section>

		<section id="footer">
			<?php $this->load->view('site/footer/index'); ?>
		</section>

	</body>

	<script src="<?php echo PUBLIC_URL('site');?>bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo PUBLIC_URL('site');?>bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
	<script src="<?php echo PUBLIC_URL('site');?>js/carousel_owl/owl.carousel.js"></script>
	<script src="<?php echo PUBLIC_URL('site');?>node_modules/swiper/dist/js/swiper.js" type="text/javascript"></script>
	<script src="<?php echo PUBLIC_URL('site');?>jqzoom_ev-2.3/js/jquery.jqzoom-core.js" type="text/javascript"></script>
	<script src="<?php echo PUBLIC_URL('site');?>js/js.js"></script>
</html>