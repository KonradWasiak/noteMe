<?php
    require('dividedHTML/head-section.php');
    require('dividedHTML/header.php');
    require('dividedHTML/left-sidebar.php');
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
                    <li class="breadcrumb-item active">Data: 2018-05-30</li>
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
                            <h2>Zadania z 2018-05-30 </h2>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nazwa</th>
                                            <th>Grupa</th>
                                            <th>Deadline</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <a href="task.php">Przykładowe zadanie z bazy</a>
                                            </td>
                                            <td>
                                                <a href="group.php">
                                                    <span>IP20</span>
                                            </td>
                                            <td>
                                                <a href="date.php">
                                                    <span>2018-05-30</span>
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge badge-success">Skończone</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2
                                            </td>
                                            <td>
                                                <a href="task.php">Następne jakieś zadanie</a>
                                            </td>
                                            <td>
                                                <a href="group.php">
                                                    <span>IP20</span>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="date.php">
                                                    <span>2018-05-30</span>
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge badge-success">Done</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br/>
                        <a href="javascript:;" data-toggle="modal" data-target="#addTaskToDateModal">
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
    require('dividedHTML/addTaskToDateModal.php');
    require('dividedHTML/footer.php');
?>