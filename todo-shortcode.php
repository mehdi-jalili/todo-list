<?php
/*
*
* Shortcode Usage - wp edits can add the shortcode [todolist]
* to list all tasks
*
*/

function todo_taskform($attrs) {
    include TODO_PLUGIN_DIR . '/include/pages/todo-shortcode-form.php';
}

add_shortcode('todolist', 'todo_taskform');

?>
