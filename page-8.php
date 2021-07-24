<?php 

get_header();

if (have_posts()):
    while (have_posts()) : the_post(); ?>
    
    <article class='post'>

        <!-- column-container-->
        <div class='column-container clearfix'>

            <!-- title-column -->
            <div class='title column'>
                <h2><?php the_title(); ?></h2>
            </div><!-- /title-column -->

                <!-- text-column-->
                <div class='text column'>
                    <?php the_content(); ?>
                </div><!-- /text-column -->

        </div><!-- /column-container -->



        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <div class='carousel-container'>
            <div calss='carousel-row'>
                <div class='col s12'>
                
                    <div class= 'carousel center-align'> 
                        <div class='carousel-item'>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


        <?php the_content(); ?>
    </article class='post'>

    <?php endwhile;

    else :
        echo '<p>No content found</p>';
    
endif;

get_footer();

?>