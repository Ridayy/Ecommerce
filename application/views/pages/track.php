<?php require APPPATH.'views/inc/header.php' ; ?>
<?php require APPPATH.'views/inc/navbar.php' ; ?>

<section class="py-3 mt-4 checkout_section">
    <div class="container">
       
        
        <h3>Track Your Order</h3>
        <div class="bottom-line"></div>
        <br>
        <p>
         <strong>To track your order, please enter your order ID in the box below and press the "track" button. This information was given to you after the confirmation of your order.</strong>
         <br><br>
        </p>
        <form action="<?= base_url().'pages/track' ?>" method="POST" id="track_form">
            <div class="form-group">
                
                <input type="text" name="order_id" placeholder="Your Order Number*" autocomplete="off" required class="form-control <?php echo (!empty(form_error('order_id'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('order_id'); ?>">
                <span class="invalid-feedback"><?php echo form_error('order_id'); ?></span>
            </div>
            <div class="form-group">
                <input type="button" class="btn ml-auto d-block" value="Track Now" id="track_btn"/>
            </div>
       </form>
       <div id="loading" class="d-none">
           <center>
              <img src="<?= base_url().'assets/img/loading.gif'; ?>" alt="Loading.." style="width:50px;height:50px">
           </center>
      </div>   
      <?php if(isset($status)): ?>
        <ol class="progress-tracker">
            <?php if($status == 'pending'):?>
                <li class="step active"><a href="#" class="step-name">Placed</a></li>
                <li class="step "><a href="#" class="step-name">Confirmed</a></li>
                <li class="step"><a href="#" class="step-name">Rider on the way</a></li>
                <li class="step"><span class="step-name">Completed</span></li>

            <?php elseif($status == 'confirmed'): ?>
                <li class="step completed"><a href="#" class="step-name">Placed</a></li>
                <li class="step completed"><a href="#" class="step-name">Confirmed</a></li>
                <li class="step active"><a href="#" class="step-name">Rider on the way</a></li>
                <li class="step"><span class="step-name">Completed</span></li>
            <?php else: ?>
                <li class="step completed"><a href="#" class="step-name">Placed</a></li>
                <li class="step completed"><a href="#" class="step-name">Confirmed</a></li>
                <li class="step completed"><a href="#" class="step-name">Rider on the way</a></li>
                <li class="step completed"><span class="step-name">Completed</span></li> 
            <?php endif; ?>
           
        </ol>
      <?php endif; ?>
    </div>
    <br>
    <center><a href="<?php echo base_url().'pages/shop'; ?>" class="cat-btn m-3 px-4">Shop Now</a></center>
    <br><br>
  </section>

  <script> 
        $('#track_btn').click(function () {
            $("#loading").removeClass('d-none');
            $(".progress-tracker").hide();
          setTimeout(function() {
            $("#loading").addClass('d-none');
            $('#track_form').submit();
          }, 2000);
       });
   
  </script>

<?php require APPPATH.'views/inc/main-footer.php' ; ?>
<?php require APPPATH.'views/inc/footer.php' ; ?>

