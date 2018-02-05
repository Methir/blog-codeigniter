<!-- Começo col-md-4-->
<div class="col-sm-4 hidden-xs">
<div class="col-sm-12">
    <h4>Bem Vindo!</h4>
    <hr/>
    <h4>Perfil</h4>
</div>
<div class="col-sm-6">
        <a data-toggle="modal" data-target="#imgPerfil"><img class="img-thumbnail" src="<?=base_url('img/user/') . $this->session->userdata('imagem') ?>" alt=""></a>
</div>
<div class="col-sm-6">
    <h4>Nível: <?= $nivel = array('aprendiz', 'mestre', 'archmago', 'merlin')[$this->session->userdata('autoridade')]; ?> </h4>
    <hr/>
    <p><?= $this->session->userdata('nome'); ?></p>
</div>
<div class="col-sm-12">
  <h4>Minha Descrição</h4>
    <div class="well" data-toggle="modal" data-target="#descricaoPerfil">
      <?=$this->session->userdata('descricao');?>
    </div>
</div>

</div>
<!-- Fim col-md-4 -->
</div>
<!-- Fim Row-->
<!-- Modal controle de descricao -->
<div class="modal fade" id="descricaoPerfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog ezCustTrans">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Pode editar sua descrição</h4>
      </div>
      <div class="modal-body">
      <div class="container">
        <div class="row">
          <form class="form-horizontal" method="POST" action="<?= base_url('descricao-perfil');?>">
            <div class="form-group">
            <label class="col-sm-2 control-label" for="Imagem"><img src="<?=base_url('img/user/') . $this->session->userdata('imagem')?>" alt=""></label>
              <div class="col-sm-3">
                <input type="hidden" name="id_user" value="<?=$this->session->userdata('id');?>">
                    <textarea class="form-control" id="texto" name="descricao_user" rows="5"><?=$this->session->userdata('descricao');?></textarea>
                    <span class="help-block">Número máximo de caracteres: 250 / Não aceita quebra de linha</span>
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

<!-- Modal Controle de Imagem-->
<div class="modal fade" id="imgPerfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog ezCustTrans">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Selecione uma nova imagem para perfil</h4>
      </div>
      <div class="modal-body">
      <div class="container">
        <div class="row">
            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?= base_url('img-perfil') ?>">
            <div class="form-group">
                <label class="col-md-2 control-label" for="Imagem"><img src="<?=base_url('img/user/') . $this->session->userdata('imagem')?>" alt=""></label>
                    <div class="col-md-8">
                        <input id="imagem" name="imagem" placeholder="Imagem" class="input-file" required="" type="file" value="<?=set_value('imagem')?>" >
                        <span class="help-block">Resolucão ideal de imagem para perfil: 100x100 </span>
                    </div>
            </div>
 
      </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" value="Salvar" class="btn btn-info"/>
        </form>
      </div>
    </div>
  </div>
</div>

