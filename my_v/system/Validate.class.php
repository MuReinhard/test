<?php

/**
 * 验证类
 */
class Validate {
	// 是否是数组
	public static function isArray( $_array ) {
		return is_array( $_array ) ? true : false;
	}

	// 数组是否有元素
	public static function isNullArray( $_array ) {
		return count( $_array ) == 0 ? true : false;
	}

	// 数组是否存在子元素
	public static function inArray( $_data, $_array ) {
		return in_array( $_data, $_array ) ? true : false;
	}

	// 字符串是否为空
	public static function isNullString( $_string ) {
		return empty( $_string ) ? true : false;
	}
	// 判断字符串长度是否合法
	/**
	 * @Param string $_string 要判断的字符串
	 * @Param int $_length 判断的长度
	 * @Param string $_flag 判断的方式（大于，小于，等于）
	 * @Param string $_charset 字符串的字符集
	 */
	public static function checkStrLength( $_string, $_length, $_flag, $_charset = 'utf-8' ) {
		// 判断小于x位
		if ( $_flag == 'min' ) {
			if ( mb_strlen( trim( $_string ), $_charset ) < $_length ) {
				return true;
			}
			return false;
			// 判断大于x位
		} elseif ( $_flag == 'max' ) {
			if ( mb_strlen( trim( $_string ), $_charset ) > $_length ) {
				return true;
			}
			return false;
			// 判断等于x位
		} elseif ( $_flag == 'equals' ) {
			if ( mb_strlen( trim( $_string ), $_charset ) != $_length ) {
				return true;
			}
			return false;
		}
	}

	// 判断字符串是否相等
	public static function checkStrEquals( $_string, $_otherstring ) {
		if ( trim( $_string ) == trim( $_otherstring ) ) {
			return true;
		}
		return false;
	}

}

?>