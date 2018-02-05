<!-- Modal Perfil User -->
<div class="modal fade" id="perfilModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog ezCustTrans">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="titleModalPerfil">Dados do Usuário</h4>
      </div>
      <div class="modal-body">
            <div class="media">
              <img id="perfilImagem" class="media-object pull-left" src="<?=base_url('img/user/com/') . 'default.png' ?>" alt="">
                <div id="perfilInfo" class="media-body">
                  Se está lendo isso é por que seu javascript está desabilitado ou tivemos algum problema no servidor.
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>