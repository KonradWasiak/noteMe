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
                    <h3 class="text-primary"><?php $pane->addTask($pdo,$_SESSION['userID']); ?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">Zadania</a>
                        </li>
                        <li class="breadcrumb-item active">Nazwa zadania . .. . </li>
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
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Zadanie</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#users" role="tab">Przypisani użytkownicy</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#edit" role="tab">Edycja</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!--second tab-->
                                <div class="tab-pane active" id="profile" role="tabpanel">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-6 b-r">
                                                <strong>Nazwa zadania</strong>
                                                <br>
                                                <p class="text-muted">Jakieś tam zadanie</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r">
                                                <strong>Grupa</strong>
                                                <br>
                                                <p class="text-muted">Zebra Theme@gmail.com</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6">
                                                <strong>Deadline</strong>
                                                <br>
                                                <p class="text-muted">2018-05-30</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <p class="m-t-30">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo,
                                            rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede
                                            mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi.
                                            Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat
                                            vitae, eleifend ac, enim.</p>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text ever since the 1500s, when
                                            an unknown printer took a galley of type and scrambled it to make a type specimen
                                            book. It has survived not only five centuries </p>
                                        <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem
                                            Ipsum passages, and more recently with desktop publishing software like Aldus
                                            PageMaker including versions of Lorem Ipsum.
                                        </p>

                                    </div>
                                    <button type="button" class="btn btn-success m-b-10 m-l-5">Zakończ zadanie</button>
                                </div>

                                <div class="tab-pane" id="users" role="tabpanel">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nazwa</th>
                                                    <th>Ilość zadań</th>
                                                    <th>
                                                        <center>Akcje</center>
                                                    </th>
                                                    <th>Status zadania</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="round-img">
                                                            <a href="">
                                                                <img src="images/avatar/4.jpg" alt="">
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>John Abraham</td>
                                                    <td>
                                                        <span>456 </span>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <button type="button" class="btn btn-info btn-xs m-b-10 m-l-5">Wiadomość</button>
                                                            <button type="button" class="btn btn-warning btn-xs m-b-10 m-l-5">Dodaj zadanie</button>
                                                            <button type="button" class="btn btn-danger btn-xs m-b-10 m-l-5">Usuń z grupy</button>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info">W trakcie</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="round-img">
                                                            <a href="">
                                                                <img src="images/avatar/4.jpg" alt="">
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>John Abraham</td>
                                                    <td>
                                                        <span>456 </span>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <button type="button" class="btn btn-info btn-xs m-b-10 m-l-5">Wiadomość</button>
                                                            <button type="button" class="btn btn-warning btn-xs m-b-10 m-l-5">Dodaj zadanie</button>
                                                            <button type="button" class="btn btn-danger btn-xs m-b-10 m-l-5">Usuń z grupy</button>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-success">Zakończone</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="round-img">
                                                            <a href="">
                                                                <img src="images/avatar/4.jpg" alt="">
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>John Abraham</td>
                                                    <td>
                                                        <span>456 </span>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <button type="button" class="btn btn-info btn-xs m-b-10 m-l-5">Wiadomość</button>
                                                            <button type="button" class="btn btn-warning btn-xs m-b-10 m-l-5">Dodaj zadanie</button>
                                                            <button type="button" class="btn btn-danger btn-xs m-b-10 m-l-5">Usuń z grupy</button>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info">W trakcie</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                        <br/>
                                        <a href="javascript:;" data-toggle="modal" data-target="#addUserModal">
                                            <button type="button" class="btn btn-primary btn-flat btn-addon m-b-10 m-l-5">
                                                <i class="ti-plus"></i>Dodaj użytkownika</button>
                                        </a>
                                        
                                    </div>

                                </div>

                                <div class="tab-pane" id="edit" role="tabpanel">
                                    <div class="card-body">
                                        <form class="form-horizontal form-material">
                                            <div class="form-group">
                                                <label class="col-md-12">Nazwa zadania</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Zadanie jakieś" class="form-control form-control-line" name="taskName">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="example-email" class="col-md-12">Opis</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Opis zadania..." class="form-control form-control-line" name="taskDescription" id="example-email">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Deadline</label>
                                                <div class="col-md-12">
                                                    <input type="date" class="form-control" placeholder="yyyy/mm/dd"> </div>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="submit" value="Zapisz" class="btn btn-success" />
                                        </div>
                                    </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>

<?php
require('dividedHTML/addUserModal.php');
    require('dividedHTML/footer.php');
    
?>
 