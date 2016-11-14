/**
 *  模块	：编纂模块
 *  流程	：目录设置
 */
$(function(){
	
	setDir = {
		//	弹出编辑界面
		pop : function(){
			var row = $('#taskDir').datagrid('getSelected');
			if( row == null ){
				$.messager.alert("提示","请至少选择一个待创建的任务!","warning");
			}else{
				$('#editDir').window({
					title : '目录设置 - 协同编纂业务',
					width : 800,
					height : 600,
					cache : false,
					collapsible : false,
					minimizable : false,
					maximizable : false,
					draggable : false,
					resizable : false,
					inline : true,
					modal : true,
					onOpen : function(){
						setDir.creatTree();
					},
					onClose : function(){
						$('#saveNodes').form('reset');		//关闭窗口后重置表单
						$('#bookDir').tree('loadData',[]);	//关闭窗口后清空树
					},
				});
			}
		},
		//	tree 事件
		creatTree : function(){
			var row = $('#taskDir').datagrid('getSelected');
			var taskId = row.taskId;
			// load book DirTree
			$('#bookDir').tree({
				url : 'api/task/setdir/bytask/' + taskId,
				method : 'get',
				cache : false,
				dnd : true,
				lines : true,
//				loadFilter: function(data){ 
//					var root = [];
//					var n = $(this).tree('getRoot');
//			           if (!n){
//			               var node = {id:'1', text:'ROOT',state:'closed'};
//			               node.children = data;
//			               root.push(node);
//			               return root;          
//			            }else{
//			                return data;
//			            }
//				},
//				formatter: function(node){ //显示子节点数
//					var s = node.text;
//					if (node.children){
//						s += ' <span style=\'color:blue\'>[' + node.children.length + ']</span>';
//					}
//					return s;
//				},
				onDrop : function(target , source , point){
					var tar = $(this).tree('getNode',target);
					console.info(tar);
					console.info(source);
					console.info(point);
					$.ajax({
						type : 'post',
						url : 'api/task/setDir/update',
						dataType : 'json',
						cache : false,
						data : {
							targetId : tar.id,
							sourceId : source.id,
							point : point
						},
						success : function(result){
							$.messager.show({
								title : '提示信息',
								msg : '恭喜：更新目录结构成功！'
							});
						},
						error : function(result){
							$.messager.show({
								title : '提示信息',
								msg : '注意：更新目录结构失败！'
							});
						}
					});
				},
				onClick : function(node){
					var name = node.text;
					var id = node.id;
					var children = $('#bookDir').tree('getLeafChildren', node.target); //获取子节点对象
					$('#fatherName').textbox("setValue",name);
					$('#fatherId').textbox("setValue",id);
					if(children != 0){  //判断是否包含子节点
						var s = '';
						for (var i=0; i<children.length; i++) {
							s += children[i].text + ',';
						}
						$('#sonName').textbox("setValue",s);
					}else{
						$('#sonName').textbox("setValue",'');
					}
				}
			});
		},
		//	保存节点
		save : function(){
			var selected = $('#bookDir').tree('getSelected');
			var nodes = $('#saveNodes input[name=sonName]').val();
			var strs = new Array();
			strs = nodes.split(",");
			var data = '[';

			for (i=0; i<strs.length; i++) 
			{
				if(strs.length == i+1)
				{
					data += "{text:'" + strs[i] + "'}";
				}
				else{
					data += "{text:'" + strs[i] + "'},";
//					data += "{text:'" + strs[i] + "'},";
				}
			}
			data+=']';
			
			data1 = eval("("+data+")");
			console.info(data1);
			$('#bookDir').tree('append', {
				parent : selected.target,
				data : data1
			});
		},
		// 删除节点
		del : function(){
			var node = $('#bookDir').tree('getSelected');
			if( node == null ){
				$.messager.alert("提示","请选择需要删除的节点!","warning");
			}else if( node.id == 1 ){
				$.messager.alert("提示","禁止删除任务根节点!","warning");
			}else{
				$('#bookDir').tree('remove', node.target);
			}
		},
		
	};
	// 构建代办列表
	$('#taskDir').datagrid({
		toolbar : [{
			text : '编辑目录',
			iconCls : 'icon-edit',
			handler : function(){
				setDir.pop();
			}
		}],
		url : 'api/task/setdir/todolist',
		method : 'get',
		pagination : true,
		rownumbers : true,
		singleSelect : true,
		pageSize : 10,
		pageList : [ 10, 20, 30, 40, 50 ],
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
			field : 'creatime',
			title : '任务创建时间',
			width : 100
		}]]
	});
	//	构建input框 ////
	$('#fatherName').textbox({
		width : 450,
		height : 30,
		required : true,
		disabled : true
	});
	$('#fatherId').textbox({
		width : 450,
		height : 30,
		required : true,
		disabled : true
	});
	$('#sonName').textbox({
		width : 450,
		height : 200,
		multiline : true,
		required : true
	});
});
function TreeLevelNodeOrder(id,targetNode){
	var parent = $('#'+id).tree('getParent', targetNode);
	//获取同一级节点
	var nodeList = parent?$('#'+id).tree('getChildren',parent.target):$('#'+id).tree('getRoots');
	var orders = new Array();
	$.each(nodeList,function(i,val){
		orders[i] = nodeList[i].id;
	});
	return orders;
};