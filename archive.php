<?php 

get_header();

if (have_posts()):

    ?>

    <h2><?php
     
    if (is_category() ) {
        single_cat_title();
    } elseif ( is_tag() ) {
        single_tag_tile();
    } elseif (is_author()) {
        the_post();
        echo 'Author posts: ' . get_the_author();
        rewind_posts();
    } elseif (is_day()) {
        echo 'Daily Archive: ' . get_the_date();
    } elseif ( is_month()){
        echo 'Montholy Archive: ' . get_the_date('F Y');
    } elseif (is_year() ) {
        echo 'Yearly Archive: ' . get_the_date('Y');
    } else {
        echo 'Archives:';
    }

    ?></h2>

    <?php
    while (have_posts()) : the_post(); 

    get_template_part('content');
    
    endwhile;

    else :
        echo '<p>No content found</p>';
    
endif;

get_footer();

?>