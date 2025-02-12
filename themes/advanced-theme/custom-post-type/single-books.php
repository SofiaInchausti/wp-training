<?php
get_header();
if (have_posts()) : while (have_posts()) : the_post();?>
    <h1><?php the_title(); ?></h1>  
    <p>Author: <?php the_field('book_author'); ?></p>
    <p>Published: <?php the_field('publication_date'); ?></p>
    <p>Summary: <?php the_field('summary'); ?></p>
<?php endwhile; endif;
get_footer();