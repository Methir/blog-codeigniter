<?php $this->load->view('commons/header')?>

    <!-- Page Content -->

<div class="container">
    <div class="row">
        <div class="col-sm-4">    
            <div class="page-header">
                <h1>Novo Post</h1>
            </div>
        </div>
        <div class="col-sm-8">    
            <?php $this->load->view('commons/alertBox')?>
        </div>
    </div>
<!-- Começo row-->
<div class="row">
<!-- Começo col-sm-8-->
<div class="col-sm-8">

<!-- Inicio do formulario de postagem-->
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?= base_url('new-post') ?>">

<div class="form-group">
    <label class="col-md-2 control-label" for="titulo">Titulo</label>
        <div class="col-md-8">
            <input name="titulo_post" placeholder="Titulo" class="form-control input-md" required="" type="text" value="<?=set_value('titulo_post')?>" >
        </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label" for="autor">Autor</label>
        <div class="col-md-8">
            <input name="autor_post" placeholder="Autor" class="form-control input-md" required="" type="text" 
            value="<?= $this->session->userdata('nome'); ?>" readonly>
        </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label" for="Texto">Texto</label>
        <div class="col-md-8">
            <textarea class="form-control" name="texto_post" rows="10"><?=set_value('texto_post')?></textarea>
        </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="Texto">Categoria</label>
        <div class="col-md-8">
            <select class="form-control" name="categoria_post">
              <option>projeto</option>
              <option>registro</option>
              <option>extras</option>
              <option>especiais</option>
              <option>personagens</option>
              <option>nenhuma</option>
            </select>
        </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label" for="Imagem">Imagem</label>
        <div class="col-md-8">
            <input name="imagem" aria-describedby="resohelp" placeholder="Imagem" class="input-file" required="" type="file" value="<?=set_value('imagem')?>" >
            <span id="resohelp" class="help-block">Resolucão ideal de imagem para postagem: 900x300</span>
        </div>
</div>

<div class="form-group">
    <div class="col-md-10">
        <input type="submit" value="Enviar" class="btn btn-default pull-right"/>
    </div>
</div>

</form>
<!-- fim do formulario de postagem -->
</div>
<!-- Fim col-md-8 -->


<?php $this->load->view('commons/perfilbar')?>
<?php $this->load->view('commons/footer')?>
</body>
</html>