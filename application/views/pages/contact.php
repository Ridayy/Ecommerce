<?php require APPPATH.'views/inc/header.php' ; ?>
<?php require APPPATH.'views/inc/navbar.php' ; ?>

<section class="py-3 mt-4">
    <div class="container">
      <div class="row" id="contact_rows">
        <div class="col-md-4 contact_area">
          <div class="card p-4">
            <div class="card-body">
              <h5>Get In Touch</h5>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, odio!</p>
              <h5>Address</h5>
              <p>GBS</p>
              <h5>Email</h5>
              <p>test@test.com</p>
              <h5>Phone</h5>
              <p>(555) 555-5555</p>
            </div>
          </div>
        </div>
        <div class="col-md-8 contact_area">
          <div class="card p-4">
            <form action="<?php echo base_url().'pages/contact'; ?>" method="POST">
                <div class="card-body">
                <h3 class="text-center">Please fill out this form to contact us</h3>
                <?php if($this->session->flashdata('success')){
                        echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>';
                }  
                ?>
                <?php if($this->session->flashdata('failure')){
                        echo '<div class="alert alert-danger">'.$this->session->flashdata('failure').'</div>';
                }  
                ?>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Your Name*" required class="form-control <?php echo (!empty(form_error('name'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('name'); ?>">
                        <span class="invalid-feedback"><?php echo form_error('name'); ?></span>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="email" name="email"  placeholder="Email*" required class="form-control <?php echo (!empty(form_error('email'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('email'); ?>">
                            <span class="invalid-feedback"><?php echo form_error('email'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="subject"  placeholder="Subject*" required class="form-control <?php echo (!empty(form_error('subject'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('subject'); ?>">
                            <span class="invalid-feedback"><?php echo form_error('subject'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                         <input type="text" name="mobile"  placeholder="Mobile*" required class="form-control <?php echo (!empty(form_error('mobile'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('mobile'); ?>">
                        <span class="invalid-feedback"><?php echo form_error('mobile'); ?></span>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <textarea name="message"  placeholder="Message*" required class="form-control <?php echo (!empty(form_error('message'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('message'); ?>"></textarea>
                        <span class="invalid-feedback"><?php echo form_error('message'); ?></span>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-block" name="message_submit">
                    </div>
                    </div>
                </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <center><a href="<?php echo base_url().'pages/shop'; ?>" class="cat-btn m-3 px-4">Shop Now</a></center>
  </section>

<?php require APPPATH.'views/inc/main-footer.php' ; ?>
<?php require APPPATH.'views/inc/footer.php' ; ?>

