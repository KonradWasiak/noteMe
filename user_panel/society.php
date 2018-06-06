<?php
    require('dividedHTML/head-section.php');
    require('dividedHTML/header.php');
    require('dividedHTML/left-sidebar.php');
    $login= substr($_SESSION['userID'], 0, -5); 
    if(isset($_POST["acceptInvitation"]))
    $pane->acceptInvitation($pdo, $login, $_POST["acceptInvitation"]);
    
    if(isset($_POST["ignoreInvitation"]))
    $pane->ignoreInvitation($pdo, $login, $_POST["ignoreInvitation"]);

    if(isset($_POST["deleteSentInvitation"]))
    $pane->deleteSentInvitation($pdo, $login, $_POST["deleteSentInvitation"]);
    
    if(isset($_POST["removeFriend"]))
    $pane->removeFromFriends($pdo, $login, $_POST["removeFriend"]);
    if(isset($_POST["mailTo"]))
    $pane->sendMail($pdo, $_SESSION['userID']);

?>
<script src="./controllers/getUsersByLetter/society.js"></script>
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Społeczność</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Społeczność</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                <form>
                                    <div class="form-group">
                                        <h3>Znajdź użytkownika</h3>
                                        <div class="input-group input-group-default">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="ti-search"></i>
                                                </button>
                                            </span>
                                            <input type="text" placeholder="Nazwa użytkownika" name="search-user" id="groupName" class="form-control">
                                            <div id="userlistbox" style="width: 100%"><p>Lista Użytkowników:</p><div id="userlist"></div> </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Znajomości</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>Użytkownik</th>
                                        <th>
                                            <center>Akcje</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php   $pane->showFriends($pdo, $login) ?>
                                </tbody>
                            </table>
                        </div>
                        <br/>

                    </div>
                </div>
            </div>
            </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h3>Zaproszenia wysłane</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>Użytkownik</th>
                                        <th>
                                            <center>Akcje</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="showSentInvitations">
                               <?php $pane->showSentInvitations($pdo, $login) ?>

                                </tbody>
                            </table>
                        </div>
                        <br/>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h3>Zaproszenia otrzymane</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>Użytkownik</th>
                                        <th>
                                            <center>Akcje</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="showReceivedInvitations">
                                <?php $pane->showReceivedInvitations($pdo, $login) ?>

                                </tbody>
                            </table>
                        </div>
                        <br/>

                    </div>
                </div>
            </div>
            
        </div>
    </div>

<?php
    require('dividedHTML/footer.php');
?>