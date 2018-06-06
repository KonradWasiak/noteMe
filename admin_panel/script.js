console.log("Skrypt załadowano");

function showCallback(){
    
    setTimeout(function(){
            $(".btn-showAll").each(function(){
                this.addEventListener('click', function(){
                sendUsers();
            })
            });
            $(".btn-primary-groups").each(function(){
                this.addEventListener('click',function(){
                    var grupa = document.getElementById('grpName');
                    sendUsersInGroups(grupa);    
                })
            });
            $(".btn-showGroups").each(function(){
                this.addEventListener('click',function(){
                showGroups();    
                })
            });
            $("#modalChangePassword").on('show.bs.modal', function(e) {
                var login = $(e.relatedTarget).data('logints');
                $(e.currentTarget).find('input[name="login"]').val(login);
                var y = document.getElementById('loginInput');
                var x =document.getElementById('loginLabel');
                if (login !=null){
                y.type = "hidden";
                x.style.visibility = 'hidden';
                } else {
                y.type = "text";    
                x.style.visibility = 'visible';
                }
            });
        });
    $('#users').on('DOMNodeInserted DOMNodeRemoved',function(){
        $('.deleteUser').each(function(){
            $(this).on('click',function(){
                let przycisk = this;
                let user = this.dataset.user;
                let group = this.dataset.group;
                if (user !=null){
                    $.ajax({
                        type: 'POST',
                        url: './adminhandler.php',
                        data: {"delete":"true","loginToDoSt":user},
                            success: function (response) {
                                console.log(response);
                                animateAndDelete(przycisk.parentNode.parentNode);
                        }
                    })
                } else if (group !=null) {
                    $.ajax({
                        type: 'POST',
                        url: './adminhandler.php',
                        data: {"deleteGroup":"true","GroupName":group},
                            success: function (response) {
                                console.log(response);
                                animateAndDelete(przycisk.parentNode.parentNode);
                        }
                    })

                };
            });
        });

    });
    }


function animateAndDelete(przycisk){
    przycisk.innerHTML = "";
    let divInfo = `<div class="divinfo">Usunięto</div>`;
    przycisk.innerHTML= divInfo;
    setTimeout(function(){
        przycisk.remove();
    },1500);
}


function showGroups(){
    $.ajax ({
        type:'POST',
        url:'./adminhandler.php',
        data:{"showAllGroups":"1"},
        success: function (response){
            let json = JSON.parse(response);
            $('#users').html('');
            var lenght = json.length;
            var iterator=0;
            function animation(){
                if(iterator < lenght){
                    setTimeout(function () {  
                       showall(json[iterator]);
                        iterator++;
                        animation();
                    },240);
                }    
            }
            animation();
        }
    })
}


function sendUsersInGroups(grupa){
    $.ajax({
        type:'POST',
        url:'./adminhandler.php',
        data:{'showUsersIngroup':grupa.value},
        success: function(response){
            let json = JSON.parse(response);
            $('#users').html('');
            var lenght = json.length;
            var iterator=0;
            function animation(){
                if(iterator < lenght){
                    setTimeout(function () {  
                       show_all(json[iterator]);
                        iterator++;
                        animation();
                    },240);
                }    
            }
            animation();
        }
})
}

function sendUsers(){
    $.ajax ({
        type:'POST',
        url:'./adminhandler.php',
        data:{"showalluser":"1"},
        success: function (response){
            let json = JSON.parse(response);
            $('#users').html('');
            var lenght = json.length;
            var iterator=0;
            function animation(){
                if(iterator < lenght){
                    setTimeout(function () {  
                       show_all(json[iterator]);
                        iterator++;
                        animation();
                    },240);
                }    
            }
            animation();
        }
    })
}

function show_all(json){
    let outerDiv =`<div class="media" style="display:none">
                        <div class="media-left"> \ 
                            <a href="#"> \
                                <img alt="..." src="./../avatars/avatar.png" class="media-object" style="width:100px;height:100px;"> \ 
                            </a> \
                        </div>
                        <div class="user-info">
                            <h5 class="media-heading">${json.login}</h5>\
                            <p>E-mail: ${json.email}</p>\
                            <p>Miejscowość: ${json.town}</p>\
                        </div>
                        <div class="user-buttons">
                            <button type="button" class="btn btn-primary" id="form-button-changepw" data-toggle="modal" data-target="#modalChangePassword" data-loginTS=${json.login}> Zmień hasło </button>\
			                <button data-user="${json.login}" class="btn btn-primary deleteUser" value="Usuń uzytkownika">Usuń uzytkownika</button>\
                        </div>
                    </div>`
        $('#users').append(outerDiv);
        $('.media').slideDown(500).delay(300);
    }

function showall(json){
    let outerDiv =`<div class="media" style="display:none">
                        <div class="user-info"> \
                            <h4 class="media-heading">${json.GroupName}</h4>\
                            <p>Liczba użytkowników: ${json.UserCount} / ${json.Max_count}</p>\
                            <p>Administrator grupy: ${json.groupAdmin}</p>\
                        </div>\
                        <div class="user-buttons">
                            <button data-group="${json.GroupName}" class="btn btn-primary deleteUser" value="Usuń uzytkownika">Usuń grupe</button>\
                        </div>
                    </div>`
        $('#users').append(outerDiv);
        $('.media').slideDown(500).delay(300);
    }



    document.addEventListener('DOMContentLoaded', showCallback);
