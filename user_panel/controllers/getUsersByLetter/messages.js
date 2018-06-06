$(document).ready(function(){
    let input = $('#groupName');
    let box = $('#userlist');
    let outerbox = $('#userlistbox');
    outerbox.hide();
    $( document ).on( 'focus', ':input', function(){
        input.attr("autocomplete", "off");
    });
    
    input.keyup(function(){
        let word = input.val();
        if(word != "") outerbox.show();
        $.ajax({
            type: 'POST',
            url: './controllers/getUsersByLetter/handler.php',
            data: {"word":word},
            success: function (response) {
                let json =JSON.parse(response);
                console.log(json);
                box.html("");
                for(x=0;x<json.length;x++){  
                    let login = json[x].login;                 
                    box.append(`<div class="innerBox" data-login="${login}" ><span>${login}</span></div>`);
                    LetterGetAvatar(login);
                    $(`.innerBox`).each(function(){
                        $(this).click(function(){
                            let logg = this.dataset.login;
                            console.log(logg);
                            input.val(logg);
                            outerbox.hide();
                        })
                    })
                }
                
            }
            
        });
    });



});

function LetterGetAvatar(name){
    $.ajax({
        type: 'POST',
        url: './controllers/getUsersByLetter/handlerAvatar.php',
        data: {"login":name},
        success: function (response) {
           $(`.innerBox[data-login="${name}"]`).prepend(response);
           
            
            
        }
    });
}