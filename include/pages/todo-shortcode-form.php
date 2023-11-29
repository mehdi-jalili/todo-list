<?php
/*
* Display the Tasks in a neat table
*/
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<?php

global $wpdb;
$valid = true;
$SQL = "SELECT * FROM " . $wpdb->prefix . "todolist";
$formData = $wpdb->get_results($SQL);

?>


<div class="container">
    <div class="row d-flex justify-content-center ">
        <div class="col-sm-12 col-md-9 col-lg-10">
            <h1 class="text-center mt-5">Tasks</h1>
            <table class="table table-bordered table-hover mt-4">
                <tr class="info text-center">
                    <th class="col-2 text-center">Title</th>
                    <th class="col-6">Description</th>
                    <th class="col-2">Created at</th>
                    <th class="col-2">Updated at</th>
                </tr>

                <?php
                if($valid){
                    foreach($wpdb->get_results($SQL) as $key => $row) {
                        $title = $row->title;
                        $description = $row->description;
                        $created_at = $row->created_at;
                        $updated_at = $row->updated_at;
                    ?>
                    <tr>
                        <td class="col-2 text-center"><?php echo $title; ?></td>
                        <td class="text-wrap col-6"><?php echo $description; ?></td>
                        <td class="col-2 text-center"><?php echo $created_at; ?></td>
                        <td class="col-2 text-center"><?php echo $updated_at; ?></td>
                    </tr>                    
                    
                    <?php
                    }
                } else {
                    echo '<p class="text-center m-5">to-do list Is Empty</p>';
                }
                ?>
            </table>
            <?php ?>
        </div>
    </div>    
</div>

