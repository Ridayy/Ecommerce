<?php require APPPATH.'views/inc/header.php' ; ?>
<?php require APPPATH.'views/inc/navbar.php' ; ?>

<section class="mt-5">
   <div class="container">
      <?php if($this->session->flashdata('buy_fail')){
            $value = $this->session->flashdata('buy_fail');
            echo "<script>
                    $(document).ready(function(){
                        bootbox.alert('$value');
                    });
                 </script>";
        } 
        ?>
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
                            <a href="<?php echo base_url().'cart/buy/'.$product['id'] ?>" class="cat-btn">Buy Now</a>
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

           
            <div id="clothing reviews-nav-content" class="tab-content">

            <div role="tabpanel" class="tab-pane fade show active" id="desc" aria-labelledby="desc-tab">
                <h4 class='mt-4'>Some description of product</h4>
                <p>
                    <?= $product['product_desc_detailed']; ?>
                </p>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="reviews" aria-labelledby="reviews-tab">
               
                <div class="d-flex user_reviews mt-3">
                    <div class="card text-center p-3">
                        <h5>Overall Customer Satisfaction</h5>
                        <span class="review_num"><span class="review_calc"><?= $average_rating['rating']; ?></span> / 5</span>
                        <small>based on <?= $num_reviews['num_reviews']; ?> review(s)</small>
                        <br>
                        <div class="p-3">
                            <span class="check_icon"> <i class="fas fa-check"></i> </span> 100% Verified Feedback & Reviews From Customers
                        </div>
                    </div>
                    <div class="card p-3">
                        <div class="card-header">
                            <?= $num_reviews['num_reviews']; ?> Review(s)
                        </div>
                        <div class="ratings text-primary mt-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="gray-text"><?= $five_stars['five_stars']; ?> Review(s)</span>
                        </div>

                        <div class="ratings text-primary mt-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <span class="gray-text"><?= $four_stars['four_stars']; ?> Review(s)</span>
                        </div>

                        <div class="ratings text-primary mt-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <span class="gray-text"><?= $three_stars['three_stars']; ?> Review(s)</span>
                        </div>

                        <div class="ratings text-primary mt-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <span class="gray-text"><?= $two_stars['two_stars']; ?> Review(s)</span>
                        </div>

                        <div class="ratings text-primary mt-2">
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <span class="gray-text"><?= $one_stars['one_stars']; ?> Review(s)</span>
                        </div>
                    </div>
                   <?php if(isset($_SESSION['user_id'])): ?>
                       <div class="text-center rate_post">
                        <button class="btn d-block ml-auto " data-toggle="modal" data-target="#exampleModal">Rate this product &nbsp; <i class="fas fa-star"></i></button>
                        <br>
                         </div>
                   <?php endif; ?>
                </div>

                <div class="card p-3 mt-2">
                   
                    <?php foreach($reviews as $review): ?>
                     

                        <div class="user_desc d-flex align-items-center">
                        <div class="user_profile mr-3">
                            <img src="<?= base_url().'assets/img/profile_pics/defaults/image_1.png'; ?>" alt="">
                        </div>
                        <div class="user_details">
                            <span class="name"><?= $review['name']; ?></span>
                            <div class="ratings text-primary">
                                    <?php for ($i=1; $i <= 5; $i++) { 
                                        if($i <= $review['rating']){
                                            echo '<i class="fas fa-star"></i>';
                                        }else {
                                            echo '<i class="far fa-star"></i>';
                                        }
                                    }
                                    ?>
                                    
                                    
                                    <span class="gray-text"><?= $review['rating']; ?>/5</span>
                            </div>
                        </div>
                        
                       </div>

                         <div class="reviews_main mt-1">
                            "<?= $review['review_text']; ?>"
                        </div>
                        <br>
                        <small class="gray-text m-0">Date published: <?= $review['review_posted_at']; ?></small>
                        <br><br>


                    <?php endforeach; ?>
             
                </div>
            </div>

           

            </div>
    </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"           aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered submit_ratings" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="margin: 0 auto;">How was your buying experience?</h5>
            
            </button>
        </div>  
         <form action="<?php echo base_url().'reviews/add'; ?>" method="POST" id="review_form">
            <div class="modal-body text-center">
                <p>We appreciate your feedback. It helps us to improve  &#128512; </p>
               <center>
                 <button type="button" class="star_button text-primary" id="1"><i class="far fa-star fa-2x"></i></button>
                 <button type="button" class="star_button text-primary" id="2"><i class="far fa-star fa-2x"></i></button>
                 <button type="button" class="star_button text-primary" id="3"><i class="far fa-star fa-2x"></i></button>
                 <button type="button" class="star_button text-primary" id="4"><i class="far fa-star fa-2x"></i></button>
                 <button type="button" class="star_button text-primary" id="5"><i class="far fa-star fa-2x"></i></button>
               </center>
                <input type="hidden" name="rating" value="0">
                <span class="invalid-feedback"></span>
                <textarea name="review_area" id="" class="form-control mt-4" rows="3" placeholder="Leave a review about this product for others too see! *"></textarea>
                <span class="invalid-feedback"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
         </form>
        </div>
    </div>
</div>
</section>
<br>
<br>
<br>
<br>

<script>

 
    var productid = "<?php echo $product['id']; ?>";

    $(document).ready(function(){

       

        let rating = 0
        $(".star_button").click(function(e){
           
            $(this).html('<i class="fas fa-star fa-2x"></i>');
            $(this).prevAll().html('<i class="fas fa-star fa-2x"></i>');
            $(this).nextAll().html('<i class="far fa-star fa-2x"></i>');
        
            rating = $('.fas.fa-star.fa-2x').last().parent().attr('id');
            $("input[name='rating']").val(rating);
            
        });
    });

    $('#review_form').submit(function (evt) {
        evt.preventDefault();

        var form = $(this);
        var rating = $("input[name='rating']").val();
        var review = $("[name='review_area']").val();
        // do rest of the code

        

        $.ajax({
            type: "POST",
            url: "<?php echo site_url().'reviews/add'; ?>",
            data: form.serialize() + "&productId=" + productid,
            success: function(data){

                if(data == ''){
                    
                    $('#exampleModal').modal('hide');
                   
                    setTimeout(() => {
                        bootbox.alert('Review Added Successfully. However, Admin deserves the right to remove it at anytime.');
                        setTimeout(() => {
                            location.reload();
                        }, 2500);
                    }, 1000);
                
                }else {
                    var errors = JSON.parse(data);
                    if(errors['review_area']){
                        $("[name='review_area']").addClass('is-invalid');
                        $("[name='review_area']").next().text(errors['review_area']);
                     }
                    
                     if(errors['rating']){
                        $("[name='rating']").addClass('is-invalid');
                        $("[name='rating']").next().text(errors['rating']);
                     }
                   
             }

                     
        }   
    });
});

</script>

<?php require APPPATH.'views/inc/main-footer.php' ; ?>
<?php require APPPATH.'views/inc/footer.php' ; ?>

