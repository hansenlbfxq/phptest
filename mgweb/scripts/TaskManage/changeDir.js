/**
 *  模块	：编纂模块
 *  流程	：目录设置
 */
var flag ; //判断执行保存还是修改

$(function(){
	$('#savebtn').click(function(){
		if( flag == 'add' ){
			var node = $('#changeDir').tree('getSelected');
			//调用append实现前端更新
			$('#changeDir').tree('append' , {
				parent : node.target ,
				data:[{
					text: $('#myform').find('input[name=name]').val()
				}]
			});
			//后端同步更新
			$.ajax({
				type : 'post' ,
				url : 'api/task/setDir/add' ,
				cache : false , 
				data : {
					parentId : node.id ,
					name : $('#myform').find('input[name=name]').val() ,
				} ,
				dataType : 'json' ,
				success : function(result){
					//刷新节点 
					var parent = $('#changeDir').tree('getParent' , node.target);
					$('#changeDir').tree('reload',parent.target);
					$.messager.show({
						title : '提示信息',
						msg : '注意：添加目录节点成功！'
					});
				},
				error : function(result){
					$.messager.show({
						title : '提示信息',
						msg : '注意：添加目录节点失败！'
					});
				}
			});
			//更新完关闭弹出层
			$('#mydiv').dialog('close');
		}else{
			$.ajax({
				type:'post' ,
				url:'api/task/setDir/update' ,
				cache:false , 
				data:{
					id:$('#myform').find('input[name=id]').val() ,
					name:$('#myform').find('input[name=name]').val() ,
				} ,
				dataType:'json' ,
				success:function(result){
					//刷新节点 (一定是选中节点的父级节点)
					var node = $('#changeDir').tree('getSelected');
					var parent = $('#changeDir').tree('getParent' ,node.target);
					$('#changeDir').tree('reload',parent.target);
					//给出提示信息 
					$.messager.show({
						title:'提示信息',
						msg:'注意：更新目录节点成功！'
					});
				},
				error : function(result){
					$.messager.show({
						title : '提示信息',
						msg : '注意：更新目录节点失败！'
					});
				}
			});
			//3 关闭dialog
			$('#mydiv').dialog('close'); 
		}
	});
	//取消按钮
	$('#cancelbtn').click(function(){
		$('#myform').form('clear');
		$('#mydiv').dialog('close'); 
	});
	setDir = {
		//构建树
		create : function(rowIndex , rowData){
			var taskId = rowData.taskId;
			$('#changeDir').tree({
				url : 'api/task/setdir/bytask/' + taskId,
				method : 'get',
				lines : true,
				dnd : true,
				onDrop : function(target , source , point){
					var tar = $(this).tree('getNode',target);
					console.info(tar);
					console.info(source);
					console.info(point);
					$.ajax({
						type : 'post',
						url : 'api/task/setDir/update',
						dataType : 'json',
						cache : false,
						data : {
							targetId : tar.id,
							sourceId : source.id,
							point : point
						},
						success : function(result){
							$.messager.show({
								title : '提示信息',
								msg : '恭喜：更新目录结构成功！'
							});
						},
						error : function(result){
							$.messager.show({
								title : '提示信息',
								msg : '注意：更新目录结构失败！'
							});
						}
					});
				},
				onContextMenu: function(e,node){
					//禁止浏览器的菜单打开
					e.preventDefault();
					$(this).tree('select',node.target);
					$('#editBox').menu('show', {
						left: e.pageX,
						top: e.pageY
					});
				}
			});
		},
		// 追加节点方法
		append : function(){
			flag = 'add';
			$('#myform').form('clear');
			$('#mydiv').dialog('open');
			$('input[name="name"]').focus();
		},
		// 修改节点方法
		editor : function(){
			flag = 'edit';
			//清空表单数据 ,重新填充选中的节点里的id ,name , url属性
			$('#myform').form('clear');
			var node = $('#setDir').tree('getSelected');
			$('#myform').form('load',{
				id : node.id ,
				name : node.text ,
			});
			//打开dialog
			$('#mydiv').dialog('open');
		},
		// 删除节点方法
		remove : function(){
			var node = $('#changeDir').tree('getSelected');
			$('#changeDir').tree('remove' , node.target);
			//后台删除
			$.post('api/task/setDir/delete' , {id:node.id} , function(reuslt){
				//给出提示信息 
				$.messager.show({
					title:'提示信息',
					msg:'操作成功!'
				});
			});
		},
		submit : function(){
			var id = $('#changeDirTask').datagrid('getSelected').taskId;
			$.ajax({
	            type: 'post',
	            contentType: "application/json;charset=utf-8",
	            url: 'api/task/setDir/submit/' + id,
	            async : false,
				success: function(data){
					$.messager.alert("提示", "提交目录审核成功！", "info");
				},
				error: function(data){
					$.messager.alert("提示", "提交目录审核失败！", "info");  
				}
	        });
		}
	},
	// 构建代办列表
	$('#changeDirTask').datagrid({
		url : 'api/task/setdir/todolist',
		method : 'get',
		pagination : true,
		rownumbers : true,
		singleSelect : true,
		pageSize : 10,
		pageList : [ 10, 20, 30, 40, 50 ],
		fit : true,
		fitColumns : true,
		border : false,
		columns : [[{
			field : 'id',
			checkbox : true
		},{
			field : 'taskName',
			title : '任务名称',
			width : 100,
			halign : 'center',
			styler : function(value,row,index){
				return 'color: #9d0000;font-weight:bold;';
			}
		},{
			field : 'taskType',
			title : '任务类型',
			width : 100
		},{
			field : 'dirSetter',
			title : '目录创建人',
			width : 100
		},{
			field : 'dirAuditer',
			title : '目录审核',
			width : 100
		},{
			field : 'composerNames',
			title : '执行编辑',
			width : 100
		},{
			field : 'creatime',
			title : '任务创建时间',
			width : 100
		}]],
		toolbar : [{
			text : '收缩目录',
			iconCls : 'icon-undo',
			handler : function(){
				collapseAll()
			}
		},'-',{
			text : '添加目录',
			iconCls : 'icon-add',
			handler : setDir.append
		},'-',{
			text : '修改目录',
			iconCls : 'icon-edit',
			handler : setDir.editor
		},'-',{
			text : '删除目录',
			iconCls : 'icon-remove',
			handler : setDir.remove
		},'-',{
			text : '提交审核',
			iconCls : 'icon-ok',
			handler : setDir.submit
		}],
		onLoadSuccess : function(data){
			$(this).datagrid('selectRow', 0);  
		},
		onSelect : setDir.create
	});
	//输入验证
	$('input[name="name"]').validatebox({
		required : true,
		missingMessage : '请输入节点的名称',
	});
});
function collapseAll(){
	$('#changeDir').tree('collapseAll');
}
function expandAll(){
	$('#changeDir').tree('expandAll');
}