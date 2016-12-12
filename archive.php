<?php
/**
 * Default archive template
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
                                <h1 class="page-title"><?php
                                if (is_day()) {
									_e('Daily Archives', 'sparkler');
									
								} elseif (is_month()) {
									_e('Monthly Archives', 'sparkler');
									
								} elseif (is_year()) {
									_e('Yearly Archives', 'sparkler');
									
								} else {
									_e('Blog Archives', 'sparkler');
								}
								?></h1>
                                
                                <h2 class="subtitle"><?php
                                if (is_day()) {
									the_date();
									
								} elseif (is_month()) {
									the_date(_x('F Y', 'monthly archives date format', 'sparkler'));
									
								} elseif (is_year()) {
									the_date(_x('Y', 'yearly archives date format', 'sparkler'));
									
								} else {
									_e('Blog Archives', 'sparkler');
								}
								?></h2>
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