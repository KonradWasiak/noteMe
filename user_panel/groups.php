<?php
    require('dividedHTML/head-section.php');
    require('dividedHTML/header.php');
    require('dividedHTML/left-sidebar.php');
    if(isset($_POST["groupName"]))
    $pane->addGroup($pdo,$_SESSION['userID'], $_POST["groupName"]);
    $pane->deleteGroup($pdo,$_SESSION['userID']);
    $pane->leaveGroup($pdo);

?>

    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Grupy do których należysz</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Twoje grupy</li>
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
                            <h2>Twoje grupy </h2>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nazwa</th>
                                            <th>Użytkownicy</th>
                                            <th>
                                                <center>Akcje</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $pane->showGroups($pdo,$_SESSION['userID']);?>
                                    </tbody>
                                </table>
                            </div>
                            <br/>
                            <a href="javascript:;" data-toggle="modal" data-target="#createGroupModal">
                                <button type="button" class="btn btn-primary btn-flat btn-addon m-b-10 m-l-5">
                                    <i class="ti-plus"></i>Stwórz grupę</button>
                            </a>
                        </div>
                    </div>
                    <!-- /# card -->
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->

<?php
    require('dividedHTML/deleteGroupConfirmModal.php');
    require('dividedHTML/createGroupModal.php');
    require('dividedHTML/footer.php');
?>