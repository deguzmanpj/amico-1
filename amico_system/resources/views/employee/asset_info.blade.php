<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
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
                    <a href="{{ route ('employee/asset_info')}}"  id = "active_tab" class="item1">Asset Management</a>
                    <a href="{{ route ('employee/pending')}}" class="item1">Pending Requests</a> <!-- item -->
                    <a href="#" class="item">Forms</a>
                    <a href="#" class="item">Logout</a>
                </div>
            </div>
        </div>
    </div>



    <div class="header">
        <p class="pageTitle">Asset Information</p>
        <p>AMICO ASSET MANAGEMENT</p>

    </div>

    <div class="container">
        <div class="form">
            <form action="/upload" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="csvFile" accept=".csv">
                <button type="submit">Upload File</button>
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
                <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Leave Note</button>
            </div>
        </div>
    </div>


        <div class="wrapper">
            <section class="section section--large" id="part1">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                        </div>
                        <table class="table table-bordered" id="9table1">
                            <thead>
                                <tr>
                                    <th>Unit</th>
                                    <th>Tag Number</th>
                                    <th>Asset Description</th>
                                    <th>Asset Pic</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Serial No</th>
                                    <th>Asset Class</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($csvData))
                                <tr>
                                    <td>{{ $csvData[0][1] }}</td>
                                    <td>{{ $csvData[0][2] }}</td>
                                    <td>{{ $csvData[0][3] }}</td>
                                    <td>{{ $csvData[0][4] }}</td>
                                    <td>{{ $csvData[0][5] }}</td>
                                    <td>{{ $csvData[0][6] }}</td>
                                    <td>{{ $csvData[0][7] }}</td>
                                    <td>{{ $csvData[0][8] }}</td>
                                    <td>{{ $csvData[0][9] }}</td>
                                    </td>
                                </tr>
                                @endif

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
                        <table class="table table-bordered" id="7table2">
                            <thead>
                                <tr>
                                    <th>Cost</th>
                                    <th>Warranty</th>
                                    <th>Building Loc</th>
                                    <th>Asset Pic</th>
                                    <th>Floor</th>
                                    <th>Specific Area</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($csvData))
                                <tr>
                                    <td>{{ $csvData[0][1] }}</td>
                                    <td>{{ $csvData[0][2] }}</td>
                                    <td>{{ $csvData[0][3] }}</td>
                                    <td>{{ $csvData[0][4] }}</td>
                                    <td>{{ $csvData[0][5] }}</td>
                                    <td>{{ $csvData[0][6] }}</td>
                                    <td>{{ $csvData[0][7] }}</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section class="section section--small" id="part3">
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
                            <tbody>

                                @if (!empty($csvData))
                                <tr>
                                    <td>{{ $csvData[0][1] }}</td>
                                    <td>{{ $csvData[0][2] }}</td>
                                    <td>{{ $csvData[0][3] }}</td>
                                    <td>{{ $csvData[0][4] }}</td>
                                    <td>{{ $csvData[0][5] }}</td>
                                    <td>{{ $csvData[0][6] }}</td>
                                    <td>{{ $csvData[0][7] }}</td>
                                    <td>{{ $csvData[0][8] }}</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section class="section section--large four" id="part4">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                        </div>
                        <table class="table table-bordered" id="7table4">
                            <thead>
                                <tr>
                                    <th>RS Date</th>
                                    <th>From - location</th>
                                    <th>Doc No. - Donation/Grant</th>
                                    <th>Date</th>
                                    <th>From - Donator/Grantor</th>
                                    <th>Date Acquired</th>
                                    <th>Received By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($csvData))
                                <tr>
                                    <td>{{ $csvData[0][1] }}</td>
                                    <td>{{ $csvData[0][2] }}</td>
                                    <td>{{ $csvData[0][3] }}</td>
                                    <td>{{ $csvData[0][4] }}</td>
                                    <td>{{ $csvData[0][5] }}</td>
                                    <td>{{ $csvData[0][6] }}</td>
                                    <td>{{ $csvData[0][7] }}</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section class="section section--large five" id="part5">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                        </div>
                        <table class="table table-bordered" id="7table5">
                            <thead>
                                <tr>
                                    <th>PB No.</th>
                                    <th>PB Date</th>
                                    <th>ID No.</th>
                                    <th>Serial No.</th>
                                    <th>Asset Description</th>
                                    <th>Quantity</th>
                                    <th>Person Acountable</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($csvData))
                                <tr>
                                    <td>{{ $csvData[0][1] }}</td>
                                    <td>{{ $csvData[0][2] }}</td>
                                    <td>{{ $csvData[0][3] }}</td>
                                    <td>{{ $csvData[0][4] }}</td>
                                    <td>{{ $csvData[0][5] }}</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section class="section section--large six" id="part6">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                        </div>
                        <table class="table table-bordered" id="5table6">
                            <thead>
                                <tr>
                                    <th>MS No.</th>
                                    <th>MS Date</th>
                                    <th>Serial No</th>
                                    <th>Asset Description</th>
                                    <th>Monitoring Log</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($csvData))
                                <tr>
                                    <td>{{ $csvData[0][1] }}</td>
                                    <td>{{ $csvData[0][2] }}</td>
                                    <td>{{ $csvData[0][3] }}</td>
                                    <td>{{ $csvData[0][4] }}</td>
                                    <td>{{ $csvData[0][5] }}</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section class="section section--large seven" id="part7">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                        </div>
                        <table class="table table-bordered" id="5table7">
                            <thead>
                                <tr>
                                    <th>CR No.</th>
                                    <th>CR Date</th>
                                    <th>Serial No.</th>
                                    <th>Asset Description</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($csvData))
                                <tr>
                                    <td>{{ $csvData[0][1] }}</td>
                                    <td>{{ $csvData[0][2] }}</td>
                                    <td>{{ $csvData[0][3] }}</td>
                                    <td>{{ $csvData[0][4] }}</td>
                                    <td>{{ $csvData[0][5] }}</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

        <nav>
        <a href="{{ route ('employee/receiving_repo')}}" class="two">Receiving Report</a>
            <a href="{{ route ('employee/asset_info')}}" class="one"   id = "active_page" >Asset Information</a>
        <a href="{{ route ('employee/ack_repo')}}" class="three">Acknowledgement Report</a>
        <a href="{{ route ('employee/prop_borr')}}" class="four">Property Borrowing</a>
        <a href="{{ route ('employee/main_req')}}" class="five">Maintenance Request</a>
        <a href="{{ route ('employee/condemn_req')}}" class="six">Condemnation Request</a>
        </nav>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../res/js/asset_information.js"></script>
<script src="../res/js/navbar.js"></script>

</html>