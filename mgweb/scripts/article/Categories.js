/**
 * Created by Administrator on 2016/11/6 0006.
 */
/**
 *  模块    ：文章模块
 */

$(function () {
    //状态查询
    $('#selectShowtypes').combobox({
        prompt: '筛选状态...',
        width: 200,
        height: 30,
        panelHeight: 75,
        editable: false,
        hasDownArrow: true,
        valueField: 'id',
        textField: 'text',

        data: [{
            id: 1,
            text: '列表显示'

        }, {
            id: 2,
            text: '内容显示'

        }, {
            id: 3,
            text: '链接跳转'

        }],
        onChange: function (val) {

            $('#categoryGrid').treegrid('load', {
                showtypes: val
            });

        }
    });
    //分类列表
    $('#categoryGrid').treegrid({
        url: Qrck.baseApiUrl + 'cms/category/index',
        method: 'get',
        iconCls: 'icon-view',
        height: 650,
        width: function () {
            return document.body.clientWidth * 0.9
        },
        nowrap: true,
        autoRowHeight: false,
        fit: true,
        fitColumns: true,
        striped: true,
        collapsible: true,
        pagination: true,
        pageSize: 30,
        pageList: [30, 60, 90],
        rownumbers: true,
        sortName: 'id',
        sortOrder: 'desc',
        remoteSort: false,
        idField: 'id',
        treeField: 'text',
        columns: [[
            {field: 'ck', checkbox: true},   //选择
            {title: '栏目名称', field: 'text', width: '15%', align: 'left'},
            {
                title: '栏目语言', field: 'lan', width: "10%", align: 'center', sortable: true,
                formatter: function (value) { //格式化数据
                    if (value == 1) {
                        return '中文';
                    } else if (value == 2) {
                        return 'English'
                    } else if (value == 3) {
                        return '한 글'
                    }
                }
            },
            {
                title: '显示类型', field: 'showtype', width: "5%", align: 'center', sortable: true,
                formatter: function (value) { //格式化数据
                    if (value == 1) {
                        return '列表显示';
                    } else if (value == 2) {
                        return '内容显示'
                    } else if (value == 3) {
                        return '链接跳转'
                    }
                }
            },
            {title: '描述', field: 'descriptions', width: "10%", align: 'center', sortable: true},
            {title: '发布时间', field: 'created', width: "15%", align: 'center', sortable: true},
            {title: '更新时间', field: 'updated', width: "15%", align: 'center', sortable: true},
            {
                title: '操作', field: 'id', width: "15%", align: 'center', formatter: function () {
                return '<a href="javascript:void(0)" onclick="cateUpOpen()">编辑</a>' +
                    '&nbsp;&nbsp;&nbsp;' +
                    '<a href="javascript:void(0)" onclick="cateDelete()">删除</a>';
            }
            }
        ]],

        toolbar: '#CateToolbar'
    });


});


function cateAddOpen() {
    $('#addCates').dialog({
        title: '添加分类',
        width: 450,
        height: 430,
        closed: false,
        cache: false,
        href: '../../pages/article/addCategory.html',
        modal: true
    });
}

function cateUpOpen() {
    var row = $('#categoryGrid').treegrid('getSelected');
    console.log(row);
    if(row !== null){
        $('#upCates').dialog({
            title: '编辑分类',
            width: 450,
            height: 430,
            closed: false,
            cache: false,
            href: '../../pages/article/upCategory.html',
            modal: true
        });
    }else {
        $.messager.alert('警告','必须选择一行才能编辑!');
    }


}
function cateReload() {

    $('#categoryGrid').treegrid('load');

}
function cateDelete() {
    var row = $('#categoryGrid').treegrid('getSelected');
    Qrck.delete('cms/category/delete', {ids: row.id}, function () {

    }, function (data) {
        console.log(data);
        if (data.code = 200) {
            $('#categoryGrid').treegrid('load');
        }
        //alert('删除成功');

    }, function (data) {
        console.log(data);
    });
}


///////////////////
/**
 * 文章分类发布
 */


$(function () {

    //获取分类数据
    $('#addPid').combotree({
        url: Qrck.baseApiUrl + 'cms/category/getcategory',
        required: true,
        width: 200
    });


    //设置语言
    $('#addLan').combobox({
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
        valueField: 'id',
        textField: 'text',
        editable: false,
        width: 80,
        panelHeight: 75
    });
    //设置状态
    $('#addShowtype').combobox({
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
        valueField: 'id',
        textField: 'text',
        editable: false,
        width: 80,
        panelHeight: 75
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
                msg: '分类添加成功!'
            });
            $("#addedCategory").form('clear');
        }, function () {
            $.messager.progress('close');
            $.messager.alert({
                msg: '添加错误,查找一下哪里有问题....'
            });
        });
}
function clearForm() {
    $("#addedCategory").form('clear');
}

