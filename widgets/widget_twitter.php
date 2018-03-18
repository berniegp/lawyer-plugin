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
				'description' => 'Lawyer Theme Widget.'
			);
			parent::__construct( 'Lawyer_Twitter', 'Lawyer - Twitter', $widget_ops );
		}

		function widget( $args, $instance ) {

			extract( $args );

			echo $before_widget;

			if ( ! empty( $instance['title'] ) ) {
				echo $before_title . $instance['title'] . $after_title;
			}


			if ( ! empty( $instance['username'] ) ) {
				$count = ! empty( $instance['twitts'] ) ? $instance['twitts'] : 2;

				$twitts = lawyer_get_twitts( $instance['username'], $count );
				if ( $twitts ) {
					$item_class = $instance['icon'] ? '' : ' no-icon';
					$user_link = $instance['user'] ? '<a href="https://twitter.com/' . $instance['username'] . '">@' . $instance['username'] . '</a>' : '';

					$links  = $instance['links'];
					$user   = $instance['user'];
					$time   = $instance['time'];
					$images = $instance['images'];

					foreach ( $twitts as $twitt ) {
						$text = $twitt->text;
						$img = '';
						$date = '';


						if ( $images && isset( $twitt->entities->media ) ) {
							$media = $twitt->entities->media;

							$text = str_replace( $media[0]->url, '', $text );
							$media_url = is_ssl() ? $media[0]->media_url_https : $media[0]->media_url;

							$img = '<img src="' . $media_url . '" alt="">';

						}

						if ( $time ) {
							$timestamp = strtotime( $twitt->created_at );
							$date = '<p class="widget-twitter__date">' . esc_html__( 'Posted on', 'lawyer-plugin' ) . ' ' . date( 'd M', $timestamp ) . '</p>';
						}

						if ( $links ) {
							$text = preg_replace('/(http[s]{0,1}\:\/\/\S{4,})\s{0,}/ims', '<a href="$1" target="_blank">$1</a> ', $text);
						} ?>

						<div class="widget-twitter__data <?php echo $item_class; ?>">
							<p><?php echo $text, $img; ?></p>
							<?php echo $date; ?>
							<?php echo $user_link; ?>
						</div>
						<?php
					}
				}
			}

			echo $after_widget;

		}

		function update( $new_instance, $old_instance ) {

			$instance             = $old_instance;
			$instance['title']    = $new_instance['title'];
			$instance['username'] = $new_instance['username'];
			$instance['twitts']   = $new_instance['twitts'];
			$instance['icon']     = $new_instance['icon'];
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
				'title'    => 'Twitter',
				'username' => '',
				'twitts'   => 2,
				'icon' 	   => true,
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
				'title' => 'Title',
			);

			echo cs_add_element( $text_field, $text_value );

	
			// twitts field
			// -------------------------------------------------
			$textarea_value = esc_attr( $instance['twitts'] );
			$textarea_field = array(
				'id'    => $this->get_field_name('twitts'),
				'name'  => $this->get_field_name('twitts'),
				'type'  => 'number',
				'title' => 'Count of tweets'
			);
	

			// username field
			// -------------------------------------------------
			$textarea_value = esc_attr( $instance['username'] );
			$textarea_field = array(
				'id'    => $this->get_field_name('username'),
				'name'  => $this->get_field_name('username'),
				'type'  => 'text',
				'title' => 'Username'
			);

			echo cs_add_element( $textarea_field, $textarea_value );


			// icon field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['icon'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('icon'),
				'name'  => $this->get_field_name('icon'),
				'type'  => 'switcher',
				'title' => 'Show icons'
			);

			echo cs_add_element( $switcher_field, $switcher_value );

			// links field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['links'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('links'),
				'name'  => $this->get_field_name('links'),
				'type'  => 'switcher',
				'title' => 'Enable links'
			);

			echo cs_add_element( $switcher_field, $switcher_value );


			// field images
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['images'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('images'),
				'name'  => $this->get_field_name('images'),
				'type'  => 'switcher',
				'title' => 'Enable images'
			);

			echo cs_add_element( $switcher_field, $switcher_value );


			// user field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['user'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('user'),
				'name'  => $this->get_field_name('user'),
				'type'  => 'switcher',
				'title' => 'Show user'
			);

			echo cs_add_element( $switcher_field, $switcher_value );


			// time field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['time'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('time'),
				'name'  => $this->get_field_name('time'),
				'type'  => 'switcher',
				'title' => 'Show time'
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