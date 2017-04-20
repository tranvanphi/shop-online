
<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('admin/head');?>
	</head>
	<body>
		<div class="content overflow-hidden">
			<div class="row">
                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                    <!-- Login Block -->
                    <div class="block block-themed animated fadeIn">
                        <div class="block-header bg-primary">
                            <ul class="block-options">
                                <li>
                                    <a href="base_pages_reminder.html">Quên mật khẩu ?</a>
                                </li>
                                <li>
                                    <a href="base_pages_register.html" data-toggle="tooltip" data-placement="left" title="New Account"><i class="si si-plus"></i></a>
                                </li>
                            </ul>
                            <h3 class="block-title">Đăng nhập</h3>
                        </div>
                        <div class="block-content block-content-full block-content-narrow">
                            <!-- Login Title -->
                            <h1 class="h3 font-w600 push-30-t push-5">Hệ thống quản lý</h1>
                            <!-- <p>Welcome, please login.</p> -->
                            <!-- END Login Title -->

                            <!-- Login Form -->
            
                            <form class="js-validation-login form-horizontal push-30-t push-50" action="#" method="post">

                                <?php 
				                	if(!empty(form_error('login')) && empty(form_error('login-username')) && empty(form_error('login-password')))
				                	{
				                		echo "<div class='animated bounceIn' style='color:red; font-weight:bold;'>".form_error('login')." </div>";
				                	}	
			                	?>

                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material floating">
                                            <input class="form-control" type="text" id="login3-username" name="login-username" value="">
                                            <label for="login3-username">Tên đăng nhập</label>  	
                                        </div>
                                        <?php
                                        	if(!empty(form_error('login-username')))
                                        	{
                                        		echo "<div id='val-username3-error' class='help-block text-right animated fadeInDown' style='color:red;'>".form_error('login-username')."</div>";
                                        	}
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material floating">
                                            <input class="form-control" type="password" id="login3-password" name="login-password" value="">
                                            <label for="login3-password">Mật khẩu</label>

                                        </div>
                                        <?php
                                        	if(!empty(form_error('login-password')))
                                        	{
                                        		echo "<div id='val-username3-error' class='help-block text-right animated fadeInDown' style='color:red;'>".form_error('login-password')."</div>";
                                        	}
                                        ?>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <div class="col-xs-12">
                                        <label class="css-input switch switch-sm switch-primary">
                                            <input type="checkbox" id="login-remember-me" name="login-remember-me"><span></span> Ghi nhớ đăng nhập ?
                                        </label>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-6 col-md-4">
                                        <button class="btn btn-primary" type="submit">Đăng nhập <i class="si si-login"></i></button>
                                    </div>
                                </div>
                            </form>
                            <!-- END Login Form -->
                        </div>
                    </div>
                    <!-- END Login Block -->
                </div>
            </div>
		</div>

		<!-- Login Footer -->
        <div class="push-10-t text-center animated fadeInUp">
            <small class="text-muted font-w600"><span class="js-year-copy"></span> Copyright &copy; Tran van phi</small>
        </div>

        <?php //$this->load->view('admin/bottom')?>
	</body>
</html>


<!--  -->
