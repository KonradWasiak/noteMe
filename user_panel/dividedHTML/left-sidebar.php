  <!-- Left Sidebar  -->
  <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Menu główne</li>
                        <li>
                            <a  class="has-arrow" href="userpanel.php">
                                <i class="fa fa-tachometer"></i>
                                <span class="hide-menu">Strona główna </a>
                        </li>
                        <li>
                            <a href="emailInbox.php"  class="has-arrow" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                <span class="hide-menu">Wiadomości
                                         <span class="label label-rouded label-danger pull-right">
                                            <?php 
                                                $pane->countReceivedMails($pdo, $_SESSION['userID']); 
                                            ?>
                                        </span>
                                </span>
                            </a>
                            <li>
                                <a href="app-profile.php"  class="has-arrow" aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                    <span class="hide-menu">Twój profil</span>
                                </a>
                            </li>
                            <li>
                                <a href="groups.php"  class="has-arrow" aria-expanded="false">
                                    <i class="fa fa-table"></i>
                                    <span class="hide-menu">Grupy</span>
                                </a>
                            </li>
                            <li>
                                <a href="tasks.php"  class="has-arrow" aria-expanded="false">
                                    <i class="fa fa-wpforms"></i>
                                    <span class="hide-menu">Zadania</span>
                                </a>
                            </li>
                            <li>
                                <a href="userPrivateNotes.php"  class="has-arrow" aria-expanded="false">
                                    <i class="fa fa-book"></i>
                                    <span class="hide-menu">Notatki</span>
                                </a>
                            </li>    
                            <li>
                                <a href="society.php" class="has-arrow" aria-expanded="false">
                                <i class="fa fa-th-large"></i>
                                    <span class="hide-menu">Społeczność
                                        <span class="label label-rouded label-danger pull-right">
                                            <?php 
                                                $login= substr($_SESSION['userID'], 0, -5); 
                                                $pane->countInvitations($pdo, $login); 
                                            ?>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="./logout.php" class="has-arrow" aria-expanded="false">
                                    <i class="fa fa-level-down"></i>
                                    <span class="hide-menu">Wyloguj</span>
                                </a>
                            </li>

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->