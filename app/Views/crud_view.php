<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>Codeigniter Ajax</title>
<style>
    .jumbotron {
        background-color: #d3d3d3;
    }
    tr td a {
        margin-left: 5px;
    }
</style>
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <h3 class="text-center">AJAX CRUD app with Codeigniter 4 and Bootstrap</h3>
        </div>
            <div class="card">
                <div class="card-header">
                    <div style="display: inline-block;">View Data</div>
                    <!-- Button to Open the Modal -->
                    <div style="display: inline-block;" class="offset-10" >
                    <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#myModal">
                        Add Data
                    </button>
                    <span class="text text-success" id="message"></span>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-light table-bordered table-hover" id="sample_table">
                        <thead class="thead-light">
                            <tr>
                                <th>S. No</th>
                                <th>Name</th>
                                <th colspan="2">Email address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Alpha</td>
                                <td colspan="2">alpha@gmail.com</td>
                                <td colspan="1"><a class="btn btn-outline-secondary">Edit</a>
                                <a class="btn btn-outline-danger">Delete</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Data</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="" method="post" class="form" id="user_form">
            <div class="form-group">
                <label for="name">Enter your name</label>
                <input id="name" class="form-control" type="text" name="name" autocomplete="off" placeholder="E.g. Muhammad Umair">
                <span id="name_error" class="text text-danger"></span>
            </div>
            <div class="form-group">
                <label for="email">Enter your email</label>
                <input id="email" class="form-control" type="text" name="email" autocomplete="off" placeholder="E.g. umair@gmail.com">
                <span id="email_error" class="text text-danger"></span>
            </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <input type="hidden" name="hidden_id" id="hidden_id">
        <input type="hidden" name="action" id="action" value="Add">
        <input type="submit" name="submit" id="submit_button" class="btn btn-outline-success" value="Add">
        
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('#add_record').click(function() {
            $('#user_form')[0].reset();
            $('.modal-title').text('Add Data');
            $('#name_error').text('');
            $('#email_error').text('');
            $('#action').val('Add');    
            $('#submit_button').val('Add');
            $('#myModal').modal('show');
        });
        $('#user_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: "<?php echo base_url('/CrudController/action'); ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend:funcion(){
                    $('#submit_button').val('wait....');
                    $('#submit_button').attr('disabled', 'disabled')
                },
                success:function(data){
                    $('#submit_button').val('Add');
                    $('#submit_button').attr('disabled', flase);

                    if(data.error == 'yes') {
                        $('$name_error').text(data.name_error);
                        $('$email_error').text(data.email_error);
                    } else {
                        $('#myModal').modal('hide');
                        $('#message').html(data.message);
                        $('#sample_table').DataTable().ajax.reload();
                        setTimeout(function(){
                            $('#message').html('');
                        }, 5000);
                    }
                }
            })
        });
    });
</script>
</body>
</html>