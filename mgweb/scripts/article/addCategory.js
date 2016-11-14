/**
 * 文章分类发布
 */


$(function () {

    //获取分类数据
    $('#addCatePid').combotree({
        url: Qrck.baseApiUrl + 'cms/category/getcategory',
        headers: {"X-Auth-Client": $.cookie('login_name'), "X-Auth-Token": $.cookie('token')},
        required: true ,
        width: 250,
        prompt: '顶级栏目为空',
    });


    //设置语言
    $('#addCateLan').combobox({
        data: [
            {
                "id": 1,
                "text": "中 文"
            },
            {
                "id": 2,
                "text": "English"
            },
            {
                "id": 2,
                "text": "한 글"
            }
        ],
        prompt: '选择栏目语言',
        valueField: 'id',
        textField: 'text',
        editable: false,
        width: 250,
        panelHeight: 75
    });
    //设置栏目类别
    $('#addCateShowtype').combobox({
        data: [
            {
                "id": 1,
                "text": "列表显示"
            },
            {
                "id": 2,
                "text": "内容显示"
            },
            {
                "id": 2,
                "text": "链接跳转"
            }
        ],
        prompt: '选择栏目类别',
        valueField: 'id',
        textField: 'text',
        editable: false,
        width: 200,
        panelHeight: 75
    });

    //按钮样式
    $('#addCate .easyui-linkbutton').linkbutton({
        width:60,
        height:30,
        size:'large'
    });


});


function submitForm() {

    var data = $("#addedCategory").serializeArray();

    Qrck.post('cms/category/create', data,
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
            $("#addedCategory").form('clear');
        }, function () {
            $.messager.progress('close');
            $.messager.alert({
                msg: '查找一下哪里有问题....'
            });
        });
}
function clearForm() {
    $("#addedCategory").form('clear');
}

