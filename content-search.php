<?php
/**
 * Search content template
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */
?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('excerpt'); ?>>
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'sparkler' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                    
                                    <div class="entry-meta">
                                    <?php
                                    $type = get_post_type();
                                    $id = ($type == 'post') ? get_option('page_for_posts') : $post->post_parent;
                                    $icon = ($type == 'post') ? 'icon-pin3' : 'icon-text-document';
                                    ?>
                                        <span class="icon <?php echo $icon; ?>"><?php echo ucwords($type); ?> located in <a href="<?php echo get_permalink($id); ?>"><?php echo get_the_title($id); ?></a></span>
                                        
                                    </div><!--entry-meta-->
                                </header><!--entry-header-->
                                
                                <div class="entry-content">
                                    <?php the_excerpt(); ?>
                                </div><!--entry-content-->
                            </article><!--post-<?php the_ID(); ?>-->
