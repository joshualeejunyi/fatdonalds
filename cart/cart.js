$(".addCart").on("click", function ()
{
    $.ajax({
        url: "ordermenu.php",
        type: "POST",
        data: {
            hidden_ID: $(this).prev().val()
        },
        success: function (response) {
//            $(".tbl-cart").load("ordermenu.php .tbl-cart");
            console.log(response);
            $("#auto").load("ordermenu.php #auto");
            location.reload();
        }
    });
});


$(".removeCart").on("click", removeItem);


function removeItem()
{
    $.ajax({
        url: "ordermenu.php",
        type: "POST",
        data: {
            remove_ID: $(this).prev().val()
        },
        success: function (response) {
            console.log("Reloading");
            console.log(response);
            $("#auto").load("ordermenu.php #auto");
            location.reload();
        }
    });
    
}