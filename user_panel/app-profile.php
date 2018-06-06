<?php
    require('dividedHTML/head-section.php');
    require('dividedHTML/header.php');
    require('dividedHTML/left-sidebar.php');
    $pane->changeUserData($pdo,$_SESSION['userID']);
?>
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Twój profil</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Profil użytkownika</li>
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
                                <header>
                                    <div class="avatar">
                                        <?php
                                        $login= substr($_SESSION['userID'], 0, -5); 
                                        $pane->getUserAvatar($pdo, $login);
                                         ?>
                                    </div>
                                </header>

                                <h3>
                                    <?php $pane->getUserData($pdo,$_SESSION['userID'],'login');?>
                                </h3>
                                <div class="desc">
                                    <?php $pane->getUserData($pdo,$_SESSION['userID'],'description');?>
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
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Ustawienia</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!--second tab-->
                        <div class="tab-pane active" id="profile" role="tabpanel">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-xs-6 b-r">
                                        <strong>Nazwa użytkownika</strong>
                                        <br>
                                        <p class="text-muted">
                                            <?php $pane->getUserData($pdo,$_SESSION['userID'],'login');?>
                                        </p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r">
                                        <strong>Email</strong>
                                        <br>
                                        <p class="text-muted">
                                            <?php $pane->getUserData($pdo,$_SESSION['userID'],'email');?>
                                        </p>
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <strong>Miejscowość</strong>
                                        <br>
                                        <p class="text-muted">
                                            <?php $pane->getUserData($pdo,$_SESSION['userID'],'town');?>
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <p class="m-t-30">
                                    <?php $pane->getUserData($pdo,$_SESSION['userID'],'description');?>
                                </p>

                            </div>
                        </div>

                        <div class="tab-pane" id="settings" role="tabpanel">
                            </br>
                            <div class="card-body">
                                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-md-12">Miejscowość</label>
                                        <div class="col-md-12">
                                            <input name="city" type="text" value="<?php $pane->getUserData($pdo,$_SESSION['userID'],'town');?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Hasło (podaj nowe)</label>
                                        <div class="col-md-12">
                                            <input name="password" placeholder="Wpisz nowe hasło" type="password" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Hasło (powtórz)</label>
                                        <div class="col-md-12">
                                            <input name="password2" placeholder="Powtórz hasło" type="password" class="form-control form-control-line">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Opis</label>
                                        <div class="col-md-12">
                                            <textarea name="description" rows="20" class="form-control form-control-line">
                                                <?php $pane->getUserData($pdo,$_SESSION['userID'],'description');?>
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Avatar</label>
                                        <div class="col-md-12">
                                            <input type="file" name="avatar">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="submit" class="btn btn-success"></input>
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
    require('dividedHTML/footer.php');
?>  