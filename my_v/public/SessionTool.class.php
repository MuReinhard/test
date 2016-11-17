<?php
/**
 * SESSION工具类
 * Class SessionTool
 * 工具函数：
 * getSessionFileMTimeBySID SessionTool
 */
class SessionTool {
	/**
	 * 利用SessionId得到最后一次修改session文件的时间（返回假证明没有此文件）
	 * @param $_sid
	 * @return $_lastConTime
	 */
	public static function getSessionFileMTimeBySID($_sid) {
		$_path = session_save_path();
		$_path = $_path.DIRECTORY_SEPARATOR.'sess_'.$_sid;
		if( ! file_exists( $_path ) ) {
			throw new Exception("此SID已经过期");
		} else {
			return $_lastConTime = filemtime($_path);
		}
	}

}