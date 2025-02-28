<?php

/**
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
function my_custom_plugin_activate_func()
{
    add_option('my_custom_plugin_option', 'Plugin activated!');
}
register_activation_hook(__FILE__, 'my_custom_plugin_activate_func');

// This function adds a menu item to the WordPress admin panel
add_action('admin_menu', 'my_custom_plugin_menu');
function my_custom_plugin_menu()
{
    add_menu_page(
        'My Plugin Settings',
        'My Plugin',
        'manage_options',
        'my-custom-plugin',
        'my_custom_plugin_page'  // Callback function
    );
}

// This function renders the settings page of the plugin
function my_custom_plugin_page()
{
?>
    <div class="wrap">
        <script type="module">
            import RefreshRuntime from "http://localhost:3334/@react-refresh"
            RefreshRuntime.injectIntoGlobalHook(window)
            window.$RefreshReg$ = () => {}
            window.$RefreshSig$ = () => (type) => type
            window.__vite_plugin_react_preamble_installed__ = true
        </script>
        <script type="module" src="http://localhost:3334/@vite/client"></script>
        </script>
        <h1>My Plugin Settings</h1>
        <div id="root-shortcode">

        </div>
    </div>
<?php }
add_action('admin_init', 'my_custom_plugin_settings');

function my_custom_plugin_settings()
{
    register_setting('my_plugin_settings_group', 'my_plugin_favorite_book');
    add_settings_section('my_plugin_main_section', 'Main Settings', null, 'my-custom-plugin');
    add_settings_field('favorite_book', 'Favorite Book', 'my_plugin_favorite_book_callback', 'my-custom-plugin', 'my_plugin_main_section');
}

// Registers custom REST API endpoints to fetch and save the 'Favorite Book' setting
function my_custom_plugin_register_rest_api()
{
    register_rest_route('my-custom-plugin/v1', '/favorite-book', array(
        'methods' => 'GET',
        'callback' => 'my_custom_plugin_get_favorite_book',
        'permission_callback' => '__return_true', 
    ));

    register_rest_route('my-custom-plugin/v1', '/favorite-book', array(
        'methods' => 'POST',
        'callback' => 'my_custom_plugin_save_favorite_book',
        'permission_callback' => '__return_true', 
    ));
}

add_action('rest_api_init', 'my_custom_plugin_register_rest_api');

// // Callback function to return the "Favorite Book" option
function my_custom_plugin_get_favorite_book()
{
    $favorite_book = get_option('my_plugin_favorite_book');

    if (empty($favorite_book)) {
        return rest_ensure_response(['favorite_book' => '']);
    }
    return rest_ensure_response(['favorite_book' => $favorite_book]);
}
// Saves the "Favorite Book" option via REST API
function my_custom_plugin_save_favorite_book(WP_REST_Request $request)
{
    $favorite_book = $request->get_param('favorite_book');

    if (!empty($favorite_book)) {
        $updated = update_option('my_plugin_favorite_book', sanitize_text_field($favorite_book));

        if ($updated) {
            return new WP_REST_Response('Favorite book saved successfully', 200);
        }
    }

    return new WP_REST_Response('Failed to save favorite book', 500);
}

function enqueue_react_app()
{
    // add script loader filter
    add_filter('script_loader_tag', 'add_type_attribute_plugin', 10, 3);

    //if the file react-plugin.js exists load it 
    if (file_exists(plugin_dir_path(__FILE__) . 'dist/react-plugin.js')) {

        $manifest_path = plugin_dir_path(__FILE__) . 'dist/.vite/manifest.json';

        if (!file_exists($manifest_path)) {
            return;
        }

        $manifest = json_decode(file_get_contents($manifest_path), true);

        // Revisar que la clave correcta en el manifest es 'src/index.jsx'
        $entry = $manifest['src/index.jsx'];

        wp_enqueue_script(
            'react-app',
            plugins_url('dist/' . $entry['file'], __FILE__),
            ['wp-element'], // Dependencia de React de WordPress
            null,
            true
        );

        // Si hay CSS, lo encolamos también
        if (!empty($entry['css'])) {
            foreach ($entry['css'] as $css_file) {
                wp_enqueue_style(
                    'react-app-style',
                    plugins_url('dist/' . $css_file, __FILE__)
                );
            }
        }
    } else {
        // load index.jsx from localhost:3334
        wp_enqueue_script(
            'react-app',
            'http://localhost:3334/src/index.jsx',
            ['wp-element'], // Dependencia de React de WordPress
            null,
            true
        );
    }
}
add_action('admin_enqueue_scripts', 'enqueue_react_app');


// // // Filter to add type="module" attribute to the React app's script tag for module support
function add_type_attribute_plugin($tag, $handle, $src)
{
    if ($handle === 'react-app') {
        $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
    }
    return $tag;
}

