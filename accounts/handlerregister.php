<?php
    $register = 'register.php';
    if(file_exists($register)){
        require $register;
        $config = 'config.php';
        if(file_exists($config))
        {
            require $config;
            
            try
            {
                $pdo = new PDO("mysql:host=$server;dbname=$database", $usr, $passwd);
            }
            catch(Exception $e)
            {
                die('Błąd krytyczny');
            }
        }
        else
        {
            die('Błąd krytyczny :(');
        }
        $reg = new register();
    }
    else
    {
        die('Błąd krytyczny :(');
    }

    //----------------Weryfikacja rejestracji----------------
    if(!empty($_POST['login']))
    {
        $stmtExists = $pdo->prepare('SELECT login FROM users ');
        $stmtExists->execute();
        $userFound = false;
            while($rows = $stmtExists->fetch())
            { 
                if($_POST['login'] == $rows['login'])
                {
                    echo 'Login jest już zajęty!';
                }
            }
        $pattern = '/(\s)\w/';

        if(preg_match($pattern, $_POST['login']))
                {
                    echo'Login nie może zawierać spacji!';
                    return;
                }
        $login = $_POST['login']; 
        if(!empty($_POST['mail']))
        {
            $mail = $_POST['mail'];
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                echo "podano zły email!"; 
            }
            else{

                
                if(!empty($_POST['pass1']) && !empty($_POST['pass2']) )
                {
                    $pass1 = $_POST['pass1'];
                    $pass2 = $_POST['pass2'];
                    if($pass1 == $pass2){
                        $reg->addUser($pdo,$mail,$login,$pass1,$pass2);
                        echo"Rejestracja przbiegła pomyślnie!";
                    }
                    else{
                        echo ("Podane Hasła są różne!");
                    }
                }
                else{
                    echo"Nie podano Hasła";
                }     
            }
        }
        else{
            echo "Nie wpisano adresu Email.";
        }
    }
    else{
        echo ("Nie wpisano loginu.");
    }
    
    //-------------------------------------------------------

?>