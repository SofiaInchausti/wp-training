<?php

// Function to enqueue the theme's main style (CSS file)
function my_theme_enqueue_styles()
{
    wp_enqueue_style('main-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

// Function to register a Custom Post Type (CPT) for "Books"
function create_books_cpt()
{
    register_post_type('books', [
        'labels' => [
            'name' => 'Books',
            'singular_name' => 'Book',
        ],
        'public' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-book',
        'has_archive' => true,
        'rewrite' => ['slug' => 'books'],
        'show_in_rest' =>  true
    ]);
}
// Hooking the function to 'init' so it runs when WordPress initializes
add_action('init', 'create_books_cpt');

// Filter to load custom templates for the "Books" archive and single post views
function ryp_enqueue_scripts()
{

    $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';

    $dist_url = get_template_directory_uri() . '/dist/';

    if (file_exists($manifest_path)) {
        $manifest = json_decode(file_get_contents($manifest_path), true);


        if (isset($manifest['src/main.jsx'])) {
            $entry = $manifest['src/main.jsx'];


            if (isset($entry['css'])) {
                foreach ($entry['css'] as $css_file) {
                    wp_enqueue_style('react-style', $dist_url . $css_file, [], null);
                }
            }


            wp_enqueue_script('react-script', $dist_url . $entry['file'], ['wp-element'], null, true);
        }
    }
}
add_action('wp_enqueue_scripts', 'ryp_enqueue_scripts');


// Filter to add type="module" attribute to the React app's script tag for module support
function add_type_attribute($tag, $handle, $src)
{
    if ($handle === 'react-script') {
        $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
    }
    return $tag;
}
add_filter('script_loader_tag', 'add_type_attribute', 10, 3);


function check_elementor_is_active()
{
    if (! did_action('elementor/loaded')) {
        // Si Elementor no está activo, muestra un error o haz algo
        add_action('admin_notices', function () {
            echo '<div class="error"><p><strong>Custom Elementor Books Widget</strong> necesita Elementor para funcionar.</p></div>';
        });
        return false;
    }
    return true;
}


function register_books_widget()
{
    if (! check_elementor_is_active()) {
        return;
    }

    require_once get_template_directory() . '/elementor-widgets/books-widget.php';

    \Elementor\Plugin::instance()->widgets_manager->register(new \Elementor\Books_Widget());
}
add_action('elementor/widgets/register', 'register_books_widget');
