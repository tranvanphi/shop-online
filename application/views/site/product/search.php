<div class="row">
    <?php $this->load->view('site/message');?>
   <div class="col-sm-4 col-lg-3 hidden-xs">
   
      <div class="list-catalog">
         <div class="header-catalog">
            <h2><i class="fa fa-bars"></i> Danh mục</h2>
         </div>
         <div class="content-catalog">
            <ul>
            <?php //pre($catalogList,false);?>
                <?php foreach($catalogList as $r =>  $row):?>
                <li class="catalog-parent"><a href="<?php echo base_url('product/catalog/').$row->id;?>"><p><?php echo $row->name;?></p></a>
                <?php if(!empty($row->subs)):?>
                  <div class="catalog-child">
                     <ul class="catalog-sub"> 
                        <?php foreach($row->subs as $row => $sub):?>
                         <li><a href="<?php echo base_url('product/catalog/').$sub->id;?>" title="<?php echo $sub->name?>"><?php echo $sub->name?></a></li>
                         <?php endforeach;?>              
                     </ul>
                    
                     <img class="img-background" src="<?php echo PUBLIC_URL('site')?>img/bg_danhmuc_<?php echo $r;?>.png">
                     
                  </div>
                <?php endif;?>
                </li>
               
                <?php endforeach;?>
            </ul>
         </div>

      </div>

   </div>
   <div class="col-sm-8 col-lg-9">
      <div class="content">
      <?php //pre($search,false)?>
         <div class="panel panel-default panel-default-custom">
            <div class="panel-heading">
               <h3 class="panel-title">Kết quả "<?php echo $search?>"</h3>
            </div>
            <div class="panel-body">
               <div class="row">
                <?php foreach($productList as $row):?>
                            <?php 
                                $image = json_decode($row->image_list);
                                $arrayKeys = array_keys($image);
                                $img = $image[$arrayKeys[0]];
                            ?>
                  <div class="col-md-3 col-sm-4 col-xs-6">

                     <div class="thumbnail thumbnail-custom1">
                        <img src="<?php echo base_url('uploads/product/').$img?>" alt="<?php echo $row->name?>">
                        <p class="view">lượt xem: <?php echo $row->view?></p>
                        <div class="btn-buy">
                            <!-- <a href="<?php //echo base_url('product/view/').$row->id;?>" class="btn btn-default btn-buy-custom">Mua hàng</a><br> -->
                            <a href="<?php echo base_url('product/view/').$row->id;?>" class="btn btn-default btn-detalt-custom">Chi tiết</a>

                        </div>
                        
                        <div class="caption">
                        <a href="<?php echo base_url('product/view/').$row->id;?>">
                            <h3><?php echo $row->name?></h3>
                            <?php if($row->discount > 0):?>
                            <?php $priceNew = $row->price - $row->discount;?>
                                <p class="price">Giá mới: <?php echo number_format($priceNew)?> đ</p>
                                <p class="price-old">Giá cũ: <?php echo number_format($row->price)?> đ</p>

                            <?php else:?>
                                <p class="price">Giá: <?php echo number_format($row->price)?> đ</p>
                            <?php endif;?>
                        </a>  
                        </div>
                     </div>
                  </div>

                <?php endforeach;?> 
                <div class="clear"></div>
                <nav class="text-center">
                    <?php echo $pagination_cre?>
                </nav>

               </div>
            </div>
         </div>
      </div>
   </div>
</div>