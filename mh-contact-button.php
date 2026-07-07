<?php
/**
 * Plugin Name: MH Contact Button - minhhan.net
 * Plugin URI:  https://minhhan.net
 * Description: Phiên bản 2.1: Đồng bộ Animation tuyệt đối (DOM Reflow), Căn trục dọc Pixel-perfect, Tối ưu UI Mobile.
 * Version:     2.1
 * Author:      MinhHan
 * License:     GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 1. TÍNH NĂNG QUÉT CACHE & HIỂN THỊ CẢNH BÁO
 */
add_action('admin_notices', 'mhc_check_cache_plugins_notice');
function mhc_check_cache_plugins_notice() {
    if ( !isset($_GET['page']) || $_GET['page'] !== 'mh-contact-settings' ) return;

    $cache_plugins = [
        'litespeed-cache/litespeed-cache.php' => 'LiteSpeed Cache',
        'wp-super-cache/wp-cache.php'         => 'WP Super Cache',
        'w3-total-cache/w3-total-cache.php'   => 'W3 Total Cache',
        'wp-rocket/wp-rocket.php'             => 'WP Rocket',
        'autoptimize/autoptimize.php'         => 'Autoptimize',
        'sg-cachepress/sg-cachepress.php'     => 'SiteGround Security & Cache',
        'wp-fastest-cache/wpFastestCache.php' => 'WP Fastest Cache'
    ];

    $active_caches = [];
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    foreach ( $cache_plugins as $path => $name ) {
        if ( is_plugin_active( $path ) ) {
            $active_caches[] = $name;
        }
    }

    if ( !empty($active_caches) ) {
        $plugin_names = implode(', ', $active_caches);
        echo '<div class="notice notice-warning is-dismissible">
                <p><strong>Lưu ý:</strong> Website đang sử dụng plugin (<strong>' . esc_html($plugin_names) . '</strong>). Sau khi <i>lưu cấu hình</i>, <strong>vui lòng xoá cache </strong> để thay đổi có hiệu lực.</p>
              </div>';
    }
}

/**
 * 2. TẠO MENU CHÍNH & ĐĂNG KÝ TRƯỜNG DỮ LIỆU
 */
add_action('admin_menu', 'mhc_add_admin_menu');
function mhc_add_admin_menu() {
    add_menu_page(
        'MH Contact Button - minhhan.net',
        'MH Contact', 
        'manage_options', 
        'mh-contact-settings', 
        'mhc_create_admin_page', 
        'dashicons-format-chat', 
        80
    );
}

add_action('admin_init', 'mhc_settings_init');
function mhc_settings_init() {
    $fields = [
        'mhc_phone', 'mhc_email', 'mhc_zalo', 'mhc_messenger', 'mhc_telegram', 'mhc_discord', 
        'mhc_position', 'mhc_size', 'mhc_wave_effect', 'mhc_cta_text',
        'mhc_color_type', 'mhc_single_color',
        'mhc_color_phone', 'mhc_color_email', 'mhc_color_group', 'mhc_color_zalo', 'mhc_color_messenger', 'mhc_color_telegram', 'mhc_color_discord'
    ];
    foreach ($fields as $field) {
        register_setting('mhc_settings_group', $field);
    }
}

/**
 * 3. GIAO DIỆN TRANG QUẢN TRỊ (UI)
 */
function mhc_create_admin_page() {
    $position   = get_option('mhc_position', 'right');
    $size       = get_option('mhc_size', '50');
    $wave       = get_option('mhc_wave_effect', '1');
    $color_type = get_option('mhc_color_type', 'default');
    ?>
    <style>
        .mhc-admin-wrap { display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px; font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif; }
        .mhc-admin-main { flex: 1; min-width: 500px; background: #fff; padding: 25px; border: 1px solid #ccd0d4; border-radius: 6px; }
        .mhc-admin-sidebar { width: 350px; }
        .mhc-card { background: #fff; padding: 20px; border: 1px solid #ccd0d4; border-radius: 6px; margin-bottom: 20px; }
        .section-title { font-weight: bold; font-size: 15px; color: #2271b1; margin-top: 20px; border-bottom: 1px solid #f0f0f1; padding-bottom: 5px; }
        .color-group { display: none; margin-top: 10px; background: #f6f7f7; padding: 15px; border-left: 4px solid #2271b1; }
        .color-group.active { display: block; }
    </style>
    
    <div class="wrap">
        <h2>Cài Đặt MH Contact Button - minhhan.net</h2>
        <div class="mhc-admin-wrap">
            <div class="mhc-admin-main">
                <form method="post" action="options.php">
                    <?php settings_fields('mhc_settings_group'); ?>
                    
                    <div class="section-title">1. Tùy biến Màu sắc</div>
                    <table class="form-table">
                        <tr>
                            <th scope="row">Chế độ màu</th>
                            <td>
                                <select name="mhc_color_type" id="mhcColorType">
                                    <option value="default" <?php selected($color_type, 'default'); ?>>Mặc định</option>
                                    <option value="single" <?php selected($color_type, 'single'); ?>>Tối giản</option>
                                    <option value="custom" <?php selected($color_type, 'custom'); ?>>Tuỳ chỉnh</option>
                                </select>
                                
                                <div id="mhcSingleColor" class="color-group <?php echo ($color_type == 'single') ? 'active' : ''; ?>">
                                    <label>Chọn màu chung:</label> <input type="color" name="mhc_single_color" value="<?php echo esc_attr(get_option('mhc_single_color', '#2271b1')); ?>" />
                                </div>
                                
                                <div id="mhcCustomColor" class="color-group <?php echo ($color_type == 'custom') ? 'active' : ''; ?>">
                                    <p>Phone: <input type="color" name="mhc_color_phone" value="<?php echo esc_attr(get_option('mhc_color_phone', '#4CAF50')); ?>" /></p>
                                    <p>Email: <input type="color" name="mhc_color_email" value="<?php echo esc_attr(get_option('mhc_color_email', '#EA4335')); ?>" /></p>
                                    <p>MXH: <input type="color" name="mhc_color_group" value="<?php echo esc_attr(get_option('mhc_color_group', '#37474F')); ?>" /></p>
                                    <p>Zalo: <input type="color" name="mhc_color_zalo" value="<?php echo esc_attr(get_option('mhc_color_zalo', '#0068FF')); ?>" /></p>
                                    <p>Messenger: <input type="color" name="mhc_color_messenger" value="<?php echo esc_attr(get_option('mhc_color_messenger', '#0084FF')); ?>" /></p>
                                    <p>Telegram: <input type="color" name="mhc_color_telegram" value="<?php echo esc_attr(get_option('mhc_color_telegram', '#26A5E4')); ?>" /></p>
                                    <p>Discord: <input type="color" name="mhc_color_discord" value="<?php echo esc_attr(get_option('mhc_color_discord', '#5865F2')); ?>" /></p>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <div class="section-title">2. Giao diện & Hiệu ứng</div>
                    <table class="form-table">
                        <tr>
                            <th scope="row">Vị trí hiển thị</th>
                            <td>
                                <select name="mhc_position">
                                    <option value="right" <?php selected($position, 'right'); ?>>Bên Phải</option>
                                    <option value="left" <?php selected($position, 'left'); ?>>Bên Trái</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Kích thước nút (px)</th>
                            <td>
                                <input type="number" name="mhc_size" value="<?php echo esc_attr($size); ?>" class="small-text" min="20" max="80" />
                                <p class="description">Kích thước từ 20px đến 80px.</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Hiệu ứng</th>
                            <td><label><input type="checkbox" name="mhc_wave_effect" value="1" <?php checked($wave, '1'); ?> /> Kích hoạt hiệu ứng shake</label></td>
                        </tr>
                        <tr>
                            <th scope="row">Tiêu đề (Call-To-Action)</th>
                            <td>
                                <input type="text" name="mhc_cta_text" value="<?php echo esc_attr(get_option('mhc_cta_text')); ?>" class="regular-text" placeholder="Ví dụ: Liên hệ ngay!" />
                            </td>
                        </tr>
                    </table>

                    <div class="section-title">3. Liên Hệ</div>
                    <table class="form-table">
                        <tr>
                            <th scope="row">Số Điện Thoại</th>
                            <td><input type="text" name="mhc_phone" value="<?php echo esc_attr(get_option('mhc_phone')); ?>" class="regular-text" placeholder="0987654321" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td><input type="email" name="mhc_email" value="<?php echo esc_attr(get_option('mhc_email')); ?>" class="regular-text" placeholder="contact@minhhan.net" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Zalo (SĐT)</th>
                            <td><input type="text" name="mhc_zalo" value="<?php echo esc_attr(get_option('mhc_zalo')); ?>" class="regular-text" placeholder="0987654321" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Messenger (ID/Username)</th>
                            <td><input type="text" name="mhc_messenger" value="<?php echo esc_attr(get_option('mhc_messenger')); ?>" class="regular-text" placeholder="yourpageID" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Telegram (ID/Link)</th>
                            <td><input type="text" name="mhc_telegram" value="<?php echo esc_attr(get_option('mhc_telegram')); ?>" class="regular-text" placeholder="username hoặc https://t.me/..." /></td>
                        </tr>
                        <tr>
                            <th scope="row">Discord (Link mời)</th>
                            <td><input type="url" name="mhc_discord" value="<?php echo esc_attr(get_option('mhc_discord')); ?>" class="regular-text" placeholder="Bắt buộc nhập full link: https://discord.gg/..." /></td>
                        </tr>
                    </table>
                    
                    <?php submit_button('Lưu Cấu Hình'); ?>
                </form>
            </div>

            <div class="mhc-admin-sidebar">
                <div class="mhc-card">
                    <h3>Giới thiệu tác giả</h3>
                    <p><strong>MinhHan</strong> - Giảng viên, System Admin & Nhà sáng lập Hân Nguyễn CCTV.</p>
                    <p>Plugin được thiết kế tối giản, loại bỏ hoàn toàn render block, đảm bảo tính đồng bộ hoàn hảo ở mức pixel và tối ưu tốc độ load server.</p>
                    <p>🌐 <a href="https://minhhan.net" target="_blank">minhhan.net</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('mhcColorType').addEventListener('change', function() {
        document.getElementById('mhcSingleColor').classList.remove('active');
        document.getElementById('mhcCustomColor').classList.remove('active');
        if(this.value === 'single') document.getElementById('mhcSingleColor').classList.add('active');
        if(this.value === 'custom') document.getElementById('mhcCustomColor').classList.add('active');
    });
    </script>
    <?php
}

/**
 * 4. HIỂN THỊ HTML & LOGIC JS ĐỒNG BỘ TIMELINE (REFLOW)
 */
add_action('wp_footer', 'mhc_display_buttons');
function mhc_display_buttons() {
    $phone = get_option('mhc_phone'); 
    $email = get_option('mhc_email');
    $zalo_raw = get_option('mhc_zalo'); 
    $messenger_raw = get_option('mhc_messenger');
    $telegram_raw = get_option('mhc_telegram'); 
    $discord = get_option('mhc_discord');
    $cta_text = get_option('mhc_cta_text');
    
    $zalo = (!empty($zalo_raw) && strpos($zalo_raw, 'http') === false) ? 'https://zalo.me/' . preg_replace('/[^0-9a-zA-Z]/', '', $zalo_raw) : $zalo_raw;
    $messenger = (!empty($messenger_raw) && strpos($messenger_raw, 'http') === false) ? 'https://m.me/' . trim($messenger_raw, '/@') : $messenger_raw;
    $telegram = (!empty($telegram_raw) && strpos($telegram_raw, 'http') === false) ? 'https://t.me/' . trim($telegram_raw, '/@') : $telegram_raw;

    $has_mxh = (!empty($zalo) || !empty($messenger) || !empty($telegram) || !empty($discord));
    if (empty($phone) && empty($email) && !$has_mxh) return;

    // Các class hiệu ứng cơ sở
    $wave_class = (get_option('mhc_wave_effect', '1') === '1') ? ' mhc-wave-active' : '';
    $shake_class = (get_option('mhc_wave_effect', '1') === '1') ? ' mhc-shake-active' : '';
    $main_classes = $wave_class . $shake_class;
    
    $position = get_option('mhc_position', 'right');
    
    // THÊM CLASS mhc-animate-sync MẶC ĐỊNH ĐỂ CHẠY ANIMATION KHI LOAD TRANG
    echo '<div class="mhc-widget mhc-pos-' . $position . ' mhc-animate-sync" id="mhcWidget">';

    $cta_html = '';
    if (!empty($cta_text)) {
        $cta_html = '<span class="mhc-cta-text">' . esc_html($cta_text) . '</span>';
    }
    $cta_placed = false;

    // 1. NHÓM MXH MỞ DỌC LÊN TRÊN
    if ($has_mxh) {
        echo '<div class="mhc-item-wrapper">';
        echo $cta_html; 
        $cta_placed = true;

        echo '<button class="mhc-btn mhc-group-btn' . $main_classes . '" id="mhcToggle" title="Mạng xã hội">
            <svg class="mhc-icon-chat" viewBox="0 0 24 24"><title>Mở Mạng Xã Hội</title><path fill="currentColor" d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 9h12v2H6V9zm8 5H6v-2h8v2zm4-6H6V6h12v2z"/></svg>
            <svg class="mhc-icon-close" viewBox="0 0 24 24" style="display:none;"><title>Đóng</title><path fill="currentColor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
        </button>';
        
        echo '<div class="mhc-mxh-vertical" id="mhcMxhGroup">';
        if (!empty($zalo)) echo '<a href="' . esc_url($zalo) . '" class="mhc-btn mhc-zalo' . $shake_class . '" target="_blank" title="Zalo"><svg viewBox="0 0 24 24"><title>Zalo</title><path fill="currentColor" d="M11.98 2C6.47 2 2 6.13 2 11.23c0 2.63 1.25 5.05 3.32 6.75.18.15.3.36.27.6l-.38 2.53c-.07.47.45.82.88.58l2.76-1.52c.2-.11.43-.13.65-.08 1.14.28 2.37.43 3.65.43 5.51 0 9.98-4.13 9.98-9.23S17.49 2 11.98 2zm3.43 12.35H9.72c-.41 0-.74-.33-.74-.74 0-.41.33-.74.74-.74h2.95l-3.36-3.8c-.18-.21-.26-.45-.26-.72 0-.54.44-.98.98-.98h4.63c.41 0 .74.33.74.74 0 .41-.33.74-.74.74h-2.67l3.18 3.6c.19.22.29.47.29.74 0 .54-.44.98-.98.98z"/></svg></a>';
        if (!empty($messenger)) echo '<a href="' . esc_url($messenger) . '" class="mhc-btn mhc-messenger' . $shake_class . '" target="_blank" title="Messenger"><svg viewBox="0 0 24 24"><title>Messenger</title><path fill="currentColor" d="M12 2C6.48 2 2 6.14 2 11.25c0 2.91 1.45 5.51 3.71 7.17.19.14.3.36.29.6l-.04 1.78c-.01.59.58 1.04 1.14.85l1.99-.68c.19-.06.4-.04.57.06A10.323 10.323 0 0 0 12 20.5c5.52 0 10-4.14 10-9.25S17.52 2 12 2zm1.18 11.64l-2.09-2.23-4.08 2.23 4.49-4.77 2.14 2.23 4.02-2.23-4.48 4.77z"/></svg></a>';
        if (!empty($telegram)) echo '<a href="' . esc_url($telegram) . '" class="mhc-btn mhc-telegram' . $shake_class . '" target="_blank" title="Telegram"><svg viewBox="0 0 24 24"><title>Telegram</title><path fill="currentColor" d="M9.78 18.65c-.28 0-.24-.1-.37-.47l-1.37-4.51 10.05-6.33c.46-.28.89-.13.54.18l-8.15 7.36-.32 4.49c.44 0 .63-.2.88-.44l2.11-2.05 4.39 3.23c.8.45 1.38.22 1.58-.74l2.88-13.57c.29-1.16-.44-1.69-1.2-1.36L2.3 9.47c-1.13.45-1.12 1.09-.2 1.37l4.31 1.35 9.99-6.28c.47-.29.9-.13.55.18l-8.09 7.31-.31 4.49c.43 0 .62-.19.86-.43l2.12-2.06 4.35 3.21c.8.44 1.37.21 1.57-.75l2.9-13.59c.3-1.16-.43-1.68-1.2-1.35z"/></svg></a>';
        if (!empty($discord)) echo '<a href="' . esc_url($discord) . '" class="mhc-btn mhc-discord' . $shake_class . '" target="_blank" title="Discord"><svg viewBox="0 0 24 24"><title>Discord</title><path fill="currentColor" d="M19.27 4.73A16.13 16.13 0 0 0 14.93 3.4a11.4 11.4 0 0 0-.42.87 14.88 14.88 0 0 0-5 0 11.62 11.62 0 0 0-.43-.87 16.13 16.13 0 0 0-4.34 1.33A16.27 16.27 0 0 0 1.51 17.7a16.3 16.3 0 0 0 5 2.5 11.87 11.87 0 0 0 1-.65 11 11 0 0 1-1.63-.78 7.57 7.57 0 0 0 .14-.11 11.53 11.53 0 0 0 12 0 6.1 6.1 0 0 0 .14.11 11.33 11.33 0 0 1-1.62.78 12.3 12.3 0 0 0 1 .65 16.18 16.18 0 0 0 5.05-2.5 16.23 16.23 0 0 0-3.23-12.97zM8.51 14.11a1.44 1.44 0 0 1-1.35-1.48 1.44 1.44 0 0 1 1.35-1.48 1.45 1.45 0 0 1 1.36 1.48 1.45 1.45 0 0 1-1.36 1.48zm6.98 0a1.44 1.44 0 0 1-1.35-1.48 1.44 1.44 0 0 1 1.35-1.48 1.45 1.45 0 0 1 1.36 1.48 1.45 1.45 0 0 1-1.36 1.48z"/></svg></a>';
        echo '</div></div>';
    }

    // 2. NÚT PHONE
    if (!empty($phone)) {
        echo '<div class="mhc-item-wrapper">';
        if (!$cta_placed) { echo $cta_html; $cta_placed = true; }
        echo '<a href="tel:' . esc_attr($phone) . '" class="mhc-btn mhc-phone' . $main_classes . '" title="Gọi điện"><svg viewBox="0 0 24 24"><title>Điện thoại</title><path fill="currentColor" d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg></a>';
        echo '</div>';
    }

    // 3. NÚT EMAIL
    if (!empty($email)) {
        echo '<div class="mhc-item-wrapper">';
        if (!$cta_placed) { echo $cta_html; $cta_placed = true; }
        echo '<a href="mailto:' . esc_attr($email) . '" class="mhc-btn mhc-email' . $main_classes . '" title="Gửi Email"><svg viewBox="0 0 24 24"><title>Email</title><path fill="currentColor" d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg></a>';
        echo '</div>';
    }

    echo '</div>';

    // JS ĐỒNG BỘ ANIMATION BẰNG KỸ THUẬT DOM REFLOW
    if ($has_mxh) {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            var toggle = document.getElementById("mhcToggle");
            var mxhGroup = document.getElementById("mhcMxhGroup");
            var mhcWidget = document.getElementById("mhcWidget");
            
            if (toggle && mxhGroup && mhcWidget) {
                toggle.addEventListener("click", function(e) {
                    e.preventDefault();
                    
                    // Xử lý mở/đóng menu
                    mxhGroup.classList.toggle("mhc-active");
                    toggle.classList.toggle("mhc-btn-active");
                    mhcWidget.classList.toggle("is-active");
                    
                    toggle.querySelector(".mhc-icon-chat").style.display = mxhGroup.classList.contains("mhc-active") ? "none" : "block";
                    toggle.querySelector(".mhc-icon-close").style.display = mxhGroup.classList.contains("mhc-active") ? "block" : "none";

                    // ==========================================
                    // ÉP ĐỒNG BỘ NHỊP LẮC & SÓNG BẰNG REFLOW TRICK
                    // ==========================================
                    mhcWidget.classList.remove("mhc-animate-sync"); // Tạm tháo animation
                    void mhcWidget.offsetWidth;                     // Lệnh này buộc trình duyệt tính toán lại Render Tree
                    mhcWidget.classList.add("mhc-animate-sync");    // Lắp lại animation (tất cả sẽ chạy từ giây số 0 cùng nhau)
                });
            }
        });
        </script>';
    }
}

/**
 * 5. CSS STYLING & CĂN LỀ TRỤC DỌC (PIXEL-PERFECT)
 */
add_action('wp_head', 'mhc_frontend_css');
function mhc_frontend_css() {
    $pos = get_option('mhc_position', 'right');
    $size = intval(get_option('mhc_size', '50'));
    $svg_size = intval($size * 0.52);
    $color_type = get_option('mhc_color_type', 'default');
    
    $c_phone = '#4CAF50'; $c_email = '#EA4335'; $c_group = '#37474F';
    $c_zalo = '#0068FF'; $c_msg = '#0084FF'; $c_tele = '#26A5E4'; $c_dis = '#5865F2';

    if ($color_type === 'single') {
        $single = get_option('mhc_single_color', '#2271b1');
        $c_phone = $c_email = $c_group = $c_zalo = $c_msg = $c_tele = $c_dis = $single;
    } elseif ($color_type === 'custom') {
        $c_phone = get_option('mhc_color_phone', $c_phone);
        $c_email = get_option('mhc_color_email', $c_email);
        $c_group = get_option('mhc_color_group', $c_group);
        $c_zalo = get_option('mhc_color_zalo', $c_zalo);
        $c_msg = get_option('mhc_color_messenger', $c_msg);
        $c_tele = get_option('mhc_color_telegram', $c_tele);
        $c_dis = get_option('mhc_color_discord', $c_dis);
    }
    ?>
    <style>
        .mhc-widget {
            position: fixed; bottom: 30px; z-index: 99999;
            display: flex; flex-direction: column; gap: 12px;
            align-items: center; /* Đảm bảo mọi đối tượng bám sát trục giữa tuyệt đối */
            <?php echo ($pos === 'left') ? 'left: 30px;' : 'right: 30px;'; ?>
        }
        .mhc-item-wrapper { position: relative; display: flex; align-items: center; justify-content: center; }
        
        .mhc-btn {
            display: flex; align-items: center; justify-content: center;
            width: <?php echo $size; ?>px; height: <?php echo $size; ?>px;
            border-radius: 50%; color: #fff !important;
            text-decoration: none; box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            transition: all 0.3s ease; border: none; cursor: pointer; padding: 0; margin: 0;
            position: relative; z-index: 2; outline: none; box-sizing: border-box;
        }
        .mhc-btn svg { width: <?php echo $svg_size; ?>px; height: <?php echo $svg_size; ?>px; transition: transform 0.3s ease; }
        .mhc-btn:hover { transform: translateY(-4px); box-shadow: 0 6px 15px rgba(0,0,0,0.3); filter: brightness(110%); }

        /* Tiêu đề CTA */
        .mhc-cta-text {
            position: absolute; white-space: nowrap;
            background-color: #fff; color: #333;
            padding: 6px 14px; border-radius: 20px;
            font-size: 14px; font-weight: 600;
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
            pointer-events: none; transition: opacity 0.3s, visibility 0.3s;
            font-family: sans-serif;
        }
        .mhc-pos-right .mhc-cta-text { right: calc(100% + 15px); }
        .mhc-pos-left .mhc-cta-text { left: calc(100% + 15px); }
        .mhc-widget.is-active .mhc-cta-text { opacity: 0; visibility: hidden; }

        /* Màu sắc */
        .mhc-phone { background-color: <?php echo $c_phone; ?>; }
        .mhc-email { background-color: <?php echo $c_email; ?>; }
        .mhc-group-btn { background-color: <?php echo $c_group; ?>; }
        .mhc-zalo { background-color: <?php echo $c_zalo; ?>; }
        .mhc-messenger { background-color: <?php echo $c_msg; ?>; }
        .mhc-telegram { background-color: <?php echo $c_tele; ?>; }
        .mhc-discord { background-color: <?php echo $c_dis; ?>; }

        /* Nhóm MXH dọc */
        .mhc-mxh-vertical {
            position: absolute; bottom: 100%; left: 50%;
            transform: translateX(-50%) translateY(20px) scale(0.8);
            margin-bottom: 12px;
            display: flex; flex-direction: column-reverse; gap: 12px;
            align-items: center; /* Trục giữa nội bộ của thanh nổi */
            opacity: 0; pointer-events: none;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .mhc-mxh-vertical.mhc-active {
            opacity: 1; pointer-events: auto;
            transform: translateX(-50%) translateY(0) scale(1);
        }

        /* KHỞI ĐỘNG ANIMATION CHỈ KHI CÓ CLASS .mhc-animate-sync (Do JS cấp phép) */
        .mhc-animate-sync .mhc-wave-active::before {
            content: ''; position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            border-radius: 50%; background: inherit;
            z-index: -1; animation: mhcWave 2s infinite ease-out;
        }
        .mhc-animate-sync .mhc-shake-active svg { 
            animation: mhcShake 2s infinite ease-in-out; 
        }
        
        @keyframes mhcWave {
            0% { transform: scale(1); opacity: 0.6; }
            100% { transform: scale(1.6); opacity: 0; }
        }
        @keyframes mhcShake {
            0%, 100% { transform: rotate(0deg); }
            10%, 30%, 50% { transform: rotate(-12deg) scale(1.08); }
            20%, 40% { transform: rotate(12deg) scale(1.08); }
            60% { transform: rotate(0deg) scale(1); }
        }
    </style>
    <?php
}