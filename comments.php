<?php
/**
 * Comment markup
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */
?>
<div id="comments">
    <?php if ( post_password_required() ) : ?>
        <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'sparkler' ); ?></p>
    </div><!-- #comments -->
    <?php
            /* Stop the rest of comments.php from being processed,
             * but don't kill the script entirely -- we still have
             * to fully load the template.
             */
            return;
        endif;
    ?>
    
    <?php if ( have_comments() ) : ?>
        <h2 id="comments-title">
            <?php printf( _n('1 Comment', '%1$s Comments', get_comments_number(), 'sparkler'), number_format_i18n(get_comments_number())); ?>
        </h2>

        <ol class="commentlist">
            <?php
                /* Loop through and list the comments. Tell wp_list_comments()
                 * to use sparkler_comment() to format the comments.
                 * If you want to overload this in a child theme then you can
                 * define sparkler_comment() and that will be used instead.
                 * See sparkler_comment() in sparkler/functions.php for more.
                 */
                wp_list_comments( array( 'callback' => 'sparkler_comment' ) );
            ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-below">
            <h1 class="assistive-text"><?php _e( 'Comment navigation', 'sparkler' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'sparkler' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'sparkler' ) ); ?></div>
        </nav>
        <?php endif; // check for comment navigation ?>

    <?php
        /* If there are no comments and comments are closed, let's leave a little note, shall we?
         * But we don't want the note on pages or post types that do not support comments.
         */
        elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="nocomments"><?php _e( 'Comments are closed.', 'sparkler' ); ?></p>
    <?php endif; ?>
    
    <?php
    $comment_fields = array(
        'author' => '<p class="comment-form-author"><label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '<span class="req">*</span>' : '' ) .
                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></p>',
        'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '<span class="req">*</span>' : '' ) .
                    '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></p>',
        'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
                    '<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></p>',
    );
    $comment_args = array(
        'title_reply' => 'Leave a Comment',
        'cancel_reply_link' => '(cancel)',
        'fields' => $comment_fields,
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <span class="req">*</span>' .
                           '<textarea id="comment" name="comment" aria-required="true"></textarea></p>',
        'id_form' => 'form-comment',
        'id_submit' => 'submit-comment',
        'label_submit' => 'Submit',
        'comment_notes_before' => '<p class="comment-notes">Your email address will not be published. Required fields are marked <span class="req">*</span></p>',
        'comment_notes_after' => '',
    );
    
    comment_form($comment_args);
    ?>

</div><!--comments-->
