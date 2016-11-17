<?php
    /**
     * xss过滤工具类
     * Class XSSTool
     * 工具函数：
     * clean_xss 过滤字符串的html,空格,xml标签,php标签,并过滤xss攻击
     */
class XSSTool {
	/**
	 * 过滤字符串的html,空格,xml标签,php标签,并过滤xss攻击
	 * @param  变量引用  &$string 要过滤字符串变量
	 * @param  boolean $low     过滤级别（高的情况下过滤xss）
	 * @return boolean          是否过滤成功
	 */
	public function clean_xss(&$string, $low = false) {
		if (! is_array ( $string )) {
			$string = trim ( $string );
			$string = strip_tags ( $string );
			$string = htmlspecialchars ( $string );
			if ($low) {
				return true;
			}
			$string = str_replace ( array ('"', "\\", "'", "/", "..", "../", "./", "//" ), '', $string );
			$no = '/%0[0-8bcef]/';
			$string = preg_replace ( $no, '', $string );
			$no = '/%1[0-9a-f]/';
			$string = preg_replace ( $no, '', $string );
			$no = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';
			$string = preg_replace ( $no, '', $string );
			return true;
		}
		$keys = array_keys ( $string );
		foreach ( $keys as $key ) {
			clean_xss ( $string [$key] );
		}
	}
}
?>

