<?php

/**
 * 时间工具类
 * Class DateTool
 * 工具函数：
 * get_today_week_str 得到今天是星期几的中文字符串
 * get_milli_second 获得毫秒级时间戳
 */
class DateTool {
	/**
	 * 得到今天是星期几的中文字符串
	 * @return string
	 */
	static function get_today_week_str() {
		$ji = array("日", "一", "二", "三", "四", "五", "六",);
		$j = date( "w" );
		return "星期" . $ji[$j];
	}

	/**
	 * 获得毫秒级时间戳
	 * @return float
	 */
	static function get_milli_second() {
		list( $t1, $t2 ) = explode( ' ', microtime() );
		return (float) sprintf( '%.0f', ( floatval( $t1 ) + floatval( $t2 ) ) * 1000 );
	}
}

?>