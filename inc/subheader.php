<?php
/**
 * Subheader markup
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */
?>
            <div class="subheader">
                <div class="wrap">
                    <div class="inner clear">
                        <?php
						/**
						 * Display headings
						 */
						$h1 = get_post_meta($post->ID, 'h1', true);
						
						// Specific page template
						if (is_page_template('template-with-category-heading.php')) : ?>
						
							<div class="h1"><?php the_title(); ?></div>
                            
                        <?php
						// Team Member archive page
						elseif (is_post_type_archive('team-member')) : ?>
                        
                        	<h1 class="h1"><?php _e('Meet Our Team', 'sparkler'); ?></h1>
                            
						<?php
						// Team Member taxonomy archive or single pages
						elseif (is_tax('department') || is_singular('team-member')) : ?>
                        
                        	<div class="h1"><?php _e('Meet Our Team', 'sparkler'); ?></div>
                            
						<?php
						// Post type archive page
						elseif (is_post_type_archive()) : ?>
                        
							<h1 class="h1"><?php post_type_archive_title(); ?></h1>
							
						<?php
						// Blog index page
						elseif (is_home()) : ?>
                        
							<h1 class="h1"><?php single_post_title(); ?></h1>
							
						<?php
						// Blog single, archive, or search pages
						elseif (is_single() || is_archive() || is_search()) : ?>
                        
                        	<div class="h1"><?php _e('Blog', 'sparkler'); ?></div>
                            
                        <?php
						// 404 error page
						elseif (is_404()) : ?>
                        
							<h1 class="h1"><?php _e('Page Not Found', 'sparkler'); ?></h1>
							
						<?php
						// Success page
						elseif (isset($_GET['success'])) : ?>
                        
							<h1 class="h1"><?php _e('Thank You!', 'sparkler'); ?></h1>
							
                        <?php    
						// Custom heading
						elseif ($h1) : ?>
                        
							<h1 class="h1"><?php echo $h1; ?></h1>
							
						<?php
						// All other pages
						else : ?>
                        
							<h1 class="h1"><?php the_title(); ?></h1>
                            
						<?php endif; ?>
                        
                    </div><!--inner-->
                </div><!--wrap-->
            </div><!--subheader-->
