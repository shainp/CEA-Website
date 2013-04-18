<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
get_header();
global $post_id;
$post_xml = get_post_meta($post->ID, "cs_event_meta", true);
	if ( $post_xml <> "" ) {
		$xmlObject = new SimpleXMLElement($post_xml);		
			$cs_layout = $xmlObject->cs_layout;
			$cs_sidebar_left = $xmlObject->cs_sidebar_left;
			$cs_sidebar_right = $xmlObject->cs_sidebar_right;
			$event_social_sharing = $xmlObject->event_social_sharing;
			$event_start_time = $xmlObject->event_start_time;
			$event_end_time = $xmlObject->event_end_time;
			$event_all_day = $xmlObject->event_all_day;
			$event_booking_url = $xmlObject->event_booking_url;
			$event_address = $xmlObject->event_address;
			
				if ( $cs_layout == "left" ) {
					$cs_layout = "col3 page_box right";
					$show_sidebar_left = $cs_sidebar_left;
				}
				else if ( $cs_layout == "right" ) {
					$cs_layout = "col3 page_box left";
					$show_sidebar = $cs_sidebar_right;
				}
				else if ( $cs_layout == "both" ) {
					$cs_layout = "col2 page_box both";
					$show_sidebar = $cs_sidebar_right;
					$show_sidebar_left = $cs_sidebar_left;
				}
				else if ( $cs_layout == "both_left" ) {
					$cs_layout = "col2 page_box both_left";
					$show_sidebar = $cs_sidebar_right;
					$show_sidebar_left = $cs_sidebar_left;
				}
				else if ( $cs_layout == "both_right" ) {
					$cs_layout = "col2 page_box both_right";
					$show_sidebar = $cs_sidebar_right;
					$show_sidebar_left = $cs_sidebar_left;
				}				
				else $cs_layout = "fullwidth box";
	}	

	$cs_event_loc = get_post_meta($xmlObject->event_address, "cs_event_loc_meta", true);
	if ( $cs_event_loc <> "" ) {
		$cs_event_loc = new SimpleXMLElement($cs_event_loc);
			$event_loc_lat = $cs_event_loc->event_loc_lat;
			$event_loc_long = $cs_event_loc->event_loc_long;
			$event_loc_zoom = $cs_event_loc->event_loc_zoom;
			$loc_address = $cs_event_loc->loc_address;
			$loc_city = $cs_event_loc->loc_city;
			$loc_postcode = $cs_event_loc->loc_postcode;
			$loc_region = $cs_event_loc->loc_region;
			$loc_country = $cs_event_loc->loc_country;
	}
	else {
		$event_loc_lat = '';
		$event_loc_long = '';
		$event_loc_zoom = '';
		$loc_address = '';
		$loc_city = '';
		$loc_postcode = '';
		$loc_region = '';
		$loc_country = '';
	}
?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
var map;
		var myLatLng = new google.maps.LatLng(<?php echo $event_loc_lat;?>, <?php echo $event_loc_long;?>)
        //Initialize MAP
		var myOptions = {
          zoom: <?php echo $event_loc_zoom;?>,
          center: myLatLng,
		  disableDefaultUI: true,
		  zoomControl: true,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map_canvas'),myOptions);
		//End Initialize MAP
		//Set Marker
        var marker = new google.maps.Marker({
          position: map.getCenter(),
          map: map
        });
		marker.getPosition();
		//End marker
		
		//Set info window
		var infowindow = new google.maps.InfoWindow({
			content: '',
			position: myLatLng
		});
		infowindow.open(map);
    });
</script>
<?php
		if($cs_layout == 'col2 page_box both' || $cs_layout == 'col3 page_box right' || $cs_layout =='col2 page_box both_left'){?>
				<div class="col1 left hidemobile">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($show_sidebar_left) ) : ?>
					<?php endif; ?>                                    
				</div>
			<?php }//Both?>
		 <?php if($cs_layout =='col2 page_box both_left'){?>
		<!--Sidebar Start-->
			<div class="col1 left hidemobile margin_left_sidebar">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($show_sidebar) ) : ?>
				<?php endif; ?>                                    
			</div>
		<?php }
		wp_reset_query();
		?>
		<div class="<?php if(isset($cs_layout)) echo $cs_layout;?>">
				<?php
				 if ( have_posts() ) while ( have_posts() ) : the_post();
                    $cs_event_meta = get_post_meta($post->ID, "cs_event_meta", true);
                    if ( $cs_event_meta <> "" ) $cs_event_meta = new SimpleXMLElement($cs_event_meta);
                    ?>
            	<!-- Events Start -->
                <div class="blog">
                    <div class="box-in">
                    	<!-- Post Start -->
                    	<div class="post event-detail">
                            <!--<h2 class="ev-head"><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>-->
							<?php $image_id = cs_get_post_thumbnail($post->ID, 690, 270);
                                if($image_id <> ''){?>
                                    <a class="thumb" href="<?php echo get_permalink()?>">
                                        <?php echo $image_id;?>
                                    </a>
                            <?php }?>
                            <div class="clear"></div>
                            <div class="post-opts even-opts">
                            	<p class="author">by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="txthover"><?php echo get_the_author();?></a></p>
								<?php
									$event_from_date = get_post_meta($post->ID, "cs_event_from_date", true);
									$event_to_date = get_post_meta($post->ID, "cs_event_to_date", true);
								?>	
                                <p class="date"><?php echo 'From '.date(get_option('date_format'), strtotime($event_from_date)).' To '.date(get_option('date_format'), strtotime($event_to_date))?> -
                                			<span> Time : <?php 
                                                if ( $xmlObject->event_all_day == "" ) {
                                                    echo $xmlObject->event_start_time . " &ndash; " . $xmlObject->event_end_time;
                                                }
                                                else echo "All Day";
                                            ?></span></p>
                                <p class="comment-txt"><a href="<?php echo get_permalink();?>#comments" class="txthover"><?php echo get_comments_number($post_id);?> Comments</a></p>
                            </div>
                            <?php the_content();
							wp_link_pages( 'before=<p class="link-pages">Page: ' );
							?>
                            <div class="event-location">
                            	<h2 class="colr bold">Event Location</h2>
                                <div class="map-section">
                                	<div class="location-opts">
                                    	<p>
                                        <?php
											if ( $xmlObject->event_address <> "" ) {
												echo get_the_title( "$xmlObject->event_address" );
													if ( $loc_address <> "" ) echo ", " . $loc_address;
													if ( $loc_city <> "" ) echo ", " . $loc_city;
													if ( $loc_postcode <> "" ) echo ", " . $loc_postcode;
													if ( $loc_region <> "" ) echo ", " . $loc_region;
													if ( $loc_country <> "" ) echo ", " . $loc_country;
											}
										?>
                                        </p>
                                    </div>                                    
                                    <div class="mapbox">
                                    	<?php
                                        if($event_loc_lat <> "" && $event_loc_long <>""){?>
                                           <div id="map_canvas" style="height:300px"></div>
										<?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Post End -->
                        <!-- Post Extra Options Start -->
                        <div class="post-extras">
                        	<div class="tags">
								<?php
                                $tag_post = get_categories('taxonomy=event-tag&orderby=name');
                                $counterr = 0;
                                foreach($tag_post as $values){
                                    if($counterr == 1){echo 'Tags';}
                                        echo ' <a href="'.get_term_link($values->slug,$values->taxonomy).'">'.$values->name.'</a>  ';											
                                    }										
                                ?> 
                            </div>
					<?php if ( $xmlObject->event_social_sharing == "on" ) { ?>
                            <div class="post-share">
                                <?php 
                               $cs_social_share = get_option("cs_social_share");
							  	$xmlObject_album = new SimpleXMLElement($cs_social_share);
									$twitter = $xmlObject_album->twitter;
									$facebook = $xmlObject_album->facebook;
									$linkedin = $xmlObject_album->linkedin;
									$digg = $xmlObject_album->digg;
									$delicious = $xmlObject_album->delicious;
									$google_plus = $xmlObject_album->google_plus;
									$google_buzz = $xmlObject_album->google_buzz;
									$google_bookmark = $xmlObject_album->google_bookmark;
									$myspace = $xmlObject_album->myspace;
									$reddit = $xmlObject_album->reddit;
									$stumbleupon = $xmlObject_album->stumbleupon;
									$yahoo_buzz = $xmlObject_album->yahoo_buzz;
									$rss = $xmlObject_album->rss;
										if($twitter == 'on' or $facebook == 'on' or $linkedin == 'on' or $digg == 'on' or $delicious == 'on' or $google_plus == 'on' or $google_buzz == 'on' or $google_bookmark == 'on' or $myspace == 'on' or $reddit == 'on' or $stumbleupon == 'on' or $yahoo_buzz == 'on' or $rss == 'on'){
											$pageurl = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];?>
											<div class="social_sharing">
                                            <h5>Share</h5>
												<?php if($twitter == 'on'){?><a href="http://twitter.com/home?status=<?php the_title();?> - <?php echo $pageurl;?>" target="_blank" class="share_twitter"></a><?php }?>
												<?php if($facebook == 'on'){?><a href="http://www.facebook.com/share.php?u=<?php echo $pageurl;?>" target="_blank" class="share_fb"></a><?php }?>
												<?php if($linkedin == 'on'){?><a href="http://www.linkedin.com/shareArticle?mini=true&#038;url=<?php echo $pageurl;?>&#038;title=<?php the_title();?>" target="_blank" class="share_linkedin"></a><?php }?>
												<?php if($digg == 'on'){?><a href="http://digg.com/submit?url=<?php echo $pageurl;?>&#038;title=<?php the_title();?>" target="_blank" class="share_digg"></a><?php }?>												
												<?php if($delicious == 'on'){?><a href="http://delicious.com/post?url=<?php echo $pageurl;?>&#038;title=<?php the_title();?>" target="_blank" class="share_delicious"></a><?php }?>
												<?php if($google_bookmark == 'on'){?><a href="http://www.google.com/bookmarks/mark?op=edit&#038;bkmk=<?php echo $pageurl;?>&#038;title=<?php the_title();?>" target="_blank" class="share_google_bookmark"></a><?php }?>
												<?php if($google_buzz == 'on'){?><a href="http://www.google.com/reader/link?title=<?php the_title();?>&url=<?php the_permalink();?>" target="_blank" class="share_google_buzz"></a><?php }?>												
												<?php if($google_plus == 'on'){?><a href="https://plus.google.com/share?url=<?php the_permalink();?>" target="_blank" class="share_google_plus"></a><?php }?>																																																
												<?php if($myspace == 'on'){?><a href="http://www.myspace.com/Modules/PostTo/Pages/?u=<?php echo $pageurl;?>" target="_blank" class="share_twitter"></a><?php }?>
												<?php if($reddit == 'on'){?><a href="http://reddit.com/submit?url=<?php echo $pageurl;?>&#038;title=<?php the_title();?>" target="_blank" class="share_myspace"></a><?php }?>
												<?php if($stumbleupon == 'on'){?><a href="http://www.stumbleupon.com/submit?url=<?php echo $pageurl;?>&#038;title=<?php the_title();?>" target="_blank" class="share_stumbleupon"></a><?php }?>
												<?php if($rss == 'on'){?><a href="#" target="_blank" class="share_twitter"><img src="<?php echo get_template_directory_uri(); ?>/images/sharing-icons/small/rss.png" alt="" /></a><?php }?>												
											</div>
										<?php }?>
                                </div>
                        <?php }?>                            
                                                </div>
							</div>

                    <div class="clear"></div>
					<?php if ( get_the_author_meta( 'description' ) ) :?>
                    <div class="about-author">
                        <a href="#" class="thumb"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'PixFill_author_bio_avatar_size', 53 ) ); ?></a>
                        <div class="desc">
                            <h4 class="colr"><?php echo get_the_author(); ?></h4>
                            <p>
                              	<?php the_author_meta( 'description' ); ?>
                            </p>
                        </div>
                    </div>
                    <!-- About Author End -->
                   <?php endif; ?>                    
                <div class="clear"></div>
	            <!-- Blog Start -->                    	
            <?php endwhile; // end of the loop. ?>
			<?php comments_template( '', true ); 
					wp_reset_query();
			?>     
			</div>                                               
			</div>                                                            
		</div>                
		<?php if($cs_layout =='col2 page_box both_right'){?>
        <!--Sidebar Start-->
            <div class="col1 hidemobile margin_right_sidebar">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($show_sidebar_left) ) : ?>
                <?php endif; ?>                                    
            </div>
        <?php }?>
        
        <?php if($cs_layout == "col2 page_box both" || $cs_layout =='col3 page_box left' || $cs_layout =='col2 page_box both_right'){?>
        <!--Sidebar Start-->
            <div class="col1 right hidemobile">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($show_sidebar) ) : ?>
                <?php endif; ?>                                    
            </div>
        <?php }?>  
<?php get_footer(); ?>