<div class="container">
   <div class="row top-header">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="phone"><i class="fa fa-phone" aria-hidden="true"></i> 0946191773</div>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-12">
         <div class="logo"><h2>Shop Mobile</h2></div>
      </div>
      <div class="col-md-6 col-sm-5 col-xs-12">
      <form method="post" action="<?php echo base_url('product/search')?>">
         <div class="input-group">
            <span class="input-group-addon icon-search"><i class="fa fa-search"></i></span>
            <input type="text" id="text-search" name="key-search" class="form-control input-search" placeholder="Search product...">
            <span class="input-group-btn span-button">
               <button class="btn btn-info button-search" type="submit">Search</button>
            </span>
         </div>
       </form>
        
      </div>

      <div class="col-md-3 col-sm-3 hidden-xs">
         <a class="btn btn-block cart" href="<?php echo base_url('cart')?>"><i class="fa fa-shopping-cart"></i> Giỏ hàng <?php if($totalItems > 0) {echo $totalItems;}?></a>
      </div>
   </div>
   
</div>
<nav class="navbar navbar-default navbar-default-custom">
   <div class="container">  
      <div class="row"> 
         <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
         </div>

         <div id="navbar" class="navbar-collapse collapse navbar-collapse-custom">
            <ul class="nav navbar-nav">
               <li class="active"><a href="<?php echo base_url()?>">Trang chủ</a></li>
               <li><a href="#">Giới thiệu</a></li>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sản phẩm <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                  <?php foreach($catalogList as $row):?>
                     <li><a href="<?php echo base_url('product/catalog/').$row->id;?>"><?php echo $row->name?></a></li>
                  <?php endforeach;?>   
                  </ul>
               </li>
               <li><a href="#">Tin tức</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
               <?php if(!isset($userInfo)):?>
               <li><a href="<?php echo base_url('user/login');?>">Đăng nhập</a></li>
               <li><a href="<?php echo base_url('user/register');?>">Đăng ký</a></li>
               <?php else:?>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $userInfo->name;?><span class="caret"></span></a>
                  <ul class="dropdown-menu">
                     <li><a href="<?php echo base_url('user');?>">Thông tin người dùng</a></li>
                     <li><a href="<?php echo base_url('user/logout');?>">Đăng xuất</a></li>
                  </ul>
               </li>
               <?php endif;?>
            </ul>
         </div>
      </div> 
   </div>
</nav>