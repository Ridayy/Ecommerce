<?php require APPPATH.'views/inc/admin_header.php' ; ?>

        
<!-- Admin content here  -->


<ol class="breadcrumb">
    <li class="breadcrumb-item">
    <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Orders</li>
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
              Pending
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Order Date</th>
                    <th>Ordered By</th>
                    <th>Phone</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                 
                <tbody>
                <?php $i = 1; ?>
                <?php foreach ($orders as $order): ?>
                    <tr> 
                        <td><?= $i ?></td>
                        <td>
                            <?= $order['ordered_at']; ?>
                        </td>
                        <td class="font-weight-bold"><?= $order['email']; ?></td>
                        <td><?= $order['phone']; ?></td>
                        <td>Rs. <?= $order['amount']; ?></td>
                        <td><?= $order['status']; ?></td>
                        <td><?= $order['city']; ?></td>
                        <td><?= $order['state']; ?></td>
                        <td class="actions">
                            <?php $id = $order['order_id']; ?>
                            <a href="#" class="btn btn-danger btn-sm" onclick="deleteOrder('<?php echo $id; ?>')">Delete</a>
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

function deleteOrder(id){
    bootbox.confirm('Are you sure that you want to delete this order?', function(result){
      
        if(result){
           let url = "<?php echo base_url(). 'orders/delete/'?>"+ id + '?page=completed';
           window.location.href= url;
        }
    });
}


</script>
        
<?php require APPPATH.'views/inc/admin_footer.php' ; ?>
  
