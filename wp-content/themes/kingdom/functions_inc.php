<?php
function register_my_menus() {
  register_nav_menus(
	array(
	  'top-navi' => __( 'Top Navigation','mytheme' ),	
	  'top-menu'  => __('Main Menu','mytheme'),
	)
  );
}
add_action( 'init', 'register_my_menus' );

	
	

// custom sidebar start
$counter = 0;
 $parts = explode( "<name>", get_option("cs_sidebar") );
 foreach ( $parts as $val ) {
  if ( $val <> "" ) {
   $counter++;
    register_sidebar(array(
      'name' => $val,
      'id' => $val,
      'description' => 'This widget will be displayed on right side of the page.',
      'before_widget' => '<div class="widget box %2$s">',
      'after_widget' => '</div><div class="clear"></div>',
      'before_title' => '<h2 class="heading">',
      'after_title' => '</h2>'
    ));
  }
 }
// custom sidebar end
// adding custom images while uploading media start
		add_image_size('cs_media_1', 1000, 406, true);
		add_image_size('cs_media_1', 990, 200, true);
		add_image_size('cs_media_2', 690, 270, true);
		add_image_size('cs_media_3', 468, 288, true);
		add_image_size('cs_media_4', 299, 175, true);
		add_image_size('cs_media_5', 68, 68, true);
// adding custom images while uploading media end


	$inc_path = (TEMPLATEPATH.'/widgets/');
	require_once ($inc_path.'cs_gallery_widget.php');	
	require_once ($inc_path.'cs_twitter_widget.php');
	require_once ($inc_path.'cs_recent_post_widget.php');
	require_once ($inc_path.'cs_facebook_widget.php');
	require_once ($inc_path.'cs_newsletter_widget.php');	
	require_once ($inc_path.'cs_contact_us_widget.php');	
	require_once ($inc_path.'cs_message_box.php');		
	require_once ($inc_path.'cs_campus_comm_box.php');	
	require_once ($inc_path.'cs_event_countdown_widget.php');				
	require_once ($inc_path.'cs_tabs_widget.php');					
	require_once ($inc_path.'cs_search_widget.php');
	require_once ($inc_path.'cs_social_sharing.php');	
							
		

//Home Page Sidebar
register_sidebar( array(
	'name' => __( 'Home Page Left','mytheme'),
	'id' => 'left-sidebar',
	'description' => 'This Widget Show the Content of Home Sidebar.',
	'before_widget' => '<div class="widget box %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="heading">',
	'after_title' => '</h3>'
) );
//Home Page Sidebar
register_sidebar( array(
	'name' => __( 'Home Page Center','mytheme'),
	'id' => 'center-sidebar',
	'description' => 'This Widget Show the Content of Home Sidebar.',
	'before_widget' => '<div class="box cent-col %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="heading">',
	'after_title' => '</h3>'
) );
//Home Page Sidebar
register_sidebar( array(
	'name' => __( 'Home Page Right','mytheme'),
	'id' => 'right-sidebar',
	'description' => 'This Widget Show the Content of Home Sidebar.',
	'before_widget' => '<div class="widget box left %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2 class="heading">',
	'after_title' => '</h2>'
) );

//Home Page Sidebar
register_sidebar( array(
	'name' => __( 'Footer Widget','mytheme'),
	'id' => 'footer-sidebar',
	'description' => 'This Widget Area placed under the slider for small banner area.',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="white">',
	'after_title' => '</h4>'
) );


/* external functions start */

if ( ! function_exists( 'PixFill_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own PixFill_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function PixFill_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div class="com-in" id="comment-<?php comment_ID(); ?>">
 
		<div class="thumb">
			<?php echo '<a>'.get_avatar( $comment, 40 ).'</a>'; ?>
        </div>
		<div class="desc">
            <div class="desc-in-border">
                <div class="desc-in"> 
                    <div class="title">
                        <h5><?php printf( __( '%s', 'PixFill' ), sprintf( '<a class="colr">%s</a>', get_comment_author_link() ) ); ?></h5>
                        <p>
                        <?php
                        /* translators: 1: date, 2: time */
                        printf( __( '%1$s at %2$s', 'PixFill' ), get_comment_date(),  get_comment_time() ); ?>
                        <?php edit_comment_link( __( '(Edit)', 'mytheme' ), ' ' );?>
                        </p>
                    </div>
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                        <div class="comment-awaiting-moderation backcolr"><?php _e( 'Your comment is awaiting moderation.', 'mytheme' ); ?></div>
                        <div class="clear"></div>
                    <?php endif; ?>                          
                        <?php comment_text(); ?>
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    <div class="clear"></div>                    
                </div>
            </div>
		</div>
        </div>
</li>
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'PixFill' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'PixFill' ), ' ' ); ?></p>
    </li>
	<?php
			break;
	endswitch;
?>
<?php
	
}
endif;

?>