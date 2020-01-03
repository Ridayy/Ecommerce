<?php require APPPATH.'views/inc/header.php' ; ?>
<?php require APPPATH.'views/inc/navbar.php' ; ?>

<section class="py-3 mt-4 payment_section">
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
        <div class="col-md-7 contact_area">
          <div class="card p-4">
           
                <div class="card-body">
                <h3 class="text-center">Product Order Form</h3>
                <div class="card p-1 my-3">
                    <p class="text-center payment_msg">
                        Hello <?= $_SESSION['user_name']; ?>, Please fill in your details correctly to avoid any inconvenience
                    </p>
                </div>
                <hr>
                <form action="<?php echo base_url().'pages/payment'; ?>" method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="phone"  placeholder="Phone*" required class="form-control <?php echo (!empty(form_error('phone'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('phone'); ?>">
                            <span class="invalid-feedback"><?php echo form_error('phone'); ?></span>
                        </div>
                        <div class="form-group">
                            <textarea name="address"  placeholder="Shipping Address*" required class="form-control <?php echo (!empty(form_error('address'))) ? 'is-invalid' : ''; ?>" ><?php echo set_value('address'); ?></textarea>
                            <span class="invalid-feedback"><?php echo form_error('address'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="city"  placeholder="City*" required class="form-control <?php echo (!empty(form_error('city'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('city'); ?>">
                                <span class="invalid-feedback"><?php echo form_error('city'); ?></span>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="state"  placeholder="State/Province*" required class="form-control <?php echo (!empty(form_error('state'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('state'); ?>">
                                <span class="invalid-feedback"><?php echo form_error('state'); ?></span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-block" name="payment_submit">
                    </div>
                    </div>
                </div>
                </form>
                </div>
          
          </div>
        </div>
      </div>
    </div>
    <center><a href="<?php echo base_url().'pages/shop'; ?>" class="cat-btn m-3 px-4">Shop Now</a></center>
  </section>

<?php require APPPATH.'views/inc/main-footer.php' ; ?>
<?php require APPPATH.'views/inc/footer.php' ; ?>

