$(".addCart").on("click", function() {
    $.ajax({
        url: "deliver.php",
        type: "POST",
        data: {
            hidden_ID: $(this).prev().val()
        },
        success: function (response) {
            $(".cart-table").load("deliver.php .cart-table");
        }
    });
});

$(".removeCart").on("click", function () {
    console.log("HELP");
    console.log($(this).parent().children(".removeid"));
    $.ajax({
        url: "deliver.php",
        type: "POST",
        data: {
            remove_ID: $(this).prev().val()
        },
        success: function (response) {
            $(".cart-table").load("deliver.php .cart-table");
        }
    });
});