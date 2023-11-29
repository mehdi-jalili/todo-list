<?php
/*
* Setup the todo admin menu to list all tasks
*/

add_action('admin_menu', 'todo_admin_men');

function todo_admin_men() {
    add_menu_page(
        'Todo',
        'Todo',
        'manage_options',
        'todo_list',
        'todo_list',
        'dashicons-groups'
    );

    add_submenu_page(
        'todo_list',
        'Add New Task',
        'Add New',
        'manage_options',
        'todo_insert',
        'todo_insert'
    );
}

/*****************************************/
/* task_post_action Handle the Edit Actions
******************************************/

function task_post_action() {
    global $wpdb;
    global $id;
    if (!empty($_POST)) {
        $listaction = $_POST['listaction'];
        if (isset($_POST['taskid'])) {
            $id = $_POST['taskid'];
        }
        switch ($listaction) {
            case 'insert':
                include TODO_PLUGIN_DIR . 'include/pages/todo-insert.php';
                break;
            case 'edit':
                include TODO_PLUGIN_DIR . 'include/pages/todo-edit.php';
                break;
            case 'list':
                include TODO_PLUGIN_DIR . 'include/pages/todo-list.php';
                break;
            case 'handleupdate':
                handle_task_update();
                include TODO_PLUGIN_DIR . 'include/pages/todo-list.php';
                break;
            case 'handledelete':
                handle_task_delete();
                include TODO_PLUGIN_DIR . 'include/pages/todo-list.php';
                break;
            case 'handleinsert':
                handle_task_insert();
                include TODO_PLUGIN_DIR . 'include/pages/todo-list.php';
                break;
            default:
                echo "<h2>Nothing Found!</h2>";

        }
    } else {
        include TODO_PLUGIN_DIR . 'include/pages/todo-list.php';
    }
}


/*****************************************/
/* insert a new Task
/*****************************************/

function handle_task_insert() {
    global $wpdb;

    $table = $wpdb->prefix . 'todolist';

    if(isset($_POST['title'])) {
        $title = $_POST['title'];
    }

    if(isset($_POST['description'])) {
        $description = $_POST['description'];
    }

    $updated_at = date("Y-m-d H:i:s");
    
    $created_at = date("Y-m-d H:i:s");
    
    $wpdb->insert(
        $table, //table
        array(
            'title' => $title,
            'description' => $description,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ),
        array('%s','%s','%s','%s') //data format
    );
}

/*****************************************/
/* Update a Task
/*****************************************/

function handle_task_update() {
    global $wpdb;

    $table = $wpdb->prefix . 'todolist';

    if(isset($_POST['taskid'])) {
        $id = $_POST['taskid'];
    }

    if(isset($_POST['title'])) {
        $title = $_POST['title'];
    }

    if(isset($_POST['description'])) {
        $description = $_POST['description'];
    }

    $updated_at = date("Y-m-d H:i:s");
    
    $wpdb->update(
        $table, //table
        array(
            'title' => $title,
            'description' => $description,
            'updated_at' => $updated_at,
        ),
        array('ID'=>$id), //where
        array('%s','%s','%s'), //data format
        array('%s') //where format
    );
}


/*****************************************/
/* Delete a Task
/*****************************************/

function handle_task_delete() {
    global $wpdb;

    if(isset($_POST['taskid'])) {
        $id = $_POST['taskid'];
        $SQL = "DELETE FROM " . $wpdb->prefix . "todolist WHERE id=$id";
        $wpdb->query($SQL);
    }
}

/*****************************************/
/* Display the Todo-list insert Action Page
/*****************************************/

function todo_list() {
    global $wpdb;
    task_post_action();
}

/*****************************************/
/* Display the Todo-list Add New Page
/*****************************************/

function todo_insert() {
    global $wpdb;

    if(!empty($_post)) {
        task_post_action();
    } else {
        include TODO_PLUGIN_DIR . 'include/pages/todo-insert.php';
    }

}
