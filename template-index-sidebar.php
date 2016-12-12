<?php
/**
 * Template Name: Index Sidebar
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */

get_header();
?>
                        <section id="content" class="grid8">
                        
                        <?php while (have_posts()) : the_post(); ?>
                        
                            <?php get_template_part('content', 'page'); ?>
                            
                        <?php endwhile; ?>
                        
                        <?php
                        // Display child excerpts
                        $args = array(
                            'post_type' => 'page',
                            'post_parent' => $post->ID,
                            'orderby' => 'menu_order',
                            'order' => 'ASC',
                            'posts_per_page' => -1,
                        );
                        $query = new WP_Query($args);
                        
                        if ($query->have_posts()) : ?>
                        
                            <div class="dynagrid clear">
                            
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                
                                <div class="grid6">
                                    <?php
                                    // Display featured image
                                    if (has_post_thumbnail()) : ?>
                                    
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('small'); ?></a>
                                    <?php endif; ?>
                                    
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <?php the_excerpt(); ?>
                                    
                                    <a href="<?php the_permalink(); ?>" class="btn btn-arrow style2">Learn more<span class="icon icon-after icon-chevron-right2"></span></a>
                                </div><!--grid4-->
                                
                            <?php endwhile; ?>
                            
                            </div><!--dynagrid-->
                            
                        <?php
                        endif;
                        
                        // Cleanup
                        wp_reset_postdata(); ?>
                        
                        </section><!--content-->
<?php
get_sidebar();
get_footer();
?>