function calendarAddCallback() {


    setTimeout(function () {
        calendarGetUserDates();

        $(".pignose-calendar-unit-date").each(function () {

            let date = this.dataset.date;
            this.addEventListener('click', function () {
                calendarSendData(date);
            });
        });
        let arrows = $('.pignose-calendar-top-icon');
        $(arrows).each(function () {
            $(this).click(function () {
                calendarAddCallback();      
                calendarGetUserDates();  
            });
        $('.pignose-calendar-body').on('DOMSubtreeModified',function(){
            calendarAddCallback();      
            calendarGetUserDates();  
        });
        });


    }, 300);
}

function calendarSendData(date) {
    const session = document.getElementById("sessionNumber").dataset.name;
    $.ajax({
        type: 'POST',
        url: 'controllers/calendar/getArticles.php',
        data: {"date":date},
        success: function (response) {
            let json =JSON.parse(response);
            $('#calendarTable').html('')
            let length = json.length;
            let iterator=0;
            function animation(){
                if(iterator < length){
                    setTimeout(function () {  
                        calendarShowTable(json[iterator]);
                        iterator++;
                        animation();
                    },240);
                }   
                
            }
            animation();
        }
    });
}

function calendarGetUserDates(){
    const session = document.getElementById("sessionNumber").dataset.name;
    $.ajax({
        type: 'POST',
        url: 'controllers/calendar/getDates.php',
        data: {"method":"getDates"},
        success: function (response) {
            let json =JSON.parse(response);
            console.log(json);
            for(x=0;x<json.length;x++){
                let targetData = json[x].dateend;
                if(json[x].status1 == 0 ) $(`.pignose-calendar-unit-date[data-date='${targetData}'] a`).css({background: "#ff99a4"});
                else if (json[x].status1 == 1)  $(`.pignose-calendar-unit-date[data-date='${targetData}'] a`).css({background: "#38fabc"});
            }
            
        }
        
    });
}

function calendarShowTable(json){

    let content = json.content + "...";
    let outerDiv = `<div class="media" style="display: none"> \
    <div class="media-left"> \ 
        <a href="#"> \
            <img alt="..." src="images/avatar/time.png" class="media-object" style="margin-top: 15px;"> \ 
        </a> \
    </div> \
    <div class="media-body"> \
        <h4 class="media-heading" style="margin-top: 15px;">${json.topic}</h4>\
        <p>${content}</p>\
        <p class="comment-date">Data zakończenia: ${json.dateend}</p> \
    </div> \
    </div>`
    $('#calendarTable').append(outerDiv);
    $('.media').slideDown(500).delay(300);
}


document.addEventListener('DOMContentLoaded', calendarAddCallback);