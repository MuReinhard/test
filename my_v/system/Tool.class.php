<?php

/**
 * 工具类，封装函数与算法
 */
class Tool {
	// 获取客户端IP
	public static function getIP() {
		return $_SERVER['REMOTE_ADDR'];
	}

	// 获取当前时间
	public static function getDate( $format = 'Y-m-d H:i:s' ) {
		return date( $format );
	}

	// 表单提交字符转义
	public static function setFormString( $_data ) {
		// 如果没有开启自动转义
		if ( ! get_magic_quotes_gpc() ) {
			// 使用递归方式，如果是数组，拆分后将字符串，然后转义返回
			if ( Validate::isArray( $_data ) ) {
				foreach ( $_data as $_key => $_value ) {
					$_data[$_key] = self::setFormString( $_value );
				}
			} else {
				return addslashes( $_data );
				// 如果不支持mysql_real_escape_string（因为有可能需要PDO句柄），使用addslashes
//                    return addslashes( $_data );
			}
			return $_data;
		}
	}

	// html过滤
	static public function setHtmlString( $_data ) {
		$_string = '';
		if ( Validate::isArray( $_data ) ) {
			if ( Validate::isNullArray( $_data ) ) {
				return $_data;
			}
			foreach ( $_data as $_key => $_value ) {
				$_string[$_key] = self::setHtmlString( $_value ); // 递归
			}
		} elseif ( is_object( $_data ) ) {
			foreach ( $_data as $_key => $_value ) {
				$_string->$_key = self::setHtmlString( $_value ); // 递归
			}
		} else {
			$_string = htmlspecialchars( $_data );
		}
		return $_string;
	}

	// 得到上一页
	public static function getPrevPage() {
		return $_SERVER['HTTP_REFERER'];
	}
}

?>