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

	<div id="installDialog" class="easyui-dialog" title="执行安装.." data-options="closable:false,buttons:[{text:'上一步',handler:function(){history.go(-1);}},{text:'安装中..'}]" style="width:550px;height:350px">
		<p id="installmessage" class="text-info">正在准备安装 ...<br /></p>
	</div>
	<form id="install" action="<?php echo U('Index/index');?>" method="post">
		<input type="hidden" name="step" value="4">
	</form>


	<script type="text/javascript">
	$(document).ready(function(){
		$.post('<?php echo U('Index/install');?>', <?php echo ($data); ?>, function(msg){
			switch(msg){
				case '1':
					$('#installmessage').append("<font color='#ff0000'>指定的数据库不存在，系统也无法创建，请先通过其他方式建立好数据库！</font><br />");
					$('#installmessage').append("<font color='#ff0000'>安装失败！</font>");
					$('#installDialog').dialog({ buttons:[{text:'上一步',handler:function(){history.go(-1);}},{text:'安装失败'}]});
					break;
				case '2':
					$('#installmessage').append("<font color='#ff0000'>数据库文件不存在</font>");
					$('#installDialog').dialog({ buttons:[{text:'上一步',handler:function(){history.go(-1);}},{text:'安装失败'}]});
					break;
				case '3':
					$('#installmessage').append("<font color='blue'>安装完成</font>，但需要手动修改配置文件");
					$('#installDialog').dialog({ buttons:[{text:'上一步',handler:function(){history.go(-1);}},{text:'安装完成',handler:function(){$('#install').submit();}}]});
					break;
				case '4':
					$('#installmessage').append("<font color='blue'>安装完成</font>");
					$('#installDialog').dialog({ buttons:[{text:'上一步',handler:function(){history.go(-1);}},{text:'安装完成',handler:function(){$('#install').submit();}}]});
					break;
				default:
					$('#installmessage').append("<font color='#ff0000'>错误信息：</font>"+msg);
					$('#installDialog').dialog({ buttons:[{text:'上一步',handler:function(){history.go(-1);}},{text:'安装失败'}]});
			}
			document.getElementById('installmessage').scrollTop = document.getElementById('installmessage').scrollHeight;
		}, 'html');
	});
	</script>

</body>
</html>