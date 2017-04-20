<div class="row">
   <div class="col-sm-9">
    
    <?php 
    // pre($cart,false);
    if($totalItems > 0):?>

        <form action="<?php echo base_url('cart/update');?>" method="post">
      <table class="table">
         <thead>
            <th class="col-md-8"><h3>Giỏ hàng (có <?php echo $totalItems?> sản phẩm)</h3></th>
            <th class="col-md-2">giá mua</th>
            <th class="col-md-2">số lượng</th>

         </thead>
         <tbody>
         <?php $totalAmount = 0;?>
            <?php foreach($cart as $row):
            ?>
                <?php $totalAmount =$totalAmount + $row['subtotal'];?>

            <tr>
            <td>
               <div class="media">
                 <div class="media-left">
                   <a href="<?php echo base_url('product/view/').$row['id'];?>">
                     <img class="media-object img-product-cart" src="<?php echo base_url('uploads/product/').json_decode($row['image_list'])[0]?>" alt="<?php echo $row['name']?>">
                   </a>
                 </div>
                 <div class="media-body">
                   <h4 class="media-heading"><a href="<?php echo base_url('product/view/').$row['id'];?>"><?php echo $row['name']?></a></h4>
                   <?php 
                    if($row['total'] == 0){
                        echo "<p style='color: red;'>sản phẩm đã hết hàng</p>";
                    }else if($row['total'] < 6){
                        
                        echo "<p style='color: red;'>còn lại ".$row['total']." sản phẩm</p>";
                    }   
                   ?>
                   
                   <a href="<?php echo base_url('cart/delete/').$row['id']?>" class="btn btn-default">Xóa</a>
                 </div>
               </div>
            </td>
            <td>
                <?php 
                    if($row['discount'] > 0){
                        echo "<p class='number-price-new'>".($row['price'])." đ</p>";
                        echo "<p class='number-price-old'>".$row['price_old']." đ</p>";
                    }else{
                        echo "<p class='number-price-new'>".$row['price']." đ</p>";
                    }
                ?>
            </td>
            <td>
                <input class="form-control" name="qty_<?php echo $row['id']?>" value="<?php echo $row['qty']?>">

            </td>
            </tr>
            <?php endforeach;?>
            
         </tbody>
      </table>
      <a href="<?php echo base_url();?>" class="btn btn-primary"><i class="fa fa-angle-left" aria-hidden="true"></i> Tiếp tục mua hàng</a>
      <button type="submit" class="btn btn-info pull-right"><i class="fa fa-pencil" aria-hidden="true"></i> Cập nhật</button>
      </form>
      
      

   </div>
   <div class="col-sm-3">
      <div class="panel panel-default">
         <div class="panel-body">
            <div class="infor-price">
               <p>Tạm tính:</p>
               <p><?php echo number_format($totalAmount)?> đ</p>
            </div>
            <div class="clear"></div>
            <div class="total-price">
               <p>Tổng tiền:</p>
               <p><?php echo number_format($totalAmount)?> đ</p>
            </div>
            <div class="clear"></div>
            <div class="text-right">
               <p><i>(Đã bao gồm VAT)</i></p>
            </div>
         </div>
      </div>
      <a class="btn btn-block btn-danger btn-lg" href="<?php echo base_url('order/checkout');?>">Tiến hành đặt hàng</a>
   </div>
   <?php else:?>
        <h4>không có sản phẩm trong giỏ hàng!</h4>
        <a href="<?php echo base_url();?>" class="btn btn-primary btn-lg"><i class="fa fa-angle-left" aria-hidden="true"></i> Tiếp tục mua hàng</a>
    <?php endif;?>
</div>