/**
 *  模块	：编纂模块
 *  流程	：在线编纂 - 编辑页面
 */
$(function(){
	// 主体编辑器
	var ueNow = UE.getEditor('editNow', {
	
    });
	// 版本查看辅编辑器
	var ueOld = UE.getEditor('editOld', {
        toolbars : [['FullScreen', 'Source', 'Undo', 'Redo','Bold']],
	    readonly : true,
	    wordCount : false,
	    enableAutoSave : false
    });
	//报送资料查看编辑器
	var ueFile = UE.getEditor('viewFile',{
	    readonly : true
    });
	// 取任务记录对象
	var row = $('#editList').datagrid('getSelected');
	//
	edit = {
			//打开报送资料
			open : function(){
				$('#insertFileLayout').dialog('open');
			},
			insert : function(){
				var txt = ueFile.getContentTxt();
				console.info(txt);
				ueNow.setContent(txt,true);
				$('#insertFileLayout').window('close');
			},
			//保存文稿
			save : function(){
				var con = ueNow.hasContents();
				if( con == false){
					$.messager.alert('提醒','编辑器内无内容，禁止保存!');
				}else{
					$.messager.progress({
		                msg : '正在保存草稿，请稍后……'
		            });
					$.ajax({
			            type: 'POST',
			            contentType: "application/json;charset=utf-8",
			            url: 'api/task/compose/draft',
			            data: $('#saveTmp').serializeObjectToJson(),
			            async : true,
						success: function(data){
							$.messager.progress('close');
						},
						error: function(data){
							$.messager.alert('Error!','数据草稿保存失败,请检查左侧选择的章节是否正确!');
							$.messager.progress('close');
						}
			        });
				}
			},
			//提交审核
			submit : function(){
				var con = ueNow.hasContents();
				if( con == false ){
					$.messager.alert("Error!","编辑器中无内容，禁止提交!","warning");
				}else{
					//var con2 = ueNow.getContent();
					//var id = $('#editDir').tree('getSelected').id;
					$.ajax({
			            type: 'PUT',
			            contentType: "application/json;charset=utf-8",
			            url: 'api/task/compose/commit/' + row.id,
			            data: {},
			            async : false,
						success: function(data){
							$.messager.alert("提示", "已经提交审核！", "info");  
						},
						error: function(data){
							$.messager.alert("提示", "保存失败，请重新操作！", "info");  
						}
			        });
				}
			}
		}
	
	// 构建树
	$('#editDir').tree({
		url : 'api/task/compose/getviewtree/'+row.id,
		method : 'GET',
		lines : true,
		onClick : function(node){
			$.ajax({
	            type : 'GET',
	            contentType : "application/json;charset=utf-8",
	            url : 'api/task/compose/detail/task/'+row.taskId+'/node/'+node.id,
	            data : {},
	            async : false,
				success : function(data){
					// 取到正文插入编辑器
					ueNow.setContent(data.content);
					// 取到目录节点ID存入隐藏文本域
					$("#detailId").val(data.detailId);
				},
				error : function(data){
					$.messager.alert('Sorry...','Loading Data Error!');
				}
	        });
			// 历史修订版本下拉框
			$('#version').combobox({
			    url : 'api/task/compose/audithistory/content/'+node.id,
			});
		}
	});
	
	//
	$('#insertFileLayout').dialog({
		title : '您可以很方便的将报送资料直接加载到文档中进行编辑',
		width : 1000,
		height : 600,
		closed : true,
		modal : true,
		collapsible : false,
		minimizable : false,
		maximizable : false,
		closable : false,
		buttons : [{
			text : '导入编辑器',
			iconCls:'icon-add',
			handler : function(){
				var ueNow = UE.getEditor('editNow');
				var txt = ueFile.getContent();
				ueNow.setContent(txt,true);
				$('#insertFileLayout').dialog('close')
			}
		},{
			text : '关闭',
			iconCls:'icon-close',
			handler : function(){
				$('#insertFileLayout').dialog('close')
			}
		}],
		onBeforeOpen : function(){
			$.parser.parse($('#insertFileLayout').parent());
		},
		onClose : function(){
			$.parser.parse($('#insertFileLayout').parent());
		}
	});
	
	//构建报送资料列表
	$('#ViewFileList').datagrid({
		url : 'api/task/filereport/viewlist/12',
		method : 'GET',
		idField : 'id',
		fit : true,
		fitColumns : true,
		border: false,
	    loadMsg : '正在获取远程数据，请稍后……',
	    columns : [[
	                {field : 'id' , checkbox : true},
	                {field : 'fileName', title : '文件名', width : 100, align : 'center'},
	                {field : 'reportCompanyName', title : '报送单位', width : 80, sortable : true, align : 'center'}
	    ]],
	    onDblClickRow : function(rowIndex , rowData){
	    		ueFile.setContent(rowData.reportContent);
	    		
	    } //点击查看报送内容
	});
	

	
	// 历史修订版本下拉框
	$('#version').combobox({
	    method : 'get',
	    valueField : 'id',
	    textField : 'text',
	    contentField : 'content',
	    height : 26,
	    editable : false,
	    onSelect : function(record){
			$('#editPage').layout('expand','east');
			var con = record.content;
			ueOld.setContent(con);
	    }
	});
	
});