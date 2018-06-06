<?php
    require('dividedHTML/head-section.php');
    require('dividedHTML/header.php');
    require('dividedHTML/left-sidebar.php');
    $pane->addPrivateNote($pdo,$_SESSION['userID']);
    $pane->delUserPrivateNote($pdo,$_SESSION['userID']);
    $pane->editUserPrivateNote($pdo,$_SESSION['userID']);
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
                            <h2>Twoje prywatne notatki </h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tytuł</th>
                                            <th>Data dodania</th>
                                            <th>
                                                <center>Akcje</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $pane->showUserPrivateNotes($pdo,$_SESSION['userID']) ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br/>
                        <a href="javascript:;" data-toggle="modal" data-target="#addPrivateNoteModal">
                            <button type="button" class="btn btn-primary btn-flat btn-addon m-b-10 m-l-5">
                                <i class="ti-plus"></i>Dodaj notatkę</button>
                        </a>
                    </div>
                    <!-- /# card -->
                </div>
                <!-- /# column -->

        
        <?php
    require('dividedHTML/showPrivateNoteModal.php');
    require('dividedHTML/addPrivateNoteModal.php');
    require('dividedHTML/footer.php');
?>