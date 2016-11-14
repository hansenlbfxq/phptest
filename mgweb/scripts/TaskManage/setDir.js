/**
 *  模块	：编纂模块
 *  流程	：目录设置
 */
var flag ; //判断执行保存还是修改

$(function(){
	$('#savebtn').click(function(){
		setDir.append()
	});
	//取消按钮
	$('#cancelbtn').click(function(){
		$('#myform').form('clear');
		$('#mydiv').dialog('close'); 
	});
	setDir = {
		//保存树
		saveNodes : function(){
			var nodes = $('#setDir').tree('getRoot')
			var id = $('#setDirTask').datagrid('getSelected').id;
			$.ajax({
	            type: 'post',
	            contentType: "application/json;charset=utf-8",
	            url: 'api/task/setdir/draft/'+id,
	            data : $.toJSON(nodes),
	            async : true,
				success: function(data){
					$.messager.show({
			                title : '提示',
			                msg : '目录设置保存成功!',
			                timeout : 5000,
			                showType : 'fade'
					});
				},
				error: function(data){
					$.messager.alert("提示", "保存草稿失败！", "info");  
				}
	        });
		},
		//构建树
		create : function(rowIndex , rowData){
			var taskId = rowData.taskId;
			$('#setDir').tree({
				url : 'api/task/setdir/bytask/' + taskId,
				method : 'get',
				lines : true,
				dnd : true,
				cache : false,
				onContextMenu: function(e,node){
					//禁止浏览器的菜单打开
					e.preventDefault();
					$(this).tree('select',node.target);
					$('#editBox').menu('show', {
						left : e.pageX,
						top  : e.pageY
					});
				},
				onStopDrag : setDir.saveNodes
			});
		},
		// 打开弹出层
		openBox : function(){
			var node = $('#setDir').tree('getSelected');
			if ( node == null ){
				$.messager.alert("提示", "需要先选择一个目录节点！", "info"); 
			}else{
				$('#myform').form('clear');
				$('#mydiv').dialog('open');
				$('input[name="name"]').focus();
			}
		},
		// 追加节点方法
		append : function(){
				var node = $('#setDir').tree('getSelected');
				//调用append实现前端更新
				$('#setDir').tree('append' , {
					parent : node.target ,
					data:[{
						text: $('#myform').find('input[name=name]').val()
					}]
				});
				//更新完关闭弹出层
//				$('#mydiv').dialog('close');
				setDir.saveNodes();
		},
		// 删除节点方法
		remove : function(){
			var node = $('#setDir').tree('getSelected');
			var b = $('#setDir').tree('isLeaf', node.target);
			if ( b == false ){
				$.messager.alert("提示", "不能删除根目录！", "info");
			}else{
				$('#setDir').tree('remove' , node.target);
				setDir.saveNodes();
			}	
		},
		//提交审核
		submit : function(){
			var node = $('#setDir').tree('getRoot')
			var id = $('#setDirTask').datagrid('getSelected').id;
			console.info(id);
			$.ajax({
	            type: 'post',
	            contentType: "application/json;charset=utf-8",
	            url: 'api/task/setdir/commit/'+id,
	            data : $.toJSON(node),
	            async : false,
				success: function(data){
					$.messager.alert("提示", " 目录已提交审核！", "info");
					$('#setDirTask').datagrid('reload');
				},
				error: function(data){
					$.messager.alert("提示", "目录提交审核失败！", "info");  
				}
	        });
		},
		//保存草稿
		draft : function(){
			var node = $('#setDir').tree('getRoot')
			var id = $('#setDirTask').datagrid('getSelected').id;
			$.ajax({
	            type: 'post',
	            contentType: "application/json;charset=utf-8",
	            url: 'api/task/setdir/draft/'+id,
	            data : $.toJSON(node),
	            async : false,
				success: function(data){
					$.messager.alert("提示", "保存草稿成功！", "info");
					$('#setDirTask').datagrid('reload');
				},
				error: function(data){
					$.messager.alert("提示", "保存草稿失败！", "info");  
				}
	        });
		},
		//查看审核意见
		sugBoxOpen : function(){
			$('#sugBox').dialog('open');
			var id = $('#setDirTask').datagrid('getSelected').id;
			//构建审核意见列表
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
					formatter : function(value,row,index){  
					    var unixTimestamp = new Date(value);  
					    return unixTimestamp.toLocaleString(); 
					}
				}]]
			});
		}
	},
	// 构建代办列表
	$('#setDirTask').datagrid({
		url : 'api/task/setdir/todolist',
		method : 'get',
		pagination : true,
		rownumbers : true,
		singleSelect : true,
		pageSize: 20,
		pageList: [5, 10, 15, 20],
		fit : true,
		fitColumns : true,
		border : false,
	    remoteSort: true,
		columns : [[{
			field : 'id',
			checkbox : true
		},{
			field : 'taskName',
			title : '任务名称',
			width : 100,
			halign : 'center',
			styler : function(value,row,index){
				return 'font-weight:bold;';
			}
		},{
			field : 'statusString',
			title : '状态',
			width : 100,
			halign : 'center',
			styler : function(value,row,index){
				return 'font-weight:bold;';
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
			title : '任务创建时间',
			width : 100,
			formatter : dataFormat
		}]],
		toolbar : [{
			text : '添加目录',
			iconCls : 'icon-add',
			handler : function(){
				setDir.openBox()
			}
		},'-',{
			text : '删除目录',
			iconCls : 'icon-no',
			handler : setDir.remove
		},'-',{
			text : '提交审核',
			iconCls : 'icon-ok',
			handler : setDir.submit	
		},'-',{
			text : '查看审核意见',
			iconCls : 'icon-more',
			handler : setDir.sugBoxOpen
		}],
		onLoadSuccess : function(data){
			if( data.total != 0){
				$(this).datagrid('selectRow', 0);  
			}else{
				$('#west').panel('clear');
				$.messager.show({
					title : '提示',
					msg : '没有需要待创建目录的编纂任务!',
					timeout : 5000,
					showType : 'slide'
				});
			}
		},
		onSelect : setDir.create,
		onDblClickRow : setDir.sugBoxOpen
	});
	//构建审核意见弹出层
	$('#sugBox').dialog({
	    title : '查看审核意见',
	    width : 800,
	    height : 400,
	    closed : true,
	    cache : false,
	    modal : true,
	    onOpen : function(){
	    		$('input[name="name"]').focus();
			$('#savebtn').keyup(function(event) {
				if (event.keyCode == 13) {
					setDir.saveNodes();
				}
			});
		}
	});
	//输入验证
	$('input[name="name"]').validatebox({
		required : true,
		missingMessage : '请输入节点的名称',
	});
});