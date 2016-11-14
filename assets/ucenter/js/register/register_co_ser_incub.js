/**
 * Created by vikyshang on 2016-11-11.
 */
$(function(){
    $("form :input.required").each(function(){
        var $required = $("<strong class='high'> </strong>"); //创建元素
        $(this).parent().append($required); //然后将它追加到文档中
    });
    //文本框失去焦点后
    $('form :input').blur(function(){
        var $parent = $(this).parent();
        $parent.find(".formtips").remove();
        //验证单位名称
        if( $(this).is('#name') ){
            if( this.value==""){
                var errorMsg = '*请输入单位名称';
                $parent.append('<span style="color:red ;" class="formtips onError">'+errorMsg+'</span>');
            } else {
                var okMsg = '';
                $parent.append('<span class="formtips onSuccess">'+okMsg+'</span>');
            }
        }
        //验证联系人
        if( $(this).is('#link_name') ){
            if( this.value==""){
                var errorMsg = '*请输入联系人';
                $parent.append('<span style="color:red ;" class="formtips onError">'+errorMsg+'</span>');
            } else {
                var okMsg = '';
                $parent.append('<span class="formtips onSuccess">'+okMsg+'</span>');
            }
        }
        //验证联系人手机
        if ($(this).is('#link_mobile')){
            if( this.value=="" ){
                var errorMsg = '*请输入电话号码';
                $parent.append('<span style="color:red ;" class="formtips onError">'+errorMsg+'</span>');
            }
            if(this.value!="" && !/^1[34578]\d{9}$/.test(this.value) ){
                var errorMsg = '*电话号码输入有误';
                $parent.append('<span style="color:red ;" class="formtips onError">'+errorMsg+'</span>');
            }else{
                var okMsg = '';
                $parent.append('<span class="formtips onSuccess">'+okMsg+'</span>');
            }
        }
        //验证企业负责人
        if( $(this).is('#co_name') ){
            if( this.value==""){
                var errorMsg = '*请输入企业负责人';
                $parent.append('<span style="color:red ;" class="formtips onError">'+errorMsg+'</span>');
            } else {
                var okMsg = '';
                $parent.append('<span class="formtips onSuccess">'+okMsg+'</span>');
            }
        }
        //验证企业负责人联系电话
        if ($(this).is('#co_mobile')){
            if( this.value=="" ){
                var errorMsg = '*请输入电话号码';
                $parent.append('<span style="color:red ;" class="formtips onError">'+errorMsg+'</span>');
            }
            if(this.value!="" && !/^1[34578]\d{9}$/.test(this.value) ){
                var errorMsg = '*电话号码输入有误';
                $parent.append('<span style="color:red ;" class="formtips onError">'+errorMsg+'</span>');
            }else{
                var okMsg = '';
                $parent.append('<span class="formtips onSuccess">'+okMsg+'</span>');
            }
        }
    }).keyup(function(){
        $(this).triggerHandler("blur");
    }).focus(function(){
        $(this).triggerHandler("blur");
    });//end blur


    //提交，最终验证。
    $('#send').click(function(){
        $("form :input.required").trigger('blur');
        var numError = $('form .onError').length;
        if(numError ){
            return false;
        }

//            alert("注册成功,激活正在邮件已发送，请查收");
    });

    //重置
    $('#res').click(function(){
        $(".formtips").remove();
    });

})