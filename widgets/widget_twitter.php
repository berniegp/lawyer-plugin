<?php
/**
 *
 * Lawyer Twitter Widget
 *
 */
if( ! class_exists( 'Lawyer_Twitter' ) ) {
	class Lawyer_Twitter extends WP_Widget {

		function __construct() {

			$widget_ops     = array(
				'classname'   => 'lawyer_twitter',
				'description' => esc_html__( 'Lawyer Theme Widget.', 'lawyer-plugin' )
			);
			parent::__construct( 'Lawyer_Twitter', 'Lawyer - Twitter', $widget_ops );
		}

		function widget( $args, $instance ) {

			extract( $args );

			echo $before_widget;

			$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
			$limit = isset($instance['twitts']) ? $instance['twitts'] : 3;
			$enable_links = isset($instance['links']) ? 'true' : 'false';
			$enable_images = isset($instance['images']) ? 'true' : 'false';
			$show_user = isset($instance['user']) ? 'true' : 'false';
			$show_time = isset($instance['time']) ? 'true' : 'false';
			$twitter_screen_name =  isset($instance['username']) ? $instance['username'] : 'ThemeMakers';
			$hash = md5(rand(1, 999));

			if ( ! empty( $instance['title'] ) ) {
				echo $before_title . $title . $after_title;
			}

			if ( ! empty( $instance['username'] ) ) {

				?>

				<script type="text/javascript">
					jQuery(function() {
						var config = {
							"profile": {"screenName": '<?php echo esc_js($twitter_screen_name); ?>'},
							"domId": 'tweets_<?php echo esc_js($hash); ?>',
							"maxTweets": <?php echo esc_attr((int) $limit) ?>,
							"enableLinks": <?php echo esc_attr( $enable_links ) ?>,
							"showImages": <?php echo esc_attr( $enable_images ) ?>,
							"showUser": <?php echo esc_attr( $show_user ) ?>,
							"showTime": <?php echo esc_attr( $show_time ) ?>,
							"showRetweet": false,
							"showInteraction": false

						};
						twitterFetcher.fetch(config);
					});
				</script>

				<div class="widget-twitter" id="tweets_<?php echo esc_attr($hash) ?>"></div>

				<?php
			} else {
				?>

				<p><?php esc_html_e( 'Twitter Username is not set', 'lawyer-plugin' ); ?></p>

				<?php
			}

			echo $after_widget;

			wp_enqueue_script( 'lawyer-twitter-fetcher', EF_URI . '/assets/js/twitterFetcher_min.js', array( 'jquery' ), false, true );

		}

		function update( $new_instance, $old_instance ) {

			$instance             = $old_instance;
			$instance['title']    = $new_instance['title'];
			$instance['username'] = $new_instance['username'];
			$instance['twitts']   = $new_instance['twitts'];
			$instance['links']    = $new_instance['links'];
			$instance['images']   = $new_instance['images'];
			$instance['user']     = $new_instance['user'];
			$instance['time']     = $new_instance['time'];

			return $instance;

		}

		function form( $instance ) {

			// set defaults
			// -------------------------------------------------
			$instance   = wp_parse_args( $instance, array(
				'title'    => esc_html__( 'Twitter', 'lawyer-plugin' ),
				'username' => 'ThemeMakers',
				'twitts'   => 2,
				'links'    => true,
				'images'   => false,
				'user'	   => false,
				'time' 	   => true
			));

			// title field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['title'] );
			$text_field = array(
				'id'    => $this->get_field_name('title'),
				'name'  => $this->get_field_name('title'),
				'type'  => 'text',
				'title' => esc_html__( 'Title', 'lawyer-plugin' )
			);

			echo cs_add_element( $text_field, $text_value );
	

			// username field
			// -------------------------------------------------
			$textarea_value = esc_attr( $instance['username'] );
			$textarea_field = array(
				'id'    => $this->get_field_name('username'),
				'name'  => $this->get_field_name('username'),
				'type'  => 'text',
				'title' => esc_html__( 'Username', 'lawyer-plugin' )
			);

			echo cs_add_element( $textarea_field, $textarea_value );


			// twitts field
			// -------------------------------------------------
			$textarea_value = esc_attr( $instance['twitts'] );
			$textarea_field = array(
				'id'    => $this->get_field_name('twitts'),
				'name'  => $this->get_field_name('twitts'),
				'type'  => 'number',
				'title' => esc_html__( 'Number of tweets', 'lawyer-plugin' )
			);

			echo cs_add_element( $textarea_field, $textarea_value );


			// links field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['links'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('links'),
				'name'  => $this->get_field_name('links'),
				'type'  => 'switcher',
				'title' => esc_html__( 'Enable links', 'lawyer-plugin' )
			);

			echo cs_add_element( $switcher_field, $switcher_value );


			// field images
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['images'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('images'),
				'name'  => $this->get_field_name('images'),
				'type'  => 'switcher',
				'title' => esc_html__( 'Enable images', 'lawyer-plugin' )
			);

			echo cs_add_element( $switcher_field, $switcher_value );


			// user field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['user'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('user'),
				'name'  => $this->get_field_name('user'),
				'type'  => 'switcher',
				'title' => esc_html__( 'Show user', 'lawyer-plugin' )
			);

			echo cs_add_element( $switcher_field, $switcher_value );


			// time field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['time'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('time'),
				'name'  => $this->get_field_name('time'),
				'type'  => 'switcher',
				'title' => esc_html__( 'Show time', 'lawyer-plugin' )
			);

			echo cs_add_element( $switcher_field, $switcher_value );

		}
	}
}

if ( ! function_exists( 'lawyer_init_twitter_widget' ) ) {
	function lawyer_init_twitter_widget() {
		register_widget( 'Lawyer_Twitter' );
	}
	add_action( 'widgets_init', 'lawyer_init_twitter_widget', 2 );
}