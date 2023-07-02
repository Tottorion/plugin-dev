<?php
/**
 * @package Current_DateTime_JS
 * @version 1.0.0
 */
/*
Plugin Name: Current Datetime JS
Plugin URI: http://wordpress.org/plugins/
Description: JavaScriptで管理画面右上に現在日時を表示します。
Author: 01塾 ex講師
Version: 1.0.0
Author URI: https://zero1-pg.com/
*/



// This just echoes the chosen line, we'll position it later.
function ex01_current_datetime_js()
{
	echo "<div id='current-time'></div>
	<script type='text/javascript'>
function updateTime() {
  const now = new Date();
  const hours = now.getHours().toString().padStart(2, '0');
  const minutes = now.getMinutes().toString().padStart(2, '0');
  const seconds = now.getSeconds().toString().padStart(2, '0');
  const timeString = hours + ':' + minutes + ':' + seconds;
  document.getElementById('current-time').textContent = timeString;
}

setInterval(updateTime, 1000);
</script>";
}

// Now we set that function up to execute when the admin_notices action is called.
add_action('admin_notices', 'ex01_current_datetime_js');

// We need some CSS to position the paragraph.
function ex01_current_datetime_js_css()
{
	echo "
	<style type='text/css'>
	#current-time {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #current-time {
		float: left;
	}
	.block-editor-page #current-time {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#current-time,
		.rtl #current-time {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action('admin_head', 'ex01_current_datetime_js_css');