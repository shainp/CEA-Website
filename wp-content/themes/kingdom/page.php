<?php get_header(); 
$cs_page_builder = get_post_meta($post->ID, "cs_page_builder", true);
	if($cs_page_builder == '') {
		// if page have no meta info like sample page - start
			if ( have_posts() ) while ( have_posts() ) : the_post();
				echo "<div class='fullwidth box'><h2 class='heading colr'>".get_the_title()."</h2>";
					echo '<div class="box-in">'.get_the_content();
					wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'mytheme' ), 'after' => '</div>' ) );
					edit_post_link( __( 'Edit', 'mytheme' ), '<span class="edit-link">', '</span>' );
					comments_template( '', true );
					echo '</div>';
			endwhile;
		// if page have no meta info like sample page - end
	}
	else {		

		$xmlObject = new SimpleXMLElement($cs_page_builder);
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
                    <?php
                        $counter_gal = 0;
                        foreach ( $xmlObject->children() as $node ){
                            if ( $node->getName() == "rich_editor" ) {
                                wp_reset_query();
                                //get_template_part( 'loop', 'page' );
                                    if ( $node->cs_rich_editor_title == "Yes") echo '<h2 class="heading colr">'.get_the_title().'</h2>';
                                    if ( $node->cs_rich_editor_desc == "Yes") {
                                        echo '<div class="intro">';
                                            $content_of_post = get_post($post->ID);
                                            $content = $content_of_post->post_content;
                                            $content = apply_filters('the_content', $content);
                                            $content = str_replace(']]>', ']]>', $content);
	                                        echo $content;
	                                    echo '</div>';
                                    }
                            }
                            if ( $node->getName() == "gallery" ) {
                                $counter_gal++;
                                $cs_gal_layout_db = $node->layout;
                                $cs_gal_album_db = $node->album;
                                $cs_gal_title_db = $node->title;
                                $cs_gal_desc_db = $node->desc;
                                $cs_gal_pagination_db = $node->pagination;
                                $cs_gal_media_per_page_db = $node->media_per_page;
                                    include("page_gallery.php");
                            }
                            else if ( $node->getName() == "slider" ) {
                                $counter_gal++;
                                include("page_slider.php");
                            }
                            else if ( $node->getName() == "blog" ) {
                                $counter_gal++;
                                    $cs_blog_title_db = $node->cs_blog_title;
                                    $cs_blog_cat_db = $node->cs_blog_cat;
                                    $cs_blog_excerpt_db = $node->cs_blog_excerpt;
                                    $cs_blog_num_post_db = $node->cs_blog_num_post;
                                    $cs_blog_pagination_db = $node->cs_blog_pagination;
                                    include("page_blog.php");
                            }
                            else if ( $node->getName() == "contact" ) {
                                $counter_gal++;
                                    $cs_contact_email_db = $node->cs_contact_email;
                                    $cs_contact_succ_msg_db = $node->cs_contact_succ_msg;
                                    $cs_contact_map_db = $node->cs_contact_map;
                                    include("page_contact.php");
                            }
                            else if ( $node->getName() == "news" ) {
                                $counter_gal++;
                                    $cs_news_title_db = $node->cs_news_title;
                                    $cs_news_cat_db = $node->cs_news_cat;
                                    $cs_news_excerpt_db = $node->cs_news_excerpt;
                                    $cs_news_num_post_db = $node->cs_news_num_post;
                                    $cs_news_pagination_db = $node->cs_news_pagination;
                                    include("page_news.php");
                            }
                            else if ( $node->getName() == "course" ) {
                                $counter_gal++;
                                    $cs_album_cat_db = $node->cs_album_cat;
                                    $cs_album_cat_show_db = $node->cs_album_cat_show;
                                    $cs_album_filterable_db = $node->cs_album_filterable;
                                    $cs_album_buynow_db = $node->cs_album_buynow;
                                    $cs_album_pagination_db = $node->cs_album_pagination;
                                    $cs_album_per_page_db = $node->cs_album_per_page;
                                    include("page_courses.php");
                            }		
                            else if ( $node->getName() == "event" ) {
                                $counter_gal++;
                                include("page_event.php");
                            }
                        }			
                    ?>
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
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
	<?php }?>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>