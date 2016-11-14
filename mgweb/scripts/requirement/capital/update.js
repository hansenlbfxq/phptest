/**
 * 更新
 */


$(function () {
    //设置栏目类别
    $('#upStatus').combobox({
        data: [
            {
                "id": 1,
                "text": "待发布"
            },
            {
                "id": 2,
                "text": "已发布"
            },
            {
                "id": 3,
                "text": "删  除"
            }
        ],
        prompt: '请选择类别....',
        valueField: 'id',
        textField: 'text',
        editable: false,
        width: 200,
        panelHeight: 75
    });

    //按钮样式
    $('#button .easyui-linkbutton').linkbutton({
        width: 60,
        height: 30,
        size: 'large'
    });
    //获取编辑数据
    var upid = $('#CapitalReqGrid').datagrid('getSelected');
    if (upid == null) {
        $.messager.confirm("提示", "编辑错误,请重新选择！", function () {
            removePanel();
        });

    } else {
        var CapitalReqID = upid.id;
        var login_name = $.cookie('login_name');
        var token = $.cookie('token');
        $.ajax({
            type: 'get',
            url: Qrck.baseApiUrl + 'bs/CapitalReq/view?id=' + CapitalReqID,
            success: function (data) {
                $('#upForm').form('load', data);
            }
        });
    }

});


function submitForm() {
    var row = $('#CapitalReqGrid').datagrid('getSelected');

    var data = $("#upForm").serializeArray();

    Qrck.put('bs/CapitalReq/update?id=' + row.id, data,
        function () {
            $.messager.progress({
                text: '请稍后……'

            });
        }, function (data) {
            console.log(data);
            $.messager.progress('close');
            $.messager.alert({
                msg: '文章发布成功!'
            });
            $("#upForm").form('clear');
        }, function () {
            $.messager.progress('close');
            $.messager.alert({
                msg: '查找一下哪里有问题....'
            });
        });
}
function clearForm() {
    $("#upForm").form('clear');
}

