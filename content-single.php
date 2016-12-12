<?php
/**
 * Single content template
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */
?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <header class="entry-header">
                                    <h1 class="entry-title"><?php the_title(); ?></h1>
                            
                                    <?php if ( 'post' == get_post_type() ) : ?>
                                    <div class="entry-meta">
                                        <?php sparkler_posted_on(); ?>
                                        
                                    <?php
                                    /* Translators: used between list items, there is a space after the comma */
                                    $categories_list = get_the_category_list( __( ', ', 'sparkler' ) );
                                    if ( $categories_list ) :
                                    ?>
                                        <span class="cat-links">
                                            <?php printf( __( '<span class="%1$s">in</span> %2$s', 'sparkler' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list ); ?>
                                        </span>
                                    <?php endif; // End if $categories_list ?>
                                    
                                    </div><!-- .entry-meta -->
                                    <?php endif; ?>
                                </header><!-- .entry-header -->
                                
                                <?php
                                // Display featured image
                                if (has_post_thumbnail()) the_post_thumbnail('medium');
                                ?>
                            
                                <div class="entry-content">
                                    <?php the_content(); ?>
                                </div><!-- .entry-content -->
                                
                                <footer class="entry-meta">
                                <?php
                                /* Translators: used between list items, there is a space after the comma */
                                $categories_list = get_the_category_list( __( ', ', 'sparkler' ) );
                    
                                /* Translators: used between list items, there is a space after the comma */
                                $tag_list = get_the_tag_list( '', __( ', ', 'sparkler' ) );
                                if ( '' != $tag_list ) {
                                    $utility_text = __( 'This entry was posted in %1$s and tagged %2$s.', 'sparkler' );
                                } elseif ( '' != $categories_list ) {
                                    $utility_text = __( 'This entry was posted in %1$s.', 'sparkler' );
                                } else {
                                    $utility_text = __( 'This entry was posted by <a href="%6$s">%5$s</a>.', 'sparkler' );
                                }
                    
                                printf(
                                    $utility_text,
                                    $categories_list,
                                    $tag_list,
                                    esc_url( get_permalink() ),
                                    the_title_attribute( 'echo=0' ),
                                    get_the_author(),
                                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
                                );
                                ?>
                            
                                    <?php if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || is_multi_author() ) ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries ?>
                                    <div id="author-info">
                                        <div id="author-avatar">
                                            <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'sparkler_author_bio_avatar_size', 68 ) ); ?>
                                        </div><!-- #author-avatar -->
                                        <div id="author-description">
                                            <h2><?php printf( __( 'About %s', 'sparkler' ), get_the_author() ); ?></h2>
                                            <?php the_author_meta( 'description' ); ?>
                                            <div id="author-link">
                                                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                                                    <?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'sparkler' ), get_the_author() ); ?>
                                                </a>
                                            </div><!-- #author-link	-->
                                        </div><!-- #author-description -->
                                    </div><!-- #author-info -->
                                    <?php endif; ?>
                                </footer><!-- .entry-meta -->
                            </article><!-- #post-<?php the_ID(); ?> -->
