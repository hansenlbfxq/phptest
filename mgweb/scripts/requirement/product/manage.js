/**
 * Created by Administrator on 2016/11/6 0006.
 */
/**
 *  模块：产品需求模块
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

            $('#ProductReqGrid').datagrid('load', {
                showtypes: val
            });

        }
    });
    //分类列表
    $('#ProductReqGrid').datagrid({
        url: Qrck.baseApiUrl + 'bs/productreq/index',
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
        frozenColumns: [[]],
        columns: [[
            {field: 'ck', checkbox: true},
            //{title: '所有者', field: 'owner', align: 'left', sortable: true},
            //{title: '所有者类型', field: 'owner_type', align: 'left', sortable: true},
            {title: '企业名称', field: 'company', width: '15%', align: 'left', sortable: true},
            {title: '产品名称', field: 'product', width: '15%', align: 'left', sortable: true},
            //{title: '产品简介', field: 'content', width: '5%', align: 'left', sortable: true},
            {title: '希望价格', field: 'price', width: '5%', align: 'left', sortable: true},
            {title: '联系人', field: 'link_name', width: '5%', align: 'left', sortable: true},
            {title: '联系方式', field: 'link_tel', width: '10%', align: 'left', sortable: true},
            {
                title: '语言', field: 'lan',width: '5%', align: 'left', sortable: true,
                formatter: function (value) {
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
                title: '状态', field: 'status',width: '5%', align: 'center', sortable: true,
                formatter: function (value) { //格式化数据
                    if (value == 1) {
                        return '待发布';
                    } else if (value == 2) {
                        return '已发布'
                    }
                }
            },
            {title: '发布时间', field: 'created',width: '5%', align: 'center', sortable: true},
            {title: '更新时间', field: 'updated', width: '5%',align: 'center', sortable: true},
            {
                title: '操作', field: 'id',width: '5%', align: 'center', formatter: function () {
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
    //$('#adds').dialog({
    //    title: '添加分类',
    //    width: 450,
    //    height: 430,
    //    closed: false,
    //    cache: false,
    //    href: '../../pages/ProductReq/add.html',
    //    modal: true
    //});
    addTab('发布资金需求', '../../../mgweb/pages/requirement/product/add.html');

}

function UpOpen() {
    var row = $('#ProductReqGrid').datagrid('getSelected');
    console.log(row);
    if (row !== null) {
        //弹窗添加
        //$('#ups').dialog({
        //    title: '编辑分类',
        //    width: 450,
        //    height: 430,
        //    closed: false,
        //    cache: false,
        //    href: '../../pages/ProductReq/update.html',
        //    modal: true
        //});
        //新标签页添加
        addTab('发布资金需求', '../../../mgweb/pages/requirement/product/update.html');
    } else {
        $.messager.alert('警告', '必须选择一行才能编辑!');
    }


}
function Reload() {

    $('#ProductReqGrid').datagrid('load');

}
function Delete() {

    var row = $('#ProductReqGrid').datagrid('getSelected');
    if (row !== null) {
        Qrck.delete('bs/productReq/delete', {ids: row.id}, function () {

        }, function (data) {
            console.log(data);
            if (data.code = 200) {
                $.messager.alert('提示', '删除成功!');
                $('#ProductReqGrid').datagrid('load');
            }
        }, function (data) {
            $.messager.alert('警告', '删除失败!');
            console.log(data);
        });
    } else {
        $.messager.alert('警告', '必须选择一行才能删除!');
    }
}