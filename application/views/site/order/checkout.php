<div class="row">
<form enctype="multipart/form-data" action="<?php echo base_url('order/checkout')?>" method="post" class="t-form form_action">

   <div class="col-sm-8">
   <?php //pre($user,false);
      $stinginput = "";
      if (!empty($user)):
   ?>
   <?php 
      $stinginput .= "<div class='panel panel-default panel-order-custom'>
                        <div class='panel-body'>
                           <input type='text' name='name' class='form-control name-order-custom' value='".$user->name."'>
                           <input type='email' name='email' class='form-control name-order-custom' value='".$user->email."'>";
      if(!empty($user->phone) && !empty($user->address))
      {
         $stinginput .= "<textarea name='address' class='form-control address-order-custom' value='".$user->address."'>".$user->address."</textarea>
                           <input name='phone' class='form-control phone-order-custom' value='".$user->phone."'>";
      }else{
         $stinginput .= "<textarea class='form-control address-order-custom1' placeholder='Nhập địa chỉ' value='".$user->address."' name='address'>".$user->address."</textarea>
                        <input type='text' name='phone' class='form-control phone-order-custom1' value='".$user->phone."' placeholder='Số điện thoại'>";
      }
      $stinginput .="</div></div>";



   ?>
     
   <?php else:?>
      <?php $stinginput .= "<div class='panel panel-default panel-order-custom'>
         <div class='panel-body'>
            <input type='text' name='name' class='form-control name-order-custom1' placeholder='Tên người mua'>
            <input type='email' name='email' class='form-control name-order-custom1' placeholder='Email'>
            <textarea name='address' class='form-control address-order-custom1' placeholder='Nhập địa chỉ'></textarea>
            <input type='text' name='phone' class='form-control phone-order-custom1' placeholder='Số điện thoại'>
         </div>
      </div>";?>
   <?php endif;?>
   <?php echo $stinginput?>

      <!-- when user login then show panel-->
      <!-- <div class="panel panel-default panel-order-custom">
         <div class="panel-body">
            <input type="" name="" class="form-control name-order-custom" placeholder="Tên người mua" value="tran van phi" disabled>
            when esset value address and phone
            <textarea class="form-control address-order-custom" placeholder="Nhập địa chỉ" disabled>656 Võ Văn Kiệt, Phường 01, Quận 5, Hồ Chí Minh Việt Nam</textarea>
            <input type="" name="" class="form-control phone-order-custom" placeholder="Số điện thoại" value="09476384789" disabled>
            
            when empty value address and phone
            <textarea class="form-control address-order-custom1" placeholder="Nhập địa chỉ"></textarea>
            <input type="" name="" class="form-control phone-order-custom1" placeholder="Số điện thoại">
         </div>
      </div> -->
      <!-- when user not login then show panel input-->
      <!-- <div class="panel panel-default panel-order-custom">
         <div class="panel-body">
            <input type="text" name="name" class="form-control name-order-custom1" placeholder="Tên người mua">
            <input type="email" name="email" class="form-control name-order-custom1" placeholder="Email">
            <textarea name="address" class="form-control address-order-custom1" placeholder="Nhập địa chỉ"></textarea>
            <input type="text" name="phone" class="form-control phone-order-custom1" placeholder="Số điện thoại">
         </div>
      </div> -->

      <div class="col-sm-6 btn-custom-order">
      <!-- <button class="btn btn-lg btn-danger btn-block"></button> -->
      <input type="submit" name="submit" class="btn btn-lg btn-danger btn-block" value="ĐẶT MUA">
      </div>
   </div>
   <div class="col-sm-4">
      <?php //pre($cart,false);
         if($totalItems > 0):
      ?>
      <div class="panel panel-default">
         <div class="panel-body">
            <div class="head-panel-order">
               <p>Đơn hàng (<?php echo $totalItems?> sản phẩm)</p>
               <a href="<?php echo base_url('cart')?>" class="btn btn-default">sửa</a>
               <div class="clear"></div>
            </div>
           
            <div class="product">
               <?php $totalAmount = 0;?>
               <?php foreach($cart as $row):?>
                  <?php $totalAmount =$totalAmount + $row['subtotal'];?>
               
               <div class="item-product">
                  <p class="name-product"><?php echo $row['qty']?> X <a href="<?php echo base_url('product/view/').$row['id'];?>"><?php echo $row['name']?></a></p>

                  <?php 
                     
                        $price = $row['price'];
                  ?>

                  <p class="price-product"><?php echo ($price*$row['qty']); ?>đ</p>
               </div>
               <?php endforeach;?>
               
            </div>
            
            <div class="clear"></div>
            <div class="total-price">
               <p>Tổng tiền:</p>
               <p><?php echo $totalAmount;?> đ</p>
               <input type="hidden" name="totalAmount" value="<?php echo $totalAmount;?>">
            </div>
            <div class="clear"></div>
            <div class="text-right">
               <p><i>(Đã bao gồm VAT)</i></p>
            </div>

            
            
         </div>
      </div>
   <?php endif;?>
   </div>

</form>
</div>