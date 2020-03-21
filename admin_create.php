<html>
    <head>
        <?php 
        include "incl/header.inc.php";
        ?>
    </head>
    
    <body>
        <?php 
        include "incl/nav.inc.php";
        ?>
        
        <br />
        <br />
        <main class="container">
            <div class="newsform">
                <h2>Update News</h2>
                <br />
                <form action="process_postnews.php" method="post">
                    <div class="form-group">
                        <label for="fname">Posted By:</label>
                        <input class="form-control" type="text" id="postedBy" maxlength="50" name="postedBy" placeholder="Enter your name">
                    </div>

                    <div class="form-group">
                        <label for="lname">Title:</label>
                        <input class="form-control" type="text" id="title" required maxlength="50" name="title" placeholder="Enter post title">
                    </div>

                    <div class="form-group">
                        <label for="email">Text:</label>
                        <input class="form-control" type="text" id="text" required name="text" placeholder="Enter text">
                    </div>
                       <br />
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </main>
        <br />
        <br />
        
        <?php 
        include "incl/footer.inc.php";
        ?>
    </body>
</html>