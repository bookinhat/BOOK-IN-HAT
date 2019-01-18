<?php $shortname = "ishopp_theme"; ?>
<footer id="footer">
	<div class="footer_widgets_cont">
			<div class="footer_widget_col">
				<?php if( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 1') ) : ?>
				<?php endif; ?>
			</div> <!-- //footer_widget_col -->
			<div class="footer_widget_col">
				<?php if( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 2') ) : ?>
				<?php endif; ?>
			</div> <!-- //footer_widget_col -->
			<div class="footer_widget_col">
				<?php if( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 3') ) : ?>
				<?php endif; ?>
			</div> <!-- //footer_widget_col -->
			<div class="footer_widget_col footer_widget_col_last">
				<?php if( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 4') ) : ?>
				<?php endif; ?>
			</div> <!-- //footer_widget_col -->		
			<div class="clear"></div>
			<div class="footer_copyright">
				<?php echo stripslashes(stripslashes(get_option($shortname.'_copyright_text','&copy; Copyright 2014 Powered by Wordpress'))); ?>
			</div> <!-- //footer_copyright -->
	</div> <!-- //footer_widgets_cont -->
	
</footer><!--//footer-->
</div> <!-- //right_cont -->
<div class="clear"></div>
</div> <!--//container -->
<?php wp_footer(); ?>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/scripts.js"></script>
</body>
</html>