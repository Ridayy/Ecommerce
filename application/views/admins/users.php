<?php require APPPATH.'views/inc/admin_header.php' ; ?>

        
<!-- Admin content here  -->


<ol class="breadcrumb">
    <li class="breadcrumb-item">
    <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Users</li>
</ol>


<?php if($this->session->flashdata('success')){
          echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>';
      }  
?>

<?php if($this->session->flashdata('failure')){
          echo '<div class="alert alert-danger">'.$this->session->flashdata('failure').'</div>';
    }  
?>



<div class="card mb-3 admin_products">
          <div class="card-header">
            <i class="fas fa-table"></i>
              Confirmed
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Num Orders</th>
                    <th>Joined At</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                 
                <tbody>
                <?php $i = 1; ?>
                <?php foreach ($users as $user): ?>
                    <tr> 
                        <td><?= $i ?></td>
                       
                        <td class="font-weight-bold"><?= $user['name']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td><?= $user['num_orders']; ?></td>
                        <td><?= $user['created_at']; ?></td>
                        <td class="actions">
                            <?php $id = $user['id']; ?>
                            <a href="#" class="btn btn-danger btn-sm" onclick="deleteUser('<?php echo $id; ?>')">Delete</a>
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

function deleteUser(id){
    bootbox.confirm('Are you sure that you want to delete this user?', function(result){
      
        if(result){
           let url = "<?php echo base_url(). 'users/delete/'?>"+ id;
           window.location.href= url;
        }
    });
}


</script>
        
<?php require APPPATH.'views/inc/admin_footer.php' ; ?>
  
