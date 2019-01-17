<?php
/**
 * The template part for displaying services
 *
 * @package advance-ecommerce-store
 * @subpackage advance-ecommerce-store
 * @since advance-ecommerce-store 1.0
 */
?>  
<?php
  $content = apply_filters( 'the_content', get_the_content() );
  $video = false;

  // Only get video from the content if a playlist isn't present.
  if ( false === strpos( $content, 'wp-playlist-script' ) ) {
    $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
  }
?>
<div class="page-box">
    <h4><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a></h4>
    <div class="metabox">
        <span class="entry-author"><i class="fas fa-user"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></span>
        <span class="entry-date"><i class="fas fa-calendar-alt"></i><?php echo esc_html( get_the_date() ); ?></span>       
        <span class="entry-comments"><i class="fas fa-comments"></i> <?php comments_number( __('0 Comment', 'advance-ecommerce-store'), __('0 Comments', 'advance-ecommerce-store'), __('% Comments', 'advance-ecommerce-store') ); ?> </span>
    </div>
    <div class="box-image">
      <?php
        if ( ! is_single() ) {
          // If not a single post, highlight the video file.
          if ( ! empty( $video ) ) {
            foreach ( $video as $video_html ) {
              echo '<div class="entry-video">';
                echo $video_html;
              echo '</div>';
            }
          };
        }; 
      ?>
    </div>
    <div class="new-text">
        <p><?php the_excerpt();?></p>
        <div class="second-border">
            <a href="<?php echo esc_url( get_permalink() );?>" title="<?php esc_attr_e( 'Read More', 'advance-ecommerce-store' ); ?>"><?php esc_html_e('Read More','advance-ecommerce-store'); ?></a>
        </div>
    </div>
    <div class="clearfix"></div>
</div>