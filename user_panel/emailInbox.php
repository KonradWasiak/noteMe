<?php
    require('dividedHTML/head-section.php');
    require('dividedHTML/header.php');
    require('dividedHTML/left-sidebar.php');
    $pane->delReceivedMails($pdo,$_SESSION['userID']);
?>
<script src="./controllers/getUsersByLetter/messages.js"></script>
<div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Skrzynka odbiorcza</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Skrzynka odbiorcza</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title">
                        <h2>Twoje wiadomości  <?php $pane->sendMail($pdo,$_SESSION['userID']); ?></h2>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> </th>
                                            <th>Nadawca</th>
                                            <th>Temat</th>
                                            <th>
                                                <center>Akcje</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $pane->receivedMails($pdo,$_SESSION['userID']); ?>
                                    </tbody>
                                </table>
                            </div>
                            <br/>
                            <a href="javascript:;" data-toggle="modal" data-target="#sendMail">
                                <button style="margin:auto;text-align:center;" type="button" class="btn btn-primary btn-flat btn-addon m-b-10 m-l-5">
                                    <i class="ti-plane"></i>Wyślij wiadomość</button>
                            </a>
                        </div>
                    </div>
                    <!-- /# card -->
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
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
                                <label for="groupName">
                                    Adresat </label>
                                <input type="text" placeholder="Tutaj wpisz login osoby, z którą chcesz się skontaktować"  class="form-control" name="adresat" id="groupName"
                                />
                                <div id="userlistbox"><p>Lista Użytkowników:</p><div id="userlist"></div> </div>
                                <label for="mailTopic">
                                    Temat </label>
                                <input type="text" placeholder="Temat wiadomości" class="form-control" name="mailTopic" id="mailTopic"/>
                                <label for="mailContent">
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
?>