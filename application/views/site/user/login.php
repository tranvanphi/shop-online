 <div class="row">
  <div class="col-md-6 col-md-offset-3">
     <form enctype="multipart/form-data" action="<?php echo base_url('user/login')?>" method="post" class="form-login form_action">
     <h2>Người dùng đăng nhập</h2>
     <h3><?php echo form_error('login');?></h3>
     <div class="form-group">
     <label for="exampleInputEmail1">Địa chỉ Email</label>
         <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email">
         <div class="clear"></div>
         <div id="email_error" class="error"><?php echo form_error('email');?></div>
     </div>
     <div class="form-group">
     <label for="exampleInputPassword1">Mật khẩu</label>
         <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
         <div class="clear"></div>
         <div id="password_error" class="error"><?php echo form_error('password');?></div>
     </div>
     <button type="submit" class="btn btn-info btn-block">Đăng nhập</button>
     </form>
    
  </div>
  </div>