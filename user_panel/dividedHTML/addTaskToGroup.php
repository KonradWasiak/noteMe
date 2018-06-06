<div class="modal" tabindex="-1" role="dialog" aria-labelledby="addTaskToGroup" aria-hidden="true" id="addTaskToGroupModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" novalidate="novalidate">
                    <div class="modal-header">
                        <h3 class="modal-title">Dodaj zadanie</h3>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="form-group">
                                <label for="taskName">
                                    Nazwa zadania
                                </label>
                                <input type="text" data-val="true" data-val-required="Wpisz nazwę zadania" class="form-control" name="taskName" id="oldPass"
                                />
                                <span class="field-validation-valid text-danger" data-valmsg-for="oldPass" data-valmsg-replace="true"></span>
                            </div>
                            <div class="form-group">
                                <label for="taskDescription">
                                    Opis
                                </label>
                                <input type="text" data-val="false" data-val-required="this is Required Field" class="form-control" name="taskDescription" id="newPass"
                                />
                                <span class="field-validation-valid text-danger" data-valmsg-for="newPass" data-valmsg-replace="true"></span>

                            </div>
                            <div class="form-group">
                                <label for="taskDeadline">
                                    Deadline zadania
                                </label>
                                <div class='input-group date' id='datetimepicker2'>
                                    <input type="date" class="form-control" placeholder="dd/mm/yyyy" name="taskExpiry">
                                </div>
                                <span class="field-validation-valid text-danger" data-valmsg-for="confirmPass" data-valmsg-replace="true"></span>

                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="groupTaskSend" class="btn btn-primary">Dodaj</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                    </div>
                </form>
            </div>
        </div>
    </div>