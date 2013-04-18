<?php

class princple_msg extends WP_Widget

{

  function princple_msg()

  {

    $widget_ops = array('classname' => 'princple-msg', 'description' => 'Welcome box display beside slider.' );

    $this->WP_Widget('princple_msg', 'ChimpS : Welcome Box', $widget_ops);

  }

 

  function form($instance)

  {

    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );

    $title = $instance['title'];

	$widgettitle = isset( $instance['widgettitle'] ) ? esc_attr( $instance['widgettitle'] ) : '';		

	$txt_img = isset( $instance['txt_img'] ) ? esc_attr( $instance['txt_img'] ) : '';	

	$txt_description = isset( $instance['txt_description'] ) ? esc_attr( $instance['txt_description'] ) : '';

	$textcounter = isset( $instance['textcounter'] ) ? esc_attr( $instance['textcounter'] ) : '';

	$btn_link_one = isset( $instance['btn_link_one'] ) ? esc_attr( $instance['btn_link_one'] ) : '';

?>

  <p>

  <label for="<?php echo $this->get_field_id('title'); ?>">

	  Title: 

	  <input class="upcoming" size="40" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

  </label>

  </p>

	<p>

		<label for="<?php echo $this->get_field_id('widgettitle'); ?>">

		  Widget Title: 

		  <input class="upcoming" size="40" id="<?php echo $this->get_field_id('widgettitle'); ?>" name="<?php echo $this->get_field_name('widgettitle'); ?>" type="text" value="<?php echo esc_attr($widgettitle); ?>" />

		</label>

	</p>    

  <p>

  <label for="<?php echo $this->get_field_id('txt_img'); ?>">

	  Image URL: 

	  <input class="upcoming" size="40" id="<?php echo $this->get_field_id('txt_img'); ?>" name="<?php echo $this->get_field_name('txt_img'); ?>" type="text" value="<?php echo esc_attr($txt_img); ?>" />

  </label>

  </p>  

  <p>

  <label for="<?php echo $this->get_field_id('txt_description'); ?>">

	  Text Description: 

	<textarea rows="3"  cols="35" class="upcoming" id="<?php echo $this->get_field_id('txt_description'); ?>" name="<?php echo $this->get_field_name('txt_description'); ?>"><?php echo esc_attr($txt_description); ?></textarea>

  </label>

  </p>  

  <p>

  <label for="<?php echo $this->get_field_id('textcounter'); ?>">

	  Number of Text:

	  <input class="upcoming" size="2" id="<?php echo $this->get_field_id('textcounter'); ?>" name="<?php echo $this->get_field_name('textcounter'); ?>" type="text" value="<?php echo esc_attr($textcounter); ?>" />

  </label>

  </p>

  <br />

<?php

  }

 

  function update($new_instance, $old_instance)

  {

    $instance = $old_instance;

    $instance['title'] = $new_instance['title'];

	$instance['widgettitle'] = $new_instance['widgettitle'];	

    $instance['txt_img'] = $new_instance['txt_img'];		

    $instance['txt_description'] = $new_instance['txt_description'];	

	$instance['textcounter'] = $new_instance['textcounter'];

    return $instance;

  }

 

	function widget($args, $instance)

	{

	

		extract($args, EXTR_SKIP);

		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

		$widgettitle = isset( $instance['widgettitle'] ) ? esc_attr( $instance['widgettitle'] ) : '';						

		$txt_img = isset( $instance['txt_img'] ) ? esc_attr( $instance['txt_img'] ) : '';				

		$txt_description = isset( $instance['txt_description'] ) ? esc_attr( $instance['txt_description'] ) : '';		

		$textcounter = isset( $instance['textcounter'] ) ? esc_attr( $instance['textcounter'] ) : '';		

		echo $before_widget;	

		// WIDGET display CODE Start

		if (!empty($title))

			//echo $before_title;

			//echo $title;

			//echo $after_title;

			global $wpdb, $post;

			if(strlen($textcounter) < 1){$textcounter = 95;}

				if(strlen($title) <> 1){

			?>

            	<!-- Principle Message Start -->

                    <div class="thumb">

						<a><img src="<?php echo $txt_img;?>" alt="<?php echo $title;?>" /></a>

                        <h4 class="white"><?php echo $title;?></h4>

                    </div>

                    <div class="clear"></div>

                    <div class="box-in">

                        <h4 class="colr"><?php echo $widgettitle;?></h4>

                        <p>

                            <?php echo substr($txt_description, 0, $textcounter);	if ( strlen($txt_description) > $textcounter ) echo "...";?>

                        </p>

                    </div>

                <!-- Principle Message End -->

                    <?php

					 }else{

						 echo '<h4>There is no content to Show.</h4>';

						 }

	echo $after_widget;

		}

		

	}

add_action( 'widgets_init', create_function('', 'return register_widget("princple_msg");') );?>