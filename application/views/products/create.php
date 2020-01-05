<?php require APPPATH.'views/inc/admin_header.php' ; ?>

        
<!-- Admin content here  -->

<ol class="breadcrumb">
    <li class="breadcrumb-item">
    <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Add Product</li>
</ol>

<div class="container create_edit_product">
    <form action="<?php echo base_url().'products/create'; ?>"  method="POST" enctype="multipart/form-data">
        <div class="row p-3">
            <div class="col-md-4">
                <img src="<?= base_url(). 'assets/img/icons/upload_default.png'; ?>" alt="product image" id="product_img">
                <center>
                <label class="custom-file-upload">
                    <input type="file" onchange="readURL(this);" name="file_to_upload"/>
                    Upload
                </label>
                <input type="hidden" name="create_form" value="true">
                <?php echo form_error('file_to_upload'); ?>
                </center>
            </div>
            <div class="col-md-8 ">
                <div class="card p-3">
                        <div class="form-group">
                            <input type="text" name="product_desc" class="form-control  <?php echo (!empty(form_error('product_desc'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('product_desc'); ?>" placeholder="Product Description (Short)*" required>
                            <span class="invalid-feedback"><?php echo form_error('product_desc'); ?></span>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="category" required>
                                <option value="" disabled selected>Select Category</option>
                                <?php foreach($categories as $category): ?>
                                    <?php if($category['cat_id'] == set_value('category')): ?>
                                        <option value="<?= $category['cat_id']; ?>" selected>
                                            <?= $category['cat_name']; ?>
                                        </option>
                                    <?php else: ?>
                                        <option value="<?= $category['cat_id']; ?>" >
                                            <?= $category['cat_name']; ?>
                                        </option>
                                     <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="product_brand" class="form-control <?php echo (!empty(form_error('product_brand'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('product_brand'); ?>" placeholder="Brand*" required>
                            <span class="invalid-feedback"><?php echo form_error('product_brand'); ?></span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="number" name="product_price" class="form-control <?php echo (!empty(form_error('product_price'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('product_price'); ?>" placeholder="Price*" required>
                                    <span class="invalid-feedback"><?php echo form_error('product_price'); ?></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="number" name="product_discount" class="form-control  <?php echo (!empty(form_error('product_discount'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('product_discount'); ?>" placeholder="Discount*" required>
                                    <span class="invalid-feedback"><?php echo form_error('product_discount'); ?></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                
                                    <input type="number" name="product_quantity" class="form-control  <?php echo (!empty(form_error('product_quantity'))) ? 'is-invalid' : ''; ?>" value="<?php echo set_value('product_quantity'); ?>" placeholder="Quantity*" required>
                                    <span class="invalid-feedback"><?php echo form_error('product_quantity'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="product_desc_detailed" required class="form-control  <?php echo (!empty(form_error('product_desc_detailed'))) ? 'is-invalid' : ''; ?>" placeholder="Product Description (Detailed)*" rows="4"><?php echo set_value('product_desc_detailed'); ?></textarea>
                            <span class="invalid-feedback"><?php echo form_error('product_desc_detail'); ?></span>
                        </div>
                        <div class="form-group">
                            <center>
                                <input type="submit" value="Create" class="btn btn-primary w-25 font-weight-bold" name="">
                            </center>
                        </div>
                </div>
            </div>
        </div>
    </form>
</div>
          

        
        
<?php require APPPATH.'views/inc/admin_footer.php' ; ?>
  
