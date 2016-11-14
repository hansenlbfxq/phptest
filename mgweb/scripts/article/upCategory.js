/**
 * 文章分类发布
 */


$(function () {

    //获取分类数据
    $('#upCatePid').combotree({
        url: Qrck.baseApiUrl + 'cms/category/getcategory',
        headers: {"X-Auth-Client": $.cookie('login_name'), "X-Auth-Token": $.cookie('token')},
        required: true,
        width: 200,
        prompt: '顶级栏目为空',
    });


    //设置语言
    $('#upCateLan').combobox({
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
                "id": 3,
                "text": "한 글"
            }
        ],
        valueField: 'id',
        textField: 'text',
        editable: false,
        width: 80,
        panelHeight: 75
    });
    //设置语言
    $('#upCateShowtype').combobox({
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
                "id": 3,
                "text": "链接跳转"
            }
        ],
        valueField: 'id',
        textField: 'text',
        editable: false,
        width: 80,
        panelHeight: 75
    });
    var row = $('#categoryGrid').treegrid('getSelected');
    if (row.id) {
        var articleID = row.id;

    }

    var login_name = $.cookie('login_name');
    var token = $.cookie('token');
    $.ajax({
        type: 'get',
        url: Qrck.baseApiUrl + 'cms/category/view?id=' + articleID,
        success: function (data) {
            $('#upCategory').form('load', data);
            //$('#upCatePid').combotree.val(data.id);
            console.log(data);
        }
    });

    //按钮样式
    $('#addCate .easyui-linkbutton').linkbutton({
        width:60,
        height:30,
        size:'large'
    });


});


function submitForm() {
    var row = $('#categoryGrid').treegrid('getSelected');

    var data = $("#upCategory").serializeArray();

    Qrck.put('cms/category/update?id=' + row.id, data,
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
        }, function () {
            $.messager.progress('close');
            $.messager.alert({
                msg: '查找一下哪里有问题....'
            });
        });
}
function clearForm() {
    $("#upCategory").form('clear');
}

