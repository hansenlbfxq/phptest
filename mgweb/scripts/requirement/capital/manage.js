/**
 * Created by Administrator on 2016/11/6 0006.
 */
/**
 *  模块：资金需求模块
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

            $('#CapitalReqGrid').datagrid('load', {
                showtypes: val
            });

        }
    });
    //分类列表
    $('#CapitalReqGrid').datagrid({
        url: Qrck.baseApiUrl + 'bs/capitalreq/index',
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
        frozenColumns: [[



        ]],
        columns: [[
            {field: 'ck', checkbox: true},
            //{title: '所有者', field: 'owner', align: 'left', sortable: true},
            //{title: '所有者类型', field: 'owner_type', align: 'left', sortable: true},
            {title: '企业名称', field: 'company', width: '15%', align: 'left', sortable: true},

            //{title: '语言', field: 'lan', align: 'left', sortable: true},
            {title: '资金需求量', field: 'capital_req', align: 'left', sortable: true},
            //{title: '贷款用途', field: 'useing', align: 'left', sortable: true},
            //{title: '法人代表', field: 'legal', align: 'left', sortable: true},
            //{title: '成立日期', field: 'reg_date', align: 'left', sortable: true},
            //{title: '注册资本(万元)', field: 'captial', align: 'left', sortable: true},
            //{title: '工商注册地', field: 'reg_address', align: 'left', sortable: true},
            //{title: '所属行业', field: 'industry', align: 'left', sortable: true},
            //{title: '专利情况', field: 'patent', align: 'left', sortable: true},
            //{title: '上年度销售收入(万元)', field: 'pre_income', align: 'left', sortable: true},
            //{title: '上年度净利润(万元)', field: 'pre_profit', align: 'left', sortable: true},
            //{title: '截止上年度银行贷款(万元)', field: 'pre_loan', align: 'left', sortable: true},
            //{title: '资金供应方', field: 'money_supply', align: 'left', sortable: true},
            //{title: '担保公司', field: 'bonding_company', align: 'left', sortable: true},
            //{title: '贷款品种', field: 'loan_type', align: 'left', sortable: true},
            //{title: '贷款时间', field: 'loan_date', align: 'left', sortable: true},
            //{title: '还款时间', field: 'return_date', align: 'left', sortable: true},
            //{title: '利率', field: 'rate', align: 'left', sortable: true},


            //{title: '语言', field: 'lan', align: 'left', sortable: true},
            //{title: '备注', field: 'note', align: 'left', sortable: true},
            {title: '联系人', field: 'link_name', align: 'left', sortable: true},
            {title: '联系方式', field: 'link_tel', align: 'left', sortable: true},
            {
                title: '状态', field: 'status', align: 'center', sortable: true,
                formatter: function (value) { //格式化数据
                    if (value == 1) {
                        return '待发布';
                    } else if (value == 2) {
                        return '已发布'
                    }
                }
            },
            {title: '发布时间', field: 'created', align: 'center', sortable: true},
            {title: '更新时间', field: 'updated', align: 'center', sortable: true},
            {
                title: '操作', field: 'id', align: 'center', formatter: function () {
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
    //    href: '../../pages/CapitalReq/add.html',
    //    modal: true
    //});
    addTab('发布资金需求', '../../../mgweb/pages/bs/capital/req/add.html');

}

function UpOpen() {
    var row = $('#CapitalReqGrid').datagrid('getSelected');
    console.log(row);
    if (row !== null) {
        //弹窗添加
        //$('#ups').dialog({
        //    title: '编辑分类',
        //    width: 450,
        //    height: 430,
        //    closed: false,
        //    cache: false,
        //    href: '../../pages/CapitalReq/update.html',
        //    modal: true
        //});
        //新标签页添加
        addTab('发布资金需求', '../../../mgweb/pages/bs/capital/req/update.html');
    } else {
        $.messager.alert('警告', '必须选择一行才能编辑!');
    }


}
function Reload() {

    $('#CapitalReqGrid').datagrid('load');

}
function Delete() {

    var row = $('#CapitalReqGrid').datagrid('getSelected');
    if (row !== null) {
        Qrck.delete('bs/CapitalReq/delete', {ids: row.id}, function () {

        }, function (data) {
            console.log(data);
            if (data.code = 200) {
                $.messager.alert('提示', '删除成功!');
                $('#CapitalReqGrid').datagrid('load');
            }
        }, function (data) {
            $.messager.alert('警告', '删除失败!');
            console.log(data);
        });
    } else {
        $.messager.alert('警告', '必须选择一行才能删除!');
    }
}