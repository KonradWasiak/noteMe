$(document).ready(function () {
    let input = $('#groupName');
    let box = $('#userlist');
    let outerbox = $('#userlistbox');
    outerbox.hide();
    $(document).on('focus', ':input', function () {
        input.attr("autocomplete", "off");
    });

    input.keyup(function () {
        let word = input.val();
        let List;
        if (word != "") outerbox.show();
        else outerbox.hide();

        $.ajax({
            type: 'POST',
            url: './controllers/getUsersByLetter/handlerSocietySub.php',
            data: {
                "name2": name
            },
            success: function (response) {
            List = JSON.parse(response);   

            $.ajax({
                type: 'POST',
                url: './controllers/getUsersByLetter/handler.php',
                data: {
                    "word": word
                },
                success: function (response) {
                    let json = JSON.parse(response);
                    box.html("");
                    
                    for (x = 0; x < json.length; x++) {
                        let login = json[x].login;
                        let isExist = false;

                        if(List.length){
                            for(let z = 0; z<List.length ;z++){
                                if(List[z].user1Login == login){
                                    isExist = true;
                                    
                                } 
                            }

                        }
                        
                        if(isExist == false){
                            let button = `<button type="button" class="btn-success" data-login="${login}"  style="float:right; padding: 5px 5%;">Dodaj do znajomych</button>`;
                            box.append(`<div class="innerBox" data-login="${login}" ><span style="width: 10% !important" >${login}</span>${button}</div>`);
                            LetterGetAvatar(login);
                        }
    
                    }
                    $(`.btn-success`).each(function () {
                        $(this).click(function () {
                            let logg = this.dataset.login;
    
                            SocietySendInvitation(logg);
                        })
                    })

    
    
                }
    
            });



            }
        });

        
    });



});

function LetterGetAvatar(name) {
    $.ajax({
        type: 'POST',
        url: './controllers/getUsersByLetter/handlerAvatar.php',
        data: {
            "login": name
        },
        success: function (response) {
            $(`.innerBox[data-login="${name}"]`).prepend(response);



        }
    });
}

function SocietySendInvitation(name) {
    $.ajax({
        type: 'POST',
        url: './controllers/getUsersByLetter/handlerSociety.php',
        data: {
            "name2": name
        },
        success: function (response) {
            let table = document.getElementById('showSentInvitations');
            table.innerHTML = response;



        }
    });
}

