<div class="container">
    <div class="p-5 m-5 bg-light rounded border shadow">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= Url ?>/blog">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $dados['post']->titulo ?></li>
            </ol>
        </nav>

        <div class="card text-center">
            <div class="card-header bg-secondary text-white font-weight-bold">
                <?= $dados['post']->titulo ?>
            </div>
            <div class="card-body">
                <p class="card-text"><?= $dados['post']->texto ?></p>
            </div>
            <div class="card-footer text-muted">
                <div class="card-footer text-muted">
                    <small>Escrito por: <?= $dados['usuario']->nome ?> em <?= date('d-m-Y H:i', strtotime($dados['post']->criado_em)) ?></small>
                </div>

                <?php if ($dados['post']->usuario_id == $_SESSION['usuario_id']) { ?>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="<?= Url . '/blog/editar/' . $dados['post']->id ?>" class="btn btn-sm btn-primary">Editar</a>
                        </li>
                        <li class="list-inline-item">
                            <form action="<?= Url . '/blog/deletar/' . $dados['post']->id ?>" method="POST">
                                <input type="submit" class="btn btn-sm btn-danger" value="Deletar">
                            </form>
                        </li>
                    </ul>

                <?php } ?>

            </div>
        </div>
    </div>
</div>