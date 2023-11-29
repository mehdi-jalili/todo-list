<?php
/*
* Display the Tasks in a neat table
*/
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<?php

global $wpdb;
$valid = true;
$SQL = "SELECT * FROM " . $wpdb->prefix . "todolist";
$formData = $wpdb->get_results($SQL);


// Check for database errors
if ($wpdb->last_error) {
    $error_message = $wpdb->last_error;
    // Display or log the error message as desired
    echo "Database Error: " . $error_message;
}

?>

    <div class="container">
        <div class="row d-flex justify-content-center ">
            <div class="col-sm-12 col-md-9 col-lg-10">
                <h1 class="text-center mt-5">To-do List Admin Panel</h1>

                <form action="" method="post">
                    <input type="hidden" name="listaction" value="insert" />
                    <button type="submit" class="btn btn-primary">Add New Task</button>
                </form>


                <table class="table table-bordered table-hover mt-4">
                    <tr class="info text-center">
                        <th class="font-weight-bold col-2">Title</th>
                        <th class="col-4">Description</th>
                        <th class="col-2">Created at</th>
                        <th class="col-2">Updated at</th>
                        <th class="col-2">Actions</th>
                    </tr>

                    <?php

                    if($valid){
                        foreach($wpdb->get_results($SQL) as $key => $row) {
                            $id = $row->id;
                            $title = $row->title;
                            $description = $row->description;
                            $created_at = $row->created_at;
                            $updated_at	= $row->updated_at;
                        ?>
                        <tr>
                            <form action="" method="post">
                                <input type="hidden" name="listaction" value="edit" />
                                <input type="hidden" name="taskid" value="<?php echo $id; ?>" />
                                <td class="col-2 text-center"><?php echo $title; ?></td>
                                <td class="text-wrap col-4"><?php echo $description; ?></td>
                                <td class="col-2 text-center"><?php echo $created_at; ?></td>
                                <td class="col-2 text-center"><?php echo $updated_at; ?></td>
                                <td class="col-2 text-center">
                                    <button type="submit" class="col-4 btn btn-primary bi bi-pencil-fill"></button>
                                </td>
                            </form>
                        </tr>                    
                        
                        <?php
                        }
                    } else { ?>
                    <?php

                        $valid = false;
                        $wpdb->show_errors();
                    
                    ?>
                        </table>
                    <?php
                        echo '<p class="text-center m-5">This Form Is Empty And or Invalid</p>';
                    }
                    
                    ?>
            </div>
        </div>

        
    </div>












