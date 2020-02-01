<?php require APPPATH.'views/inc/admin_header.php' ; ?>

        
<!-- Admin content here  -->

 
<ol class="breadcrumb">
    <li class="breadcrumb-item">
    <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Slides</li>
</ol>


<?php if($this->session->flashdata('success')){
          echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>';
      }  
?>

<?php if($this->session->flashdata('failure')){
          echo '<div class="alert alert-danger">'.$this->session->flashdata('failure').'</div>';
    }  
?>

<div class="d-flex justify-content-between">
      <a href=""></a>
      <button type="button" class="btn btn-primary mb-3 mx-1" data-toggle="modal" data-target="#slides_modal">
      Add Slide <i class="fas fa-plus"></i>
     </button>  
</div>

<div class="card mb-3 admin_slides">
          <div class="card-header">
            <i class="fas fa-table"></i>
             Slides
          </div>
          <div class="card-body">
            <h3>Slides Available</h3>
            <div class="bottom-line"></div>
            <div class="d-flex available_slides flex-wrap">
             <?php foreach($slides as $slide): ?>
                <div>
                  <div class="slides_img">
                    <img src=" <?= base_url().$slide['slide_img']; ?>" alt="">
                  </div>
                  <div class="overlay-slide">
                   <div>
                      <button class="btn btn-primary edit_slide mb-2" id="<?php echo $slide['id']; ?>">
                            Edit Title
                      </button> 
                      <?php if($slide['location'] == "home"): ?>
                        <a href="<?= base_url().'admins/remove_from_page/'.$slide['id'];?>" class="btn btn-danger mb-2">Remove From Home</a>
                      <?php elseif($slide['location'] == "shop"): ?>
                        <a href="<?= base_url().'admins/remove_from_page/'.$slide['id'];?>" class="btn btn-danger mb-2">Remove From Shop</a>
                      <?php else: ?>
                        <a href="<?= base_url().'admins/add_to_home/'.$slide['id'];?>" class="btn btn-primary mb-2">Add To Home Page</a>
                        <a href="<?= base_url().'admins/add_to_shop/'.$slide['id'];?>" class="btn btn-primary mb-2">Add To Shop Page</a>
                      <?php endif; ?>
                      <?php if($slide['mandatory'] == 0): ?>
                      <a href="<?= base_url().'admins/remove/'.$slide['id'];?>" class="btn btn-danger mb-2">Delete</a>
                      <?php endif; ?>
                      
                   </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
        </div>
     
</div>


<div class="modal fade" id="slide_modal" tabindex="-1" role="dialog" aria-labelledby="edit_label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="cat_label">Edit Slide Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(). 'admins/edit_title'; ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="edit_title" placeholder="Enter Slide Title" required name="edit_title" >
            <input type="hidden" name="slide_id" id="slide_id">
          </div>
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button type="submit" class="btn btn-primary w-25" id="modal_btn">Edit <i class="fas fa-pencil"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>







<div class="modal fade" id="slides_modal" tabindex="-1" role="dialog" aria-labelledby="slide_label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="slide_label">Add Slide</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(). 'admins/add_slide'; ?>" method="POST" id="slides_form" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="slide_title" placeholder="Enter Slide Title*" required name="slide_title">
            <span class="invalid-feedback"></span>
            <br>
            
                <center>
                <img src="<?= base_url(). 'assets/img/icons/upload_default.png'; ?>" alt="slide image" id="slide_img">
                
                <label class="custom-file-upload">
                    <input type="file" onchange="readURLSlide(this);" name="file_to_upload"/>
                    Upload
                </label><br>
                <span id="img_err"></span>
                <br>
               
                </center>
                <div id="loading" class="d-none">
                    <center>
                        <img src="<?= base_url().'assets/img/loading.gif'; ?>" alt="Loading.." style="width:50px;height:50px">
                    </center>
               </div>
          </div>
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button type="submit" class="btn btn-primary w-25" id="modal_btn">Add <i class="fas fa-plus"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>

$(document).ready(function(){
  $(document).on('click', '.edit_slide', function(){
       var slide_id = $(this).attr("id");
       $.ajax({
           url: "<?php echo base_url().'admins/get_slide/'; ?>" + slide_id,
           type:"GET",
           dataType: "json",
           success: function(data){
                $("#edit_title").val(data.slide_title);
                $("#slide_id").val(slide_id);
                $("#slide_modal").modal('show');
           }
       });
  });

    $('#slide_modal').on('hidden.bs.modal', function(){
      $("#edit_title").val("");   
      $("#slide_id").val("");           
    });
});

$('#slides_form').submit(function (evt) {
        evt.preventDefault();

       
        var formData = new FormData(this);       

        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').text('');
        $('.custom-invalid').text('');
        $('.custom-invalid').removeClass('custom-invalid');

        $("#loading").removeClass('d-none');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url().'admins/add_slide'; ?>",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            
            success: function(data){
              
               setTimeout(() => {
                 if(data == ''){
                    $('#slides_modal').modal('hide');
                    location.reload();

                 }else {
                  
                   var errors = JSON.parse(data);
                   if(errors['file_to_upload']){
                     $("#img_err").text(errors['file_to_upload']);
                     $("#img_err").addClass('custom-invalid');
                   }

                   if(errors['slide_title']){
                     $("[name='slide_title']").addClass('is-invalid');
                     $("[name='slide_title']").next().text(errors['slide_title']);
                   }

                   console.log(errors);
                

                 }
                 $("#loading").addClass('d-none');
               }, 2000);
            }
          
       });
    });



</script>
        
<?php require APPPATH.'views/inc/admin_footer.php' ; ?>
  
