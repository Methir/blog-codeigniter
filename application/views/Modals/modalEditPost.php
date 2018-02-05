<!-- Modal Editar Post -->
<div class="modal fade" id="textEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog ezCustTrans">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Pode editar seu texto</h4>
      </div>
      <div class="modal-body">
      <div class="container">
        <div class="row">
        <div class="col-md-5">
            <form class="form-horizontal" method="POST" action="<?= base_url('control-post');?>">
                <input type="hidden" name="id_post" value="<?= $postagem[0]->id_post ?>">
                <div class="form-group">
                    <textarea class="form-control" id="texto" name="texto_post" rows="10"><?= $postagem[0]->texto_post ?></textarea>
                </div>
            </div>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" value="Editar" class="btn btn-info"/>
        </form>
      </div>
    </div>
  </div>
</div>