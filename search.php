<?php
/**
 * Search template
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
                                <h1 class="page-title"><?php printf(__('Search Results for %s', 'sparkler'), '<span>&quot;'.get_search_query().'&quot;</span>'); ?></h1>
                            </header>
                            
                            <div class="excerpts">
                            <?php while (have_posts()) : the_post(); ?>
                            
                                <?php get_template_part('content', 'search'); ?>
                                
                            <?php endwhile; ?>
                            </div><!--excerpts-->
                            
                            <?php sparkler_content_nav('pagenav'); ?>
                            
                        <?php else : ?>
                                        
                            <article id="post-0" class="post no-results not-found">
                                <header class="entry-header">
                                    <h1 class="entry-title"><?php _e('Nothing Found', 'sparkler'); ?></h1>
                                </header><!-- .entry-header -->
                                
                                <div class="entry-content">
                                    <p><?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'sparkler'); ?></p>
                                </div><!-- .entry-content -->
                            </article><!-- #post-0 -->
                            
                        <?php endif; ?>
                        
                        </section><!--content-->
<?php
get_sidebar('blog');
get_footer();
?>