<?php
error_reporting(0);
//require the header
require_once("./partials/header.php");
?>
<head>
</head>
    <script> 
        // $("#spinner").show();
        $("#data").hide();
        $("#buttons").hide();
    </script>
<body>

<div id="container">
<link href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.css" rel="stylesheet" type="text/css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.js"></script>
<!-- Include English language -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.js"></script>
    <div id="sidebar" style="">
        <div id="sidebar-content" style="height:600px;font-weight: 600;">
		<img src="./logo.jpg" id="logo" alt="">
		<link rel="stylesheet" href="./style/sidebar.css">
    <!-- drop down -->
        <div id="add_event">
            <br>
            <button class=" btn btn-outline-success" id='event_btn'>Book Boardroom</button>  
        </div><br>
        <div class="">
            <div class=" link option" id="home">Home</div>
        </div>
        <div class="">
        <div class="link option" style="color:#007bff" id="overview">Overview</div>
        </div>
	<p id="space"></p>
	<p class="header link sidebar_items"> Rooms & Status </p>
	<div class="sidebar_items items sidebar">
        <div class="room">
            <div class="item links option"  id="one"><span></span  id="one" >Boardroom One</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
         <div class="room">
            <div class="item links option" id="two" ><span></span>Boardroom Two</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            </div>
            </div>
        </div>
        <div class="room">
        <div class="item links option" id="three" ><span></span>Boardroom Three</div>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        </div>
    </div>
</div>
    </div><!--
 --><div id="content">
	<div id="main-content" style="height: 400px">
		<!-- the container to the display page -->
		<div class="container">
			<div id="space"></div><br>
			<div class="row col-lg-12">
                <div class="col-lg-6" style="margin-left:-15px"><h5 id="theDisplay">Boardroom Booking System</h5></div>
                <!-- <div class="col-lg-5" style=""><input class="form-control "  type="search" id="search"  placeholder="Search" aria-label="Search"></div>
                <div class="col-lg-1" id="spinner"><span class="spinner spinner-bounce-middle"></span></div> -->
            </div>
			<h5 id="section">Boardroom One</h5>
                <br>
                <form id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close" style="text-align:right">&times;</span>                  
                        <div id="pop" class="col-lg-12">
                            <h5  id="action">Book A Room</h5>
                            <br>
                        <div class="row">
                        <div class="col-lg-10">
                        <label for="Title">Title<small  class="help_info form-text text-muted">Brief Explanation Of The Event</small></label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>

                </div><br>
                <div class="row">
                    <div class="col-lg-5">
                        <label for="datePickerStart">Start Date<small  class="help_info form-text text-muted">When The Event Begins</small></label>
                        <input readonly type="text" class="form-control" id="startDate" name="datePackerOne">
                    </div>
                    <div class="col-lg-5" id="endDateDiv">
                        <label for="datePickerStart">End Date<small  class="help_info form-text text-muted">When The Event Ends</small></label>
                        <input readonly type="text" class="form-control" id="endDate" name="datePickerTwo">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="employees">Boardroom <small  class="help_info form-text text-muted">The Boardroom You would like to book.</small></label>
                    <select class="form-control col-lg-9" id="boardroom"  name="boardroom">
                        <option value="null">Select Boardroom</option>
                        <option value="1" id="one" class="room" >Boardroom One</option>
                        <option value="2" id="two" class="room" >Boardroom Two</option>
                        <option value="3" id="three" class="room" >Boardroom Three</option>
                    </select>
                </div>
                
                <br>

                <br>
                <button class="btn btn-warning   col-lg-2 " type="button" id="cancel">Cancel</button>
                <button class=" btn btn-primary  col-lg-6" type="button" id="book">Book The Room</button>
</form>
                </div>
                </div>
                
				<div id="display" >
                    <!-- jumbtron -->
                <!-- <div class="jumbotron">
                        <h1 class="display-4">Boordroom Summary</h1>
                        <p class="lead">Summary of the current status of each boardroom.</p>
                </div> -->
                <style>
                
                </style>
                <!-- end jumbotron -->
                <div class=" container row">
                    <div class="boardroom_card">
                        <h5 class="header">Boardroom One <span class="extra">•</span><br><span class="status small text-muted">In Progress </span></h5>
                        <p class="event"> Sample Info from the event Description. Should Not be too long. </p>
                        <p class="time">11:30AM — 12:30PM </p>
                        <p class="info"><i class="far fa-clock"></i> &nbsp; Ends In 1 Hour 20 Minutes. </p>
                    </div>
                    <!-- card 2 -->
                    <div class="boardroom_card">
                        <h5 class="header">Boardroom Two <span class="extra">•</span><br><span class="status small text-muted">In Progress </span></h5>
                        <p class="event"> Sample Info from the event Description. Should Not be too long. </p>
                        <p class="time">11:30AM — 12:30PM </p>
                        <p class="info"><i class="far fa-clock"></i> &nbsp; Ends In 1 Hour 20 Minutes. </p>
                    </div>
                    <!-- <div class="boardroom_card"></div> -->
                </div>

                <div class="container row mt-5">
                    <div class="boardroom_card empty">
                        <h5 class="header open">Boardroom Three <span class="extra open">•</span><br><span class="status small text-muted">Not Occupied</span></h5>
                        <p class="event"></p>
                        <!-- <p class="time">11:30AM — 12:30PM </p> -->
                        <p class="info"><i class="far fa-clock"></i> &nbsp; Available Till 3PM. </p>
                        <span class="btn btn-secondary btn-sm" id="btn_book">Book This Space</span>
                    </div>
                </div>
		</div>
    </div>
	</div>
</div>
<?php
require_once("./partials/footer.php");
?>