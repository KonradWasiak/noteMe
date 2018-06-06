<div class="modal" id="sendMessageModal" tabindex="-1" role="dialog" aria-labelledby="sendMessageModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Wyślij wiadomość do jakiśUser1</h3>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Odbiorca:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="topic" class="col-form-label">Temat:</label>
            <input type="text" class="form-control" id="topic">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Treść wiadomości:</label>
            <textarea style="height: 10em" rows="100" class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary"> Wyślij</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
      </div>
    </div>
  </div>
</div>