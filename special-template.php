<?php 

/*Template name: Special layout */

get_header();

if (have_posts()):
    while (have_posts()) : the_post(); ?>
    
    <article class = 'post page'>
        <h1><?php the_title(); ?></h1>
           
        <!-- info-box -->
        <div class = "info-box">
            <h4>Disclaimer Title</h4>
            <p>En un lugar de la mancha, cuyo nombre no</p>
        </div><!-- /info-box -->

        <?php the_content(); ?>
    </article>

    <?php endwhile;

    else :
        echo '<p>No content found</p>';
    
endif;

get_footer();

?>