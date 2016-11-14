/**
 * 文章发布
 */


$(function () {

    //获取分类数据
    $('#addCategory').combotree({
        url: Qrck.baseApiUrl + 'cms/category/getcategory',
        headers: {"X-Auth-Client": $.cookie('login_name'), "X-Auth-Token": $.cookie('token')},
        required: true
    });


    //设置状态值
    $('#addStatus').combobox({
        data: [
            {
                "id": 1,
                "text": "待 发 布"
            },
            {
                "id": 2,
                "text": "已 发 布"
            }
        ],
        valueField: 'id',
        textField: 'text',
        editable: false,
        width:80,
        panelHeight:50
    });


});


function submitForm() {

    var data = $("#addedArtitcle").serializeArray();

    Qrck.post('cms/article/create', data,
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
            $("#addedArtitcle").form('clear');
        }, function () {
            $.messager.progress('close');
            $.messager.alert({
                msg: '查找一下哪里有问题....'
            });
        });


    //$.ajax({
    //    type: 'POST',
    //    data: data,
    //    url: Qrck.baseApiUrl + '/cms/article/create',
    //    success: function (data) {
    //        console.log(data);
    //    },
    //    error: function (XmlHttpRequest, textStatus, errorThrown) {
    //        console.log(XmlHttpRequest);
    //        console.log(textStatus);
    //        console.log(errorThrown);
    //    }
    //});

}

