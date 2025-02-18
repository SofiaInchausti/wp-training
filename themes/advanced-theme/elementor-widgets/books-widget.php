<?php
namespace Elementor;

class Books_Widget extends Widget_Base {

    public function get_name() {
        return 'books-widget';
    }

    public function get_title() {
        return 'Books Widget';
    }

    public function get_icon() {
        return 'eicon-post-list'; // Icono para el widget
    }

    public function get_categories() {
        return [ 'general' ]; // Categoría del widget
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Books Content', 'plugin-name' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'number_of_books',
            [
                'label' => __( 'Number of Books', 'plugin-name' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'default' => 5,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        // Get widget settings
        $settings = $this->get_settings_for_display();
        $number_of_books = $settings['number_of_books'];

        // Consulta para obtener los "Books"
        $args = [
            'post_type' => 'books',
            'posts_per_page' => $number_of_books,
        ];

        $books_query = new \WP_Query( $args );

        if ( $books_query->have_posts() ) :
            echo '<div class="books-grid">';
            while ( $books_query->have_posts() ) : $books_query->the_post();
            echo '<div class="book-item">';
            echo '<h3><a href="' . get_permalink() . '" class="book-link">' . get_the_title() . '</a></h3>';
            echo '<p>' . get_the_excerpt() . '</p>';
            echo '</div>';
            endwhile;
            echo '</div>';
        else :
            echo '<p class="text-gray-600 text-center">No books found.</p>';
        endif;

        wp_reset_postdata();
    }

    protected function _content_template() {
        // Aquí puedes agregar el código de JS para la vista previa en vivo de Elementor
    }
}
