<!-- Modal Controle de nivel -->
<div class="modal fade" id="nivelControlModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog ezCustTrans">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title titleModalNivel" id="titleModalNivel">Tivemos um problema com nossa reserva de mana, tente novamente mais tarde quando ela estiver cheia!</h4>
      </div>
      <div class="modal-body">
      <div class="container">
        <div class="row">
            <form class="form-horizontal" method="POST" action="<?= base_url('nivelControl');?>">
              <input id="inputNivel" type="hidden" name="id_user" value="">
                <input id="inputNivelAutoridade" type="hidden" name="autoridade_user" value="">
              <div class="radio">
            <label>
            <input id="radioUp" type="radio" name="level" value="up">
              Level Up
            </label>
          </div>

          <div class="radio">
            <label>
             <input id="radioDown" type="radio" name="level" value="down">
                Level Down
             </label>
          </div>
    </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" value="Mudar Nível" class="btn btn-warning"/>
        </form>
      </div>
    </div>
  </div>
</div>