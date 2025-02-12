<?php

// Function to enqueue the theme's main style (CSS file)
function my_theme_enqueue_styles() {
    wp_enqueue_style('main-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

// Function to register a Custom Post Type (CPT) for "Books"
function create_books_cpt() {
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
]); }
// Hooking the function to 'init' so it runs when WordPress initializes
add_action('init', 'create_books_cpt');

// Filter to load custom templates for the "Books" archive and single post views
function ryp_enqueue_scripts() {
    // Ruta física del manifest.json
    $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';
    // URL base para cargar los archivos desde la carpeta dist
    $dist_url = get_template_directory_uri() . '/dist/';

    if (file_exists($manifest_path)) {
        $manifest = json_decode(file_get_contents($manifest_path), true);

        // Verifica que la entrada para el punto de entrada de React exista
        if (isset($manifest['src/main.jsx'])) {
            $entry = $manifest['src/main.jsx'];

            // Si hay archivos CSS generados, encola cada uno
            if (isset($entry['css'])) {
                foreach ($entry['css'] as $css_file) {
                    wp_enqueue_style('react-style', $dist_url . $css_file, [], null);
                }
            }

            // Encola el archivo JS generado
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