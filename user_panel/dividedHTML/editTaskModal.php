<div class="modal" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Edytuj zadanie: Jakieś tam zadanie</h3>
            </div>
            <div class="modal-body">
                <form>
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
                    <button type="button" class="btn btn-primary"> Zapisz</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                </form>
            </div>
        </div>
    </div>
</div>