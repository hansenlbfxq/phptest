/**
 * 添加
 */

$(function () {
    //设置栏目类别
    $('#addStatus').combobox({
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
        width:60,
        height:30,
        size:'large'
    });


});


function submitForm() {

    var data = $("#addForm").serializeArray();
    console.log(data);
    Qrck.post('bs/capitalreq/create', data,
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
            $("#adds").form('clear');
        }, function () {
            $.messager.progress('close');
            $.messager.alert({
                msg: '查找一下哪里有问题....'
            });
        });
}
function clearForm() {
    $("#addForm").form('clear');
}

