<?php require APPPATH.'views/inc/admin_header.php' ; ?>

        
<!-- Admin content here  -->


<ol class="breadcrumb">
    <li class="breadcrumb-item">
    <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Products</li>
</ol>


<?php if($this->session->flashdata('edit_success')){
          echo '<div class="alert alert-success">'.$this->session->flashdata('edit_success').'</div>';
      }  
?>

<?php if($this->session->flashdata('delete_success')){
          echo '<div class="alert alert-success">'.$this->session->flashdata('delete_success').'</div>';
    }  
?>

<?php if($this->session->flashdata('delete_failure')){
          echo '<div class="alert alert-failure">'.$this->session->flashdata('delete_failure').'</div>';
      }  
?>

<?php if($this->session->flashdata('add_success')){
          echo '<div class="alert alert-success">'.$this->session->flashdata('add_success').'</div>';
      }  
?>

<div class="d-flex justify-content-between">
      <a href=""></a>
      <a href="<?php echo base_url(). 'products/create'; ?>" class="btn btn-primary mb-3 mx-1">
        Add Product <i class="fas fa-plus"></i>
      </a>
</div>

<div class="card mb-3 admin_products">
          <div class="card-header">
            <i class="fas fa-table"></i>
              Products
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Thumbnail</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Brand</th>
                    <th>Discount</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                 
                <tbody>
                <?php $i = 1; ?>
                <?php foreach ($products as $product): ?>
                    <tr> 
                        <td><?= $i ?></td>
                        <td>
                       <center> 
                         <img src="<?= base_url().$product['product_image']; ?>" alt="thumbnail" class="img-thumbnail" width="50" height="50">
                        </center>
                        </td>
                        <td class="text-dark-primary"><?= $product['product_description']; ?></td>
                        <td><?= $product['cat_name']; ?></td>
                        <td><?= $product['product_price']; ?></td>
                        <td><?= $product['brand']; ?></td>
                        <td><?= $product['discount']; ?></td>
                        <td><?= $product['quantity']; ?></td>
                        <td class="actions">
                            <a href="<?=base_url().'products/edit/'.$product['id']; ?>" class="btn btn-primary btn-sm mb-1">
                            Edit
                            </a>
                            <?php $id = $product['id']; ?>
                            <a href="#" class="btn btn-danger btn-sm" onclick="deleteProduct('<?php echo $id; ?>')">Delete</a>
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

function deleteProduct(id){
    bootbox.confirm('Are you sure that you want to delete this product?', function(result){
      
        if(result){
           let url = "<?php echo base_url(). 'products/delete/'?>"+ id;
           window.location.href= url;
        }
    });
}


</script>
        
<?php require APPPATH.'views/inc/admin_footer.php' ; ?>
  
