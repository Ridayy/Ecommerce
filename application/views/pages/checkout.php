<?php require APPPATH.'views/inc/header.php' ; ?>
<?php require APPPATH.'views/inc/navbar.php' ; ?>

<section class="py-3 mt-4 checkout_section">
    <div class="container">
       
        <?php if($this->session->flashdata('checkout_msg')){
            $value = $this->session->flashdata('checkout_msg');
            echo "<script>
                    $(document).ready(function(){
                        bootbox.alert('$value');
                    });
                 </script>";
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
                  <?php if(isset($_SESSION['products']) && !empty($_SESSION['products'])){
                           $total = 0;
                           foreach($_SESSION['products'] as $product){  
                            $product['product_price'] = $product['product_price'] - ($product['product_price']*$product['discount']/100);
                            $subtotal = $_SESSION['product_'.$product['id']]*$product['product_price'];
                            $total+= $subtotal;
                        ?>
                        <tr>
                            <th scope="row"><?php echo $product['product_description']; ?></th>
                            <td>Rs. <?php echo $product['product_price']; ?></td>
                            <td><?php echo $_SESSION['product_'.$product['id']]; ?></td>
                            <td><?php echo $subtotal ; ?></td>
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
                    <?php 
                        } 
                    }

                        else { ?>
                        <tr>
                            <td colspan="5">
                                <span class="text-center d-block"><small>Cart empty at the moment</small></span>
                            </td>
                        </tr>
                    <?php } ?>
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
                        <td><?php echo (isset($_SESSION['total_quantity']) && !empty($_SESSION['total_quantity'])) ? array_sum($_SESSION['total_quantity']) : 0 ?> </td>
                    </tr>
                    <tr>
                        <th scope="row">Shipping and Handling</th>
                        <td>Free Shipping</td>
                    </tr>
                    <tr>
                        <th scope="row">Order Total</th>
                        <td><?php echo isset($total) ? 'Rs. '.$total : 0; ?></td>
                    </tr>
                </tbody>
                 </table>
            </div>
        </div>
    </div>
    <br>
    <center><a href="<?php echo base_url().'pages/shop'; ?>" class="cat-btn m-3 px-4">Shop Now</a></center>
    <br><br>
  </section>

<?php require APPPATH.'views/inc/main-footer.php' ; ?>
<?php require APPPATH.'views/inc/footer.php' ; ?>

