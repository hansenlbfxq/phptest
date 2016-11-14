/**
 *  模块	：编纂模块
 *  流程	：目录审核
 */
$(function(){
	//
	checkDir = {
		//构建树
		create : function(rowIndex , rowData){
			var taskId = rowData.taskId;
			$('#checkDir').tree({
				url : 'api/task/setdir/bytask/' + taskId,
				method : 'get',
				lines : true
			});
		},
		//审核通过
		submit : function(){
			var id = $('#checkDirTask').datagrid('getSelected').id;
			$.ajax({
	            type: 'GET',
	            contentType: "application/json;charset=utf-8",
	            url: 'api/task/auditdir/auditpass/' + id,
	            async : false,
				success: function(data){
					$.messager.alert("提示", "目录审核通过！", "info");
					$('#checkDirTask').datagrid('reload');
				},
				error: function(data){
					$.messager.alert("提示", "目录审核失败！", "info");  
				}
	        });
		},
		// 打开审核驳回层
		openRefuseBox : function(){
			$('#refuseCheck').dialog('open');
		},
		//审核驳回
		refuse : function(){
			var row = $('#checkDirTask').datagrid('getSelected');
			$('#checkId').val(row.id);
			$.ajax({
	            type : 'POST',
	            contentType : "application/json;charset=utf-8",
	            url : 'api/task/auditdir/auditrefuse/',
	            data : $('#refuseCheckForm').serializeObjectToJson(),
	            async : false,
				success : function(data){
					$.messager.alert("提示", "目录审核驳回成功！", "info");
					$('#refuseCheck').dialog('close');
					$('#refuseCheckForm').form('reset');
					$('#checkDirTask').datagrid('reload');	
				},
				error : function(data){
					$.messager.alert("提示", "目录驳回失败！", "info");
					$('#refuseCheck').dialog('close');
					$('#refuseCheckForm').form('clear');
				}
	        });
		},
		// 保存模板
		saveTem : function(){
			var node = $('#checkDir').tree('getRoot')
			var typeId = $('#checkDirTask').datagrid('getSelected').typeId;
			$.ajax({
	            type : 'post',
	            contentType : "application/json;charset=utf-8",
	            url : 'api/task/dirtemplate/save/' + typeId,
	            data : $.toJSON(node),
	            async : true,
	            beforeSend : function(){
					$.messager.progress({
						text : '操作正在处理中请稍后……'
					});
				},
				success : function(data){
					$.messager.progress('close');
					$.messager.alert("提示", " 目录已存为模板！", "info");
				},
				error : function(data){
					$.messager.progress('close');
					$.messager.alert("提示", "目录保存模板失败！", "info");  
				}
	        });
		},
		//打开审核意见历史
		sugBoxOpen : function(){
			$('#sugBox').dialog('open');
			var id = $('#checkDirTask').datagrid('getSelected').setDirId;
			//构建审核意见历史列表
			$('#sugList').datagrid({
				url : 'api/task/setdir/audithistory/' + id,
				method : 'get',
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
					formatter : dataFormat
				}]]
			});
		}
	},
	// 构建驳回意见弹出层
	$('#refuseCheck').dialog({
		title : '请填写驳回意见',
		iconCls : 'icon-save',
		width : 800,
		height : 374,
	    closed : true,
	    cache : false,
	    modal : false,
		inline : true,
		buttons : [{
			text : '确认',
			handler : checkDir.refuse
		},{
			text : '取消',
			handler : function(){
				$('#refuseCheck').dialog('close');
			}
		}],
		onBeforeOpen : function(){
			$('#refuseCheckForm').form('clear');
		},
		onBeforeClose : function(){
			$('#refuseCheckForm').form('clear');
		}
	});
	// 构建代办列表
	$('#checkDirTask').datagrid({
		url : 'api/task/auditdir/todolist',
		method : 'get',
		pagination : true,
		rownumbers : true,
		singleSelect : true,
		pageSize: 20,
		pageList: [5, 10, 15, 20],
	    remoteSort: true,
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
			field : 'createDate',
			title : '创建日期',
			width : 100,
			formatter : dataFormat
		}]],
		toolbar : [{
			text : '驳回修改',
			iconCls : 'icon-undo',
			handler : checkDir.openRefuseBox
		},'-',{
			text : '存为类别模板',
			iconCls : 'icon-save',
			handler : checkDir.saveTem
		},'-',{
			text : '审核通过',
			iconCls : 'icon-ok',
			handler : checkDir.submit
		},'-',{
			text : '审核历史',
			iconCls : 'icon-more',
			handler : checkDir.sugBoxOpen
		}],
		onLoadSuccess : function(data){
			if( data.total != 0){
				$(this).datagrid('selectRow', 0);  
			}else{
				$('#west').panel('clear');
				$.messager.show({
					title : '提示',
					msg : '没有需要待审核目录的编纂任务!',
					timeout : 5000,
					showType : 'slide'
				});
			}
		},
		onSelect : checkDir.create
	});
	//构建审核意见弹出层
	$('#sugBox').dialog({
	    title : '查看审核历史',
	    width : 800,
	    height : 400,
	    closed : true,
	    cache : false,
	    modal : true
	});
	// 驳回意见INPUT
	$('#auditOpinion').textbox({
		width : 786,
		height : 300,
		required : true,
		multiline : true
	});
});