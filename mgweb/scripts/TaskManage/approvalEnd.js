/**
 *  模块	：编纂模块
 *  流程	：任务终审 - 代办列表
 */
$(function(){
	var addApprovalTab = function(){
		var row = $('#approvalEndList').datagrid('getSelected');
		title = '《' + row.taskName + '》终审中…';
		taskId = row.id;
		url = 'pages/task/approvalEndPage.html';
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
	approval = {
			//批准出版
			agree : function(){
				var id = $('#approvalEndList').datagrid('getSelected').id;
				$.ajax({
		            type : 'POST',
		            contentType : "application/json;charset=utf-8",
		            url : 'api/task/secondaudit/pass/' + id,
		            data : {},
		            async : false,
					success : function(data){
						$.messager.alert("提示", "恭喜！任务完成并自动归档，今后您可以在成果管理中查看！", "info");
						$('#approvalList').datagrid('reload');
					},
					error : function(data){
						$.messager.alert("提示", "操作失败请重试！", "info");
					}
		        });
			},
	}
	//构建终审任务列表
	$('#approvalEndList').datagrid({
		url : 'api/task/secondaudit/todolist',
		iconCls : 'icon-man',
		fit : true,
	    fitColumns : true,
	    pagination : true,
		pageSize: 20,
		pageList: [5, 10, 15, 20],
	    singleSelect : true,
	    striped : true,
	    method : 'GET',
	    rownumbers : true,
	    border : false,
	    scrollbarSize : 10,
	    remoteSort : true,
	    columns : [[{
    		field : 'id',
    		checkbox: true
	    },{
			field : 'taskName',
			title : '任务名称',
			width : 100
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
		}]],
		toolbar : [{
			text : '内容查看',
			iconCls: 'icon-add',
			handler : function(){
				addApprovalTab()
			}
		},'-',{
			text : '批准出版',
			iconCls: 'icon-print',
			handler : function(){
				approval.agree()
			}
		}]
	});
});