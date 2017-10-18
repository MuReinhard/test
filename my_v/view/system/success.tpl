<title>成功提示页</title>
<meta http-equiv="refresh" content="5;url={$url}"
{foreach from=$message key=key item=v}
    <p>{$key+1}.{$v}</p>
{/foreach}
<p><a href="{$url}">[如果浏览器没有成功跳转，请点击这里]</a></p>