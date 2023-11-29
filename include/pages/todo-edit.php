<?php
/*
* Display the Edit form
*/
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<?php

global $wpdb;
$valid = true;
$SQL = "SELECT * FROM " . $wpdb->prefix . "todolist WHERE id=$id";
$row = $wpdb->get_row($SQL);
$title = $row->title;
$description = $row->description;

?>

<div class="container col-6 d-flex justify-content-center mt-5">
    <div class="col-12 d-flex flex-column justify-content-center">
                
        <div class="card card-primary">
            <div class="card-heading">
                <h3 class="card-title text-center m-3">
                    Edit Task
                </h3>
            </div>
                
            <div class="card-body">
                <form action="" method="post">
                    <input type="hidden" name="taskid" value="<?php echo $id; ?>">
                    <div class="form-group">
                                
                        <label for="frmTitle" class="col-12 control-label mt-4">Title: <?php echo $title; ?></label>
                            <div class="col-12">
                                <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
                            </div>

                        <label for="frmDescription" class="col-12 control-label mt-4">Description</label>
                            <div class="col-12">
                                <textarea type="text" class="form-control" name="description" value="<?php echo $description; ?>"><?php echo $description; ?></textarea>
                            </div>

                        <div class="col-12 col-sm-offset-4 mt-4">
                            <button type="submit" name="listaction" value="handleupdate" class="btn btn-success">update</button>
                            <button type="submit" name="listaction" value="list" class="btn btn-warning">Cancel</button>
                            <button type="submit" name="listaction" value="handledelete" class="btn btn-danger"
                                onclick="return confirm('Are you sure to delete this task?')">Delete
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>        
</div>