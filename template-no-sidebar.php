<?php
/**
 * Template Name: No Sidebar
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */

get_header();
?>
                        <section id="content" class="grid12 last">
                        
                        <?php while (have_posts()) : the_post(); ?>
                        
                            <?php get_template_part('content', 'page'); ?>
                            
                        <?php endwhile; ?>
                            
                        </section><!--content-->
<?php
get_footer();
?>