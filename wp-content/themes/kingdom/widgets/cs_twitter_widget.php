<?php

class cs_twitter_widget extends WP_Widget

{

  function cs_twitter_widget()

  {

    $widget_ops = array('classname' => 'tweets-widget', 'description' => 'Twitter Widget feeds' );

    $this->WP_Widget('cs_twitter_widget', 'ChimpS : Twitter Widget', $widget_ops);

  }

 

  function form($instance)

  {

    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );

    $title = $instance['title'];

	$username = isset( $instance['username'] ) ? esc_attr( $instance['username'] ) : '';	

	$numoftweets = isset( $instance['numoftweets'] ) ? esc_attr( $instance['numoftweets'] ) : '';	

?>

	<p>

		<label for="<?php echo $this->get_field_id('title'); ?>">

			<span>Widget Title</span><br />

			<input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size="40" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

		</label>

	</p><br />

	<div class="clear"></div>

	<br />

	<p>

		<label for="<?php echo $this->get_field_id('username'); ?>">

			<span>Twitter Username </span><br />

			<small>http://www.twitter.com/your-username  - Only {your-username}</small>

			<input class="upcoming" id="<?php echo $this->get_field_id('username'); ?>" size="40" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr($username); ?>" />

		</label>

	</p><br />
    	<div class="clear"></div>

	<br />
<p>
  <label for="<?php echo $this->get_field_id('numoftweets'); ?>">
	  <span>Num of Tweets: </span>
	  <input class="upcoming" id="<?php echo $this->get_field_id('numoftweets'); ?>" size="2" name="<?php echo $this->get_field_name('numoftweets'); ?>" type="text" value="<?php echo esc_attr($numoftweets); ?>" />
      <div class="clear"></div>
  </label>
  </p>   
      <div class="clear"></div>        

<?php

  }

 

  function update($new_instance, $old_instance)

  {

    $instance = $old_instance;

    $instance['title'] = $new_instance['title'];

	$instance['username'] = $new_instance['username'];	

	$instance['numoftweets'] = $new_instance['numoftweets'];	



    return $instance;

  }

 

	function widget($args, $instance)

	{

		extract($args, EXTR_SKIP);

		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

		$username = empty($instance['username']) ? ' ' : apply_filters('widget_title', $instance['username']);

		$numoftweets = empty($instance['numoftweets']) ? ' ' : apply_filters('widget_title', $instance['numoftweets']);
		if(!is_numeric($numoftweets)){$numoftweets = 1;}
	 
		
		// WIDGET display CODE Start

		if (!empty($title))

			echo $before_widget;

			echo $before_title .$title. $after_title;

//			echo '<div class="tweet-banners"><a href="#" class="thumb"><img src="'.$instance['t_img_url'].'" alt="" /><span>&nbsp;</span></a>';

//			echo "<div class='scroll-sec'>";

			if(strlen($username) > 1){
				//echo isset($numoftweets); 
				?>

			<!-- Twitter Scroll Start -->

                <div class="box-in" id="tweet-links<?php echo $username;?>"></div>

                <div class="clear"></div>

			<!-- Twitter Scroll End -->

			<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/frontend/jquery.tweetable.js"></script>

			<script type="text/javascript">

                    $(function(){

                        $('#tweet-links<?php echo $username;?>').tweetable({username: '<?php echo $username;?>', time: true, limit: <?php echo $numoftweets;?>, replies: true, position: 'append'});

                    });

            </script>

            <!-- Twitter End -->	

            <a href="http://www.twitter.com/<?php echo $username;?>" class="follow-tweet">Follow Us On Twitter</a>

			<?php }else{ ?>

                            <h4>No User information given.</h4>

<?php

			}?>

			<?php echo $after_widget;

		// WIDGET display CODE End

		}

	}

add_action( 'widgets_init', create_function('', 'return register_widget("cs_twitter_widget");') );?>