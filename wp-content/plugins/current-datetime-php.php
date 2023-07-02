<?php
/**
 * @package Current_DateTime_PHP
 * @version 1.0.0
 */
/*
Plugin Name: Current Datetime PHP
Plugin URI: http://wordpress.org/plugins/
Description: PHPで管理画面右上に現在日時を表示します。
Author: 01塾 ex講師
Version: 1.0.0
Author URI: https://zero1-pg.com/
*/

function ex01_get_current_datetime_php()
{
	// 現在日時を取得する
	$currentDatetime = date('Y年m月d日 H時i分s秒');

	// 現在日時が入った変数を返す
	return $currentDatetime;
}

// This just echoes the chosen line, we'll position it later.
function ex01_current_datetime_php()
{
	$chosen = ex01_get_current_datetime_php();
	$lang = '';
	if ('en_' !== substr(get_user_locale(), 0, 3)) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="dolly"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__('Quote from Hello Dolly song, by Jerry Herman:'),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action('admin_notices', 'ex01_current_datetime_php');

// We need some CSS to position the paragraph.
function ex01_current_datetime_php_css()
{
	echo "
	<style type='text/css'>
	#dolly {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #dolly {
		float: left;
	}
	.block-editor-page #dolly {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#dolly,
		.rtl #dolly {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action('admin_head', 'ex01_current_datetime_php_css');