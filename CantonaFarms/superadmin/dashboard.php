<?php

// Include database credentials and establish a connection
include('../connection/connection.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize $result variable
$result = null;

// Fetch orders from the database
$sql = "SELECT * FROM `order`"; // Backticks added around table name
$result = $conn->query($sql);

// Check if there's an error with the query execution
if ($result === false) {
    die("Error executing query: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Cantona Farms</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v6.3.0/css/all.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.2rem;
        }

        .card-header {
            background-color: #343a40;
            color: #fff;
        }

        .card-body {
            padding: 0;
        }

        .table {
            margin-bottom: 0;
        }

        .breadcrumb {
            background-color: #fff;
            padding: 10px 0;
            border-radius: 0;
        }

        .breadcrumb-item.active {
            color: #000;
        }

        .sb-sidenav-menu-heading {
            font-size: 0.9rem;
            color: #aaa;
            text-transform: uppercase;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .sb-sidenav-menu .nav-link {
            padding: 10px 20px;
            color: #fff;
            font-size: 0.9rem;
        }

        .sb-sidenav-menu .nav-link:hover {
            background-color: #343a40;
        }

        .sb-sidenav-footer {
            padding: 20px;
            background-color: #212529;
            color: #aaa;
            font-size: 0.8rem;
        }

        .sb-sidenav-footer .small {
            font-size: 0.7rem;
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <!-- Navigation Bar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.html">Cantona Farms</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="../index.html">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- Sidebar -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.html"><i class="fas fa-tachometer-alt me-2"></i>View Request</a>
                        <a class="nav-link" href="index.html"><i class="fas fa-tachometer-alt me-2"></i>View Order</a>
                        <a class="nav-link" href="../post/post.php"><i class="fas fa-tachometer-alt me-2"></i>Post Item</a>
                        <a class="nav-link" href="profile.php"><i class="fas fa-tachometer-alt me-2"></i>My Profile</a>
                        <a class="nav-link collapsed" href="../index.html" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <i class="fas fa-book-open me-2"></i>Logout
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Communication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">Whatsapp</a>
                                        <a class="nav-link" href="404.html">Email</a>
                                        <a class="nav-link" href="500.html">Short Text Box</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Super Admin
                </div>
            </nav>
        </div>
        <!-- Main Content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Super Admin Dashboard</h1>
        
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard Overview</li>
                    </ol>
                    <div class="row">
                        <!-- Display Orders Section -->
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Orders
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Equipment</th>
                                                    <th>Rental Period</th>
                                                    <th>Total Price</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Equipment</th>
                                                    <th>Rental Period</th>
                                                    <th>Total Price</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                if ($result->num_rows > 0) {
                                                    // Output data of each row
                                                    while($row = $result->fetch_assoc()) {
                                                        echo "<tr>
                                                                <td>{$row['id']}</td>
                                                                <td>{$row['customer_name']}</td>
                                                                <td>{$row['equipment']}</td>
                                                                <td>{$row['rental_period']}</td>
                                                                <td>{$row['total_price']}</td>
                                                              </tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='5'>No orders found</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <!-- Simple DataTables -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>
