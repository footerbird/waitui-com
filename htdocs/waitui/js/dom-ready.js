$(function(){
    //重置输入框
    $(document).on("click",".form-clear",function(e){
        var $input = $(e.target).siblings(".form-input").val("").focus().trigger("input");
    })
    
    if($(".my-mainpanel").length == 1){
        $(".my-mainpanel").css({
            "min-height" : ($(".my-leftmenu").height()-15)+"px"
        });
    }
    
})
