/**
 * Created by Administrator on 2016/11/6 0006.
 */
/**
 *  模块：友情链接模块
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

            $('#flinkGrid').datagrid('load', {
                showtypes: val
            });

        }
    });
    //分类列表
    $('#flinkGrid').datagrid({
        url: Qrck.baseApiUrl + 'cms/flink/index',
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
        //ctrlSelect:true,
        singleSelect: true,
        collapsible: true,
        pagination: true,
        pageSize: 30,
        pageList: [30, 60, 90],
        rownumbers: true,
        sortName: 'id',
        sortOrder: 'desc',
        remoteSort: false,
        idField: 'id',
        selectOnCheck: false,
        checkOnSelect: false,
        columns: [[
            {field: 'ck', checkbox: true},   //选择
            {title: '名称', field: 'name', width: '15%', align: 'left', sortable: true},
            {title: '地址', field: 'url', width: '15%', align: 'left', sortable: true},
            {title: '图片', field: 'img', width: '15%', align: 'left', sortable: true},
            {title: '排序', field: 'rank', width: '15%', align: 'left', sortable: true},
            {
                title: '状态', field: 'status', width: "5%", align: 'center', sortable: true,
                formatter: function (value) { //格式化数据
                    if (value == 1) {
                        return '待发布';
                    } else if (value == 2) {
                        return '已发布'
                    }
                }
            },
            {title: '发布时间', field: 'created', width: "15%", align: 'center', sortable: true},
            {title: '更新时间', field: 'updated', width: "15%", align: 'center', sortable: true},
            {
                title: '操作', field: 'id', width: "15%", align: 'center', formatter: function () {
                return '<a href="javascript:void(0)" onclick="UpOpen()">编辑</a>' +
                    '&nbsp;&nbsp;&nbsp;' +
                    '<a href="javascript:void(0)" onclick="Delete()">删除</a>';
            }
            }
        ]],

        toolbar: '#Toolbar'
    });


});


function AddOpen() {
    $('#adds').dialog({
        title: '添加分类',
        width: 450,
        height: 430,
        closed: false,
        cache: false,
        href: '../../pages/flink/add.html',
        modal: true
    });
}

function UpOpen() {
    var row = $('#flinkGrid').datagrid('getSelected');
    console.log(row);
    if (row !== null) {
        $('#ups').dialog({
            title: '编辑分类',
            width: 450,
            height: 430,
            closed: false,
            cache: false,
            href: '../../pages/flink/update.html',
            modal: true
        });
    } else {
        $.messager.alert('警告', '必须选择一行才能编辑!');
    }


}
function Reload() {

    $('#flinkGrid').datagrid('load');

}
function Delete() {

    var row = $('#flinkGrid').datagrid('getSelected');
    if (row !== null) {
        Qrck.delete('cms/flink/delete', {ids: row.id}, function () {

        }, function (data) {
            console.log(data);
            if (data.code = 200) {
                $.messager.alert('提示', '删除成功!');
                $('#flinkGrid').datagrid('load');
            }
        }, function (data) {
            $.messager.alert('警告', '删除失败!');
            console.log(data);
        });
    } else {
        $.messager.alert('警告', '必须选择一行才能删除!');
    }
}


///////////////////
/**
 * 文章分类发布
 */


$(function () {

    //获取分类数据
    $('#addPid').combotree({
        url: Qrck.baseApiUrl + 'cms/flink/getflink',
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

    var data = $("#addedflink").serializeArray();

    Qrck.post('cms/flink/create', data,
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
            $("#addedflink").form('clear');
        }, function () {
            $.messager.progress('close');
            $.messager.alert({
                msg: '添加错误,查找一下哪里有问题....'
            });
        });
}
function clearForm() {
    $("#addedflink").form('clear');
}

