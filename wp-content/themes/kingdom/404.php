<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
       <div class="fullwidth">
           <div class="box blog">
                <div class="box-in">
                    <div class="page-not-found">
                        <div class="fourofuor"><img src="<?php echo get_template_directory_uri(); ?>/images/404.png" alt="404" /></div>
                    </div>
                </div>
            </div>    
        </div>
</div>
</div>
    <div class="clear"></div>
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>
<?php get_footer(); ?>