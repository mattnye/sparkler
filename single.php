<?php
/**
 * Single template
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */

get_header();
?>
                        <section id="content" class="grid8">
                        
                        <?php while (have_posts()) : the_post(); ?>
                        
                            <?php get_template_part('content', 'single'); ?>
                            
                            <nav id="pagenav">
                                <h3 class="assistive-text"><?php _e( 'Post navigation', 'sparkler' ); ?></h3>
                                <div class="grid6">
                                    <p><?php if (get_previous_post()) echo '<span class="icon icon-chevron-left2"></span>'; ?> <?php previous_post_link('%link', '%title'); ?></p>
                                </div><!--grid-->
                                <div class="grid6 last">
                                    <p><?php next_post_link('%link', '%title'); ?> <?php if (get_next_post()) echo '<span class="icon icon-after icon-chevron-right2"></span>'; ?></p>
                                </div><!--grid-->
                            </nav><!--pgnav-->
                            
                            <?php //comments_template('', true); ?>
                            
                        <?php endwhile; ?>
                        
                        </section><!--content-->
<?php
get_sidebar('blog');
get_footer();
?>