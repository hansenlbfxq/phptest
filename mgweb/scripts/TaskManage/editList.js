/**
 *  模块	：编纂模块
 *  流程	：编纂任务代办列表
 */
$(function(){
	editList = {
		// 打开审核意见弹出层
		openSug : function(){
			var row = $('#editList').datagrid('getSelected');
			if( row == null ){
				$.messager.alert("提示", "请选择一项编纂任务！", "info");
			}else{
				$('#sugBox').dialog('open');
				$('#sugList').datagrid({
					url : 'api/task/compose/audithistory/' + row.id,
					method : 'GET',
					pagination : true,
					rownumbers : true,
					singleSelect : true,
					pageSize : 10,
					pageList : [ 10, 20, 30, 40, 50 ],
					fit : true,
					fitColumns : true,
					border : false,
					striped : true,
					columns : [[{
						title : '审核意见',
						field : 'auditOpinion',
						width : 300
					},{
						title : '审核人',
						field : 'auditerFullName',
						width : 100
					},{
						title : '审核时间',
						field : 'auditDate',
						width : 100,
						formatter:function(value,row,index){  
	                        var unixTimestamp = new Date(value);  
	                        return unixTimestamp.toLocaleString();  
	                        } 
					}]]
				});
			}
		},
		// 检查是否可以提交审核
		check : function(){
			var row = $('#editList').datagrid('getSelected');
			$.ajax({
	            type: 'GET',
	            contentType: "application/json;charset=utf-8",
	            url: 'api/task/compose/draftdone/' + row.id,
	            async : false,
				success: function(data){
					console.info(data);
					if( data.done == true ){
						$('#check').linkbutton('enable');
					}else{
						$('#check').linkbutton('disable');
					}
				},
				error: function(data){
					$.messager.alert("提示", "网络异常，请尝试刷新！", "info");  
				}
	        });
		},
		// 提交审核
		submit : function(){
			var row = $('#editList').datagrid('getSelected');
			if( row == null ){
				$.messager.alert("提示", "请选择一项需要提交审核的编纂任务！", "info");
			}else{
				$.ajax({
		            type: 'PUT',
		            contentType: "application/json;charset=utf-8",
		            url: 'api/task/compose/commit/' + row.id,
		            data: {},
		            async : false,
					success: function(data){
						$.messager.alert("提示", "提交审核成功！", "info");  
					},
					error: function(data){
						$.messager.alert("提示", "保存审核失败！", "info");  
					}
		        });
			}
		}
	},
	//	构建待编纂任务列表
	$('#editList').datagrid({
		url : 'api/task/compose/todolist',
		iconCls : 'icon-man',
		fit : true,
	    fitColumns : true,
	    pagination : true,
		pageSize: 20,
		pageList: [5, 10, 15, 20],
	    remoteSort: true,
	    singleSelect : true,
	    striped : true,
	    method : 'GET',
	    rownumbers : true,
	    border : false,
	    scrollbarSize : 10,
	    columns : [[{
	    		field : 'id',
	    		checkbox: true
	    },{
			field : 'taskName',
			title : '任务名称',
			width : 100,
			formatter : function(value, rec) {
				if (value ) {
					return '《 ' + rec.taskName + ' 》';
				} 
			},
			styler : function(value,row,index){
				return 'color: #9d0000;font-weight:bold;';
			}
		},{
			field : 'statusString',
			title : '状态',
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
			title : '目录创建者',
			width : 100
		}]],
		toolbar : [{
			text : '编写内容',
			iconCls : 'icon-add',
			handler : function(){
				addEditTab();
			}
		},'-',{
			id : 'check',
			text : '提交审核',
			iconCls : 'icon-redo',
			handler : editList.submit
		},'-',{
			text : '审核意见',
			iconCls : 'icon-more',
			handler : editList.openSug
		}],
		onDblClickRow : function(){
			addEditTab();
		}
	});
	//构建审核意见弹出层
	$('#sugBox').dialog({
	    title: '查看审核意见',
	    width: 800,
	    height: 400,
	    closed: true,
	    cache: false,
//	    modal: true
	});
});