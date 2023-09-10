<?php
/*
Plugin Name: Bgcolor Changer
Plugin URI: https://your-website.com/
Description: このプラグインはショートコードを使用して全体の背景色を変更します。使用方法: [shortcode]#カラーコード[/shortcode] 。不正なカラーコードが入力された場合、エラーメッセージが表示されます。
Author: 01塾 ex講師
Version: 1.0.0
Author URI: https://zero1-pg.com/
*/

// メイン処理
function bgcolor_changer_shortcode($atts, $content = null) {
	// Check if the color code is valid
	if (preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', trim($content))) {
		// 背景色
		$bgcolor = esc_html(trim($content));
		// グラデーションの角度
		$linear_gradient = esc_attr(get_option('bg-color-changer-linear-gradient'));
		$output = '<style>body {background: linear-gradient(' . $linear_gradient . 'deg, ' . $bgcolor . ', #fff)}</style>';
	} else {
		$output = '<div style="color: red;">エラー: 不正なカラーコードが入力されました。</div>';
	}
	return $output;
}
add_shortcode('bgcolor_changer', 'bgcolor_changer_shortcode');

// 管理メニューを追加
function bgcolor_changer_plugin_menu() {
	add_menu_page(
		'背景色変更プラグイン', // ページタイトル（必須）
		'背景色変更', // メニュータイトル（必須）
		'manage_options', // 権限（必須）
		'bg-color-changer-settings', // ページを開いた際のURL（必須）
		'bgcolor_changer_settings_page' // 画面内容を出力する関数
	);
}

// 管理メニューがクリックされた際のコールバック
function bgcolor_changer_settings_page() {
	echo '<div class="wrap">';
	echo '<h2>背景色変更プラグイン設定画面</h2>';

	// 設定の保存処理
	if (isset($_POST['bg-color-changer-linear-gradient'])) {
		update_option('bg-color-changer-linear-gradient', $_POST['bg-color-changer-linear-gradient']);
		echo '<div class="updated"><p>設定変更しました。</p></div>';
	}

	// 設定フォーム
	echo '<form method="post" action="">';
	echo '<label for="bg-color-changer-linear-gradient">グラデーションの角度： </label>';
	echo '<input type="text" name="bg-color-changer-linear-gradient" value="' . esc_attr(get_option('bg-color-changer-linear-gradient')) . '">';
	echo '<br>';
	echo '<input type="submit" name="submit" class="button button-primary" value="変更">';
	echo '</form>';
	echo '</div>';
}

// 管理メニューのフックを追加
add_action('admin_menu', 'bgcolor_changer_plugin_menu');

// プラグインがアンインストール（削除）された際の処理
register_uninstall_hook(__FILE__, 'bgcolor_changer_uninstall');
function bgcolor_changer_uninstall() {
	// グラデーションの角度を削除
	delete_option('bg-color-changer-linear-gradient');
}
