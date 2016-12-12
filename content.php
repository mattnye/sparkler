<?php
/**
 * Default content template
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */
?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('excerpt'); ?>>
                                <header class="entry-header">
                                <?php if ( comments_open() && ! post_password_required() ) : ?>
                                    <div class="comments-link">
                                        <?php comments_popup_link( '<span class="leave-reply">' . __( 'Reply', 'sparkler' ) . '</span>', _x( '1', 'comments number', 'sparkler' ), _x( '%', 'comments number', 'sparkler' ) ); ?>
                                    </div><!--comments-link-->
                                <?php endif; ?>
                                
                                <?php if ( is_sticky() ) : ?>
                                    <hgroup>
                                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'sparkler' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                        <h3 class="entry-format"><?php _e( 'Featured', 'sparkler' ); ?></h3>
                                    </hgroup>
                                <?php else : ?>
                                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'sparkler' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                <?php endif; ?>
                            
                                <?php if ( 'post' == get_post_type() ) : ?>
                                    <div class="entry-meta">
                                        <?php sparkler_posted_on(); ?>
                                        
                                    <?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
                                    <?php
                                    /* Translators: used between list items, there is a space after the comma */
                                    $categories_list = get_the_category_list( __( ', ', 'sparkler' ) );
                                    if ( $categories_list ) :
                                    ?>
                                        <span class="cat-links">
                                            <?php printf( __( '<span class="%1$s">in</span> %2$s', 'sparkler' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
                                            $show_sep = true; ?>
                                        </span>
                                    <?php endif; // End if $categories_list ?>
                                    <?php endif; // End if 'post' == get_post_type() ?>
                                    
                                    </div><!-- .entry-meta -->
                                <?php endif; ?>
                                </header><!-- .entry-header -->
                                
                                <?php
                                // Display featured image
                                if (has_post_thumbnail()) :
                                ?>
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
                                <?php endif; ?>
                                
                                <div class="entry-content">
                                    <?php the_excerpt(); ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-arrow style2">Read on<span class="icon icon-after icon-chevron-right2"></span></a>
                                    <div class="clear"></div>
                                </div><!-- .entry-content -->
                            </article><!-- #post-<?php the_ID(); ?> -->
