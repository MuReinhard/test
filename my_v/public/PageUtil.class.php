<?php

/*
 *调用示例
 *
 * Action层
 *$page = new Page(3,'/indexAction');              // 每页显示数量,连接回跳地址
 *$page->setPageNum();                                     // 指定请求的页码（post提交也可以，手动也可以）
 *
 *$data = findXxxUsePage($page);                   // 查找数据库，传入page对象，返回数据
 *$page->setGetParam("条件名", 条件值);            // 传入条件，条件会被带入到超链接中，形成：条件=条件值&条件=条件值
 *$page->show("A");                                // 开启展示方法，传入需要展示的分类类型
 * // 得到分页的数据  array['frist'] => 首页超链接，[previous]=>上一页，['next']=>下一页,['last']=>尾页,['str']=>(页数/总页数)
 * // 如果有小页码的情况下，返回值中会多出一个 array['numPage']=>array[0]=>页码超链接1,array[1]=>页码超链接2...
 *
 * Model层
 * 在findXxxUsePage($page)的数据库方法中，需要类似如下代码
 * public findXxxUsePage($page){
 *      $count = $数据库对象->fieldAs($firld)->where($where)->tableAs($table)->count();                                              //得到你查询条件下的计数
 *      $page->setCount($count);                                                                                                     //把你查询结果的总条数传进来，以供分页计算使用
 *      $data = $数据库对象->fieldAs($firld)->where($where)->tableAs($table)->limit($page->limitStart, $page->limitEnd)->select();  //得到数据,传入计算好的limit值即可
 * }
 */

/**
 * @author GHC
 * @date 2014年8月9日
 * @version v0.1.0
 *
 * @param $_pageNum 当前页数
 * @param $_count 记录总数
 * @param $_showSize 每页显示条数
 * @param $_URL 分页数据返回的处理URL
 * @param $_totalPage 页总数
 * @param $_pageNumKey 保存页数的超链接的key
 * @param $_paramOfGet 储存携带参数
 * @param $_pageArr 前台信息的数组
 * @param $_limitStart limit所需的开始数
 * @param $_limitEnd limit所需的结束数
 * 分页类
 */
class PageUtil {
	private $_pageNum;
	private $_count;
	private $_showSize;
	private $_URL;
	private $_totalPage;

	private $_pageNumKey;
	private $_paramOfGet = array();

	private $_pageArr = array();

	public $_limitStart;
	public $_limitEnd;

	/**
	 * 构造
	 *
	 * @param $_showSize
	 * @param $_URL
	 */
	public function __construct( $_showSize, $_URL ) {
		$this->_showSize = $_showSize;
		$this->_URL = $_URL;
	}

	/**
	 * 储存总条数
	 *
	 * @param $_count
	 */
	public function setCount( $_count ) {
		$this->_count = $_count;
		$this->pageMath();
	}

	/**
	 * 传入当前页数，或者说要跳转的页数
	 *
	 * @param $_pageNum 指定页数
	 * @param $_pageNumKey 指定保存页数的超链接的key
	 *
	 * @return $this 本类对象
	 */
	public function setPageNum( $_pageNum = null, $_pageNumKey = 'pageNum' ) {
		// 如果参数等于空，证明没指定页数
		if ( $_pageNum == null ) {
			// 如果GET内的参数为空，证明第一次进入
			if ( $_GET[$_pageNumKey] == null ) {
				$_pageNum = 1;
			} else {
				$_pageNum = $_GET[$_pageNumKey];
			}
		}
		$this->_pageNum = $_pageNum;
		$this->_pageNumKey = $_pageNumKey;

		return $this;
	}

	/**
	 * 分页核心计算方法
	 * @return $this 本类对象
	 */
	private function pageMath() {
		$this->_totalPage = ceil( $this->_count / $this->_showSize );
		$this->_limitStart = ( $this->_pageNum - 1 ) * $this->_showSize;
		$this->_limitEnd = $this->_showSize;
	}

	/**
	 * 设置GET携带参数
	 *
	 * @param $key
	 * @param $value
	 */
	public function setGetParam( $key, $value ) {
		$this->_paramOfGet[$key] = $value;
	}

	/**
	 * 展示分页前台
	 *
	 * @param $_style 使用哪一种模版
	 * @param $_linkMark url连接符号（当使用的环境url另作他用，如 本框架中url的形式为?a=xx&m=xx 则需要用&作为连接符号而非?）
	 *
	 * @return array $_pageArr 返回结果数组
	 */
	public function show( $_style, $_linkMark = '?' ) {
		switch ( $_style ) {
			case "A":
				$this->pageStyleA( $_linkMark ); //调取样式A
				break;

			case "B":
				$this->pageStyleB( $_linkMark ); //调取样式A
				break;

			case "C":
				$this->pageStyleC( $_linkMark ); //调取样式C
				break;
		}
		return $this->_pageArr;
	}

	/**
	 * 分页表现方式A
	 * 首页 上一页 下一页 尾页
	 */
	private function pageStyleA( $_linkMark ) {
		$_paramUrl = ""; //参数字符串容器

		if ( ! $this->_paramOfGet != null ) { //如果参数列表不为空
			$_paramUrl = $this->buildGet(); //构造参数字符串
		}

		$this->_pageArr["frist"] = "<a href = '" . $this->_URL . $_linkMark . $_paramUrl . "$this->_pageNumKey=1'>首页</a>";

		if ( $this->_pageNum != 1 ) {
			$this->_pageArr["previous"] = "<a href = '" . $this->_URL . $_linkMark . $_paramUrl . "$this->_pageNumKey=" . ( $this->_pageNum - 1 ) . "'>上一页</a>";
		}
		if ( $this->_pageNum < $this->_totalPage ) { //如果page小于总页数,显示下一页链接
			$this->_pageArr["next"] = "<a href='" . $this->_URL . $_linkMark . $_paramUrl . "$this->_pageNumKey=" . ( $this->_pageNum + 1 ) . "'>下一页</a>";
		}
		$this->_pageArr["last"] = "<a href = '" . $this->_URL . $_linkMark . $_paramUrl . "$this->_pageNumKey=" . $this->_totalPage . "'>尾页</a>";
		$this->_pageArr["str"] = "当前第" . $this->_pageNum . "页/" . $this->_totalPage . "页";
	}

	/**
	 * 分页表现方式B
	 * 首页 上一页 1 2 3 4 5 6 7 8 9 10 下一页 尾页
	 * 小页码随选择而位移，保证 5-当前页+5，当当前页到达右侧范围之内时，左侧会被补齐数量
	 */
	private function pageStyleB( $_linkMark ) {
		$_numPageStart = 0; //小页码开始页数
		$_numPageEnd = 0; //小页码结束页数
		$_numPageShow = 10; //显示10个小页码

		//注意 ！这两个数加起来一定要等于numPageShow
		$_numPageLeft = $_numPageShow / 2; //numPageShow/2	指定左侧显示的页面个数，默认一半
		$_numPageRight = $_numPageShow / 2; //numPageShow/2 指定右侧显示的页面个数。默认一半

		/*
		* 如果当前页小于小页码的一半，证明左边的范围不足以位移整个页码，这时的范围为1-小页码数量，如果情况相反，证明整个页码要开始位移
		* 小页码开始 = 当前页数 - 页码总数的一半，确定左边开始的数字
		* 小页码结束 = 当前页数 + 页码总数的一半，确定右边开始的数字
		*/
		if ( $this->_pageNum <= $_numPageLeft ) {
			$_numPageStart = 1;
			$_numPageEnd = $_numPageShow;
		} else {
			$_numPageStart = $this->_pageNum - $_numPageLeft;
			$_numPageEnd = $this->_pageNum + $_numPageRight;
		}
		/*
		* 如果当前页数大于总页数-5的话，证明当前的页数是在左边范围，那么展示方式就会发生改变，以最大页数-显示数
		* 并且不能在6页之内，否则这样就会在左范围之内
		*
		*/
		if ( $this->_pageNum > ( $this->totalPage - $_numPageRight ) ) {
			$_numPageStart = $this->_totalPage - $_numPageShow;
			if ( $_numPageStart == 0 ) {
				$_numPageStart = 1;
			}
		}

		/*
		* 如果计算出来的尾页数，大于或等于尾页数，那么证明就是在最大页数范围内
		*/
		if ( $_numPageEnd >= $this->_totalPage ) {
			$_numPageEnd = $this->_totalPage;
		}

		$_numPageArr = array();

		$_paramUrl = ""; //参数字符串容器

		if ( $this->_paramOfGet != null ) { //如果参数列表不为空
			$_paramUrl = $this->buildGet(); //构造参数字符串
			/*
				if($paramUrl == null){
					$paramUrl = "";
				}
			*/
		}

		$this->_pageArr["frist"] = "<a href = '" . $this->_URL . $_linkMark . $_paramUrl . "$this->_pageNumKey=1'>首页</a>";

		if ( $this->_pageNum != 1 ) {
			$this->_pageArr["previous"] = "<a href = '" . $this->_URL . $_linkMark . $_paramUrl . "$this->_pageNumKey=" . ( $this->_pageNum - 1 ) . "'>上一页</a>";
		}

//---小页码---
		$_selected = 0; //是否被选中
		for ( $i = $_numPageStart; $i <= $_numPageEnd; $i ++ ) {
			if ( $i == $this->_pageNum ) {
				$_selected = 1;
			}
			$_numPageArr[] = "<a href = '" . $this->_URL . $_linkMark . $_paramUrl . "$this->_pageNumKey=" . $i . "' selected='" . $_selected . "'>" . $i . "</a>";
		}

		$this->_pageArr["numPage"] = $_numPageArr;
//---小页码---

		if ( $this->_pageNum < $this->_totalPage ) {
			$this->_pageArr["next"] = "<a href='" . $this->_URL . $_linkMark . $_paramUrl . "$this->_pageNumKey=" . ( $this->_pageNum + 1 ) . "'>下一页</a>";
		}
		$this->_pageArr["last"] = "<a href = '" . $this->_URL . $_linkMark . $_paramUrl . "$this->_pageNumKey=" . $this->_totalPage . "'>尾页</a>";
		$this->_pageArr["str"] = "当前第" . $this->_pageNum . "页/" . $this->_totalPage . "页";
	}

	/**
	 * 分页表现方式C
	 * 首页 上一页 1 2 3 4 5 6 7 8 9 10 下一页 尾页
	 * 小页码随选择而位移，保证 5-当前页+5，当当前页到达右侧范围之内时，左侧不会被补齐数量
	 */
	private function pageStyleC( $_linkMark ) {
		$_numPageStart = 0; //小页码开始页数
		$_numPageEnd = 0; //小页码结束页数
		$_numPageShow = 10; //显示10个小页码

		//注意 ！这两个数加起来一定要等于numPageShow
		$_numPageLeft = $_numPageShow / 2; //numPageShow/2	指定左侧显示的页面个数，默认一半
		$_numPageRight = $_numPageShow / 2; //numPageShow/2 指定右侧显示的页面个数。默认一半
		/*
		* 如果当前页小于小页码的一半，证明左边的范围不足以位移整个页码，这时的范围为1-小页码数量，如果情况相反，证明整个页码要开始位移
		* 小页码开始 = 当前页数 - 页码总数的一半，确定左边开始的数字
		* 小页码结束 = 当前页数 + 页码总数的一半，确定右边开始的数字
		*/
		if ( $this->_pageNum <= $_numPageLeft ) {
			$_numPageStart = 1;
			$_numPageEnd = $_numPageShow;
		} else {
			$_numPageStart = $this->_pageNum - $_numPageLeft;
			$_numPageEnd = $this->_pageNum + $_numPageRight;
		}

		/*
		* 如果计算出来的尾页数，大于或等于尾页数，那么证明就是在最大页数范围内
		*/
		if ( $_numPageEnd >= $this->_totalPage ) {
			$_numPageEnd = $this->_totalPage;
		}

		$_numPageArr = array();

		$_paramUrl = ""; //参数字符串容器

		if ( $this->_paramOfGet != null ) { //如果参数列表不为空
			$_paramUrl = $this->buildGet(); //构造参数字符串
			/*
				if(paramUrl == null){
					paramUrl = "";
				}
			*/
		}

		$this->_pageArr["frist"] = "<a href = '" . $this->_URL . $_linkMark . $_paramUrl . "$this->_pageNumKey=1'>首页</a>";

		if ( $this->_pageNum != 1 ) {
			$this->_pageArr["previous"] = "<a href = '" . $this->_URL . $_linkMark . $_paramUrl . "$this->_pageNumKey=" . ( $this->_pageNum - 1 ) . "'>上一页</a>";
		}

		//---小页码---
		for ( $i = $_numPageStart; $i <= $_numPageEnd; $i ++ ) {
			$_numPageArr[] = "<a href = '" . $this->_URL . $_linkMark . $_paramUrl . "$this->_pageNumKey=" . $i . "'>" . $i . "</a>";
		}

		$this->_pageArr["numPage"] = $_numPageArr; //小页码list循环
		//---小页码---

		if ( $this->_pageNum < $this->_totalPage ) {
			$this->_pageArr["next"] = "<a href='" . $this->_URL . $_linkMark . $_paramUrl . "$this->_pageNumKey=" . ( $this->_pageNum + 1 ) . "'>下一页</a>";
		}
		$this->_pageArr["last"] = "<a href = '" . $this->_URL . $_linkMark . $_paramUrl . "$this->_pageNumKey=" . $this->_totalPage . "'>尾页</a>";
		$this->_pageArr["str"] = "当前第" . $this->_pageNum . "页/" . $this->_totalPage . "页";
	}

	/**
	 * 拆分map集合，组成URL参数字符串
	 * @return String paramUrl 组合好的参数字符串
	 */
	private function buildGet() {
		$_paramUrl = "";

		foreach ( $this->_paramOfGet as $_key => $_value ) {
			$_paramUrl = $_paramUrl . $_key . "=" . $_value . "&";
		}
		return $_paramUrl;
	}
}

?>