//document.getElementsByClassName("img-thumbnail").forEach(createPopUp); 

$( document ).ready(function() {
    activateMenu();
});



$(".img-thumbnail").each(function()
{
    this.addEventListener("click", createPopUp)
});
function createPopUp(event)
{
    if($(this).parent().find("img").length === 1) 
    {
        var imageDatabase = event.target.cloneNode(true);
        var spanner = document.createElement("span");

        spanner.style.position = "absolute" ;
        spanner.style.zIndex = 1;
        spanner.append(imageDatabase);
        imageDatabase.style.width = "200%";

        event.target.parentElement.appendChild(spanner);
    }
    else 
    {
        $(this).next().next().remove();
    }
}

/*
*	This function toggles the nav menu active/inactive status as
*	different pages are selected. It should be called from $(document).ready()
*	or whenever the page loads.
*/
function activateMenu()
{
    var current_page_URL = location.href;

    $(".navbar-nav a").each(function()
    {
        var target_URL = $(this).prop("href"); if (target_URL === current_page_URL)
        {
            $('nav a').parents('li, ul').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
        }
    });
}


var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");

        if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}