<?php require APPPATH.'views/inc/header.php' ; ?>
<?php require APPPATH.'views/inc/navbar.php' ; ?>

<section class="m-4">
   <div class="container">
      <div class="filter">
         <center>
            <ul id="filters">
            <a href="#" data-filter="*" class="current cat-btn outline-primary">ALL</a>
            <?php foreach ($categories as $category): ?>
               
                    <a class="cat-btn outline-primary" href="#" data-filter=".<?php echo $category['cat_class']; ?>">
                        <?php echo ucfirst($category['cat_name']); ?>
                    </a>
             
            <?php endforeach; ?>
            </ul>
          </center>
        </div>

    
        <div id="sorts" class="button-group">  
             <center>
                <button class="cat-btn is-checked" data-sort-by="original-order">Original</button>
                <button class="cat-btn" data-sort-by="price">Price</button>
                <button class="cat-btn" data-sort-by="date">Date</button>
                <button class="cat-btn" data-sort-by="discount">Discount</button>
                <button class="cat-btn" data-sort-by="category">Category</button>
            </center>
        </div>

     
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
         </center>
    </div>
     
   </div>
</section>

<?php require APPPATH.'views/inc/main-footer.php' ; ?>
<?php require APPPATH.'views/inc/footer.php' ; ?>

