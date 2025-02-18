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
function my_custom_plugin_activate_func() {
    add_option('my_custom_plugin_option', 'Plugin activated!');
}
register_activation_hook(__FILE__, 'my_custom_plugin_activate_func');

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
}
$favorite_book = get_option('my_plugin_favorite_book');

// Register custom REST API endpoint to fetch the 'Favorite Book'
function my_custom_plugin_register_rest_api() {
    register_rest_route('my-custom-plugin/v1', '/favorite-book', array(
        'methods' => 'GET',
        'callback' => 'my_custom_plugin_get_favorite_book',
        'permission_callback' => '__return_true', // Public access (you can adjust this)
    ));
}

add_action('rest_api_init', 'my_custom_plugin_register_rest_api');

// Callback function to return the "Favorite Book" option
function my_custom_plugin_get_favorite_book() {
    $favorite_book = get_option('my_plugin_favorite_book', 'Not set');
    return rest_ensure_response(['favorite_book' => $favorite_book]); 
}

// function my_custom_plugin_enqueue_react() {
//     // Enqueue the React app built JS file
//     wp_enqueue_script(
//         'my-custom-plugin-react',
//         plugin_dir_url(__FILE__) . 'my_custom_plugin/build/static/js/main.js', // Adjust this path as needed
//         array('wp-element'),
//         null,
//         true
//     );
    
//     // Enqueue the CSS file if applicable
//     wp_enqueue_style(
//         'my-custom-plugin-styles',
//         plugin_dir_url(__FILE__) . 'my_custom_plugin/build/static/css/main.css',
//         array(),
//         null
//     );
// }
// add_action('wp_enqueue_scripts', 'my_custom_plugin_enqueue_react');




function my_custom_plugin_react_shortcode() {
    return '<div id="root-shortcode">wfhrihfer</div>';  // React will render into this div
}

add_shortcode('favorite_book', 'my_custom_plugin_react_shortcode');

// function my_custom_plugin_enqueue_react() {
//     // Enqueue solo en páginas donde se use el shortcode
//     if (!has_shortcode(get_post()->post_content, 'favorite_book')) {
//         return;
//     }

//     wp_enqueue_script( 
//         'my-custom-plugin-react-shortcode',
//         '/wp-content/plugins/my_custom_plugin/build/static/js/main.*.js', // Adjust this path as needed
//         array('wp-element'), // Asegura que React cargue correctamente
//         null,
//         true // Carga en el footer para asegurarse de que el div exista
//     );

//     wp_enqueue_style(
//         'my-custom-plugin-react-styles-shortcode',
//     '/wp-content/plugins//my_custom_plugin/build/static/css/main.5a8e2793.css',
//         array(),
//         null
//     );
// }
// add_action('wp_enqueue_scripts', 'my_custom_plugin_enqueue_react');

// error_log(plugins_url('build/static/js/main.js', __FILE__));

function my_custom_plugin_enqueue_react() {
    $manifest_path = plugin_dir_path(__FILE__) . 'build/asset-manifest.json'; // ✅ Ruta corregida

    if (file_exists($manifest_path)) {
        $manifest = json_decode(file_get_contents($manifest_path), true);

        // Revisa qué estructura tiene el asset-manifest.json para usar la clave correcta
        $js_file = $manifest['files']['main.js'] ?? $manifest['entrypoints'][0] ?? null;
        $css_file = $manifest['files']['main.css'] ?? null;

        if ($js_file) {
            wp_enqueue_script(
                'my-custom-plugin-react-shortcode',
                get_site_url() . '/wp-content/plugins/my_custom_plugin/build/' . ltrim($js_file, '/'), // ✅ Asegura que la ruta sea correcta
                array('wp-element'),
                null,
                true
            );
        }

        if ($css_file) {
            wp_enqueue_style(
                'my-custom-plugin-react-styles-shortcode',
                get_site_url() . '/wp-content/plugins/my_custom_plugin/build/' . ltrim($css_file, '/'), // ✅ Asegura que la ruta sea correcta
                array(),
                null
            );
        }
    } else {
        error_log('El archivo asset-manifest.json no existe en: ' . $manifest_path);
    }
}
add_action('wp_enqueue_scripts', 'my_custom_plugin_enqueue_react');

