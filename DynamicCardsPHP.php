<div class="container">
  <div class="row">
    <?php
if($lclResult->rowCount() > 0){
while($row = $lclResult->fetch(PDO::FETCH_ASSOC)) {
# code...
$lclUserName = $row['food_name'];
$lclImage = $row['food_image'];
$lclCategory = $row['food_category'];
//$lclArea = $row['us_area'];
?>
    <div class="col-sm-4">
      <div class="card">
        <img class="card-img-top " src="<?php echo $lclImage ?>" alt="Card image" style="width:100%; height: 158px;">
        <div class="card-body">
          <h4 class="card-title">
            <?php echo $lclUserName?>
          </h4>
          <p class="card-text" style="font-size: 25px;">
            <?php echo $lclCategory?>
          </p>
          <hr>
          <i class="fa fa-map-marker" style="font-size: 23px;">
            <span>&nbsp;&nbsp;
            </span>
            <?php echo $lclArea?>
          </i>
          <!-- <a href="#" class="btn btn-primary">See Profile</a> -->
        </div>
      </div>
    </div>
    <?php
}
?>
    <?php
} else { 
?>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h1> NO RESULT FOUND...
          </h1>
        </div>
      </div>
    </div>
    <?php
}
?>
  </div>  
</div>

