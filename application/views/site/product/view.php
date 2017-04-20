<?php 
$arrayKeys = array_keys($imageList);
$img1 = $imageList[$arrayKeys[0]];
?>
<div class="row">
   <div class="col-sm-5">
      <div class="img-box">
         <div class="thumb">
            <div class="swiper-container">
            	<div class="swiper-wrapper"> 
	            	<?php 
						if(is_array($imageList)):
						foreach ($imageList as $img):
					?>
	                  <a class="swiper-slide" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo base_url('uploads/product/').$img?>',largeimage: '<?php echo base_url('uploads/product/').$img?>'}"><img class="img-thumb-test" src="<?php echo base_url('uploads/product/').$img?>"></a>
	               	<?php 
						endforeach;
						endif;
					?>
				</div>
               <div class="swiper-pagination"></div> 
            </div>
            <div class="swiper-button-next swipter-button-black"></div>
            <div class="swiper-button-prev swipter-button-black"></div>
         </div>
         <div class="wrap-jqzoom">
            <a href="<?php echo base_url('uploads/product/').$img1?>" class="jqzoom" rel='gal1'  title="" >
               <img src="<?php echo base_url('uploads/product/').$img1?>"  title="" style="width: 350px;">
            </a>
         </div>
      </div>            
   </div>

   <div class="col-sm-7">
      <div class="item-box"> 
         <h1 class="name-product"><?php echo $product->name?></h1>
         <div class="row">
            <div class="col-sm-7">
               <div class="item-row1">
                  <div class="row">
                     <div class="col-sm-6">
                        <p>Thương hiệu : <?php echo $catalog->name;?></p>
                       
                     </div>
                     <div class="col-sm-6"></div>
                  </div>
                  <?php 
						if($product->discount > 0)
						{ 
							$priceNew = $product->price - $product->discount;
						}else{
							$priceNew = $product->price;
						}
					?>
                  <p>giá sản phẩm: <?php echo number_format($priceNew);?> đ</p>
                  <p>Số lượt xem: <?php echo $product->view;?></p>
                  <p>bảo hành: <?php echo $product->warranty;?></p>
                  <?php 
                    if($product->total - $product->buyed == 0){
                        echo "<a class='btn btn-danger btn-lg btn-block' style='float:left;padding:8px 15px;font-size:16px' disabled title='Mua ngay'><i class='fa fa-frown-o' aria-hidden='true'></i> Sản phẩm tạm hết hàng</a>";
                    }else{
                      echo "<a class='btn btn-danger btn-lg btn-block' style='float:left;padding:8px 15px;font-size:16px' href='".base_url('cart/add/').$product->id."' title='Mua ngay'><i class='fa fa-shopping-cart' aria-hidden='true'></i> Thêm vào giỏ hàng</a>";
                    }
                  ?>
                  
               </div>

            </div>
            <div class="col-sm-5"></div>
         </div>
      </div>
   </div>
   
   <div class="col-md-12">
   <div class="panel panel-default panel-default-custom">
            <div class="panel-heading">
               <h3 class="panel-title">Sản phẩm cùng thể loại</h3>
            </div>
            <div class="panel-body panel-body3">
               <div class="owl-carousel">
                  
                  <?php foreach($productLikeCatalog as $row):?>
                            <?php 
                                $image = json_decode($row->image_list);
                                $arrayKeys = array_keys($image);
                                $img = $image[$arrayKeys[0]];
                            ?>
                            <div class="thumbnail thumbnail-custom">
                                <img src="<?php echo base_url('uploads/product/').$img?>" alt="<?php echo $row->name?>">
                                <p class="view">lượt xem: <?php echo $row->view?></p>
                                <div class="btn-buy">
                                    <!-- <a href="<?php// echo base_url('product/view/').$row->id;?>" class="btn btn-default btn-buy-custom">Mua hàng</a><br> -->
                                    <a href="<?php echo base_url('product/view/').$row->id;?>" class="btn btn-default btn-detalt-custom">Chi tiết</a>

                                </div>

                                <div class="caption">
                                    <h3><?php echo $row->name?></h3>
                                    <?php if($row->discount > 0):?>
                                    <?php $priceNew = $row->price - $row->discount;?>
                                        <p class="price">Giá mới: <?php echo number_format($priceNew)?> đ</p>
                                        <p class="price-old">Giá cũ: <?php echo number_format($row->price)?> đ</p>

                                    <?php else:?>
                                        <p class="price">Giá: <?php echo number_format($row->price)?> đ</p>
                                    <?php endif;?>
                                    
                                </div>
                            </div> 
                        <?php endforeach;?> 
                  
                  

               </div>
            </div>
   </div>
   </div>
   

</div>
