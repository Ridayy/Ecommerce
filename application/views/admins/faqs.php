<?php require APPPATH.'views/inc/admin_header.php' ; ?>

        
<!-- Admin content here  -->


<ol class="breadcrumb">
    <li class="breadcrumb-item">
    <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">FAQS</li>
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
      <button type="button" class="btn btn-primary mb-3 mx-1" data-toggle="modal" data-target="#question_modal">
      Add Question <i class="fas fa-plus"></i>
     </button>  
</div>

<div class="card mb-3 admin_products">
          <div class="card-header">
            <i class="fas fa-table"></i>
              Questions
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Action</th>
                  </tr>
                </thead>
                 
                <tbody>
                <?php $i = 1; ?>
                <?php foreach ($questions as $question): ?>
                    <tr> 
                        <td><?= $i ?></td>
                       
                        <td class="text-dark-primary"><?= $question['title'] ?></td>
                        <td><?= $question['answer'] ?></td>
                        <?php $id = $question['id']; ?>
                        <td class="actions">
                            <button class="btn btn-primary btn-sm edit_question" id="<?php echo $id; ?>">
                                 Edit
                            </button>
                            <a href="#" class="btn btn-danger btn-sm" onclick="deleteQuestion('<?php echo $id; ?>')">Delete</a>
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


<div class="modal fade" id="question_modal" tabindex="-1" role="dialog" aria-labelledby="question_label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="question_label">Add Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(). 'faqs/add'; ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="question_title" placeholder="Enter Question" required name="question_title"><br>
            <textarea class="form-control" id="question_answer" placeholder="Enter Answer" required name="question_answer" rows="5"></textarea>
            <input type="hidden" name="question_id" id="question_id">
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
  $("#question_title").css('font-weight', 'bold');
  $(document).on('click', '.edit_question', function(){
       var id = $(this).attr("id");
       $.ajax({
           url: "<?php echo base_url().'faqs/get_question/'; ?>" + id,
           type:"GET",
           dataType: "json",
           success: function(data){
                $("#question_label").text("Edit Question");
                $("#question_title").val(data.title);
                $("#question_answer").val(data.answer);
                $("#question_id").val(id);
                $("#modal_btn").html("Edit <i class='fas fa-pencil-alt'></i>");
                $("#question_modal").modal('show');
           }
       });
    });

    $('#question_modal').on('hidden.bs.modal', function(){
        $("#question_label").text("Add Question");
        $("#question_title").val("");
        $("#question_answer").val("");
        $("#question_id").val("");
        $("#modal_btn").html("Add <i class='fas fa-plus'></i>");
               
    });
});

function deleteQuestion(id){
    bootbox.confirm('Are you sure that you want to delete this Question?', function(result){
      
        if(result){
           let url = "<?php echo base_url(). 'faqs/delete/'?>"+ id;
           window.location.href= url;
        }
    });
}


</script>
        
<?php require APPPATH.'views/inc/admin_footer.php' ; ?>
  
