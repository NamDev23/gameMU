<?php
	
add_theme_support( 'post-thumbnails' );
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	

	
}

function get_language_shortcode() {
    return apply_filters( 'wpml_current_language', null );
}
add_shortcode( 'language', 'get_language_shortcode' );

function wpse_136058_debug_admin_menu() {

    echo '<pre>' . print_r( $GLOBALS[ 'menu' ], TRUE) . '</pre>';
}

add_action('admin_enqueue_scripts', 'ds_admin_theme_style');
add_action('login_enqueue_scripts', 'ds_admin_theme_style');
function ds_admin_theme_style() {
	if (!current_user_can( 'manage_options' )) {
		echo '
		
		<style>
		#wpseo-dashboard-overview { display: none; }
		.wrap .error { display: none; }
		.update-nag.notice.notice-warning.inline {
			display: none;
		}

		
		</style>';
	}
}

function remove_menu() {

	if (!is_super_admin()) {
	remove_menu_page('vc-welcome');
	remove_menu_page('wpseo_redirects');
	remove_menu_page('cptui_main_menu');
    remove_menu_page('edit-comments.php');
    //remove_menu_page('edit.php?post_type=page');
    remove_menu_page('themes.php');
    remove_menu_page('plugins.php');
    remove_menu_page('tools.php');
    remove_menu_page('edit.php?post_type=acf-field-group');
	  }

	

}




function hk_remove_dashboard_widgets() {
	global $wp_meta_boxes;

	remove_meta_box( 'dashboard_primary','dashboard','side' ); // WordPress.com Blog
	remove_meta_box( 'dashboard_plugins','dashboard','normal' ); // Plugins
	remove_meta_box( 'dashboard_right_now','dashboard', 'normal' ); // Tin nhanh
	remove_action( 'welcome_panel','wp_welcome_panel' ); // Welcome Panel
	remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel'); // Giới thiệu Gutenberg
	remove_meta_box('dashboard_quick_press','dashboard','side'); // Bản nháp
	remove_meta_box('dashboard_recent_drafts','dashboard','side'); // Bản nháp gần đây
	remove_meta_box('dashboard_secondary','dashboard','side'); // WordPress News
	remove_meta_box('dashboard_recent_comments','dashboard','normal'); // Bình luận
	remove_meta_box('dashboard_activity','dashboard', 'normal'); // Hoạt động

	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health'] ); // Tình trạng website
}
add_action( 'wp_dashboard_setup', 'hk_remove_dashboard_widgets' );
add_action('admin_menu' , 'remove_menu');



function hk_welcome_dashboard() {
    global $wp_meta_boxes;
    wp_add_dashboard_widget('custom_support_widget', 'Dashboard', 'hk_dashboard_content');
}

function hk_dashboard_content() { ?>
	
	<div class="default-container">
		<h2>TRUY CẬP NHANH</h2>
		<hr>
	</div>

	<div class="icon-container"> 
	  	<div class="column">
			<a href="/wp-admin/post-new.php?post_type=gamelist" class="add">Thêm game mới</a>
		</div>
		<div class="column">
			<a href="/wp-admin/post-new.php" class="add">Thêm tin game mới</a>
		</div>
		
        <div class="column">
			<a href="/wp-admin/admin.php?page=theme-general-settings
  	" class="add">Cài đặt trang chủ</a>
		</div>
     
		

  	</div>





	<!-- STYLE CSS -->
	<style>
	#wpbody-content #dashboard-widgets #postbox-container-1 {
    	width: 100%;
	}
	.default-container {
		display: grid;
		grid-template-columns: 1fr;
		padding: 20px 20px 0px 20px;
		text-align: center;
	}
	.default-container hr {
		height: 3px;
		background: #ebebeb;
		border: none;
		outline: none;
		width:10%;
		margin:1em auto;
		position: relative;
	}
	.icon-container {
		display: grid;
		grid-template-columns: 1fr 1fr 1fr 1fr;
		padding: 20px;
		text-align: center;
	}
	@media (max-width: 520px) {
		.icon-container {
			grid-template-columns: none;
			padding: 0px;
		}
	}
	@media (min-width: 521px) and (max-width: 767px) {
		.icon-container {
			grid-template-columns: 1fr 1fr;
			padding: 0px;
		}
	}
	@media (min-width: 768px) and (max-width: 990px) {
		.icon-container {
			grid-template-columns: 1fr 1fr 1fr;
			padding: 0px;
		}
	}
	.icon-container .column {
		background: #fff; 
		box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
		color: #000;
		font-family: "Ubuntu", sans-serif;
		font-size: 16px;
		margin: 3%;
		padding: 30px; 
		transition: background-color 0.5s ease;
		text-transform: uppercase;
		text-align: center;
		text-decoration: none;
	}
	.icon-container .column a {
		color: #000;
		text-decoration: none;
	}
	.icon-container .column a:before {
		font-family: "dashicons";
		font-size: 34px;
		display: block;
		color: #2681B0;
		margin-bottom: 4px;
	}
	.icon-container .column:hover {
		background: #f9f9f9;
	}
	.icon-container .pages:before {
		content: "\f123";
	}
	.icon-container .posts:before {
		content: "\f109";
	}
	.icon-container .add:before {
		content: "\f133";
	}
	.icon-container .media:before {
		content: "\f104";
	}
	.icon-container .plugin:before {
		content: "\f106";
	}
	.icon-container .theme:before {
		content: "\f100";
	}
	.icon-container .settings:before {
		content: "\f108";
	}
	</style>

<?php }
add_action('wp_dashboard_setup', 'hk_welcome_dashboard');

?>