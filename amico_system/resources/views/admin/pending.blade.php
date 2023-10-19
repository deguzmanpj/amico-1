<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="res/css/loginpage.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../res/css/asset_information.css">
        <link rel="stylesheet" href="../res/css/pending.css">
        <link rel="stylesheet" href="../res/css/navbar.css">

    </head>

<body>

    <div class="navigation">
        <div class="nav-bar">
            <div id="menuToggle" class="toggle-menu active">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>

        <div class="main">
            <div id="sideMenu" class="side-menu">
                <div class="menu-items">
                    <a href="#" class="item">Dashboard</a>
                    <a href="#" class="item">Users</a>
                    <a href="{{ route ('admin/receiving_repo')}}" class="item1">Asset Information</a>
                    <a href="{{ route ('admin/pending')}}"  id = "active_tab" class="item1">Pending Requests</a> <!-- item -->
                    <a href="#" class="item">Forms</a>
                    <a href="#" class="item">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <div class="header">
        <p class="pageTitle">Pending Request</p>
        <p>Amico Asset Management</p>
    </div>



    <div class="wrapper">
        <section class="section section--large" id="part1">
            <div class="container">
                <div class="table-wrapper">
                    <div class="table-title">
                    </div>
                    <table class="table table" id="8table3">
                        <thead>
                            <tr>
                                <th>Asset</th>
                                <th>Received By</th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php
                        if (!empty($results)) {
                            for ($num = 0; $num < sizeof($results); $num++) {
                                $data = $results[$num];
                                $serialNo = $data->serial_no;
                                $reqStatus = $data->req_status;
                                
                                echo '<input type = "hidden" class = "status" value ="' .  $reqStatus . '">';
                                echo '<tr>';
                                echo '<td>' . $data->asset_desc . ' - serial no: ' . $serialNo . '</td>';
                                echo '<td>' . $data->user_id . ' on ' . $data->date_rec . '</td>';
                                echo '<td>';

                                echo '<div style="display: inline-block;">'; // Container for inline display
                                echo '<form action="/accept_request" method="POST">'; // accept form
                                echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                                echo '<input type="hidden" class="serial_no" name="serial_no" value="' . $serialNo . '">';
                                echo '<button type="submit" class="accept">ACCEPT</button>';
                                echo '</form>';
                                echo '</div>';

                                echo '<div style="display: inline-block;">'; // Container for inline display
                                echo '<form action="/decline_request" method="POST">'; // decline form
                                echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                                echo '<button type="submit" class="decline">DECLINE</button>';
                                echo '<input type="hidden" class="serial_no" name="serial_no" value="' . $serialNo . '">';
                                echo '</form>';
                                echo '</div>';

                                echo '</td>';

                                
                                echo '</tr>';
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

</body>
<script src="../res/js/pending.js"></script>
<script src="../res/js/navbar.js"></script>


</html>