/**
 *  模块	：编纂模块
 *  流程	：目录分配
 */
$(function(){
	
	assign = {
		close : function(){
			$('#assignLayout').window('close')
		},
		// 弹出分配窗口
		pop : function(){
			var row = $('#taskAssign').datagrid('getSelected');
			$("#assignedTaskId").val(row.id);
			if( row == null ){
				$.messager.alert("提示","请选择待审核分配的任务!","warning");
			}else{
				var url = 'api/task/'+ row.taskId + '/composeres/';
				console.info(url);
				$('#assignLayout').window({
					title : '审核分配 - 协同编纂业务',
					width : 800,
					height : 600,
					cache : false,
					collapsible : false,
					minimizable : false,
					maximizable : false,
					draggable : false,
					resizable : false,
					inline : true,
					modal : true,
					onOpen : function(){
						$('#assignedUserId').combobox({
							width : 450,
							height : 30,
							url : url,
							method : 'get',
							valueField : 'id',
							textField : 'fullName',
							required : true,
						});
						assign.createTree();
					},
					onClose : function(){
						$('#saveAssign').form('reset');		//关闭窗口后重置表单
						$('#bookDir').tree('loadData',[]);	//关闭窗口后清空树
					},
				});
			}
		},
		//	构建树控件
		createTree : function(){
			var row = $('#taskAssign').datagrid('getSelected');	//	取选中的行
			var taskId = row.taskId;	// 获取行ID

			//	构建树控件
			$('#assignDir').tree({
				method:'get' ,
	            contentType: "application/json;charset=utf-8",
				url: 'api/task/setdir/bytask/' + taskId,
				cache : false , 
				dataType : 'json' ,
				animate : true,
				checkbox : true,
				cascadeCheck : false,
				formatter : function(node){ //显示子节点数
					var s = node.text;
					if (node.children){
						s += ' <span style=\'color:blue\'>(' + node.children.length + ')</span>';
					}
					return s;
				},
				onCheck : function(node){
					var name = node.text;
					var id = node.id;
					var children = $('#assignDir').tree('getChecked'); //获取子节点对象
					$('#fatherName').textbox("setValue",name);
					$('#fatherId').textbox("setValue",id);
					if(children != 0){ //判断是否包含子节点
						var s = '';
						for (var i=0; i<children.length; i++){
							s += children[i].id + ',';
						}
						$('#nodeIds').textbox("setValue",s);
					}else{
						$('#nodeIds').textbox("setValue",'');
					}
				}
			});
		},
		//存草稿
		draft : function() {
			$.ajax({  
			    type: 'PUT',  
			    contentType: "application/json;charset=utf-8",  
			    url: 'api/task/dir/assign/draft',  
			    data: $('#saveAssign').serializeObjectToJson(),
				async : false,
					success: function(data) {
						$.messager.alert("提示","目录分配保存成功!","info"); 
						$('#taskAssign').datagrid("reload");
					},
					error: function(data) {
						$.messager.alert("提示","发生错误!","warning"); 
					}
			});
		},
		//确认分配
		commit : function() {
			var row = $('#taskAssign').datagrid('getSelected');	//	取选中的行
			var taskId = row.taskId;	// 获取行ID
			$("#assignedTaskId").val(row.id);
			$.ajax({  
			    type: 'PUT',  
			    contentType: "application/json;charset=utf-8",  
			    url: 'api/task/dir/assign/commit',  
			    data: $('#saveAssign').serializeObjectToJson(),
				async : false,
					success: function(data) {
						$.messager.alert("提示","任务已分配至相应的执行编辑!","info"); 
						//$('#assignLayout').window('close');
						$('#taskAssign').datagrid("reload");
					},
					error: function(data) {
						console.log(data);
						$.messager.alert("提示","发生错误!","warning"); 
					}
			});
		}
	}
	// 构建待分配任务列表
	$('#taskAssign').datagrid({
		toolbar : [{
			text : '任务分配',
			iconCls : 'icon-edit',
			handler : function(){
				assign.pop();
			}
		},{
			text : '提交分配',
			iconCls : 'icon-ok',
			id : 'commit',
			disabled : true,
			handler : assign.commit
		}],
		url : 'api/task/assign/todolist',
		method : 'GET',
		pagination : true,
		rownumbers : true,
		singleSelect : true,
	    checkOnSelect : true,
		pageSize: 20,
		pageList: [5, 10, 15, 20],
	    remoteSort: true,
		fit : true,
		fitColumns : true,
		border : false,
		columns :[[{
			field : 'id',
			checkbox : true
		},{
			field : 'taskId',
			hidden : true
		},{
			field : 'taskName',
			title : '任务名称',
			width : 100,
			formatter : function(value, rec) {
				if (value ) {
					return '《 ' + rec.taskName + ' 》';
				} 
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
		}]],
		onClickRow : function(rowIndex, rowData){
			if(rowData.draftReady == true){
				$('#commit').linkbutton('enable');
			}else{
				$('#commit').linkbutton('disable');
			}
		}
	});
	//
	$('#nodeIds').textbox({
		width : 450,
		height : 200,
		required : true,
		readonly : true,
		multiline : true
	});
});