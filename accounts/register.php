<?php
class register{

    public function addUser($pdo,$mail,$login,$password,$password2)
    {           
           if($password===$password2)
           {

                              
                $salted = "salt{$password}salt";
                $hash = md5($salted);
                $primary = $login.substr($hash,0,5);

                $avatar = "../avatars/avatar.png";
                $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac semper ante. Nam semper erat nec dui accumsan, in rutrum urna congue. Duis cursus turpis vestibulum tortor posuere, eu varius neque rhoncus. In volutpat luctus tortor ac finibus. Etiam placerat nunc id ultricies dictum. Suspendisse dapibus dui augue, quis scelerisque eros lacinia eu. Sed sed turpis lectus. Maecenas et nisl molestie, ullamcorper mauris non, consectetur sem. Vivamus bibendum purus in erat faucibus, at pharetra purus euismod. Ut ut accumsan nibh.";
                $town = "Przykładowa miejscowość";
                $stmt = $pdo->prepare('INSERT INTO users(email,login,md5,loginmd5,description,town,isAdmin)
                                    VALUES(:email,:login,:md5,:loginmd5,:description,:town,0)');
                $stmt->bindParam(':email',$mail, PDO::PARAM_STR);
                $stmt->bindParam(':login',$login, PDO::PARAM_STR);
                $stmt->bindParam(':md5',$hash, PDO::PARAM_STR);
                $stmt->bindParam(':loginmd5',$primary, PDO::PARAM_STR);
                $stmt->bindParam(':description',$description, PDO::PARAM_STR);
                $stmt->bindParam(':town',$town, PDO::PARAM_STR);
                $stmt->execute();

                $imgData = file_get_contents($avatar);
    
                $stmtD = $pdo->prepare('DELETE FROM avatars WHERE loginmd5 = :loginmd5');
                $stmtD->bindParam(':loginmd5', $loginmd5);
                $stmtD->execute();
             
                $stmtC = $pdo->prepare('INSERT into avatars(login, data) values(:login, :imgdata)');
                $stmtC->bindParam(':login', $login);
                $stmtC->bindValue(':imgdata', $imgData);
                $stmtC->execute();


           }
           
    }

    public function login($pdo,$login,$password)
    {
            $stmt = $pdo->query('SELECT login,md5 FROM users');
            $salted = "salt{$password}salt";
            $md5 = md5($salted);
            $check = FALSE;
            foreach($stmt as $row)
            {
                if($login===$row['login'] AND $md5===$row['md5'])
                {
                    $check = TRUE;
                }
            }

            if($check == TRUE)
            {
                session_start();
                $query = $pdo->query('SELECT login,loginmd5,isAdmin FROM users');
                foreach($query as $row)
                {
                    if($row['login']===$login)
                    {
                        $_SESSION['userID']= $row['loginmd5'];
                        $_SESSION['isAdmin'] = $row['isAdmin'];
                    }
                }

                setcookie("loginResult", 'true', time()+100,'/',$_SERVER['HTTP_HOST']);
                header('Location:../user_panel/userpanel.php');
            }
            else
            {
                setcookie("loginResult", 'false', time()+100,'/',$_SERVER['HTTP_HOST']);
                //header('Location:../index.php');
            }
            
           

    }

}
?>
