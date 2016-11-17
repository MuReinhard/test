<?php

/**
 * 数组处理工具类
 * Class ArrayTool
 * 工具函数：
 * list_search 在数据列表中搜索，返回数组
 * unique_arr 二维数组去重复项（当整个二维子数组出现完全重复的时候才会被去除）
 * unique_arr_top_data 去除用户的重复数据，并返回用户的指定条数据
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

} 