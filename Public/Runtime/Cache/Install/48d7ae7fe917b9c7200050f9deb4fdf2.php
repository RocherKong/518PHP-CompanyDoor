<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta name="author" content="wangdong">
<title>初始化安装</title>
<link rel="stylesheet" type="text/css" href="/Public/static/js/easyui/themes/default/easyui.css" />
<script type="text/javascript" src="/Public/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/static/js/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/Public/static/js/easyui/locale/easyui-lang-zh_CN.js"></script>
<style type="text/css">
a{color:#08c;text-decoration:none}
a:hover,a:focus{color:#005580;text-decoration:underline}
a:focus,a:hover,a:active {outline: 0;}
textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]{background-color: #ffffff;border: 1px solid #dddddd;}
input[type="radio"],input[type="checkbox"] {margin: 4px 0 0;margin-top: 1px \9;*margin-top: 0;line-height: normal;}
input[type="file"],input[type="image"],input[type="submit"],input[type="reset"],input[type="button"],input[type="radio"],input[type="checkbox"] {width: auto;}
</style>
</head>
<body>

	<div class="easyui-dialog" title="安装完成" data-options="closable:false" style="width:550px;height:350px;padding:10px">
		<h3>您可以点击下面链接进行操作:</h3>
		<ol style="font-size:16px">
			<li><a href="<?php echo U('Home/Index/index');?>">前台首页</a></li>
			<li><a href="<?php echo U('Admin/Index/index');?>">后台管理</a></li>
		</ol>
	</div>


</body>
</html>