<?php require APPPATH.'views/inc/header.php' ; ?>
<?php require APPPATH.'views/inc/navbar.php' ; ?>

<section class="mt-5">
   <div class="container">
       
        <div class="row">
             <div class="col-md-8 mx-auto d-flex">
                 <div class="w-50 product_image mr-3">
                     <img src="<?php echo base_url().$product['product_image']; ?>" alt="">
                 </div>
                 <div class="w-50 card p-1">
                     <div class="card-body">
                         <span class="product_description d-flex align-items-center">
                             <span><?php echo $product['product_description']; ?></span>
                             <div class='product_cat ml-2'>
                                <?php echo $product['cat_name']; ?>
                             </div>
                        </span>
                         <span class="gray-text">Brand: 
                            <span class="text-primary"> <strong><?php echo $product['brand']; ?></strong></span>
                        </span>
                        <hr>
                         <div class="card-text">
                           <div class="ratings text-primary">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                4.0 stars
                           </div>
                        
                            <?php if($product['discount'] == 0): ?>
                                <h4 class="text-primary mt-3">Rs. <?php echo($product['product_price']); ?></h4>
                            <?php else: ?>
                                <h4 class="text-primary mt-3">Rs. <?php echo($product['product_price'] - $product['product_price']* ($product['discount']/100)); ?></h4>
                                <span class='gray-text'>Rs. <del> <?php echo($product['product_price']); ?></del></span>
                                <small>-<?php echo $product['discount']; ?>% </small>
                            <?php endif; ?>
                            <br><br>
                            <a href="<?php echo base_url().'cart/add/'.$product['id'] ?>" class="cat-btn">Add To Cart</a>
                            <a href="#" class="cat-btn">Buy Now</a>
                         </div>
                     </div>
                 </div>    
             </div>
        </div>

        <hr>

        <ul id="review-nav" class="nav nav-tabs mt-4" role="tablist">
	
            <li class="nav-item">
            <a class="nav-link active" href="#desc" id="home-tab" role="tab" data-toggle="tab" aria-controls="desc" aria-expanded="true">Description</a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="#reviews" role="tab" id="reviews-tab" data-toggle="tab" aria-controls="reviews">Reviews</a>
            </li>
            </ul>

            <!-- Content Panel -->
            <div id="clothing reviews-nav-content" class="tab-content">

            <div role="tabpanel" class="tab-pane fade show active" id="desc" aria-labelledby="desc-tab">
                <h4 class='mt-4'>Some description of product</h4>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nulla quia deserunt vel, natus dignissimos sint? Veniam, velit! Nisi, saepe fugit.
                </p>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="reviews" aria-labelledby="reviews-tab">
                <h4 class='mt-4'>Reviews</h4>
                <p>
                   This product has no reviews yet
                </p>
            </div>

           

            </div>
    </div>
</section>
<br>
<br>
<br>
<br>

<?php require APPPATH.'views/inc/main-footer.php' ; ?>
<?php require APPPATH.'views/inc/footer.php' ; ?>

