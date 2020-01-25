<?php require APPPATH.'views/inc/header.php' ; ?>
<?php require APPPATH.'views/inc/navbar.php' ; ?>


<section id="user_dashboard" >
   <div class="container">
        <div class="d-flex align-items-center">
            <div id="user_options">
                <ul>
                    <li class="active">
                       <a href="<?= base_url().'users/profile'; ?>">My Profile</a>
                    </li>
                    <li>
                        <a href="<?= base_url().'users/orders'; ?>">My Orders</a>
                    </li>
                   
                    <li>
                        <a href="<?= base_url().'users/addresses'; ?>">My Addresses</a>
                    </li>
                    <li>
                        <a href="<?= base_url().'users/settings'; ?>">Settings</a>
                    </li>
                </ul>
            </div>
            <div class="ml-3 card p-3" id="desc">
                     <h3>Your Details</h3>
                    <div class="bottom-line"></div>
                <div class="d-flex align-items-center">
                    <div>
                        <img src="<?= base_url(). $profile_pic; ?>" alt="Image">
                    </div>
                    <div class="ml-4 w-100">
                   
                    <br>
                    <div class="form-group">
                        <label for="name"><strong>Name</strong></label>
                        <input type="text" class="form-control w-100" id="name" value="<?= $name; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email"><strong>Email</strong></label>
                        <input type="email" class="form-control w-100" value="<?= $email; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="orders"><strong>Number Of Orders</strong></label>
                        <input type="number" class="form-control w-100" value="<?= $num_orders; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="date"><strong>Date of Account Creation</strong></label>
                        <input type="text" class="form-control w-100" value="<?= $created_at; ?>" disabled>
                    </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
</section>
<br><br><b></b>


<?php require APPPATH.'views/inc/main-footer.php' ; ?>
<?php require APPPATH.'views/inc/footer.php' ; ?>