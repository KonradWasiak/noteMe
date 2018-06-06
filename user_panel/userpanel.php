<?php
    require('dividedHTML/head-section.php');
    require('dividedHTML/header.php');
    require('dividedHTML/left-sidebar.php');
    $pane->addTask($pdo,$_SESSION['userID']);
    $pane->endTask($pdo,$_SESSION['userID']);
    $pane->delTask($pdo,$_SESSION['userID']);
?>
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Zalogowany jako: <?php $pane->getUserData($pdo,$_SESSION['userID'],'login');?></h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Panel użytkownika</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card p-30">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <img src="images/list.png" />
                            </div>
                            <div class="media-body media-text-right">
                                <h2><?php $pane->countAllTasks($pdo, $_SESSION['userID']); ?></h2>
                                <p class="m-b-0">Twoje zadania</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-30">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <img src="images/hourglass.png" />
                            </div>
                            <div class="media-body media-text-right">
                                <h2><?php $pane->countWaitingTasks($pdo, $_SESSION['userID']); ?></h2>
                                <p class="m-b-0">Oczekujące</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-30">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <img src="images/goal.png" />
                            </div>
                            <div class="media-body media-text-right">
                                <h2><?php $pane->countFinishedTasks($pdo, $_SESSION['userID']) ?></h2>
                                <p class="m-b-0">Zakończone</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-30">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <img src="images/notepad.png" />
                            </div>
                            <div class="media-body media-text-right">
                                <h2><?php $pane->countUserPrivateNotes($pdo, $_SESSION['userID']) ?></h2>
                                <p class="m-b-0">Notatki</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4>Twoje ostatnie zadania <?php $pane->editTask($pdo,$_SESSION['userID']); ?> </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <?php  $pane->showTasks($pdo,$_SESSION['userID']);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-11">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-5">
                        <div class="card" >
                            <div class="card-title">
                                <h4>Zadania na dany dzień</h4>
                            </div>
                            <div class="recent-comment" id="calendarTable">                               
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="year-calendar"></div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>


        </div>

        <?php
    require('dividedHTML/footer.php');
?>