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

function my_custom_plugin_activate() {
    add_option('my_custom_plugin_option', 'Plugin activated!');
}
register_activation_hook(__FILE__, 'my_custom_plugin_activate');


