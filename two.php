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
    <style>
        #location{
            color : #09f;
        }
        .wrapper_div{
            background: #fcfcfc;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 2000;
        }
        .loader,
        .loader:after {
            border-radius: 50%;
            width: 10em;
            height: 10em;
        }
        .loader {
            margin: 60px auto;
            font-size: 10px;
            position: relative;
            text-indent: -9999em;
            border-top: 1.1em solid rgba(0,116,255, 0.2);
            border-right: 1.1em solid rgba(0,116,255, 0.2);
            border-bottom: 1.1em solid rgba(0,116,255, 0.2);
            border-left: 1.1em solid #0074ff;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load8 1.1s infinite linear;
            animation: load8 1.1s infinite linear;
        }
        @-webkit-keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        .space{
            padding-top:200px;
        }
        #spinner{
            margin-top :10px;
        }
        #beta{
            font-size:10px;
            background-color: #09f;
            color : #fff;
            padding : 2px 5px;
            border-radius :5px;
        }
        #username{
            font-size : 12px;
            margin-bottom : 15px;
            color : #fff;
            font-weight : 900;
            background-color: #fe5363;
            padding : 4px 10px 5px 15px;
            width : 75%;
            border-radius : 15px;
            letter-spacing: .5px;
        }
        .progress{
            height : 4px;
            width: 150px;
        }
        .room{
            padding-left:20px;
            padding-top:8px;
            padding-bottom: 12px;
            border-radius:5px
        }
        .room:hover{
            background-color:#ceceff;
        }
        .link{
            padding-left:20px;
            padding-top:1px;    
            padding-bottom : 1px;
            font-size: 16px;
        }
        .links{
            color : #999;
        }
    </style>
    <style>
        /* The Modal (background) */
    .modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 2; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    overflow: auto; /*Enable scroll if needed*/
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.2); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
    background-color: #fefefe;
    margin: 2% auto; /* 15% from the top and centered */

    padding: 20px;
    padding-left:120px;
    border: 1px solid #888;
    width: 60%; /* Could be more or less, depending on screen size */
    padding-bottom:40px
    }

    /* The Close Button */
    .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    }

    .close:hover,
    .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
    }
    .pop{
        padding-left :100px;
    }
    #calendar{
        margin-right:80px;
    }
    #add_event{
        padding-left:20px;
    }
    #event_btn{
        border-radius: 20px;
        font-size: 14px;
        border:2px solid #5CB85C;
        padding: 8px 30px 8px 30px;
    }
    .links{
        padding-bottom:3px;
    }
    </style>
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
        <div class=" link option clicked" id="overview">Overview</div>
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
			<h5 id="section">Boardroom Two</h5>
                <br>
                <form id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close" style="text-align:right">&times;</span>                  
                        <div id="pop" class="col-lg-12">
                            <h5>Book A Room</h5>
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
                        <option value="null" selected>Select Boardroom</option>
                        <option value="1" >Boardroom One</option>
                        <option value="2" >Boardroom Two</option>
                        <option value="3" >Boardroom Three</option>
                    </select>
                </div>
                
                <br>
                <!-- <div class="form-group occurence">
                    <label for="">Repeats</label><br>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-outline-info active">
                            <input type="radio" name="options" id="daily" autocomplete="off" value="1"> Daily
                        </label>
                        <label class="btn btn-outline-info">
                            <input type="radio" name="options" id="weekly" autocomplete="off" value="2" checked> Weekly
                        </label>
                        <label class="btn btn-outline-info">
                            <input type="radio" name="options" id="monthly" autocomplete="off" value="3"> Monthly
                        </label>
                    </div>
                </div> -->

                <br>
                <button class="btn btn-warning   col-lg-2 " type="button" id="cancel">Cancel</button>
                <button class=" btn btn-primary  col-lg-6" type="button" id="book">Book The Room</button>
</form>
                </div>
                </div>
                
				<div id="display" >
                    <div class=''id='calendar'></div>
				</div>
		</div>
    </div>
	</div>
</div>

<?php
require_once("./partials/footer.php");
?>