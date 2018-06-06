<?php
    require('dividedHTML/head-section.php');
    require('dividedHTML/header.php');
    require('dividedHTML/left-sidebar.php');
    $pane->addTask($pdo,$_SESSION['userID']);
    $pane->endTask($pdo,$_SESSION['userID']);
    $pane->delTask($pdo,$_SESSION['userID']);
?>

    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Twoje wszystkie zadania</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Zadania</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title">
                            <h2>Lista zadań <?php $pane->editTask($pdo,$_SESSION['userID']); ?></h2>
                           
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php  $pane->showTasks($pdo,$_SESSION['userID']);?>
                            </div>
                        </div>
                        <br/>
                        <a href="javascript:;" data-toggle="modal" data-target="#addTaskModal">
                            <button type="button" class="btn btn-primary btn-flat btn-addon m-b-10 m-l-5">
                                <i class="ti-plus"></i>Dodaj zadanie</button>
                        </a>
                    </div>
                    <!-- /# card -->
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
            <!-- End PAge Content -->
        <?php
    require('dividedHTML/deleteTaskConfirmModal.php');
    require('dividedHTML/editTaskModal.php');
    require('dividedHTML/addTaskModal.php');
    require('dividedHTML/footer.php');
?>