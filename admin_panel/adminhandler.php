<?php

    $editosoba = 'editosoba.php';
    require $editosoba;
    require './../accounts/config.php';
    try
    {
        $pdo = new PDO("mysql:host=$server;dbname=$database", $usr, $passwd);
    }
    catch(Exception $e)
    {
        echo 'Błąd połączenia z bazą danych';
    }
    $edit = new editosoba();



//Usuwanie
if(isset($_POST["delete"])){
    $login = $_POST['loginToDoSt'];
    if($login == ''){
        echo "Uzupełnij login do usunięcia"; 
    }
    $edit->delete_user($pdo,$login);
    echo "usunieto: ".$login;
}
if(isset(($_POST["addtask"]))){
    $exec = True;
    if($_POST['login'] =='') $exec = False;
    if($_POST['topic'] =='') $exec = False;
    if($_POST['content'] =='') $exec = False;
    if($_POST['expiry_date'] =='') $exec = false;
    if ($exec){
        $login = $_POST['login'];
        $topic = $_POST['topic'];
        $task = $_POST['content'];
        $expiry_date = $_POST['expiry_date'];      
        $edit->add_task($pdo,$login,$task,$expiry_date,'Administrator',$topic);
    } else {
        echo "Błąd formularza - Spróbuj ponownie";
    }
    
}
if(isset(($_POST["changepw"]))){
    $login = $_POST['login'];
    $pw1 = $_POST['password1'];
    $pw2 = $_POST['password2'];
    if ($login !=''){
            $edit->change_pass($pdo,$login,$pw1,$pw2);
    } else {
        echo "<script type='text/javascript'>
        alert('Uzupełnij login do usunięcia');
        location='index_admin.php';
        </script>"; 
    }
}
if(isset($_POST["getAdmin"])){
    $login = $_POST['login'];
    if ($login !='') {
        $edit->change_to_admin($pdo,$login);
    } else {
        echo "<script type='text/javascript'>
        alert('Uzupełnij login do usunięcia');
        location='index_admin.php';
        </script>"; 
    }
}
if(isset($_POST["showalluser"])){

    $edit->show_all($pdo);
}
if(isset($_POST["showUsersIngroup"])){
    $groupName = $_POST['showUsersIngroup'];
    $edit->show_in_Groups($pdo,$groupName);
}
if(isset($_POST["showAllGroups"])){
    $edit->show_Groups($pdo);
}
if(isset($_POST["deleteGroup"])){
    $groupName = $_POST['GroupName'];
    $edit->deleteGroup($pdo,$groupName);
}
if(isset($_POST["changeGrpPw"])){
    $groupName = $_POST['GroupName'];
    $pw1 = $_POST['password1'];
    $pw2 = $_POST['password2'];
    if ($groupName !=''){
        $edit->changePwGroup($pdo,$groupName,$pw1,$pw2);
    } else {
        echo "<script type='text/javascript'>
        alert('Uzupełnij nazwe grupy do zmiany hasła');
        
        </script>"; 
    }
}
if(isset($_POST["logout"])){
    $edit->logout();
}


?>