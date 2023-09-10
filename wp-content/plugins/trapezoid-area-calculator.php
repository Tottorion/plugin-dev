<?php
/*
Plugin Name: Trapezoid Area Calculator
Description: 台形の面積を求めて出力するプラグインです。[trapezoid_area base1="X" bottom="Y" height="Z"]という形式で使用します。
Author: 01塾 ex講師
Version: 1.0.0
Author URI: https://zero1-pg.com/
*/

function calculate_trapezoid_area($atts, $content = null)
{
	$attributes = shortcode_atts(
		array(
			'top' => 0,
			'bottom' => 0,
			'height' => 0,
		),
		$atts
	);

	$top = floatval($attributes['top']);
	$bottom = floatval($attributes['bottom']);
	$height = floatval($attributes['height']);

	$area = ($top + $bottom) * $height / 2;
	$resultMsg = "<p>上底が $top cmで、下底が $bottom cmで、高さが $height cmの台形の面積は $area cm2です。</p>";

	ob_start();
	echo $resultMsg;
	$output = ob_get_clean();
	return $output;
}
add_shortcode('trapezoid_area', 'calculate_trapezoid_area');
?>