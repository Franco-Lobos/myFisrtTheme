<! DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name='viewport' content="width=device-width">
        <title><?php bloginfo('name')?></title>
        <?php wp_head(); ?>
    </head>

<body <?php body_class(); ?>>

    <div class='container'>

        <!-- site-header -->
        <header class ="site-header">

            <!-- hd-search -->
            <div class='hd-search'>
                <?php get_search_form();?>
            </div><!--/hd-search-->


            <h1><a href="<?php echo home_url();?>"><?php bloginfo('name'); ?></a></h1>
            <h4><?php bloginfo('description'); ?></h4>

            <?php if(is_page(8)) { ?>
                <h5>Thank you for viewing our page!</h5>
            <?php }?>

            <nav class='site-nav'>

                <?php 

                    $args = array(
                        'theme_location' => 'primary'
                    );

                ?>                

                <?php wp_nav_menu( $args); ?>
            <nav/>

        </header><!-- /siteheader -->
