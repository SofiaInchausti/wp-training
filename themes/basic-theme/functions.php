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
add_filter('template_include', function($template) {
    if (is_post_type_archive('books')) {
        return get_template_directory() . '/../custom-post-type/archive-books.php';
    } elseif (is_singular('books')) {
        return get_template_directory() . '/../custom-post-type/single-books.php';
    }
    return $template;
});

// Function to enqueue React app's styles and scripts
function ryp_enqueue_scripts() {
    wp_enqueue_style('react-style',  get_template_directory_uri() . '/build/static/css/main.css', // Update path as necessary
    null,
    true
);
    wp_enqueue_script('react-script', get_template_directory_uri() . '/build/static/js/main.js', // Update path as necessary
    ['wp-element'],
    null,
    true
);
}
add_action('wp_enqueue_scripts', 'ryp_enqueue_scripts');

// Function to render a div with ID "root" for the React app in the footer
function ryp_render_react_app() {
    echo '<div id="root"></div>';
}
add_action('wp_footer', 'ryp_render_react_app');

// Filter to add type="module" attribute to the React app's script tag for module support
function add_type_attribute($tag, $handle, $src)
{
  if ($handle === 'react-script') {
    $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
  }
  return $tag;
}
add_filter('script_loader_tag', 'add_type_attribute', 10, 3);