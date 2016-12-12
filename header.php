<?php
/**
 * Header
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 lte8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 lte8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 lte8" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
		
		wp_title( '|', true, 'right' );
		
		// Add the blog name.
		//bloginfo( 'name' ); // Remove when WordPress SEO is active
		
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
		
		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'sparkler' ), max( $paged, $page ) );
			
	?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/img/favicon.ico" />
	<link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/img/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_url'); ?>/img/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_url'); ?>/img/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_url'); ?>/img/apple-touch-icon-144x144.png" />
    
    <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script> 
        <script src="<?php bloginfo('template_url'); ?>/js/respond.js"></script>
    <![endif]-->
    
    <?php wp_head(); ?>
</head>

<body <?php body_class('nav-style2 nav-click'); ?>>
    <div id="outer-wrap">
        <div id="inner-wrap">
            
            <header id="header">
                <div class="wrap">
                    <div class="inner clear">
						<?php
                        // Display logo
                        $logo_src = get_option('theme_options_logo_src');
                        if (!empty($logo_src)) : ?>
                        
                        <a href="/"><img src="<?php echo $logo_src; ?>" alt="<?php echo get_option('theme_options_logo_alt'); ?>" id="logo" /></a>
						<?php endif; ?>
                        
                        <?php
                        // Display Top nav
                        if (has_nav_menu('top')) : ?>
                        
                        <nav id="topnav">
                            <?php
                            $args = array(
                                'theme_location' => 'top',
                                'container_class' => 'menu',
                                'menu_class' => 'inline-list inline-list-right',
                            );
                            wp_nav_menu($args); ?>
                            
                        </nav>
                        <?php endif; ?>
                        
						<?php
                        /**
						 * Display phone numbers
						 */
                        $tel  = get_option('theme_options_tel');
                        $tel2 = get_option('theme_options_tel2');
						
						// If exists, display phone numbers
						if ($tel || $tel2) : ?>
                        
                        <div class="tel">
                        
                            <?php if (!empty($tel)) : ?>
                            
                            <a class="tel-link" href="tel:+<?php echo $tel; ?>"><?php echo $tel; ?></a>
                            
							<?php endif; ?>
                            
                            <?php if (!empty($tel2)) : ?>
                            
                            <a class="tel-link" href="tel:+<?php echo $tel2; ?>"><?php echo $tel2; ?></a>
                            
                            <?php endif; ?>
                            
                        </div><!--tel-->
                        
                        <?php endif; ?>
                        
                        <?php //get_search_form(); ?>
                        
                        <nav id="nav">
                            <div class="inner">
                                <h3 class="assistive-text"><?php _e( 'Main menu', 'sparkler' ); ?></h3>
                                <a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'sparkler' ); ?>"><?php _e( 'Skip to primary content', 'sparkler' ); ?></a>
                                <a class="assistive-text" href="#sidebar" title="<?php esc_attr_e( 'Skip to secondary content', 'sparkler' ); ?>"><?php _e( 'Skip to secondary content', 'sparkler' ); ?></a>
                                
                                <?php
                                // If exists, display custom Main nav
                                if (has_nav_menu('main')) :
                                
                                $args = array(
                                    'theme_location' => 'main',
                                    'container_class' => 'menu',
                                    'menu_class' => '',
                                );
                                wp_nav_menu($args);
                                
                                // Else, display nav as all pages minus utilities
                                else : ?>
                                
                                <div class="menu">
                                    <ul>
                                        <?php
                                        $args = array(
                                            'title_li' => '',
                                            'exclude_tree' => '99',
                                        );
                                        wp_list_pages($args);
                                        ?>
                                    </ul>
                                </div><!--menu-->        
                                <?php endif; ?>
                                
                                <?php
								// Display mobile Top nav
								if (has_nav_menu('top')) : ?>
								
								<nav id="topnav-mobile">
									<?php
									$args = array(
										'theme_location' => 'top',
										'container_class' => 'menu',
										'menu_class' => '',
									);
									wp_nav_menu($args); ?>
									
								</nav>
								<?php endif; ?>
                                
                            </div><!--inner-->
                        </nav><!--nav-->
                                                
                    </div><!--inner-->
                </div><!--wrap-->
            </header><!--header-->
            
            <?php
            // Display subheader on all interior pages
			/*if (!is_page_template('template-home.php'))
				include('inc/subheader.php');*/
			
			// Display hero on Home template
			if (is_page_template('template-home.php'))
				include('inc/hero.php'); ?>
            
            <div id="body">
                <div class="wrap">
                    <div class="inner clear">
