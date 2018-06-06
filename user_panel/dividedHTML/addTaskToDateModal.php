<div class="modal" tabindex="-1" role="dialog" aria-labelledby="addTaskToDateModal" aria-hidden="true" id="addTaskToDateModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="javascript:;" novalidate="novalidate">
                    <div class="modal-header">
                        <h5 class="modal-title">Dodaj zadanie do daty: 2018-05-30</h5>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="form-group">
                                <label for="taskName">
                                    Nazwa zadania
                                </label>
                                <input type="text" data-val="true" data-val-required="Wpisz nazwę zadania" class="form-control" name="oldPass" id="oldPass"
                                />
                                <span class="field-validation-valid text-danger" data-valmsg-for="oldPass" data-valmsg-replace="true"></span>
                            </div>
                            <div class="form-group">
                                <label for="taskDescription">
                                    Opis
                                </label>
                                <input type="text" data-val="false" data-val-required="this is Required Field" class="form-control" name="newPass" id="newPass"
                                />
                                <span class="field-validation-valid text-danger" data-valmsg-for="newPass" data-valmsg-replace="true"></span>

                            </div>
                            <div class="form-group">
                                <label for="chooseGroup">
                                    Wybier grupę
                                </label>
                                <select name="chooseGroup" class="form-control">
                                    <option>IP20</option>
                                    <option>GRUPA2</option>
                                    <option>Jakaś grupa</option>
                                    <option>xD</option>
                                </select>
                            </div>

                         <div class="form-group">
                                <label for="chooseUsers">
                                    Wybier użytkowników
                                </label>
                                <br/>
                                <input type="checkbox" name="userName" value="userName"> user1<br>
                                <input type="checkbox" name="userName" value="userName"> username13<br>
                                <input type="checkbox" name="userName" value="userName"> user666<br>
                                <input type="checkbox" name="userName" value="userName"> username123<br>
                                <input type="checkbox" name="userName" value="userName"> AdamMickiewicz<br>
                                <br/>
                                <input type="checkbox" name="selectAllUsers" value="selectedAllUsers"><strong>Wybierz wszystkich</strong><br>

                            </div>
                            

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Dodaj</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                    </div>
                </form>
            </div>
        </div>
    </div>