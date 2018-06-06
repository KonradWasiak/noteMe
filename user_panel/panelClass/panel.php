<?php

class panel
{
    //Pobieranie poszczgólnych danych usera (edycja profilu)
    public function getUserData($pdo,$userID,$data)
    {
        $stmt = $pdo->prepare('SELECT email,login,md5,loginmd5,description,town,isAdmin FROM users WHERE loginmd5= :userID;');
        $stmt->bindParam(':userID',$userID,PDO::PARAM_STR);
        $stmt->execute();
        while($row = $stmt->fetch())
        {
            echo $row[$data];
        }   
    }

    public function getOtherUserData($pdo,$username,$data)
    {
        $stmt = $pdo->prepare('SELECT email,login,description,town FROM users WHERE login= :username;');
        $stmt->bindParam(':username',$username,PDO::PARAM_STR);
        $stmt->execute();
        while($row = $stmt->fetch())
        {
            echo $row[$data];
        }   
    }


    public function getUserAvatar($pdo,$userID)
    {   
        $stmt = $pdo->prepare('SELECT data FROM avatars WHERE login = :login;');
        $stmt->bindParam(':login',$userID,PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        $a=$row['data'];
        echo '<img src="data:image/jpeg;base64,'.base64_encode($a) .'" />';
    }

    public function getUserArticles($pdo,$userID,$date)
    {   
        $stmt1 = $pdo->prepare('SELECT login FROM users WHERE loginmd5= :userID;');
        $stmt1->bindParam(':userID',$userID,PDO::PARAM_STR);
        $stmt1->execute();
        $loged = $stmt1->fetchColumn();
        $stmt = $pdo->prepare('SELECT topic,content,DateAdded,dateend FROM tasks WHERE author = :loged AND dateend >= :today UNION SELECT topic,content,DateAdded,dateend FROM grouptasks INNER JOIN connectgroup ON grouptasks.groupname = connectgroup.GroupName AND grouptasks.dateend >= :today AND connectgroup.login = :loged;');
        $stmt->bindParam(':loged',$loged,PDO::PARAM_STR);
        $stmt->bindParam(':today',$date,PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);  
        echo($json);
    }


    public function getUserDates($pdo,$userID)
    {
        $stmt1 = $pdo->prepare('SELECT login FROM users WHERE loginmd5= :userID;');
        $stmt1->bindParam(':userID',$userID,PDO::PARAM_STR);
        $stmt1->execute();
        $loged = $stmt1->fetchColumn();
        $stmt = $pdo->prepare('SELECT dateend,status1 FROM tasks WHERE author = :loged  UNION SELECT dateend,status1 FROM grouptasks INNER JOIN connectgroup ON grouptasks.groupname = connectgroup.GroupName AND connectgroup.login = :loged;');
        $stmt->bindParam(':loged',$loged,PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);  
        echo($json);
    }

    //Wyswietlenie listy notatek użytkownika

    public function showUserPrivateNotes($pdo, $userID)
    {
        $stmt = $pdo->prepare('SELECT Title,DateAdded,Content FROM privatenotes WHERE loginmd5= :userID');
        $stmt->bindParam(':userID',$userID,PDO::PARAM_STR);
        $stmt->execute();
        $counter = 1;
        while($rows = $stmt->fetch())
        {
            echo '<tr>';
            echo '<td>'. $counter .'</td>';

            echo "<td><a href=\"javascript:;\" data-toggle=\"modal\" data-target=\"#show".$rows["Title"]. "\">
                  {$rows["Title"]}</td></a>";
            echo " <td>{$rows["DateAdded"]}</td>";
            echo "<td> <center>
            <a href=\"javascript:;\" data-toggle=\"modal\" data-target=\"#edit" .$rows['Title'] ."\">
                <button type=\"button\" class=\"btn btn-warning btn-xs m-b-10 m-l-5\">
                    Edytuj</button>
            </a>
            <a href=\"javascript:;\" data-toggle=\"modal\" data-target=\"#a".$rows['Title']."\">
            <button type=\"button\" class=\"btn btn-danger btn-xs m-b-10 m-l-5\">
                Usuń</button>
        </a> 
        </center></td>";
        echo '<div class="modal" id="a'.$rows['Title'].'" tabindex="-1" role="dialog" aria-labelledby="deleteTaskConfirmModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Uwaga!</h3>
            </div>
            <div class="modal-body">
                <h5>Na pewno chcesz usunąć zadanie: <strong>'.$rows['Title'].'</strong></h5>
            </div>
            <div class="modal-footer">
            <form method="POST">
                <input name="delNote" type="hidden" value="'.$rows['Title'].'">
                <input type="submit" class="btn btn-primary" value="Tak"/>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Nie</button>
                </form>
            </div>
            </div>
        </div>
        </div>';
echo '<div class="modal" tabindex="-1" role="dialog" aria-labelledby="showPrivateNoteModal" aria-hidden="true" id="show'.$rows["Title"].'">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">'.$rows["Title"].'</h3>
                    </div>
                    <div class="modal-body">
                    <p>'.$rows["Content"].'</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                    </div>
                </form>
            </div>
        </div>
    </div>';

    echo '
    <div class="modal" id="edit'.$rows['Title'].'"  role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="#'.$rows['Title'].'">Edytuj zadanie: '.$rows['Title'].'</h3>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="hidden" value="'.$rows['Title'].'" class="form-control form-control-line" name="editNoteTitle">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-email" class="col-md-12">Opis</label>
                        <div class="col-md-12">
                            <input type="text" value="'.$rows['Content'].'" class="form-control form-control-line" name="editNoteContent" id="example-email">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"> Zapisz</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    ';
        $counter++;
        }
        
    }


    //Edycja profilu usera
    public function changeUserData($pdo,$userID)
    {
        if(isset($_POST['city']))
        {
            $stmt = $pdo->prepare('UPDATE users SET town= :town WHERE loginmd5 = :userID;');
            $stmt->bindParam(':town',$_POST['city'], PDO::PARAM_STR);
            $stmt->bindParam(':userID',$userID, PDO::PARAM_STR);
            $stmt->execute();
        }
        if(isset($_POST['description']))
        {
            $stmtE = $pdo->prepare('UPDATE users SET description= :description WHERE loginmd5 = :userID;');
            $stmtE->bindParam(':description',$_POST['description'],PDO::PARAM_STR);
            $stmtE->bindParam(':userID',$userID,PDO::PARAM_STR);
            $stmtE->execute();      
        }
        if(isset($_POST['password']) && isset($_POST['password2']))
        {
            
            $pass = $_POST['password'];
            $pass2 = $_POST['password2'];
            if($pass == $pass2)
            {
            $salted = "salt{$pass}salt";
            $hash = md5($salted);
             $login= substr($userID, 0, -5); 
            $querryChangePass = $pdo->prepare('UPDATE users SET md5=:hash,loginmd5=:userID WHERE login =:login');
            $querryChangePass->bindParam(':login',$login, PDO::PARAM_STR);
            $querryChangePass->bindParam(':userID',$userID, PDO::PARAM_STR);
            $querryChangePass->bindParam(':hash',$hash, PDO::PARAM_STR);
            $querryChangePass->execute();
            }
            else
            {
                echo '<script>
                alert("Podane hasła różnią się od siebie! ");
                 </script>';
            }

        }
        else
        {
            $stmtB = $pdo->prepare('SELECT md5, login FROM users WHERE loginmd5 = :userID;');
            $stmtB->bindParam(':userID',$userID,PDO::PARAM_STR);
            $stmtB->execute();
            while($row = $stmtB->fetch())
                {
                    $stmtB->bindParam(':md5',$row['md5'], PDO::PARAM_STR);
                    $stmtB->bindParam(':loginmd5',$row['loginmd5'], PDO::PARAM_STR);
                }   
        }
        if (!empty($_FILES['avatar']))        
        {
        if(file_exists($_FILES['avatar']['tmp_name']))
        {        
            
            $imgData = file_get_contents($_FILES['avatar']['tmp_name']);
            $loginmd5 = $_SESSION['userID'];
            $login= substr($loginmd5, 0, -5); 
            $name = $_FILES['avatar']['name'];
            $type = $_FILES['avatar']['type'];

            $stmtD = $pdo->prepare('DELETE FROM avatars WHERE login = :login');
            $stmtD->bindParam(':login', $login);
            $stmtD->execute();
         
            $stmtC = $pdo->prepare('INSERT into avatars(login, name, mime, data) values(:login, :name, :type, :imgdata)');
            $stmtC->bindParam(':login', $login);
            $stmtC->bindParam(':name', $name);
            $stmtC->bindParam(':type', $type);
            $stmtC->bindValue(':imgdata', $imgData);
            $stmtC->execute();
        }
    }
    }

    public function showGroups($pdo,$userID)
    {

        $loggedUser = substr($_SESSION['userID'], 0, -5); 
        $stmt = $pdo->prepare('SELECT cg.GroupName, g.Max_count, g.UserCount, g.groupAdmin
        FROM groups g, connectgroup cg
        WHERE cg.login = :loggedUser
        AND cg.GroupName = g.GroupName
        AND cg.groupAdmin = g.groupAdmin
        ');
        $stmt->bindParam(':loggedUser',$loggedUser,PDO::PARAM_STR);
        $stmt->execute();
        $counter = 1;
        while($rows = $stmt->fetch())
        {
            echo"<br/>";
            echo '<tr>';
            echo '<td>'. $counter .'</td>';

            echo "<td><a href=group.php?groupName="; echo urlencode($rows["GroupName"]) .">"; echo ($rows["GroupName"]) ."</td></a>";
            echo "
            <td>"
                .$rows["UserCount"] ."/".$rows["Max_count"]
            ."</td>";
            echo "<td> <center>
            <form method='POST' id='delete-".$rows["GroupName"]."'>
                <input name='deleteGroup' type='hidden' value='".$rows["GroupName"]."'>
            </form>";
            if($loggedUser != $rows["groupAdmin"])
            {
            echo'<form method="POST" id="leave-'.$rows["GroupName"].'">
                <input name="leaveGroup" type="hidden" value="'.$rows["GroupName"].'">
            </form>
                <button form="leave-"'.$rows["GroupName"].'"  type="submit" class="btn btn-warning btn-xs m-b-10 m-l-5"> Opuść grupę </button>';
            }
            if($loggedUser == $rows["groupAdmin"])
            {
           echo "<button form='delete-".$rows["GroupName"]."' type='submit' class='btn btn-danger btn-xs m-b-10 m-l-5'> Skasuj grupę </button>";
            }
            echo "</center></td>";
        $counter++;
        }
    }
    public function addGroup($pdo, $userID, $groupName)
    {
        if(isset($_POST["groupName"]) && isset($_POST["groupSize"]))
        {
            $pane1 = new panel();
            $name = $_POST["groupName"];
            $size = $_POST["groupSize"];
            $userCount = 1;
            $loggedUser = substr($_SESSION['userID'], 0, -5); 
            if(($pane1->hasUserGroup($pdo, $loggedUser, $groupName) != true))
            {
                echo $name;

                $stmtGroupsCount = $pdo->prepare('SELECT COUNT(*) FROM groups WHERE GroupName = :groupName');
                $stmtGroupsCount->bindParam(':groupName', $groupName,PDO::PARAM_STR);
                $stmtGroupsCount->execute();

                $row= $stmtGroupsCount->fetch();
                $count = $row["COUNT(*)"];
                if($count == 0)
                {
                    $stmt = $pdo->prepare('INSERT INTO groups(GroupName,GroupDescription, Max_count, UserCount, groupAdmin) 
                    VALUES (:name, "Opis grupy...", :size, :count, :user )');

                    $stmtB = $pdo->prepare('INSERT INTO connectgroup(login, GroupName, groupAdmin)
                    VALUES (:login, :name, :login)');

                    $stmt->bindParam(':name', $name,PDO::PARAM_STR);
                    $stmt->bindParam(':size', $size,PDO::PARAM_INT);
                    $stmt->bindParam(':count', $userCount,PDO::PARAM_INT);
                    $stmt->bindParam(':user', $loggedUser,PDO::PARAM_STR);

                    $stmtB->bindParam(':name', $name,PDO::PARAM_STR);
                    $stmtB->bindParam(':login', $loggedUser,PDO::PARAM_STR);

                    $stmt->execute();
                    $stmtB->execute();
                }
                else
                {
                    echo '<script>alert("Już istnieje grupa o takiej nazwie! Wybierz inną nazwę")</script>';
                }
            }
            else
            {
                echo '<script>alert("Już masz grupę o takiej nazwie, wybierz inną nazwę dla grupy")</script>';
            }
        }
    }
    public function getGroupData($pdo, $groupName, $data)
    {
        $stmt = $pdo->prepare('SELECT GroupName, GroupDescription, Max_count, UserCount FROM groups WHERE GroupName= :groupName;');
        $stmt->bindParam(':groupName',$groupName,PDO::PARAM_STR);
        $stmt->execute();
        while($row = $stmt->fetch())
        {
            echo $row[$data];
        }  
    }

    public function showGroupUsers($pdo, $groupName)
    {
        $pane = new panel();
        $stmt = $pdo->prepare('SELECT cg.login, g.groupAdmin, a.data
                               FROM groups g, connectgroup cg, avatars a
                               WHERE cg.GroupName = :groupName 
                               AND cg.GroupName = g.GroupName 
                               AND a.login = cg.login
                               AND cg.groupAdmin = g.groupAdmin
                               ');

        $stmt->bindParam(':groupName',$_GET['groupName'],PDO::PARAM_STR);
        $stmt->execute();
        $counter = 1;

            while($rows = $stmt->fetch())
            { 
            //   var_dump($rows);
            //  echo"<br/>";
            echo '<tr>';
            echo '<td>'. $counter .'</td>';
            if(substr($_SESSION['userID'], 0, 5) == $rows["login"])
            {
                echo '<td>
                <a href=app-profile.php>
                <div class="round-img">';
                    $pane->getUserAvatar($pdo,$rows['login']);
                echo '</div>
                </td>';
                echo "<td>
                <a href=app-profile.php>
                 ".$rows["login"] ." </td></a>" ;
                echo "<td> <center>
              
                </a>
                </a>";   
            }
            else
            {
            echo '<td>
            <a href=app-profile.php?username="'.$rows["login"].'">
            <div class="round-img">';
                $pane->getUserAvatar($pdo,$rows['login']);
            echo '</div>
            </td>';
            echo "<td>
            <a href=otherUserPanel.php?username=".$rows["login"]. ">
             ".$rows["login"] ." </td></a>" ;
            echo "<td> <center>
            <a data-logints=".$rows['login']." href=\"javascript:;\" data-toggle=\"modal\" data-target=\"#sendMail\">
                <button data-logints=".$rows['login']." type=\"button\" class=\"btn btn-info btn-xs m-b-10 m-l-5\">
                    Wiadomość</button>
            </a>";
            }
            if(substr($_SESSION['userID'],0, -5) == $rows["groupAdmin"])
            {
                if(substr($_SESSION['userID'],0, -5) != $rows["login"])
                    {
                    echo "  
                    <form style=\"float:left;\" method='POST' id='delete".$rows['login']."FromGroup'>
                            <input name='usertodeleteFromGroup' type='hidden' value='".$rows['login']."'>
                        </form>

                        <button name='deleteFromGroup' form ='delete".$rows['login']."FromGroup' type=\"submit\" class=\"btn btn-danger btn-xs m-b-10 m-l-5\">
                            Usuń użytkownika</button>
                        </td>";
                    }
            }
            if($rows["login"] == $rows["groupAdmin"])
            {
            echo "<td><span class=\"badge badge-danger\">ADMIN</span>
                    </td>
                    </tr>";
            }
            // else
            // {
            //     echo "<a href=\"javascript:;\" data-toggle=\"modal\" data-target=\"#deleteTaskConfirmModal\">
            //             <button type=\"button\" class=\"btn btn-danger btn-xs m-b-10 m-l-5\"></button>
            //         </a>
            //         </center></td>
            //         <td>
            //             <span class=\"badge badge-danger\"></span>
            //         </td>
            //         </tr>";
            // }
            $counter++;
        }

    }

    public function existsUser($pdo, $username)
    {
        $stmt = $pdo->prepare('SELECT login FROM users ');
        $stmt->execute();
        $userFound = false;
            while($rows = $stmt->fetch())
            { 
                if($username == $rows['login'])
                {
                    $userFound = true;
                }
            }
        return $userFound;
    }

    public function existsUserInGroup($pdo, $username, $groupName)
    {
        $stmt = $pdo->prepare('SELECT login, GroupName FROM connectgroup ');
        $stmt->execute();
        $userFound = false;
            while($rows = $stmt->fetch())
            { 
                if($username == $rows['login'] && $groupName == $rows['GroupName'])
                {
                    $userFound = true;
                }
            }
        return $userFound;
    }

    public function hasUserGroup($pdo, $username, $groupName)
    {
        $stmt = $pdo->prepare('SELECT  g.GroupName, g.groupAdmin FROM groups g WHERE g.GroupName = :groupName AND g.groupAdmin = :username');
        $stmt->bindParam(':groupName', $groupName,PDO::PARAM_INT);
        $stmt->bindParam(':username', $username,PDO::PARAM_INT);
        $stmt->execute();
        $userFound = false;

            while($rows = $stmt->fetch())
            { 
                if($username == $rows['groupAdmin'] && $groupName == $rows['GroupName'])
                {
                    $userFound = true;
                }
            }
        return $userFound;
    }

    public function addUserToGroup($pdo, $groupName)
    {
        if(isset($_POST["username"]))
        {
            $username = $_POST["username"];
            if($this->existsUser($pdo, $username) && (!($this->existsUserInGroup($pdo, $username, $groupName))))
            {
                
                echo'<script>' .$groupName. '</script>';
                $stmtAdmin = $pdo->prepare('SELECT g.groupAdmin FROM groups g WHERE g.GroupName = :groupName');
                $stmtAdmin->bindParam(':groupName', $groupName,PDO::PARAM_INT);
                $stmtAdmin->execute();
                
                $stmtIncrement = $pdo->prepare('UPDATE groups SET UserCount = UserCount + 1
                                                 WHERE GroupName = :groupName');
                $stmtIncrement->bindParam(':groupName', $groupName,PDO::PARAM_INT);
                $stmtIncrement->execute();

                $row = $stmtAdmin->fetch();
                $groupAdminLogin = $row["groupAdmin"];

                $stmt = $pdo->prepare('INSERT INTO connectgroup(login, GroupName, groupAdmin)
                                    VALUES (:username, :groupName, :admin) ');

                $stmt->bindParam(':username', $username,PDO::PARAM_STR);
                $stmt->bindParam(':groupName', $groupName,PDO::PARAM_STR);
                $stmt->bindParam(':admin', $groupAdminLogin,PDO::PARAM_STR);
                $stmt->execute();
            }
            else
            {
                echo '<script>alert("Użytkownik jest już w grupie lub nie istnieje!")</script>'; 
            }
        }

    }

    public function addPrivateNote($pdo, $username)
    {
        if(isset ($_POST['noteTitle']))
        {
            if(isset ($_POST['noteContent']))
            {
                $date = date("y-m-d");
                $insertSTMT = $pdo->prepare('INSERT into privatenotes(DateAdded, Loginmd5, Title, Content) 
                                values(:DateAdded, :Loginmd5, :Title, :Content)');
                $insertSTMT->bindParam(':DateAdded', $date);
                $insertSTMT->bindParam(':Loginmd5', $username);
                $insertSTMT->bindParam(':Title', $_POST['noteTitle']);
               $insertSTMT->bindParam(':Content', $_POST['noteContent']);
               $insertSTMT->execute();
            }
        }
    }

    public function changeGroupData($pdo,$groupName)
    {
            if(isset($_POST['groupName']))
            {
                $stmt = $pdo->prepare('UPDATE groups SET GroupName= :name WHERE GroupName  = :oldName;');
                $stmtB = $pdo->prepare('UPDATE connectgroup SET GroupName= :name WHERE GroupName  = :oldName;'); 
                $stmt->bindParam(':name',$_POST['groupName'], PDO::PARAM_STR);
                $stmt->bindParam(':oldName',$groupName, PDO::PARAM_STR);
                $stmtB->bindParam(':name',$_POST['groupName'], PDO::PARAM_STR);
                $stmtB->bindParam(':oldName',$groupName, PDO::PARAM_STR);

                if(isset($_POST['description']))
                {
                    $stmtC = $pdo->prepare('UPDATE groups SET GroupDescription= :desc WHERE GroupName  = :name;');
                    $stmtC->bindParam(':desc',$_POST['description'], PDO::PARAM_STR);
                    $stmtC->bindParam(':name',$groupName, PDO::PARAM_STR);
                    $stmtC->execute();
                    
                    if(isset($_POST['count']))
                    {
                        $stmtD = $pdo->prepare('UPDATE groups SET Max_count= :count WHERE GroupName  = :name;');
                        $stmtD->bindParam(':count',$_POST['count'], PDO::PARAM_STR);
                        $stmtD->bindParam(':name',$groupName, PDO::PARAM_STR);
                        $stmtD->execute();
                    }
                }
                $stmt->execute();
                $stmtB->execute();
            }
            

    }
    
    //USUWANIE GRUPY ORAZ UŻYTKOWNIKÓW Z GRUPY
    public function deleteGroup($pdo,$loginmd5)
    {

        if(isset($_POST['deleteGroup']))
        {
            $groupID = $_POST['deleteGroup'];
            $login= substr($loginmd5, 0, -5); 

        $querryDeleteGroup=$pdo->prepare('DELETE FROM groups WHERE GroupName=:groupName AND groupAdmin=:login');
        $querryDeleteGroup->bindParam(':groupName',$groupID, PDO::PARAM_STR);
        $querryDeleteGroup->bindParam(':login',$login, PDO::PARAM_STR);
        $querryDeleteGroup->execute();

        $q = $pdo->prepare('DELETE FROM connectgroup WHERE GroupName=:groupName AND groupAdmin=:admin');
        $q->bindParam(':groupName',$groupID, PDO::PARAM_STR);
        $q->bindParam(':admin',$login, PDO::PARAM_STR);
        $q->execute();

        $q2 = $pdo->prepare('DELETE FROM grouptasks WHERE GroupName=:groupName AND groupAdmin=:admin');
        $q2->bindParam(':groupName',$groupID, PDO::PARAM_STR);
        $q2->bindParam(':admin',$login, PDO::PARAM_STR);
        $q2->execute();
        }
    }
    //Opuść grupe
    public function leaveGroup($pdo){
        if(isset($_POST['leaveGroup'])){
            $groupID = $_POST['leaveGroup'];
            $loginmd5 = $_SESSION['userID'];
            $login= substr($loginmd5, 0, -5); 
        $querryLeaveGroup = $pdo->prepare('DELETE FROM connectgroup WHERE GroupName=:groupName AND login=:login');
        $querryLeaveGroup->bindParam(':groupName',$groupID, PDO::PARAM_STR);
        $querryLeaveGroup->bindParam(':login',$login, PDO::PARAM_STR);
        $querryLeaveGroup->execute();
        }
    }
    public function deleteFromGroup($pdo, $groupName){
        if (isset($_POST['usertodeleteFromGroup']))
        {
            $stmtDecrement = $pdo->prepare('UPDATE groups SET UserCount = UserCount - 1
            WHERE GroupName = :groupName');
            $stmtDecrement->bindParam(':groupName', $groupName,PDO::PARAM_INT);
            $stmtDecrement->execute();
            
            $groupID= $_GET['groupName'];
            $login = $_POST['usertodeleteFromGroup'];
            echo $login;
            echo $groupID;
            $querryDeleteFrom = $pdo->prepare('DELETE FROM connectgroup WHERE GroupName=:groupName AND login=:login');
            $querryDeleteFrom->bindParam(':groupName',$groupID, PDO::PARAM_STR);
            $querryDeleteFrom->bindParam(':login',$login, PDO::PARAM_STR);
            $querryDeleteFrom->execute();
        }
    }
    public function addTaskToGroup($pdo){
        if (isset($_POST['groupTaskSend'])){
            $groupID = $_GET['groupName'];
            $taskName = $_POST['taskName'];
            $taskDescription = $_POST['taskDescription'];
            $taskExpiry = $_POST['taskExpiry'];
            $date = date("y-m-d");
            $login= substr($_SESSION['userID'], 0, -5); 
            
            $querryFindAdmin = $pdo->prepare('SELECT groupAdmin FROM groups WHERE GroupName = :GroupName');
            $querryFindAdmin->bindParam(':GroupName', $groupID, PDO::PARAM_STR);
            $querryFindAdmin->execute();

            $row = $querryFindAdmin->fetch();
            $groupAdmin = $row["groupAdmin"];

            $querryAddTask = $pdo->prepare('INSERT INTO grouptasks(topic, content,DateAdded, dateend, groupname, author, status1, groupAdmin) 
            VALUES (:topic,:content,:dateAdded,:dateend,:groupname,:login,0, :groupAdmin);');
            $querryAddTask->bindParam(':topic', $taskName, PDO::PARAM_STR);
            $querryAddTask->bindParam(':content', $taskDescription, PDO::PARAM_STR);
            $querryAddTask->bindParam(':dateAdded', $date, PDO::PARAM_STR);
            $querryAddTask->bindParam(':dateend', $taskExpiry, PDO::PARAM_STR);
            $querryAddTask->bindParam(':groupname', $groupID, PDO::PARAM_STR);
            $querryAddTask->bindParam(':login',$login, PDO::PARAM_STR);
            $querryAddTask->bindParam(':groupAdmin',$groupAdmin, PDO::PARAM_STR);

            $querryAddTask->execute();
        }
    }

    //DODAWANIE ZADAŃ

    public function addTask($pdo,$userID)
    {
        if(isset ($_POST['topic']))
        {
        $stmt = $pdo->prepare('SELECT email,login,md5,loginmd5,description,town FROM users WHERE loginmd5= :userID;');
        $stmt->bindParam(':userID',$userID,PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(); 
        $stmt -> closeCursor();

        $status = 0;
        $date = date("Y-m-d");
        $insertSTMT = $pdo->prepare('INSERT into tasks(topic, content, loginmd5, DateAdded, dateend, author, status1) 
                            values(:topic, :content, :loginmd5, :DateAdded, :dateend, :author, :status1)');
        $insertSTMT->bindParam(':topic', $_POST['topic']);
        $insertSTMT->bindParam(':content', $_POST['content']);
        $insertSTMT->bindParam(':loginmd5', $userID);
        $insertSTMT->bindParam(':DateAdded', $date);
        $insertSTMT->bindParam(':dateend', $_POST['dateend']);
        $insertSTMT->bindParam(':author', $row['login']);
        $insertSTMT->bindParam(':status1', $status);
        $insertSTMT->execute();
        }
    }

    public function showTasks($pdo, $userID)
    {
        $stmt = $pdo->prepare('SELECT topic, content, loginmd5, DateAdded, dateend, author, status1 FROM tasks
        WHERE loginmd5= :userID;');
        $stmt->bindParam(':userID',$userID,PDO::PARAM_STR);
        $stmt->execute();
        echo '<table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nazwa</th>
                <th>Deadline</th>
                <th>
                    <center>Akcje</center>
                </th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>';
        $counter =0;
        while($row = $stmt->fetch())        
        {
            echo '
                <tr>
                    <td>'.++$counter.'</td>
                    <td>
                    <a href="javascript:;" data-toggle="modal" data-target="#show'.$row["topic"].'">
                    '.$row["topic"].'</td></a>
                                        </td>
                    <td>
                       
                            <span>'.$row['dateend'].'</span>
                       
                    </td>
                    <td>
                    <center> ';
                        if($row['status1']==0)
                        {
                         echo '<form id="end-'.$row['topic'].'" method="POST">
                         <input name="endTask" type="hidden" value="'.$row['topic'].'">
                         </form>                 
                        <button form="end-'.$row['topic'].'" type="submit" class="btn btn-info btn-xs m-b-10 m-l-5">Zakończ</button> 
                                          
                         ';
                        }
                           
                        echo '<a href="javascript:;" data-toggle="modal" data-target="#'.$row['topic'].'">
                                <button type="button" class="btn btn-warning btn-xs m-b-10 m-l-5">
                                    Edytuj</button>
                            </a>
                            <a href="javascript:;" data-toggle="modal" data-target="#a'.$row['topic'].'">
                                <button type="button" class="btn btn-danger btn-xs m-b-10 m-l-5">
                                    Usuń</button>
                            </a> 
                   </center>

                    </td>
                    <td>';
                        if($row['status1']==1)
                        {
                        echo '<span class="badge badge-success">Skończone</span>';
                        }
                        else
                        {
                        echo '<span class="badge badge-danger">W trakcie</span>';   
                        }
                        echo'
                    </td>
                </tr>
               
                <div class="modal" id="'.$row['topic'].'"  role="dialog"  aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="#'.$row['topic'].'">Edytuj zadanie: '.$row['topic'].'</h3>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="hidden" value="'.$row['topic'].'" class="form-control form-control-line" name="editTaskName">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Opis</label>
                                    <div class="col-md-12">
                                        <input type="text" value="'.$row['content'].'" class="form-control form-control-line" name="editTaskDescription" id="example-email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Deadline</label>
                                    <div class="col-md-12">
                                        <input name="editTaskDate" type="date" class="form-control" value="'.$row['dateend'].'"> </div>
                                </div>
                                <button type="submit" class="btn btn-primary"> Zapisz</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                            </form>
                        </div>
                    </div>
                </div>
          </div>';
            
          echo '<div class="modal" tabindex="-1" role="dialog" aria-labelledby="showTask" aria-hidden="true" id="show'.$row["topic"].'">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">'.$row["topic"].'</h3>
                        <h4 style="float:left !important;">Deadline: '.$row["dateend"] .'</h4>';
                      
                    
                        echo'</div>
                    <div class="modal-body">
                    <p>'.$row["content"].'</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                    </div>
                </form>
            </div>
         </div>
        </div>';
            
            echo'<div class="modal" id="a'.$row['topic'].'" tabindex="-1" role="dialog" aria-labelledby="deleteTaskConfirmModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Uwaga!</h3>
                </div>
                <div class="modal-body">
                    <h5>Na pewno chcesz usunąć zadanie: <strong>'.$row['topic'].'</strong></h5>
                </div>
                <div class="modal-footer">
                <form method="POST">
                    <input name="delTask" type="hidden" value="'.$row['topic'].'">
                    <input type="submit" class="btn btn-primary" value="Tak"/>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Nie</button>
                    </form>
                </div>
                </div>
            </div>
            </div>';
        }
        echo '
        </tbody>
        </table>';
    }

    //Zadania grupowe - show i akcje do niego xD
    
    public function showGroupTasks($pdo)
    {
        $groupName = $_GET['groupName'];
        $stmt = $pdo->prepare('SELECT topic, content, DateAdded, dateend, status1 FROM grouptasks
        WHERE groupName= :groupName;');
        $stmt->bindParam(':groupName',$groupName,PDO::PARAM_STR);
        $stmt->execute();
        echo '<table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nazwa</th>
                <th>Deadline</th>
                <th>
                    <center>Akcje</center>
                </th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>';
        $counter =0;
        while($row = $stmt->fetch())        
        {
            echo '
                <tr>
                    <td>'.++$counter.'</td>
                    <td>
                    <a href="javascript:;" data-toggle="modal" data-target="#show'.$row["topic"].'">
                    '.$row["topic"].'</td></a>
                    </td>
                    <td>
                        <a href="date.php">
                            <span>'.$row['dateend'].'</span>
                        </a>
                    </td>
                    <td>
                    <center> ';
                        if($row['status1']==0)
                        {
                         echo '<form id="end-'.$row['topic'].'" method="POST">
                         <input name="endgroupTask" type="hidden" value="'.$row['topic'].'">
                         </form>                 
                        <button form="end-'.$row['topic'].'" type="submit" class="btn btn-info btn-xs m-b-10 m-l-5">Zakończ</button> 
                                          
                         ';
                        }
                           
                        echo '<a href="javascript:;" data-toggle="modal" data-target="#'.$row['topic'].'">
                                <button type="button" class="btn btn-warning btn-xs m-b-10 m-l-5">
                                    Edytuj</button>
                            </a>
                            <a href="javascript:;" data-toggle="modal" data-target="#a'.$row['topic'].'">
                                <button type="button" class="btn btn-danger btn-xs m-b-10 m-l-5">
                                    Usuń</button>
                            </a> 
                   </center>

                    </td>
                    <td>';
                        if($row['status1']==1)
                        {
                        echo '<span class="badge badge-success">Skończone</span>';
                        }
                        else
                        {
                        echo '<span class="badge badge-danger">W trakcie</span>';   
                        }
                        echo'
                    </td>
                </tr>
               
                <div class="modal" id="'.$row['topic'].'"  role="dialog"  aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="#'.$row['topic'].'">Edytuj zadanie: '.$row['topic'].'</h3>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="hidden" value="'.$row['topic'].'" class="form-control form-control-line" name="editgroupTaskName">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Opis</label>
                                    <div class="col-md-12">
                                        <input type="text" value="'.$row['content'].'" class="form-control form-control-line" name="editTaskDescription" id="example-email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Deadline</label>
                                    <div class="col-md-12">
                                        <input name="editTaskDate" type="date" class="form-control" value="'.$row['dateend'].'"> </div>
                                </div>
                                <button type="submit" class="btn btn-primary"> Zapisz</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                            </form>
                        </div>
                    </div>
                </div>
          </div>';
            
          echo '<div class="modal" tabindex="-1" role="dialog" aria-labelledby="showGroupTask" aria-hidden="true" id="show'.$row["topic"].'">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">'.$row["topic"].'</h3>
                        <h4 style="float:left">Deadline: '.$row["dateend"] .'</h4>';
                        if($row['status1']==1)
                        {
                        echo '<span class="badge badge-success">Skończone</span>';
                        }
                        else
                        {
                        echo '<span class="badge badge-danger">W trakcie</span>';   
                        }
                        echo'</div>
                    
                    <div class="modal-body">
                    <p>'.$row["content"].'</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                    </div>
                </form>
            </div>
         </div>
        </div>';
            
            echo '<div class="modal" id="a'.$row['topic'].'" tabindex="-1" role="dialog" aria-labelledby="deleteTaskConfirmModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Uwaga!</h3>
                </div>
                <div class="modal-body">
                    <h5>Na pewno chcesz usunąć zadanie: <strong>'.$row['topic'].'</strong></h5>
                </div>
                <div class="modal-footer">
                <form method="POST">
                    <input name="delgroupTask" type="hidden" value="'.$row['topic'].'">
                    <input type="submit" class="btn btn-primary" value="Tak"/>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Nie</button>
                    </form>
                </div>
                </div>
            </div>
            </div>';
        }
        echo '
        </tbody>
        </table>';
    }
    public function editgroupTask($pdo)
    {
        if(isset($_POST['editgroupTaskName']))
        {
        $groupID = $_GET['groupName'];
        $stmt = $pdo->prepare('UPDATE grouptasks SET 
                                content= :content,
                                dateend= :dateend 
                                WHERE topic = :topic AND groupName = :groupID;');
        $stmt->bindParam(':topic', $_POST['editgroupTaskName']);                    
        $stmt->bindParam(':content', $_POST['editTaskDescription']);
        $stmt->bindParam(':dateend', $_POST['editTaskDate']);
        $stmt->bindParam(':groupID', $groupID);
        $stmt->execute();
        }
    }
    public function endgroupTask($pdo)
    {
        if(isset($_POST['endgroupTask']))
        {
            $groupID = $_GET['groupName'];
            $status1 = 1;
            $stmt = $pdo->prepare('UPDATE grouptasks SET 
                                    status1= :status1
                                    WHERE topic = :topic AND groupName = :groupID;');
            $stmt->bindParam(':status1', $status1);                    
            $stmt->bindParam(':topic', $_POST['endgroupTask']);
            $stmt->bindParam(':groupID', $groupID);
            $stmt->execute();
        } 
    }

    public function delgroupTask($pdo)
    {
        if(isset($_POST['delgroupTask']))
        {
            $groupID = $_GET['groupName'];
            $stmt = $pdo->prepare('DELETE FROM grouptasks WHERE topic = :topic AND groupName = :groupID;');                 
            $stmt->bindParam(':topic', $_POST['delgroupTask']);
            $stmt->bindParam(':groupID', $groupID);
            $stmt->execute();
        } 
        
    }


//---------------------------------------------------------------------------
    public function editTask($pdo, $userID)
    {
        if(isset($_POST['editTaskName']))
        {
        $stmt = $pdo->prepare('UPDATE tasks SET 
                                content= :content,
                                dateend= :dateend 
                                WHERE topic = :topic AND loginmd5 = :userID;');
        $stmt->bindParam(':topic', $_POST['editTaskName']);                    
        $stmt->bindParam(':content', $_POST['editTaskDescription']);
        $stmt->bindParam(':dateend', $_POST['editTaskDate']);
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
        }
    }
    public function endTask($pdo,$userID)
    {
        if(isset($_POST['endTask']))
        {
            $status1 = 1;
            $stmt = $pdo->prepare('UPDATE tasks SET 
                                    status1= :status1
                                    WHERE topic = :topic AND loginmd5 = :userID;');
            $stmt->bindParam(':status1', $status1);                    
            $stmt->bindParam(':topic', $_POST['endTask']);
            $stmt->bindParam(':userID', $userID);
            $stmt->execute();
        } 
    }

    public function delTask($pdo,$userID)
    {
        if(isset($_POST['delTask']))
        {

            $stmt = $pdo->prepare('DELETE FROM tasks WHERE topic = :topic AND loginmd5 = :userID;');                 
            $stmt->bindParam(':topic', $_POST['delTask']);
            $stmt->bindParam(':userID', $userID);
            $stmt->execute();
        } 
        
    }

    //ZLICZANIE landpage
    public function countWaitingTasks($pdo, $username)
    {
        $tasksCount = 0;
        $stmt = $pdo->prepare('SELECT COUNT(t.loginmd5) FROM tasks t WHERE t.loginmd5 = :userID AND t.status1 = 0');
        $stmt->bindParam(':userID', $username,PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        echo $row['COUNT(t.loginmd5)'];  
    }

    public function countUserPrivateNotes($pdo, $username)
    {
        $tasksCount = 0;
        $stmt = $pdo->prepare('SELECT COUNT(n.loginmd5) FROM privatenotes n WHERE n.loginmd5 = :userID');
        $stmt->bindParam(':userID', $username,PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        echo $row['COUNT(n.loginmd5)'];  
    }

    public function countAllTasks($pdo, $username)
    {
        $tasksCount = 0;
        $stmt = $pdo->prepare('SELECT COUNT(t.loginmd5) FROM tasks t WHERE t.loginmd5 = :userID ');
        $stmt->bindParam(':userID', $username,PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        echo $row['COUNT(t.loginmd5)'];  
    }

    public function countFinishedTasks($pdo, $username)
     {
         $tasksCount = 0;
        $stmt = $pdo->prepare('SELECT COUNT(t.loginmd5) FROM tasks t WHERE t.loginmd5 = :userID AND t.status1 = 1');
         $stmt->bindParam(':userID', $username,PDO::PARAM_STR);
         $stmt->execute();
         $row = $stmt->fetch();
         echo $row['COUNT(t.loginmd5)'];  
     }

     public function delUserPrivateNote($pdo,$userID)
    {
        if(isset($_POST['delNote']))
        {
            $stmt = $pdo->prepare('DELETE FROM privatenotes WHERE Title = :Title AND loginmd5 = :userID;');                 
            $stmt->bindParam(':Title', $_POST['delNote']);
            $stmt->bindParam(':userID', $userID);
            $stmt->execute();
        } 
        
    }

    public function editUserPrivateNote($pdo,$userID)
    {
        
        if(isset($_POST['editNoteTitle']))
        {
        $stmtE = $pdo->prepare('UPDATE privatenotes SET 
                                Content= :Content
                                WHERE Title = :Title AND Loginmd5 = :userID;');
        $stmtE->bindParam(':Title', $_POST['editNoteTitle']);                    
        $stmtE->bindParam(':Content', $_POST['editNoteContent']);
        $stmtE->bindParam(':userID', $userID);
        $stmtE->execute();
        }
    }
    //SPOLECZNOSC:
    // STATUS 0 - NIEZNAJOMI
    // STATUS 1 - ZAPRO WYSLANE
    // STATUS 2 - ZNAJOMI
    // STATUS 3 - ZAPRO ZIGNOROWANE
    public function showFriends($pdo, $username)
    {
        $pane = new panel();
        $stmt = $pdo->prepare('SELECT r.user1Login, r.user2Login FROM relationships r 
        WHERE (r.user1Login =:username OR r.user2Login = :username)
        AND r.relationshipStatus = 2
        ');
        $stmt->bindParam(':username',$username,PDO::PARAM_STR);
        $stmt->execute();
        $counter = 1;

            while($rows = $stmt->fetch())
            { 
            //  var_dump($rows);
            //  echo"<br/>";
            echo '<tr>';
            echo '<td>'. $counter .'</td>';
            echo '<td>';
            if($rows["user1Login"] == $username)
            {
                $friend = $rows["user2Login"];
            }
            else
            {
                $friend = $rows["user1Login"];
            }
           echo' <a href=otherUserPanel.php?username='.$friend.'>
            <div class="round-img">';
                $pane->getUserAvatar($pdo,$friend);
            echo '</div>
            </td>';
            echo "<td>
            <a href=otherUserPanel.php?username=".$friend. ">
             ".$friend." </td></a>" ;
            echo "<td> 
            <center>
            <a  href=\"javascript:;\" data-toggle=\"modal\" data-target=\"#sendMailTo".$friend. "\">
                <button type=\"button\" class=\"btn btn-info btn-xs m-b-10 m-l-5\">
                    Wiadomość</button>
            </a>";
            echo '
            <form id="removefriend-'.$friend.'" style="float:left" method="POST">
            <input name="removeFriend" type="hidden" value="'.$friend.'">
            </form>            
            <button form="removefriend-'.$friend.'" type="submit" class="btn btn-danger btn-xs m-b-10 m-l-5">Usuń ze znajomych</button>

            </td>';
            echo'
            <div class="modal" tabindex="-1" role="dialog" aria-labelledby="sendMail" aria-hidden="true" id="sendMailTo'.$friend.'">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" novalidate="novalidate">
                    <div class="modal-header">
                        <h3 class="modal-title">Wyślij wiadomość do '.$friend.'</h3>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="form-group">
                                <input type="hidden" name="mailTo" value="'.$friend.'"/>
                                <label for="groupName">
                                    Temat </label>
                                <input type="text" placeholder="Temat wiadomości" class="form-control" name="mailTopic" id="mailTopic"/>
                                <label for="groupSize">
                                    Treść </label>
                                <input type="text" placeholder="Treść wiadomości"  class="form-control" name="mailContent" id="mailContent"/>
                                <span class="field-validation-valid text-danger" data-valmsg-for="groupName" data-valmsg-replace="true"></span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Wyślij wiadomość"/>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
            ';
            $counter++;
        }


    }

    public function showFriendsJSON($pdo, $username)
    {
        $pane = new panel();
        $stmt = $pdo->prepare('SELECT r.user2Login FROM relationships r 
        WHERE (r.user1Login =:username OR r.user2Login = :username)
        AND r.relationshipStatus = 2 AND r.relationshipStatus = 1
        ');
        $stmt->bindParam(':username',$username,PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);  
        echo($json);
    }

    public function showReceivedInvitations($pdo, $username)
    {
        $pane = new panel();
        $stmt = $pdo->prepare('SELECT r.user1Login, r.user2Login FROM relationships r 
        WHERE (r.user1Login = :username OR r.user2Login = :username)
        AND r.relationshipStatus = 1
        AND r.actionUserLogin <> :username
        ');
        $stmt->bindParam(':username',$username,PDO::PARAM_STR);
        $stmt->execute();
        $counter = 1;
        echo"<br/>";
            while($rows = $stmt->fetch())
            { 
            //  var_dump($rows);
            //  echo"<br/>";
            echo '<tr>';
            echo '<td>'. $counter .'</td>';
            echo '<td>';
            if($rows["user1Login"] == $username)
            {
                $friend = $rows["user2Login"];
            }
            else
            {
                $friend = $rows["user1Login"];
            }
           echo' <a href=otherUserPanel.php?username='.$friend.'>
            <div class="round-img">';
                $pane->getUserAvatar($pdo,$friend);
            echo '</div>
            </td>';
            echo "<td>
            <a href=otherUserPanel.php?username=".$friend.">
             ".$friend." </td></a>" ;
            echo "<td> <center>"; 
            echo'
            <form id="ignore" method="POST">
            <input name="ignoreInvitation" type="hidden" value="'.$friend.'">
            </form>   
            <button form="ignore" type="submit" class="btn btn-danger btn-xs m-b-10 m-l-5"><i class="ti-user"></i>Ignoruj</button>

            <form id="accept" style="float:left;" method="POST" id="accept'.$friend.'">
            <input name="acceptInvitation" type="hidden" value="'.$friend.'">
            </form>   
            <button form="accept" type="submit" class="btn btn-success btn-xs m-b-10 m-l-5"><i class="ti-user"></i>Akceptuj</button>

          ';
           echo" </td>";
            $counter++;
        }    }
    public function showSentInvitations($pdo, $username)
    {
        $pane = new panel();
        $stmt = $pdo->prepare('SELECT user1Login, user2Login FROM relationships r 
        WHERE (r.user1Login =:username OR r.user2Login = :username)
        AND r.relationshipStatus = 1
        AND r.actionUserLogin = :username
        ');
        $stmt->bindParam(':username',$username,PDO::PARAM_STR);
        $stmt->execute();
        $counter = 1;

            while($rows = $stmt->fetch())
            { 
            //  var_dump($rows);
            //  echo"<br/>";
            echo '<tr>';
            echo '<td>'. $counter .'</td>';
            echo '<td>';
            if($rows["user1Login"] == $username)
            {
                $friend = $rows["user2Login"];
            }
            else
            {
                $friend = $rows["user1Login"];
            }
           echo' <a href=otherUserPanel.php?username='.$friend.'>
            <div class="round-img">';
                $pane->getUserAvatar($pdo,$friend);
            echo '</div>
            </td>';
            echo "<td>
            <a href=otherUserPanel.php?username=".$friend. ">
             ".$friend." </td></a>" ;
            echo '<td> <center>
            <form method="POST">
            <input name="deleteSentInvitation" type="hidden" value="'.$friend.'">
            <button type="submit" class="btn btn-danger btn-xs m-b-10 m-l-5">Usuń zaproszenie</button>
            </form> 
            </td>';
            $counter++;
        }
    }
    public function inviteToFriendsButtons($pdo, $user1, $user2)
    {
        if($this->relationShipStatus($pdo, $user1, $user2) == 0)
        {
            //user1 - zapraszany
            //user2 - zapraszajacy
            echo'
            <form style="float:left" method="POST">
            <input name="user1" type="hidden" value="'.$user1.'">
            <button type="submit" class="btn btn-success btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-user"></i>Zaproś do znajomych</button>
            </form>
            ';
        }
        else if(($this->relationShipStatus($pdo, $user1, $user2) == 1) || ($this->relationShipStatus($pdo, $user1, $user2) == 3))
        {
            echo'
            <form style="float:left" method="POST">
            <input name="user1" type="hidden" value="'.$user1.'">
            <button type="submit" class="btn btn-primary btn-flat btn-addon btn-sm m-b-10 m-l-5" disabled><i class="ti-user"></i>Zaproszenie wysłane</button>
            </form>
            ';
        }
        else if($this->relationShipStatus($pdo, $user1, $user2) == 2)
        {
            echo'
            <form style="float:left"  method="POST">
            <input name="user1" type="hidden" value="'.$user1.'">
            <button type="submit" class="btn btn-success btn-flat btn-addon btn-sm m-b-10 m-l-5" disabled><i class="ti-user"></i>Znajomy</button>
            </form>
            ';
        }
        else if($this->relationShipStatus($pdo, $user1, $user2) == 4)
        {
            echo'
            <form style="float:left"  method="POST">
            <input name="acceptInvitation" type="hidden" value="'.$user1.'">
            <button type="submit" class="btn btn-success btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-user"></i>Zaakceptuj zaproszenie</button>
            </form>
            ';
        }
    }
    public function sendInvitation($pdo, $user1, $user2)
    {
        if($this->relationShipStatus($pdo, $user1, $user2) == 0)
        {
            if($user2 != $user1)
            {
                $stmt = $pdo->prepare('INSERT INTO `relationships` (user1Login, user2Login, relationshipStatus, actionUserLogin)
                VALUES (:user1, :user2, 1, :user2)
                ');
                $stmt->bindParam(':user1', $user1, PDO::PARAM_STR);
                $stmt->bindParam(':user2', $user2, PDO::PARAM_STR);
                $stmt->execute();
            }
        }
    }

    public function acceptInvitation($pdo, $user1, $user2)
    {
        if(isset($_POST["acceptInvitation"]))
        {
            $stmt = $pdo->prepare('UPDATE relationships r SET 
            relationshipStatus = 2 
            WHERE (r.user1Login =:user1 AND r.user2Login = :user2) 
             OR (r.user2Login = :user1 AND r.user1Login= :user2)
             AND r.relationshipStatus = 1;
            ');
         $stmt->bindParam(':user1', $user1, PDO::PARAM_STR);
         $stmt->bindParam(':user2', $user2, PDO::PARAM_STR);
         $stmt->execute();
        }
    }
    public function ignoreInvitation($pdo, $user1, $user2)
    {
        if(isset($_POST["ignoreInvitation"]))
        {
            $stmt = $pdo->prepare('UPDATE relationships r SET 
            relationshipStatus = 3 
            WHERE (r.user1Login =:user1 AND r.user2Login = :user2) 
             OR (r.user2Login = :user1 AND r.user1Login= :user2)
             AND r.relationshipStatus = 1;
            ');
         $stmt->bindParam(':user1', $user1, PDO::PARAM_STR);
         $stmt->bindParam(':user2', $user2, PDO::PARAM_STR);
         $stmt->execute();
        }
    }
    public function searchUser($pdo, $username)
    {
        if(isset($_POST["ignoreInvitation"]))
        {
         $stmt = $pdo->prepare('SELECT login FROM users WHERE login LIKE :username');
         $stmt->bindParam(':username', $username ."%", PDO::PARAM_STR);
         $stmt->execute();
         while($rows = $stmt->fetch())
            {
                $output .= '
                <tr>
                    <td>'.$rows["login"].'</td>
                </tr>
                ';
            }
            echo $output;
        }
    }
    public function relationShipStatus($pdo, $user1, $user2)
    {
         $stmt = $pdo->prepare('SELECT COUNT(*), r.actionUserLogin, r.relationshipStatus FROM relationships r 
        WHERE (r.user1Login =:user1 AND r.user2Login = :user2) 
        OR (r.user2Login = :user1 AND r.user1Login= :user2)
        ');

         $stmt->bindParam(':user1', $user1, PDO::PARAM_STR);
         $stmt->bindParam(':user2', $user2, PDO::PARAM_STR);
         $stmt->execute();
         $row = $stmt->fetch();
         $count = $row["COUNT(*)"];
         if($count == 0)
         {
             return 0;  
         }
         if($user1 == $row["actionUserLogin"] && $row["relationshipStatus"] == 1)
         {
             return 4;
         }

         else
         {
            return $row["relationshipStatus"];
         }

    }

    public function deleteSentInvitation($pdo, $user1, $user2)
    {
        if(isset($_POST["deleteSentInvitation"]))
        {
            $stmt = $pdo->prepare('DELETE FROM relationships  
            WHERE (user1Login = :user1 AND user2Login = :user2) 
             OR (user2Login = :user1 AND user1Login= :user2)
             AND relationshipStatus = 1
             AND actionUserLogin = :user1
            ');
         $stmt->bindParam(':user1', $user1, PDO::PARAM_STR);
         $stmt->bindParam(':user2', $user2, PDO::PARAM_STR);
         $stmt->execute();
        }
    }
    public function removeFromFriends($pdo, $user1, $user2)
    {
        if(isset($_POST["removeFriend"]))
        {
            $stmt = $pdo->prepare('DELETE FROM relationships  
            WHERE (user1Login = :user1 AND user2Login = :user2) 
             OR (user2Login = :user1 AND user1Login= :user2)
             AND relationshipStatus = 2
            ');
         $stmt->bindParam(':user1', $user1, PDO::PARAM_STR);
         $stmt->bindParam(':user2', $user2, PDO::PARAM_STR);
         $stmt->execute();
        }
    }
    public function countInvitations($pdo, $username)
    {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM relationships r 
                                WHERE (user1Login = :username OR user2Login = :username)
                                AND relationshipStatus = 1
                                AND actionUserLogin != :username');
        $stmt->bindParam(':username', $username,PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        echo $row['COUNT(*)'];      
    }
    //MAILING
    public function loginToLoginMd5($pdo, $userID)
    {
        $stmt = $pdo->prepare('SELECT loginmd5 FROM users WHERE login= :login;');
        $stmt->bindParam(':login', $userID ,PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(); 
        return $row["loginmd5"];
    }
    public function sendMail($pdo,$userID)
    {
        if(isset ($_POST['adresat']))
        {
        
        $stmt = $pdo->prepare('SELECT loginmd5 FROM users WHERE login= :login;');
        $stmt->bindParam(':login',$_POST['adresat'],PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(); 
        $stmt -> closeCursor();
        if(isset($row['loginmd5']))
        {
        $insertSTMT = $pdo->prepare("INSERT INTO mails(sender,receiver,topic,content) 
                            values(:sender, :receiver, :topic, :content)");
        $insertSTMT->bindParam(':sender', $userID);
        $insertSTMT->bindParam(':receiver',$row['loginmd5']);
        $insertSTMT->bindParam(':topic', $_POST['mailTopic']);
        $insertSTMT->bindParam(':content', $_POST['mailContent']);
        $insertSTMT->execute();
        }
        else
        {
            echo "<script>alert('Podany użytkownik nie istnieje. Spróbuj ponownie ;)')</script>";
        }
        }
    }

    public function receivedMails($pdo, $userID)
    {
        $stmt = $pdo->prepare('SELECT m.sender,m.receiver,m.topic,m.content FROM mails m
        WHERE receiver = :receiver;');
        $stmt->bindParam(':receiver',$userID,PDO::PARAM_STR);
        $stmt->execute(); 
        $counter = 0;
        foreach($stmt as $row)
        {
            $pane = new panel();

            $stmtA =  $pdo->prepare('SELECT login FROM users WHERE loginmd5 = :loginmd5;');
            $stmtA->bindParam(':loginmd5',$row['sender'],PDO::PARAM_STR);
            $stmtA->execute();
            $rowA = $stmtA->fetch();
            
            echo '
            <tr>
                    <td><a href=otherUserPanel.php?username='.$rowA['login'].'>
                    <div class="round-img">';
                        $pane->getUserAvatar($pdo,$rowA['login']);
                    echo '</div>
                    </td>
                    <td>
                    <a href=otherUserPanel.php?username='.$rowA['login'].'>  '.$rowA['login'].' </a>
                    </td>
                    <td>    
                            <span>'.$row['topic'].'</span>   
                    </td>
                    <td>
                    <center> 
                    <form id="end-'.$row['topic'].'" method="POST">
                    <input name="delMail" type="hidden" value="'.$row['topic'].'">
                    </form> 
                        <a href="javascript:;" data-toggle="modal" data-target="#'.$row['topic'].'">          
                        <button type="submit" class="btn btn-info btn-xs m-b-10 m-l-5">Wyświetl</button> 
                        </a>     
                                      
                        <button form="end-'.$row['topic'].'" type="submit" class="btn btn-danger btn-xs m-b-10 m-l-5">
                        Usuń</button>
                             
                   </center>

                    </td>
                    
                </tr>
                
                
                <div class="modal" id="'.$row['topic'].'"  role="dialog"  aria-hidden="true">
                <div style = "max-width: 850px;" class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="#'.$row['topic'].'">Nadawca wiadomości: '.$rowA['login'].'</h3>
                        </div>
                        <div class="modal-body">
                        <div class="jumbotron">
                        <h5 class="display-7">'.$row['topic'].'</h5>
                        <hr class="my-4">
                        <p class="lead">'.$row['content'].'</p>
                        <hr class="my-4">
                      
                        </div>
                            
                            <button style = "float:right;" type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                         
                        </div>
                    </div>
                </div>
          </div>
          ';
        } 
    }

    public function delReceivedMails($pdo,$userID)
    {
        if(isset($_POST['delMail']))
        {
            $stmt = $pdo->prepare('DELETE FROM mails WHERE receiver = :receiver AND topic = :topic;');                 
            $stmt->bindParam(':topic', $_POST['delMail']);
            $stmt->bindParam(':receiver', $userID);
            $stmt->execute();
        } 
    }
    public function countReceivedMails($pdo, $userID)
    {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM mails 
        WHERE receiver = :userID ');
        $stmt->bindParam(':userID', $userID,PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        echo $row['COUNT(*)']; 
    }

    public function countMailsReturn($pdo, $userID)
    {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM mails 
        WHERE receiver = :userID ');
        $stmt->bindParam(':userID', $userID,PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['COUNT(*)']; 
    }

    public function showMailsRounded($pdo,$userID)
    {
        $pane = new panel();
        $stmt = $pdo->prepare('SELECT m.sender,m.receiver,m.topic,m.content FROM mails m
        WHERE receiver = :receiver;');
        $stmt->bindParam(':receiver',$userID,PDO::PARAM_STR);
        $stmt->execute(); 
        $counter = 0;
        
        if($pane->countMailsReturn($pdo,$userID)>0)
        {
        echo '
        <div class="drop-title">
                                 
        Liczba wiadomości: 
        <span class="label label-rouded label-danger pull-right">';
        
                $pane->countReceivedMails($pdo, $userID); 
         echo '
        </span>
       
        </div>
    </li>
    <li>
        <div class="message-center">';
        foreach($stmt as $row)
        {
           

            $stmtA =  $pdo->prepare('SELECT login FROM users WHERE loginmd5 = :loginmd5;');
            $stmtA->bindParam(':loginmd5',$row['sender'],PDO::PARAM_STR);
            $stmtA->execute();
            $rowA = $stmtA->fetch();
            
            echo '
            <a href=otherUserPanel.php?username='.$rowA['login'].'>
            <div class="user-img round-img">';
            $pane->getUserAvatar($pdo,$rowA['login']);
            echo '
            </div>
            <div class="mail-contnet">
                <h5>'.$rowA['login'].'</h5>
                <span class="mail-desc">'.$row['topic'].'</span>   
            </div>
        </a>
                                    
            ';
          
        } 
        echo '
        </div>
        </li>
        <li>
            <a class="nav-link text-center" href="emailInbox.php">
                <strong>Zobacz wszystkie wiadomości</strong>
                <i class="fa fa-angle-right"></i>
            </a>';
        }
        else
        {
            echo'
            <div class="drop-title">
                                 
        Brak wiadomości w skrzynce odbiorczej!

       
        </div>
    </li>
    
      ';
        }
    }
    public function showUsernamesbyLetter($pdo,$word){
        $stmt = $pdo->prepare('SELECT login FROM users WHERE login LIKE ? ');
        $params = Array("$word%");
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);  
        echo($json);
    }



}
?>
