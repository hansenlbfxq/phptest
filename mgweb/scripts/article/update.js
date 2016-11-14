/**
 * Created by Administrator on 2016/11/7 0007.
 */


$(function () {

    //获取分类数据
    $('#upCategory').combotree({
        url: Qrck.baseApiUrl + 'cms/category/getcategory',
        headers: {"X-Auth-Client": $.cookie('login_name'), "X-Auth-Token": $.cookie('token')},
        required: true ,
        width: 200,
        prompt: '顶级栏目为空',
    });


    //设置状态值
    $('#upStatus').combobox({
        data: [
            {
                "id": 1,
                "text": "待发布"
            },
            {
                "id": 2,
                "text": "已发布",
                "selected": true
            },
            {
                "id": 3,
                "text": "删 除"

            }
        ],
        valueField: 'id',
        textField: 'text',
        editable: false
    });

    var upid = $('#articleGrid').datagrid('getSelected');
    if (upid == null) {

        $.messager.confirm("提示", "编辑错误,请重新选择！", function () {
            removePanel();
        });

    } else {
        var articleID = upid.id;


        var login_name = $.cookie('login_name');
        var token = $.cookie('token');
        $.ajax({
            type: 'get',
            url: Qrck.baseApiUrl + 'cms/article/view?id=' + articleID,
            success: function (data) {
                $('#updateArtitcle').form('load', data);
            }
        });
    }
});


function submitForm() {
    var row = $('#articleGrid').treegrid('getSelected');

    var data = $("#updateArtitcle").serializeArray();

    Qrck.put('cms/article/update?id=' + row.id, data,
        function () {
            $.messager.progress({
                text: '请稍后……'

            });
        }, function (data) {
            $.messager.confirm("提示", "文章更新成功!", function () {
                $.messager.progress('close');
                removePanel();

            });

            //
            //console.log(data);
            //$.messager.progress('close');
            //$.messager.alert({
            //    msg: '文章更新成功!'
            //});
            //removePanel();
        }, function () {
            $.messager.progress('close');
            $.messager.alert({
                msg: '查找一下哪里有问题....'
            });
        });
}



