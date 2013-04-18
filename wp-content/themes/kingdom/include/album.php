<?php
	//adding columns start
    add_filter('manage_courses_posts_columns', 'album_columns_add');
		function album_columns_add($columns) {
			$columns['category'] = 'Category';
			$columns['author'] = 'Author';
			return $columns;
    }
    add_action('manage_courses_posts_custom_column', 'album_columns');
		function album_columns($name) {
			global $post;
			switch ($name) {
				case 'category':
					$categories = get_the_terms( $post->ID, 'course-category' );
						if($categories <> ""){
							$couter_comma = 0;
							foreach ( $categories as $category ) {
								echo $category->name;
								$couter_comma++;
								if ( $couter_comma < count($categories) ) {
									echo ", ";
								}
							}
						}
					break;
				case 'author':
					echo get_the_author();
					break;
			}
		}
	//adding columns end

	function cs_album_register() {
		$labels = array(
			'name' => __('Manage Courses','mytheme'),
			'add_new' => __('Add New Course', 'Add New'),
			'add_new_item' => __('Add New Course','mytheme'),
			'edit_item' => __('Edit Course','mytheme'),
			'new_item' => __('New Course Item','mytheme'),
			'view_item' => __('View Course Item','mytheme'),
			'search_items' => __('Search Course','mytheme'),
			'not_found' =>  __('Nothing found','mytheme'),
			'not_found_in_trash' => __('Nothing found in Trash','mytheme'),
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/album-icon.png',
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor','thumbnail', 'comments' )
		); 
        register_post_type( 'courses' , $args );
	}
		  $labels = array(
			'name' => __( 'Course Categories' ,'mytheme' ),
			'search_items' =>  __( 'Search Course Categories' ,'mytheme'),
			'edit_item' => __( 'Edit Course Category' ,'mytheme'), 
			'update_item' => __( 'Update Course Category' ,'mytheme'),
			'add_new_item' => __( 'Add New Course Category','mytheme' ),
			'menu_name' => __( 'Course Categories' ,'mytheme'),
		  ); 	
		  register_taxonomy('course-category',array('courses'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'course-category' ),
		  ));

	add_action('init', 'cs_album_register');

	// adding album meta info start
		add_action( 'add_meta_boxes', 'cs_meta_album_add' );
		function cs_meta_album_add()
		{  
			add_meta_box( 'cs_meta_album', 'Course Options', 'cs_meta_album', 'courses', 'normal', 'high' );
		}
		function cs_meta_album( $post ) {
			$cs_course = get_post_meta($post->ID, "cs_course", true);
			if ( $cs_course <> "" ) {
				$xmlObject = new SimpleXMLElement($cs_course);
					$course_date = $xmlObject->course_date;
					$course_eligibility = $xmlObject->course_eligibility;
					$course_apply = $xmlObject->course_apply;
					$course_social = $xmlObject->course_social;
			}
			else {
				$course_date = '';
				$course_eligibility = '';
				$course_apply = '';
				$course_social = '';
			}
?>
            <div class="page-wrap page-opts left" style="overflow:hidden; position:relative;">
            <script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/jquery.scrollTo-min.js"></script>
                <div class="option-sec" style="margin-bottom:0;">
                    <div class="opt-conts">
                    	<ul class="form-elements">
                            <li class="to-label"><label>Start Date</label></li>
                            <li class="to-field">
                                    <!--date picker start-->
                                        <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/scripts/date_range/jquery.ui.datepicker.css">
                                        <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/scripts/date_range/jquery.ui.theme.css">
                                        <script>
                                        $(function() {
                                            $( "#course_date" ).datepicker({
                                                defaultDate: "+1w",
												dateFormat: "yy-mm-dd",
                                                changeMonth: true,
                                                numberOfMonths: 1,
                                                //onSelect: function( selectedDate ) {
                                                    //$( "#cs_event_to_date" ).datepicker( "option", "minDate", selectedDate );
                                                //}
                                            });
                                        });
                                        </script>
                                    <!--date picker end-->
                                <input type="text" id="course_date" name="course_date" value="<?php if ($course_date=="") echo gmdate("Y-m-d"); else echo $course_date?>" />
                            </li>
                            <li class="to-desc"><p>Put start date</p></li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label>Eligibility</label></li>
                            <li class="to-field"><input type="text" name="course_eligibility" value="<?php echo htmlspecialchars($course_eligibility)?>" /></li>
                            <li class="to-desc"><p>Put eligibility types</p></li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label>Apply Now URL</label></li>
                            <li class="to-field"><input type="text" name="course_apply" value="<?php echo htmlspecialchars($course_apply)?>" /></li>
                            <li class="to-desc"><p>Enter the full URL</p></li>
                        </ul>
                        <ul class="form-elements noborder">
                            <li class="to-label"><label>Social Sharing</label></li>
                            <li class="to-field">
                                <select name="course_social" class="dropdown">
                                    <option <?php if($course_social=="Yes")echo "selected" ?> >Yes</option>
                                    <option <?php if($course_social=="No")echo "selected" ?> >No</option>
                                </select>
                            </li>
                            <li class="to-desc"><p>Make Social Sharing On/Off</p></li>
                        </ul>
                    </div>
					<div class="clear"></div>
                </div>
                
                <div class="to-tables" style="margin-top: 10px;">
                    <div id="add_track" class="poped-up">
                        <div class="opt-head">
                            <h6>Add Subject</h6>
                            <a href="javascript:closetrack('add_track')" class="closeit">&nbsp;</a>
                        </div>
                        <ul class="form-elements">
                            <li class="to-label"><label>Subject Title</label></li>
                            <li class="to-field"><input type="text" id="subject_title_dummy" name="subject_title_dummy" value="Subject Title" /></li>
                            <li class="to-desc"><p>Put Subject title</p></li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label>Instructor</label></li>
                            <li class="to-field"><input type="text" id="subject_instructor" name="subject_instructor" /></li>
                            <li class="to-desc"><p>Put Instructor Name</p></li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label>Credit Hours</label></li>
                            <li class="to-field"><input type="text" id="subject_credit" name="subject_credit" /></li>
                            <li class="to-desc"><p>Put The Total Credit Hours</p></li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label>Detail Of the Subject(URL)</label></li>
                            <li class="to-field"><input type="text" id="subject_detail" name="subject_detail" /></li>
                            <li class="to-desc"><p>Put a URL for the detail of this subject</p></li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"></li>
                            <li class="to-field"><input type="button" value="Add Subject to List" onclick="add_track_to_list()" /></li>
                        </ul>
                    </div>

            <script>
                var counter_track = 0;
                function add_track_to_list(){
                    counter_track++;
                    var dataString = 'counter_track=' + counter_track + 
                                    '&subject_title=' + jQuery("#subject_title_dummy").val() +
                                    '&subject_instructor=' + jQuery("#subject_instructor").val() +
                                    '&subject_credit=' + jQuery("#subject_credit").val() + 
                                    '&subject_detail=' + jQuery("#subject_detail").val() ;
                    jQuery("#loading").html("<img src='<?php echo get_template_directory_uri()?>/images/admin/ajax_loading.gif' />");
                        jQuery.ajax({
                            type:'POST',
                            url: '<?php echo get_template_directory_uri()?>/include/album_track.php',
                            data: dataString,
                            success: function(response) {
                                jQuery("#total_tracks").append(response);
                                jQuery("#loading").html("");
                                closetrack('add_track');
                                    jQuery("#subject_title_dummy").val("Subject Title");
                                    jQuery("#subject_instructor").val("");
                                    jQuery("#subject_credit").val("");
                                    jQuery("#subject_detail").val("");
                            }
                        });
                }
            
				$(document).ready(function() {
					$("#total_tracks").sortable({
						cancel : 'li div.poped-up',
					});
				});
				</script>
                    <h5>
                        <span style="padding-top:5px; float:left;">Subjects</span> 
                        <a href="javascript:addtrack('add_track')" class="button right">Add Subject</a>
                    </h5>
                    <ul class="to-rows to-head">
                        <li class="album-title">Subject Title</li>
                        <li class="actions">Actions</li>
                    </ul>
                        <ul id="total_tracks">
                            <?php
                            $counter_track = $post->ID;
					        if ( $cs_course <> "" ) {
								foreach ( $xmlObject as $track ){
									if ( $track->getName() == "subject" ) {
										$subject_title = $track->subject_title;
										$subject_instructor = $track->subject_instructor;
										$subject_credit = $track->subject_credit;
										$subject_detail = $track->subject_detail;
										$counter_track++;
										include(TEMPLATEPATH."/include/album_track.php");
									}
								}
							}
                            ?>
                        </ul>
                        
	                </div>
				<?php include("inc_meta_layout.php")?>
                <input type="hidden" name="course_meta_form" value="1" />
                <div class="clear"></div>
            </div>
            <div class="clear"></div>

<?php
		}

		if ( isset($_POST['course_meta_form']) and $_POST['course_meta_form'] == 1 ) {
			if ( empty($_POST['cs_layout']) ) $_POST['cs_layout'] = 'none';
			add_action( 'save_post', 'cs_meta_album_save' );  
			function cs_meta_album_save( $post_id )
			{  
				$sxe = new SimpleXMLElement("<course></course>");
					if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
					if ( empty($_POST["course_date"]) ) $_POST["course_date"] = "";
					if ( empty($_POST["course_eligibility"]) ) $_POST["course_eligibility"] = "";
					if ( empty($_POST["course_apply"]) ) $_POST["course_apply"] = "";
					if ( empty($_POST["course_social"]) ) $_POST["course_social"] = "";
						$sxe = save_layout_xml($sxe);
								$sxe->addChild('course_date', $_POST['course_date'] );
								$sxe->addChild('course_eligibility', htmlspecialchars($_POST['course_eligibility']) );
								$sxe->addChild('course_apply', htmlspecialchars($_POST['course_apply']) );
								$sxe->addChild('course_social', $_POST['course_social'] );
							$counter = 0;
							if ( isset($_POST['subject_title']) ) {
								foreach ( $_POST['subject_title'] as $count ){
									$track = $sxe->addChild('subject');
										$track->addChild('subject_title', htmlspecialchars($_POST['subject_title'][$counter]) );
										$track->addChild('subject_instructor', htmlspecialchars($_POST['subject_instructor'][$counter]) );
										$track->addChild('subject_credit', htmlspecialchars($_POST['subject_credit'][$counter]) );
										$track->addChild('subject_detail', htmlspecialchars($_POST['subject_detail'][$counter]) );
										$counter++;
								}
							}
				update_post_meta( $post_id, 'cs_course', $sxe->asXML() );
			}
		}
		// adding album meta info end
?>