<?php require APPPATH.'views/inc/admin_header.php' ; ?>

        
<!-- Admin content here  -->



        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5"><?= $total_orders; ?> Orders So Far!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#ord">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-users"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5"><?= $total_products; ?> Products!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?= base_url(). 'admins/products'; ?>">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5"><?= $total_users; ?> Users!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?= base_url(). 'admins/users'; ?>">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5"><?= $total_categories; ?> Categories!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?= base_url(). 'admins/categories'; ?>">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>

        <!-- Area Chart Example-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Area Chart Example</div>
          <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

        <!-- DataTables Example -->
        <div class="card mb-3" id="ord">
          <div class="card-header">
            <i class="fas fa-table"></i>
            ALL ORDERS</div>
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
                       
                    <?php $i++; ?>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
             </table>
        </div>
        </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

      
        <?php require APPPATH.'views/inc/admin_footer.php' ; ?>
  
