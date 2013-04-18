<?php get_header();
global $post_id; 
$post_xml = get_post_meta($post->ID, "post", true);
	if ( $post_xml <> "" ) {
		$xmlObject = new SimpleXMLElement($post_xml);
			$cs_layout = $xmlObject->cs_layout;
			$cs_sidebar_left = $xmlObject->cs_sidebar_left;
			$cs_sidebar_right = $xmlObject->cs_sidebar_right;
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
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                    <!-- Blog Start -->
                        <div class="box-in">
                    		<!-- Blog Post Start -->
                            <div class="post" id="<?php the_ID(); ?>">
                                <?php
									$image_id = cs_get_post_thumbnail($post->ID, 690, 270);
									if($image_id <> ''){?>
                                        <a class="thumb" href="<?php echo get_permalink();?>">
                                            <?php echo $image_id;?>
                                        </a>
								<?php }?>
                                <h2><?php echo get_the_title();?></h2>
                                <div class="post-opts">
                                    <p class="author">by <a class="txthover" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="txthover"><?php echo get_the_author();?></a></p>
                                    <p class="date"><?php echo date( 'd M Y', strtotime(get_the_date()) );?></p>
                                </div>
                                <?php the_content();
								wp_link_pages( 'before=<p class="link-pages">Page: ' );
								?>
                            </div>
                            <!-- Post Extra Options Start -->
                            <div class="post-extras">
                                <div class="tags">
                                    Tags:
                                    <?php
										$tag_post = wp_get_post_tags( $post->ID );									
										$counterr = 0;
										foreach($tag_post as $values){
											echo ' <a href="'.get_term_link($values->slug,$values->taxonomy).'">'.$values->name.'</a>  ';											
											}										
									?> 
                                </div>
                                <div class="post-share">
                                    <?php 
                                        $post_social_sharing = '';
                                        $post_xml = get_post_meta($post->ID, "post", true);
                                        if ( $post_xml <> "" ) {
                                            $xmlObject = new SimpleXMLElement($post_xml);
                                                $post_social_sharing = $xmlObject->post_social_sharing;
                                        }
                                        if ( $post_social_sharing == "on" ) {
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
    	</div>
<?php get_footer(); ?>