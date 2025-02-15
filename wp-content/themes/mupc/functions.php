<?php

add_theme_support('post-thumbnails');
if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

function get_language_shortcode()
{
	return apply_filters('wpml_current_language', null);
}
add_shortcode('language', 'get_language_shortcode');

function wpse_136058_debug_admin_menu()
{

	echo '<pre>' . print_r($GLOBALS['menu'], TRUE) . '</pre>';
}

add_action('admin_enqueue_scripts', 'ds_admin_theme_style');
add_action('login_enqueue_scripts', 'ds_admin_theme_style');
function ds_admin_theme_style()
{
	if (!current_user_can('manage_options')) {
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

function remove_menu()
{

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




function hk_remove_dashboard_widgets()
{
	global $wp_meta_boxes;

	remove_meta_box('dashboard_primary', 'dashboard', 'side'); // WordPress.com Blog
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); // Plugins
	remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // Tin nhanh
	remove_action('welcome_panel', 'wp_welcome_panel'); // Welcome Panel
	remove_action('try_gutenberg_panel', 'wp_try_gutenberg_panel'); // Giới thiệu Gutenberg
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // Bản nháp
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); // Bản nháp gần đây
	remove_meta_box('dashboard_secondary', 'dashboard', 'side'); // WordPress News
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Bình luận
	remove_meta_box('dashboard_activity', 'dashboard', 'normal'); // Hoạt động

	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health']); // Tình trạng website
}
add_action('wp_dashboard_setup', 'hk_remove_dashboard_widgets');
add_action('admin_menu', 'remove_menu');



function hk_welcome_dashboard()
{
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_support_widget', 'Dashboard', 'hk_dashboard_content');
}


// Hook xử lý form đăng ký
add_action('admin_post_nopriv_custom_register_action', 'handle_custom_register');

function custom_register_user()
{
	// Kiểm tra nếu form được gửi đúng cách
	if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['action']) || $_POST['action'] !== 'custom_register_action') {
		wp_die('Lỗi bảo mật, vui lòng thử lại.');
	}

	// Kiểm tra nonce để tránh CSRF
	if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'custom_register_action')) {
		wp_die('Lỗi bảo mật, vui lòng thử lại.');
	}

	// Lấy dữ liệu từ form
	$username   = sanitize_user($_POST['username']);
	$password   = $_POST['password'];
	$re_password = $_POST['re_password'];
	$email      = sanitize_email($_POST['email']);
	$phone      = sanitize_text_field($_POST['phone']);
	$captcha    = sanitize_text_field($_POST['captcha']);



	// Kiểm tra dữ liệu đầu vào
	if (empty($username) || empty($password) || empty($re_password) || empty($email) || empty($phone) || empty($captcha)) {
		wp_die('Vui lòng điền đầy đủ thông tin.');
	}

	// Kiểm tra username đã tồn tại chưa
	if (username_exists($username)) {
		wp_die('Tên tài khoản đã tồn tại. Vui lòng chọn tên khác.');
	}

	// Kiểm tra email đã tồn tại chưa
	if (email_exists($email)) {
		wp_die('Email đã được sử dụng. Vui lòng chọn email khác.');
	}

	// Kiểm tra mật khẩu nhập lại
	if ($password !== $re_password) {
		wp_die('Mật khẩu nhập lại không khớp.');
	}

	// Kiểm tra độ dài mật khẩu
	if (strlen($password) < 6 || strlen($password) > 50) {
		wp_die('Mật khẩu phải từ 6 - 50 ký tự.');
	}

	// Kiểm tra độ dài username
	if (!preg_match('/^[a-zA-Z0-9]{6,20}$/', $username)) {
		wp_die('Tên tài khoản không hợp lệ.');
	}

	// Kiểm tra số điện thoại
	if (!preg_match('/^[0-9]{10,12}$/', $phone)) {
		wp_die('Số điện thoại không hợp lệ.');
	}
	// Kiểm tra mã captcha (giả định đã lưu trong session)
	add_action('init', 'start_session_custom');
	function start_session_custom()
	{
		if (!session_id()) {
			session_start();
		}
	}
	// $captcha_input = isset($_POST['captcha']) ? $_POST['captcha'] : '';
	// if (!isset($_SESSION['captcha_code']) || (string)$_SESSION['captcha_code'] !== $captcha_input) {
	// 	wp_die('Mã chống spam không chính xác.');
	// }

	// // Nếu đúng, xóa CAPTCHA khỏi session để không tái sử dụng
	// unset($_SESSION['captcha_code']);




	// Xóa captcha sau khi kiểm tra
	unset($_SESSION['captcha_code']);

	// Tạo user mới
	$user_id = wp_create_user($username, $password, $email);
	if (is_wp_error($user_id)) {
		wp_die('Có lỗi xảy ra khi tạo tài khoản.');
	}

	// Thêm số điện thoại vào user meta
	update_user_meta($user_id, 'phone', $phone);

	// Đăng nhập ngay sau khi đăng ký
	$creds = [
		'user_login'    => $username,
		'user_password' => $password,
		'remember'      => true,
	];
	$user = wp_signon($creds, false);
	if (is_wp_error($user)) {
		wp_die('Đăng nhập tự động thất bại.');
	}

	// Chuyển hướng sau khi đăng ký thành công
	wp_redirect(home_url('/'));
	exit;
}

// Gán hàm xử lý vào admin-post.php
add_action('admin_post_nopriv_custom_register_action', 'custom_register_user');


function custom_login_user()
{
	// Kiểm tra phương thức gửi dữ liệu và action
	if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['action']) || $_POST['action'] !== 'custom_login_action') {
		wp_die('Lỗi bảo mật, vui lòng thử lại.');
	}

	// Kiểm tra nonce để bảo vệ form khỏi CSRF
	if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'custom_login_action')) {
		wp_die('Lỗi bảo mật, vui lòng thử lại.');
	}

	// Lấy dữ liệu từ form và làm sạch dữ liệu đầu vào
	$username = sanitize_user($_POST['username']);
	$password = $_POST['password'];

	if (empty($username) || empty($password)) {
		wp_die('Vui lòng nhập đầy đủ thông tin đăng nhập.');
	}

	// Tạo mảng dữ liệu đăng nhập cho wp_signon()
	$creds = array(
		'user_login'    => $username,
		'user_password' => $password,
		'remember'      => isset($_POST['remember']) ? true : false,
	);

	// Xác thực người dùng bằng wp_signon()
	$user = wp_signon($creds, false);
	if (is_wp_error($user)) {
		wp_die('Đăng nhập thất bại: ' . $user->get_error_message());
	}

	// Kiểm tra quyền của người dùng để chuyển hướng phù hợp:
	// Nếu là quản trị viên (administrator) => chuyển về Dashboard admin
	// Ngược lại => chuyển về trang chủ "/"
	if (in_array('administrator', (array)$user->roles)) {
		wp_redirect(admin_url());
	} else {
		wp_redirect(home_url('/'));
	}
	exit;
}

// Hook xử lý khi người dùng chưa đăng nhập
add_action('admin_post_nopriv_custom_login_action', 'custom_login_user');
// Nếu cần xử lý cho người dùng đã đăng nhập cũng có thể dùng hook này:
add_action('admin_post_custom_login_action', 'custom_login_user');


function get_current_user_info()
{
	if (!is_user_logged_in()) {
		return false;
	}

	// Lấy object WP_User
	$current_user = wp_get_current_user();

	// Nếu có lỗi hoặc user = 0, trả về false
	if (!$current_user || 0 === $current_user->ID) {
		return false;
	}

	// Chuẩn bị mảng thông tin
	$user_info = array(
		'username'      => $current_user->user_login,
		'email'         => $current_user->user_email,
		'display_name'  => $current_user->display_name,
	);

	// Lấy user meta phone (nếu bạn có trường phone)
	$phone = get_user_meta($current_user->ID, 'phone', true);
	if (!empty($phone)) {
		$user_info['phone'] = $phone;
	}

	// Bạn có thể thêm các trường khác, ví dụ address, ...
	// $user_info['address'] = get_user_meta(...);

	return $user_info;
}

/**
 * Hàm xử lý đổi mật khẩu cho user đang đăng nhập.
 */
function handle_change_password()
{
	// Chỉ xử lý khi form được gửi bằng POST và action = change_password_action
	if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['action']) || $_POST['action'] !== 'change_password_action') {
		wp_die('Lỗi bảo mật hoặc sai phương thức gửi dữ liệu.');
	}

	// Kiểm tra nonce để tránh CSRF
	if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'change_password_action')) {
		wp_die('Lỗi bảo mật, vui lòng thử lại.');
	}

	// Kiểm tra user đã đăng nhập
	if (!is_user_logged_in()) {
		wp_die('Bạn chưa đăng nhập. Vui lòng đăng nhập trước.');
	}

	// Lấy user hiện tại
	$current_user = wp_get_current_user();
	if (!$current_user || 0 === $current_user->ID) {
		wp_die('Không tìm thấy người dùng.');
	}

	// Lấy dữ liệu từ form
	$old_password    = isset($_POST['old_password']) ? $_POST['old_password'] : '';
	$new_password    = isset($_POST['new_password']) ? $_POST['new_password'] : '';
	$re_new_password = isset($_POST['re_new_password']) ? $_POST['re_new_password'] : '';

	// Kiểm tra dữ liệu
	if (empty($old_password) || empty($new_password) || empty($re_new_password)) {
		wp_die('Vui lòng điền đầy đủ các trường.');
	}

	if ($new_password !== $re_new_password) {
		wp_die('Mật khẩu mới và xác nhận mật khẩu không khớp.');
	}

	// Xác minh mật khẩu cũ
	// Lấy hash của mật khẩu cũ từ database
	$hash = $current_user->user_pass;
	// Dùng wp_check_password để xác thực
	if (!wp_check_password($old_password, $hash, $current_user->ID)) {
		wp_die('Mật khẩu cũ không chính xác.');
	}

	$updated_user_id = wp_update_user(array(
		'ID'        => $current_user->ID,
		'user_pass' => $new_password
	));

	if (is_wp_error($updated_user_id)) {
		wp_die('Có lỗi xảy ra khi đổi mật khẩu: ' . $updated_user_id->get_error_message());
	}

	// Thành công: Chuyển hướng hoặc hiển thị thông báo
	wp_redirect(home_url('/?password_changed=1'));
	exit;
}

// Gắn hàm xử lý vào admin-post
add_action('admin_post_nopriv_change_password_action', 'handle_change_password'); // Nếu user chưa login
add_action('admin_post_change_password_action', 'handle_change_password');       // Nếu user đã login

/**
 * Gửi link xác minh email cho user đang đăng nhập
 */
function send_verification_link()
{
	// Kiểm tra method & action
	if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['action']) || $_POST['action'] !== 'send_verification_link') {
		wp_die('Lỗi bảo mật hoặc sai phương thức gửi dữ liệu.');
	}

	// Kiểm tra nonce
	if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'send_verification_link')) {
		wp_die('Lỗi bảo mật, vui lòng thử lại.');
	}

	// Kiểm tra user đăng nhập
	if (!is_user_logged_in()) {
		wp_die('Bạn chưa đăng nhập. Vui lòng đăng nhập trước.');
	}

	$current_user = wp_get_current_user();
	if (!$current_user || 0 === $current_user->ID) {
		wp_die('Không tìm thấy người dùng.');
	}

	// Tạo token ngẫu nhiên
	$token = wp_generate_password(20, false);
	// Lưu token vào user_meta
	update_user_meta($current_user->ID, 'email_verification_token', $token);
	// Bạn có thể lưu thêm thời gian hết hạn nếu muốn

	// Tạo link xác minh
	// Người dùng sẽ click link này => ?action=verify_email&token=...
	$verify_link = add_query_arg(array(
		'action' => 'verify_email',
		'token'  => $token,
	), home_url('/'));

	// Gửi email
	$subject = "Xác minh email";
	$message = "Chào bạn, vui lòng nhấn vào link sau để xác minh email: \n$verify_link\n";
	// Dùng wp_mail
	wp_mail($current_user->user_email, $subject, $message);

	// Chuyển hướng về trang chủ kèm query string báo đã gửi
	wp_redirect(home_url('/?email_verify_sent=1'));
	exit;
}
add_action('admin_post_nopriv_send_verification_link', 'send_verification_link');
add_action('admin_post_send_verification_link', 'send_verification_link');

/**
 * Hàm xử lý quên mật khẩu.
 * - Kiểm tra dữ liệu từ form (email).
 * - Tìm user tương ứng.
 * - Tạo token, lưu vào user_meta (có thể kèm thời gian hết hạn).
 * - Gửi mail cho user kèm link reset password.
 */
function handle_forgot_password()
{
	// 1. Kiểm tra method & action
	if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['action']) || $_POST['action'] !== 'custom_forgot_password') {
		wp_die('Lỗi bảo mật hoặc sai phương thức gửi dữ liệu.');
	}

	// 2. Kiểm tra nonce
	if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'custom_forgot_password')) {
		wp_die('Lỗi bảo mật, vui lòng thử lại.');
	}

	// 3. Lấy email từ form
	$email = sanitize_email($_POST['user_email']);
	if (empty($email) || !is_email($email)) {
		wp_die('Email không hợp lệ.');
	}

	// 4. Tìm user có email này
	$user = get_user_by('email', $email);
	if (!$user) {
		wp_die('Không tìm thấy tài khoản với email này.');
	}

	// 5. Tạo token reset password
	$token = wp_generate_password(20, false); // 20 ký tự, không ký tự đặc biệt
	update_user_meta($user->ID, 'reset_password_token', $token);

	// Lưu thời gian hết hạn (ví dụ 1 giờ = 3600 giây)
	update_user_meta($user->ID, 'reset_password_expires', time() + 3600);

	// 6. Tạo link reset
	// Người dùng sẽ click link => ?action=reset_password&token=...
	$reset_link = add_query_arg(array(
		'action' => 'reset_password',
		'token'  => $token,
	), home_url('/'));

	// 7. Gửi email
	$subject = "Khôi phục mật khẩu";
	$message = "Bạn đã yêu cầu khôi phục mật khẩu.\n"
		. "Nhấn vào link sau để đặt lại mật khẩu (có hiệu lực 1h):\n"
		. $reset_link . "\n";

	// Sử dụng wp_mail để gửi
	wp_mail($email, $subject, $message);

	// 8. Chuyển hướng về trang chủ (hoặc trang khác) kèm query string
	wp_redirect(home_url('/?reset_password_sent=1'));
	exit;
}

// Hook hàm xử lý
add_action('admin_post_nopriv_custom_forgot_password', 'handle_forgot_password');
add_action('admin_post_custom_forgot_password', 'handle_forgot_password');

function custom_logout()
{
	wp_logout();
	wp_redirect(home_url()); // Chuyển hướng về trang chủ sau khi logout
	exit();
}


function hk_dashboard_content()
{ ?>

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
			width: 10%;
			margin: 1em auto;
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