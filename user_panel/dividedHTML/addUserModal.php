<div class="modal" tabindex="-1" role="dialog" aria-labelledby="addUserModal" aria-hidden="true" id="addUserModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="addUserHandler.php" method="POST" novalidate="novalidate">
                    <div class="modal-header">
                        <h3 class="modal-title">Przypisz użytkownika do zadania</h3>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="form-group">
                                <label for="oldPass">
                                    Nazwa użytkownika </label>
                                <input type="text" data-val="true" data-val-required="Wpisz nazwę użytkownika" class="form-control" name="userName" id="userName"/>
                                <span class="field-validation-valid text-danger" data-valmsg-for="userName" data-valmsg-replace="true"></span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                    </div>
                </form>
            </div>
        </div>
    </div>