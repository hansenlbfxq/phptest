/**
 *  模块	：编纂模块
 *  流程	：任务终审 - 查看页面
 */
$(function(){
	var ueNow = UE.getEditor('editNow', {
    });

	var row = $('#approvalEndList').datagrid('getSelected');
	// 构建树
	$('#approvalEndDir').tree({
		url: 'api/task/setdir/bytask/' + row.taskId,
		method : 'GET',
		lines : true,
		onClick : function(node){
			$.ajax({
	            type: 'GET',
	            contentType: "application/json;charset=utf-8",
	            url: 'api/task/adjust/detail/task/'+row.taskId+'/node/'+node.id,
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
});