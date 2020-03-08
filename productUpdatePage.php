<head>
    <?php
    include "HeadInclude.php";
    ?>
</head>
<body>
    <?php
    include "nav.inc.php";
    ?>
        <main class="container">
            <h1>Product Insert Page</h1>
            <p>
            Database Display Page
            <a href="#">Database Display Page Link</a>.
            </p>
            <form enctype="multipart/form-data" action="process_productUpdate.php" method="post">
                <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <input class="form-control" type="text" id="product_name" maxlength="50" name="product_name" placeholder="Enter product name">
                </div>
                <div class="form-group">
                    <label for="product_description">Product Description:</label>
                    <input class="form-control" type="text" id="product_description" maxlength="50" name="product_description" required  placeholder="Enter product description">
                </div>
                <div class="form-group">
                    <label for="product_category">Product Category:</label>
                    <input class="form-control" type="text" id="product_category" name="product_category" required placeholder="Enter product category">
                </div>
                <div class="form-group">
                    <label for="product_status">Product Status:</label>
                    <input class="form-control" type="text" id="product_status" name="product_status" required placeholder="Enter product status E.g. Popular, Sale, Recommended">
                </div>

                <div class="form-group">
                    <label for="product_image">Product image:</label>
                    <input type="file" id="product_image" name="product_image">
                </div>
                
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>

         </main>
    <?php
    include "footer.inc.php";
    ?>
</body>
