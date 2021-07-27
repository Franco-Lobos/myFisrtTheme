<?php

//IMPORTAR CSS
wp_enqueue_style('style-slider', get_template_directory_uri(). '/shortcodes/slider/style/style.css');

//SHORTOCDE

function homeSlidergraficLab($atts) {
                $a = shortcode_atts( array(
                        'height' => '400px',
                        'tablet-landscape-height' => '300px',
                        'tablet-height' => '300px',
                        'mobile-height' => '300px',
                        'white' =>  '#fff',
                        'black' =>  '#323232',
                        'color1' => '#fff',
                        'color2' => '#fff',
                        'color3' => '#fff',
                        'color4' => '#898a89',
                        'color5' => '#e5e5e5',
                ), $atts);

        $categoriesID = array();
            foreach ($atts as $categ) {
                $key = array_search($categ, $a);
                if ( in_array($a,$key)){
                    echo '';
                }
                else{
                    array_push($categoriesID, get_cat_ID($categ));
                }
            }      
        ?>
            <style type="text/css"> :root{
                --white: <?php echo $a['white']?>;
                --black: <?php echo $a['black']?>;
                --color1: <?php echo $a['color1']?>;
                --color2: <?php echo $a['color2']?>;
                --color3: <?php echo $a['color3']?>;
                --color4: <?php echo $a['color4']?>;
                --color5: <?php echo $a['color5']?>;        
            }
            </style>

            <style type="text/css">
                @media (min-width: 320px) and (max-width: 480px) {
                    .CSSgal  {
                        max-height: <?php echo $a['mobile-height']?>;
                    }
                }

                @media (min-width: 481px) and (max-width: 767px) {
                    .CSSgal  {
                        max-height: <?php echo $a['tablet-height']?>;
                    } 
                }

                @media (min-width: 768px) and (max-width: 1024px) {
                    .CSSgal  {
                        max-height: <?php echo $a['tablet-landscape-height']?>;
                    } 
                }
            </style>

        <?php

        if (count($categoriesID)== 0) {
            return '<h1> NO CATEGORY FOUND </h1>';
        }

        else {
                $args = array(
                        //'post_type'=> $posttype,
                        //'post_parent' => '33',
                        'category__in'=> $categoriesID,
                        'orderby' => 'menu_order'
                );

                $the_query = new WP_Query( $args );

                    ?><div class="CSSgal" style='height: <?php echo $a['height']?>'><?php
                
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
                                        <?php 
                                        $theid = 0;
                                        while ( $the_query->have_posts() ) { // DIV CREATOR
                                                
                                                $the_query->the_post();
                                                $theid+=1;
                                                $thepercentage = $theid*100-100;

                                        ?>        
                                        <!-- post slider -->
                                            <div class= 'slider-img' style = 'background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID()) ?>)'>
                                                <div class ='slider-text'>
                                                    <h2><?php the_title()?></h2>
                                                    <p><?php the_excerpt()?></p>
                                                    <h1> <?php echo $thepercentage;?> </h1>
                                                    <h1> <?php echo $theid;?> </h1>
                                                </div>
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
                                                    <a href="<?php echo '#s'.$prev ?>" >
                                                        ‹
                                                    </a>
                                                    <a href="<?php echo '#s'.$next ?>">
                                                        ›
                                                    </a>
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
                                                <a href="<?php echo '#s'. $theid?>"></a>
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
