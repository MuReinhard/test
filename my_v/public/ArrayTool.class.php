<?php

/**
 * 数组处理工具类
 * Class ArrayTool
 * 工具函数：
 * list_search 在数据列表中搜索，返回数组
 * unique_arr 二维数组去重复项（当整个二维子数组出现完全重复的时候才会被去除）
 * unique_arr_top_data 去除用户的重复数据，并返回用户的指定条数据
 * sort2DArrByKey 二维数组排序
 * arrayGroupByKey 为二维数组分组，分解成以指定key为分组的数组
 * keepArrayKeyValueToString 保留指定键的数组数据，并转化为指定标记分割的字符串
 * iArrayColumn array_column函数的低版本兼容函数
 * arrayDiffAssoc2DArr array_diff的二维数组版本
 */
class ArrayTool {
	/**
	 * +----------------------------------------------------------
	 * 在数据列表中搜索
	 * +----------------------------------------------------------
	 * @access public
	 * +----------------------------------------------------------
	 *
	 * @param array $list 数据列表
	 * @param mixed $condition 查询条件
	 * 支持 array('name'=>$value) 或者 name=$value
	 * +----------------------------------------------------------
	 *
	 * @return array
	+----------------------------------------------------------
	 */
	static function list_search( $list, $condition ) {
		if ( is_string( $condition ) ) {
			parse_str( $condition, $condition );
		}
		// 返回的结果集合
		$resultSet = array();
		foreach ( $list as $key => $data ) {
			$find = false;
			foreach ( $condition as $field => $value ) {
				if ( isset( $data[$field] ) ) {
					if ( 0 === strpos( $value, '/' ) ) {
						$find = preg_match( $value, $data[$field] );
					} elseif ( $data[$field] == $value ) {
						$find = true;
					}
				}
			}
			if ( $find ) {
				$resultSet[] =   & $list[$key];
			}
		}
		return $resultSet;
	}

	/**
	 * 二维数组去重复项（当整个二维子数组出现完全重复的时候才会被去除）
	 *
	 * @param $array2D
	 * @param bool $stkeep
	 * @param bool $ndformat
	 *
	 * @return mixed
	 */
	static function unique_arr( $array2D, $stkeep = false, $ndformat = true ) {
		// 判断是否保留一级数组键 (一级数组键可以为非数字)
		if ( $stkeep ) {
			$stArr = array_keys( $array2D );
		}

		// 判断是否保留二级数组键 (所有二级数组键必须相同)
		if ( $ndformat ) {
			$ndArr = array_keys( end( $array2D ) );
		}

		//降维,也可以用implode,将一维数组转换为用逗号连接的字符串
		foreach ( $array2D as $v ) {
			$v = join( ",", $v );
			$temp[] = $v;
		}

		//去掉重复的字符串,也就是重复的一维数组
		$temp = array_unique( $temp );

		//再将拆开的数组重新组装
		foreach ( $temp as $k => $v ) {
			if ( $stkeep ) {
				$k = $stArr[$k];
			}
			if ( $ndformat ) {
				$tempArr = explode( ",", $v );
				foreach ( $tempArr as $ndkey => $ndval ) {
					$output[$k][$ndArr[$ndkey]] = $ndval;
				}
			} else {
				$output[$k] = explode( ",", $v );
			}
		}

		return $output;
	}

	/**
	 * 去除用户的重复数据，并返回用户的指定条数据
	 * @param $_array 二维数组
	 * @param $_key 依据字段去除
	 * @param $_top 返回每个用户的几条数据
	 *
	 * @return array
	 */
	public static function unique_arr_top_data($_array, $_key, $_top) {
		$arr = array();
		foreach($_array as $k=>$v){
			if(self::topN($v[$_key],$_top)){
				$arr[$k]= $v;
			}
		}
		return $arr;
	}

	/**
	 * unique_arr_top_data的支援函数
	 * @param $uid
	 * @param $top
	 *
	 * @return bool
	 */
	private static function topN($uid,$top){
		global $_user;
		$_user[$uid]['cnt'] = $_user[$uid]['cnt'] + 1;
		if($_user[$uid]['cnt']>$top){
			return false;
		}else{
			return true;
		}
	}

	/**
	 * @author ShiO
	 * 为二维数组分组，分解成以指定key为分组的数组
	 * @param $arr
	 * @param $groupKey
	 * @param bool $ifKeepIndexTo3D
	 * @return array
     */
	public static function arrayGroupByKey($arr, $groupKey, $ifKeepIndexTo3D = false) {
		$return = array();
		foreach ($arr as $key => $value) {
			if ($ifKeepIndexTo3D) {
				$return[][$value[$groupKey]][] = $value;
			} else {
				$return[$value[$groupKey]][] = $value;
			}
		}
		return $return;
	}

	/**
	 * @author ShiO
	 * @param $arr2D
	 * @param $sortKey
	 * @param int $sortType
	 * @return array|bool
     */
	public static function sort2DArrByKey($arr2D, $sortKey, $sortType = SORT_ASC) {
		if (is_array($arr2D)) {
			foreach ($arr2D as $row_array) {
				if (is_array($row_array)) {
					$key_array[] = $row_array[$sortKey];
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
		array_multisort($key_array, $sortType, $arr2D);
		return $arr2D;
	}

	/**
	 * @author ShiO
	 * @date 2015年9月19日22:35:01
	 * 保留指定键的数组数据，并转化为指定标记分割的字符串
	 * @param array $arr2D 源数组（二维数组）
	 * @param string $key 要保存的key
	 * @param string $mark 分割标记
	 * @return string 转化后的字符串
	 */
	static function keepArrayKeyValueToString($arr2D, $key, $mark = ',') {
		$newArr = array();
		for ($i = 0, $max = count($arr2D); $i < $max; $i++) {
			$newArr[] = $arr2D[$i][$key];
		}
		return implode($mark, $newArr);
	}

	/**
	 * @author ShiO
	 * @date 2016年1月15日11:24:51
	 * array_diff的二维数组版本
	 * 对比两个数组，返回差集
	 * @param $array1
	 * @param $array2
	 * @return array
	 */
	static function arrayDiffAssoc2DArr($array1, $array2) {
		$ret = array();
		foreach ($array1 as $k => $v) {
			if (!isset($array2[$k])) $ret[$k] = $v;
			else if (is_array($v) && is_array($array2[$k])) $ret[$k] = array_diff_assoc2_deep($v, $array2[$k]);
			else if ($v != $array2[$k]) $ret[$k] = $v;
			else {
				unset($array1[$k]);
			}
		}
		return $ret;
	}

	/**
	 * @author ShiO
	 * @date 2015年10月26日 09:18:56
	 * array_column函数的低版本兼容函数
	 * @param $input 数组
	 * @param $columnKey 保留键名
	 * @param null $indexKey 索引键名
	 * @return array 处理后的数组
	 */
	static function iArrayColumn($input, $columnKey, $indexKey = null) {
		if (!function_exists('array_column')) {
			$columnKeyIsNumber = (is_numeric($columnKey)) ? true : false;
			$indexKeyIsNull = (is_null($indexKey)) ? true : false;
			$indexKeyIsNumber = (is_numeric($indexKey)) ? true : false;
			$result = array();
			foreach ((array)$input as $key => $row) {
				if ($columnKeyIsNumber) {
					$tmp = array_slice($row, $columnKey, 1);
					$tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : null;
				} else {
					$tmp = isset($row[$columnKey]) ? $row[$columnKey] : null;
				}
				if (!$indexKeyIsNull) {
					if ($indexKeyIsNumber) {
						$key = array_slice($row, $indexKey, 1);
						$key = (is_array($key) && !empty($key)) ? current($key) : null;
						$key = is_null($key) ? 0 : $key;
					} else {
						$key = isset($row[$indexKey]) ? $row[$indexKey] : 0;
					}
				}
				$result[$key] = $tmp;
			}
			return $result;
		} else {
			return array_column($input, $columnKey, $indexKey);
		}
	}
}