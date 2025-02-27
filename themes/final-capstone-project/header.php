<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>

    <?php
    // Etiquetas Open Graph generadas dinámicamente
    if (is_front_page() || is_home()) :
        // Esto asegura que solo se agregue la imagen OG para la página principal
        $og_image = get_the_post_thumbnail_url(get_option('page_on_front'), 'full');
    else:
        $og_image = get_the_post_thumbnail_url();
    endif;
    ?>
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php wp_title(); ?>">
    <meta property="og:description" content="<?php bloginfo('description'); ?>">
    <meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>">
    <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
    

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
       
      
    </header>