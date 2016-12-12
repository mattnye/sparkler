<?php
/**
 * Page template
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */

get_header();
?>
                        <section id="content" class="grid8">
                        
                        <?php
						/**
						 * Display success message
						 */
						$success_message = get_post_meta($post->ID, 'success_message', true);
						
						// If exists, display custom message
						if (isset($_GET['success']) && $success_message) : 
							echo do_shortcode($success_message);
							
                        // Else, display generic message
						elseif (isset($_GET['success'])) : ?>
                        
                            <h1><?php _e('Thank You!', 'pjfitz'); ?></h1>
                            <p><?php _e('We have received your submission.', 'pjfitz'); ?></p>
                            
                        <?php
                        /**
						 * Display page content
						 */
						else : ?>
                        
                            <?php while (have_posts()) : the_post(); ?>
                            
                                <?php get_template_part('content', 'page'); ?>
                                
                            <?php endwhile; ?>
                            
                            <?php
                            // If Sitemap page, list all pages
                            if (is_page('Sitemap')) : ?>
                            
                                <ul>
                                    <?php
                                    $pages_args = array(
                                        'title_li' => '',
                                        'sort_column' => 'menu_order, post_name',
										//'exclude' => '',
                                    );
                                    wp_list_pages($pages_args); ?>
                                    
                                </ul>
                                
                            <?php endif; ?>
                            
                        <?php endif; ?>
                        
                        </section><!--content-->
<?php
get_sidebar();
get_footer();
?>