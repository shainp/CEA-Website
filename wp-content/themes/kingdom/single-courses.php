<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
get_header(); 
global $post_id,$post;
if ( have_posts() ) while ( have_posts() ) : the_post();
	$cs_album = get_post_meta($post->ID, "cs_course", true);
	if ( $cs_album <> "" ) {
		$xmlObject = new SimpleXMLElement($cs_album);
			$cs_layout = $xmlObject->cs_layout;
			$cs_sidebar_left = $xmlObject->cs_sidebar_left;
			$cs_sidebar_right = $xmlObject->cs_sidebar_right;
			$course_date = $xmlObject->course_date;
			$course_eligibility = $xmlObject->course_eligibility;
			$course_apply = $xmlObject->course_apply;
			$course_social = $xmlObject->course_social;
	}
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
                <?php }?>
                <div class="<?php echo $cs_layout;?>">
                    <div class="box-in">
                    	<!-- Courses Intro Start -->
                    	<div class="intro post">
                        <?php $image_id = cs_get_post_thumbnail($post->ID, 690, 270);
							if($image_id <> ''){?>
									<a class="thumb" href="<?php echo get_permalink();?>">
										<?php echo $image_id;?>
									</a>
							<?php }?>
                            <div class="clear"></div>
                            <div class="post-opts">
                                <p class="author">by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="txthover"><?php echo get_the_author();?></a></p>
                                <p class="date"><?php echo date( get_option('date_format'), strtotime($course_date) );?></p>
                                <p class="comment-txt"><a href="<?php echo get_permalink();?>#comments" class="txthover"><?php echo get_comments_number($post_id);?> Comments</a></p>
                            </div>
                            <div class="intro-desc">
                            	<?php the_content();
								wp_link_pages( 'before=<p class="link-pages">Page: ' );
								?>
                            </div>
                            <div class="box intro-box">
                            	<div class="box-in">
                                	<h3 class="colr">Course Plan</h3>
                                    <ul>
                                    	<li>
                                        	<p>Course Start Date </p>
                                            <p><?php echo date(get_option('date_format'), strtotime($course_date))?></p>
                                        </li>
                                        <li>
                                        	<p>Course Program</p>
                                            <p>
											<?php $categories = get_the_terms( $post->ID, 'course-category' );
                                                if($categories != ''){
                                                    $couter_comma = 0;
                                                    foreach ( $categories as $category ) {
                                                        echo $category->name;
                                                        $couter_comma++;
                                                        if ( $couter_comma < count($categories) ) {
                                                            echo ", ";
                                                        }
                                                    }
                                            }?>                                            
                                            </p>
                                        </li>
                                        <li>
                                        	<p>Eligibility:</p>
                                            <p><?php echo $course_eligibility;?></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Courses Intro End -->
                        <!-- Table Section Start -->
                        <div class="table-sec">
                        	<ul class="table-head">
                            	<li class="id">01</li>
                                <li class="subject-title">Subject Title</li>
                                <li class="campus hidesmall">Instructor</li>
                                <li class="class-time">Credit Hours</li>
                                <li class="class-time">Detail</li>
                            </ul>
                            <?php
								$subject_counter = 0;
								foreach ( $xmlObject as $track ){
                                    if ( $track->getName() == "subject" ) {
										$subject_counter++;
										$subject_title = $track->subject_title;
										$subject_instructor = $track->subject_instructor;
										$subject_credit = $track->subject_credit;
										$subject_detail = $track->subject_detail;
										?>
                                        <ul class="table-cont">
                                            <li class="id"><?php echo $subject_counter;?></li>
                                            <li class="subject-title"><?php echo $track->subject_title;?></li>
                                            <li class="campus hidesmall"><?php echo $track->subject_instructor;?></li>
                                            <li class="class-time"><?php echo $track->subject_credit;?></li>
                                            <li class="class-time"><a class="document_class" href="<?php echo $track->subject_detail;?>">&nbsp;</a></li>
                                        </ul>
										<?php }
								}
							?>
                        </div>
                        <!-- Table Section Close -->
                        <!-- Across Categories Start -->
                        <div class="acros-cats">
                            <a href="<?php echo $course_apply;?>" class="backcolr">Apply Now</a>
                        </div>
                        <!-- Across Categories End -->
                        <!-- Post Extra Options Start -->
                        <div class="post-extras course-extra">
						<?php
							$cs_social_share = get_option("cs_social_share");							
							if($cs_social_share != ''){?>
							<div class="post-share">
							<?php
							  $xmlObject_album = new SimpleXMLElement($cs_social_share);
								if($course_social == 'Yes'){
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
							<?php }?>                                   
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