/**
 * Created by Administrator on 2016/11/6 0006.
 */
/**
 *  模块    ：文章模块
 */

$(function () {


    var DataCategorys; //分类数据全局变量

    //分类查询树
    $('#selectGetcategory').combotree({
        url: Qrck.baseApiUrl + 'cms/category/getcategory',
        method: 'get',
        multiple: true,
        prompt: '类型筛选...',
        width: 200,
        height: 30,
        onChange: function () {
            var Cids = $('#selectGetcategory').combotree('getValues');	// 获取树对象
            var Cid = Cids.join(',');
            $('#articleGrid').datagrid('load', {
                category_id: Cid
            })
        }
    });

    //状态查询
    $('#selectStatus').combobox({
        prompt: '筛选状态...',
        width: 200,
        height: 30,
        panelHeight: 50,
        editable: false,
        hasDownArrow: true,
        valueField: 'id',
        textField: 'text',

        data: [{
            id: 1,
            text: '待发布'

        }, {
            id: 2,
            text: '已发布'

        }],
        onChange: function (val) {

            $('#articleGrid').datagrid('load', {
                status: val
            });

        }
    });
    //文章列表
    $('#articleGrid').datagrid({
        onBeforeLoad: function () {
            //获取分类数组

            Qrck.post('cms/category/arrcategory', {}, '', function (DataCategory) {
                DataCategorys = DataCategory;

            });
        },
        url: Qrck.baseApiUrl + 'cms/article/index',
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
            {title: '标题', field: 'title', width: '15%', align: 'left', sortable: true},
            {title: '描述', field: 'description', width: "10%", align: 'center', sortable: true},
            {title: '关键字', field: 'keywords', width: "5%", align: 'center', sortable: true},
            {title: '来源', field: 'source', width: "10%", align: 'center', sortable: true},
            {title: '点击数', field: 'd_num', width: "5%", align: 'center', sortable: true},
            {
                title: '分类', field: 'category_id', width: "10%", align: 'center',
                formatter: function (index) {
                    return DataCategorys[index].text;
                }
            },
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
                title: '操作', field: 'id', width: "5%", align: 'center', formatter: function () {
                return '<a href="javascript:void(0)" onclick="articleUpOpen()">编辑</a>' +
                    '&nbsp;&nbsp;&nbsp;' +
                    '<a href="javascript:void(0)" onclick="articleDelete()">删除</a>';
            }
            }
        ]],
        toolbar: '#articleToolbar'
    });


});
//搜索
$('#articleSearch').searchbox({
    prompt: '列表搜索...',
    height: 30,
    width: 200,
    searcher: function () {
        $('#articleGrid').datagrid('load', {
            keyword: $('#articleSearch').searchbox('getValue')
        })
    }
});

//刷新

function articleReload() {

    $('#articleGrid').datagrid({
        onSelect: function (node) {

            console.log(node);
        }
    });

}
//添加页面
function articleAddOpen() {

    addTab('添加文章', '../../pages/article/add.html');

}
//修改页面
function articleUpOpen() {

    var row = $('#articleGrid').datagrid('getSelected');
    console.log(row);
    if (row !== null) {
        addTab('修改文章', '../../pages/article/update.html');
    } else {
        $.messager.alert('警告', '必须选择一行才能编辑!');
    }

}
//删除数据
function articleDelete() {
    var row = $('#articleGrid').datagrid('getSelected');
    Qrck.put('cms/article/status', {ids: row.id, status: 9}, function () {

    }, function (data) {
        console.log(data);
        if (data.code = 200) {
            $('#articleGrid').datagrid('load');
        }

    }, function (data) {
        console.log(data);
    });
}