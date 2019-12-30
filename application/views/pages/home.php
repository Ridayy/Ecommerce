<?php require APPPATH.'views/inc/header.php' ; ?>

<body id="home">
  
    <div class="loader">
		<div class="inner"></div>
	</div>

	<div id="slides">
		<div class="overlay"></div>
		<div class="slides-container">
		    <img src="assets/img/slide1.jpeg" alt="">
		    <img src="assets/img/slide2.jpeg" alt="">
		    <img src="assets/img/slide3.jpeg" alt="">
		</div>
		<div class="titleMessage">
			<div class="heading">
				<p class="main">The Mountain</p>
				<p class="sub typed"></p>
			</div>
		</div>
		<nav class="slides-navigation">
		    <a href="#" class="next"></a>
		    <a href="#" class="prev"></a>
		</nav>
    </div>
    
    <?php require APPPATH.'views/inc/navbar.php' ; ?>

    <section>
        <div class="container p-1">
            <p class="lead text-center">New artists, new designs, new body styles. It’s all right here! </p>
            <div class="bottom-line"></div>
            


            <!-- Show products here -->
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

        </div>
    </section>
  
    <script src="<?php echo base_url().'/assets/js/home.js'?>"></script>
    
    <?php require APPPATH . 'views/inc/main-footer.php'; ?>
    <?php require APPPATH.'views/inc/footer.php' ; ?>