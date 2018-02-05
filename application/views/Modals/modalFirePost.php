<!-- Modal Fire ball -->
<div class="modal fade" id="fireBallModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog ezCustTrans">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="titleModalFire">Tem certeza que quer apagar essa postagem?</h4>
      </div>
      <div class="modal-body">
      <div class="container">
        <div class="row">
            <img class="img-responsive" src="<?=base_url('img/') . 'redBro.png' ?>" alt="Fire Ball">
            <form class="form-horizontal" method="POST" action="<?= base_url('delete-post');?>">
            <input id="inputFire" type="hidden" name="id_post" value="<?=$postagem[0]->id_post?>">
            <input id="inputFire" type="hidden" name="img_post" value="<?=$postagem[0]->img_post?>">
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