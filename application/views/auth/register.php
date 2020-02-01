<?php require APPPATH . 'views/inc/header.php'; ?>
<?php require APPPATH . 'views/inc/navbar.php'; ?>

  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body bg-light my-4">
        <h2>Create An Account</h2>
        <p>Please fill out this form to register with us</p>
        <form action="<?php echo base_url(); ?>auth/register" method="post">
          <div class="form-group">
            <label for="name">Name: <sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty(form_error('name'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('name'); ?>">
            <span class="invalid-feedback"><?php echo form_error('name'); ?></span>
          </div>
          <div class="form-group">
            <label for="email">Email: <sup>*</sup></label>
            <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty(form_error('email'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('email'); ?>">
            <span class="invalid-feedback"><?php echo form_error('email'); ?></span>
          </div>
          <div class="form-group">
            <label for="password">Password: <sup>*</sup></label>
            <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty(form_error('password'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('password'); ?>">
            <span class="invalid-feedback"><?php echo form_error('password'); ?></span>
          </div>
          <div class="form-group">
            <label for="confirm_password">Confirm Password: <sup>*</sup></label>
            <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty(form_error('confirm_password'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('confirm_password'); ?>">
            <span class="invalid-feedback"><?php echo form_error('confirm_password'); ?></span>
          </div>

          <div class="row">
            <div class="col">
              <input type="submit" value="Register" class="btn btn-success btn-block">
            </div>
            <div class="col">
              <a href="<?php echo base_url(); ?>auth/login" class="btn btn-light btn-block">Have an account? Login</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php require APPPATH . 'views/inc/main-footer.php'; ?>
<?php require APPPATH.'views/inc/footer.php' ; ?>
