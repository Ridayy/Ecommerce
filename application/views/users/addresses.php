<?php require APPPATH.'views/inc/header.php' ; ?>
<?php require APPPATH.'views/inc/navbar.php' ; ?>


<section id="user_dashboard" >
   <div class="container">
        <div class="d-flex align-items-center">
            <div id="user_options">
                <ul>
                    <li >
                       <a href="<?= base_url().'users/show'; ?>">My Profile</a>
                    </li>
                    <li >
                        <a href="<?= base_url().'users/orders'; ?>">My Orders</a>
                    </li>
                   
                    <li class="active">
                        <a href="<?= base_url().'users/addresses'; ?>">My Addresses</a>
                    </li>
                    <li>
                        <a href="<?= base_url().'users/settings'; ?>">Settings</a>
                    </li>
                </ul>
            </div>
            <div class="ml-3 card p-3" id="desc">
                     <h3>Your Addresses</h3>
                    <div class="bottom-line"></div>
                    <br>
                <div class="d-flex align-items-center w-100">
                  <div class="w-100" id="user_orders">
                     <?php foreach($orders as $order): ?>
                     <div class="card p-3">
                         <?= $order['address']; ?>
                     </div>
                     <br>
                     <?php endforeach; ?>
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