<?php require APPPATH.'views/inc/admin_header.php' ; ?>

        
<!-- Admin content here  -->


<ol class="breadcrumb">
    <li class="breadcrumb-item">
    <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Products</li>
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
      <button type="button" class="btn btn-primary mb-3 mx-1" data-toggle="modal" data-target="#category_modal">
      Add Category <i class="fas fa-plus"></i>
     </button>  
</div>

<div class="card mb-3 admin_products">
          <div class="card-header">
            <i class="fas fa-table"></i>
              Categories
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                 
                <tbody>
                <?php $i = 1; ?>
                <?php foreach ($categories as $category): ?>
                    <tr> 
                        <td><?= $i ?></td>
                       
                        <td class="text-dark-primary"><?= $category['cat_name'] ?></td>
                        <?php $id = $category['cat_id']; ?>
                        <td class="actions">
                            <button class="btn btn-primary btn-sm edit_cat" id="<?php echo $id; ?>">
                                 Edit
                            </button>
                            <a href="#" class="btn btn-danger btn-sm" onclick="deleteCategory('<?php echo $id; ?>')">Delete</a>
                        </td>
                    <?php $i++; ?>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
             </table>
        </div>
        </div>
     <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>


<div class="modal fade" id="category_modal" tabindex="-1" role="dialog" aria-labelledby="cat_label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="cat_label">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(). 'categories/add'; ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="cat_name" placeholder="Enter Category Name" required name="cat_name">
            <input type="hidden" name="cat_id" id="cat_id">
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
  $(document).on('click', '.edit_cat', function(){
       var cat_id = $(this).attr("id");
       $.ajax({
           url: "<?php echo base_url().'categories/get_category/'; ?>" + cat_id,
           type:"GET",
           dataType: "json",
           success: function(data){
                $("#cat_label").text("Edit Category");
                $("#cat_name").val(data.cat_name);
                $("#cat_id").val(cat_id);
                $("#modal_btn").html("Edit <i class='fas fa-pencil-alt'></i>");
                $("#category_modal").modal('show');
           }
       });
  });

    $('#category_modal').on('hidden.bs.modal', function(){
        $("#cat_label").text("Add Category");
        $("#cat_name").val("");
        $("#cat_id").val("");
        $("#modal_btn").html("Add <i class='fas fa-plus'></i>");
               
    });
});

function deleteCategory(id){
    bootbox.confirm('Are you sure that you want to delete this Category?', function(result){
      
        if(result){
           let url = "<?php echo base_url(). 'categories/delete/'?>"+ id;
           window.location.href= url;
        }
    });
}


</script>
        
<?php require APPPATH.'views/inc/admin_footer.php' ; ?>
  
