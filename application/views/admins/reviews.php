<?php require APPPATH.'views/inc/admin_header.php' ; ?>

        
<!-- Admin content here  -->


<ol class="breadcrumb">
    <li class="breadcrumb-item">
    <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Reviews</li>
</ol>


<?php if($this->session->flashdata('success')){
          echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>';
      }  
?>

<?php if($this->session->flashdata('failure')){
          echo '<div class="alert alert-failure">'.$this->session->flashdata('failure').'</div>';
    }  
?>



<div class="card mb-3 admin_products">
          <div class="card-header">
            <i class="fas fa-table"></i>
              Reviews
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Product</th>
                    <th>Review</th>
                    <th>Rating</th>
                    <th>User</th>
                    <th>Posted At</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                 
                <tbody>
                <?php $i = 1; ?>
                <?php foreach ($reviews as $review): ?>
                    <tr> 
                        <td><?= $i ?></td>
                        <td>
                       <center> 
                         <img src="<?= base_url().$review['product_image']; ?>" alt="thumbnail" class="img-thumbnail" width="50" height="50">
                        </center>
                        </td>
                        <td class="text-dark-primary"><?= $review['review_text']; ?></td>
                        <td><?= $review['rating']; ?></td>
                        <td><?= $review['email']; ?></td>
                        <td><?= $review['review_posted_at']; ?></td>
                       
                        <td class="actions">
                            <?php $id = $review['review_id']; ?>
                            <a href="#" class="btn btn-danger btn-sm" onclick="deleteReview('<?php echo $id; ?>')">Delete</a>
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

<script>

$(document).ready(function(){
  console.log('loaded');
});

function deleteReview(id){
    bootbox.confirm('Are you sure that you want to delete this review?', function(result){
      
        if(result){
           let url = "<?php echo base_url(). 'reviews/delete/'?>"+ id;
           window.location.href= url;
        }
    });
}


</script>
        
<?php require APPPATH.'views/inc/admin_footer.php' ; ?>
  
