<?php
/**
 * +------------------------------------------------------------------------------
 * json操作类库
 *
 * 工具函数：
 * encode json编码
 * decode json解码
 * encode_for_low_php json编码（兼容低版本）
 * decode_for_low_php json解码（兼容低版本）
 */
class JsonTool {
	/**
	 * json编码
	 *
	 * @param $data
	 *
	 * @return float|int|string
	 */
	static function encode( $data ) {
		// 设置不编码中文（php5.4以上支持）
		$json = json_encode( $data, JSON_UNESCAPED_UNICODE );
		return $json;
	}

	/**
	 * json解码
	 *
	 * @param $data
	 *
	 * @return float|int|string
	 */
	static function decode( $data ) {
		// 设置不解码中文（php5.4以上支持）
		$json = json_decode( $data, JSON_UNESCAPED_UNICODE );
		return $json;
	}

	/**
	 * json编码（兼容低版本）
	 *
	 * @param $data
	 *
	 * @return float|int|string
	 */
	static function encode_for_low_php( $data ) {
		$json = urlencode( json_encode( urlencode( $data ) ) );
		return $json;
	}

	/**
	 * json解码（兼容低版本）
	 *
	 * @param $data
	 *
	 * @return float|int|string
	 */
	static function decode_for_low_php( $data ) {
		$json = urldecode( json_encode( urldecode( $data ) ) );
		return $json;
	}
} 