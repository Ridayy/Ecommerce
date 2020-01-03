<?php require APPPATH.'views/inc/header.php' ; ?>
<?php require APPPATH.'views/inc/navbar.php' ; ?>

<section class="py-3 mt-4 review_section">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <div class="card p-2">
            <div class="card-body">
              <h5>Your Order Summary</h5><br>
              <table class="table">
                <thead class="bg-dark">
                    <tr>
                    <th scope="col" class="text-white">Descriptions</th>
                    <th scope="col"  class="text-white">Amount</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(isset($_SESSION['products']) && !empty($_SESSION['products'])){
                         $total = 0;
                         foreach($_SESSION['products'] as $product){  
                                $product['product_price'] = $product['product_price'] - ($product['product_price']*$product['discount']/100);
                                $subtotal = $_SESSION['product_'.$product['id']]*$product['product_price'];
                                $total+= $subtotal;
                        ?>
                        <tr class="bg-light">
                            <th scope="row"><?php echo $product['product_description']; ?></th>
                            <th>Rs. <?php echo $subtotal; ?></th>
                        </tr>
                        <tr>
                            <td scope="row">Item Number: <?php echo $product['id']; ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td scope="row">Item Price: <?php echo $product['product_price']; ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td scope="row">Quantity: <?php echo  $_SESSION['product_'.$product['id']]; ?></td>
                            <td></td>
                        </tr>
                    <?php 
                        } ?>
                        <tr class="bg-light">
                            <th scope="row">Item Total: </th>
                            <th>Rs. <?php echo $total; ?></th>
                        </tr> 
                    
                  <?php } ?>
                    
 
                </tbody>
                </table>
            </div>
          </div>
        </div>
        <div class="col-md-7 details_area">
          <div class="card p-4">
            <div class="card-body">
                <h3 class="text-center">Review Your Information</h3>
                <div class="card p-1 my-3">
                    <p class="text-center payment_msg">
                        You are only one step away!
                    </p>
                </div>
               
                <div class="row">
                   <div class="col-md-12">
                        <p class="payment_msg">
                            Shipping address
                        </p>
                        <div class="card p-2">
                            <div class="w-50">
                                 <p><?= $address ?></p>
                                 <p><?= $city ?>, <?= $state ?></p>
                            </div> 
                        </div>
                        <p class="payment_msg">
                           Contact Information
                        </p>
                        <div class="card p-2">
                          <p><span class="text-dark-primary">Email:</span> &nbsp;<?= $_SESSION['user_email']; ?></p>
                          <p><span class="text-dark-primary">Phone:</span> &nbsp; <?= $phone; ?></p>
                        </div>
                        <p class="payment_msg">
                           Payment Method
                        </p>
                        <div class="card p-2">
                          <p>Cash on delivery</p>
                        </div>
                   </div>
                </div>
                </div>
                <center>
                    <form action="<?php echo base_url().'orders/place'; ?>" method="POST">
                        <input type="hidden" name="address" value="<?= $address; ?>">
                        <input type="hidden" name="city" value="<?= $city; ?>">
                        <input type="hidden" name="state" value="<?= $state; ?>">
                        <input type="hidden" name="phone" value="<?= $phone; ?>">
                        <input type="hidden" name="amount" value="<?= $total; ?>">
                        <input type="submit" value="Proceed" class="btn">
                    </form>
               </center>
          </div>
          
        </div>
      </div>
    </div>
   
  </section>

<?php require APPPATH.'views/inc/main-footer.php' ; ?>
<?php require APPPATH.'views/inc/footer.php' ; ?>

