<?php
    require('dividedHTML/head-section.php');
    require('dividedHTML/header.php');
    require('dividedHTML/left-sidebar.php');
    $pane->changeGroupData($pdo, $_GET['groupName']);
    $pane->addUserToGroup($pdo, $_GET['groupName']);
    $pane->sendMail($pdo,$_SESSION['userID']);
    $pane->deleteFromGroup($pdo, $_GET['groupName']);
    $pane->addTaskToGroup($pdo);
    $pane->delgroupTask($pdo);
    $pane->editgroupTask($pdo);
    $pane->endgroupTask($pdo);
?>

    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Panel grupy
                    <?php echo $_GET['groupName'];?>
                </h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="groups.php">GRUPY</a>
                    </li>
                    <li class="breadcrumb-item active">Profil grupy
                        <?php echo $_GET['groupName'];?>
                    </li>
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
                            <div class="card-two">

                                <center>
                                    <h1>
                                        <?php echo $_GET['groupName'];?>
                                    </h1>
                                </center>
                                <hr/>
                                <div class="desc">
                                    <?php $pane->getGroupData($pdo, $_GET['groupName'], 'GroupDescription'); ?>
                                </div>

                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->

            <!-- Column -->
            <div class="col-lg-12">
                <div class="card">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs profile-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#members" role="tab">Członkowie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tasks" role="tab">Zadania</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Ustawienia</a>
                        </li>

                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="members" role="tabpanel">
                            <div class="card-body">
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
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  $pane->showGroupUsers($pdo, $_GET['groupName']); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <br/>
                                <a href="javascript:;" data-toggle="modal" data-target="#addUserToGroupModal">
                                    <button type="button" class="btn btn-primary btn-flat btn-addon m-b-10 m-l-5">
                                        <i class="ti-plus"></i>Dodaj użytkownika</button>
                                </a>
                            </div>
                        </div>

                        <div class="tab-pane" id="tasks" role="tabpanel">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                       
                                        <tbody>
                                            <?php $pane->showGroupTasks($pdo); ?> 
                                        </tbody>
                                    </table>
                                </div>
                                <a href="javascript:;" data-toggle="modal" data-target="#addTaskModal">
                                    <button type="button" class="btn btn-primary btn-flat btn-addon m-b-10 m-l-5" data-toggle="modal" data-target="#addTaskToGroupModal">
                                        <i class="ti-plus"></i>Dodaj zadanie</button>
                                </a>
                            </div>
                        </div>

                        <div class="tab-pane" id="settings" role="tabpanel">
                            <div class="card-body">
                            <br/>
                                <form method="POST" class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12">Nazwa grupy</label>
                                        <div class="col-md-12">
                                            <input name="groupName" type="text" value="<?php echo $_GET['groupName'];?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                            <div class="form-group">
                                <label class="col-md-12">Opis</label>
                                <div class="col-md-12">
                                    <input name="description" type=text value="<?php $pane->getGroupData($pdo,$_GET['groupName'] , 'GroupDescription'); ?>" class="form-control form-control-line"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Zwiększ limit użytwkowników</label>
                                <div class="col-md-12">
                                    <input name="count" type=number value="<?php $pane->getGroupData($pdo,$_GET['groupName'] , 'Max_count'); ?>" class="form-control form-control-line"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="submit" value="Zapisz" class="btn btn-info"/>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    <div class="modal" tabindex="-1" role="dialog" aria-labelledby="sendMail" aria-hidden="true" id="sendMail">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" novalidate="novalidate">
                    <div class="modal-header">
                        <h3 class="modal-title">Wyślij wiadomość</h3>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="form-group">
                                <input type="hidden" placeholder="Tutaj wpisz login osoby, z którą chcesz się skontaktować"  class="form-control" name="adresat" id="groupName">
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
            <?php
    require('dividedHTML/footer.php');
    require('dividedHTML/deleteTaskConfirmModal.php');
    require('dividedHTML/editTaskModal.php');
    require('dividedHTML/deleteUserConfirmModal.php');
    require('dividedHTML/sendMessageModal.php');
    require('dividedHTML/addTaskToGroup.php');
    require('dividedHTML/addUserToGroupModal.php');
    
?>