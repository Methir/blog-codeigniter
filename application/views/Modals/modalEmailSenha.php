<!-- Modal Perfil User -->
<div class="modal fade" id="esqueceuSenhaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog ezCustTrans">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Escreva o email da sua conta</h4>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('esqueci-minha-senha');?>" method="POST" >
          <div class="form-group">
            <label class="text-muted">Email:</label>
            <input type="text" class="form-control" placeholder="Email" name="email_user" required/>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-info" value="Enviar"/>
        </form>
      </div>
    </div>
  </div>
</div>