let display_header = $("#section");
let display = $("#display");
let currentPath = $("#currentPath");


// calender 
function calender(path){
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
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
    events: path ,
    customButtons: {
            addEventButton: {
            text: 'add event...',
            click: function() {
                var dateStr = prompt('Enter a date in YYYY-MM-DD format');
                var date = new Date(dateStr + 'T00:00:00'); // will be in local time
    
                if (!isNaN(date.valueOf())) { // valid?
                calendar.addEvent({
                    title: 'dynamic event',
                    start: date,
                    allDay: true
                });
                alert('Great. Now, update your database...');
                } else {
                alert('Invalid date.');
                }
            }
            }
        },
    eventClick: function(info) {
                // alert('Event: ' + info.event.title);
                // alert('View: ' + info.view.type);
                // change the border color just for fun
                info.el.style.borderColor = 'red';
                // show();
            },
    dateClick: function(info) {
        var startDate = new Date(info.date);
        show();
        getDate(startDate);
    }
    });
    calendar.render();
    });
}
// requests
$("#overview").on("click",(e)=>{
    window.location.href = "index.php";
})
$("#one").on("click",(e)=>{
    display_header.html("Broadroom One");   
    source = "./one.json";
    calender(source);
});
$("#two").on("click",(e)=>{
    display_header.html("Broadroom Two");
    source = "./two.json";
    calender(source);
});
$("#three").on("click",(e)=>{
    display_header.html("Broadroom Three"); 
    source = "./three.json";
    calender(source);
});
$("#four").on("click",(e)=>{
    display_header.html("Broadroom Four");
    source = "./four.json";
    calender(source);
});


            
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
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

function getDate(thisDate){
    // working the date picket 
    let start = thisDate,
    today = new Date(),
    prevDay,
    startHours = 9;
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
        customButtons: {
            custom1: {
                    text: 'custom 1',
                    click: function() {
                    alert('clicked custom button 1!');
                    }
                }
        },
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

$("#add_event").on("click",(e)=>{
    show();
    getDate(new Date())
})

$("#book").on("click",()=>{
    let formData = $("#myModal").serialize().split("&");
    let title = unescape(formData[0].split("=")[1]);
    let start = unescape(formData[1].split("=")[1]);
    let end = unescape(formData[2].split("=")[1]);
    let room = unescape(formData[3].split("=")[1]);
    let roomMap = ["Boardroom One","Boardroom Two","Boardroom Three"]
    console.log(title, ":",start ,"–",end,"[",roomMap[room],"]")
})

$("#cancel").on("click",()=>{
    modal.style.display = "none";
})





