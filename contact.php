<?php  
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');

    if ($_SESSION["admin"] === true) {
        header('location: /admin/products.php');
    }

?>
<!DOCTYPE html>
<html>
    
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/head.inc.php');
    ?>
    <body>
        <?php
            include($_SERVER['DOCUMENT_ROOT'].'/incl/nav.inc.php');
        ?>
        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuzdwZdjHBM2Pm9_0UPI3jiz7c2qIrs2M&callback=initMap">
        </script>
        <script defer src="/js/map.js">
        </script>   
        <main>
            <article id="map" class="card">
            He
            </article>
        </main>
    </body>
</html>
