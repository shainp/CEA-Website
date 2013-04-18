<?php
class tabs_widget_show extends WP_Widget
{
  function tabs_widget_show()
  {
    $widget_ops = array('classname' => 'tabs-widget', 'description' => 'Select Widgets from options for tabs' );
    $this->WP_Widget('tabs_widget_show', 'ChimpS : Tabs Widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];	
	$get_default_widget_one = isset( $instance['get_default_widget_one'] ) ? esc_attr( $instance['get_default_widget_one'] ) : '';	
	
	$title_widget_two = isset( $instance['title_widget_two'] ) ? esc_attr( $instance['title_widget_two'] ) : '';		
	$get_default_widget_two = isset( $instance['get_default_widget_two'] ) ? esc_attr( $instance['get_default_widget_two'] ) : '';	
?>
	
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">
          Title: 
          <input class="upcoming" size="40" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </label>
    </p>
    <br />    
    <p>
      <label for="<?php echo $this->get_field_id('get_default_widget_one'); ?>">
          Select Widget First Tab:
          <select id="<?php echo $this->get_field_id('get_default_widget_one'); ?>" name="<?php echo $this->get_field_name('get_default_widget_one'); ?>" style="width:225px">
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Archives'){echo 'selected';}?> value='WP_Widget_Archives'>Archives</option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Calendar'){echo 'selected';}?> value='WP_Widget_Calendar'>Calendar</option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Categories'){echo 'selected';}?> value='WP_Widget_Categories'>Categories</option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Links'){echo 'selected';}?> value='WP_Widget_Links'>Links</option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Meta'){echo 'selected';}?> value='WP_Widget_Meta'>Meta</option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Pages'){echo 'selected';}?> value='WP_Widget_Pages'>Pages</option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Recent_Comments'){echo 'selected';}?> value='WP_Widget_Recent_Comments'>Recent_Comments</option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Recent_Posts'){echo 'selected';}?> value='WP_Widget_Recent_Posts'>Recent_Posts</option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_RSS'){echo 'selected';}?> value='WP_Widget_RSS'>RSS</option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Search'){echo 'selected';}?> value='WP_Widget_Search'>Search</option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Tag_Cloud'){echo 'selected';}?> value='WP_Widget_Tag_Cloud'>Tag_Cloud</option>
                        <option <?php if(esc_attr($get_default_widget_one) == 'WP_Widget_Text'){echo 'selected';}?> value='WP_Widget_Text'>Text</option>
          </select>
      </label>
    </p>     
<br />
    <p>
        <label for="<?php echo $this->get_field_id('title_widget_two'); ?>">
          Title: 
          <input class="upcoming" size="40" id="<?php echo $this->get_field_id('title_widget_two'); ?>" name="<?php echo $this->get_field_name('title_widget_two'); ?>" type="text" value="<?php echo esc_attr($title_widget_two); ?>" />
        </label>
    </p>  
	<p>
	  <label for="<?php echo $this->get_field_id('get_default_widget_two'); ?>">
		  Select Widget Second Tab:
		  <select id="<?php echo $this->get_field_id('get_default_widget_two'); ?>" name="<?php echo $this->get_field_name('get_default_widget_two'); ?>" style="width:225px">
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Archives'){echo 'selected';}?> value='WP_Widget_Archives'>Archives</option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Calendar'){echo 'selected';}?> value='WP_Widget_Calendar'>Calendar</option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Categories'){echo 'selected';}?> value='WP_Widget_Categories'>Categories</option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Links'){echo 'selected';}?> value='WP_Widget_Links'>Links</option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Meta'){echo 'selected';}?> value='WP_Widget_Meta'>Meta</option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Pages'){echo 'selected';}?> value='WP_Widget_Pages'>Pages</option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Recent_Comments'){echo 'selected';}?> value='WP_Widget_Recent_Comments'>Recent_Comments</option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Recent_Posts'){echo 'selected';}?> value='WP_Widget_Recent_Posts'>Recent_Posts</option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_RSS'){echo 'selected';}?> value='WP_Widget_RSS'>RSS</option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Search'){echo 'selected';}?> value='WP_Widget_Search'>Search</option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Tag_Cloud'){echo 'selected';}?> value='WP_Widget_Tag_Cloud'>Tag_Cloud</option>
						<option <?php if(esc_attr($get_default_widget_two) == 'WP_Widget_Text'){echo 'selected';}?> value='WP_Widget_Text'>Text</option>
		  </select>
	  </label>
	</p>     	
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];		
    $instance['get_default_widget_one'] = $new_instance['get_default_widget_one'];		
    
	$instance['title_widget_two'] = $new_instance['title_widget_two'];			
	$instance['get_default_widget_two'] = $new_instance['get_default_widget_two'];				

    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);						
		$get_default_widget_one = isset( $instance['get_default_widget_one'] ) ? esc_attr( $instance['get_default_widget_one'] ) : '';				
		
		$title_widget_two = isset( $instance['title_widget_two'] ) ? esc_attr( $instance['title_widget_two'] ) : '';								
		$get_default_widget_two = isset( $instance['get_default_widget_two'] ) ? esc_attr( $instance['get_default_widget_two'] ) : '';
		
		echo $before_widget;	
		// WIDGET display CODE Start
						
		if (!empty($title))
			//echo $before_title;
			//echo $title;
			//echo $after_title;
			global $wpdb, $post;?>
			<div class="tab_menu_container">
				<ul id="tab_menu<?php echo $title.$get_default_widget_one;?>">  
					<li style="width:50%;"><a class="" rel="<?php echo $title.$get_default_widget_one;?>"><?php echo $title;?></a></li>
					<li style="width:49%;"><a class="current" rel="<?php echo $title_widget_two.$get_default_widget_two;?>"><?php echo $title_widget_two;?></a></li>
				</ul>
				<div class="clear"></div>
			</div>
			<!-- Tabs End -->
			<!-- Tabs Container Start -->
			<div class="tab_container">
				<div class="tab_container_in">                            
					<!-- Recent Tab Start -->
					<div id="<?php echo $title.$get_default_widget_one;?>" class="tab-list">
						<?php the_widget($get_default_widget_one);?>
					</div> 
					<!-- Recent Tab End -->
					<!-- Popular Tab Start -->
					<div id="<?php echo $title_widget_two.$get_default_widget_two;?>" class="tab-list">
						<?php the_widget($get_default_widget_two);?>
					</div>
				<!-- Popular Tab End -->
				<div class="clear"></div>
			</div>
		</div>
			<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/scripts/frontend/tabs.js"></script>
			<script>
				menuscript.definemenu("tab_menu<?php echo $title.$get_default_widget_one;?>", 0);
			</script>        
			<!-- Tabs Container End -->			
               <?php
	echo $after_widget;
		}
		
	}
add_action( 'widgets_init', create_function('', 'return register_widget("tabs_widget_show");') );?>