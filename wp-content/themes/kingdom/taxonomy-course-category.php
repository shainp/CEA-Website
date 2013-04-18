<?php get_header(); ?>
<?php if ( have_posts() )	the_post(); ?>
		<?php 
				global $post_id;
		        $cs_default_pages = get_option("cs_default_pages");
                if ( $cs_default_pages <> "" ) {
                    $xmlObject = new SimpleXMLElement($cs_default_pages);
                        $cs_layout = $xmlObject->cs_layout;
						$cs_sidebar_left = $xmlObject->cs_sidebar_left;
						$cs_sidebar_right = $xmlObject->cs_sidebar_right;
                        $cs_pagination = $xmlObject->cs_pagination;
                        $record_per_page = $xmlObject->record_per_page;
						if($cs_pagination == 'Single Page'){$record_per_page = '-1';}						
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
		<div class="<?php if(isset($cs_layout)) echo $cs_layout;?>">           
				<h2 class="heading"><?php echo 'Category :  '.single_cat_title( '', false );?></h2>        
            <div class="blog">
                 <div class="box-in">	
					<?php
					wp_reset_query();
						if ( empty($_GET['page_id_all']) ) $_GET['page_id_all'] = 1;
						$album_category = single_term_title( '', false );						
						$newterm = get_term_by('slug', $album_category, 'course-category');
						if ( $cs_pagination == "Single Page" ) $cs_pagination = -1;
						if(!isset($_GET["course-categor"])){$_GET["course-category"] = '';}							
						$args = array(
                                'posts_per_page'			=> "-1",
                                'paged'						=> $_GET['page_id_all'],
                                'post_type'					=> 'courses',
                                'course-category'			=> $newterm->slug,
                                'post_status'				=> 'publish',
                                'order'						=> 'ASC',
                            );
						query_posts($args);
							$count_post = 0;
						while ( have_posts() ) : the_post(); 
								$count_post++;						
						endwhile;
						wp_reset_query();
						$args = array(
                                'posts_per_page'			=> "-1",
                                'paged'						=> $_GET['page_id_all'],
                                'post_type'					=> 'courses',
                                'course-category'			=> $newterm->slug,
                                'post_status'				=> 'publish',
                                'order'						=> 'ASC',
                            );
                    query_posts($args);
						while ( have_posts() ) : the_post(); 
						if ( is_archive() || is_search() ) :
						$image_id = get_post_thumbnail_id();  
						$image_url = wp_get_attachment_image_src($image_id,'');	
						$day = date('d', strtotime(get_the_time('F jS, Y')));
						$day_num = date("M", strtotime(get_the_time('F jS, Y')));
						$day_alpha = date("Y", strtotime(get_the_time('F jS, Y')));												
					?>
                    <div class="post no-image">
                        <h2><a href="<?php echo get_permalink()?>"><?php echo get_the_title();?></a></h2>
                        <div class="post-opts">
                            <p class="author">by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="txthover"><?php echo get_the_author();?></a></p>
                            <p class="date"><?php echo date( get_option('date_format'), strtotime(get_the_date()) );?></p>
                            <p class="comment-txt"><a href="<?php echo get_permalink();?>#comments" class="txthover"><?php echo get_comments_number($post_id);?> Comments</a></p>
                            <p class="cat"><?php $categories = get_the_terms( $post->ID, 'course-category' );
									if($categories != ''){
										$couter_comma = 0;
										foreach ( $categories as $category ) {
											echo '<a href="'.get_term_link($category->slug,$category->taxonomy).'">'.$category->name.'</a>';
											$couter_comma++;
											if ( $couter_comma < count($categories) ) {
												echo ", ";
											}
										}
								}?>
                            </p>
                        </div>
                        <p>
                            <?php   //echo get_the_excerpt()."<br /><br />";
                                $get_the_excerpt = trim(preg_replace('/<a[^>]*>(.*)<\/a>/iU','', get_the_content()));
                                $new_excerpt = trim(preg_replace('/\[(.*?)\]/ ','', $get_the_excerpt));															
                                echo substr($new_excerpt, 0, 350);
                                if ( strlen( $new_excerpt ) > 350 ) {
                                    echo '... <a class="readmore" href="'.get_permalink().'"> Read more</a>';
                                }
                            ?>
                        </p>
                    </div>      
                        <!-- Post End -->                    
					<?php endif; endwhile; wp_reset_query();?>
            <?php
                $qrystr = '';
                if(cs_pagination($count_post, $record_per_page,$qrystr) <> ''){
                    // pagination start
                    if ( $cs_pagination == "Show Pagination" and $record_per_page > 0 ) {
                        echo "<div class='pagination'><h5>Pages</h5><ul>";
                            if ( isset($_GET['course-category']) ) $qrystr = "&course-category=".$_GET['course-category'];								
                        echo cs_pagination($count_post, $record_per_page,$qrystr);
                        echo "</ul></div>";
                    }
                    // pagination end
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
	</div><!-- Page End -->
</div>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>