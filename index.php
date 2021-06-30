<?php 

get_header();

if (have_posts()):
    while (have_posts()) : the_post(); ?>
    
    <article class='post'>
        <h1><a href ="<?php the_permalink();?>"><?php the_title(); ?></a></h1>

        <p class='post-meta'><?php the_time('F jS, Y');?> | <a href='<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>'> By <?php the_author();?></a> | Posted in 
    
            <?php
            
            $categories = get_the_category();
            $separator = ', ';
            $output = '';

            if($categories){

                foreach ($categories as $category) {

                    $output .= '<a href="'. get_category_link($category->term_id) . '">' . $category->cat_name . '</a>' . $separator;
                
                }

                echo trim($output, $separator); 

            }

            ?>

            </p>
        
        <?php the_content(); ?>
    </article class='post'>

    <?php endwhile;

    else :
        echo '<p>No content found</p>';
    
endif;

get_footer();

?>