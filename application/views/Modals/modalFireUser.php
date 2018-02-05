<!-- Modal Fire ball -->
<div class="modal fade" id="fireBallModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog ezCustTrans">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="titleModalFire">Tivemos um problema com nossa reserva de mana, tente novamente mais tarde quando ela estiver cheia!</h4>
      </div>
      <div class="modal-body">
      <div class="container">
        <div class="row">
          <img class="img-responsive" src="<?=base_url('img/') . 'redBro.png' ?>" alt="Fire Ball">
            <form class="form-horizontal" method="POST" action="<?= base_url('fireBall');?>">
            <input id="inputFire" type="hidden" name="id_user" value="">
      </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" value="Conjurar Fire Ball" class="btn btn-danger"/>
        </form>
      </div>
    </div>
  </div>
</div>