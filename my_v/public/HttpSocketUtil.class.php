<?php
interface Proto {
	// 连接url
	function conn($url);
	// 发送get请求
	function get();
	// 发送post请求
	function post();
	// 关闭连接
	function close();
}

class Http implements proto {
	const CRLF = '\r\n';

	protected $line = array();
	protected $header = array();
	protected $body = array();
	protected $urlInfo = array();
	protected $version = 'HTTP/1.1';

	protected $errorNum = null;
	protected $errorStr = null;
	protected $timeOut = null;
	protected $fh = null;

	protected $response = null;

	public function __construct($url) {
		$this->conn($url);
		$this->setHeader('Host:'.$this->urlInfo['host']);
	}

	/**
	 * 连接url
	 * @param  [type] $url [description]
	 * @return [type]      [description]
	 */
	function conn($url){
		// 处理url字符串，返回字符串中相应的信息数组
		// 参数1：url字符串
		$this->urlInfo = parse_url($url);

		// 判断端口，没有指定默认80
		if(!isset($this->url['prot'])){
			$this->urlInfo['prot'] = '80';
		}

		// socket连接
		// 参数1：主机名
		// 参数2：连接端口
		// 参数3：错误号
		// 参数4：错误信息
		// 参数5：连接超时时间
		$this->fh = fsockopen($this->urlInfo['host'], $this->urlInfo['prot'], $this->errorNum, $this->errorStr, $this->timeOut);
	}
	/**
	 * 构造get请求
	 * @return [type] [description]
	 */
	function get(){
		$this->setLine('GET');
		$this->request();
		return $this->response;
	}
	/**
	 * 构造post请求
	 * @return [type] [description]
	 */
	public function post($body = array()){
		$this->setLine('POST');
		$this->setHeader('Content-type:application/x-www-form-urlencoded');
		// 构造主体信息
		$this->setBody($body);

		$this->setHeader('Content-length:'.strlen($this->body[0]));
		$this->request();
	}
	// 关闭连接
	public function close(){
		fclose($this->fh);
	}
	/**
	 * 写请求行
	 */
	public function setLine($method) {
		$this->line[0] = $method.' '.$this->urlInfo['path'].' '.$this->version;
	}
	/**
	 * 写头信息
	 */
	public function setHeader($headerLine) {
		$this->header[] = $headerLine;
	}
	/**
	 * 写主体信息
	 */
	public function setBody($body) {
		$this->body[] = http_build_query($body);
	}
	/**
	 * 发送请求
	 * @return [type] [description]
	 */
	public function request() {
		// 拼接请求各项信息
		$req = array_merge($this->line, $this->header, array(''), $this->body, array());
		$req = implode(self::CRLF, $req);
		// 写请求信息
		// 参数1：socket资源句柄
		// 参数2：包含请求行，头信息，主体信息的数组
		fwrite($this->fh, $req);
		// 结束标志
		// 参数1：socket资源句柄
		while (!feof($this->fh)) {
			// 读取响应信息
			// 参数1：socket资源句柄
			// 参数2：读取长度（单位：字节）
			$this->response .= fread($this->fh, 1024);
		}
		$this->close();
	}
	/**
	 * 得到response信息
	 * @return array 响应信息
	 */
	public function getResponse() {
		return $this->response;
	}
}
$url = 'http://localhost?a=1';
$http = new Http($url);
$http->get();

$url = 'http://localhost';
$http = new Http($url);
$post = array('username'=>'1');
$http->post($post);
?>