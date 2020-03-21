$(".addCart").on("click", function ()
{
    $.ajax({
        url: "ordermenu.php",
        type: "POST",
        data: {
            hidden_ID: $(this).prev().val()
        },
    });
    $("#auto").load("ordermenu.php #auto");
});


$(".removeCart").on("click", function ()
{
    $.ajax({
        url: "ordermenu.php",
        type: "POST",
        data: {
            remove_ID: $(this).prev().val()
        },
    });
    $("#auto").load("ordermenu.php #auto");
});


