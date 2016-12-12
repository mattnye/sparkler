<?php
/**
 * Template Name: Contact
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */

get_header();
?>
                        <section id="content" class="grid8">
                        
                        <?php if (isset($_GET['success'])) : ?>
                        
                            <h1>Thank You!</h1>
                            <p>We have received your submission. A representative will be in contact with you as soon as possible.</p>
                            
                        <?php else : ?>
                        
                            <?php while ( have_posts() ) : the_post(); ?>
                            
                                <?php get_template_part( 'content', 'page' ); ?>
                                
                            <?php endwhile; ?>
                        
                        <?php endif; ?>
                  
                        </section><!--content-->
<?php
get_sidebar('contact');
get_footer();
?>