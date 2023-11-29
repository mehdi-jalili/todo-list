<?php
/*
Plugin Name: To-do List
Plugin URI: http://wwww.github.com/mehdi-jalili/wptodo
Description: you can manage your tasks with this TODO Plugin
Author: Mehdi Jalili
Version: 1.0
Author URI: http://wwww.github.com/mehdi-jalili
Requires at least: 5.8
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPL v2+
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

define('TODO_PLUGIN_DIR', plugin_dir_path(__FILE__));

require_once 'todo-shortcode.php';
require_once 'include/todo-admin-panel.php';



// Activate Plugin Hook

function todo_create_db_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'todolist';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        created_at DATETIME NOT NULL DEFAULT current_timestamp(),
        updated_at DATETIME NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

register_activation_hook( __FILE__, 'todo_create_db_table' );

?>