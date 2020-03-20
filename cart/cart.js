$('document').ready(function () {
    $(".addCart").on("click", function () {
        $.ajax({
            url: "deliver.php",
            type: "POST",
            data: {
                hidden_ID: $(this).prev().val()
            },
            success: function (response) {
                console.log("HI" + response);
            }
        });
    });
});
