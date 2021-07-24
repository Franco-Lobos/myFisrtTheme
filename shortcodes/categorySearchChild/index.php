<?php
function get_child_categories($atts) {
    
    foreach($atts as $sub) {
        echo '<h1> '. $sub .'</h1>';
        $catid = get_cat_ID($sub);
        $taxonomyName = 'category';
        $htmloutput = '<select name="Seleccinar" >';

        $children = get_term_children( $catid, $taxonomyName );
        
            
            foreach($children as $childid) {
                $categoryName= get_the_category_by_ID($childid);
                $htmloutput.= '<option value='.$categoryName .'>'. $categoryName. '</option>';
            }

        $htmloutput.= '</select>';
    }

    return $htmloutput;
    }


add_shortcode('child_categories', 'get_child_categories');

