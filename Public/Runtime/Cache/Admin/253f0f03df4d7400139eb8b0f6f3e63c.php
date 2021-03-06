<?php if (!defined('THINK_PATH')) exit();?><div>
	<span class="tree-icon tree-folder tree-folder-open"></span> 
	<a href="javascript:;" onclick="contentRightTreeRefresh()">刷新</a> | 
	<a href="javascript:;" onclick="contentRightTreeCollapseAll()">收起</a> | 
	<a href="javascript:;" onclick="contentRightTreeExpandAll()">展开</a>
</div>
<div>
	<ul id="content_public_right_tree" class="easyui-tree" data-options="url:'<?php echo U('Content/public_right');?>',animate:true,lines:true"></ul>
</div>

<script type="text/javascript">
//格式化
$('#content_public_right_tree').tree({
	onClick: function(node){
		if (!node.children || node.children.length == 0){
			contentRightTreeTypeFunc(node.type, node.id);
		}
	},
	formatter:function(node){
		var res = node.text;
		if (!node.children || node.children.length == 0){
			var typeList = <?php echo json_encode(C('CONTENT_CATEGORY_TYPE'));?>;
			res = node.text + ' ['+ typeList[node.type] +']';
		}
		return res;
	}
});
//刷新
function contentRightTreeRefresh(){
	$('#content_public_right_tree').tree('reload');
}
//收起
function contentRightTreeCollapseAll(){
	$('#content_public_right_tree').tree('collapseAll');
}
//展开
function contentRightTreeExpandAll(){
	$('#content_public_right_tree').tree('expandAll');
}

//类型对应的功能
function contentRightTreeTypeFunc(type, id){
	switch(type){
		//栏目
		case '0':
			var url = '<?php echo U('Content/newsList');?>';
			url += url.indexOf('?') != -1 ? '&catid='+id : '?catid='+id;
			contentMainOpenUrl(url, false);
			break;
		//页面
		case '1':
			var url = '<?php echo U('Content/page_iframe');?>';
			url += url.indexOf('?') != -1 ? '&catid='+id : '?catid='+id;
			contentMainOpenUrl(url, true);
			break;
		//链接
		case '2':
			return false;
			break;
		default:
			$.messager.alert('提示信息', '未知的类型', 'error');
	}
};
</script>