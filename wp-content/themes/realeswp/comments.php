<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if(post_password_required()) {
    return;
}

global $current_user;
global $post;
$post_type = $post->post_type;
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>

        <h2 class="comments-title">
            <?php 
            if($post_type == 'agent') {
                echo number_format_i18n(get_comments_number()) . ' ' . __('Reviews', 'reales'); 
            } else {
                echo number_format_i18n(get_comments_number()) . ' ' . __('Comments', 'reales'); 
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            if($post_type == 'agent') {
                $callback = 'reales_agent_review';
            } else {
                $callback = 'reales_comment';
            }
            wp_list_comments( array(
                'style'       => 'ol',
                'callback'    => $callback,
                'short_ping'  => true,
            ) );
            ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
            <div class="nav-previous pull-left">
                <?php 
                if($post_type == 'agent') {
                    previous_comments_link( '<span class="fa fa-angle-left"></span> ' . __( 'Older Reviews', 'reales' ) ); 
                } else {
                    previous_comments_link( '<span class="fa fa-angle-left"></span> ' . __( 'Older Comments', 'reales' ) ); 
                }
                ?>
            </div>
            <div class="nav-next pull-right">
                <?php 
                if($post_type == 'agent') {
                    next_comments_link( __( 'Newer Reviews', 'reales' ) . ' <span class="fa fa-angle-right"></span>' ); 
                } else {
                    next_comments_link( __( 'Newer Comments', 'reales') . ' <span class="fa fa-angle-right"></span>' ); 
                }
                ?>
            </div>
            <div class="clearfix"></div>
        </nav>
        <?php endif; ?>

        <?php if ( ! comments_open() ) : ?>
        <p class="no-comments">
            <?php 
            if($post_type == 'agent') {
                _e( 'Reviews are closed.', 'reales' );
            } else {
                _e( 'Comments are closed.', 'reales' ); 
            }
            ?>
        </p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $required_text = '  ';

    if($post_type == 'agent') {
        $title_reply = __( 'Write a Review','reales' );
        $title_reply_to = __( 'Write a Review to %s','reales' );
        $cancel_reply_link = __( 'Cancel Review','reales' );
        $label_submit = __( 'Post Review','reales' );
        $comment_field = __( 'Your review helps others decide on the right agent for them. Please tell others why you recommend this agent.', 'reales' );
        $rating = '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">' .
            '<div class="agentRatingLabel">' . __('Rate the agent', 'reales') . '</div>' . 
            '<span class="agentRating">' . 
                '<span data-rating="5"></span>' . 
                '<span data-rating="4"></span>' . 
                '<span data-rating="3"></span>' . 
                '<span data-rating="2"></span>' . 
                '<span data-rating="1"></span>' .
            '</span>' .
            '<input type="hidden" name="rate" id="rate" value="" />' . 
        '</div></div>';
    } else {
        $title_reply = __( 'Leave a Reply','reales' );
        $title_reply_to = __( 'Leave a Reply to %s','reales' );
        $cancel_reply_link = __( 'Cancel Reply','reales' );
        $label_submit = __( 'Post Comment','reales' );
        $comment_field = __( 'Comment', 'reales' );
        $rating = '';
    }

    $args = array(
        'id_form'           => 'commentform',
        'id_submit'         => 'submit',
        'title_reply'       => $title_reply,
        'title_reply_to'    => $title_reply_to,
        'cancel_reply_link' => $cancel_reply_link,
        'label_submit'      => $label_submit,

        'comment_notes_before' => '<p class="comment-notes">' .
            __( 'Your email address will not be published.  ', 'reales' ) . ( $req ? esc_html($required_text) : '' ) .
        '</p>',

        'comment_field' => $rating . 
            '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">' .
                '<div class="form-group">' .
                    '<textarea id="comment" class="form-control" name="comment" rows="5" aria-required="true" placeholder="'. $comment_field .'"></textarea>' .
                '</div>' .
            '</div></div>',

        'fields' => apply_filters( 'comment_form_default_fields', array(
            'author' => '<div class="row"><div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">' .
                '<div class="form-group">'.
                    '<input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . '  placeholder="' . __( 'Name', 'reales' ) . '"/>'.
                '</div>'.
            '</div>',

            'email' => '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">' .
                '<div class="form-group">'.
                    '<input id="email" name="email" type="text" class="form-control"  value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( 'Email', 'reales' ) . '" />'.
                '</div>'.
            '</div></div>',

            'url' => '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">'.
                '<div class="form-group">'.
                    '<input id="url" name="url" type="text" class="form-control"  value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="'. __( 'Website', 'reales' ) .'"/>'.
                '</div>'.
            '</div></div>'
        ) )
    );

    if($post_type == 'agent') {
        if(is_user_logged_in()) {
            $user_review = get_comments(array('user_id' => $current_user->ID, 'post_id' => $post->ID));
            if(!$user_review) {
                comment_form($args);
            }
        } else {
            if(comments_open()) {
                print '<a href="#" class="btn btn-green" data-toggle="modal" data-target="#signin">' . __('Sign In and Write a Review', 'reales') . '</a>';
            }
        }
    } else {
        comment_form($args);
    }
    ?>

</div>
