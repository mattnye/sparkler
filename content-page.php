<?php
/**
 * Page content template
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */
?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <header class="entry-header">
									<?php
                                    // If exists, display custom heading
                                    $h1 = get_post_meta($post->ID, 'h1', true); ?>
                                    
                                    <h1 class="entry-title"><?php echo ($h1) ? $h1 : get_the_title(); ?></h1>
                                </header><!--entry-header-->
                                
                                <?php
								// Display featured image
								if (has_post_thumbnail()) the_post_thumbnail('large'); ?>
                                
                                <div class="entry-content">
                                    <?php the_content(); ?>
                                </div><!--entry-content-->
                            </article><!--post-<?php the_ID(); ?>-->
