<?php
class contact_us_widget extends WP_Widget
{
  function contact_us_widget()
  {
    $widget_ops = array('classname' => 'latest-videos', 'description' => 'Please paste embed code of Latest Video.' );
    $this->WP_Widget('contact_us_widget', 'ChimpS : Contact footer widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	$contact_textarea = isset( $instance['contact_textarea'] ) ? esc_attr( $instance['contact_textarea'] ) : '';
	$footer_logo_url = isset( $instance['footer_logo_url'] ) ? esc_attr( $instance['footer_logo_url'] ) : '';	?>
  <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
		Title: 
	  <input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size="40" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p> 
  <p>
  <label for="<?php echo $this->get_field_id('contact_textarea'); ?>">
		Description: <br />
      <textarea rows="3"  cols="35" class="upcoming" id="<?php echo $this->get_field_id('contact_textarea'); ?>" name="<?php echo $this->get_field_name('contact_textarea'); ?>"><?php echo esc_attr($contact_textarea); ?></textarea>
  </label>
  </p>   
  <p>
  <label for="<?php echo $this->get_field_id('footer_logo_url'); ?>">
		Footer Logo Url:<br />
      <input class="upcoming" id="<?php echo $this->get_field_id('footer_logo_url'); ?>" size="40" name="<?php echo $this->get_field_name('footer_logo_url'); ?>" type="text" value="<?php echo esc_attr($footer_logo_url); ?>" />
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['contact_textarea'] = $new_instance['contact_textarea'];
    $instance['footer_logo_url'] = $new_instance['footer_logo_url'];		
    return $instance;
  }
 
	function widget($args, $instance)
	{
		extract($args, EXTR_SKIP);

		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$contact_textarea = empty($instance['contact_textarea']) ? ' ' : apply_filters('widget_title', $instance['contact_textarea']);
		$footer_logo_url = empty($instance['footer_logo_url']) ? ' ' : apply_filters('widget_title', $instance['footer_logo_url']);
		echo $before_widget;	
		if(strlen($title) <> 1){
		// WIDGET display CODE Start
		if (!empty($title))
			//echo $before_title;
			//echo $title;
			//echo $after_title;
			global $wpdb, $post;?>
				<?php if($footer_logo_url <> ''){?><a href="#"><img src="<?php echo $footer_logo_url;?>" alt="" /></a><?php }?>
                	<?php echo '<p>'.html_entity_decode($contact_textarea).'</p>';
					}else{?>
                    <h4>There is no data to display.</h4>
                    <?php }?>
	<?php echo $after_widget; ?>
		<?php } 
				}
add_action( 'widgets_init', create_function('', 'return register_widget("contact_us_widget");') );?>
