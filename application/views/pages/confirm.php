<?php
    if($_SESSION['order_set']) {
        unset($_SESSION['order_set']);
    }else {
        redirect(base_url().'pages/shop');
        die();
    }

require APPPATH.'views/inc/header.php' ; 
require APPPATH.'views/inc/navbar.php' ; 

?>

<section class="py-3 mt-4 confirm_section">
    <div class="container text-center">
        
        <?php if($this->session->flashdata('email_success')): ?>
            <h3>Email Confirmation</h3>
            <div class="bottom-line"></div>
            <br>
            <div class="card p-2 text-dark-primary font-weight-bold">
                <div class="card-body">
                    <p>The confirmation email has been sent to 
                    <span class="text-dark">
                         <?= $this->session->flashdata('email_success'); ?>
                    </span>
                    </p> 
                    <p>Please confirm your order as soon as possible</p>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                We are Sorry, the confirmation email was not sent to <?= $this->session->flashdata('email_failure'); ?> 
            </div>
        <?php endif; ?>
        
       
        
    </div>
    <br>
    <center><a href="<?php echo base_url().'pages/shop'; ?>" class="cat-btn m-3 px-4">Go Back</a></center>
    <br><br>
  </section>

<?php require APPPATH.'views/inc/main-footer.php' ; ?>
<?php require APPPATH.'views/inc/footer.php' ; ?>

