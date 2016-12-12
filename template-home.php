<?php
/**
 * Template Name: Home
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */

get_header();
?>
                        <section id="content" class="grid12 last">
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="entry-content">
                                
                                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                
                                    <?php the_content(); ?>
                                    
                                <?php endwhile; endif; ?>
                                
                                </div><!--entry-content-->
                            </article><!--post-<?php the_ID(); ?>-->
                        </section><!--content-->
<?php
get_footer();
?>