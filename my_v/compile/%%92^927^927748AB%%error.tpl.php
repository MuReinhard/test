<?php /* Smarty version 2.6.26, created on 2015-02-18 18:09:07
         compiled from system/error.tpl */ ?>
<title>错误页面</title>
<p>错误信息：</p>
<?php $_from = $this->_tpl_vars['message']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
    <p><?php echo $this->_tpl_vars['key']+1; ?>
.<?php echo $this->_tpl_vars['value']; ?>
</p>
<?php endforeach; endif; unset($_from); ?>
<p><a href="<?php echo $this->_tpl_vars['prve']; ?>
">返回</a></p>