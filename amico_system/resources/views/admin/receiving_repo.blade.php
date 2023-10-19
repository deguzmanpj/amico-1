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
                    <a href="{{ route ('admin/asset_info')}}" id="active_tab" class="item1">Asset Management</a>
                    <a href="{{ route ('admin/pending')}}" class="item1">Pending Requests</a> <!-- item -->
                    <a href="#" class="item">Forms</a>
                    <a href="#" class="item">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="header">
        <p class="pageTitle">Receiving Report</p>
        <p>AMICO ASSET MANAGEMENT</p>

    </div>

    <div id="overlay" class="cover blur-in">


        <div class="container">
            <div class="form">
                <form action="/upload" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input id="csv" type="file" name="csvFile" accept=".csv">
                    <button id="csv" type="submit">Upload File</button>
                </form>


                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
            </div>





            <div class="table-title">
                <div class="row">
                    <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add Entry</button>
                </div>
            </div>
        </div>


        <div class="wrapper">
            <section class="section section--large" id="part1">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                        </div>
                        <table class="table table-bordered" id="8table3">
                            <thead>
                                <tr>
                                    <th>RR Number</th>
                                    <th>RR Date</th>
                                    <th>PO No.</th>
                                    <th>PO Date </th>
                                    <th>Serial No.</th>
                                    <th>Asset Description</th>
                                    <th>Funded By</th>
                                    <th>RS No. - Transferred</th>
                                </tr>
                            </thead>
                            <?php
                            if (!empty($results)) {
                                for ($num = 0; $num < sizeof($results); $num++) {
                                    $data = $results[$num];
                                    echo '<form action="/edit_asset" method="POST">'; // edit form
                                    echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                                    echo '<input type = "hidden" class = "serial_no" name = "serial_no" value ="' .  $data->serial_no . '">';
                                    echo '<tr>';
                                    echo '<td>' . '<input type="text" class="form-control" name="rr_no" value = "' . $data->rr_no . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="rr_date" value = "' . $data->rr_date . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="po_no" value = "' . $data->po_no . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="po_date" value = "' . $data->po_date . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="serial_no" value = "' . $data->serial_no . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="asset_desc" value = "' . $data->asset_desc . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="funded_by" value = "' . $data->funded_by . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="rs_no" value = "' . $data->rs_no . '"readonly></td>';

                                    echo '<td class="toggleBtns">'; // Add the class for the buttons container
                                    echo '<button type = "submit" class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></button>';
                                    echo '<a class="edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>';


                                    echo '</tr>';
                                    echo '<input class="inputForm" type = "hidden" id = "user" name="user" value="employee">';
                                    echo '</form>';
                                }
                            }
                            ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </section>
            <section class="section section--dark section--small" id="part2">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                        </div>
                        <table class="table table-bordered" id="8table3">
                            <thead>
                                <tr>
                                    <th>RR Number</th>
                                    <th>RS Date</th>
                                    <th>From - Location</th>
                                    <th>Doc No. - Donation</th>
                                    <th>Date Received</th>
                                    <th>From - Donator</th>
                                    <th>Date Acquired</th>
                                    <th>Unit</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Qty</th>
                                    <th>Received By</th>
                                </tr>
                            </thead>
                            <?php

                            use Illuminate\Support\Facades\Log;

                            if (!empty($results)) {
                                for ($num = 0; $num < sizeof($results); $num++) {
                                    $data = $results[$num];
                                    Log::info($results);
                                    echo '<form action="/edit_asset" method="POST">'; // edit form
                                    echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                                    echo '<input type = "hidden" class = "serial_no" name = "serial_no" value ="' .  $data->serial_no . '">';
                                    echo '<tr>';
                                    echo '<td>' . '<input type="text" class="form-control" name="rr_no" value = "' . $data->rr_no . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="rs_date" value = "' . $data->rs_date . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="doc_no" value = "' . $data->doc_no . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="date_rec" value = "' . $data->date_rec . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="from_loc" value = "' . $data->from_loc . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="from_don" value = "' . $data->from_don . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="date_acq" value = "' . $data->date_acq . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="date_rec" value = "' . $data->unit . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="from_loc" value = "' . $data->brand . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="from_don" value = "' . $data->model . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="date_acq" value = "' . $data->qty . '"readonly></td>';
                                    echo '<td>' . '<input type="text" class="form-control" name="user_id" value = "' . $data->user_id . '"readonly></td>';

                                    echo '<td class="toggleBtns">'; // Add the class for the buttons container
                                    echo '<button type = "submit" class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></button>';
                                    echo '<a class="edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>';

                                    echo '</td>';

                                    echo '</tr>';
                                    echo '<input class="inputForm" type = "hidden" id = "user" name="user" value="employee">';
                                    echo '</form>';
                                }
                            }
                            ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </section>

            <nav>
                <a href="{{ route ('employee/receiving_repo')}}" class="two" id="active_page">Receiving Report</a>
                <a href="{{ route ('employee/asset_info')}}" class="one">Asset Information</a>
                <a href="{{ route ('employee/ack_repo')}}" class="item1">Acknowledgement Report</a>
                <a href="{{ route ('employee/prop_borr')}}" class="item1">Property Borrowing</a>
                <a href="{{ route ('employee/main_req')}}" class="item1">Maintenance Request</a>
                <a href="{{ route ('employee/condemn_req')}}" class="item1">Condemnation Request</a>
            </nav>

        </div>
    </div>

    <div class="row pop-up">
        <button class="close-button"> x </button>
        <div class=entry>
            <!-- <div class=entry_container>
            <div class="form">
                    <form action = "addEntry" method = "POST">
                   
                    @csrf
                    <label for="rrDate">RR Date</label>
                    <input type = text id="rrDate" name="rrDate"></br>
                    <label for="rrDate">PO No.</label>
                    <input type = text id="poNo" name="poNo"></br>
                    <label for="rrDate">PO Date</label>
                    <input type = text id="poDate" name="poDate"></br>
                    <label for="rrDate">Serial No.</label>
                    <input type = text id="serialNo" name="serialNo"></br>
                    <label for="rrDate">Asset Description</label>
                    <input type = text id="assetDesc" name="serialNo"></br>
                    <label for="rrDate">Funded By</label>
                    <input type = text id="fundedBy" name="fundedBy"></br>
                    <label for="rrDate">RS No.-Transferred</label>
                    <input type = text id="rsNo" name="rsNo"></br>
                    <input type="submit" id="submit" value="Submit">
                    </form>
                </div>
            </div> -->
            <!-- <svg viewBox="0 0 790 3000">
                <defs>
                    <linearGradient inkscape:collect="always" id="linearGradient" x1="13" y1="193.49992" x2="307" y2="193.49992"  gradientUnits="userSpaceOnUse">
                        <stop style="stop-color:#ff00ff;" offset="0" id="stop876" />
                        <stop style="stop-color:#ff0000;" offset="1" id="stop878" />
                    </linearGradient>
                </defs>
                <path id = path1 d="m 100,140.00016 239.99984,-3.2e-4 
                c 0,0 24.99261,0.79931 25.00011,35.00011 0.001,34.20081 -25.00011,35 -25.00011,35 
                h -210.99981 
                c 0,-0.0202 -25,4.01342 -25,38.5 0,34.48652 25,38.5 25,38.5 
                h 215
                c 0,0 24.99263,0.79933 25.00013,35.00013 0.008,34.20083 -25.00013,35 -25.00013,35 
                h -210.99984 
                c 0,-0.02054 -25,4.013484 -25,38.5 0,34.486524 25,28.5 25,28.5 
                h 215"
                opacity="1"></path>
                
                
                <path id = path2 d = "m 100,400.00016 239.99984,-3.2e-4 
                c 0,0 24.992634,0.799324 25.000164,35.000164 0.008,34.200844 -25.000164,35 -25.000164,35 
                h -210.99984
                c 0,-0.0205 -25,4.013485 -25,38.5 0,18.486525 25,18.5 25,18.5
                h 215

                c 0,0 24.992636,0.799326 25.00016,35.000166 0.008,34.200846 -25.00016,35 -25.00016,35 
                h -210.99984
                c 0,-0.02057 -25,4.013487 -25,38.5 0,34.486752 25,30.5 25,30.5 
                h 215"
                opacity="0"></path>


                <path id = path3 d = "m 100,800.00016 239.99984,-3.2e-4 
                c 0,0 24.992683,0.79932 25.00016,35.000186 0.008,34.20084 -25.00016,35 -25.00016,35 
                h -210.99984 
                c 0,-0.0205 -25,4.013489 -25,38.5 0,34.48652 25,22.5 25,22.5 
                h 215
                
                c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.200849 -25.00016,35 -25.00016,35 
                h -210.99984 
                c 0,-0.02057 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 
                h 215"
                opacity="0"
                ></path>
            </svg> -->



            <!-- c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 
                h -190 
                c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 
                h 168.57143 -->


            <div class="form">

                <form action="/report" method="POST">
                    <!-- cross-site request forgery -->
                    @csrf
                    <label for="rrNumber">RR Number</label>
                    <input class="inputForm" type=text id="rrNumber" name="rrNumber">
                    <label for="rrDate">RR Date</label>
                    <input class="inputForm" type=date id="rrDate" name="rrDate">
                    <label for="poNo">PO No.</label>
                    <input class="inputForm" type=text id="poNo" name="poNo">
                    <label for="poDate">PO Date</label>
                    <input class="inputForm" type=date id="poDate" name="poDate">
                    <label for="assetDesc">Asset Description</label>
                    <input class="inputForm" type=text id="assetDesc" name="assetDesc">
                    <label for="fundedBy">Funded By</label>
                    <input class="inputForm" type=text id="fundedBy" name="fundedBy">
                    <label for="rsNo">RS No.-Transferred</label>
                    <input class="inputForm" type=text id="rsNo" name="rsNo">

                    <label for="rsDate">RS Date</label>
                    <input class="inputForm" type=date id="rsDate" name="rsDate">

                    <label for="docNo">Doc No. - Donation/Grant</label>
                    <input class="inputForm" type=text id="docNo" name="docNo">

                    <label for="dateRec">Date Received</label>
                    <input class="inputForm" type=date id="dateRec" name="dateRec">
                    <label for="location">From - Location.</label>
                    <input class="inputForm" type=text id="location" name="location">
                    <label for="donator">From - Donator/Grantor</label>
                    <input class="inputForm" type=text id="donator" name="donator">
                    <label for="dateAcq">Date Acquired</label>
                    <input class="inputForm" type=date id="dateAcq" name="dateAcq">
                    <label for="receivedBy">Received By</label>
                    <input class="inputForm" type=text id="receivedBy" name="receivedBy">
                    <label for="receivedBy">Brand</label>
                    <input class="inputForm" type=text id="brand" name="brand">
                    <label for="receivedBy">Model</label>
                    <input class="inputForm" type=text id="model" name="model">
                    <label for="receivedBy">Unit</label>
                    <input class="inputForm" type=text id="unit" name="unit">
                    <label for="receivedBy">Quantity</label>
                    <input class="inputForm" type=text id="qty" name="qty">
                    <label for="serialNo">Serial No.</label>
                    <input class="inputForm" type=text id="serialNo" name="serialNo">
                    <button type="submit" id="submit" value="Submit">
                        <input class="inputForm" type="text" id="user" name="user" value="employee">
                </form>
            </div>

        </div>
    </div>

</body>
<!-- <script src="../res/js/loginpage.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../res/js/asset_information.js"></script>
<script src="../res/js/navbar.js"></script>


</html>x