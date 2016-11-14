/**
 * Created by vikyshang on 2016-11-10.
 */
$(function(){
    $("form :input.required").each(function(){
        var $required = $("<strong style='color: red' class='high'> *</strong>"); //创建元素
        $(this).parent().append($required); //然后将它追加到文档中
    });
    //文本框失去焦点后
    $('form :input').blur(function(){
        var $parent = $(this).parent();
        $parent.find(".formtips").remove();
        //验证用户名
        if( $(this).is('#username') ){
            if( this.value=="" || this.value.length < 3 || this.value.length >20 ){
                var errorMsg = '请输入3到20位的用户名';
                $parent.append('<span style="color:red ;" class="formtips onError">'+errorMsg+'</span>');
            }
            if(this.value != null && this.value !=""){
                var name = this.value;

                checkName(name);

            }else {
                var okMsg = '';
                $parent.append('<span style="color:red ;" class="formtips onSuccess">'+okMsg+'</span>');
            }
        }
        //验证密码
        if ($(this).is('#password')){
            if( this.value=="" || this.value.length < 6 || this.value.length >20 ){
                var errorMsg = '请输入6到16位字符';
                $parent.append('<span style="color:red ;" class="formtips onError">'+errorMsg+'</span>');
            }else{

                var okMsg = '';
                $parent.append('<span style="color:red ;" class="formtips onSuccess">'+okMsg+'</span>');
            }
        }
        var password=document.getElementById("password");
        var pwd = password.value;
        if($(this).is('#repwd')){
            if(this.value != pwd || this.value == ""){
                var errorMsg = '密码输入不一致';
                $parent.append('<span style="color:red ;" class="formtips onError">'+errorMsg+'</span>');
            }else{
                var okMsg = '';
                $parent.append('<span  class="formtips onSuccess">'+okMsg+'</span>');
            }
        }

        //验证邮件
        if( $(this).is('#email') ){
            if( this.value=="" || ( this.value!="" && !/.+@.+\.[a-zA-Z]{2,4}$/.test(this.value) ) ){
                var errorMsg = '请输入正确的E-Mail地址.';
                $parent.append('<span style="color:red ;" class="formtips onError">'+errorMsg+'</span>');
            }
            if(this.value != null && this.value !=""){
                var email = this.value;
                checkEmail(email)
            } else{
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
        var user = $('.user_only').text().length;
        var email = $('.email_only').text().length;
        var agree = $('.fffff').text().length;
        var ment = $('.agreement').value;
        if(numError ||  user !=0  || email != 0 || agree != 0){

            return false;
        }

//            alert("注册成功,激活正在邮件已发送，请查收");
    });

    //重置
    $('#res').click(function(){
        $(".formtips").remove();
    });

//验证用户名唯一性
    function checkName(name) {
        var _url ="http://www.ppp.com/member/user_only";
        $.ajax({
            url:_url,
            type:'post',
            dataTye:'JSON',
            data:{name:name},
            success:function (result) {
                if( result == true ){
                    $(".user_only").html("用户名已存在");
                }else {
                    $(".user_only").html("");
                }
            }
        })
    }
//        验证邮箱唯一性

    function checkEmail(email) {
        var _url ="http://www.ppp.com/member/email_only";
        $.ajax({
            url:_url,
            type:'post',
            dataTye:'JSON',
            data:{email:email},
            success:function (result) {
                if(result == 1){
//                            return true;
                    $(".email_only").html("邮箱已存在");
                }else {
//                            return false;
                    $(".email_only").html("");
                }

            }
        })
    }


})

