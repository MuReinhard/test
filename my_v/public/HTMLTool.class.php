<?php

/**
 * HTML处理工具类
 * Class HTMLTool
 * 工具函数：
 * cleanHTML 得到安全的HTML（过滤一切标签（除了指定不过滤的标签外），注释，文件代码等）
 * ubb 将字符串中的[xxx][/xxx]标签替换为<xxx></xxx>这种HTML的指定标签
 */
class HTMLTool {
	/**
	 * +----------------------------------------------------------
	 * 得到安全的HTML
	 * +----------------------------------------------------------
	 * @param String $text 被过滤的文本
	 * @param String $tags 允许的html标签（以|分割）
	 * +----------------------------------------------------------
	 * @return String
	+----------------------------------------------------------
	 */
	public static function cleanHTML( $text, $tags = null ) {
		$text = trim( $text );
		//完全过滤注释
		$text = preg_replace( '/<!--?.*-->/', '', $text );
		//完全过滤动态代码
		$text = preg_replace( '/<\?|\?' . '>/', '', $text );
		//完全过滤js
		$text = preg_replace( '/<script?.*\/script>/', '', $text );

		$text = str_replace( '[', '&#091;', $text );
		$text = str_replace( ']', '&#093;', $text );
		$text = str_replace( '|', '&#124;', $text );
		//过滤换行符
		$text = preg_replace( '/\r?\n/', '', $text );
		//br
		$text = preg_replace( '/<br(\s\/)?' . '>/i', '[br]', $text );
		$text = preg_replace( '/(\[br\]\s*){10,}/i', '[br]', $text );
		//过滤危险的属性，如：过滤on事件lang js
		while ( preg_match( '/(<[^><]+)( lang|on|action|background|codebase|dynsrc|lowsrc)[^><]+/i', $text, $mat ) ) {
			$text = str_replace( $mawwt[0], $mat[1], $text );
		}
		while ( preg_match( '/(<[^><]+)(window\.|javascript:|js:|about:|file:|document\.|vbs:|cookie)([^><]*)/i', $text, $mat ) ) {
			$text = str_replace( $mat[0], $mat[1] . $mat[3], $text );
		}
		if ( empty( $tags ) ) {
			$tags = 'table|td|th|tr|i|b|u|strong|img|p|br|div|strong|em|ul|ol|li|dl|dd|dt|a';
		}
		//允许的HTML标签
		$text = preg_replace( '/<(' . $tags . ')( [^><\[\]]*)>/i', '[\1\2]', $text );
		//过滤多余html
		$text = preg_replace( '/<\/?(html|head|meta|link|base|basefont|body|bgsound|title|style|script|form|iframe|frame|frameset|applet|id|ilayer|layer|name|script|style|xml)[^><]*>/i', '', $text );
		//过滤合法的html标签
		while ( preg_match( '/<([a-z]+)[^><\[\]]*>[^><]*<\/\1>/i', $text, $mat ) ) {
			$text = str_replace( $mat[0], str_replace( '>', ']', str_replace( '<', '[', $mat[0] ) ), $text );
		}
		//转换引号
		while ( preg_match( '/(\[[^\[\]]*=\s*)(\"|\')([^\2=\[\]]+)\2([^\[\]]*\])/i', $text, $mat ) ) {
			$text = str_replace( $mat[0], $mat[1] . '|' . $mat[3] . '|' . $mat[4], $text );
		}
		//过滤错误的单个引号
		while ( preg_match( '/\[[^\[\]]*(\"|\')[^\[\]]*\]/i', $text, $mat ) ) {
			$text = str_replace( $mat[0], str_replace( $mat[1], '', $mat[0] ), $text );
		}
		//转换其它所有不合法的 < >
		$text = str_replace( '<', '&lt;', $text );
		$text = str_replace( '>', '&gt;', $text );
		$text = str_replace( '"', '&quot;', $text );
		//反转换
		$text = str_replace( '[', '<', $text );
		$text = str_replace( ']', '>', $text );
		$text = str_replace( '|', '"', $text );
		//过滤多余空格
		$text = str_replace( '  ', ' ', $text );
		return $text;
	}

	/**
	 * +----------------------------------------------------------
	 * 将字符串中的[xxx][/xxx]标签替换为<xxx></xxx>这种HTML的指定标签
	 * 可以转换兼容手机格式的html？
	 * +----------------------------------------------------------
	 * @param String $text 被转换的文本
	 * +----------------------------------------------------------
	 * @return String
	+----------------------------------------------------------
	 */
	public static function ubb( $Text ) {
		$Text = trim( $Text );
		//$Text=htmlspecialchars($Text);
		$Text = preg_replace( "/\\t/is", "  ", $Text );
		$Text = preg_replace( "/\[h1\](.+?)\[\/h1\]/is", "<h1>\\1</h1>", $Text );
		$Text = preg_replace( "/\[h2\](.+?)\[\/h2\]/is", "<h2>\\1</h2>", $Text );
		$Text = preg_replace( "/\[h3\](.+?)\[\/h3\]/is", "<h3>\\1</h3>", $Text );
		$Text = preg_replace( "/\[h4\](.+?)\[\/h4\]/is", "<h4>\\1</h4>", $Text );
		$Text = preg_replace( "/\[h5\](.+?)\[\/h5\]/is", "<h5>\\1</h5>", $Text );
		$Text = preg_replace( "/\[h6\](.+?)\[\/h6\]/is", "<h6>\\1</h6>", $Text );
		$Text = preg_replace( "/\[separator\]/is", "", $Text );
		$Text = preg_replace( "/\[center\](.+?)\[\/center\]/is", "<center>\\1</center>", $Text );
		$Text = preg_replace( "/\[url=http:\/\/([^\[]*)\](.+?)\[\/url\]/is", "<a href=\"http://\\1\" target=_blank>\\2</a>", $Text );
		$Text = preg_replace( "/\[url=([^\[]*)\](.+?)\[\/url\]/is", "<a href=\"http://\\1\" target=_blank>\\2</a>", $Text );
		$Text = preg_replace( "/\[url\]http:\/\/([^\[]*)\[\/url\]/is", "<a href=\"http://\\1\" target=_blank>\\1</a>", $Text );
		$Text = preg_replace( "/\[url\]([^\[]*)\[\/url\]/is", "<a href=\"\\1\" target=_blank>\\1</a>", $Text );
		$Text = preg_replace( "/\[img\](.+?)\[\/img\]/is", "<img src=\\1>", $Text );
		$Text = preg_replace( "/\[color=(.+?)\](.+?)\[\/color\]/is", "<font color=\\1>\\2</font>", $Text );
		$Text = preg_replace( "/\[size=(.+?)\](.+?)\[\/size\]/is", "<font size=\\1>\\2</font>", $Text );
		$Text = preg_replace( "/\[sup\](.+?)\[\/sup\]/is", "<sup>\\1</sup>", $Text );
		$Text = preg_replace( "/\[sub\](.+?)\[\/sub\]/is", "<sub>\\1</sub>", $Text );
		$Text = preg_replace( "/\[pre\](.+?)\[\/pre\]/is", "<pre>\\1</pre>", $Text );
		$Text = preg_replace( "/\[email\](.+?)\[\/email\]/is", "<a href='mailto:\\1'>\\1</a>", $Text );
		$Text = preg_replace( "/\[colorTxt\](.+?)\[\/colorTxt\]/eis", "color_txt('\\1')", $Text );
		$Text = preg_replace( "/\[emot\](.+?)\[\/emot\]/eis", "emot('\\1')", $Text );
		$Text = preg_replace( "/\[i\](.+?)\[\/i\]/is", "<i>\\1</i>", $Text );
		$Text = preg_replace( "/\[u\](.+?)\[\/u\]/is", "<u>\\1</u>", $Text );
		$Text = preg_replace( "/\[b\](.+?)\[\/b\]/is", "<b>\\1</b>", $Text );
		$Text = preg_replace( "/\[quote\](.+?)\[\/quote\]/is", " <div class='quote'><h5>引用:</h5><blockquote>\\1</blockquote></div>", $Text );
		$Text = preg_replace( "/\[code\](.+?)\[\/code\]/eis", "highlight_code('\\1')", $Text );
		$Text = preg_replace( "/\[php\](.+?)\[\/php\]/eis", "highlight_code('\\1')", $Text );
		$Text = preg_replace( "/\[sig\](.+?)\[\/sig\]/is", "<div class='sign'>\\1</div>", $Text );
		$Text = preg_replace( "/\\n/is", "<br/>", $Text );
		return $Text;
	}

}