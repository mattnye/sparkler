<?php
/**
 * 404 template
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */

get_header();
?>
                        <section id="content" class="grid8">
                        
                            <article id="post-0" class="post error404 not-found">
                                <header class="entry-header">
                                    <h1 class="entry-title"><?php _e( 'Page Not Found', 'sparkler' ); ?></h1>
                                </header>
                                
                                <p>It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.</p>
                                                
                            </article><!-- #post-0 -->
                                            
                        </section><!--content-->
<?php
get_sidebar();
get_footer();
?>