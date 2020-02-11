<nav id="navigation">
        <h1 class="logo">
        <span class="text-primary">
          <i class="fas fa-mountain"></i>The</span>Mountain
        </h1>
        <ul id="main_menu">
            <li><a href="<?php echo base_url(); ?>" id="home"><i class="fas fa-home"></i> &nbsp;Home</a></li>
            <li><a href="<?php echo base_url(); ?>pages/shop" id="shop"><i class="fas fa-shopping-basket"></i> &nbsp;Shop</a></li>
            <li><a href="<?php echo base_url(); ?>pages/contact" id="contact"><i class="fas fa-envelope-open"></i> &nbsp;Contact</a></li>
            <li><a href="<?php echo base_url(); ?>pages/new" id="new"><i class="fas fa-user"></i> &nbsp;What's New</a></li>
            <li><a href="<?php echo base_url(); ?>pages/faqs" id="faqs"><i class="fas fa-question"></i> &nbsp;FAQS</a></li>
           
        </ul>

        <ul> 
            <li id="search_bar">
                <form action="#" method="GET">
                <input type="text" name="q" id="search_text_input" placeholder="Search for products..." onkeyup="getLiveSearchProducts(this.value, '<?php echo base_url(); ?>')" autocomplete="off">
                <button type="button" id="search_button"><i class="fas fa-search"></i></button>
                </form>
                <div class="search_results"></div>
               
            </li>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <li><a href="<?php echo base_url(); ?>auth/login"><i class="fas fa-user"></i> &nbsp; Join Us</a></li>
               
            <?php else: ?>
                <li id="cart">
                    <a href="<?php echo base_url(); ?>pages/checkout">
                        <i class="fas fa-shopping-cart"></i>
                        <span>
                        <?php echo (isset($_SESSION['total_quantity']) && !empty($_SESSION['total_quantity'])) ? array_sum($_SESSION['total_quantity']) : '0' ?>
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle ml-2" href="#" id="navbardrop" data-toggle="dropdown">
                    My Account
                </a>
                <div class="dropdown-menu">
                    <a class=" dropdown-item" href="<?php echo base_url(); ?>pages/checkout"><i class="fas fa-credit-card"></i> &nbsp;Checkout</a>
                    <a class=" dropdown-item" href="<?php echo base_url(); ?>users/show"><i class="fas fa-id-badge"></i> &nbsp;&nbsp;&nbsp;My Profile </a>
                    <a  class=" dropdown-item" href="<?php echo base_url(); ?>pages/track"><i class="fas fa-truck"></i> &nbsp;Track Order</a>
                    
                    <a class=" dropdown-item" href="<?php echo base_url(); ?>auth/logout"><i class="fas fa-sign-out-alt"></i>&nbsp; Logout</a>
                </div>
                </li>
            <?php endif; ?>
           
        </ul>
</nav>

<!-- <div id="search_bar">

    <center>
       
    </center>
           
</div> -->