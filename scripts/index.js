let display_header = $("#section");
let display = $("#display");
let currentPath = $("#currentPath");
var calender;
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
function show(context) {
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

function getContext(){
    return sessionStorage.getItem("context");
}
function setContext(context){
    sessionStorage.setItem("context",context);
}
function setEventId(id){
    sessionStorage.setItem("eventId",id);
}
function getEventId(){
    return sessionStorage.getItem("eventId");
}

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
        if(getContext()){
            let context = getContext();
            console.log(context);
            if(context === "new"){
                console.log("new");
                $.ajax({
                    url:"http://localhost:4000/bookings",
                    type:"POST",
                    data:{ boardroom_id : room, event:title, start:finalStart, end:finalEnd},
                    success:function(){
                        calender.refetchEvents();
                        $("#cancel").trigger("click");
                        console.log("Added Successfully");
                    }
                })
            }else if( context === "update"){
                console.log("update");
                let id = getEventId();
                $.ajax({
                    url:"http://localhost:4000/bookings",
                    type:"PUT",
                    data:{ booking_id : id, boardroom_id : room, event:title, start:finalStart, end:finalEnd},
                    success:function(){
                        calender.refetchEvents();
                        $("#cancel").trigger("click");
                        console.log("Added Successfully");
                    }
                })
            }
        }
    }
})
// cancel button modal
$("#cancel").on("click",()=>{
    modal.style.display = "none";
})

function makeCalender(name){
    console.log(name);
}

// function to update modal
function update(title='',start='',end='',room){
    $("#title").val(title);
    $("#startText").html("Booked  : "+start);
    $("#endText").html("Booked  : "+end);
    $(".brm_modal").removeAttr("selected");
    $("#boardroom option").each(function(i){
        if(Number($(this).val()) === Number(room)){
            $(this).attr("selected",true);
        }
    });
}
$("#delete").on("click",()=>{
    if(getEventId()){
        $.ajax({
        url : "http://localhost:4000/bookings/"+getEventId(),
        method : "DELETE",
        success : (data)=>{
            if(data){
                calender.refetchEvents();
                $("#cancel").trigger("click");
            }else{
                $("#cancel").trigger("click");                
            }
        }
    });
    }else{
        $("#cancel").trigger("click");
    }
})

