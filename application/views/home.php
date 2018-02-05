<?php $this->load->view('commons/header')?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-sm-8">

                    <?php if($mensagem = $this->session->flashdata('fail_msg')): ?>
                        <div class="alert alert-danger">
                            <?= $mensagem; ?>
                        </div>
                    <?php else:

                        if($mensagem = $this->session->flashdata('success_msg')) : ?>
                            <div class="alert alert-success">
                                <?=$mensagem; ?>
                            </div>

                    <?php endif; endif; ?>

                <h1 class="page-header">
                    Alika Project
                    <small>Campanha no Mundo de Alika</small>
                </h1>

                <!-- Blog Post -->
                <?php foreach($postagens as $post): ?>
                <h2>
                    <a href="<?=base_url('post/') . $post->id_post; ?>"><?= $post->titulo_post; ?></a>
                </h2>
                <p class="lead">
                    por <a href="<?=base_url('autor/') . url_title($post->autor_post); ?>"><?=$post->autor_post; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Postado em <?= $post->data_post; ?></p>
                <hr>
                <img class="img-responsive" src="<?=base_url('img/post/') . $post->img_post; ?>" alt="">
                <hr>
                <p><?= word_limiter(nl2br($post->texto_post), 40, '...'); ?></p>
                <a class="btn btn-primary" href="<?=base_url('post/') . $post->id_post; ?>">Leia mais <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
              <?php endforeach ?>

                <!-- Pager -->
                <?= $pagination ?>

            </div>


<?php $this->load->view('commons/sidebar')?>
<?php $this->load->view('commons/footer')?>

</body>
</html>