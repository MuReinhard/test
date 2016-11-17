<title>错误页面</title>
<p>错误信息：</p>
{foreach from=$message key=key item=v}
	<p>{$key+1}.{$v}</p>
{/foreach}
<p><a href="{$prve}">返回</a></p>