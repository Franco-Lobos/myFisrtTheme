<?php

//IMPORTAR CSS
wp_enqueue_style('style-slider', get_template_directory_uri(). '/shortcodes/slider/style/style.css');

//SHORTOCDE

function homeSlidergraficLab($categoryinput) {?>

<!-- return posts/pages/proyects of $postyptes where $category is true-->

<?php 
        $categoriesID = array();
          foreach ($categoryinput as $categ) {
              array_push($categoriesID, get_cat_ID($categ));
          }      

        if (count($categoriesID)== 0) {
            return '';
        }

        else {
                $args = array(
                        //'post_type'=> $posttype,
                        //'post_parent' => '33',
                        'category__in'=> $categoriesID,
                        'orderby' => 'menu_order'
                );

                $the_query = new WP_Query( $args );


                
                    ?><div class="CSSgal"><?php
                
                        // The Loop
                        
                        if ( $the_query->have_posts() ) {
                            $theid = 0;
                            while ( $the_query->have_posts() ) { // <S> CREATOR
                                
                                $the_query->the_post();
                                    
                                    $theid += 1;
                            ?>
                                
                                <!-- post slider -->
                                <s id="<?php echo 's'.$theid ?>"></s>
                                
                                <!--/post slider -->
                        <?php     

                            } // end while
                                ?>
                                    <div class="slider">
                                
                                        <?php while ( $the_query->have_posts() ) { // DIV CREATOR
                                                
                                                $the_query->the_post();
                                                    
                                        ?>
                                
                                        <!-- post slider -->
                                            <div style = 'background-color:red'>
                                                <h2><?php the_title()?></h2>
                                                <p><?php the_content()?></p>
                                            </div>  
                                        <!--/post slider -->
                                    
                                        <?php
                                        } // end while
                                        ?>

                                            
                                    </div>
                                    
                                    <div class="prevNext">
                                    
                                        <?php 

                                            $theid = 0;
                                        
                                            while ( $the_query->have_posts() ) { // ARROWS CREATOR
                                                    
                                                    $the_query->the_post();
                                                    $theid += 1; 
                                                     
                                                    
                                                    if ($theid == 1) {
                                                        $prev = $the_query->post_count;
                                                        $next = $theid + 1;
                                                    }

                                                    elseif($theid == $the_query->post_count) {
                                                        $prev = $theid -1;
                                                        $next = 1;
                                                    }

                                                    else {
                                                        $prev= $theid - 1;
                                                        $next= $theid + 1;
                                                    }

                                                
                                            ?>
                                    
                                            <!-- post slider -->
                                                <div>
                                                    <a href="<?php echo '#s'.$prev  ?>"></a><a href="<?php echo '#s'.$next ?>"></a>
                                                </div>  
                                                
                                            <!--/post slider -->

                                            <?php
                                            
                                            } // end while
                                            ?>
                                            

                                    </div>

                                    <div class="bullets">

                                    <?php 
                                        $theid = 0;
                                        while ( $the_query->have_posts() ) { // <S> CREATOR
                                            
                                            $the_query->the_post();
                                                
                                                $theid += 1;

                                        ?>
                            
                                            <!-- post slider -->
                                                <a href="<?php echo '#s'. $theid?>"><?php echo $theid ?></a>
                                            <!--/post slider -->
                                        
                                        <?php     
                                        } // end while
                                        ?>
                                    </div>
                                    
                                <?php
                            

                        } // endif 
                        

                    ?></div><?php
                ?>

            <?php 

                // Reset Post Data
                wp_reset_postdata();
        } //end else
            
    ?>

<?php

}

add_shortcode('slider', 'homeSlidergraficLab');
