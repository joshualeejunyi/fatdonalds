<?php  
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');

    if (isset($_SESSION["admin"])) {
        if ($_SESSION["admin"] === true) {
            header('location: /admin/products.php');
        }
    }

?>
<!DOCTYPE html>
<html>
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/head.inc.php');
    ?>
    <body data-spy="scroll" data-target="#navbar-menu" data-offset="100">
        <?php
            include($_SERVER['DOCUMENT_ROOT'].'/incl/nav.inc.php');
        ?>


        <header>
            <div class="row">
                <div class="col">
                    <div class="banner">
                        <h1>About Us</h1>
                    </div>
                </div>
            </div>
        </header>
        
        <main class="container">
            <section id="block">
                <div class="container">
                    <!-- Blog section -->
                    <div class="card">
                    <h5>About Description, Dec 7, 2017</h5>
                    <br />
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse volutpat nisl a est aliquet suscipit a ut velit. Donec finibus augue quis pellentesque pellentesque. Curabitur scelerisque tristique est maximus pharetra. Etiam et placerat est. Nullam efficitur ante at ex fringilla lacinia. Suspendisse fringilla nisi ac pellentesque finibus. Nulla consequat, magna ac elementum accumsan, mauris nulla vestibulum metus, eu sagittis est mi sed ex. Sed gravida semper dolor, non blandit nibh rhoncus non. Sed rutrum tellus hendrerit lectus finibus, eu luctus dui bibendum. Nulla in imperdiet metus, in pulvinar nibh. Pellentesque egestas, velit eget pellentesque ultrices, nunc augue hendrerit est, sit amet elementum neque orci et mi. Nullam vehicula in nisi et pharetra. Pellentesque ut orci at augue tempor fermentum. Integer rutrum ullamcorper mollis.</p>
                    <p>Maecenas condimentum id orci vitae placerat. Cras consequat massa enim, sit amet volutpat odio porttitor sed. Donec rutrum suscipit sapien, at varius dui lacinia in. Donec convallis nunc in magna semper rutrum. Nam vel augue lorem. Curabitur eu egestas dolor, eu dictum risus. Ut at eros at tellus fermentum facilisis vel eu diam. Suspendisse laoreet sem vel nisi finibus rhoncus. Morbi eget nibh a ipsum gravida sagittis. Nam aliquet tincidunt consequat. Nam at accumsan dui, sit amet lobortis est. Quisque gravida massa vitae nisi blandit, scelerisque placerat dolor porttitor. Quisque interdum leo id fringilla suscipit. Pellentesque sed tincidunt magna, ac vehicula odio.</p>
                    </div>
                    <br />
                </div>
            </section>
        </main>
    </body>
</html>
