<?php 

get_header();

if (have_posts()): ?>

    <h1> Hey Morty, look what I've found for <?php the_search_query(); ?>!</h1>
    <p>It shoud be read in Rick´s voice, otherwise get out of here, wabalabadubdub </p>

    <?php
    while (have_posts()) : the_post();
    
    get_template_part('content');

    endwhile;

    else :
        echo '<p>No content found</p>';
    
endif;

get_footer();

?>