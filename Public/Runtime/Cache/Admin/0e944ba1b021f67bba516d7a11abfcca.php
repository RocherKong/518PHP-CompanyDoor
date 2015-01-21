<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
$(function(){
	$('#category_category_add_dialog_form_parentid').combotree({url:'<?php echo U('Category/public_categorySelect');?>'});
	$.formValidator.initConfig({formID:"category_category_add_dialog_form",onError:function(msg){/*$.messager.alert('错误提示', msg, 'error');*/},onSuccess:categoryCategoryAddDialogFormSubmit,submitAfterAjaxPrompt:'有数据正在异步验证，请稍等...',inIframe:true});
	$("#category_category_add_dialog_form_parentid").formValidator({onShow:"请选择上级栏目",onFocus:"上级栏目不能为空"}).inputValidator({min:0,type:'value',onError:"上级栏目不能为空"}).defaultPassed();
	$("#category_category_add_dialog_form_catname").formValidator({onShow:"请输入栏目名称",onFocus:"栏目名称不能为空",onCorrect:"输入正确"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:'栏目名称不能有空格'},onError:"栏目名称不能为空"});
})
function categoryCategoryAddDialogFormSubmit(){
	$.post('<?php echo U('Category/categoryAdd');?>', $("#category_category_add_dialog_form").serialize(), function(res){
		if(!res.status){
			$.messager.alert('提示信息', res.info, 'error');
		}else{
			$.messager.alert('提示信息', res.info, 'info');
			$('#category_category_add_dialog').dialog('close');
			categoryCategoryListRefresh();
		}
	})
}
function categoryCategoryAddDialogFormTypeChange(val){
	if(val == '2'){
		$('#category_category_add_dialog_form_url').show();
	}else{
		$('#category_category_add_dialog_form_url').val('');;
		$('#category_category_add_dialog_form_url').hide();
	}
}
</script>
<form id="category_category_add_dialog_form">
<table width="100%">
	<tr>
		<td width="80">上级栏目：</td>
		<td><input id="category_category_add_dialog_form_parentid" name="info[parentid]" class="easyui-combotree" value="<?php echo ((isset($_GET['parentid']) && ($_GET['parentid'] !== ""))?($_GET['parentid']):0); ?>" style="width:180px;height:26px" /></td>
		<td><div id="category_category_add_dialog_form_parentidTip"></div></td>
	</tr>
	<tr>
		<td>栏目名称：</td>
		<td><input id="category_category_add_dialog_form_catname" name="info[catname]" type="text" style="width:178px;height:22px" /></td>
		<td><div id="category_category_add_dialog_form_catnameTip"></div></td>
	</tr>
	<tr>
		<td>栏目类型：</td>
		<td>
			<select id="category_category_add_dialog_form_type" name="info[type]" class="easyui-combobox" data-options="editable:false,panelHeight:'auto',onChange:categoryCategoryAddDialogFormTypeChange" style="width:80px">
				<?php if(is_array($typelist)): foreach($typelist as $key=>$type): ?><option value="<?php echo ($key); ?>"><?php echo ($type); ?></option><?php endforeach; endif; ?>
			</select>
			<span style="color:gray;padding-left:15px">提示：设置后将不可修改</span>
		</td>
		<td><div id="category_category_add_dialog_form_typeTip"></div></td>
	</tr>
	<tr id="category_category_add_dialog_form_url" style="display:none">
		<td>链接：</td>
		<td colspan="2"><input name="info[url]" type="text" style="width:80%;height:22px" /></td>
	</tr>
	<tr>
		<td>描述：</td>
		<td colspan="2"><textarea name="info[description]" style="width:80%;height:60px"></textarea></td>
	</tr>
	<tr>
		<td>是否启用：</td>
		<td colspan="2">
			<label><input name="info[ismenu]" value="1" type="radio" checked />是</label>
			<label><input name="info[ismenu]" value="0" type="radio" />否</label>
		</td>
	</tr>
</table>
</form>