/**
 *  模块	：编纂模块
 *  流程	：排版校对
 */
$(function(){
	
	var addProofTab = function(){
		var row = $('#proofList').datagrid('getSelected');
		title = '《' + row.taskName + '》校对中…';
		taskId = row.id;
		url = 'pages/task/proofPage.html';
		if ($('#MT').tabs('exists', title)){
	        $('#MT').tabs('select', title);
	    } else {
		    	$('#MT').tabs("add",{
		    		title: title,
		    		href: url,
		    		iconCls: 'icon-edit',
		    		closable: true,
		    		cache : false
		    	});
	    }
	    $('#mainLayout').layout('collapse','west');
	}
	proofList = {
			// 打开审核意见弹出层
			openSug : function(){
				var row = $('#proofList').datagrid('getSelected');
				if( row == null ){
					$.messager.alert("提示", "请选择一项校对任务！", "info");
				}else{
					$('#sugBox').dialog('open');
					$('#sugList').datagrid({
						url : 'api/task/adjust/audithistory/' + row.id,
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
			// 提交审核
			submit : function(){
				var row = $('#proofList').datagrid('getSelected');
				if( row == null ){
					$.messager.alert("提示", "请选择一项需要提交审核的排版校对任务！", "info");
				}else{
					$.ajax({
			            type: 'PUT',
			            contentType: "application/json;charset=utf-8",
			            url: 'api/task/adjust/commit/' + row.id,
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
	//构建待校对任务列表
	$('#proofList').datagrid({
		url : 'api/task/adjust/todolist',
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
			field : 'chiefEditor',
			title : '主编',
			width : 100
		},{
			field : 'associateEditor',
			title : '副主编',
			width : 100
		},{
			field : 'composeres',
			title : '执行编辑',
			width : 100
		},{
			field : 'createTime',
			title : '创建时间',
			width : 100
		}]],
		toolbar : [{
			text : '排版校对',
			iconCls: 'icon-add',
			handler : function(){
				addProofTab();
			}
		},'-',{
			text : '提交审核',
			iconCls : 'icon-redo',
			handler : proofList.submit
		},'-',{
			text : '审核意见',
			iconCls : 'icon-more',
			handler : proofList.openSug
		}]
	});
	//构建审核意见弹出层
	$('#sugBox').dialog({
	    title: '查看审核意见',
	    width: 800,
	    height: 400,
	    closed: true,
	    cache: false,
	});
});