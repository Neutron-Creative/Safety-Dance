<?php
/**
 * Safety Dance
 *
 * @package   NeutronCreative\SafetyDance
 * @link      https://neutroncreative.com/safety-dance
 * @author    Neutron Creative Inc
 * @copyright Copyright © 2018 Neutron Creative Inc
 * @license   GPL-3.0-or-later
 */

namespace NeutronCreative\SafetyDance;

use SeoThemes\Core\AssetLoader;
use SeoThemes\Core\Constants;
use SeoThemes\Core\CustomColors;
use SeoThemes\Core\Customizer;
use SeoThemes\Core\GenesisSettings;
use SeoThemes\Core\GoogleFonts;
use SeoThemes\Core\HeroSection;
use SeoThemes\Core\Hooks;
use SeoThemes\Core\ImageSizes;
use SeoThemes\Core\PageLayouts;
use SeoThemes\Core\PageTemplate;
use SeoThemes\Core\PluginActivation;
use SeoThemes\Core\PostTypeSupport;
use SeoThemes\Core\SimpleSocialIcons;
use SeoThemes\Core\TextDomain;
use SeoThemes\Core\ThemeSupport;
use SeoThemes\Core\WidgetArea;

$core_assets = [
	AssetLoader::SCRIPTS => [
		[
			AssetLoader::HANDLE   => 'menus',
			AssetLoader::URL      => AssetLoader::path( '/resources/js/menus.js' ),
			AssetLoader::DEPS     => [ 'jquery' ],
			AssetLoader::VERSION  => wp_get_theme()->get( 'Version' ),
			AssetLoader::FOOTER   => true,
			AssetLoader::ENQUEUE  => true,
			AssetLoader::LOCALIZE => [
				AssetLoader::LOCALIZEVAR  => 'genesis_responsive_menu',
				AssetLoader::LOCALIZEDATA => [
					'mainMenu'         => '<span class="hamburger"></span><span class="screen-reader-text">' . __( 'Menu', 'safety-dance' ) . '</span>',
					'subMenu'          => __( 'Sub Menu', 'safety-dance' ),
					'menuIconClass'    => null,
					'subMenuIconClass' => null,
					'menuClasses'      => [
						'combine' => [
							'.nav-primary',
							'.nav-secondary',
						],
					],
				]
			],
		],
		[
			AssetLoader::HANDLE  => 'fitvids',
			AssetLoader::URL     => AssetLoader::path( '/resources/js/script.js' ),
			AssetLoader::DEPS    => [ 'jquery' ],
			AssetLoader::VERSION => wp_get_theme()->get( 'Version' ),
			AssetLoader::FOOTER  => true,
			AssetLoader::ENQUEUE => true,
		],
		[
			AssetLoader::HANDLE  => 'script',
			AssetLoader::URL     => AssetLoader::path( '/resources/js/jquery.fitvids.js' ),
			AssetLoader::DEPS    => [ 'fitvids' ],
			AssetLoader::VERSION => wp_get_theme()->get( 'Version' ),
			AssetLoader::FOOTER  => true,
			AssetLoader::ENQUEUE => true,
		],
	],
	AssetLoader::STYLES  => [
		[
			AssetLoader::HANDLE      => 'woocommerce',
			AssetLoader::URL         => AssetLoader::path( '/woocommerce.css' ),
			AssetLoader::VERSION     => wp_get_theme()->get( 'Version' ),
			AssetLoader::ENQUEUE     => true,
			AssetLoader::CONDITIONAL => function () {
				return class_exists( 'WooCommerce' );
			},
		],
	],
];

$core_constants = [
	Constants::DEFINE => [
		'CHILD_THEME_NAME'    => wp_get_theme()->get( 'Name' ),
		'CHILD_THEME_URL'     => wp_get_theme()->get( 'ThemeURI' ),
		'CHILD_THEME_VERSION' => wp_get_theme()->get( 'Version' ),
		'CHILD_THEME_HANDLE'  => wp_get_theme()->get( 'TextDomain' ),
		'CHILD_THEME_AUTHOR'  => wp_get_theme()->get( 'Author' ),
		'CHILD_THEME_DIR'     => get_stylesheet_directory(),
		'CHILD_THEME_URI'     => get_stylesheet_directory_uri(),
	],
];

$core_customizer = [
	Customizer::SECTIONS => [
		[
			Customizer::ID    => 'single_posts',
			Customizer::TITLE => __( 'Single Posts', 'safety-dance' ),
			Customizer::PANEL => 'genesis',
		],
	],
	Customizer::FIELDS   => [
		[
			Customizer::CONTROL_TYPE  => 'checkbox',
			Customizer::SETTINGS      => 'single_post_featured_image',
			Customizer::LABEL         => __( 'Display featured image?', 'safety-dance' ),
			Customizer::SECTION       => 'single_posts',
			Customizer::DEFAULT_VALUE => true,
		],
	],
];

$core_custom_colors = [
	[
		CustomColors::ID            => 'background',
		CustomColors::DEFAULT_COLOR => '#ffffff',
		CustomColors::OUTPUT        => [
			[
				CustomColors::ELEMENTS   => [
					'body',
					'.site-container',
				],
				CustomColors::PROPERTIES => [
					'background-color' => '%s',
				],
			],
		],
	],
	[
		CustomColors::ID            => 'link',
		CustomColors::DEFAULT_COLOR => '#0077ee',
		CustomColors::OUTPUT        => [
			[
				CustomColors::ELEMENTS   => [
					'a',
					'.site-title a:focus',
					'.site-title a:hover',
					'.entry-title a:focus',
					'.entry-title a:hover',
					'.genesis-nav-menu a:focus',
					'.genesis-nav-menu a:hover',
					'.genesis-nav-menu .current-menu-item > a',
					'.genesis-nav-menu .sub-menu .current-menu-item > a:focus',
					'.genesis-nav-menu .sub-menu .current-menu-item > a:hover',
					'.menu-toggle:focus',
					'.menu-toggle:hover',
					'.sub-menu-toggle:focus',
					'.sub-menu-toggle:hover',
				],
				CustomColors::PROPERTIES => [
					'color' => '%s',
				],
			],
		],
	],
	[
		CustomColors::ID            => 'accent',
		CustomColors::DEFAULT_COLOR => '#0077ee',
		CustomColors::OUTPUT        => [
			[
				CustomColors::ELEMENTS   => [
					'button:focus',
					'button:hover',
					'[type="button"]:focus',
					'[type="button"]:hover',
					'[type="reset"]:focus',
					'[type="reset"]:hover',
					'[type="submit"]:focus',
					'[type="submit"]:hover',
					'[type="reset"]:focus',
					'[type="reset"]:hover',
					'[type="submit"]:focus',
					'[type="submit"]:hover',
					'.button:focus',
					'.button:hover',
				],
				CustomColors::PROPERTIES => [
					'background-color' => '%s',
				],
			],
		],
	],
];

$core_example = [
	Example::SUB_CONFIG => [
		Example::KEY => 'value',
	],
];

$core_genesis_settings = [
	GenesisSettings::DEFAULTS => [
		GenesisSettings::SITE_LAYOUT => 'full-width-content',
	],
];

$core_google_fonts = [
	GoogleFonts::ENQUEUE => [
		'Source+Sans+Pro:400,600,700',
	],
];

$core_hero_section = [
	HeroSection::ENABLE => [
		HeroSection::PAGE            => true,
		HeroSection::POST            => true,
		HeroSection::PRODUCT         => true,
		HeroSection::PORTFOLIO_ITEM  => true,
		HeroSection::FRONT_PAGE      => true,
		HeroSection::ATTACHMENT      => true,
		HeroSection::ERROR_404       => true,
		HeroSection::LANDING_PAGE    => false,
		HeroSection::BLOG_TEMPLATE   => true,
		HeroSection::SEARCH          => true,
		HeroSection::AUTHOR          => true,
		HeroSection::DATE            => true,
		HeroSection::LATEST_POSTS    => true,
		HeroSection::BLOG            => true,
		HeroSection::SHOP            => true,
		HeroSection::PORTFOLIO       => true,
		HeroSection::PORTFOLIO_TYPE  => true,
		HeroSection::PRODUCT_ARCHIVE => true,
		HeroSection::CATEGORY        => true,
		HeroSection::TAG             => true,
	],
];

$core_hooks = [
	Hooks::ADD    => [
		// Inc 5000 Banner
		[
			Hooks::TAG      => 'genesis_before_header', 
			Hooks::CALLBACK => function ( ) {
				echo '<div class="announcement-banner">Educated Design &amp; Development has been named an <img src="/wp-content/uploads/2019/01/inc-5000.png"/> company.</div>';
			}
		],
		// Products Category Archive
		/*[
			Hooks::TAG      => 'genesis_before_loop',
			Hooks::CALLBACK => function () {
				if(is_product_category()) {
					echo '<h1>is a catergory</h1>';
				} else {
					echo '<h1>not category</h1>';
				}
			}
		],*/
		// Products Archive Attempt 2
		[
			Hooks::TAG      => 'woocommerce_before_main_content',
			Hooks::CALLBACK => function() {
				global $product;

					echo "</header><main class='content product-archive'><div class='wrap'>";
						if(!is_product()) {
							echo "<h1>" . substr(get_the_archive_title(), 10) . "</h1>";
							echo "<div style='display:flex;flex-direction:row;align-items:flex-start;'>";
								echo "<div class='display:flex;flex-direction:column;'>" . get_the_archive_description() . "</div>";
								echo "<img src='/wp-content/uploads/2019/01/ISO_accredited.gif'/>";
							echo "</div>";
						} else {
							echo "<h1>" . $product->get_name() . "</h1>";
						}

						// Sidebar
							echo '<div class="sidebar" style="left: -44px !important;">';
							echo '<form action="/" method="get" class="search-form">';
								echo '<input type="text" name="s" id="search" value="' . the_search_query() . '">';
								echo '<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search!' ) .'" />';
							echo '</form>';
							
							echo '<ul class="category-list">';
								echo '<div class="bg-stripe"></div>';
								echo '<div class="list-header">Product List</div>';

								$taxonomy     = 'product_cat';
								$orderby      = 'name';  
								$show_count   = 0;      // 1 for yes, 0 for no
								$pad_counts   = 0;      // 1 for yes, 0 for no
								$hierarchical = 1;      // 1 for yes, 0 for no  
								$title        = '';  
								$empty        = 0;
							
								$args = array(
									'taxonomy'     => $taxonomy,
									'orderby'      => $orderby,
									'show_count'   => $show_count,
									'pad_counts'   => $pad_counts,
									'hierarchical' => $hierarchical,
									'title_li'     => $title,
									'hide_empty'   => $empty
								);
								$all_categories = get_categories( $args );
								foreach ($all_categories as $cat) {
									if($cat->category_parent == 0) {
										$category_id = $cat->term_id;       
										echo '<li><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a></li>'; 
									}
								}

								echo '<div class="list-closer"></div>';

							echo '</ul>';
						echo '</div>';
					echo "</div></main><header>";
			}
		],
		[
			Hooks::TAG      => 'woocommerce_after_main_content',
			Hooks::CALLBACK => function() {
				if(!is_product()) {
					// Category Archive
					echo "<main class='content product-archive'><div class='wrap'>";
						$cate = get_queried_object();
						$cateID = $cate->term_id;
						$args = array(
							'status' => 'publish',
							'category' => array( sanitize_title_with_dashes( substr(get_the_archive_title(), 10) ) ),
							'orderby' => 'menu_order',
							'order' => 'ASC'
						);
						$products = wc_get_products( $args );
						foreach($products as $product) {
							$attachmentIDs = $product->get_gallery_image_ids();
							$specificationBadges = $product->get_meta('specifications');
							$meetsRequirements = $product->get_meta('meets_requirements');
							$stubbyTable = $product->get_meta('stubby_table');
							$fullTable = $product->get_meta('full_table');

							echo "<a class='product-in-loop-wc' href='" . get_permalink( $product->get_id() ) . "'><div>";
								if(in_array('exclusive', $specificationBadges)) {
									echo '<img class="exclusive-badge" src="/wp-content/uploads/2019/01/edd-exclusive.png"/>';
								}
								echo "<div style='display:block;width:100%;height:2px;margin-bottom:10px;margin-top:0;background-color:#0094DE;'></div>";
								echo "<div class='title-row'>";
									echo "<h3>" . $product->get_name() . "</h3>";
									if(in_array('millenium', $specificationBadges)) {
										echo '<img src="/wp-content/uploads/2019/01/millenium.gif"/>';
									}
								echo "</div>";
								echo '<div class="product-content">';
									// $product->get_image_id();
									echo '<div class="product-details image-details">';
										echo '<img class="product-image" src="' . get_the_post_thumbnail_url( $product->get_id(), 'full' ) . '"/>';
										foreach($attachmentIDs as $attachmentID) {
											echo '<img class="product-gallery-image" src="' . wp_get_attachment_url( $attachmentID ) . '"/>';
										}
										echo '<div class="specification-badges">';
											foreach($specificationBadges as $badge) {
												if($badge != 'millenium' && $badge != 'exclusive') echo '<img src="/wp-content/uploads/2019/01/' . $badge . '.gif"/>';
											}
										echo '</div>';
									echo '</div>';
									echo "<div class='product-details content-details' style='color:#000'>";
										echo "<strong>Product Details</strong><br/>";
										echo $product->get_description();
										if($meetsRequirements) {
											echo "<ul class='product-requirements'>";
											echo "<h5>Meets Requirements for Testing Standard(s) including but not limited to:</h5>";
											foreach($meetsRequirements as $requirement) {
												echo "<li>" . $requirement . "</li>";
											}
											echo "</ul>";
										}
										if($stubbyTable) echo '<img class="stubby-table" src="' . wp_get_attachment_url( $stubbyTable ) . '"/>';
									echo "</div>";
								echo '</div>';
								if($fullTable) echo '<img class="full-table" src="' . wp_get_attachment_url( $fullTable ) . '"/>';
								echo '<p class="product-disclaimer">' . $product->get_meta('disclaimers') . '</p>';
							echo "</div></a>";
						}
						//print_r($products);
					echo "</div></main>";
				} else {
					// Single Product
					global $product;
					// Product Loop
					$attachmentIDs = $product->get_gallery_image_ids();
					$specificationBadges = $product->get_meta('specifications');
					$meetsRequirements = $product->get_meta('meets_requirements');
					$stubbyTable = $product->get_meta('stubby_table');
					$fullTable = $product->get_meta('full_table');

					echo "<a class='product-in-loop-wc' href='" . get_permalink( $product->get_id() ) . "'><div>";
						if(in_array('exclusive', $specificationBadges)) {
							echo '<img class="exclusive-badge" src="/wp-content/uploads/2019/01/edd-exclusive.png"/>';
						}
						echo "<div style='display:block;width:100%;height:2px;margin-bottom:10px;margin-top:0;background-color:#0094DE;'></div>";
						echo "<div class='title-row'>";
							echo "<h3>" . $product->get_name() . "</h3>";
							if(in_array('millenium', $specificationBadges)) {
								echo '<img src="/wp-content/uploads/2019/01/millenium.gif"/>';
							}
						echo "</div>";
						echo '<div class="product-content">';
							// $product->get_image_id();
							echo '<div class="product-details image-details">';
								echo '<img class="product-image" src="' . get_the_post_thumbnail_url( $product->get_id(), 'full' ) . '"/>';
								foreach($attachmentIDs as $attachmentID) {
									echo '<img class="product-gallery-image" src="' . wp_get_attachment_url( $attachmentID ) . '"/>';
								}
								echo '<div class="specification-badges">';
									foreach($specificationBadges as $badge) {
										if($badge != 'millenium' && $badge != 'exclusive') echo '<img src="/wp-content/uploads/2019/01/' . $badge . '.gif"/>';
									}
								echo '</div>';
							echo '</div>';
							echo "<div class='product-details content-details' style='color:#000'>";
								echo "<strong>Product Details</strong><br/>";
								echo $product->get_description();
								if($meetsRequirements) {
									echo "<ul class='product-requirements'>";
									echo "<h5>Meets Requirements for Testing Standard(s) including but not limited to:</h5>";
									foreach($meetsRequirements as $requirement) {
										echo "<li>" . $requirement . "</li>";
									}
									echo "</ul>";
								}
								if($stubbyTable) echo '<img class="stubby-table" src="' . wp_get_attachment_url( $stubbyTable ) . '"/>';
							echo "</div>";
						echo '</div>';
						if($fullTable) echo '<img class="full-table" src="' . wp_get_attachment_url( $fullTable ) . '"/>';
						echo '<p class="product-disclaimer">' . $product->get_meta('disclaimers') . '</p>';
					echo "</div></a>";
					
				}
			}
		],
		// Products Sidebar
		[
			Hooks::TAG      => 'genesis_entry_content',
			Hooks::CALLBACK => function () {
				
				echo '<div class="sidebar">';
					echo '<form action="/" method="get" class="search-form">';
						echo '<input type="text" name="s" id="search" value="' . the_search_query() . '">';
						echo '<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search!' ) .'" />';
					echo '</form>';
					
					echo '<ul class="category-list">';
						echo '<div class="bg-stripe"></div>';
						echo '<div class="list-header">Product List</div>';

						$taxonomy     = 'product_cat';
						$orderby      = 'name';  
						$show_count   = 0;      // 1 for yes, 0 for no
						$pad_counts   = 0;      // 1 for yes, 0 for no
						$hierarchical = 1;      // 1 for yes, 0 for no  
						$title        = '';  
						$empty        = 0;
					
						$args = array(
							'taxonomy'     => $taxonomy,
							'orderby'      => $orderby,
							'show_count'   => $show_count,
							'pad_counts'   => $pad_counts,
							'hierarchical' => $hierarchical,
							'title_li'     => $title,
							'hide_empty'   => $empty
						);
						$all_categories = get_categories( $args );
						foreach ($all_categories as $cat) {
							if($cat->category_parent == 0) {
								$category_id = $cat->term_id;       
								echo '<li><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a></li>'; 
							}
						}

						echo '<div class="list-closer"></div>';

					echo '</ul>';
				echo '</div>';
			}
		],
		[
			Hooks::TAG      => 'template_include',
			Hooks::CALLBACK => function ( $template ) {
				if ( ! is_front_page() || 'posts' === get_option( 'show_on_front' ) ) {
					return $template;
				}

				return get_stylesheet_directory() . '/resources/views/page-front.php';
			}
		],
		[
			Hooks::TAG      => 'wp_enqueue_scripts',
			Hooks::CALLBACK => 'genesis_enqueue_main_stylesheet',
			Hooks::PRIORITY => 99,
		],
		[
			Hooks::TAG      => 'body_class',
			Hooks::CALLBACK => function ( $classes ) {
				if ( ! is_front_page() && is_home() || is_search() || is_author() || is_date() || is_category() || is_tag() || is_page_template( 'page_blog.php' ) ) {
					$classes[] = 'is-archive';
				}

				if ( ! is_front_page() && ! is_page_template( 'page_blog.php' ) && ! is_post_type_archive() && is_singular() || is_404() ) {
					$classes[] = 'is-singular';
				}

				if ( is_page_template( 'page-blog.php' ) ) {
					$classes[] = 'blog';
					$classes   = array_diff( $classes, [ 'page' ] );
				}

				if ( is_front_page() ) {
					$classes[] = 'front-page';
				}

				$classes[] = 'no-js';

				return $classes;
			},
		],
		[
			Hooks::TAG      => 'genesis_before',
			Hooks::CALLBACK => function () {
				?>
                <script>
                    //<![CDATA[
                    (function () {
                        var c = document.body.classList;
                        c.remove('no-js');
                        c.add('js');
                    })();
                    //]]>
                </script>
				<?php
			},
			Hooks::PRIORITY => 1,
		],
		[
			Hooks::TAG         => 'genesis_site_title',
			Hooks::CALLBACK    => 'the_custom_logo',
			Hooks::PRIORITY    => 0,
			Hooks::CONDITIONAL => function () {
				return has_custom_logo();
			}
		],
		[
			Hooks::TAG      => 'genesis_markup_title-area_close',
			Hooks::CALLBACK => function ( $close_html ) {
				if ( $close_html ) {
					ob_start();
					do_action( 'child_theme_after_title_area' );
					$close_html = $close_html . ob_get_clean();
				}

				return $close_html;
			}
		],
		[
			Hooks::TAG      => 'genesis_before',
			Hooks::CALLBACK => function () {
				$wraps = get_theme_support( 'genesis-structural-wraps' );
				foreach ( $wraps[0] as $context ) {
					add_filter( "genesis_structural_wrap-{$context}", function ( $output, $original ) use ( $context ) {
						$position = ( 'open' === $original ) ? 'before' : 'after';
						ob_start();
						do_action( "child_theme_{$position}_{$context}_wrap" );
						if ( 'open' === $original ) {
							return ob_get_clean() . $output;
						} else {
							return $output . ob_get_clean();
						}
					}, 10, 2 );
				}
			}
		],
		[
			Hooks::TAG      => 'genesis_attr_content-sidebar-wrap',
			Hooks::CALLBACK => function ( $atts ) {
				$atts['class'] = 'wrap';

				return $atts;
			},
		],
		[
			Hooks::TAG      => 'genesis_structural_wrap-footer',
			Hooks::CALLBACK => function ( $output, $original_output ) {
				if ( 'open' == $original_output ) {
					$output = '<div class="footer-credits">' . $output;
				} elseif ( 'close' == $original_output ) {
					$backtotop = '<a href="#" rel="nofollow" class="backtotop">' . __( 'Return to top', 'safety-dance' ) . '</a>';
					$output    = $backtotop . $output . $output;
				}

				return $output;
			},
			Hooks::PRIORITY => 10,
			Hooks::ARGS     => 2,
		],
		[
			Hooks::TAG      => 'genesis_before',
			Hooks::CALLBACK => function () {
				if ( 'center-content' === genesis_site_layout() ) {
					add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );
				}
			}
		],
		[
			Hooks::TAG      => 'admin_init',
			Hooks::CALLBACK => function () {
				add_editor_style( 'editor.css' );
			},
		],
		[
			Hooks::TAG      => 'genesis_setup',
			Hooks::CALLBACK => function () {
				register_default_headers( [
					'child' => [
						'url'           => '%2$s/resources/img/hero.jpg',
						'thumbnail_url' => '%2$s/resources/img/hero.jpg',
						'description'   => __( 'Hero Image', 'corporate-pro' ),
					],
				] );
			},
			Hooks::PRIORITY => 20,
		],
		[
			Hooks::TAG      => 'genesis_entry_content',
			Hooks::CALLBACK => function () {
				if ( is_singular( 'post' ) && get_theme_mod( 'single_post_featured_image', true ) ) {
					printf( "<p>%s</p>", genesis_get_image( [
						'size' => 'hero',
					] ) );
				}
			},
			Hooks::PRIORITY => 0,
		],
		[
			Hooks::TAG      => 'child_theme_after_title_area',
			Hooks::CALLBACK => 'genesis_do_nav',
		],
		[
			Hooks::TAG      => 'child_theme_after_header_wrap',
			Hooks::CALLBACK => 'genesis_do_subnav',
		],
		[
			Hooks::TAG      => 'child_theme_before_footer_wrap',
			Hooks::CALLBACK => 'genesis_footer_widget_areas',
		],
		[
			Hooks::TAG      => 'genesis_widget_column_classes',
			Hooks::CALLBACK => function ( $column_classes ) {
				$column_classes[] = 'one-fifth';
				$column_classes[] = 'two-fifths';
				$column_classes[] = 'three-fifths';
				$column_classes[] = 'four-fifths';
				$column_classes[] = 'full-width';

				return $column_classes;
			},
		],
	],
	Hooks::REMOVE => [
		[
			Hooks::TAG         => 'genesis_doctype',
			Hooks::CALLBACK    => 'genesis_do_doctype',
			Hooks::CONDITIONAL => function () {
				return is_admin_bar_showing();
			}
		],
		[
			Hooks::TAG      => 'genesis_meta',
			Hooks::CALLBACK => 'genesis_load_stylesheet',
		],
		[
			Hooks::TAG      => 'genesis_after_header',
			Hooks::CALLBACK => 'genesis_do_nav',
		],
		[
			Hooks::TAG      => 'genesis_after_header',
			Hooks::CALLBACK => 'genesis_do_subnav',
		],
		[
			Hooks::TAG      => 'genesis_before_footer',
			Hooks::CALLBACK => 'genesis_footer_widget_areas',
		],
	],
];

$core_image_sizes = [
	ImageSizes::ADD => [
		'featured' => [
			'width'  => 620,
			'height' => 380,
			'crop'   => true,
		],
		'hero'     => [
			'width'  => 1280,
			'height' => 720,
			'crop'   => true,
		],
	],
];

$core_layouts = [
	PageLayouts::REGISTER   => [
		[
			'id'    => 'center-content',
			'label' => __( 'Center Content', 'safety-dance' ),
			'img'   => get_stylesheet_directory_uri() . '/resources/img/center-content.gif',
		]
	],
	PageLayouts::UNREGISTER => [
		// PageLayouts::CONTENT_SIDEBAR,
		// PageLayouts::SIDEBAR_CONTENT,
		// PageLayouts::FULL_WIDTH_CONTENT,
		PageLayouts::CONTENT_SIDEBAR_SIDEBAR,
		PageLayouts::SIDEBAR_SIDEBAR_CONTENT,
		PageLayouts::SIDEBAR_CONTENT_SIDEBAR,
	],
];

$core_page_templates = [
	PageTemplate::REGISTER => [
		'/resources/views/page-full.php'    => 'Full Width',
		'/resources/views/page-landing.php' => 'Landing Page',
	],
];

$core_plugins = [
	PluginActivation::REGISTER => [
		[
			PluginActivation::NAME     => 'Genesis Widget Column Classes',
			PluginActivation::SLUG     => 'genesis-widget-column-classes',
			PluginActivation::REQUIRED => false,
		],
		[
			PluginActivation::NAME     => 'Icon Widget',
			PluginActivation::SLUG     => 'icon-widget',
			PluginActivation::REQUIRED => false,
		],
		[
			PluginActivation::NAME     => 'One Click Demo Import',
			PluginActivation::SLUG     => 'one-click-demo-import',
			PluginActivation::REQUIRED => false,
		],
		[
			PluginActivation::NAME     => 'Simple Social Icons',
			PluginActivation::SLUG     => 'simple-social-icons',
			PluginActivation::REQUIRED => false,
		],
	],
];

if ( class_exists( 'WooCommerce' ) ) {
	$core_plugins[ PluginActivation::REGISTER ][] = [
		PluginActivation::NAME     => 'Genesis Connect for WooCommerce',
		PluginActivation::SLUG     => 'genesis-connect-woocommerce',
		PluginActivation::REQUIRED => false,
	];
}

$core_post_type_support = [
	PostTypeSupport::ADD => [
		[
			PostTypeSupport::POST_TYPE => 'page',
			PostTypeSupport::SUPPORTS  => 'excerpt',
		],
	],
];

$core_simple_social_icons = [
	SimpleSocialIcons::DEFAULTS => [
		SimpleSocialIcons::NEW_WINDOW => 1,
		SimpleSocialIcons::SIZE       => 40,
	],
];

$core_textdomain = [
	TextDomain::DOMAIN => 'safety-dance',
];

$core_theme_support = [
	ThemeSupport::ADD => [
		'align-wide'                  => null,
		'automatic-feed-links'        => null,
		'custom-logo'                 => [
			'height'      => 100,
			'width'       => 300,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => [
				'.site-title',
				'.site-description',
			],
		],
		'custom-header'               => [
			'header-selector'  => '.hero-section',
			'default_image'    => get_stylesheet_directory_uri() . '/resources/img/hero.jpg',
			'header-text'      => false,
			'width'            => 1280,
			'height'           => 720,
			'flex-height'      => true,
			'flex-width'       => true,
			'uploads'          => true,
			'video'            => true,
			'wp-head-callback' => [
				'SeoThemes\Core\HeroSection',
				'custom_header',
			],
		],
		'genesis-accessibility'       => [
			'404-page',
			'drop-down-menu',
			'headings',
			'rems',
			'search-form',
			'skip-links',
		],
		'genesis-after-entry-widget-area',
		'genesis-footer-widgets'      => 3,
		'genesis-menus'               => [
			'primary'   => __( 'Header Menu', 'safety-dance' ),
			'secondary' => __( 'After Header Menu', 'safety-dance' ),
		],
		'genesis-responsive-viewport' => null,
		'genesis-structural-wraps'    => [
			'header',
			'menu-secondary',
			'footer-widgets',
			'footer',
		],
		'gutenberg'                   => [
			'wide-images' => true,
		],
		'html5'                       => [
			'caption',
			'comment-form',
			'comment-list',
			'gallery',
			'search-form',
		],
		'post-thumbnails',
		'woocommerce'                 => null,
		'wc-product-gallery-zoom'     => null,
		'wc-product-gallery-lightbox' => null,
		'wc-product-gallery-slider'   => null,
		'wp-block-styles'             => null,
	],
];

$core_widget_areas = [
	WidgetArea::REGISTER   => [
		[
			WidgetArea::ID           => 'front-page-1',
			WidgetArea::NAME         => __( 'Front Page 1', 'safety-dance' ),
			WidgetArea::DESCRIPTION  => __( 'Front Page 1 widget area.', 'safety-dance' ),
			WidgetArea::LOCATION     => 'genesis_loop',
			WidgetArea::BEFORE_TITLE => '<h1 itemprop="headline">',
			WidgetArea::AFTER_TITLE  => '</h1>',
			WidgetArea::BEFORE       => function () {
				ob_start();
				the_custom_header_markup();
				$custom_header = ob_get_clean();

				return '<div class="front-page-1 widget-area">' . $custom_header . '<div class="wrap">';
			},
			WidgetArea::CONDITIONAL  => function () {
				return is_front_page();
			},
		],
		[
			WidgetArea::ID          => 'front-page-2',
			WidgetArea::NAME        => __( 'Front Page 2', 'safety-dance' ),
			WidgetArea::DESCRIPTION => __( 'Front Page 2 widget area.', 'safety-dance' ),
			WidgetArea::LOCATION    => 'genesis_loop',
			WidgetArea::CONDITIONAL => function () {
				return is_front_page();
			},
		],
		[
			WidgetArea::ID          => 'front-page-3',
			WidgetArea::NAME        => __( 'Front Page 3', 'safety-dance' ),
			WidgetArea::DESCRIPTION => __( 'Front Page 3 widget area.', 'safety-dance' ),
			WidgetArea::LOCATION    => 'genesis_loop',
			WidgetArea::CONDITIONAL => function () {
				return is_front_page();
			},
		],
	],
	WidgetArea::UNREGISTER => [
		WidgetArea::SIDEBAR_ALT,
	],
];

return [
	AssetLoader::class       => $core_assets,
	Constants::class         => $core_constants,
	Customizer::class        => $core_customizer,
	CustomColors::class      => $core_custom_colors,
	Example::class           => $core_example,
	GenesisSettings::class   => $core_genesis_settings,
	GoogleFonts::class       => $core_google_fonts,
	HeroSection::class       => $core_hero_section,
	Hooks::class             => $core_hooks,
	ImageSizes::class        => $core_image_sizes,
	PageLayouts::class       => $core_layouts,
	PageTemplate::class      => $core_page_templates,
	PluginActivation::class  => $core_plugins,
	PostTypeSupport::class   => $core_post_type_support,
	SimpleSocialIcons::class => $core_simple_social_icons,
	TextDomain::class        => $core_textdomain,
	ThemeSupport::class      => $core_theme_support,
	WidgetArea::class        => $core_widget_areas,
];
