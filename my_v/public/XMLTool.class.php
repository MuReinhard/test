<?php
	/**
	 * XML处理工具类
	 * Class XmlTool
	 * 工具函数：
	 * xml2Array 将xml文件转换为数组
	 * array2XML 将数组转换为xml文件
	 */
	class XmlTool {
		public $simple = null;

		/**
		 * 讲xml转换为数组
		 * @param string $path xml文件路径
		 * @return array 转换后的数组
		 */
		public function xml2Array($path) {
			$this->simple = $simplexml_load_file($path);
			return $this->callBackXML2Array($this->simple);
		}

		/**
		 * 回调解析xml文件，转换数组
		 * @param  mixed $sim xml对象或数组（调用：传入xml文件对象）
		 * @return mixed  xml对象或数组
		 */
		private function callBackXML2Array($sim) {
			$arr = (array) $sim;
			foreach ($arr as $k => $v) {
				if($v instanceof simplexmlelement || is_array($v)) {
					$arr[$k] = 	$this->callBackXML2Array($v);
				}
			}
			return $arr;
		}
		/**
		 * 数组转换为xml
		 * @param  array $arr         被转换的数组
		 * @param  string $rootElement 默认根元素
		 * @param  string $path        保存文件路径，默认为空，返回xml结构字符串
		 * @return mixed              返回xml结构字符串或文件保存是否成功
		 */
		public function array2XML($arr,$rootElement = '<root></root>', $path = null) {
			$this->simple = $this->callBackXML2Array($arr, $rootElement);
			return $this->simple->saveXML($path);
		}
		/**
		 * 回调解析数组，转换为xml格式（暂不支持属性）
		 * @param  array $arr         被转换数组
		 * @param  string $rootElement 根节点
		 * @param  object $node        父节点对象
		 * @return object              整个xml文件结构对象
		 */
		private function callBackArray2XML($arr, $rootElement, $node = null) {
			if($node != null) {
				$simxml = new simpleXMLElement("<?xml version='1.0' encoding='utf-8'?>".$rootElement);
			} else {
				$simxml = $node;
			}

			foreach ($arr as $k => $v) {
				if(is_array($v)) {
					$simxml->addChild($k);
					$this->callBackArray2XML($v, $rootElement, $node);
				} else if(is_numeric($k)) {
					$simxml->addChild('item', $v);
				} else {
					$simxml->addChild($k, $v);
				}
			}

			return $simxml;
		}
	}
?>