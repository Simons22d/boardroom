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
    cleanFields()
}
function cleanFields(){
    $("#startDate").val("");
    $("#endDate").val("");
    $("#title").val("");
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
// button click event [capture]
$("#add_event").on("click",(e)=>{
    $("#delete").hide();
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
                    data:{ boardroom_id : room, title:title, start:finalStart, end:finalEnd},
                    success:function(){
                        calender.refetchEvents();
                        $("#cancel").trigger("click");
                        $("#successFlash").show();
                        setTimeout(()=>{
                            $("#successFlash").hide();
                            $("#deleteFlash").hide();
                        },3000);
                    }
                })
            }else if( context === "update"){
                console.log("update");
                let id = getEventId();
                $.ajax({
                    url:"http://localhost:4000/bookings",
                    type:"PUT",
                    data:{ booking_id : id, boardroom_id : room, title:title, start:finalStart, end:finalEnd},
                    success:function(){
                        calender.refetchEvents();
                        $("#cancel").trigger("click");
                        $("#successFlash").show();
                        setTimeout(()=>{
                            $("#successFlash").hide();
                            $("#deleteFlash").hide();
                        },3000);
                    }
                })
            }
        }
    }
})
// cancel button modal
$("#cancel").on("click",()=>{
    modal.style.display = "none";
    cleanFields();
})

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
                $("#deleteFlash").show();
                setTimeout(()=>{    
                    $("#successFlash").hide();
                    $("#deleteFlash").hide();
                },3000);
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


$("#btn_book").on("click",()=>{
    // locate to the boardroom 3 
    // trigger modal to add event 
    show();
    // setContext("new");
    // we shal time to funciton which we shall the work with later
    //  we are also going to restict the time to th one only the one available
    // as a range but not exceeiding the slot
    // this will be the dat the date that has been passed from the back end
    var startDate = new Date();
    getDate(startDate)
    $("#delete").hide();
    // $("#cancel").show();
    // $(".room").attr("selected",false);
    // $("#three").prop("selected",true)
    update("Event Name","08/21/2019 09:34 am","08/21/2019 11:34 am",3) 
    // later we should add the time limits to resrict to some give times
    // we would bee a funciton that takes the rescriicted times   
})

/**
 * 
 * @param {string} widgeName 
 * @returns {JSON}
 * 
 */

function refreshWidget(widgetName){
    let msg = $(`${widgetName}_message`);
    let status = $(`${widgetName}_status`);
    let duration = $(`${widgetName}_duration`);
    let time = $(`${widgetName}_time`)
    setTimeout(()=>{
        $.ajax({
            url : "",
            method : "",
            data : "",
            success : (data)=>{
                // update data
            },
            error : (error)=>{
                //  revert back to old data
            }
        })
    },1000);
}
