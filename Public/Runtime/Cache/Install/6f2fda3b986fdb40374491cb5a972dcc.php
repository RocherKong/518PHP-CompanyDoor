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

	<div class="easyui-dialog" title="填写默认参数" data-options="closable:false,buttons:[{text:'上一步',handler:function(){history.go(-1);}},{text:'下一步',handler:next}]" style="width:550px;height:350px">
	<form id="install" action="<?php echo U('Index/index');?>" method="post">
		<input type="hidden" name="step" value="3">
	    <div class="panel">
	        <div class="panel-header">
	            <div class="panel-title">填写数据库信息</div>
	        </div>
	        <div class="panel-body" style="padding:8px;line-height:1.8">
		        <table>
					<tr>
						<td>数据库主机：</td>
						<td><input name="dbhost" type="text" id="dbhost" value="<?php echo C('DB_HOST');?>" <?php if(!IS_WRITE): ?>readonly<?php endif; ?> /></td>
					</tr>
					<tr>
						<td>数据库主机端口：</td>
						<td><input name="dbport" type="text" id="dbport" value="<?php echo C('DB_PORT')?C('DB_PORT'):3306 ;?>" <?php if(!IS_WRITE): ?>readonly<?php endif; ?> /></td>
					</tr>
					<tr>
						<td>数据库帐号：</td>
						<td><input name="dbuser" type="text" id="dbuser" value="<?php echo C('DB_USER');?>" <?php if(!IS_WRITE): ?>readonly<?php endif; ?> /></td>
					</tr>
					<tr>
						<td>数据库密码：</td>
						<td><input name="dbpw" type="password" id="dbpw" value="<?php echo C('DB_PWD');?>" <?php if(!IS_WRITE): ?>readonly<?php endif; ?> /></td>
					</tr>
					<tr>
						<td>数据库名称：</td>
						<td><input name="dbname" type="text" id="dbname" value="<?php echo C('DB_NAME');?>" <?php if(!IS_WRITE): ?>readonly<?php endif; ?> /></td>
					</tr>
					<tr>
						<td>数据表前缀：</td>
						<td><input name="tablepre" type="text" id="tablepre" value="<?php echo C('DB_PREFIX');?>" <?php if(!IS_WRITE): ?>readonly<?php endif; ?> /></td>
					</tr>
				</table>
			</div>
		</div>
	    
	    <div class="panel" style="margin-top:5px">
	        <div class="panel-header">
	            <div class="panel-title">填写帐号信息</div>
	        </div>
	        <div class="panel-body" style="padding:8px;line-height:1.8">
	            <table>
	            <tr>
	                <td>超级管理员帐号：</td>
	                <td><input name="username" type="text" id="username" value="wangdong" placeholder="请输入账号" /></td>
	            </tr>
	            <tr>
	                <td>管理员密码：</td>
	                <td><input name="password" type="password" id="password" value="wangdong" placeholder="请输入密码" /></td>
	            </tr>
	            <tr>
	                <td>确认密码：</td>
	                <td><input name="pwdconfirm" type="password" id="pwdconfirm" value="wangdong" placeholder="请输入确认密码" /></td>
	            </tr>
	            <tr>
	                <td>管理员E-mail：</td>
	                <td><input name="email" type="text" id="email" placeholder="请输入邮箱" /></td>
	            </tr>
	        </table>
	        <p class="text-info">提示：管理员默认密码为“wangdong”</p>
	        </div>
	    </div>
	</form>
	</div>


	<script type="text/javascript">
	var errmsg = new Array();
	errmsg[0] = '您已经安装过，系统会自动删除老数据！是否继续？';
	errmsg[2] = '无法连接数据库服务器，请检查配置！';
	errmsg[3] = '成功连接数据库，但是指定的数据库不存在并且无法自动创建，请先通过其他方式建立数据库！';
	errmsg[6] = '数据库版本低于Mysql 4.0，无法安装，请升级数据库版本！';
	function next(){
		var isPass = true;
		var error = [];
		if( !/^[A-Za-z]\w{2,19}$/.test($("#username").val()) ){
			error.push('用户名长度应为3至20位，且必须以字母开头，字母、数字和下划线组成');
			$("#username").focus();
			isPass = false;
		}else if( !/^.{6,20}$/.test($("#password").val()) ){
			error.push('密码合法长度为6至20位');
			$("#password").focus();
			isPass = false;
		}else if( $("#pwdconfirm").val() != $("#password").val() ){
			error.push('两次密码不一致');
			$("#pwdconfirm").focus();
			isPass = false;
		}else if( !/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/.test($("#email").val()) ){
			error.push('邮箱格式不正确');
			$("#email").focus();
			isPass = false;
		}
		isPass ? checkdb() : $.messager.alert('错误提示', error.join(','), 'error');
	}
	function checkdb(){
	    $.get('<?php echo U('Index/dbTest');?>', {dbhost: $('#dbhost').val(), dbport: $('#dbport').val(), dbuser: $('#dbuser').val(), dbpw: $('#dbpw').val(), dbname: $('#dbname').val(), tablepre: $('#tablepre').val(), sid: Math.random()*5}, function(data){
	    	if(data == 0){	
	    		$.messager.confirm('安装提示', errmsg[data], function(result){
					if(result) $('#install').submit();
				});
			}else if(data > 1){
				$.messager.alert('错误提示', errmsg[data], 'error');
			}else if(data == 1) {
				$('#install').submit();
			}
		});
	}
	</script>

</body>
</html>