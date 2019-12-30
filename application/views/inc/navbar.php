<nav id="navigation">
        <h1 class="logo">
        <span class="text-primary">
          <i class="fas fa-mountain"></i>The</span>Mountain
        </h1>
        <ul>
            <li><a href="<?php echo base_url(); ?>" class="sel">Home</a></li>
            <li><a href="<?php echo base_url(); ?>pages/shop">Shop</a></li>
            <li><a href="<?php echo base_url(); ?>pages/contact">Contact</a></li>
            <li><a href="<?php echo base_url(); ?>pages/new">New</a></li>
            <li><a href="<?php echo base_url(); ?>pages/faqs">FAQS</a></li>
            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="#">Checkout</a></li>
            <?php endif; ?>
        </ul>

        <ul>
            <li><a href="#">Search</a></li>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <li><a href="<?php echo base_url(); ?>auth/login">Sign In</a></li>
                <li><a href="<?php echo base_url(); ?>auth/register">Sign Up</a></li>
            <?php else: ?>
                <li><a href="<?php echo base_url(); ?>auth/logout">Logout</a></li>
            <?php endif; ?>
           
        </ul>
</nav>