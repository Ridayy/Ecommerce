<?php require APPPATH.'views/inc/admin_header.php' ; ?>

        
<!-- Admin content here  -->


            




        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Products</li>
        </ol>

        <div class="items mt-4">
              <?php foreach ($products as $product): ?>
                    <!--  -->
                    <div class="item <?php echo $product['cat_class']; ?>" data-category="<?php echo $product['cat_class']; ?>">
                       <div onclick=window.location.href='<?php echo base_url().'products/show/'.$product['id']; ?>'>
                        <div class="item-image">
                                <img src="<?php echo base_url().$product['product_image']; ?>" alt="">
                            </div>
                            <div class="item-description">
                                <p><?php echo ucfirst($product['product_description']); ?></p>
                                <?php if($product['discount'] != 0): ?>
                                    <span class="price">Rs. <del> <?php echo($product['product_price']); ?></del></span>
                                    <small class='gray-text'>-<?php echo $product['discount']; ?>% </small>
                                    <span class="price"><?php echo($product['product_price'] - $product['product_price']* ($product['discount']/100)); ?></span>
                                <?php else: ?>
                                    <span class="price">Rs. <?php echo($product['product_price']); ?></span>
                                <?php endif; ?>
                            </div>
                       </div>
                        <div class="icons">
                            <a href="<?php echo base_url().$product['product_image']; ?>" title="View Product" class="buy_button" data-fancybox data-caption="<?php echo ucfirst($product['product_description']); ?>"> 
                                <i class="fas fa-eye"></i>
                            </a>
                            <!-- Inner one -->

                            <a href="<?php echo base_url().'cart/add/'.$product['id'] ?>" target="_blank" class="cart_button">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
						</div>
                        <div class="d-none">
                            <p class="price"><?php echo $product['product_price']; ?></p>
                            <p class="date"><?php echo $product['created_at']; ?></p>
                            <p class="discount"><?php echo $product['discount']; ?></p>
                        </div>
                        <div class="overlay" onclick=window.location.href='<?php echo base_url().'products/show/'.$product['id'];?>'>
                        </div>
                    </div>
                <?php endforeach; ?>
         </div>

        
        
        
            

      
        <?php require APPPATH.'views/inc/admin_footer.php' ; ?>
  
