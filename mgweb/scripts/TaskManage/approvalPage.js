/**
 *  模块	：编纂模块
 *  流程	：排版审核 - 查看页面
 */
$(function(){
	var ueNow = UE.getEditor('editNow', {
    });
//	var ueOld = UE.getEditor('editOld', {
//        toolbars : [['FullScreen', 'Source', 'Undo', 'Redo','Bold','test']],
//	    /* serverUrl : '/server/ueditor/controller.php', */
//	    readonly : true,
//	    wordCount : false,
//	    enableAutoSave : false
//    });

	var row = $('#approvalList').datagrid('getSelected');
	// 构建树
	$('#approvalDir').tree({
		url : 'api/task/adjustaudit/getviewtree/'+row.id,
		method : 'GET',
		lines : true,
		onClick : function(node){
			$.ajax({
	            type: 'GET',
	            contentType: "application/json;charset=utf-8",
	            url: 'api/task/adjustaudit/'+ row.id +'/detail/task/'+row.taskId+'/node/'+node.id,
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
	    onLoadSuccess : function(){
	    		$('#verifyPage').layout('expand','east');
	    	},
	    onSelect : function(record){
	    		var con = record.content;
	    		ueOld.setContent(con);
	    }
	});
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
		            type: 'POST',
		            contentType: "application/json;charset=utf-8",
		            url: 'api/task/adjustaudit/draft',
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
		}
	}
});