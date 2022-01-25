<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
        <meta name="author" content="AdminKit">
        <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

        <link rel="canonical" href="https://demo-basic.adminkit.io/ui-forms.html" />

        <title>Dilanka R | Category Management</title>

        <link href="css/app.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="wrapper">
            <?php include 'inc/header.php' ?>

            <main class="content">
                <div class="container-fluid p-0">
                    <div class="mb-3 mt-5">
                        <h1 class="h3 d-inline align-middle">Category Management</h1>
                    </div>
                    <div class="row">

                        <div class="col-12 col-lg-6 mb-0 mt-0 pb-0">

                            <form method="post" action="data/add_cat.php">
                                <div class="card mb-0 mt-0 pb-0">
                                    <div class="card-body mb-0 pb-0">
                                        <h5 class="card-title mb-2">Credit / Debit</h5>
                                        <select name="type" class="form-select mb-3">
                                            <option selected>Open this select menu</option>
                                            <option value="1">Credit</option>
                                            <option value="2">Debit</option>
                                        </select>
                                        <h5 class="card-title mb-2">Category</h5>
                                        <input type="text" name="cat_name" class="form-control mb-1" placeholder="New Category Name">
                                        <select name="category" class="form-select mb-3">
                                            <option selected>Select Credit Or Debit</option>
                                        </select>
                                        <button type="submit" class="mt-2 btn btn-success">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-lg-6">
                            <form method="post" action="data/up_cat.php">
                                <input type="hidden" name="data_id" required readonly>
                                <input type="hidden" name="new_type" required readonly>
                                <div class="card">
                                    <div class="card-body mb-0 pb-0">
                                        <h5 class="card-title mb-2">Update Name</h5>
                                        <input class="form-control" placeholder="Category Name" name="new_name">
                                    </div>
                                    <div class="card">
                                        <div class="card-body mb-0 pb-0">
                                            <h5 class="card-title mb-2">Status</h5>
                                            <select name="new_status" class="form-select mb-2">
                                                <option value="1">Payed</option>
                                                <option value="0">Still Paying</option>
                                            </select>
                                            <button type="submit" name="update" class="mt-2 btn btn-warning">Update</button>
                                            <button type="submit" name="delete" class="mt-2 btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </form>
                </div>
            </main>
        </div>
        <?php include 'inc/footer.php'; ?>
    </body>
</html>