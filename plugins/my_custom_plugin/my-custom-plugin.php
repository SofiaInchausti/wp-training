<?php /**
 * Plugin Name: My Custom Plugin
 * Plugin URI: https://github.com/your-username/my-custom-plugin
 * Description: A basic WordPress plugin for learning purposes.
 * Version: 1.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * License: GPL2
 * * Text Domain: my-custom-plugin
*/

 // This function runs when the plugin is activated. It adds a custom option to the database.
function my_custom_plugin_activate() {
    add_option('my_custom_plugin_option', 'Plugin activated!');
}
register_activation_hook(__FILE__, 'my_custom_plugin_activate');

// This function adds a menu item to the WordPress admin panel
add_action('admin_menu', 'my_custom_plugin_menu');
function my_custom_plugin_menu() {
    add_menu_page(
        'My Plugin Settings',
        'My Plugin',
        'manage_options',
        'my-custom-plugin',
        'my_custom_plugin_page'  // Callback function
); }

// This function renders the settings page of the plugin
function my_custom_plugin_page() {
    ?>
    <div class="wrap">
        <h1>My Plugin Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('my_plugin_settings_group');
            do_settings_sections('my-custom-plugin');
            submit_button();
            ?>
        </form>
    </div>
<?php }
add_action('admin_init', 'my_custom_plugin_settings');

function my_custom_plugin_settings() {
    register_setting('my_plugin_settings_group', 'my_plugin_favorite_book');
    add_settings_section('my_plugin_main_section', 'Main Settings', null, 'my-custom-plugin');
    add_settings_field('favorite_book', 'Favorite Book','my_plugin_favorite_book_callback', 'my-custom-plugin', 'my_plugin_main_section');
}

// This function renders the input field for the "Favorite Book" option
function my_plugin_favorite_book_callback() {
    $value = get_option('my_plugin_favorite_book', '');
    echo '<input type="text" name="my_plugin_favorite_book" value="' . esc_attr($value) . '"/>';
}$favorite_book = get_option('my_plugin_favorite_book');
echo 'El libro favorito es: ' . esc_html($favorite_book);


