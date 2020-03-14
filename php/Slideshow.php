<div id="Carousel" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#Carousel" data-slide-to="0" class="active"></li>
    <li data-target="#Carousel" data-slide-to="1"></li>
    <li data-target="#Carousel" data-slide-to="2"></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/Slideshow/Slideshow1.jpg" class: "carouselImg" alt="Triple Burger">
    </div>
    <div class="carousel-item">
      <img src="images/Slideshow/Slideshow2.jpg" class: "carouselImg" alt="Burger & Fries">
    </div>
    <div class="carousel-item">
      <img src="images/Slideshow/Slideshow3.jpg" class: "carouselImg" alt="Special Burger & Fries">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#Carousel" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#Carousel" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>


</div>

<style>
.center-block {float:none}
.carousel img {width:100%; height:100%}
</style>
<script>
$('.carousel').carousel({
  interval: 2000;
  pause: "hover";
})

</script>