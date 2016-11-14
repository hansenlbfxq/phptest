/**
 *  模块	：编纂模块
 *  流程	：编纂审核
 */
$(function(){
	var addVerifyTab = function(){
		var row = $('#verifyList').datagrid('getSelected');
		title = '《' + row.taskName + '》审核中…';
		id = row.id;
		if ($('#MT').tabs('exists', title)){
	        $('#MT').tabs('select', title);
	    } else {
		    	$('#MT').tabs("add",{
		    		title: title,
		    		href: 'pages/task/verifyPage.html',
		    		iconCls: 'icon-edit',
		    		closable: true,
		    		cache : false
		    	});
	    }
//	    $('#mainLayout').layout('collapse','west');
	}
	//构建待编纂审核列表
	$('#verifyList').datagrid({
		url : 'api/task/compose/audit/todolist',
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
		},{
			field : 'createTime',
			title : '创建时间',
			width : 100
		}]],
		toolbar : [{
			text : '编纂审核',
			iconCls: 'icon-add',
			handler : function(){
				addVerifyTab();
			}
		}]
	});
});