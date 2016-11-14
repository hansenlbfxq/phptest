/**
 *  模块	：编纂模块
 *  流程	：创建任务
 */
$(function(){
//	构建任务列表
	$('#task').datagrid({
		toolbar: [{
			text: '创建新任务',
			iconCls: 'icon-my-add',
			handler: function(){
				addTask.add();
			}
		}],
	    url: 'api/task/list',
	    method: 'get',
	    fit : true,
	    fitColumns: true,
	    pagination: true,
		pageSize: 20,
		pageList: [5, 10, 15, 20],
	    singleSelect: true,
	    striped: true,
	    rownumbers: true,
	    border: false,
	    scrollbarSize: 10,
	    remoteSort: true,
	    autoRowHeight : false,
	    loadMsg : '正在获取远程数据，请稍后……',
	    columns:[[{
	    		field : 'id',
	    		checkbox : true
	    	},{
	    		field : 'bookName',
	    		title : '任务名称',
	    		halign : 'center',
	    		width : 30,
	    		formatter : function(value, rec) {
	    			if (value ) {
	    				return '《 ' + rec.bookName + ' 》';
	    			} 
			},
			styler : function(value,row,index){
				return 'color: #9d0000;font-weight:bold;';
			}
	    	},{
	    		field : 'typeName',
				title : '任务类型',
				halign : 'center',
				sortable : true,
				align : 'center',
				width : 20
	    	},{
				field : 'chiefEditor',
				title : '主编',
				halign : 'center',
				align : 'center',
				width : 20
	    	},{
				field : 'taskAsignUser',
				title : '副主编',
				halign : 'center',
				align : 'center',
				width : 20
			},{
				field : 'composerNames',
				title : '执行编辑',
				halign : 'center',
				align : 'center',
				width : 20
			},{
				field : 'dirSetter',
				title : '目录设置',
				halign : 'center',
				align : 'center',
				width : 20
			},{
				field : 'createDate',
				title : '任务创建时间',
				halign : 'center',
				align : 'center',
				sortable : true,
				width : 20
		}]]
	});
	// 添加删除事件
	addTask = {
		//	创建任务方法
		add : function(){
			$('#addTaskLayout').dialog({
				title: '添加新任务',
				cache: false,
				width: 600,
				modal : true,
				inline : true,
				buttons: [{
					text: '确认创建',
					iconCls: 'icon-save',
					handler: function(){
						if($('#createtaskform').form('validate')){
							$.ajax({  
							    type: 'POST',  
							    contentType: "application/json;charset=utf-8",  
							    url: 'api/task',  
							    data: $('#createtaskform').serializeObjectToJson(),
								async : false,
									success: function(data) {
										$('#task').datagrid("reload");
										$('#addTaskLayout').dialog('close');
									},
									error: function(data) {
										$.messager.alert("提示","已存在相同任务名称!","warning"); 
									}
							});
						}else{
							$.messager.show({
								title : '提示',
								msg : '请填写完整',
								showType : 'slide'
							}); 
						}
					}
				},{
					text: '重新填写',
					iconCls: 'icon-cancel',
					handler : function(){
						$('#createtaskform').form('clear');
					}
				}]
			});
		},
		//	删除任务方法
		del : function(){
			var row = $('#task').datagrid('getSelected');
			if( row == null ){
				$.messager.alert("提示","请选择待删除的任务!","warning");
			}else{
				$.messager.confirm('警告', '确认删除此任务?', function(r){
					if (r){
						var taskID = row.id;
						var deletetaskidurl="api/task/"+taskID;
						$.ajax({
				            type: 'DELETE',
				            contentType: "application/json;charset=utf-8",
				            url: deletetaskidurl,
				            data: "{}",
				            async : false,
							success: function(data){
								$('#task').datagrid('clearSelections'); 
								$.messager.alert("提示", "任务删除成功！", "info");
								$('#task').datagrid("reload");
							},
							error: function(data){
								$.messager.alert("提示", "添加失败，请重新操作！", "info");  
							}
				        });
					}
				});
			}
		}
	}
	// 构建任务类型下拉菜单
	$('#typeId').combotree({
		required:true,
		width: 450,
		height: 30,
		url: 'api/task/bztypestree',
		method: 'get',
		remote: 'remote',
		valueField: 'id',
		textField: 'name',
		onSelect : function(node){
			//返回树对象
			var tree = $(this).tree;
			//选中的节点是否为叶子节点,如果不是叶子节点,清除选中
			var isLeaf = tree('isLeaf', node.target);
			if ( !isLeaf ) {  
	            //清除选中 
	            $('#typeId').combotree('clear');  
	            $.messager.alert("提示", "任务类型选择错误！", "info");
	        } 
		}
	});
	// 构建下拉菜单
	$('#chiefEditorId,#dirSetUserId,#dirAuditUserId,#taskAsignUserId,#composeAuditUserId,#adjusterPersonId').combobox({
		required:true,
		width: 450,
		height: 30,
		url: 'api/user/list',
		method: 'get',
		remote: 'remote',
		valueField: 'id',
		textField: 'fullName'
	});
	// 任务名称
	$('#bookName').textbox({
		required:true,
		width: 450,
		height: 30
	});
	// 执行编辑支持多选
	$('#composerIds').combobox({
		required:true,
		width: 450,
		height: 30,
		url: 'api/user/list',
		method: 'get',
		valueField: 'id',
		textField: 'fullName',
		multiple: true
	});
});