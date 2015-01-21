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

	<div id="checkdialog" class="easyui-dialog" title="检测安装环境" data-options="closable:false,buttons:[{text:'检测中...'}]" style="width:550px;height:350px;">
		<p id="checkmessage" style="line-height:1.5;margin:0;padding:5px">正在检测，请稍后 ...<br /></p>
	</div>
	<form id="install" action="<?php echo U('Index/index');?>" method="post">
		<input type="hidden" name="step" value="2">
	</form>


	<script type="text/javascript">
	var items = {
		'uname':'操作系统',
		'server':'WEB 服务器',
		'phpversion':'PHP 版本',
		'mysql':'MYSQL 扩展',
		'gd':'GD 扩展',
		'json':'JSON 扩展',
		'curl':'CURL 扩展'
		<?php if(IS_WRITE): ?>,
		'config':'配置文件写入权限',
		'upload':'上传目录写入权限',
		'tmp':'临时目录写入权限'<?php endif; ?>
	}
	$(function(){
		var pass = true;
		for(var item in items){
			$.ajax({
				type: 'POST',
				url:'<?php echo U('Index/check');?>',
				data: {item: item},
				dataType: 'json',
				async: false,
				beforeSend: function(){
					$('#checkmessage').append('检测'+items[item]+' ...... ');
				},
				success: function(res){
					res.status ?  $('#checkmessage').append('<font color="">'+res.info+'</font><br/>') : $('#checkmessage').append('<font color="red">'+res.info+'</font><br/>');
					if(!res.status) pass = false;
				}
			});
		}
		if(!pass){
			$('#checkmessage').append('<font color="red">对不起，您当前环境不满足安装要求</font><br/>');
			$('#checkdialog').dialog({buttons:[{text:'重新检测',handler:function(){location.href=location.href;}}]});
		}else{
			$('#checkmessage').append('检测通过<br/>');
			$('#checkdialog').dialog({buttons:[{text:'重新检测',handler:function(){location.href=location.href;}},{text:'下一步',handler:function(){$('#install').submit();}}]});
		}
	})
	</script>

</body>
</html>