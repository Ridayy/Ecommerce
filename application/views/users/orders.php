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
                    <li class="active">
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
                     <h3>Your Orders</h3>
                    <div class="bottom-line"></div>
                    <br>
                <div class="d-flex align-items-center w-100">
                  <div class="w-100" id="user_orders">
                  <?php foreach($orders as $order): ?> 
                    <div class="card p-3 w-100">
                        <h4 class="text-center">Order <?= $order['order_id']; ?></h4>
                        <div class="d-flex order_items">
                            <div class="card p-2">
                                <p class="text-primary">
                                   <strong>
                                        Amount:
                                        <br>
                                       <span class="value"><?= $order['amount']; ?></span>
                                   </strong> 
                                </p>
                               
                            </div>
                            <div class="card p-2">
                            <p class="text-primary">
                                   <strong>
                                        Status:
                                        <br>
                                       <span class="value"><?= ucfirst($order['status']); ?></span>
                                   </strong> 
                                </p>
                            </div>
                            <div class="card p-2">
                            <p class="text-primary">
                                   <strong>
                                       Order Date:
                                        <br>
                                       <span class="value"><?= date("Y-m-d", strtotime($order['ordered_at'])); ?></span>
                                   </strong> 
                                </p>
                            </div>
                            <div class="card p-2">
                            <p class="text-primary">
                                   <strong>
                                       Place Of Order:
                                        <br>
                                       <span class="value"><?= $order['city']; ?>, <?= $order['state']; ?></span>
                                   </strong> 
                                </p>
                            </div>
                        </div>
                    </div>
                    <br>
                   <?php endforeach; ?>
                  </div>
                </div>
            </div>
        </div>
   </div>
</section>
<br><br><b></b>


<?php require APPPATH.'views/inc/main-footer.php' ; ?>
<?php require APPPATH.'views/inc/footer.php' ; ?>