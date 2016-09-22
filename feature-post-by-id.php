<?php
/*
* Plugin Name: Viewpoint Mag display posts in sidebar
* Description: Widget for displaying posts in VP sidebar
* Version: 0.1
* Author: Brian Liston
* Author URI: brianliston.com
*/

// Register style sheet.
add_action( 'wp_enqueue_scripts', 'register_plugin_styles' );

function register_plugin_styles() {
    wp_register_style( 'feature-post-by-id', plugins_url( 'feature-post-by-id/style.css' ) );
    wp_enqueue_style( 'feature-post-by-id' );
}


// Create widget area in viewpointmag.com sidebar

function featured_posts_by_id_sidebar_widget( $content ) {
	if ( is_home() && is_active_sidebar( 'featured-post' ) && is_main_query() ) {
		dynamic_sidebar('featured-post');
	}
	return $content;
}
add_filter( 'pre_get_search_form', 'featured_posts_by_id_sidebar_widget' );

register_sidebar( array(
	'id'          => 'featured-post',
	'name'        => 'Feature Posts by ID widget area',
	'description' => __( 'The widget "Feature post by ID" goes here.', 'text_domain' ),
) );


// Widget

function feature_post_by_id_register_widget() {
    register_widget( 'Feature_Posts_by_ID_Widget');
}
add_action( 'widgets_init', 'feature_post_by_id_register_widget' );

class Feature_Posts_by_ID_Widget extends WP_Widget {
    function Feature_Posts_by_ID_Widget() {
        // Instantiate the parent object
        parent::__construct(
                'feature_posts_by_id_widget', // Base ID
                __('Feature post by ID', 'text_domain'), // Name
               array( 'description' => __( 'Widget for displaying posts by post ID in viewpointmag.com sidebar', 'text_domain' ), ) // Args
        );
    }

    function widget( $args, $instance ) {

        $post_id = $instance['postid'];
        $queried_post = get_post($post_id);
        $title = $queried_post->post_title;
        echo $args['before_widget'] . '<h2>' . $instance['idtitle'] . '</h2><a href="' . get_post_permalink($post_id) . '"><div class="featured-posts-widget">';
        if (has_post_thumbnail( $post_id) ) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
             echo '<img src="'. $image[0] . '"/>';
        }
        echo '<h1>' . $title . '</h1></div></a>' . $args['after_widget'];
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        // Fields
        $instance['idtitle'] = strip_tags($new_instance['idtitle']);
        $instance['postid'] = strip_tags($new_instance['postid']);
        return $instance;
    }

    // Widget form creation
    function form($instance) {
        $idtitle = '';
        $postid = '';

        // Check values
        if( $instance) {
            $idtitle = esc_attr($instance['idtitle']);
            $postid = esc_textarea($instance['postid']);
        } ?>
         
        <p>
            <label for="<?php echo $this->get_field_id('idtitle'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('idtitle'); ?>" name="<?php echo $this->get_field_name('idtitle'); ?>" type="text" value="<?php echo $idtitle; ?>" />
        </p>
         
        <p>
            <label for="<?php echo $this->get_field_id('postid'); ?>"><?php _e('Post ID', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('postid'); ?>" name="<?php echo $this->get_field_name('postid'); ?>" type="text" value="<?php echo $postid; ?>" />
        </p>
        
    <?php }
}