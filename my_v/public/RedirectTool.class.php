<?php

/**
 * 跳转工具类
 * Class RedirectTool
 * 工具函数：
 * redirect 向浏览器发送强制跳转
 */
class RedirectTool {
	/**
	 * +----------------------------------------------------------
	 * URL直接跳转
	 * +----------------------------------------------------------
	 * @param String $url 跳转URL
	 * @param Int 跳转时间（单位：秒）
	 * @param String $msg 跳转信息
	 */
	public static function redirect( $url, $time = 0, $msg = '' ) {
		//多行URL地址支持
		$url = str_replace( array("\n", "\r"), '', $url );
		if ( empty( $msg ) ) {
			$msg = "系统将在{$time}秒之后自动跳转到{$url}！";
		}
		if ( ! headers_sent() ) {
			// redirect
			if ( 0 === $time ) {
				header( "Location: " . $url );
			} else {
				header( "refresh:{$time};url={$url}" );
				echo( $msg );
			}
			exit();
		} else {
			$str = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
			if ( $time != 0 ) {
				$str .= $msg;
			}
			exit( $str );
		}
	}
}