<?php
class upcomingevents_count_recent extends WP_Widget
{
  function upcomingevents_count_recent()
  {
    $widget_ops = array('classname' => 'upcoming-eve', 'description' => 'Select Event to show its countdown.' );
    $this->WP_Widget('upcomingevents_count_recent', 'ChimpS : Event Countdown', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ,'widget_names_events' =>'new') );
    $title = $instance['title'];
	$get_names_events = isset( $instance['get_names_events'] ) ? esc_attr( $instance['get_names_events'] ) : '';
	$numevents = isset( $instance['numevents'] ) ? esc_attr( $instance['numevents'] ) : '';	
?>
  <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
	  Title: 
	  <input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size="40" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>
  <p>
  <label for="<?php echo $this->get_field_id('get_names_events'); ?>">
	  Select Event:
	  <select id="<?php echo $this->get_field_id('get_names_events'); ?>" name="<?php echo $this->get_field_name('get_names_events'); ?>" style="width:225px">
		<?php
        global $wpdb,$post;
		$categories = get_categories('taxonomy=event-category&child_of=0&hide_empty=0'); 
			if($categories != ''){}
				foreach ( $categories as $category){ ?>
                    <option <?php if(esc_attr($get_names_events) == $category->term_id){echo 'selected';}?> value="<?php echo $category->term_id;?>" >
	                    <?php echo substr($category->name, 0, 20);	if ( strlen($category->name) > 20 ) echo "...";?>
                    </option>						
			<?php }?>
      </select>
  </label>
  </p>  
  <p>
  <label for="<?php echo $this->get_field_id('numevents'); ?>">
	  Number of Events: 
	  <input class="upcoming" id="<?php echo $this->get_field_id('numevents'); ?>" size="2" name="<?php echo $this->get_field_name('numevents'); ?>" type="text" value="<?php echo esc_attr($numevents); ?>" />
  </label>
  </p>  
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	$instance['get_names_events'] = $new_instance['get_names_events'];	
	$instance['numevents'] = $new_instance['numevents'];		
	
	
    return $instance;
  }
 
	function widget($args, $instance)
	{
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$get_names_events = isset( $instance['get_names_events'] ) ? esc_attr( $instance['get_names_events'] ) : '';
		$numevents = isset( $instance['numevents'] ) ? esc_attr( $instance['numevents'] ) : '';		
		if(!isset($numevents)){$numevents = '4';}
		// WIDGET display CODE Start
		echo $before_widget;		
		if (!empty($title))
			echo $before_title . $title . $after_title;
			global $wpdb, $post;
			//$term = get_term( $get_names_events, 'event-category' );
			if($get_names_events <> ''){
				$newterm = get_term_by('id', $get_names_events, 'event-category');
					$args = array(
						'posts_per_page'			=> $numevents,
						'post_type'					=> 'events',
						'post_status'				=> 'publish',
						'meta_key'					=> 'cs_event_from_date',
						'meta_value'				=> date('Y-m-d'),
						'meta_compare'				=> '>',
						'orderby'					=> 'meta_value',
						'order'						=> 'ASC',
						'tax_query' => array(
								array(
									'taxonomy' => 'event-category',
									'field' => 'term_id',
									'terms' => array( $get_names_events)
								) 
							)
						);
                    query_posts($args);?>
					<?php if ( have_posts() <> "" ) {
					?>
					<ul class="date-list">
					<?php
						$recent_counter = 0;
                        while ( have_posts() ): the_post();
							$recent_counter++;
							$cs_event_from_date = get_post_meta($post->ID, "cs_event_from_date", true);
							//$event_to_date = get_post_meta($instance['get_names_events'], "cs_event_to_date", true);
							$year_event = date("Y", strtotime($cs_event_from_date));
							$month_event = date("m", strtotime($cs_event_from_date));
							$month_event_c = date("M", strtotime($cs_event_from_date));							
							$date_event = date("d", strtotime($cs_event_from_date));
							$cs_event_meta = get_post_meta($post->ID, "cs_event_meta", true);
							$date_format = get_option( 'date_format' );
							$time_format = get_option( 'time_format' );							
							if ( $cs_event_meta <> "" ) {
								$cs_event_meta = new SimpleXMLElement($cs_event_meta);
							}			
							$time_left = date("H,i,s", strtotime("$cs_event_meta->event_start_time"));
							$new_excerpt = strip_tags(trim(preg_replace('/\[(.*?)\]/ ','', get_the_content())));
								if($recent_counter == 1){?>
									<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/scripts/jquery.countdown.js"></script>
                                    <script>
                                        $(function () {
                                                var austDay = new Date();
                                                austDay = new Date(<?php echo $year_event;?>, <?php echo $month_event;?>-1, <?php echo $date_event;?>,<?php echo $time_left?>)
                                                $('#defaultCountdown<?php echo $post->ID;?>').countdown({until: austDay,layout:
												'<div id="timer">' + ''+
													  '<div id="timer_days" class="timer_numbers">{dnn}</div>'+
													  '<div id="timer_hours" class="timer_numbers">{hnn}</div>'+ 
													  '<div id="timer_mins" class="timer_numbers">{mnn}</div>'+
													  '<div id="timer_seconds" class="timer_numbers">{snn}</div>'+
													'<div id="timer_labels">'+
														'<div id="timer_days_label" class="timer_labels">days</div>'+
														'<div id="timer_hours_label" class="timer_labels">hours</div>'+
														'<div id="timer_mins_label" class="timer_labels">mins</div>'+
														'<div id="timer_seconds_label" class="timer_labels">secs</div>'+
													'</div>'+							
												'</div>'
												});
                                                $('#year').text(austDay.getFullYear());
                                        });                
                                    </script>
									<!-- Events Widget Start -->
									
										<div class="counter-sec">
											<h4 class="colr"><?php echo substr(get_the_title(), 0, 15); if ( strlen(get_the_title()) > 15 ) echo "...";?></h4>
											<div id="defaultCountdown<?php echo $post->ID;?>"></div>
											<div class="clear"></div>
											<div class="current-item">
												<div class="date">
													<h1 class="colr bold"><?php echo $date_event;?></h1>
													<h3 class="colr"><?php echo $month_event_c;?></h3>
												</div>
												<div class="eve-desc">
													<h5><a href="<?php echo get_permalink();?>" class="txthover"><?php echo get_the_title();?></a></h5>
													<p>
													
														<?php echo $month_event_c;?> <?php echo $date_event;?>, <?php echo date( get_option("time_format"), strtotime($cs_event_meta->event_start_time) );?> to <?php echo date( get_option("time_format"), strtotime($cs_event_meta->event_end_time) );?><br />
														<!--<?php echo substr($new_excerpt, 0, 15); if ( strlen($new_excerpt) > 15 ) echo "...";?>-->
													</p>
												</div>
											</div>
										</div>
										<?php }else{?>
											<li>
												<div class="date">
													<h1 class="colr bold"><?php echo $date_event;?></h1>
													<h3 class="colr"><?php echo $month_event_c;?></h3>
												</div>
												<div class="eve-desc">
													<h5><a href="<?php echo get_permalink()?>" class="txthover"><?php echo substr(get_the_title(), 0, 15); if ( strlen(get_the_title()) > 15 ) echo "...";?></a></h5>
													<p>
														<?php echo $month_event_c;?> <?php echo $date_event;?>, <?php echo date( get_option("time_format"), strtotime($cs_event_meta->event_start_time) );?> to <?php echo date( get_option("time_format"), strtotime($cs_event_meta->event_end_time) );?><br />
														<!--<?php echo substr($new_excerpt, 0, 15); if ( strlen($new_excerpt) > 15 ) echo "...";?>-->
													</p>
												</div>
											</li>
									<!-- Events Widget End -->		
								<?php }					
						endwhile;?>						
					</ul>
				<div class="sec-bot-bar">
					<a class="view-cal" href="<?php echo get_term_link($newterm->slug, 'event-category');?>">VIEW ALL EVENTS</a>
				</div>
					<?php }else{
							echo '<h4>There is no upcomming event to display.</h4>';
						}
			}	// endif of Category Selection
			echo $after_widget;	// WIDGET display CODE End
		}
	}
add_action( 'widgets_init', create_function('', 'return register_widget("upcomingevents_count_recent");') );
?>