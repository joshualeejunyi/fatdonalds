$(document).ready(function(){
    $('$auto').load('ordermenu.php');
    refresh();
});

function refresh()
{
    setTimeout(function() {
        load('cart.php');
        refresh();
    }, 1000);
}


// Attach a submit handler to the form
$( ".addCart" ).on("click", function() {
    var id = $(this).prev();
    var name = $(this).prev();
//    var htmlToAppend = " <td>"+id+"</td> <td>"+ name +"</td>";
//    console.log(htmlToAppend);
    $.post("cart.php", {"id":id, "name":name});
//    $("#cart").append(htmlToAppend);
});


//$(".addCart" ).on("click", function(){
//    var form_data = $(this).serialize();
//    $.ajax({
//    url: "cart.php",
//    type: "POST",
//    dataType:"json",
//    data: form_data
//    }).done(function(data){
//    $("#cart-container").html(data.products);
//    button_content.html('Add to Cart');
//    })
//    e.preventDefault();
//});