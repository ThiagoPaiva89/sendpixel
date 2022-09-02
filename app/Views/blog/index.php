<div class="container py-5">

    
            <div class="card">

            <?php if (isset($_SESSION['usuario_id'])) { ?>
                <div class="card-header bg-info text-white">
                   
                        <div class="float-left">
                            <a href="<?= Url ?>/blog/post" class="btn btn-light">Publicar Novo Artigo</a>
                        </div>
                        <span class="navbar-text float-right">
                            <p>Olá, <?= $_SESSION['usuario_nome'] ?>, Seja bem vindo(a)! <a class="btn btn-sm btn-danger float-right" href="<?= Url ?>/usuarios/sair" data-tooltip="tooltip" title="Sair do Sistema">Sair</a></p>
                        </span>
                    
                </div>
                <?php } ?>
                <div class="card-body">
                    <?php foreach ($dados['posts'] as $post) : ?>
                        <div class="card m-3">
                            <div class="card-header bg-secondary text-white font-weight-bold">
                                <?= $post->titulo ?>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><?= $post->texto ?></p>
                                <a href="<?= Url . '/blog/artigo/' . $post->postID ?>" class="btn btn-sm btn-outline-info float-right">Ler mais...</a>
                            </div>
                            <div class="card-footer text-muted">
                                <small>Escrito por: <?= $post->nome ?> em <?= date('d-m-Y H:i', strtotime($post->postDataCadastro)) ?></small>
                            </div>
                        </div>

                    <?php endforeach ?>
                </div>
            </div>



</div>