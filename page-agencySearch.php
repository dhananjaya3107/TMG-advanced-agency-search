<?php
/**
 * Template Name: Agency search
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
get_header(); ?>

<?php 

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				
		$service =  $_POST['service'];
		$language = $_POST['language'];
		$location = $_POST['location'];
		
		$match = preg_split('#(?<=\d)(?=[a-z])#i', (string)$service);

		$service_term = (int)$match[0];
		$service_tax = (string)$match[1];
		
		$term_list_args = array( 'hide_empty=0' );		
		$language_terms = get_terms( 'locations', $term_list_args );
				
		if($language == null && $location == null){
			
			$language_array = array();
			$language_terms = get_terms( 'language', $term_list_args );
			foreach($language_terms as $language_term){
				$language_array[] = $language_term->term_id;
			}	
			
			$location_array = array();
			$location_terms = get_terms( 'locations', $term_list_args );
			foreach($location_terms as $location_term){
				$location_array[] = $location_term->term_id;
			}
			
			$tax_args['tax_query'] = array (
				'relation' => 'AND',
				array (
					'taxonomy' => $service_tax,
					'terms' => array( $service_term ),
					'operator' => 'IN',
					'include_children' => false,
				),
				array (
					'taxonomy' => 'language',
					'terms' => $language_array,
					'operator' => 'IN',
					'include_children' => false,
				),
				array (
					'taxonomy' => 'locations',
					'terms' => $location_array,
					'operator' => 'IN',
					'include_children' => false,
				)				
			);
			
		}
		elseif($language == null && $location != null){
			$language_array = array();
			$language_terms = get_terms( 'language', $term_list_args );
			foreach($language_terms as $language_term){
				$language_array[] = $language_term->term_id;
			}
			
			$tax_args['tax_query'] = array (
				'relation' => 'AND',
				array (
					'taxonomy' => $service_tax,
					'terms' => array( $service_term ),
					'operator' => 'IN',
					'include_children' => false,
				),
				array (
					'taxonomy' => 'language',
					'terms' => $language_array,
					'operator' => 'IN',
					'include_children' => false,
				),
				array (
					'taxonomy' => 'locations',
					'terms' => array( $location ),
					'operator' => 'IN',
					'include_children' => false,
				)				
			);
			
		}
		elseif($language != null && $location == null){
			$location_array = array();
			$location_terms = get_terms( 'locations', $term_list_args );
			foreach($location_terms as $location_term){
				$location_array[] = $location_term->term_id;
			}
			
			$tax_args['tax_query'] = array (
				'relation' => 'AND',
				array (
					'taxonomy' => $service_tax,
					'terms' => array( $service_term ),
					'operator' => 'IN',
					'include_children' => false,
				),
				array (
					'taxonomy' => 'language',
					'terms' => array( $language ),
					'operator' => 'IN',
					'include_children' => false,
				),
				array (
					'taxonomy' => 'locations',
					'terms' => $location_array,
					'operator' => 'IN',
					'include_children' => false,
				)				
			);
			
		}
		else{
			
			$tax_args['tax_query'] = array (
				'relation' => 'AND',
				array (
					'taxonomy' => $service_tax,
					'terms' => array( $service_term ),
					'operator' => 'IN',
					'include_children' => false,
				),
				array (
					'taxonomy' => 'language',
					'terms' => array( $language ),
					'operator' => 'IN',
					'include_children' => false,
				),
				array (
					'taxonomy' => 'locations',
					'terms' => array( $location ),
					'operator' => 'IN',
					'include_children' => false,
				)				
			);
			
		}
		
	}

?>

<div class="agency-search-hero">  
	<div class="container">
		<h1><?php the_title(); ?></h1>
		
		<?php if ( is_user_logged_in() ) : ?>
		<div class="agency-search-form">
			<form class="form-inline" action="" method="post" id="search-form">
				<div class="form-group">
					<label for="email">Services:</label>
					<select class="form-control" name="service" id="service">
						<option value="" disabled selected>Select a service</option>
						<?php
							$args = array( 'hide_empty=0' );
	 
							$primary_terms = get_terms( 'primary-service', $args );
							$core_terms = get_terms( 'core-service', $args );
							$aspirational_terms = get_terms( 'aspirational-service', $args );
							
							if ( ! empty( $primary_terms ) && ! is_wp_error( $primary_terms ) ) {
								$count = count( $primary_terms );
								$i = 0;
								//$term_list = '<p class="my_term-archive">';
								foreach ( $primary_terms as $term ) {
									$i++;
									$term_list .= '<option value="' . $term->term_id . $term->taxonomy . '">' . $term->name . '</option>';
									if ( $count != $i ) {
										$term_list .= ' &middot; ';
									}
								}								
							}
							if ( ! empty( $core_terms ) && ! is_wp_error( $core_terms ) ) {
								$count = count( $core_terms );
								$i = 0;
								//$term_list = '<p class="my_term-archive">';
								foreach ( $core_terms as $term ) {
									$i++;
									$term_list .= '<option value="' . $term->term_id . $term->taxonomy . '">' . $term->name . '</option>';
									if ( $count != $i ) {
										$term_list .= ' &middot; ';
									}
								}								
							}
							if ( ! empty( $aspirational_terms ) && ! is_wp_error( $aspirational_terms ) ) {
								$count = count( $aspirational_terms );
								$i = 0;
								//$term_list = '<p class="my_term-archive">';
								foreach ( $aspirational_terms as $term ) {
									$i++;
									$term_list .= '<option value="' . $term->term_id . $term->taxonomy . '">' . $term->name . '</option>';
									if ( $count != $i ) {
										$term_list .= ' &middot; ';
									}
								}								
							}							
							echo $term_list;
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="email">Languages:</label>
					<select class="form-control" name="language">
						<option value="" disabled selected>Select a language</option>
						<?php
							$args = array( 'hide_empty=0' );
	 
							$language_terms = get_terms( 'language', $args );
							
							if ( ! empty( $language_terms ) && ! is_wp_error( $language_terms ) ) {
								$count = count( $language_terms );
								$i = 0;
								//$term_list = '<p class="my_term-archive">';
								foreach ( $language_terms as $language ) {
									$i++;
									$language_list .= '<option value="'.$language->term_id.'">' . $language->name . '</option>';
									if ( $count != $i ) {
										$language_list .= ' &middot; ';
									}
								}								
							}							
							echo $language_list;
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="email">Location:</label>
					<select class="form-control" name="location">
						<option value="" disabled selected>Select a location</option>
						<?php
							$args = array( 'hide_empty=0' );
	 
							$location_terms = get_terms( 'locations', $args );
							
							if ( ! empty( $location_terms ) && ! is_wp_error( $location_terms ) ) {
								$count = count( $location_terms );
								$i = 0;
								//$term_list = '<p class="my_term-archive">';
								foreach ( $location_terms as $location ) {
									$i++;
									$location_list .= '<option value="'.$location->term_id.'">' . $location->name . '</option>';
									if ( $count != $i ) {
										$location_list .= ' &middot; ';
									}
								}								
							}							
							echo $location_list;
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="email">&nbsp;</label>
					<button type="submit" class="btn btn-default" id="search-form-submit">Search</button>
				</div>				
			</form>
		</div>
		
	<?php endif; ?>
		
	</div>   	
</div>
   <div class="container agency-searchlpcontent">
   			
		<?php global $user_ID, $user_identity; get_currentuserinfo(); if (!$user_ID) { ?>
		
		  <div class="subtitle">Login to access agency search page</div>
		<div class="agency-search-form-wrap">
		  <form method="post" action="<?php bloginfo('url') ?>/wp-login.php" class="wp-user-form form-horizontal">
			<div class="form-group">
			  <label class="control-label col-sm-2" for="email"><?php _e('Username'); ?>:</label>
			  <div class="col-sm-10">
				<input type="text" class="form-control" name="log" value="<?php echo esc_attr(stripslashes($user_login)); ?>" id="user_login" />
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-2" for="pwd"><?php _e('Password'); ?>:</label>
			  <div class="col-sm-10">          
				<input type="password" class="form-control" name="pwd" value="" id="user_pass" />
			  </div>
			</div>
			<div class="form-group">        
			  <div class="col-sm-offset-2 col-sm-10">
				<div class="checkbox">
				  <label><input type="checkbox" name="rememberme" value="forever" checked="checked" id="rememberme" /> Remember me</label>
				</div>
			  </div>
			</div>
			<div class="form-group">        
			  <div class="col-sm-offset-2 col-sm-10">
				<?php do_action('login_form'); ?>
				<input type="submit" name="user-submit" value="<?php _e('Login'); ?>" class="user-submit btn btn-default agency-search-login-submit" />
				<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
				<input type="hidden" name="user-cookie" value="1" />
			  </div>
			</div>
		  </form>	
		</div>

		<?php } else { // is logged in ?>
		
		
		
		<?php
							
			query_posts($tax_args);
			
			echo "<h2>Primary</h2>";
			
			if ( have_posts() ) :
			$primary_count = 0;
				while ( have_posts() ) : the_post(); global $post;				
			$inc = $wp_query->post_count;				
			if($service_tax == "primary-service" && $post->ID != 2824) : 
			$primary_count++;
		?>
			<div class="agency-searchitem">
				<div class="col1">
					<?php echo $primary_count; ?>.
				</div>	
				<div class="col2">
					<h3> <?php the_title(); ?></h3>
					<div class="agency-searchstatus"></div>
					<div class="agency-searchanswer hidden tvs">
					
						<div class="media agency-search-agency-data">
							<div class="media-left media-middle">
							  <img src="<?php the_post_thumbnail_url(); ?>" class="media-object pull-left" alt="<?php echo get_post_meta($post->ID, '_wp_attachment_image_alt', true); ?>" />
							</div>
							<div class="media-body">
							  <p><?php echo get_the_excerpt(); ?> <small><a href="<?php the_permalink(); ?>">view agency <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></small></p>
							</div>
						</div>
						
						<div class="media agency-search-agency-data-contact">
							<div class="media-left">
							  <h4>Get in touch</h4>
							</div>
							<div class="media-body">
							<?php
								// check if the repeater field has rows of data
								if( have_rows('contact_section') ):
							?>
								<div class="agency-contact">
									<?php
										// loop through the rows of data
										while ( have_rows('contact_section') ) : the_row();
									?>
										<p><?php the_sub_field('address'); ?></p>
										<p><?php the_sub_field('phone_no'); ?></p>
										<p>
											<a href="mailto:<?php the_sub_field('email'); ?>"><?php the_sub_field('email'); ?></a><br>
											<strong><a href="http://<?php the_sub_field('website'); ?>" target="_blank"><?php the_sub_field('website'); ?></a></strong>
										</p>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
							</div>
						</div>
												
						<div class="agency-searchshare">
							Find this useful? Share:<br/>
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?=the_permalink()?>" target="_blank" class="fbagency-searchshare"></a>
							<a href="https://twitter.com/home?status=<?=the_permalink()?>" target="_blank"  class="twagency-searchshare"></a>
							<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?=the_permalink()?>&title=&summary=&source=" target="_blank"  class="lnagency-searchshare"></a>
						</div>
					</div>   	   			
				</div>
   	   		</div>
		<?php 
			endif; 
				endwhile;
			endif;		
			wp_reset_query();	
			if($primary_count == 0): 
					echo '<div class="subtitle">No Agencies found !</div>';		
			endif;				
		?>
		<hr>
		<?php 		
			echo "<h2>Core</h2>";

			query_posts($tax_args);
			
			if ( have_posts() ) :
			$core_count = 0;
				while ( have_posts() ) : the_post(); global $post;				
			$inc = $wp_query->post_count;
			if($service_tax == "core-service" && $post->ID != 2824) : 
			$core_count++;
		?>
			<div class="agency-searchitem">
				<div class="col1">
					<?php echo $core_count; ?>.
				</div>	
				<div class="col2">
					<h3> <?php the_title(); ?></h3>
					<div class="agency-searchstatus"></div>
					<div class="agency-searchanswer hidden tvs">
						<?php the_excerpt(); ?>
						<div class="agency-searchshare">
						Find this useful? Share:<br/>
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?=the_permalink()?>" target="_blank" class="fbagency-searchshare"></a>
						<a href="https://twitter.com/home?status=<?=the_permalink()?>" target="_blank"  class="twagency-searchshare"></a>
						<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?=the_permalink()?>&title=&summary=&source=" target="_blank"  class="lnagency-searchshare"></a>
						</div>
					</div>   	   			
				</div>
   	   		</div>
		<?php 
			endif; 
				endwhile;
			endif;		
			wp_reset_query();
			if($core_count == 0): 
					echo '<div class="subtitle">No Agencies found !</div>';		
			endif;			
		?>
		<hr>
		<?php 		
			echo "<h2>Aspirational</h2>";
			
			query_posts($tax_args);
			
			if ( have_posts() ) :
			$aspirational_count = 0;
				while ( have_posts() ) : the_post(); global $post;				
			$inc = $wp_query->post_count;
			if($service_tax == "aspirational-service" && $post->ID != 2824) : 
			$aspirational_count++;
		?>
			
			<div class="agency-searchitem">
				<div class="col1">
					<?php echo $aspirational_count; ?>.
				</div>	
				<div class="col2">
					<h3> <?php the_title(); ?></h3>
					<div class="agency-searchstatus"></div>
					<div class="agency-searchanswer hidden tvs">
						<?php the_excerpt(); ?>
						<div class="agency-searchshare">
						Find this useful? Share:<br/>
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?=the_permalink()?>" target="_blank" class="fbagency-searchshare"></a>
						<a href="https://twitter.com/home?status=<?=the_permalink()?>" target="_blank"  class="twagency-searchshare"></a>
						<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?=the_permalink()?>&title=&summary=&source=" target="_blank"  class="lnagency-searchshare"></a>
						</div>
					</div>   	   			
				</div>
   	   		</div>
		<?php 
			endif; 
				endwhile;									
			endif;		
			wp_reset_query();	
			if($aspirational_count == 0): 
					echo '<div class="subtitle">No Agencies found !</div>';		
			endif;
		?>
					
		<hr>
						
		<!-- Left-aligned media object -->
		  <div class="media agency-search-user-data">
			<div class="media-left">
			  <?php global $userdata; get_currentuserinfo(); echo get_avatar($userdata->ID, 60, '', '', array('class' => 'media-object')); ?>
			</div>
			<div class="media-body">
			  <h4 class="media-heading">Welcome, <?php echo $user_identity; ?></h4>
			  <p>You&rsquo;re logged in as <strong><?php echo $user_identity; ?></strong></p>
			  <p>
					<a href="<?php echo wp_logout_url('index.php'); ?>">Log out</a> | 
					<?php 
						if (current_user_can('manage_options')) { 
							echo '<a href="' . admin_url() . '">' . __('Admin') . '</a>'; } else { 
							echo '<a href="' . admin_url() . 'profile.php">' . __('Profile') . '</a>';
						} 
					?>

				</p>
			</div>
		  </div>

		<?php } ?>
   </div>

<script>

var action = 'click';
var speed = "500";

$(document).ready(function(){
    $('.agency-searchitem:lt(10)').css('display','table');
$('.agency-searchitem').on(action, function(){
 
$(this).find('.agency-searchanswer').toggleClass('hidden');
  
  //Grab img from clicked question
$(this).find('.agency-searchstatus').toggleClass('open');


});//End on click

    $(".loadmore a").click(function(event){
        $('.agency-searchitem').css('display','table');
         $(".loadmore").hide();
    });

    $("#continue").click(function(event){
        $('.step1').hide()
         $(".step2").show();
    });

$('#submit').click(function(){

$.post("http://marketinggroupplc.com/wp-content/themes/clickverta/question.php", $("#submitq").serialize(),  function(response) {   
 $('#success').html(response);$('#submitq').hide();
});
return false;

});

});//End Ready

;(function($){
  
  /**
   * jQuery function to prevent default anchor event and take the href * and the title to make a share pupup
   *
   * @param  {[object]} e           [Mouse event]
   * @param  {[integer]} intWidth   [Popup width defalut 500]
   * @param  {[integer]} intHeight  [Popup height defalut 400]
   * @param  {[boolean]} blnResize  [Is popup resizeabel default true]
   */
  $.fn.customerPopup = function (e, intWidth, intHeight, blnResize) {
    
    // Prevent default anchor event
    e.preventDefault();
    
    // Set values for window
    intWidth = intWidth || '500';
    intHeight = intHeight || '400';
    strResize = (blnResize ? 'yes' : 'no');

    // Set title and open popup with focus on it
    var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
        strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,            
        objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
  }
  
  /* ================================================== */
  
  $(document).ready(function ($) {
    $('.agency-searchshare a').on("click", function(e) {
      $(this).customerPopup(e);
    });
  });
    
}(jQuery));
</script>

<?php get_footer(); ?>
