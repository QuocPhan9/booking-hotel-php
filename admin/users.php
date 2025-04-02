<?php
    require('shares/essentials.php');
    require('database/db_config.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - User</title>
    <?php require('shares/links.php'); ?>
</head>
<body class="bg-light">
    <?php require('shares/header-admin.php'); ?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">User</h3>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover border">
                                <thead>
                                    <tr class="bg-success text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone no.</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">DoB</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="user-data">
                                    <!-- Dynamic rows will be added here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require('shares/script.php'); ?>
    <script src="scripts/user.js"></script>
</body>
</html>