/**
 *  模块	：编纂模块
 *  流程	：编纂审核 - 查看页面
 */
$(function(){
	//当前最新版本富编辑器
	var ueNow = UE.getEditor('editNow', {
		toolbars : [['FullScreen', 'strikethrough']],
    });
//	//历史修订版本弱编辑器
//	var ueOld = UE.getEditor('editOld', {
//        toolbars : [['FullScreen', 'Source', 'Undo', 'Redo','Bold','test']],
//	    /* serverUrl : '/server/ueditor/controller.php', */
//	    readonly : true,
//	    wordCount : false,
//	    enableAutoSave : false
//    });
	$('#auditForm').form('clear');
	var row = $('#verifyList').datagrid('getSelected');
	$("#id").val(row.id);
	// 驳回意见INPUT
	$('#opinion').textbox({
		width : 786,
		height : 300,
		required : true,
		multiline : true
	});
	// 交互事件
	edit = {
		//保存文稿
		save : function(){
			var con = ueNow.hasContents();
			if( con == false){
				$.messager.show({
					title : '提示信息',
					msg : '注意：编辑器内无内容！'
				});
			}else{
				var content = ueNow.getContent();
				$("#content").val(content);
				$.ajax({
		            type: 'PUT',
		            contentType: "application/json;charset=utf-8",
		            url: 'api/task/compose/audit/detail/draft',
		            data: $('#saveTmp').serializeObjectToJson(),
		            async : false,
					success: function(data){
						$.messager.show({
							title : '提示信息',
							msg : '注意：保存成功！'
						});
					},
					error: function(data){
						$.messager.show({
							title : '提示信息',
							msg : '注意：保存失败！'
						});
					}
		        });
			}
		},
		//审核通过
		submit : function(){
			$.ajax({
	            type: 'PUT',
	            contentType: "application/json;charset=utf-8",
	            url: 'api/task/compose/audit/approval',
	            data: $('#auditForm').serializeObjectToJson(),
	            async : false,
				success: function(data){
					$.messager.show({
						title : '提示信息',
						msg : '注意：审核通过！'
					});
				},
				error: function(data){
					$.messager.show({
						title : '提示信息',
						msg : '注意：审核提交失败！'
					});
				}
	        });
		},
		// 打开审核驳回层
		openRefuseBox : function(){
			$('#refuse').dialog('open');
		},
		//审核驳回
		reject : function(){
			$.ajax({
	            type: 'PUT',
	            contentType: "application/json;charset=utf-8",
	            url: 'api/task/compose/audit/reject',
	            data: $('#auditForm').serializeObjectToJson(),
	            async : false,
				success: function(data){
					$.messager.show({
						title : '提示信息',
						msg : '注意：审核驳回！'
					});
				},
				error: function(data){
					$.messager.show({
						title : '提示信息',
						msg : '注意：驳回提交失败！'
					});
				}
	        });
		}
	}
	// 构建树
	$('#verifyDir').tree({
		url : 'api/task/composeaudit/getviewtree/'+row.id,
		method : 'get',
		lines : true,
		onClick : function(node){
			$.ajax({
	            type: 'GET',
	            contentType: "application/json;charset=utf-8",
	            url: 'api/task/composeaudit/detail/task/'+row.taskId+'/node/'+node.id,
	            data: {},
	            async : false,
				success: function(data){
					ueNow.setContent(data.content);
					$("#detailId").val(data.detailId);
				},
				error: function(data){
					$.messager.show({
						title : '提示信息',
						msg : '注意：读取正文失败！'
					});
				}
	        });
		}
	});
	// 构建驳回意见弹出层
	$('#refuse').dialog({
		title : '请填写驳回意见',
		iconCls : 'icon-save',
		width : 800,
		height : 374,
		cache : false,
		closed : true,
		modal : true,
		buttons : [{
			text : '确认',
			handler : edit.reject
		},{
			text : '取消',
			handler : function(){
				$(this).dialog('close');
			}
		}]
	});
	// 历史修订版本下拉框
	$('#version').combobox({
	    url :'demodata/version.json',
	    //url :'demodata/version.json'+id,
	    method : 'get',
	    valueField : 'id',
	    textField : 'text',
	    contentField : 'content',
	    height : 26,
	    editable : false,
	    onSelect : function(record){
	    		var con = record.content;
	    		ueOld.setContent(con);
	    }
	});

});