</div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url(). 'admins/logout'; ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>


  

<!-- The Modal -->
<div class="modal fade" id="settingsModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Admin Settings</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      
      <form action="<?php echo base_url(). 'admins/change'; ?>" method="POST" id="settings_form">
      
        <p class="text-center text-dark-primary mt-2 mb-0">
          <em>Change Your Email Or Password</em>
        </p>
          <div class="alert alert-success mx-2 mt-2 d-none">
            Settings updated successfully
          </div>
        <div class="modal-body">
        <div class="card">
          <div class="card-header">
           <strong>Email</strong>
          </div>
          <div class="card-body">
            <div class="form-group">
                <input type="email" class="form-control form-control-sm" id="old_email" placeholder="Old Email*" disabled value="<?= $_SESSION['admin'] ;?>" name="old_email" autocomplete="off">
              </div>
              <div class="form-group">
                <input type="email" class="form-control form-control-sm" id="new_email" placeholder="New Email*" required name="new_email" autocomplete="off" >
                <span class="invalid-feedback"><?php echo form_error('product_brand'); ?></span>
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
                <input type="password" class="form-control form-control-sm" id="old_password" placeholder="Old Password*" required name="old_password"  autocomplete="new-password">
                <span class="invalid-feedback"></span>
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-sm" id="new_password" placeholder="New Password*" required name="new_password"  autocomplete="new-password">
                <span class="invalid-feedback"></span>
              </div>
          </div>
        </div>
      
        <div id="loading" class="d-none">
           <center>
              <img src="<?= base_url().'assets/img/loading.gif'; ?>" alt="Loading.." style="width:50px;height:50px">
           </center>
        </div>    
        </div>
      

      <!-- Modal footer -->
      <div class="modal-footer">
        <button class="btn btn-primary">Change</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

      </form>

    </div>
  </div>
</div>

  <script>

    $('#settings_form').submit(function (evt) {
        evt.preventDefault();

        var form = $(this);
        var newEmail = $("[name='new_email']").val();

        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').text('');

        $("#loading").removeClass('d-none');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url().'admins/change'; ?>",
            data: form.serialize(),
            success: function(data){

               setTimeout(() => {
                 if(data == ''){
                   $('.alert-success').removeClass('d-none');
                   setTimeout(function() {
                      $(".alert-success").hide();
                  }, 3000);
                  $("[name='old_email']").val(newEmail);
                  $("[name='new_email']").val('');
                  $("[name='old_password']").val('');
                  $("[name='new_password']").val('');

                 }else {
                   var errors = JSON.parse(data);
                   if(errors['new_email']){
                     $("[name='new_email']").addClass('is-invalid');
                     $("[name='new_email']").next().text(errors['new_email']);
                   }

                   if(errors['old_password']){
                     $("[name='old_password']").addClass('is-invalid');
                     $("[name='old_password']").next().text(errors['old_password']);
                   }

                   if(errors['new_password']){
                     $("[name='new_password']").addClass('is-invalid');
                     $("[name='new_password']").next().text(errors['new_password']);
                   }

                 }
                 $("#loading").addClass('d-none');
               }, 2000);
            }
          
       });
    });


  </script>
  <!-- Bootstrap core JavaScript-->
  
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>assets/js/sb-admin.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/custom_admin.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.js"></script>

  <!-- Demo scripts for this page-->
  <script src="<?php echo base_url(); ?>assets/js/demo/datatables-demo.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/demo/chart-area-demo.js"></script>
 

</body>

</html>