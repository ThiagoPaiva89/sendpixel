<?php

class Blog extends Controller
{

    public function __construct()
    {
        /*if (!Sessao::estaLogado()) {
            URL::redirecionar('usuarios/login');
        }*/

        $this->blogModel = $this->model('Blogs');
        $this->usuarioModel = $this->model('Usuario');
    }

    public function index()
    {
        
        $dados = [
            'posts' => $this->blogModel->lerPosts(),
            ];

        $this->view('blog/index', $dados);
    }


    public function post()
    {

        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($formulario)) :
            $dados = [
                'titulo' => trim($formulario['titulo']),
                'texto' => trim($formulario['texto']),
                'usuario_id' => $_SESSION['usuario_id']
            ];

            if (in_array("", $formulario)) :

                if (empty($formulario['titulo'])) :
                    $dados['titulo_erro'] = 'Preencha o campo titulo';
                endif;

                if (empty($formulario['texto'])) :
                    $dados['texto_erro'] = 'Preencha o campo texto';
                endif;

            else :
                if ($this->blogModel->armazenar($dados)) :
                    URL::redirecionar('blog');
                else :
                    die("Erro ao armazenar post no banco de dados");
                endif;

            endif;
        else :
            $dados = [
                'titulo' => '',
                'texto' => '',
                'titulo_erro' => '',
                'texto_erro' => ''
            ];

        endif;

        $this->view('blog/post', $dados);
    }

    public function editar($id)
    {

        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($formulario)) :
            $dados = [
                'id' => $id,
                'titulo' => trim($formulario['titulo']),
                'texto' => trim($formulario['texto']),
            ];

            if (in_array("", $formulario)) :

                if (empty($formulario['titulo'])) :
                    $dados['titulo_erro'] = 'Preencha o campo titulo';
                endif;

                if (empty($formulario['texto'])) :
                    $dados['texto_erro'] = 'Preencha o campo texto';
                endif;

            else :
                if ($this->blogModel->atualizar($dados)) :
                    URL::redirecionar('blog');
                else :
                    die("Erro ao atualizar post no banco de dados");
                endif;

            endif;
        else :

            $post = $this->blogModel->lerPostPorId($id);
            $dados = [
                'id' => $post->id,
                'titulo' => $post->titulo,
                'texto' => $post->texto,
                'titulo_erro' => '',
                'texto_erro' => ''
            ];

        endif;

        $this->view('blog/editar', $dados);
    }

    public function artigo($id)
    {
        $post = $this->blogModel->lerPostPorId($id);
        $usuario = $this->usuarioModel->lerUsuarioPorId($post->usuario_id);

        $dados = [
            'post' => $post,
            'usuario' => $usuario
        ];

        $this->view('blog/artigo', $dados);
    }

    public function deletar($id)
    {

        if (!$this->checarAutorizacao($id)) {
            $id = filter_var($id, FILTER_VALIDATE_INT);

            $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

            if ($id && $metodo == 'POST') {
                if ($this->blogModel->apagar($id)) {
                    URL::redirecionar('blog');
                }
            }
        } else {
            URL::redirecionar('post');
        }
    }

    private function checarAutorizacao($id)
    {
        $post = $this->blogModel->lerPostPorId($id);
        if ($post->usuario_id != $_SESSION['usuario_id']) {
            return true;
        } else {
            return false;
        }
    }
}
