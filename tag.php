<?php
/**
 * Tag archive template
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */

get_header();
?>
                        <section id="content" class="grid8">
                        
						<?php if (have_posts()) : ?>
                        
                            <header class="page-header">
                                <h1 class="page-title"><?php _e('Tag Archives', 'sparkler'); ?></h1>
                                <h2 class="subtitle"><?php single_tag_title(); ?></h2>
                                
                                <?php
								// Display description
								$tag_description = tag_description();
								
								if (!empty($tag_description))
									echo apply_filters('tag_archive_meta', '<div class="tag-archive-meta">'.$tag_description.'</div>'); ?>
                                    
                            </header>
                            
                            <div class="excerpts">
                            <?php while (have_posts()) : the_post(); ?>
                            
                                <?php get_template_part('content', get_post_format()); ?>
                                
                            <?php endwhile; ?>
                            </div><!--excerpts-->
                            
                            <?php sparkler_content_nav('pagenav'); ?>
                            
                        <?php else : ?>
                        
                            <article id="post-0" class="post no-results not-found">
                                <header class="entry-header">
                                    <h1 class="entry-title"><?php _e('Nothing Found', 'sparkler'); ?></h1>
                                </header><!-- .entry-header -->
                                
                                <div class="entry-content">
                                    <p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'sparkler'); ?></p>
                                    <?php get_search_form(); ?>
                                </div><!-- .entry-content -->
                            </article><!-- #post-0 -->
                            
                        <?php endif; ?>
                        
                        </section><!--content-->
<?php
get_sidebar('blog');
get_footer();
?>