<?php require APPPATH.'views/inc/header.php' ; ?>
<?php require APPPATH.'views/inc/navbar.php' ; ?>


    <div id="myCarousel" class="carousel slide new_carousel mb-5" data-ride="carousel">
      <ol class="carousel-indicators">
       <?php if(!empty($slides)): ?>
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <?php for($i = 1;$i< $num_slides; $i++): ?>
        <li data-target="#myCarousel" data-slide-to="<?= $i;?>"></li>
        <?php endfor; ?>
       <?php else: ?>
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="2" class="active"></li>
       <?php endif; ?>
      </ol>
      <div class="carousel-inner slider_text">
        <?php if(isset($slides) && !empty($slides)): ?>
          <?php $i = 1; ?>
            <?php foreach($slides as $slide): ?>
             <?php if($i == 1): ?>
              <div class="carousel-item carousel-image-<?= $i; ?> active" style="background-image: url('<?= base_url().$slide['slide_img'] ?>');">
              <div class="container">
                <div class="carousel-caption d-none d-sm-block text-right mb-5">
                  <h1 class="display-3" style="text-shadow:2px 2px #000;">
                    Enjoy The Latest Arrivals
                  </h1>
                  <p class="lead" style="text-shadow:2px 2px #000">
                    <?= $slide['slide_title']; ?>
                  </p>
                  <a href="#" class="btn btn-success btn-lg">Learn More</a>
                </div>
              </div>
            </div>
             <?php else: ?>
              <div class="carousel-item carousel-image-<?= $i; ?>" style="background-image: url('<?= base_url().$slide['slide_img'] ?>');">
              <div class="container">
                <div class="carousel-caption d-none d-sm-block text-right mb-5">
                  <h1 class="display-3" style="text-shadow:2px 2px #000">
                    Your Satisfaction , Our Success
                  </h1>
                  <p class="lead" style="text-shadow:2px 2px #000">
                    <?= $slide['slide_title']; ?>
                  </p>
                  <a href="#" class="btn btn-success btn-lg">Learn More</a>
                </div>
              </div>
            </div>
             <?php endif; ?>
            <?php $i++; ?>
            <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <a href="#myCarousel" data-slide="prev" class="carousel-control-prev">
        <span class="carousel-control-prev-icon"></span>
      </a>

      <a href="#myCarousel" data-slide="next" class="carousel-control-next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>

<section class="m-4 new_arrival"> 
    <div class="info text-center">
        <h3>Enjoy the latest arrivals</h3>
        <div class="bottom-line"></div><br><br>
    </div>

<div class="container">
    <?php if(!empty($products)): ?>
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
      <?php else: ?>
        <p class="text-center result"><strong>No results available. <span>&#9785;</span></strong></p>
      <?php endif; ?>
    </div>
     
   </div>
</section>

<center>
    <a href="<?php echo base_url().'pages/shop'; ?>" class="cat-btn">Shop Now</a>
</center>
<br><br>

<?php require APPPATH.'views/inc/main-footer.php' ; ?>
<?php require APPPATH.'views/inc/footer.php' ; ?>

