/**
 * Created by Administrator on 2016/11/9 0009.
 */
function showAndHideDiv(divID) {
    var obj = document.getElementById(divID);
    if (obj.style.display == "none") {
        obj.style.display = "inline";
    }
    else
        obj.style.display = "none";
}
/*回到顶部*/
var $goToTop = $(".goto-top");
//根据页面滚动条位置，显示与隐藏回到顶部按钮
$(window).scroll(function () {
    var sctop = $(document).scrollTop();
    if (sctop >= 530) {
        $goToTop.fadeIn("middle");
    } else {
        $goToTop.fadeOut("middle");
    }
});
//回到頂部
$goToTop.click(function () {
    $('html, body').animate({ scrollTop: 0 }, 'slow');
});
//});