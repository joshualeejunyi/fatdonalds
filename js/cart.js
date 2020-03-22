$('document').ready(function () {
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
});