<?php require APPPATH.'views/inc/header.php' ; ?>
<?php require APPPATH.'views/inc/navbar.php' ; ?>

<section class="py-3 mt-4 checkout_section">
    <div class="container">
       
        <?php if($this->session->flashdata('success')){
            echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>';
        }  
        ?>
        <?php if($this->session->flashdata('failure')){
             echo '<div class="alert alert-danger">'.$this->session->flashdata('failure').'</div>';
        }  
        ?>
       
        <div class="row">
            <div class="col-md-8 mr-4">
            <h3>Checkout</h3>
            <div class="bottom-line"></div>
            <table class="table mt-3 cart_products">
                <thead>
                    <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Sub-total</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                   <?php foreach($_SESSION['products'] as $product): ?>
                        <tr>
                            <th scope="row"><?php echo $product['product_description']; ?></th>
                            <td>Rs. <?php echo $product['product_price']; ?></td>
                            <td>3</td>
                            <td>2</td>
                            <td>
                                <a href="<?php echo base_url().'cart/add/'.$product['id']; ?>">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </a>
                                <a href="<?php echo base_url().'cart/remove/'.$product['id']; ?>">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                </a>
                                <a href="<?php echo base_url().'cart/delete/'.$product['id']; ?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                   <?php endforeach; ?>
                </tbody>
          </table>
            </div>
            <div class="col-md-3">
            <h3>Cart Totals</h3>
            <div class="bottom-line"></div>
              <table class="table mt-3 border">
                <tbody>
                    <tr>
                        <th scope="row">Items: </th>
                        <td>4</td>
                    </tr>
                    <tr>
                        <th scope="row">Shipping and Handling</th>
                        <td>Rs. 2300</td>
                    </tr>
                    <tr>
                        <th scope="row">Order Total</th>
                        <td>Rs. 4000</td>
                    </tr>
                </tbody>
                 </table>
            </div>
        </div>
    </div>
    <br>
    <center><a href="<?php echo base_url().'/pages/shop'; ?>" class="cat-btn m-3 px-4">Shop Now</a></center>
    <br><br>
  </section>

<?php require APPPATH.'views/inc/main-footer.php' ; ?>
<?php require APPPATH.'views/inc/footer.php' ; ?>

