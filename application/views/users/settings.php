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
                   
                    <li >
                        <a href="<?= base_url().'users/addresses'; ?>">My Addresses</a>
                    </li>
                    <li class="active">
                        <a href="<?= base_url().'users/settings'; ?>">Settings</a>
                    </li>
                </ul>
            </div>
            <div class="ml-3 card p-3" id="desc">
            <?php if($this->session->flashdata('success')){
                        echo '<div class="alert alert-success text-center">'.$this->session->flashdata('success').'</div>';
                } 
            ?> 
               <h3>Settings</h3>
            <div class="bottom-line"></div>
                <form action="<?= base_url().'users/settings'; ?>" method="POST">
                <div class="d-flex align-items-center">
                    <div>
                        <img src="<?= base_url(). $profile_pic; ?>" alt="Image">
                        <br><br>
                         <a class="btn w-100" href="<?= base_url(). 'users/upload'; ?>">
                             Upload
                         </a>
                    </div>
                    <div class="ml-4 w-100">
                    <br>
                    
                    <div class="card">
                        <div class="card-header">
                        <strong>Email</strong>
                        </div>
                        
                        <div class="card-body">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-sm" id="old_email" required name="old_email"  autocomplete="off" disabled value="<?= $email; ?>">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                            <input type="email" class="form-control form-control-sm <?php echo (!empty(form_error('new_email'))) ? 'is-invalid' : ''; ?>" id="new_email" placeholder="New Email*" required name="new_email"  autocomplete="off">
                                <span class="invalid-feedback"><?php echo form_error('new_email'); ?></span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header">
                        <strong>Password</strong>
                        </div>
                        
                        <div class="card-body">
                            <div class="form-group">
                                <input type="password" class="form-control form-control-sm <?php echo (!empty(form_error('old_password'))) ? 'is-invalid' : ''; ?>" id="old_password" placeholder="Old Password*" required name="old_password"  autocomplete="old-password">
                                <span class="invalid-feedback"><?php echo form_error('old_password'); ?></span>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-sm" id="new_password" placeholder="New Password*" required name="new_password"  autocomplete="new-password">
                                <span class="invalid-feedback"><?php echo form_error('new_password'); ?></span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="submit" class="btn" value="Update"> 
      
                    </div>
                </div>
                </form>
            </div>
        </div>
        </div>
   </div>
</section>
<br><br><b></b>


<?php require APPPATH.'views/inc/main-footer.php' ; ?>
<?php require APPPATH.'views/inc/footer.php' ; ?>