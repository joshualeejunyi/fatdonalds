/* global productID */

//$(document).ready(function(){
////    $('$auto').load('ordermenu.php');
////    refresh();
////    
////    
//    $("#addCart").click(function(){
//        $("#auto").load("cart.php");
//    })
//});

//function refresh()
//{
//    setTimeout(function() {
//        load('cart.php');
//        refresh();
//    }, 1000);
//}





$(".addCart").on("click", function ()
{
    $.ajax({
        url: "ordermenu.php",
        type: "POST",
        data: {
            hidden_ID: $(this).prev().val()
        },
        success: function (output_string)
        {
            console.log(output_string);
            $('#auto').append(output_string);
        }
    });
});