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
        </div>

    
        <!-- <div id="sorts" class="button-group">  
            <button class="cat-btn is-checked" data-sort-by="original-order">Original order</button>
            <button class="cat-btn" data-sort-by="title">Title</button>
            <button class="cat-btn" data-sort-by="date">Date</button>
            <button class="cat-btn" data-sort-by="category">Category</button>
        </div>

      -->
        <div class="items">
              <?php foreach ($products as $product): ?>
                    <div class="item <?php echo $product['cat_class']; ?>" data-category="<?php echo $product['cat_class']; ?>">
                        <div class="item-image">
                            <img src="<?php echo base_url().$product['product_image']; ?>" alt="">
                        </div>
                        <div class="item-description">
                            <p><?php echo ucfirst($product['product_description']); ?></p>
                            <?php if($product['discount'] != 0): ?>
                                <span class="price">Rs. <strike> <?php echo($product['product_price']); ?></strike></span>
                                <small class='gray-text'>-<?php echo $product['discount']; ?>% </small>
                                <span class="price"><?php echo($product['product_price'] - $product['product_price']* ($product['discount']/100)); ?></span>
                            <?php else: ?>
                                <span class="price">Rs. <?php echo($product['product_price']); ?></span>
                            <?php endif; ?>
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

