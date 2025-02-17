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
add_action('admin_post_nopriv_custom_register_action', 'custom_register_user');

function custom_register_user()
{
	// global $wpdb; // Kết nối database của WordPress

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
	$pw2		= sanitize_text_field($_POST['pw2']);

	// Kiểm tra dữ liệu đầu vào
	if (empty($username) || empty($password) || empty($re_password) || empty($email) || empty($phone)) {
		wp_die('Vui lòng điền đầy đủ thông tin.');
	}

	// Kiểm tra username đã tồn tại chưa
	if (username_exists($username)) {
		wp_die('Tên tài khoản đã tồn tại. Vui lòng chọn tên khác.');
	}
	if (email_exists($email)) {
		wp_die('Email đã được sử dụng. Vui lòng chọn email khác.');
	}
	$existing_phone = get_users([
		'meta_key'   => 'phone',
		'meta_value' => $phone,
		'number'     => 1,
	]);
	if (!empty($existing_phone)) {
		wp_die('Số điện thoại đã được sử dụng trong WordPress.');
	}

	// Kiểm tra mật khẩu nhập lại
	if ($password !== $re_password) {
		wp_die('Mật khẩu nhập lại không khớp.');
	}

	// Kiểm tra độ dài username
	if (!preg_match('/^[a-zA-Z0-9]{6,20}$/', $username)) {
		wp_die('Tên tài khoản không hợp lệ.');
	}

	// Kiểm tra số điện thoại
	if (!preg_match('/^[0-9]{10,12}$/', $phone)) {
		wp_die('Số điện thoại không hợp lệ.');
	}
	if (!preg_match('/^[0-9]{1,6}$/', $pw2)) {
		wp_die('Số điện thoại không hợp lệ.');
	}
	// session_start(); // Đảm bảo session được khởi động

	if (!isset($_SESSION['captcha_code'])) {
		wp_die('Lỗi session, vui lòng thử lại.');
	}

	// Ép kiểu $_POST['captcha'] về integer để so sánh đúng
	if ((int)$_POST['captcha'] !== $_SESSION['captcha_code']) {
		wp_die('Mã CAPTCHA không chính xác.');
	}


	// Xóa CAPTCHA sau khi kiểm tra để tránh spam
	unset($_SESSION['captcha_code']);


	// Tạo user mới trên WordPress
	$user_id = wp_create_user($username, $password, $email);
	if (is_wp_error($user_id)) {
		wp_die('Có lỗi xảy ra khi tạo tài khoản.');
	}

	// Thêm số điện thoại vào user meta
	update_user_meta($user_id, 'phone', $phone);

	// 🔥 **Kết nối database của hệ thống game MU hoặc hệ thống khác**
	$db_host = '127.0.0.1'; // Thay đổi nếu cần
	$db_name = 'dbaccount'; // Tên database của bảng `db_account`
	$db_user = 'root'; // User DB
	$db_pass = '123123aB'; // Mật khẩu DB

	$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

	if ($mysqli->connect_error) {
		wp_die('Lỗi kết nối database game.');
	}

	// Hash mật khẩu nếu hệ thống MU cần mã hóa
	$hashed_password = md5($password); // Nếu hệ thống game sử dụng MD5, thay bằng bcrypt nếu cần

	// Chèn user vào bảng `db_account`
	$stmt = $mysqli->prepare("INSERT INTO t_account (name, pwd, pw2) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $username, $hashed_password, $pw2);

	if (!$stmt->execute()) {
		wp_die('Lỗi khi tạo tài khoản trong hệ thống game.');
	}

	// Đóng kết nối
	$stmt->close();
	$mysqli->close();

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
	if ((int)$_POST['captcha'] !== $_SESSION['captcha_code']) {
		wp_die('Mã CAPTCHA không chính xác.');
	}

	// Xóa CAPTCHA sau khi kiểm tra để tránh spam
	unset($_SESSION['captcha_code']);

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
 */ function handle_send_verification_link()
{
	if (
		!isset($_POST['send_verification_link_nonce']) ||
		!wp_verify_nonce($_POST['send_verification_link_nonce'], 'send_verification_link_action')
	) {
		wp_die('Lỗi bảo mật! Vui lòng thử lại.');
	}

	$user = wp_get_current_user();
	$email = $user->user_email;
	$username = $user->user_login;

	// Tạo mã xác thực
	$verification_code = wp_generate_password(32, false);
	update_user_meta($user->ID, 'email_verification_code', $verification_code);

	$verification_link = site_url("/verify-email?code=$verification_code&user={$user->ID}");

	$subject = "Xác minh email của bạn";
	$message = "Chào bạn $username,\n\nBạn hoặc ai đó đã yêu cầu xác minh email tại " . site_url() . "\n\nĐể xác minh email, nhấp vào link sau:\n\n$verification_link\n\nNếu không phải bạn, hãy bỏ qua email này.";
	$headers = ['Content-Type: text/plain; charset=UTF-8'];

	wp_mail($email, $subject, $message, $headers);

	// Hiển thị thông báo thay vì chuyển hướng
	echo '<script>alert("✅ Email xác minh đã được gửi. Vui lòng kiểm tra hộp thư của bạn."); window.location.href="' . site_url('/') . '";</script>';
	exit;
}

add_action('admin_post_send_verification_link', 'handle_send_verification_link');
add_action('admin_post_nopriv_send_verification_link', 'handle_send_verification_link');

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


function cash_management_admin_menu()
{
	add_menu_page(
		'Quản lý nạp tiền',    // Tiêu đề trang
		'💰 Nạp tiền',         // Tên menu sidebar
		'manage_options',      // Quyền hạn (chỉ admin)
		'cash-management',     // Slug của trang
		'render_cash_management_page', // Hàm hiển thị nội dung
		'dashicons-money',     // Icon menu (WordPress Dashicons)
		20                     // Vị trí hiển thị
	);

	// Thêm submenu "Lịch sử nạp tiền"
	add_submenu_page(
		'cash-management',
		'Lịch sử nạp tiền',
		'📜 Lịch sử',
		'manage_options',
		'cash-history',
		'show_cash_transactions'
	);
}
add_action('admin_menu', 'cash_management_admin_menu');
function add_cash_to_user($user_id, $amount)
{
	global $wpdb;

	$user_id = intval($user_id);
	$amount = intval($amount);

	if ($user_id <= 0 || $amount <= 0) {
		return ['status' => 'error', 'message' => '❌ Vui lòng nhập số tiền hợp lệ!'];
	}

	// Lấy số dư hiện tại của user
	$current_balance = $wpdb->get_var("SELECT user_balance FROM wp_users WHERE ID = $user_id");

	// Nếu user chưa có số dư, đặt về 0
	if ($current_balance === null) {
		$current_balance = 0;
	}

	// Cập nhật số dư mới
	$new_balance = $current_balance + $amount;
	$wpdb->update(
		'wp_users',
		['user_balance' => $new_balance],
		['ID' => $user_id],
		['%d'],
		['%d']
	);

	// Lưu lịch sử giao dịch vào user_meta
	$transactions = get_user_meta($user_id, 'cash_transactions', true);
	if (!is_array($transactions)) {
		$transactions = [];
	}

	$transactions[] = [
		'amount' => $amount,
		'date'   => current_time('mysql'),
		'admin'  => wp_get_current_user()->user_login
	];

	update_user_meta($user_id, 'cash_transactions', $transactions);

	return ['status' => 'success', 'message' => '✅ Đã nạp ' . number_format($amount, 0, ',', '.') . ' VND vào tài khoản User ID: ' . $user_id];
}


function render_cash_management_page()
{
	if (isset($_POST['submit_cash'])) {
		$result = add_cash_to_user($_POST['user_id'], $_POST['amount']);
		echo '<div class="' . ($result['status'] === 'success' ? 'updated' : 'error') . '"><p>' . $result['message'] . '</p></div>';
	}

?>
	<div class="wrap">
		<h1>💰 Nạp tiền cho User</h1>
		<form method="post">
			<table class="form-table">
				<tr>
					<th><label for="user_id">🔎 Chọn User:</label></th>
					<td>
						<select name="user_id" id="user_id">
							<?php
							$users = get_users();
							foreach ($users as $user) {
								echo '<option value="' . esc_attr($user->ID) . '">' . esc_html($user->user_login) . ' (' . esc_html($user->user_email) . ')</option>';
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<th><label for="amount">💰 Số tiền cần nạp:</label></th>
					<td><input type="number" name="amount" id="amount" required min="1"></td>
				</tr>
			</table>
			<p><input type="submit" name="submit_cash" value="Nạp tiền" class="button button-primary"></p>
		</form>
	</div>
<?php
}


function show_cash_transactions()
{
	echo "<div class='wrap'><h1>📜 Lịch sử nạp tiền</h1>";
	$users = get_users();

	echo "<table class='widefat'><thead><tr><th>User</th><th>Số tiền</th><th>Ngày</th><th>Admin</th></tr></thead><tbody>";
	foreach ($users as $user) {
		$transactions = get_user_meta($user->ID, 'cash_transactions', true);
		if ($transactions) {
			foreach ($transactions as $txn) {
				echo "<tr>
                    <td>{$user->user_login}</td>
                    <td><strong>" . number_format($txn['amount'], 0, ',', '.') . " VND</strong></td>
                    <td>{$txn['date']}</td>
                    <td>{$txn['admin']}</td>
                </tr>";
			}
		}
	}
	echo "</tbody></table></div>";
}

function get_user_wallet_balance($user_id)
{
	global $wpdb;

	$user_id = intval($user_id);
	if ($user_id <= 0) return 0;

	// Lấy số dư của user từ bảng wp_users
	$balance = $wpdb->get_var("SELECT user_balance FROM wp_users WHERE ID = $user_id");

	return $balance ? intval($balance) : 0;
}


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