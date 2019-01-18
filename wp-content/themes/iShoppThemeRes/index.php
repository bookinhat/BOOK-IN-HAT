<?php get_header(); ?>	
<div id="right_cont">
	<div id="slideshow_cont">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/new-prev.png" alt="prev" class="slide_prev" />
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/new-next.png" alt="next" class="slide_next" />
		
		<?php
		$slider_arr = array();
		$x = 0;
		$args = array(
			 //'category_name' => 'blog',
			 'post_type' => array('post','product'),
			 'meta_key' => 'ex_show_in_slideshow',
			 'meta_value' => 'Yes',
			 'posts_per_page' => 99
			 );
		query_posts($args);
		while (have_posts()) : the_post(); 
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
			//$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large' );
			$img_url = $thumb['0']; 
		?>		                     
			<div class="slide_box <?php if($x == 0) { echo 'slide_box_first'; } ?>">
			
						
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('is-slide-image'); ?></a>
				<div class="slider_text" onclick="location.href='<?php the_permalink(); ?>';">
					<div class="slider_text_inside">
						<//?php the_title(); ?>
					</div> <!-- //slider_text_inside -->
				</div> <!-- //slider_text -->
				
			</div>
		<?php array_push($slider_arr,get_the_ID()); ?>
		<?php $x++; ?>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>                                    
		
	</div><!--//slideshow_cont-->
	<section id="content">
		<div class="woocommerce">
			<?php if (get_option($shortname.'_promo1_image','') != '' || get_option($shortname.'_promo2_image','') != '') { ?>
				<div class="promo_cont">
					<div class="promo_box">
						<a href="<?php echo stripslashes(stripslashes(get_option($shortname.'_promo1_link',''))); ?>"><img src="<?php echo stripslashes(stripslashes(get_option($shortname.'_promo1_image',''))); ?>" alt="" /></a>
					</div> <!-- //promo_box -->
					<div class="promo_box promo_box_last">
						<a href="<?php echo stripslashes(stripslashes(get_option($shortname.'_promo2_link',''))); ?>"><img src="<?php echo stripslashes(stripslashes(get_option($shortname.'_promo2_image',''))); ?>" alt="" /></a>
					</div> <!-- //promo_box -->			
					<div class="clear"></div>
				</div> <!-- //promo_cont -->
			<?php } ?>
		
			<div id="posts_cont">
				<?php
				remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
				
				global $woocommerce_loop, $woocommerce;
				$meta_query = $woocommerce->query->get_meta_query();
				$args = array(
					'post_type'	=> 'product',
					'post_status' => 'publish',
					'ignore_sticky_posts'	=> 1,
					 'meta_key' => 'ex_show_in_homepage',
					 'meta_value' => 'Yes',			
					'post__not_in' => $slider_arr,
					'posts_per_page' => 8, //was 16
					'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
		//			'orderby' => 'date',
		//			'order' => 'desc',
					 //'meta_key' => 'ex_show_on_homepage',
					 //'meta_value' => 'Yes',
					//'meta_query' => $meta_query
				);	
				
				//$products = new WP_Query( $args );
				query_posts( $args );
				
					if ( have_posts() ) : $x = 0; ?>
					
						<?php while ( have_posts() ) : the_post(); ?>			
							
							<div class="home_prod_box <?php if ($x == 3) { echo 'home_prod_box_last'; } ?>">
								<?php woocommerce_get_template_part( 'content', 'product-home-inside' ); ?>
							</div> <!-- //home_prod_box -->
						
							<?php //woocommerce_get_template_part( 'content', 'product-home' ); ?>
							<?php if ($x == 3) { echo '<div class="home_prod_box clear"></div>'; $x = -1; } ?>
						
						<?php $x++; endwhile; // end of the loop. ?>
						<div class="clear"></div>
							
					<?php //woocommerce_product_loop_end(); ?>
					        			
				
				<?php endif; ?>
			</div>
			<div class="load_more_cont">
				<div align="center"><div class="load_more_text">
				<?php
				ob_start();
				//next_posts_link('<img src="' . get_bloginfo('stylesheet_directory') . '/images/loading-button.png" />');
				next_posts_link('LOAD MORE PRODUCT');
				$buffer = ob_get_contents();
				ob_end_clean();
				if(!empty($buffer)) echo $buffer;
				?>
				</div></div>
			</div><!--//load_more_cont-->          			
			<?php
			global $wp_query;
			//echo '**' . $wp_query->max_num_pages . '**';	
			$max_pages = $wp_query->max_num_pages;
			?>			
			<div id="max_pages_id" style="display: none;"><?php echo ceil($wp_query->found_posts / 8); //echo $max_pages-1; ?></div>				
			<?php
			wp_reset_query();
			//wp_reset_postdata();	
		
		?>				
			<div class="clear"></div>
			
		</div>
	</section><!--//content-->
<script type="text/javascript">
$(document).ready(
function($){
	$('.load_more_text a').click(function() {
		$(this).css('visibility','hidden');
		//alert('test');
	});
var curPage = 1;
var pagesNum = $("#max_pages_id").html();   // Number of pages	
if(pagesNum == 1)
	$('.load_more_text a').css('display','none');
  $('#posts_cont').infinitescroll({
 
    navSelector  : "div.load_more_text",            
		   // selector for the paged navigation (it will be hidden)
    nextSelector : "div.load_more_text a:first",    
		   // selector for the NEXT link (to page 2)
    itemSelector : "#posts_cont .home_prod_box",
    behavior: "twitter",
    maxPage: <?php echo $max_pages; ?>    
		   // selector for all items you'll retrieve
  },function(arrayOfNewElems){
  
  $('#posts_cont').append('<div class="clear"></div>');
  		$('.load_more_text a').css('visibility','visible');
            curPage++;
//            alert(curPage + '**' + pagesNum);
            if(curPage == pagesNum) {
                //$(window).unbind('.infscr');
                $('.load_more_text a').css('display','none');
            } else {}  		  
  
      //$('.home_post_cont img').hover_caption();
 
     // optional callback when new content is successfully loaded in.
 
     // keyword `this` will refer to the new DOM content that was just added.
     // as of 1.5, `this` matches the element you called the plugin on (e.g. #content)
     //                   all the new elements that were found are passed in as an array
 
  });  
}  
);
</script>	
<?php get_footer(); ?> 		