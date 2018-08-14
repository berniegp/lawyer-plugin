<?php


/* Add JS scripts for admin */
if ( ! function_exists( 'lawyer_admin_scripts' ) ) {
	function lawyer_admin_scripts() {
		if ( isset( $_GET['taxonomy'] ) && $_GET['taxonomy'] == 'practice' ) {
			wp_enqueue_script( 'lawyer-admin-scripts', EF_URI . '/assets/js/admin-scripts.js', array( 'jquery' ), false, true );
		}
	}
}
add_action( 'admin_init', 'lawyer_admin_scripts' );

/**
 *
 * Add fontello icons to Codestar framework.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'lawyer_fontello_icons' ) ) {
	function lawyer_fontello_icons() {
		$icons = array(array('icon-search' => 'Search'),array('icon-mail-alt' => 'Mail-alt'),array('icon-users' => 'Users'),array('icon-user-secret' => 'User-secret'),array('icon-videocam' => 'Videocam'),array('icon-picture' => 'Picture'),array('icon-camera' => 'Camera'),array('icon-ok' => 'Ok'),array('icon-cancel' => 'Cancel'),array('icon-cancel-circled' => 'Cancel-circled'),array('icon-plus' => 'Plus'),array('icon-minus' => 'Minus'),array('icon-help' => 'Help'),array('icon-home' => 'Home'),array('icon-eye' => 'Eye'),array('icon-tag' => 'Tag'),array('icon-tags' => 'Tags'),array('icon-flag' => 'Flag'),array('icon-thumbs-up-alt' => 'Thumbs-up-alt'),array('icon-thumbs-down-alt' => 'Thumbs-down-alt'),array('icon-quote-left' => 'Quote-left'),array('icon-quote-right' => 'Quote-right'),array('icon-share' => 'Share'),array('icon-pencil' => 'Pencil'),array('icon-print' => 'Print'),array('icon-comment' => 'Comment'),array('icon-chat' => 'Chat'),array('icon-bell-alt' => 'Bell-alt'),array('icon-bell-off' => 'Bell-off'),array('icon-doc' => 'Doc'),array('icon-docs' => 'Docs'),array('icon-doc-text' => 'Doc-text'),array('icon-doc-inv' => 'Doc-inv'),array('icon-doc-text-inv' => 'Doc-text-inv'),array('icon-file-pdf' => 'File-pdf'),array('icon-folder' => 'Folder'),array('icon-folder-open' => 'Folder-open'),array('icon-folder-empty' => 'Folder-empty'),array('icon-folder-open-empty' => 'Folder-open-empty'),array('icon-fax' => 'Fax'),array('icon-menu' => 'Menu'),array('icon-cog' => 'Cog'),array('icon-wrench' => 'Wrench'),array('icon-calendar' => 'Calendar'),array('icon-calendar-empty' => 'Calendar-empty'),array('icon-login' => 'Login'),array('icon-lightbulb' => 'Lightbulb'),array('icon-left-dir' => 'Left-dir'),array('icon-right-dir' => 'Right-dir'),array('icon-angle-left' => 'Angle-left'),array('icon-angle-right' => 'Angle-right'),array('icon-angle-up' => 'Angle-up'),array('icon-angle-down' => 'Angle-down'),array('icon-angle-circled-left' => 'Angle-circled-left'),array('icon-angle-circled-right' => 'Angle-circled-right'),array('icon-angle-double-left' => 'Angle-double-left'),array('icon-angle-double-right' => 'Angle-double-right'),array('icon-left' => 'Left'),array('icon-right' => 'Right'),array('icon-right-hand' => 'Right-hand'),array('icon-left-hand' => 'Left-hand'),array('icon-award' => 'Award'),array('icon-globe' => 'Globe'),array('icon-umbrella' => 'Umbrella'),array('icon-paper-plane' => 'Paper-plane'),array('icon-paper-plane-empty' => 'Paper-plane-empty'),array('icon-paste' => 'Paste'),array('icon-briefcase' => 'Briefcase'),array('icon-suitcase' => 'Suitcase'),array('icon-road' => 'Road'),array('icon-book' => 'Book'),array('icon-circle' => 'Circle'),array('icon-circle-empty' => 'Circle-empty'),array('icon-gift' => 'Gift'),array('icon-magnet' => 'Magnet'),array('icon-chart-area-1' => 'Chart-area-1'),array('icon-chart-pie-4' => 'Chart-pie-4'),array('icon-ticket' => 'Ticket'),array('icon-megaphone' => 'Megaphone'),array('icon-rocket' => 'Rocket'),array('icon-beaker' => 'Beaker'),array('icon-magic' => 'Magic'),array('icon-cab' => 'Cab'),array('icon-money' => 'Money'),array('icon-hammer' => 'Hammer'),array('icon-gauge' => 'Gauge'),array('icon-coffee' => 'Coffee'),array('icon-heartbeat' => 'Heartbeat'),array('icon-ambulance' => 'Ambulance'),array('icon-hospital' => 'Hospital'),array('icon-building' => 'Building'),array('icon-building-filled' => 'Building-filled'),array('icon-bank' => 'Bank'),array('icon-puzzle' => 'Puzzle'),array('icon-shield' => 'Shield'),array('icon-graduation-cap' => 'Graduation-cap'),array('icon-tty' => 'Tty'),array('icon-binoculars' => 'Binoculars'),array('icon-newspaper-2' => 'Newspaper-2'),array('icon-calc' => 'Calc'),array('icon-diamond-1' => 'Diamond-1'),array('icon-facebook' => 'Facebook'),array('icon-github' => 'Github'),array('icon-linkedin' => 'Linkedin'),array('icon-pinterest-4' => 'Pinterest-4'),array('icon-twitter' => 'Twitter'),array('icon-user-1' => 'User-1'),array('icon-users-1' => 'Users-1'),array('icon-cancel-1' => 'Cancel-1'),array('icon-cancel-circled-1' => 'Cancel-circled-1'),array('icon-attach-1' => 'Attach-1'),array('icon-feather' => 'Feather'),array('icon-address' => 'Address'),array('icon-location-1' => 'Location-1'),array('icon-book-1' => 'Book-1'),array('icon-folder-1' => 'Folder-1'),array('icon-rss-1' => 'Rss-1'),array('icon-clock-1' => 'Clock-1'),array('icon-hourglass' => 'Hourglass'),array('icon-left-open-1' => 'Left-open-1'),array('icon-right-open-1' => 'Right-open-1'),array('icon-globe-1' => 'Globe-1'),array('icon-paper-plane-1' => 'Paper-plane-1'),array('icon-lifebuoy-1' => 'Lifebuoy-1'),array('icon-graduation-cap-1' => 'Graduation-cap-1'),array('icon-clipboard' => 'Clipboard'),array('icon-rocket-1' => 'Rocket-1'),array('icon-gauge-1' => 'Gauge-1'),array('icon-traffic-cone' => 'Traffic-cone'),array('icon-vimeo' => 'Vimeo'),array('icon-gplus-1' => 'Gplus-1'),array('icon-dribbble-1' => 'Dribbble-1'),array('icon-instagram' => 'Instagram'),array('icon-dropbox-1' => 'Dropbox-1'),array('icon-evernote' => 'Evernote'),array('icon-skype-1' => 'Skype-1'),array('icon-behance-1' => 'Behance-1'),array('icon-heart-filled' => 'Heart-filled'),array('icon-star-filled' => 'Star-filled'),array('icon-lock-filled' => 'Lock-filled'),array('icon-lock-open-filled' => 'Lock-open-filled'),array('icon-flag-filled' => 'Flag-filled'),array('icon-globe-alt' => 'Globe-alt'),array('icon-mail-3' => 'Mail-3'),array('icon-calendar-inv' => 'Calendar-inv'),array('icon-home-4' => 'Home-4'),array('icon-eye-4' => 'Eye-4'),array('icon-attention-3' => 'Attention-3'),array('icon-info-4' => 'Info-4'),array('icon-question' => 'Question'),array('icon-article-alt-1' => 'Article-alt-1'),array('icon-wrench-3' => 'Wrench-3'),array('icon-clock-4' => 'Clock-4'),array('icon-award-2' => 'Award-2'),array('icon-book-3' => 'Book-3'),array('icon-chart-pie-3' => 'Chart-pie-3'),array('icon-dollar-1' => 'Dollar-1'),array('icon-money-1' => 'Money-1'),array('icon-user-male' => 'User-male'),array('icon-users-3' => 'Users-3'),array('icon-ok-4' => 'Ok-4'),array('icon-ok-circled-1' => 'Ok-circled-1'),array('icon-cancel-5' => 'Cancel-5'),array('icon-cancel-circled-3' => 'Cancel-circled-3'),array('icon-link-4' => 'Link-4'),array('icon-lock-5' => 'Lock-5'),array('icon-lock-alt' => 'Lock-alt'),array('icon-lock-open-5' => 'Lock-open-5'),array('icon-lock-open-alt-1' => 'Lock-open-alt-1'),array('icon-upload-cloud-4' => 'Upload-cloud-4'),array('icon-bell-4' => 'Bell-4'),array('icon-left-open-3' => 'Left-open-3'),array('icon-right-open-3' => 'Right-open-3'),array('icon-down-5' => 'Down-5'),array('icon-left-4' => 'Left-4'),array('icon-right-4' => 'Right-4'),array('icon-up-5' => 'Up-5'),array('icon-globe-4' => 'Globe-4'),array('icon-globe-inv' => 'Globe-inv'),array('icon-art-gallery' => 'Art-gallery'),array('icon-baseball' => 'Baseball'),array('icon-cinema' => 'Cinema'),array('icon-fast-food' => 'Fast-food'),array('icon-garden' => 'Garden'),array('icon-industrial-building' => 'Industrial-building'),array('icon-minefield' => 'Minefield'),array('icon-police' => 'Police'),array('icon-post' => 'Post'),array('icon-soccer' => 'Soccer'),array('icon-theatre' => 'Theatre'),array('icon-town-hall' => 'Town-hall'),array('icon-tree-3' => 'Tree-3'),array('icon-forrst' => 'Forrst'),array('icon-digg-1' => 'Digg-1'),array('icon-appstore' => 'Appstore'),array('icon-flickr-3' => 'Flickr-3'),array('icon-youtube-2' => 'Youtube-2'),array('icon-blogger-1' => 'Blogger-1'),array('icon-deviantart-1' => 'Deviantart-1'),array('icon-lastfm-3' => 'Lastfm-3'),array('icon-wordpress-2' => 'Wordpress-2'),array('icon-folder-5' => 'Folder-5'),array('icon-folder-close' => 'Folder-close'),array('icon-folder-open-2' => 'Folder-open-2'),array('icon-phone-3' => 'Phone-3'),array('icon-cogs' => 'Cogs'),array('icon-calendar-7' => 'Calendar-7'),array('icon-lightbulb-2' => 'Lightbulb-2'),array('icon-arrows-cw-2' => 'Arrows-cw-2'),array('icon-shuffle-4' => 'Shuffle-4'),array('icon-desktop-2' => 'Desktop-2'),array('icon-laptop-2' => 'Laptop-2'),array('icon-leaf-3' => 'Leaf-3'),array('icon-magnet-2' => 'Magnet-2'),array('icon-megaphone-2' => 'Megaphone-2'),array('icon-key-4' => 'Key-4'),array('icon-asl' => 'Asl'),array('icon-stumbleupon-3' => 'Stumbleupon-3'),array('icon-ok-6' => 'Ok-6'),array('icon-balance-scale' => 'Balance-scale'),array('icon-handshake-o' => 'Handshake-o'),array('icon-envelope-open' => 'Envelope') );
		return $icons;
	}
}

if ( ! function_exists( 'lawyer_fontello_icon_css' ) ) {
	function lawyer_fontello_icon_css() {
		wp_enqueue_style( 'fontello', EF_URI . '/assets/css/fontello.css' );
	}
}
add_action( 'admin_print_styles', 'lawyer_fontello_icon_css' );

if ( ! function_exists( 'lawyer_add_icons_font' ) ) {
	function lawyer_add_icons_font() {
	 
		$icons  = array_map(function($a) {  return array_keys($a)[0]; }, lawyer_fontello_icons());

		echo '<h4 class="cs-icon-title">' . esc_html__( 'Fontello Icons', 'lawyer-plugin' ) . '</h4>';
		foreach ( $icons as $icon ) {
			echo '<a class="cs-icon-tooltip" data-icon="' . $icon . '" data-title="' . $icon . '"><span class="cs-icon cs-selector"><i class="' . $icon . '"></i></span></a>';
		}
	}
}
add_action( 'cs_add_icons', 'lawyer_add_icons_font' );

/**
 * Get classes
 */
if( ! function_exists( 'lawyer_get_classes' ) ) {
	function lawyer_get_classes( $pref, $suf, $max = 120, $step = 5 ) {
		$ar = array();
		for ( $i = 0; $i < $max + $step; $i += $step ) {
			$ar[ $i . 'px' ] = $pref . '-' . $suf . $i;
		}

		return array_merge( array( 'Default' => 'none' ), $ar );
	}
}

/**
 *
 * Get categories functions. Return array lists
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'lawyer_param_values' ) ) {
	function lawyer_param_values( $post_type = 'terms', $query_args = array(), $revert = false, $show_all = false ) {

		$list = array();
		if ( $show_all ) {
			$list['All'] = 'all';
		}

		//check type
		switch ( $post_type ) {

			case 'posts': // get posts

				$posts = get_posts( $query_args );
				if ( ! empty( $posts ) ) {

					foreach ( $posts as $post ) {
						$list[ $post->post_title ] = $post->ID;
					}

				} else {
					$list[ esc_html__( 'not found posts', 'lawyer-plugin' ) ] = '';
				}

				break;

			case 'terms': // get terms

				$taxonomies = ! empty( $query_args['taxonomies'] ) ? $query_args['taxonomies'] : 'projects-category';

				$terms = get_terms( $taxonomies, $query_args );
				if ( ! empty( $terms ) ) {
					foreach ( $terms as $key => $term ) {
						$list[ $term->name ] = $term->slug;
					}
				} else {
					$list[ esc_html__( 'not found terms or terms empty', 'lawyer-plugin' ) ] = '';
				}

				break;
			case 'tags':
			case 'tag':

				$tags = get_terms( $query_args['taxonomies'] );
				if ( ! empty( $tags ) ) {
					foreach ( $tags as $tag ) {
						$options[ $tag->name ] = $tag->term_id;
					}
				}
				break;
			case 'categories': // get categories

				$categories = get_categories( $query_args );
				if ( ! empty( $categories ) ) {
					if ( is_array( $categories ) ) {
						foreach ( $categories as $category ) {
							$list[ $category->name ] = $category->slug;
						}
					} else {
						$list[ esc_html__( 'categories not is array', 'lawyer-plugin' ) ] = '';
					}
				} else {
					$list[ esc_html__( 'not found categories', 'lawyer-plugin' ) ] = '';
				}
				break;

		}

		if( $revert ) {
			$list = array_flip( $list );
		}
		
		return $list;
	}
}

/*
 *
 * Add Location metabox for people
 *
 */
if( ! function_exists( 'lawyer_poeple_add_location' ) ) {
	function lawyer_poeple_add_location() {
		add_meta_box( 'people-location', 'Location', 'lawyer_view_people_location_option', 'people', 'side', 'high' );
	}
}
add_action( 'add_meta_boxes', 'lawyer_poeple_add_location' );

if( ! function_exists( 'lawyer_view_people_location_option' ) ) {
	function lawyer_view_people_location_option( $post ) {
		$post_meta = get_post_meta( $post->ID, 'people-location', true );
		$args = array(
			'post_type'   => 'locations',
			'numberposts' => -1
		);

		$locations = lawyer_param_values( 'posts', $args ); ?>

		<p>
			<label for="people-location">Select location: </label>
			<select name='people-location' id='people-location'>
				<?php foreach ($locations as $name => $id): ?>
				<option value="<?php echo $id; ?>" <?php selected( $id, $post_meta); ?>><?php echo esc_html($name); ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<?php   
	}
}

if( ! function_exists( 'lawyer_save_people_location' ) ) {
	function lawyer_save_people_location( $post_id ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if ( isset( $_POST['post_type'] ) && 'people' == $_POST['post_type'] && ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		if ( ! isset( $_POST['people-location'] ) ) {
			return;
		}

		$data = sanitize_text_field( $_POST['people-location'] );

		update_post_meta( $post_id, 'people-location', $data );
	}
}
add_action( 'save_post', 'lawyer_save_people_location' );


/**
 *
 * Get twitts
 *
 */
if( ! function_exists( 'lawyer_get_twitts' ) ) {
	function lawyer_get_twitts( $user, $count_twitts = 3, $style = '', $echo = true ) {

		if ( ! file_exists( EF_ROOT . '/TwitterAPIExchange.php' ) ) {
			return false;
		}

		$options = false;

		if( function_exists( 'lawyer_get_options' ) ) {
			$tw_access_token 		= lawyer_get_options('tw_access_token');
			$tw_access_token_secret = lawyer_get_options('tw_access_token_secret');
			$tw_consumer_key 		= lawyer_get_options('tw_consumer_key');
			$tw_consumer_secret 	= lawyer_get_options('tw_consumer_secret');

			if( $tw_access_token && $tw_access_token_secret && $tw_consumer_key && $tw_consumer_secret ) {
				$options = true;
			}
		}

		if( $options ) {
			require_once EF_ROOT . '/TwitterAPIExchange.php';

			$settings = array(
				'oauth_access_token' 		=> $tw_access_token,
				'oauth_access_token_secret' => $tw_access_token_secret,
				'consumer_key' 				=> $tw_consumer_key,
				'consumer_secret' 			=> $tw_consumer_secret
			);

			$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
			$requestMethod = 'GET';
			$getfield = '?screen_name='. $user .'&count='. $count_twitts .'&exclude_replies=true&skip_status=1';
			$twitter = new TwitterAPIExchange($settings);
			
			$data = $twitter->setGetfield($getfield)
				->buildOauth($url, $requestMethod)
				->performRequest();

			$twitts = json_decode( $data );
			
			if( ! empty( $twitts ) && is_array( $twitts ) ) {

				return $twitts;
			} else {

				return false;
			}
		} else {

			return false;
		}
	}
}


/**
 * Add new query args for people search
 */
if ( ! function_exists( 'lawyer_search_lawyers' ) ) {

	function lawyer_search_lawyers( $query ) {

		if ( $query->is_main_query() && is_tax( 'sectors' ) ) {
			$people_pagination = lawyer_get_options('people_pagination', 10 );
			$query->set( 'posts_per_page', $people_pagination );
		}

		if ( $query->is_main_query() && $query->is_post_type_archive( 'people' ) ) {
			
			$people_pagination = lawyer_get_options('people_pagination', 10);

			$query->set( 'posts_per_page', $people_pagination );

			if ( ! empty( $_GET['legal'] ) ) {
				$practice = sanitize_title( $_GET['legal'] );

				$taxquery = array(
					array(
						'taxonomy' => 'practice',
						'field'    => 'slug',
						'terms'    => $practice
					)
				);

				$query->set( 'tax_query', $taxquery );
			}

			if ( ! empty( $_GET['office'] ) ) {
				$office = sanitize_title( $_GET['office'] );

				$query->set(
					'meta_query',
					array(
						array(
							'key'   => 'people-location',
							'value' => $office
						)
					)
				);
			}
		}

		if ( $query->is_main_query() && is_tax('practice') ) {
			$term = get_queried_object();
			$term_data = get_term_meta( $term->term_id, 'practice_fields', true );

			if ( isset( $term_data['number'] ) && ! empty( $term_data['number'] ) && is_numeric( $term_data['number'] ) ) {
				if ( $term_data['number'] == 0 ) {
					$query->set( 'posts_per_page', -1 );
				} else {
					$query->set( 'posts_per_page', $term_data['number'] );
				}
			}

			if ( isset( $term_data['random'] ) && $term_data['random'] ) {
				$query->set( 'orderby', 'rand' );
			}
		}
	}
}
add_action( 'pre_get_posts', 'lawyer_search_lawyers' );

/**
 * Make people search only by title field
 */
if ( ! function_exists( 'lawyer_search_lawyer_by_title_only' ) ) {
	function lawyer_search_lawyer_by_title_only( $search, $wp_query ) {
		if ( ! empty( $_GET['post_type'] ) && $_GET['post_type'] == 'people' ) {

			global $wpdb;
			if( empty( $search ) ) {
				return $search; // skip processing - no search term in query
			}
			$q = $wp_query->query_vars;
			$n = ! empty( $q['exact'] ) ? '' : '%';
			$search =
			$searchand = '';
			foreach ( (array) $q['search_terms'] as $term ) {
				$term = esc_sql($wpdb->esc_like($term));
				$search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
				$searchand = ' AND ';
			}
			if ( ! empty( $search ) ) {
				$search = " AND ({$search}) ";
				if ( ! is_user_logged_in() ) {
					$search .= " AND ($wpdb->posts.post_password = '') ";
				}
			}
		}
		return $search;
	}
}
add_filter( 'posts_search', 'lawyer_search_lawyer_by_title_only', 500, 2 );


/**
 * Ger list of sidebrs
 */
if ( ! function_exists( 'lawyer_sidebars' ) ) {
	function lawyer_sidebars() {
		global $wp_registered_sidebars;
		$list = array( ' - Select sidebar - ' => 'none' );

		if ( empty( $wp_registered_sidebars ) ) {
			return;
		}

		foreach ( $wp_registered_sidebars as $sidebar ) {
			$list[ $sidebar['name'] ] = $sidebar['id'];
		}

		return $list;
	}
}

/**
 * Change excerpt length
 */
if ( ! function_exists( 'lawyer_custom_excerpt_length' ) ) {
	function lawyer_custom_excerpt_length( $length ) {
		$excerpt_symbol_count = lawyer_get_options( 'excerpt_symbol_count' );
		if ( $excerpt_symbol_count ) {
			return $excerpt_symbol_count;
		}
		return $length;
	}
}
add_filter( 'excerpt_length', 'lawyer_custom_excerpt_length', 999 );


/* Fix casa textarea editor */
if ( ! function_exists( 'lawyer_fix_practice_editor' ) ) {
	function lawyer_fix_practice_editor () {

		if( isset( $_GET['taxonomy'] ) && $_GET['taxonomy'] == 'practice' ) { ?>

			<script>
			jQuery(document).ready(function() {
				if( jQuery('#addtag').length ) {
					jQuery('#submit').on('click', function(){
						var $val = tinyMCE.activeEditor.getContent();
						jQuery('#descr').val( $val );
					});
				}
			});
			</script>';

		<?php }
	}
}
add_action( 'admin_footer', 'lawyer_fix_practice_editor' );

// Pagination for shortcode
if ( ! function_exists( 'lawyer_shortcode_pagination ' ) ) {
	function lawyer_shortcode_pagination( $max_num_pages ) {
		$page = is_front_page() ? 'page' : 'paged';
		$big = 999999999;
		$args = array(
			'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'    => '?paged=%#%',
			'current'   => max( 1, get_query_var( $page ) ),
			'total'     => $max_num_pages,
			'type' 		=> 'plain', 
			'prev_text' => '<i class="icon-left-4"></i>', 
			'next_text' => '<i class="icon-right-4"></i>' 
		); 
		if ( $paginate_links = paginate_links( $args ) ): ?>
			<!-- Pagination -->
			<nav class="pagination">
				<div class="nav-links">
					<?php echo wp_kses_post( $paginate_links ); ?>
				</div>
			</nav>
			<!-- End pagination -->
		<?php
		endif;

	}
}

function lp_load_textdomain() {
	load_plugin_textdomain( 'lawyer-plugin', false, EF_ROOT . '/languages' );
}
add_action('plugins_loaded', 'lp_load_textdomain');

if ( ! function_exists( 'lawyer_get_categories' ) ) {
	function lawyer_get_categories( $post_type ) {
		$cats = array(
			'post' => 'category',
		);

		$categories = get_terms( $cats[ $post_type ] );
		$list       = array();

		if ( ! empty( $categories ) ) {
			$list[ esc_html__( 'All', 'lawyer-plugin' ) ] = 'all';

			foreach ( $categories as $category ) {
				$list[ $category->name ] = $category->slug;
			}
		}

		return $list;
	}
}