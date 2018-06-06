<div class="modal" tabindex="-1" role="dialog" aria-labelledby="createGroupModal" aria-hidden="true" id="createGroupModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" novalidate="novalidate">
                    <div class="modal-header">
                        <h3 class="modal-title">Utwórz grupę</h3>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="form-group">
                                <label for="groupName">
                                    Nazwa grupy </label>
                                <input type="text" data-val="true" data-val-required="Wpisz nazwę grupy" class="form-control" name="groupName" id="groupName"
                                />
                                <label for="groupSize">
                                    Liczba użytkowników </label>
                                <input  required class="form-control" name="groupSize" max="20"type="number"/>
                                <span class="field-validation-valid text-danger" data-valmsg-for="groupName" data-valmsg-replace="true"></span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Dodaj"/>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                    </div>
                </form>
            </div>
        </div>
    </div>