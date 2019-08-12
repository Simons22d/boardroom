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
            <div class="link option" id="home">Home</div>
        </div>
        <div class="">
        <div class="link option " id="overview">Overview</div>
        </div>
	<p id="space"></p>
	<p class="header link sidebar_items"> Rooms & Status </p>
	<div class="sidebar_items items sidebar">
        <div class="room " id="one" >
            <div class="item links option"  ><span></span  id="one" >Boardroom One</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
         <div class="room" id="two" >
            <div class="item links option"><span></span>Boardroom Two</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            </div>
            </div>
        </div>
        <div class="room"  id="three" style="background-color:#bedbed;">
        <div class="item links option"><span></span>Boardroom Three</div>
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
                            <h5 id ="action">Book A Room</h5>
                            <div class="eventDetails">
                            </div>
                            <br>
                        <div class="row">
                        <div class="col-lg-10">
                        <label for="Title">Title<small  class="help_info form-text text-muted">Brief Explanation Of The Event</small></label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>

                </div><br>
                <div class="row">
                    <div class="col-lg-5">
                        <label for="datePickerStart">Start Date<small  class="help_info form-text text-muted" id="startText">When The Event Begins</small></label>
                        <input  type="text" class="form-control" id="startDate" name="datePackerOne">
                    </div>
                    <div class="col-lg-5" id="endDateDiv">
                        <label for="datePickerStart">End Date<small  class="help_info form-text text-muted" id="endText" >When The Event Ends</small></label>
                        <input  type="text" class="form-control" id="endDate" name="datePickerTwo">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="employees">Boardroom <small  class="help_info form-text text-muted">The Boardroom You would like to book.</small></label>
                    <select class="form-control col-lg-9" id="boardroom"  name="boardroom">
                        <option value="null" class='brm_modal' >Select Boardroom</option>
                        <option value="1" class='brm_modal'>Boardroom One</option>
                        <option value="3" class='brm_modal' >Boardroom Two</option>
                        <option value="4" class='brm_modal'>Boardroom Three</option>
                    </select>
                </div>
                <br>
                <br>
                <button class="btn btn-warning col-lg-2 " type="button" id="cancel">Cancel</button>
                <button class="btn btn-danger col-lg-3 " type="button" id="delete">Delete Event</button>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    // calender_start
    calender = new FullCalendar.Calendar(calendarEl, {
        validRange: function(nowDate) {
            return {
            start: nowDate
            };
        },
    plugins: [ 'dayGrid', 'timeGrid', 'list', 'bootstrap','interaction','resourceTimeline'],
    timeZone: 'UTC',
    themeSystem: 'bootstrap',
    selectable : true,
    height: 550,
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,listMonth,timeGridDay'
    },
    eventLimit: true, // allow "more" link when too many events 
    events :"http://localhost:4000/bookings/" ,
    select : ()=>{
        // show();
        // getDate(startDate)
    },
    eventClick: function(info) {
                // show(); //show the modal with the following values
                console.log("event click");
                // get the id 
                eventId = info.event.id;
                start = moment(info.event.start).format('YYYY-MM-DD HH:mm:ss');
                end = moment(info.event.end).format("YYYY-MM-DD HH:mm:ss");
                title = info.event.title;
                setContext("update");
                setEventId(eventId);
                $("#cancel").hide();
                $("#delete").show();
                // getting the baor roo m number
                $.ajax({
                    url : "http://localhost:4000/bookings/"+eventId,
                    method : "GET",
                    success : (data)=>{
                        console.log(data)
                        update(data.event,start,end,data.boardroomId);
                    }
                })
                
                // llopginto update the 
                show();
                getDate(new Date());
            },
    dateClick: function(info) {
        var startDate = new Date(info.date);
        show();
        setContext("new");
        console.log(getContext());
        getDate(startDate)
        $("#delete").hide();
        $("#cancel").show();
    },
    eventDrop: (info)=>{
        console.log(info)
    }
    });
    // calender end
    calender.render();
});
</script>

<?php
require_once("./partials/footer.php");
?>