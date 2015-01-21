<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta name="author" content="wangdong">
<title><?php echo C('SYSTEM_NAME');?></title>
<script type="text/javascript" src="/Public/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/static/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/Public/static/js/jquery.json.min.js"></script>
<script type="text/javascript" src="/Public/static/js/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/Public/static/js/easyui/locale/easyui-lang-zh_CN.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/static/css/icons.css" />
<link rel="stylesheet" type="text/css" href="/Public/static/js/easyui/themes/default/easyui.css" title="default" />
<link rel="stylesheet" type="text/css" href="/Public/static/js/easyui/themes/gray/easyui.css" title="gray" />
<link rel="stylesheet" type="text/css" href="/Public/static/js/easyui/themes/bootstrap/easyui.css" title="bootstrap" />
<link rel="stylesheet" type="text/css" href="/Public/static/js/easyui/themes/metro/easyui.css" title="metro" />
<link rel="stylesheet" type="text/css" href="/Public/static/css/admin/default.css" title="default" />
<link rel="stylesheet" type="text/css" href="/Public/static/css/admin/gray.css" title="gray" />
<link rel="stylesheet" type="text/css" href="/Public/static/css/admin/bootstrap.css" title="bootstrap" />
<link rel="stylesheet" type="text/css" href="/Public/static/css/admin/metro.css" title="metro" />
<script type="text/javascript">
var theme = $.cookie('theme') || 'bootstrap';	//全局变量
$(document).ready(function(){
	$('link[rel*=style][title]').each(function(i){
		this.disabled = true;
		if (this.getAttribute('title') == theme) this.disabled = false;
	});
});
</script>
<script type="text/javascript" src="/Public/static/js/xheditor/xheditor-iframe.min.js"></script>
<script type="text/javascript" src="/Public/static/js/xheditor/xheditor_lang/zh-cn.js"></script>
<style type="text/css">
.btnMap {width:50px !important;background:transparent url(/Public/static/js/xheditor/plugins/googlemap/map.gif) no-repeat center center;}
.btnCode {background:transparent url(/Public/static/js/xheditor/plugins/prettify/code.gif) no-repeat 16px 16px;background-position:2px 2px;}
</style>
<script type="text/javascript">
var xheditorMarkdownCSS = '<style type="text/css">*{margin:0;padding:0;}p {margin:1em 0;line-height:1.5em;}table {font-size:inherit;font:100%;margin:1em;}table th{border-bottom:1px solid #bbb;padding:.2em 1em;}table td{border-bottom:1px solid #ddd;padding:.2em 1em;}input[type=text],input[type=password],input[type=image],textarea{font:99% helvetica,arial,freesans,sans-serif;}select,option{padding:0 .25em;}optgroup{margin-top:.5em;}img{border:0;max-width:100%;}abbr{border-bottom:none;}a{color:#4183c4;text-decoration:none;}a:hover{text-decoration:underline;}a code,a:link code,a:visited code{color:#4183c4;}h2,h3{margin:1em 0;}h1,h2,h3,h4,h5,h6{border:0;}h1{font-size:170%;border-bottom:4px solid #aaa;padding-bottom:.5em;margin-top:1.5em;}h1:first-child{margin-top:0;padding-top:.25em;border-top:none;}h2{font-size:150%;margin-top:1.5em;border-bottom:4px solid #e0e0e0;padding-bottom:.5em;}h3{margin-top:1em;}hr{border:1px solid #ddd;}ul{margin:1em 0 1em 2em;}ol{margin:1em 0 1em 2em;}ul li,ol li{margin-top:.5em;margin-bottom:.5em;}ul ul,ul ol,ol ol,ol ul{margin-top:0;margin-bottom:0;}blockquote{margin:1em 0;border-left:5px solid #ddd;padding-left:.6em;color:#555;}dt{font-weight:bold;margin-left:1em;}dd{margin-left:2em;margin-bottom:1em;}pre{margin-left:2em;border-left:3px solid #CCC;padding:0 1em;}</style>';
var xheditorPlugins={
    Code:{c:'btnCode',t:'插入代码',h:1,e:function(){
		var _this=this;
		var htmlCode='<div><select id="xheCodeType"><option value="html">HTML/XML</option><option value="js">Javascript</option><option value="css">CSS</option><option value="php">PHP</option><option value="java">Java</option><option value="py">Python</option><option value="pl">Perl</option><option value="rb">Ruby</option><option value="cs">C#</option><option value="c">C++/C</option><option value="vb">VB/ASP</option><option value="">其它</option></select></div><div><textarea id="xheCodeValue" wrap="soft" spellcheck="false" style="width:300px;height:100px;" /></div><div style="text-align:right;"><input type="button" id="xheSave" value="确定" /></div>';			var jCode=$(htmlCode),jType=$('#xheCodeType',jCode),jValue=$('#xheCodeValue',jCode),jSave=$('#xheSave',jCode);
		jSave.click(function(){
			_this.loadBookmark();
			_this.pasteHTML('<pre class="prettyprint lang-'+jType.val()+'">'+_this.domEncode(jValue.val())+'</pre>');
			_this.hidePanel();
			return false;	
		});
		_this.saveBookmark();
		_this.showDialog(jCode);
	}},
    map:{c:'btnMap',t:'插入Google地图',e:function(){
        var _this=this;
        _this.saveBookmark();
        _this.showIframeModal('Google 地图','/Public/static/js/xheditor/plugins/googlemap/googlemap.html',function(v){
            _this.loadBookmark();
            _this.pasteHTML('<img src="'+v+'" />');
        },538,404);
    }}
};
var xheditorSetting = {
	skin:       'nostyle',
	plugins:    xheditorPlugins,
	loadCSS:    xheditorMarkdownCSS,
	tools:      'Cut,Copy,Paste,Pastetext,|,Blocktag,Fontface,FontSize,Bold,Italic,Underline,Strikethrough,FontColor,BackColor,SelectAll,Removeformat,|,Align,List,Outdent,Indent,|,Link,Unlink,Anchor,Img,Flash,Media,Hr,Emot,Table,Code,map,|,Source,Preview,Print,Fullscreen',
	upLinkUrl:  '<?php echo U('Upload/link');?>',
	upLinkExt:  '<?php echo implode(',',C('FILE_UPLOAD_LINK_CONFIG.exts'));?>',
	upImgUrl:   '<?php echo U('Upload/img');?>',
	upImgExt:   '<?php echo implode(',',C('FILE_UPLOAD_IMG_CONFIG.exts'));?>',
	upFlashUrl: '<?php echo U('Upload/flash');?>',
	upFlashExt: '<?php echo implode(',',C('FILE_UPLOAD_FLASH_CONFIG.exts'));?>',
	upMediaUrl: '<?php echo U('Upload/media');?>',
	upMediaExt: '<?php echo implode(',',C('FILE_UPLOAD_MEDIA_CONFIG.exts'));?>'
}
</script>
</head>
<body>
<!-- 头部按钮 -->
<div style="border-bottom:1px solid #ddd;margin-bottom:1px;padding:1px">
	<a href="javascript:;" onclick="condtentAddNewsGoBack()" class="easyui-linkbutton" data-options="plain:true,iconCls:'icons-arrow-arrow_left'">返回栏目列表</a>
</div>

<form id="content_add_news_form" onsubmit="return contentAddNewsFormSubmit()">
	<table width="100%" cellpadding="2">
		<tr>
			<td width="80">标题：</td>
			<td width="450"><input type="text" name="info[title]" style="width:100%" /></td>
			<td></td>
		</tr>
		<tr>
			<td>关键字：</td>
			<td><input type="text" name="info[keywords]" style="width:100%" /></td>
			<td></td>
		</tr>
		<tr>
			<td>描述：</td>
			<td colspan="2"><textarea name="info[description]" style="width:90%;height:60px"></textarea></td>
		</tr>
		<tr>
			<td>作者：</td>
			<td><input type="text" name="info[username]" value="<?php echo (cookie('username')); ?>" style="width:60%" /></td>
			<td></td>
		</tr>
		<tr>
			<td>缩略图：</td>
			<td>
				<input id="content_add_news_form_thumb_input" onclick="return contentAddNewsFormThumbUpload(this);" type="image" src="" alt="点击上传缩略图" style="width:200px;height:100px;display:block;border:1px solid #ddd;padding:2px" />
				<input type="hidden"  name="info[thumb]" />
			</td>
			<td></td>
		</tr>
		<tr>
			<td>内容：</td>
			<td colspan="2"><textarea id="content_add_news_form_textarea_editor" name="info[content]" style="width:90%;height:360px"></textarea></td>
		</tr>
		<tr>
			<td>转向链接：</td>
			<td colspan="2">
				<label><input type="checkbox" name="info[islink]" value="1" id="contentAddNewsFormLink" /> 启用 </label>&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="info[url]" value="http://" disabled style="width:50%" />
			</td>
		</tr>
		<tr>
			<td>状态：</td>
			<td>
				<label><input type="checkbox" name="info[status]" value="1" checked /> 发布 </label>
			</td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3"><a class="easyui-linkbutton" onclick="$('#content_add_news_form').submit()">提交</a></td>
		</tr>
	</table>
</form>

<!-- 缩略图上传 -->
<div id="content_add_news_thumb_upload_div" style="display:none"></div>

<script type="text/javascript">
$(document).ready(function(){
	//初始化编辑器
	$('#content_add_news_form_textarea_editor').xheditor(xheditorSetting);
	
	//转向链接
	$('#contentAddNewsFormLink').click(function(){
		var checked = $(this).attr('checked');
		$(this).parent('label').next('input').attr('disabled', true);
		if(checked) $(this).parent('label').next('input').attr('disabled', false);
	});
})
//表单提交
function contentAddNewsFormSubmit(){
	$.post('<?php echo U('Content/add_news_iframe?catid='.$catid);?>', $("#content_add_news_form").serialize(), function(res){
		if(!res.status){
			parent.$.messager.alert('提示信息', res.info, 'error');
		}else{
			parent.$.messager.alert('提示信息', res.info, 'info');
			condtentAddNewsGoBack();
		}
	});
	return false;
}
//返回栏目列表
function condtentAddNewsGoBack(){
	parent.contentRightTreeTypeFunc('0', <?php echo ((isset($catid) && ($catid !== ""))?($catid):0); ?>);
}

//缩略图上传初始化
function contentAddNewsFormThumbUpload(that){
	var action = '<?php echo U('Upload/thumb', array('width'=>200, 'height'=>100));?>';
	var iframe = 'content_add_news_upload_iframe';
	var html = '<iframe onload="thumbUploadCallback(this)" id="'+iframe+'" name="'+iframe+'" style="display:none"></iframe>'+
	'<form id="content_add_news_thumb_upload_div_form" action="'+action+'" target="content_add_news_upload_iframe" method="post" enctype="multipart/form-data">'+
	'<input id="content_add_news_form_up_file" type="file" tabindex="-1" name="filedata" size="13" onchange="contentAddNewsFormThumbUploadSubmit()">'+
	'</form>';
	$('#content_add_news_thumb_upload_div').html(html);
	$('#content_add_news_form_up_file').click();
	return false;
}
//缩略图上传提交
function contentAddNewsFormThumbUploadSubmit() {
	$('#content_add_news_thumb_upload_div_form').submit();
}
//缩略图上传回调函数
function thumbUploadCallback(that){
    var text = that.contentWindow.document.body.innerHTML.replace(/^[^\{]+|[^\}]+$|^\s+|\s+$/g, '');
    if(!text) return false;
	//判断上传结果
	var data = {};
	try {
		data = eval("(" + text + ")");
	} catch(err) {}
	if(data.msg && (typeof(data.msg) == 'string' || typeof(data.msg.url) == 'string')){
		var url = (typeof(data.msg) == 'string') ? data.msg : data.msg.url;
		$('#content_add_news_form_thumb_input').attr('src', url);
		$('#content_add_news_form_thumb_input').next('input:hidden').val(url);
		
		//清空上传生成的临时内容
	    $('#content_add_news_thumb_upload_div').html('');
	}else{
		var tip = data.err ? data.err : '上传失败';
		parent.$.messager.alert('提示信息', tip, 'error');
	}
}
</script>

</body>
</html>