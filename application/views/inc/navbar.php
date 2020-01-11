<nav id="navigation">
        <h1 class="logo">
        <span class="text-primary">
          <i class="fas fa-mountain"></i>The</span>Mountain
        </h1>
        <ul>
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><a href="<?php echo base_url(); ?>pages/shop">Shop</a></li>
            <li><a href="<?php echo base_url(); ?>pages/contact">Contact</a></li>
            <li><a href="<?php echo base_url(); ?>pages/new">New</a></li>
            <li><a href="<?php echo base_url(); ?>pages/faqs">FAQS</a></li>
            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="<?php echo base_url(); ?>pages/checkout">Checkout</a></li>
            <?php endif; ?>
        </ul>

        <ul>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <li><a href="<?php echo base_url(); ?>auth/login">Sign In</a></li>
                <li><a href="<?php echo base_url(); ?>auth/register">Sign Up</a></li>
                <li><a href="#">Search</a></li>
            <?php else: ?>
                <li id="cart">
                    <a href="<?php echo base_url(); ?>pages/checkout">
                        <i class="fas fa-shopping-cart"></i>
                        <span>
                        <?php echo (isset($_SESSION['total_quantity']) && !empty($_SESSION['total_quantity'])) ? array_sum($_SESSION['total_quantity']) : '0' ?>
                        </span>
                    </a>
                </li>
                <li><a href="#">Search</a></li>
                <li><a href="<?php echo base_url(); ?>pages/track">Track Order</a></li>
                <li><a href="<?php echo base_url(); ?>auth/logout">Logout</a></li>
            <?php endif; ?>
           
        </ul>
</nav>