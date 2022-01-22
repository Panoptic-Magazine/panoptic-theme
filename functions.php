<?php
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @link https://developer.wordpress.org/themes/advanced-topics/child-themes/
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://developer.wordpress.org/plugins/}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfifteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Twenty Fifteen 1.0
	 */
	function twentyfifteen_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyfifteen
		 * If you're building a theme based on twentyfifteen, use a find and replace
		 * to change 'twentyfifteen' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'twentyfifteen' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

        function fork_register_custom_widgets() {
            register_widget( 'fork_Widget_Recent_Posts' );
        }
        add_action( 'widgets_init', 'fork_register_custom_widgets' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * See: https://developer.wordpress.org/reference/functions/add_theme_support/#post-thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 825, 510, true );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'twentyfifteen' ),
				'social'  => __( 'Social Links Menu', 'twentyfifteen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
				'navigation-widgets',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://wordpress.org/support/article/post-formats/
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'status',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for custom logo.
		 *
		 * @since Twenty Fifteen 1.5
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 248,
				'width'       => 248,
				'flex-height' => true,
			)
		);

		$color_scheme  = twentyfifteen_get_color_scheme();
		$default_color = trim( $color_scheme[0], '#' );

		// Setup the WordPress core custom background feature.

		add_theme_support(
			'custom-background',
			/**
			 * Filters Twenty Fifteen custom-background support arguments.
			 *
			 * @since Twenty Fifteen 1.0
			 *
			 * @param array $args {
			 *     An array of custom-background support arguments.
			 *
			 *     @type string $default-color      Default color of the background.
			 *     @type string $default-attachment Default attachment of the background.
			 * }
			 */
			apply_filters(
				'twentyfifteen_custom_background_args',
				array(
					'default-color'      => $default_color,
					'default-attachment' => 'fixed',
				)
			)
		);

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );

		// Load regular editor styles into the new block-based editor.
		add_theme_support( 'editor-styles' );

		// Load default block styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom color scheme.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Dark Gray', 'twentyfifteen' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', 'twentyfifteen' ),
					'slug'  => 'light-gray',
					'color' => '#f1f1f1',
				),
				array(
					'name'  => __( 'White', 'twentyfifteen' ),
					'slug'  => 'white',
					'color' => '#fff',
				),
				array(
					'name'  => __( 'Yellow', 'twentyfifteen' ),
					'slug'  => 'yellow',
					'color' => '#f4ca16',
				),
				array(
					'name'  => __( 'Dark Brown', 'twentyfifteen' ),
					'slug'  => 'dark-brown',
					'color' => '#352712',
				),
				array(
					'name'  => __( 'Medium Pink', 'twentyfifteen' ),
					'slug'  => 'medium-pink',
					'color' => '#e53b51',
				),
				array(
					'name'  => __( 'Light Pink', 'twentyfifteen' ),
					'slug'  => 'light-pink',
					'color' => '#ffe5d1',
				),
				array(
					'name'  => __( 'Dark Purple', 'twentyfifteen' ),
					'slug'  => 'dark-purple',
					'color' => '#2e2256',
				),
				array(
					'name'  => __( 'Purple', 'twentyfifteen' ),
					'slug'  => 'purple',
					'color' => '#674970',
				),
				array(
					'name'  => __( 'Blue Gray', 'twentyfifteen' ),
					'slug'  => 'blue-gray',
					'color' => '#22313f',
				),
				array(
					'name'  => __( 'Bright Blue', 'twentyfifteen' ),
					'slug'  => 'bright-blue',
					'color' => '#55c3dc',
				),
				array(
					'name'  => __( 'Light Blue', 'twentyfifteen' ),
					'slug'  => 'light-blue',
					'color' => '#e9f2f9',
				),
			)
		);

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif; // twentyfifteen_setup()
add_action( 'after_setup_theme', 'twentyfifteen_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 */
function twentyfifteen_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Widget Area', 'twentyfifteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
	/**
	 * Register Google fonts for Twenty Fifteen.
	 *
	 * @since Twenty Fifteen 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function twentyfifteen_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/*
		 * translators: If there are characters in your language that are not supported
		 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'twentyfifteen' ) ) {
			$fonts[] = 'Noto Sans:400italic,700italic,400,700';
		}

		/*
		 * translators: If there are characters in your language that are not supported
		 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'twentyfifteen' ) ) {
			$fonts[] = 'Noto Serif:400italic,700italic,400,700';
		}

		/*
		 * translators: If there are characters in your language that are not supported
		 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentyfifteen' ) ) {
			$fonts[] = 'Inconsolata:400,700';
		}

		/*
		 * translators: To add an additional character subset specific to your language,
		 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen' );

		if ( 'cyrillic' === $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ( 'greek' === $subset ) {
			$subsets .= ',greek,greek-ext';
		} elseif ( 'devanagari' === $subset ) {
			$subsets .= ',devanagari';
		} elseif ( 'vietnamese' === $subset ) {
			$subsets .= ',vietnamese';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family'  => urlencode( implode( '|', $fonts ) ),
					'subset'  => urlencode( $subsets ),
					'display' => urlencode( 'fallback' ),
				),
				'https://fonts.googleapis.com/css'
			);
		}

		return $fonts_url;
	}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Fifteen 1.1
 */
function twentyfifteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyfifteen_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '20201208' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfifteen-style', get_stylesheet_uri(), array(), '20201208' );

	// Theme block stylesheet.
	wp_enqueue_style( 'twentyfifteen-block-style', get_template_directory_uri() . '/css/blocks.css', array( 'twentyfifteen-style' ), '20190102' );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfifteen-style' ), '20170916' );
	wp_style_add_data( 'twentyfifteen-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentyfifteen-style' ), '20141210' );
	wp_style_add_data( 'twentyfifteen-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141028', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141210' );
	}

	wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20171218', true );
	wp_localize_script(
		'twentyfifteen-script',
		'screenReaderText',
		array(
			'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
			'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

/**
 * Enqueue styles for the block-based editor.
 *
 * @since Twenty Fifteen 2.1
 */
function twentyfifteen_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'twentyfifteen-block-editor-style', get_template_directory_uri() . '/css/editor-blocks.css', array(), '20201208' );
	// Add custom fonts.
	wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'twentyfifteen_block_editor_styles' );


/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Fifteen 1.7
 *
 * @param array   $urls          URLs to print for resource hints.
 * @param string  $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function twentyfifteen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentyfifteen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		} else {
			$urls[] = 'https://fonts.gstatic.com';
		}
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentyfifteen_resource_hints', 10, 2 );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentyfifteen_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' === $previous->post_type ) {
		return;
	}

	if ( $previous && has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css      .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css      .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'twentyfifteen-style', $css );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );





/**
 * Display descriptions in main navigation.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string   $item_output The menu item's starting HTML output.
 * @param WP_Post  $item        Menu item data object.
 * @param int      $depth       Depth of the menu. Used for padding.
 * @param stdClass $args        An object of wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' === $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function twentyfifteen_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Fifteen 1.9
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentyfifteen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 22;
	$args['smallest'] = 8;
	$args['unit']     = 'pt';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentyfifteen_widget_tag_cloud_args' );

/**
 * Prevents `author-bio.php` partial template from interfering with rendering
 * an author archive of a user with the `bio` username.
 *
 * @since Twenty Fifteen 2.6
 *
 * @param string $template Template file.
 * @return string Replacement template file.
 */
function twentyfifteen_author_bio_template( $template ) {
	if ( is_author() ) {
		$author = get_queried_object();
		if ( $author instanceof WP_User && 'bio' === $author->user_nicename ) {
			// Use author templates if exist, fall back to template hierarchy otherwise.
			return locate_template( array( "author-{$author->ID}.php", 'author.php' ) );
		}
	}

	return $template;
}
add_filter( 'author_template', 'twentyfifteen_author_bio_template' );


/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Block Patterns.
 *
 * @since Twenty Fifteen 3.0
 */
require get_template_directory() . '/inc/block-patterns.php';

class fork_Widget_Recent_Posts extends WP_Widget {

    /**
     * Sets up a new Recent Posts widget instance.
     *
     * @since 2.8.0
     */
    public function __construct() {
        $widget_ops = array(
            'classname'                   => 'fork_widget_recent_entries',
            'description'                 => __( 'Your site&#8217;s most recent Posts. Edited' ),
            'customize_selective_refresh' => true,
            'show_instance_in_rest'       => true,
        );
        parent::__construct( 'recent-posts', __( 'Recent Posts' ), $widget_ops );
        $this->alt_option_name = 'widget_recent_entries';
    }



    /**
     * Outputs the content for the current Recent Posts widget instance.
     *
     * @since 2.8.0
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Recent Posts widget instance.
     */
    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $default_title = __( 'Recent Posts' );
        $title         = ( ! empty( $instance['title'] ) ) ? $instance['title'] : $default_title;

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number ) {
            $number = 5;
        }
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

        $r = new WP_Query(
        /**
         * Filters the arguments for the Recent Posts widget.
         *
         * @since 3.4.0
         * @since 4.9.0 Added the `$instance` parameter.
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args     An array of arguments used to retrieve the recent posts.
         * @param array $instance Array of settings for the current widget.
         */
            apply_filters(
                'widget_posts_args',
                array(
                    'posts_per_page'      => $number,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                ),
                $instance
            )
        );

        if ( ! $r->have_posts() ) {
            return;
        }
        ?>

        <?php echo $args['before_widget']; ?>

        <?php
        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $format = current_theme_supports( 'html5', 'navigation-widgets' ) ? 'html5' : 'xhtml';

        /** This filter is documented in wp-includes/widgets/class-wp-nav-menu-widget.php */
        $format = apply_filters( 'navigation_widgets_format', $format );

        if ( 'html5' === $format ) {
            // The title may be filtered: Strip out HTML and make sure the aria-label is never empty.
            $title      = trim( strip_tags( $title ) );
            $aria_label = $title ? $title : $default_title;
            echo '<nav aria-label="' . esc_attr( $aria_label ) . '">';
        }
        ?>

        <ul>
            <?php foreach ( $r->posts as $recent_post ) : ?>
                <?php
                $post_title   = get_the_title( $recent_post->ID );
                $title        = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
                $aria_current = '';

                if ( get_queried_object_id() === $recent_post->ID ) {
                    $aria_current = ' aria-current="page"';
                }
                ?>
                <li>
                    <a href="<?php the_permalink( $recent_post->ID ); ?>"<?php echo $aria_current; ?>><?php echo $title; ?></a>
                    <?php if ( $show_date ) : ?>
                        <span class="post-date"><?php echo get_the_date( '', $recent_post->ID ); ?></span>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php
        if ( 'html5' === $format ) {
            echo '</nav>';
        }

        echo $args['after_widget'];
    }

    /**
     * Handles updating the settings for the current Recent Posts widget instance.
     *
     * @since 2.8.0
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance              = $old_instance;
        $instance['title']     = sanitize_text_field( $new_instance['title'] );
        $instance['number']    = (int) $new_instance['number'];
        $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
        return $instance;
    }

    /**
     * Outputs the settings form for the Recent Posts widget.
     *
     * @since 2.8.0
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
        </p>

        <p>
            <input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label>
        </p>
        <?php
    }
}
