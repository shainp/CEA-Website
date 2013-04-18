<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
<?php
// genereal setting start
$cs_style_sheet = '';
	$cs_gs_color_style = get_option( "cs_gs_color_style" );
		if ( $cs_gs_color_style <> "" ) {
			$sxe = new SimpleXMLElement($cs_gs_color_style);
				$cs_color_scheme = $sxe->cs_color_scheme;
				$cs_style_sheet = $sxe->cs_style_sheet;
		}
	$cs_gs_logo = get_option( "cs_gs_logo" );
		if ( $cs_gs_logo <> "" ) {
			$sxe = new SimpleXMLElement($cs_gs_logo);
				$cs_logo = $sxe->cs_logo;
				$cs_width = $sxe->cs_width;
				$cs_height = $sxe->cs_height;
		}
	
	$cs_gs_header_script = get_option( "cs_gs_header_script" );
		if ( $cs_gs_header_script <> "" ) {
			$sxe = new SimpleXMLElement($cs_gs_header_script);
				$cs_fav_icon = $sxe->cs_fav_icon;
				$cs_header_code = $sxe->cs_header_code;
				$header_phone = $sxe->header_phone;
		}
		
// genereal setting end
	$color_picker_enable = 0;
	if ( isset($_POST['color_picker']) ) {
		$_SESSION['color_picker_sess'] = $_POST['color_picker'];
		$cs_color_scheme = $_SESSION['color_picker_sess'];
		$color_picker_enable = 1;
	}
	else if ( isset($_SESSION['color_picker_sess']) ) {
		$cs_color_scheme = $_SESSION['color_picker_sess'];
		$color_picker_enable = 1;
	}
		$cs_gs_others = get_option( "cs_gs_others" );
		$responsive = "";
		$breadcrumb = "";
			if ( $cs_gs_others <> "" ) {
				$sxe = new SimpleXMLElement($cs_gs_others);
					$responsive = $sxe->responsive;
					$breadcrumb = $sxe->breadcrumb;
			}
	
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?php
	global $page, $paged;
	wp_title( '|', true, 'right' );

	bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'rockit' ), max( $paged, $page ) );

?>
</title>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/base.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/layout.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/color.css" />



<?php if($responsive <> ''){?>
<!-- Mobile Specific Metas
================================================== 
-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/skeleton.css" />
<?php }?>

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--// Javascript //-->

<?php 
if ( is_singular() && get_option( 'thread_comments' ) ) 	wp_enqueue_script( 'comment-reply' );

?>

<link rel="shortcut icon" href="<?php echo $cs_fav_icon?>" />

<!--// Favicons //-->


<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/frontend/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/frontend/contentslider.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/frontend/scrolltopcontrol.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/frontend/jquery.easing.1.3.js"></script>


<?php
if ( $cs_style_sheet == "custom" or $color_picker_enable == 1 ) {
?>
	<style>
		.colr,
		.txthover:hover,
		.ddsmoothmenu ul li ul li a:hover,
		.ddsmoothmenu ul li ul li a.selected,
		.theme-default .nivoSlider a,
		#footer .heading,
		.category-widget ul li a:hover,
		.post-list li .desc h6 a:hover,
		.post h2 a:hover,
		.post-extras .tags a:hover,
		.table-sec .table-cont li.c-name a:hover,
		.any-caption h1 a,
		.sudo-slider li .caption .capt-in a,
		.tabs-widget .widgettitle,
		.widget_categories ul li.cat-item a:hover,
		.widget_archive ul li a:hover,
		.gal-caption h3,
		ul.timeline li:hover .desc-sec .text h3 a,
		.event-location h2															{color:<?php echo $cs_color_scheme?> !important;}
		
		.backcolr,
		#backcolr,
		.ddsmoothmenu ul li ul,
		.backcolrhover:hover,
		.backcolrdark,
		.ddsmoothmenu > ul > li > a:hover,
		.ddsmoothmenu > ul > li.current-menu-item > a,
		.ddsmoothmenu > ul > li > a.selected,
		.pagination a:hover, .pagination a.active,
		.post:hover .date-sec,
		.filter-sec nav a:hover, .filter-sec nav a.active,
		ul.timeline li:hover .desc-sec .date .date-in,
		#wp-calendar thead,
		.button, button, input[type="submit"],
		input[type="reset"], input[type="button"],
		.tagcloud a																	{background-color:<?php echo $cs_color_scheme?> !important;}
		
		.bordercolr,
		.bordercolrover:hover,
		.box,
		.page_box,
		blockquote .block,
		.tabs-widget .tab_menu_container a											{border-color:<?php echo $cs_color_scheme?> !important;}


	</style>
<?php
}
else if ( $cs_style_sheet <> "custom" ) {
?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/custom_styles/<?php echo $cs_style_sheet?>.css" />
<?php
}
?>

<script type="text/javascript">
function cs_amimate(id){
	$("#"+id).animate({
		height: 'toggle'
		}, 200, function() {
		// Animation complete.
	});
}
</script>
<?php wp_head(); ?>
</head>
<body <?php body_class('dd'); ?>>
<!-- Outer Wrapper Start -->
<div id="outer-wrapper">
		<!-- Header Start -->
	<div id="header">
    	<div class="headtop">
        	<div class="inner">
            <!-- Logo End -->                
                <div class="five columns left">
                    <a href="<?php echo home_url() ; ?>" class="logo"><img width="<?php echo $cs_width?>" height="<?php echo $cs_height?>" src="<?php echo $cs_logo?>" alt="<?php echo bloginfo( 'name' )?>" /></a>
                </div>
                <!-- Logo End -->
                <div class="eleven columns right">
                    <!-- Top Links Start -->
					<?php 
                            // Menu parameters		
                            $defaults = array(
                              'theme_location'  => 'top-navi',
                              'menu'            => '', 
                              'container'       => '', 
                              'container_class' => 'menu-{menu slug}-container', 
                              'container_id'    => '',
                              'menu_class'      => '', 
                              'menu_id'         => '',
                              'echo'            => true,
                              'fallback_cb'     => '',
                              'before'          => '',
                              'after'           => '',
                              'link_before'     => '',
                              'link_after'      => '',
                              'items_wrap'      => '%3$s',
                              'depth'           => 0,
                              'walker'          => '',);				
							if(has_nav_menu('top-navi')){?>
                    <ul class="top-links">
                        <?php wp_nav_menu( $defaults); ?>
                    </ul>
					<?php }else{?>
					<?php }
					?>
					<div class="clear"></div>
                    <!-- Top Links End -->
					<?php echo $header_phone;?>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="navigation bordercolr backcolr">
        	<div class="inner">
				<?php
				// Menu parameters		
				$defaults = array(
				  'theme_location'  => 'top-menu',
				  'menu'            => '', 
				  'container'       => '', 
				  'container_class' => 'menu-{menu slug}-container', 
				  'container_id'    => '',
				  'menu_class'      => 'top-navigation', 
				  'menu_id'         => '',
				  'echo'            => true,
				  'fallback_cb'     => '',
				  'before'          => '',
				  'after'           => '',
				  'link_before'     => '',
				  'link_after'      => '',
				  'items_wrap'      => '<ul id="nav" class="%2$s">%3$s</ul>',
				  'depth'           => 0,
				  'walker'          => '',);				
				if(has_nav_menu('top-menu')){?>
						<script>
							jQuery(document).ready(function($){	
								/* prepend menu icon */
								$('#smoothmenu1').prepend('<div id="menu-icon"><div>Menu<span>&nbsp;</span></div></div>');
								
								/* toggle nav */
								$("#menu-icon").on("click", function(){
									$(".top-navigation").toggle();
									//$(this).toggleClass("active");
								});
							});
                        </script>                
					<div id="smoothmenu1" class="ddsmoothmenu">
						<?php wp_nav_menu( $defaults); ?>
						<div class="clear"></div>
					</div>
				<?php }else{
					$args = array(
						'sort_column' => 'menu_order, post_title',
						'menu_class'  => 'ddsmoothmenu',
						'include'     => '',
						'exclude'     => '',
						'echo'        => true,
						'show_home'   => false,
						'link_before' => '',
						'link_after'  => '' );
						wp_page_menu( $args ); ?>                                 
				<?php }?>
            	<div class="search">            
					<a href="javascript:cs_amimate('search-box')" class="search-btn">&nbsp;</a>					
					<form id="searchform" action="<?php echo esc_url( home_url( '/' ) ) ?>" method="get" role="search">
                    	<ul id="search-box">
							<li>
								<input name="s" value="Search"
								onfocus="if(this.value=='Search') {this.value='';}"
								onblur="if(this.value=='') {this.value='Search';}" type="text" class="bar" />
							</li>
							<li><input id="searchsubmit" type="submit" value="Search" class="go backcolr" /></li>
						</ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <div class="clear"></div>
    <?php if(is_home() || is_front_page()){
		$cs_home_page_announcement = get_option("cs_home_page_announcement");
			$show_announcement = '';
			$announcement_title = '';
			$announcement_cat = '';
				if ( $cs_home_page_announcement <> "" ) {
					$xmlObject = new SimpleXMLElement($cs_home_page_announcement);
						$show_announcement = $xmlObject->show_announcement;
						$announcement_title = $xmlObject->announcement_title;
						$announcement_cat = $xmlObject->announcement_cat;
				}		
			$show_slider = '';
			$cs_home_page_slider = get_option("cs_home_page_slider");
				if ( $cs_home_page_slider <> "" ) {
					$xmlObject = new SimpleXMLElement($cs_home_page_slider);
						$show_slider = $xmlObject->show_slider;
						$node->slider_type = $xmlObject->slider_type;
						$node->slider = $xmlObject->slider_id;
				}
	if($show_slider <> '' && $show_announcement <> ''){?>
    <!-- Banner Start -->
    <div id="banner">
    	<div class="inner">
            <div class="headlines">
            	<?php if($show_announcement <> ''){?>
                    <h4 class="white"><?php echo $announcement_title;?></h4>
                    <div id="slider2" class="sliderwrapper">
                    <?php
                    wp_reset_query();
                        $args = array(
                            'posts_per_page'			=> -1,
                            'post_type'					=> 'post',
                            'post_status'				=> 'publish',
                            'order'						=> 'DESC',
                            'tax_query' => array(
                                    array(
                                        'taxonomy' => 'category',
                                        'field' => 'term_id',
                                        'terms' => array( "$announcement_cat")
                                    ) 
                                )
                            );
                        query_posts($args);
                         if ( have_posts() <> "" ) {
                            while ( have_posts() ): the_post();
                            $new_excerpt = trim(preg_replace('/\[(.*?)\]/ ','', get_the_title()));															
                            ?>
                        <div class="contentdiv">
                            <p><span class="colr"><?php echo get_the_date();?></span> : <?php echo "<a href='".get_permalink()."'>".substr($new_excerpt, 0, 95)."</a>";  if ( strlen($new_excerpt) > 95 ) echo "...  <a href='".get_permalink()."'>Keep Reading</a>"; ?></p>
                        </div>
                        <?php endwhile; 
                         }
                         wp_reset_query();
                         ?>
                    </div>
                    <div id="paginate-slider2" class="paginationn">
                        <a href="#" class="prev">&nbsp;</a>
                        <a href="#" class="next">&nbsp;</a>
                    </div>
                <?php }?>
                <script type="text/javascript">
					featuredcontentslider.init({
						id: "slider2",  //id of main slider DIV
						contentsource: ["inline", ""],  //Valid values: ["inline", ""] or ["ajax", "path_to_file"]
						toc: "markup",  //Valid values: "#increment", "markup", ["label1", "label2", etc]
						nextprev: ["Previous", "Next"],  //labels for "prev" and "next" links. Set to "" to hide.
						revealtype: "click", //Behavior of pagination links to reveal the slides: "click" or "mouseover"
						enablefade: [true, 0.2],  //[true/false, fadedegree]
						autorotate: [true, 3000],  //[true/false, pausetime]
						onChange: function(previndex, curindex){  //event handler fired whenever script changes slide
						//previndex holds index of last slide viewed b4 current (1=1st slide, 2nd=2nd etc)
						//curindex holds index of currently shown slide (1=1st slide, 2nd=2nd etc)
						}
					});
                </script>
            </div>
        <div class="clear"></div>
        <?php if ($show_slider == 'on') {?>
                <div id="gallery">
                    <div id="main">
                    <?php               
                            $counter_gal = 1;
                            $node->width = 1000;
                            $node->height = 406;
                        ?>               	
                        <div id="images" class="" style="width:<?php echo $node->width;?>px;">
                            <?php include("page_slider.php")?>
                        </div>
                    </div>
                </div>
	        <?php }?>
    </div>
</div>
<!-- Banner End -->
<?php }?>
<div class="clear"></div>	
<?php }
wp_reset_query();
?>
<?php 
if(is_home() || is_front_page()){}else{
global $post,$wp_query;
?>
   <!-- Page Heading Section Start -->
    <div id="page-title">
        <div class="inner">
            <h1><?php echo substr(get_the_title(),0,45);if(strlen(get_the_title()) > 45){echo '...';}?></h1>
            <div class="page-share">
                <?php
                wp_reset_query();
                //Social Sharing Footer Icons
                $cs_social_network = get_option("cs_social_network");
                        if ( $cs_social_network <> "" ) {
                            $xmlObject = new SimpleXMLElement($cs_social_network);
                                $twitter = $xmlObject->twitter;
                                $facebook = $xmlObject->facebook;
                                $linkedin = $xmlObject->linkedin;
                                $digg = $xmlObject->digg;
                                $delicious = $xmlObject->delicious;
                                $google_plus = $xmlObject->google_plus;
                                $google_buzz = $xmlObject->google_buzz;
                                $google_bookmark = $xmlObject->google_bookmark;
                                $myspace = $xmlObject->myspace;
                                $reddit = $xmlObject->reddit;
                                $stumbleupon = $xmlObject->stumbleupon;
                                $yahoo_buzz = $xmlObject->yahoo_buzz;
                                $youtube = $xmlObject->youtube;
                                $feedburner = $xmlObject->feedburner;
                                $flickr = $xmlObject->flickr;
                                $picasa = $xmlObject->picasa;
                                $vimeo = $xmlObject->vimeo;
                                $tumblr = $xmlObject->tumblr;
                        }
                    ?>
                    <!-- Follow Us Start -->
                    <ul class="social">
                        <?php if($twitter != ''){?><li><a title="Twitter" href="<?php echo $twitter;?>" class="share_twitter" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($facebook != ''){?><li><a  title="Facebook" href="<?php echo $facebook;?>" class="share_fb" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($linkedin != ''){?><li><a  title="Linkedin" href="<?php echo $linkedin;?>" class="share_linkedin" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($digg != ''){?><li><a  title="Digg" href="<?php echo $digg;?>" class="share_digg" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($delicious != ''){?><li><a  title="Delicious" href="<?php echo $delicious;?>" class="share_delicious" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($google_plus != ''){?><li><a  title="Google Plus" href="<?php echo $google_plus;?>" class="share_google_plus" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($google_buzz != ''){?><li><a  title="Google Buzz" href="<?php echo $google_buzz;?>" class="share_google_buzz" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($google_bookmark != ''){?><li><a  title="Google Bookmark" href="<?php echo $google_bookmark;?>" class="share_google_bookmark" target="_blank">&nbsp;</a></li><?php }?>                                                                                                                                            
                        <?php if($myspace != ''){?><li><a  title="Myspace" href="<?php echo $myspace;?>" class="share_myspace" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($reddit != ''){?><li><a  title="Reddit" href="<?php echo $reddit;?>" class="share_reddit" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($stumbleupon != ''){?><li><a  title="Stumbleupon" href="<?php echo $stumbleupon;?>" class="share_stumbleupon" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($youtube != ''){?><li><a  title="Youtube" href="<?php echo $youtube;?>" class="share_youtube" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($feedburner != ''){?><li><a  title="Feedburner" href="<?php echo $feedburner;?>" class="share_feedburner" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($flickr != ''){?><li><a  title="Flickr" href="<?php echo $flickr;?>" class="share_flickr" target="_blank">&nbsp;</a></li><?php }?>                                                                                                                                
                        <?php if($picasa != ''){?><li><a  title="Picasa" href="<?php echo $picasa;?>" class="share_picasa" target="_blank">&nbsp;</a></li><?php }?>                                                                                                                                                                
                        <?php if($vimeo != ''){?><li><a  title="Vimeo" href="<?php echo $vimeo;?>" class="share_vimeo" target="_blank">&nbsp;</a></li><?php }?>
                        <?php if($tumblr != ''){?><li><a title="Tumblr"  href="<?php echo $tumblr;?>" class="share_tumblr" target="_blank">&nbsp;</a></li><?php }?>                                                                                                                                                                
                    </ul>                
            </div>
            <div class="clear"></div>
			<?php global $post_id,$post;
			$page_id_custom = get_page( $page_id );
			if($page_id_custom <> ''){
			$image_id = cs_get_post_thumbnail($page_id_custom->ID, 990, 200);
			if(is_page() AND $image_id <> ''){?>
                <div class="sub_banner">
                    <?php echo $image_id;?>
                </div> 
            <?php }
			}
			?>
        </div>
	</div>   
<?php }?>     
    <div class="content-sec">
    	<div class="inner">
        <!-- Page Heading Section End -->
        <div class="clear"></div>
<?php 
wp_reset_query();
if(is_home() || is_front_page()){}else{
global $post,$wp_query;?>        
	<?php if($breadcrumb <> ''){?>
    	<div class="clear"></div>
        <div class='breadcrumb' id="bread-crumb">
            <?php // if there is a parent, display the link
            echo '<ul>';
                echo '<li><a href="'.get_bloginfo('url').'" class="txthover">';
                    echo bloginfo('name').'</a>';
                echo '</li>';
                echo'<li>';
                if (is_category() || is_single()) {
                    $categories_event = get_the_terms( $post->ID, 'event-category' );
                    $categories_album = get_the_terms( $post->ID, 'course-category' );
                    if($categories_event <> ''){
                        $couter_comma_event = 0;
                        foreach ( $categories_event as $category ) {
                            echo '<a href="'.get_term_link($category->slug, 'event-category').'">'.$category->name.'</a>';
                                if ( $couter_comma_event <= count($category->name) ) {
                                    echo " - ";
                                }
                            $couter_comma_event++;
                        }
                    }else if($categories_album <> ''){
                        $categories = $categories_album;
                        $couter_comma_album = 0;
                        foreach ( $categories as $category ) {
                            echo '<a href="'.get_term_link($category->slug, 'course-category').'">'.$category->name.'</a>';
                                if ( $couter_comma_album <= count($category) ) {
                                    echo " - ";
                                }
                                $couter_comma_album++;
                        }
                    }else{
                        $categories = get_the_category();
                            $couter_comma_default = 0;
                            if($categories <> ''){
                                foreach($categories as $category){
                                echo '<a href="'.get_term_link($category->slug,$category->taxonomy).'">'.$category->name.'</a>';							
                                    if ( $couter_comma_default <= count($category->name) ) {
                                        echo " - ";
                                    }
                                    $couter_comma_default++;
                                }
                            }											
                        }            
                    }
                    if (is_single()) { 	
                    echo '</a></li><li><a class="colr">';
                    echo the_title().'</a></li>';
                    } else if (is_page()) { 
						if ($post->post_parent <> 0){
							echo '<li><a href="'.get_permalink($post->post_parent).'">'.get_the_title($post->post_parent).'</a></li><li>';
						}
                echo the_title() . '</li>';}
                echo '<div class="clear"></div>';
            echo '</ul>';
			?>
        </div>
        <div class="clear"></div>
		<?php }//Breadcrumbs Condition Ends?>        
<?php }
wp_reset_query();
?>
<div class="columns">