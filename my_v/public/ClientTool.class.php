<?php

/**
 * 客户端工具类
 * Class ClientTool
 * 工具函数：
 * get_client_ip 获取用户ip
 * get_client_browser   获取访客浏览器类型
 * get_client_lang 获得访客浏览器语言
 * get_client_os 获取访客操作系统
 *
 *
 */
class ClientTool {
	/**
	 * +----------------------------------------------------------
	 * 获取客户端IP地址
	 * +----------------------------------------------------------
	 * @return String
	+----------------------------------------------------------
	 */

	static function get_client_ip() {
		if ( getenv( "HTTP_CLIENT_IP" ) && strcasecmp( getenv( "HTTP_CLIENT_IP" ), "unknown" ) ) {
			$ip = getenv( "HTTP_CLIENT_IP" );
		} else {
			if ( getenv( "HTTP_X_FORWARDED_FOR" ) && strcasecmp( getenv( "HTTP_X_FORWARDED_FOR" ), "unknown" ) ) {
				$ip = getenv( "HTTP_X_FORWARDED_FOR" );
			} else {
				if ( getenv( "REMOTE_ADDR" ) && strcasecmp( getenv( "REMOTE_ADDR" ), "unknown" ) ) {
					$ip = getenv( "REMOTE_ADDR" );
				} else {
					if ( isset( $_SERVER['REMOTE_ADDR'] ) && $_SERVER['REMOTE_ADDR'] && strcasecmp( $_SERVER['REMOTE_ADDR'], "unknown" ) ) {
						$ip = $_SERVER['REMOTE_ADDR'];
					} else {
						$ip = "unknown";
					}
				}
			}
		}
		return ( $ip );
	}

	/**
	 * 获取访客浏览器类型
	 * @return string
	 */
	static function get_client_browser(){
		if(!empty($_SERVER['HTTP_USER_AGENT'])){
			$br = $_SERVER['HTTP_USER_AGENT'];
			if (preg_match('/MSIE/i',$br)) {
				$br = 'MSIE';
			}elseif (preg_match('/Firefox/i',$br)) {
				$br = 'Firefox';
			}elseif (preg_match('/Chrome/i',$br)) {
				$br = 'Chrome';
			}elseif (preg_match('/Safari/i',$br)) {
				$br = 'Safari';
			}elseif (preg_match('/Opera/i',$br)) {
				$br = 'Opera';
			}else {
				$br = 'Other';
			}
			return $br;
		} else {
			return "unknown";
		}
	}


	/**
	 * 获得访客浏览器语言
	 * @return string
	 */
	static  function get_client_lang() {
		if(!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
			$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
			$lang = substr($lang,0,5);
			if(preg_match("/zh-cn/i",$lang)){
				$lang = "简体中文";
			}elseif(preg_match("/zh/i",$lang)){
				$lang = "繁体中文";
			}else{
				$lang = "English";
			}
			return $lang;
		}else {
			return "unknown";
		}
	}

	/**
	 * 获取访客操作系统
	 * @return string
	 */
	static function get_client_os(){
		if(!empty($_SERVER['HTTP_USER_AGENT'])){
			$OS = $_SERVER['HTTP_USER_AGENT'];
			if (preg_match('/win/i',$OS)) {
				$OS = 'Windows';
			}elseif (preg_match('/mac/i',$OS)) {
				$OS = 'MAC';
			}elseif (preg_match('/linux/i',$OS)) {
				$OS = 'Linux';
			}elseif (preg_match('/unix/i',$OS)) {
				$OS = 'Unix';
			}elseif (preg_match('/bsd/i',$OS)) {
				$OS = 'BSD';
			}else {
				$OS = 'Other';
			}
			return $OS;
		} else {
			return "unknown";
		}
	}


	/**
	 * 根据ip获得访客所在地地名
	 * @param string $ip  指定IP（如果为空，使用用户本身的IP地址）
	 *
	 * @return string
	 */
	static function get_client_address($ip=''){
		if(empty($ip)){
			$ip = self::get_client_ip();
		}
		$ipadd = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?ip=".$ip);           //根据新浪api接口获取
		if($ipadd){
			$charset = iconv("gbk","utf-8",$ipadd);
			preg_match_all("/[\x{4e00}-\x{9fa5}]+/u",$charset,$ipadds);

			return $ipadds;   //返回一个二维数组
		} else {
			return "unknown";
		}
	}
}
