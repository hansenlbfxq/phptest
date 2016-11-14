/**
 *  模块	：编纂模块
 *  流程	：排版审核
 */
$(function(){
	var addApprovalTab = function(){
		var row = $('#approvalList').datagrid('getSelected');
		title = '《' + row.taskName + '》排版审核中…';
		taskId = row.id;
		url = 'pages/task/approvalPage.html';
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
			// 打开审核驳回层
			openRefuseBox : function(){
				$('#refuse').dialog('open');
				$('#refuseForm').form('clear');
			},
			//审核驳回
			refuse : function(){
				var id = $('#approvalList').datagrid('getSelected').id;
				$("#id").val(id);
				$.ajax({
		            type : 'PUT',
		            contentType : "application/json;charset=utf-8",
		            url : 'api/task/adjustaudit/refuse',
		            data : $('#refuseForm').serializeObjectToJson(),
		            async : false,
					success : function(data){
						$.messager.alert("提示", "排版审核驳回成功！", "info");
						$('#refuse').dialog('close');
						$('#approvalList').datagrid('reload');
					},
					error : function(data){
						$.messager.alert("提示", "排版审核驳回失败！", "info");
						$('#refuse').dialog('close');
						$('#approvalList').datagrid('reload');
					}
		        });
			},
			//审核通过
			agree : function(){
				var id = $('#approvalList').datagrid('getSelected').id;
				$.ajax({
		            type : 'PUT',
		            contentType : "application/json;charset=utf-8",
		            url : 'api/task/adjustaudit/approval/'+id,
		            data : {},
		            async : false,
					success : function(data){
						$.messager.alert("提示", "排版审核通过成功！", "info");
						$('#approvalList').datagrid('reload');
					},
					error : function(data){
						$.messager.alert("提示", "排版审核通过失败！", "info");
						$('#approvalList').datagrid('reload');
					}
		        });
			},
	}
	//构建排版审核任务列表
	$('#approvalList').datagrid({
		url : 'api/task/adjustaudit/todolist',
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
			text : '内容终审',
			iconCls: 'icon-add',
			handler : function(){
				addApprovalTab()
			}
		},'-',{
			text : '审核通过',
			iconCls: 'icon-print',
			handler : approval.agree
		},'-',{
			text : '驳回',
			iconCls: 'icon-print',
			handler : approval.openRefuseBox
		}]
	});
	// 构建驳回意见弹出层
	$('#refuse').dialog({
		title : '请填写驳回意见',
		iconCls : 'icon-save',
		width : 800,
		height : 374,
		cache : false,
		closed: true,
		modal : true,
		buttons : [{
			text : '确认',
			handler : approval.refuse
		},{
			text : '取消',
			handler : function(){
				$(this).dialog('close');
			}
		}],
		onOpen: function(){
			$('#refuseForm :input').keyup(function(event) {
				if (event.keyCode == 13) {
					checkDir.refuse();
				}
			});
		},
		onBeforeOpen : function(){
			$('#refuseForm').form('clear');
		},
		onBeforeClose : function(){
			$('#refuseForm').form('clear');
		}
	});
	// 驳回意见INPUT
	$('#opinion').textbox({
		width : 786,
		height : 300,
		required : true,
		multiline : true
	});
});