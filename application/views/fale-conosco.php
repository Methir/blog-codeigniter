<?php $this->load->view('commons/header')?>

    <!-- Page Content -->

<div class="container">
    <div class="row">
        <div class="col-sm-4">    
            <div class="page-header">
                <h1>Fale Conosco</h1>
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
<form class="form-horizontal" method="POST" action="<?= base_url('fale-conosco') ?>">

<div class="form-group">
    <label class="col-md-2 control-label" for="nome">Nome</label>
        <div class="col-md-8">
            <input name="nome_email" placeholder="Nome" class="form-control input-md" required="" type="text" 
            value="<?= $this->session->userdata('nome'); ?>" readonly>
        </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label" for="email">Email</label>
        <div class="col-md-8">
            <input name="endereco_email" placeholder="Email" class="form-control input-md" required="" type="text" 
            value="<?= $this->session->userdata('email'); ?>" readonly>
        </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label" for="Assunto">Assunto</label>
        <div class="col-md-8">
            <input name="assunto_email" placeholder="Assunto" class="form-control input-md" required="" type="text" value="<?=set_value('assunto_email')?>" >
        </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label" for="Mensagem">Mensagem</label>
        <div class="col-md-8">
            <textarea class="form-control" placeholder="Mensagem" name="texto_email" rows="10"><?=set_value('texto_email')?></textarea>
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