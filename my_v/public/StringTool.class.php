<?php

/**
 * 字符串处理工具类
 * Class StringTool
 * 工具函数：
 * msubstr 字符串截取，支持中文和其他编码
 * rand_string 产生随机字串，可用来自动生成密码 默认长度6位 字母和数字混合
 * byte_format 字节格式化 把字节数格式为 B K M G T 描述的大小
 * is_utf8 检查字符串是否是UTF8编码
 * highlight_code 字符串代码或整个文件代码加亮
 * build_count_rand 随机生成一组值，返回数组
 * all_external_link 检测字符串是否包含外链
 * get_first_img 取得内容中的第一张图片
 * dump 浏览器友好输出格式
 */
class StringTool {
	/**
	 * +----------------------------------------------------------
	 * 字符串截取，支持中文和其他编码
	 * +----------------------------------------------------------
	 * @static
	 * @access public
	 * +----------------------------------------------------------
	 * @param string $str 需要转换的字符串
	 * @param string $start 开始位置（1开始）
	 * @param string $length 留下长度
	 * @param string $charset 编码格式
	 * @param string $suffix 截断显示字符
	 * +----------------------------------------------------------
	 * @return string
	+----------------------------------------------------------
	 */
	public static function msubstr( $str, $start, $length, $charset = "utf-8", $suffix = false ) {
		$start = $start - 1;
		if ( function_exists( "mb_substr" ) ) {
			$slice = mb_substr( $str, $start, $length, $charset );
		} elseif ( function_exists( 'iconv_substr' ) ) {
			$slice = iconv_substr( $str, $start, $length, $charset );
		} else {
			$re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
			$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
			$re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
			$re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
			preg_match_all( $re[$charset], $str, $match );
			$slice = join( "", array_slice( $match[0], $start, $length ) );
		}
		return $suffix ? $slice . '...' : $slice;
	}

	/**
	 * +----------------------------------------------------------
	 * 产生随机字串，可用来自动生成密码 默认长度6位 字母和数字混合
	 * +----------------------------------------------------------
	 * @param string $len 长度
	 * @param string $type 字串类型
	 * 0 大写字母 1 数字 3 小写字母 4 中文 其它 混合（数字+小写+大写）
	 * @param string $addChars 额外字符
	 * +----------------------------------------------------------
	 * @return string
	+----------------------------------------------------------
	 */
	static function rand_string( $len = 6, $type = '', $addChars = '' ) {
		$str = '';
		switch ( $type ) {
			case 0:
				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . $addChars;
				break;
			case 1:
				$chars = str_repeat( '0123456789', 3 );
				break;
			case 2:
				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . $addChars;
				break;
			case 3:
				$chars = 'abcdefghijklmnopqrstuvwxyz' . $addChars;
				break;
			case 4:
				$chars = "们以我到他会作时要动国产的一是工就年阶义发成部民可出能方进在了不和有大这主中人上为来分生对于学下级地个用同行面说种过命度革而多子后自社加小机也经力线本电高量长党得实家定深法表着水理化争现所二起政三好十战无农使性前等反体合斗路图把结第里正新开论之物从当两些还天资事队批点育重其思与间内去因件日利相由压员气业代全组数果期导平各基或月毛然如应形想制心样干都向变关问比展那它最及外没看治提五解系林者米群头意只明四道马认次文通但条较克又公孔领军流入接席位情运器并飞原油放立题质指建区验活众很教决特此常石强极土少已根共直团统式转别造切九你取西持总料连任志观调七么山程百报更见必真保热委手改管处己将修支识病象几先老光专什六型具示复安带每东增则完风回南广劳轮科北打积车计给节做务被整联步类集号列温装即毫知轴研单色坚据速防史拉世设达尔场织历花受求传口断况采精金界品判参层止边清至万确究书术状厂须离再目海交权且儿青才证低越际八试规斯近注办布门铁需走议县兵固除般引齿千胜细影济白格效置推空配刀叶率述今选养德话查差半敌始片施响收华觉备名红续均药标记难存测士身紧液派准斤角降维板许破述技消底床田势端感往神便贺村构照容非搞亚磨族火段算适讲按值美态黄易彪服早班麦削信排台声该击素张密害侯草何树肥继右属市严径螺检左页抗苏显苦英快称坏移约巴材省黑武培著河帝仅针怎植京助升王眼她抓含苗副杂普谈围食射源例致酸旧却充足短划剂宣环落首尺波承粉践府鱼随考刻靠够满夫失包住促枝局菌杆周护岩师举曲春元超负砂封换太模贫减阳扬江析亩木言球朝医校古呢稻宋听唯输滑站另卫字鼓刚写刘微略范供阿块某功套友限项余倒卷创律雨让骨远帮初皮播优占死毒圈伟季训控激找叫云互跟裂粮粒母练塞钢顶策双留误础吸阻故寸盾晚丝女散焊功株亲院冷彻弹错散商视艺灭版烈零室轻血倍缺厘泵察绝富城冲喷壤简否柱李望盘磁雄似困巩益洲脱投送奴侧润盖挥距触星松送获兴独官混纪依未突架宽冬章湿偏纹吃执阀矿寨责熟稳夺硬价努翻奇甲预职评读背协损棉侵灰虽矛厚罗泥辟告卵箱掌氧恩爱停曾溶营终纲孟钱待尽俄缩沙退陈讨奋械载胞幼哪剥迫旋征槽倒握担仍呀鲜吧卡粗介钻逐弱脚怕盐末阴丰雾冠丙街莱贝辐肠付吉渗瑞惊顿挤秒悬姆烂森糖圣凹陶词迟蚕亿矩康遵牧遭幅园腔订香肉弟屋敏恢忘编印蜂急拿扩伤飞露核缘游振操央伍域甚迅辉异序免纸夜乡久隶缸夹念兰映沟乙吗儒杀汽磷艰晶插埃燃欢铁补咱芽永瓦倾阵碳演威附牙芽永瓦斜灌欧献顺猪洋腐请透司危括脉宜笑若尾束壮暴企菜穗楚汉愈绿拖牛份染既秋遍锻玉夏疗尖殖井费州访吹荣铜沿替滚客召旱悟刺脑措贯藏敢令隙炉壳硫煤迎铸粘探临薄旬善福纵择礼愿伏残雷延烟句纯渐耕跑泽慢栽鲁赤繁境潮横掉锥希池败船假亮谓托伙哲怀割摆贡呈劲财仪沉炼麻罪祖息车穿货销齐鼠抽画饲龙库守筑房歌寒喜哥洗蚀废纳腹乎录镜妇恶脂庄擦险赞钟摇典柄辩竹谷卖乱虚桥奥伯赶垂途额壁网截野遗静谋弄挂课镇妄盛耐援扎虑键归符庆聚绕摩忙舞遇索顾胶羊湖钉仁音迹碎伸灯避泛亡答勇频皇柳哈揭甘诺概宪浓岛袭谁洪谢炮浇斑讯懂灵蛋闭孩释乳巨徒私银伊景坦累匀霉杜乐勒隔弯绩招绍胡呼痛峰零柴簧午跳居尚丁秦稍追梁折耗碱殊岗挖氏刃剧堆赫荷胸衡勤膜篇登驻案刊秧缓凸役剪川雪链渔啦脸户洛孢勃盟买杨宗焦赛旗滤硅炭股坐蒸凝竟陷枪黎救冒暗洞犯筒您宋弧爆谬涂味津臂障褐陆啊健尊豆拔莫抵桑坡缝警挑污冰柬嘴啥饭塑寄赵喊垫丹渡耳刨虎笔稀昆浪萨茶滴浅拥穴覆伦娘吨浸袖珠雌妈紫戏塔锤震岁貌洁剖牢锋疑霸闪埔猛诉刷狠忽灾闹乔唐漏闻沈熔氯荒茎男凡抢像浆旁玻亦忠唱蒙予纷捕锁尤乘乌智淡允叛畜俘摸锈扫毕璃宝芯爷鉴秘净蒋钙肩腾枯抛轨堂拌爸循诱祝励肯酒绳穷塘燥泡袋朗喂铝软渠颗惯贸粪综墙趋彼届墨碍启逆卸航衣孙龄岭骗休借" . $addChars;
				break;
			default :
				// 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
				$chars = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789' . $addChars;
				break;
		}
		if ( $len > 10 ) { //位数过长重复字符串一定次数
			$chars = $type == 1 ? str_repeat( $chars, $len ) : str_repeat( $chars, 5 );
		}
		if ( $type != 4 ) {
			$chars = str_shuffle( $chars );
			$str = substr( $chars, 0, $len );
		} else {
			// 中文随机字
			for ( $i = 0; $i < $len; $i ++ ) {
				$str .= self::msubstr( $chars, floor( mt_rand( 0, mb_strlen( $chars, 'utf-8' ) - 1 ) ), 1 );
			}
		}
		return $str;
	}

	/**
	 * +----------------------------------------------------------
	 * 字节格式化 把字节数格式为 B K M G T 描述的大小
	 * @param Long $size 要格式化的字节
	 * @param int $dec 四舍五入后小数点后的位数
	 *
	 * +----------------------------------------------------------
	 * @return string
	+----------------------------------------------------------
	 */
	static function byte_format( $size, $dec = 2 ) {
		$a = array("B", "KB", "MB", "GB", "TB", "PB");
		$pos = 0;
		while ( $size >= 1024 ) {
			$size /= 1024;
			$pos ++;
		}
		if ( ! array_key_exists( $pos, $a ) ) {
			return round( $size, $dec ) . " 不存在单位";
		} else {
			return round( $size, $dec ) . " " . $a[$pos];
		}
	}

	/**
	 * +----------------------------------------------------------
	 * 检查字符串是否是UTF8编码
	 * +----------------------------------------------------------
	 * @param string $string 字符串
	 * +----------------------------------------------------------
	 * @return Boolean
	+----------------------------------------------------------
	 */
	static function is_utf8( $string ) {
		return preg_match( '%^(?:
		 [\x09\x0A\x0D\x20-\x7E]            # ASCII
	   | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
	   |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
	   | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
	   |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
	   |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
	   | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
	   |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
   )*$%xs', $string );
	}

	/**
	 * +----------------------------------------------------------
	 * 代码加亮
	 * +----------------------------------------------------------
	 * @param String $str 要高亮显示的字符串 或者 文件名
	 * @param Boolean $show 是否输出
	 * +----------------------------------------------------------
	 * @return String
	+----------------------------------------------------------
	 */
	static function highlight_code( $str, $show = false ) {
		if ( file_exists( $str ) ) {
			$str = file_get_contents( $str );
		}
		$str = stripslashes( trim( $str ) );
		// The highlight string function encodes and highlights
		// brackets so we need them to start raw
		$str = str_replace( array('&lt;', '&gt;'), array('<', '>'), $str );

		// Replace any existing PHP tags to temporary markers so they don't accidentally
		// break the string out of PHP, and thus, thwart the highlighting.

		$str = str_replace( array('&lt;?php', '?&gt;', '\\'), array('phptagopen', 'phptagclose', 'backslashtmp'), $str );

		// The highlight_string function requires that the text be surrounded
		// by PHP tags.  Since we don't know if A) the submitted text has PHP tags,
		// or B) whether the PHP tags enclose the entire string, we will add our
		// own PHP tags around the string along with some markers to make replacement easier later

		$str = '<?php //tempstart' . "\n" . $str . '//tempend ?>'; // <?

		// All the magic happens here, baby!
		$str = highlight_string( $str, TRUE );

		// Prior to PHP 5, the highlight function used icky font tags
		// so we'll replace them with span tags.
		if ( abs( phpversion() ) < 5 ) {
			$str = str_replace( array('<font ', '</font>'), array('<span ', '</span>'), $str );
			$str = preg_replace( '#color="(.*?)"#', 'style="color: \\1"', $str );
		}

		// Remove our artificially added PHP
		$str = preg_replace( "#\<code\>.+?//tempstart\<br />\</span\>#is", "<code>\n", $str );
		$str = preg_replace( "#\<code\>.+?//tempstart\<br />#is", "<code>\n", $str );
		$str = preg_replace( "#//tempend.+#is", "</span>\n</code>", $str );

		// Replace our markers back to PHP tags.
		$str = str_replace( array('phptagopen', 'phptagclose', 'backslashtmp'), array('&lt;?php', '?&gt;', '\\'), $str ); //<?
		$line = explode( "<br />", rtrim( ltrim( $str, '<code>' ), '</code>' ) );
		$result = '<div class="code"><ol>';
		foreach ( $line as $key => $val ) {
			$result .= '<li>' . $val . '</li>';
		}
		$result .= '</ol></div>';
		$result = str_replace( "\n", "", $result );
		if ( $show !== false ) {
			echo( $result );
		} else {
			return $result;
		}
	}

	/**
	 * +----------------------------------------------------------
	 * 随机生成一组值，返回数组
	 * +----------------------------------------------------------
	 * @param int $number 生成数量
	 * @param int $length 每个随即字符串的长度
	 * @param int $mode 生成类型
	 * 0 大写字母 1 数字 3 小写字母 4 中文 其它 混合（数字+小写+大写）
	 * +----------------------------------------------------------
	 * @return Array
	+----------------------------------------------------------
	 */

	static function build_count_rand( $number, $length = 4, $mode = 1 ) {
		if ( $mode == 1 && $length < strlen( $number ) ) {
			//不足以生成一定数量的不重复数字
			return false;
		}
		$rand = array();
		for ( $i = 0; $i < $number; $i ++ ) {
			$rand[] = StringTool::rand_string( $length, $mode );
		}
		$unqiue = array_unique( $rand );
		if ( count( $unqiue ) == count( $rand ) ) {
			return $rand;
		}
		$count = count( $rand ) - count( $unqiue );
		for ( $i = 0; $i < $count * 3; $i ++ ) {
			$rand[] = StringTool::rand_string( $length, $mode );
		}
		$rand = array_slice( array_unique( $rand ), 0, $number );
		return $rand;
	}

	 /**
	 * is_external_link 检测字符串是否包含外链
	 * @param  string  $text 文字
	 * @param  string  $host 域名
	 * @return boolean    false 有外链 true 无外链
	 */
	static function all_external_link($text = '', $host = '') {
		if (empty($host)) $host = $_SERVER['HTTP_HOST'];
		$reg = '/http(?:s?):\/\/((?:[A-za-z0-9-]+\.)+[A-za-z]{2,4})/';
		preg_match_all($reg, $text, $data);
		$math = $data[1];
		foreach ($math as $value) {
			if($value != $host) return false;
		}
		return true;
	}

	/**
	 * 取得内容中的第一张图片
	 * @param $string
	 */
	static function get_first_img( $string ) {
		preg_match_all('/<img.*?>/im',  $string, $match );                       // 将新闻中所有图片存入数组
		$img=$match[0][0] ;                                                                           // 第一张图片
	}

    /**
     * 浏览器友好输出格式
     * @param mixed $var    输出数据
     * @param string $echo  是否直接输出
     * @param string $label 标签
     * @param string $strict 严格
     * @return NULL|string 直接输出或返回格式化的数据
     */
    static function dump($var, $echo=true, $label=null, $strict=true) {
        $label = ($label === null) ? '' : rtrim($label) . ' ';
        if (!$strict) {
            if (ini_get('html_errors')) {
                $output = print_r($var, true);
                $output = "<pre>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
            } else {
                $output = $label . print_r($var, true);
            }
        } else {
            ob_start();
            var_dump($var);
            $output = ob_get_clean();
            if (!extension_loaded('xdebug')) {
                $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            }
        }
        if ($echo) {
            echo($output);
            return null;
        }else
            return $output;
    }


}
