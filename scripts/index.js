let display_header = $("#section");
let display = $("#display");
let currentPath = $("#currentPath");
var calender;
// adding the calender 
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
    events :"load.php" ,
    select : ()=>{
        // show();
        // getDate(startDate)
    },
    eventClick: function(info) {
                // alert('Event: ' + info.event.title);
                // alert('View: ' + info.view.type);
                // change the border color just for fun
                // info.el.style.borderColor = 'red';
                // show();
            },
    dateClick: function(info) {
        var startDate = new Date(info.date);
        show();
        getDate(startDate)
    }
    });
    // calender end
    calender.render();
});
// end calender
// requests
$("#overview").on("click",(e)=>{
    window.location.href = "index.php";
});

$("#one").on("click",(e)=>{
    window.location.href = "one.php"
});

$("#two").on("click",(e)=>{
    window.location.href = "two.php"
});

$("#three").on("click",(e)=>{
    window.location.href = "three.php"
});


// modal
var modal = document.getElementById("myModal");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// // When the user clicks on the button, open the modal
function show() {
    modal.style.display = "block";
}
// // When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}
// end modal
function getDate(thisDate){
    // working the date picket 
    let start = thisDate,
    today = new Date(),
    prevDay,
    startHours = 8;
    // 09:00 AM
    start.setHours(9);
    start.setMinutes(0);
    // If today is Saturday or Sunday set 10:00 AM
    if ([6, 0].indexOf(start.getDay()) !== -1) {
        start.setHours(10);
        startHours = 10
    }
    // var minHours =;
    // var minDate = ; 
    $('#startDate').datepicker({
        timepicker: true,
        language: 'en',
        startDate: start,
        minHours: startHours,
        minDate : today,
        maxHours: 18,
        onSelect: function (fd, d, picker) {
            // Do nothing if selection was cleared
            if (!d) return;
            var day = d.getDay();
            // Trigger only if date is changed
            if (prevDay !== undefined && prevDay === day) return;
            prevDay = day;
            // If chosen day is Saturday or Sunday when set
            // hour value for weekends, else restore defaults
            if (day === 6 || day === 0) {
                picker.update({
                    minHours: 10,
                    maxHours: 16
                })
            } else {
                picker.update({
                    minHours: 9,
                    maxHours: 18
                })
            }
        }
    });

    $('#endDate').datepicker({
        timepicker: true,
        language: 'en',
        startDate: start,
        minHours: startHours,
        minDate : today,
        maxHours: 18,
        onSelect: function (fd, d, picker) {
            // Do nothing if selection was cleared
            if (!d) return;
            var day = d.getDay();
            // Trigger only if date is changed
            if (prevDay != undefined && prevDay == day) return;
            prevDay = day;

            // If chosen day is Saturday or Sunday when set
            // hour value for weekends, else restore defaults
            if (day == 6 || day == 0) {
                picker.update({
                    minHours: 10,
                    maxHours: 16
                })
            } else {
                picker.update({
                    minHours: 9,
                    maxHours: 18
                })
            }
            }
    })
}
// button clcik event [capture]
$("#add_event").on("click",(e)=>{
    show();
    getDate(new Date())
})

// modal book button
$("#book").on("click",()=>{
    let formData = $("#myModal").serialize().split("&");
    let title = unescape(formData[0].split("=")[1]);
    let start = unescape(formData[1].split("=")[1]);
    let end = unescape(formData[2].split("=")[1]);
    let room = unescape(formData[3].split("=")[1]);
    // let roomMap = ["","Boardroom One","Boardroom Two","Boardroom Three"]
    if(title && start && end && room ){
        var parsed_start = new Date(start);
        var parsed_end = new Date(end);
        let finalStart = moment(parsed_start).format('YYYY-MM-DD HH:mm:ss');
        let finalEnd = moment(parsed_end).format('YYYY-MM-DD HH:mm:ss');
        $.ajax({
        url:"./insert.php",
        type:"POST",
        data:{title:title, start:finalStart, end:finalEnd},
        success:function(){
            calender.refetchEvents();
            $("#cancel").trigger("click");
            console.log("Added Successfully");
        }
        })
    }
})
// cancel button modal
$("#cancel").on("click",()=>{
    modal.style.display = "none";
})

function makeCalender(name){
    console.log(name);
}

// function reload

