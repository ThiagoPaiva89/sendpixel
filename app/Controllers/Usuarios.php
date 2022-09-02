<?php

class Usuarios extends Controller
{


    public function __construct()
    {
        $this->usuarioModel = $this->model('Usuario');
    }

    public function cadastrar()
    {


        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {
            $dados = [
                'nome' => trim($formulario['nome']),
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                'confirma_senha' => trim($formulario['confirma_senha'])
            ];


            if (in_array("", $formulario)) {

                if (empty($formulario['nome'])) {
                    $dados['nome_erro'] = 'Preencha o campo nome';
                }
                if (empty($formulario['email'])) {
                    $dados['email_erro'] = 'Preencha o campo email';
                }
                if (empty($formulario['senha'])) {
                    $dados['senha_erro'] = 'Preencha o campo senha';
                }
                if (empty($formulario['confirma_senha'])) {
                    $dados['conf_senha_erro'] = 'Preencha o campo confirmar senha';
                }
            } else {
                if (Validar::checarNome($formulario['nome'])) {
                    $dados['nome_erro'] = 'O nome não pode conter números e/ou caracteres especiais';
                } elseif (Validar::checarEmail($formulario['email'])) {
                    $dados['email_erro'] = 'O email informado é inválido';
                } elseif ($this->usuarioModel->checarEmail($formulario['email'])) {
                    $dados['email_erro'] = 'Já existe um usuário para o email cadastrado';
                } elseif (strlen($dados['senha']) < 6) {
                    $dados['senha_erro'] = 'A senha cadastrada deve possuir, no mínimo, 6 caracteres';
                } elseif ($formulario['senha'] != $formulario['confirma_senha']) {
                    $dados['conf_senha_erro'] = 'Confirme com a senha igual a cadastrada acima';
                } else {

                    $dados['senha'] = password_hash($formulario['senha'], PASSWORD_DEFAULT);

                    if ($this->usuarioModel->armazenar($dados)) {
                        echo '<hr>Cadastro realizado com sucesso<hr>';
                        Url::redirecionar('usuarios/login');
                    } else {
                        die("Erro ao armazenar usuário");
                    }
                }
            }
        } else {
            $dados = [
                'nome' => '',
                'email' => '',
                'senha' => '',
                'confirma_senha' => '',
                'nome_erro' => '',
                'email_erro' => '',
                'senha_erro' => '',
                'conf_senha_erro' => ''
            ];
        }

        $this->view('usuarios/cadastrar', $dados);
    }

    public function login()
    {
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {
            $dados = [
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha'])
            ];


            if (in_array("", $formulario)) {

                if (empty($formulario['email'])) {
                    $dados['email_erro'] = 'Preencha o campo email';
                }
                if (empty($formulario['senha'])) {
                    $dados['senha_erro'] = 'Preencha o campo senha';
                }
            } else {
                if (Validar::checarEmail($formulario['email'])) {
                    $dados['email_erro'] = 'O email informado é inválido';
                } else {
                   
                    $usuario = $this->usuarioModel->checarLogin($formulario['email'], $formulario['senha']);
                    if($usuario){
                        $this->criarSessaoUsuario($usuario);
                        
                    }else{
                        echo '<hr>Usuário ou senha inválido';
                    }

                }
            }
        } else {
            $dados = [
                'email' => '',
                'senha' => '',
                'email_erro' => '',
                'senha_erro' => ''

            ];
        }

        $this->view('usuarios/login', $dados);        

    }

    private function criarSessaoUsuario($usuario){
        $_SESSION['usuario_id'] = $usuario->id;
        $_SESSION['usuario_nome'] = $usuario->nome;
        $_SESSION['usuario_email'] = $usuario->email;

        Url::redirecionar('blog/index');

        
    }

    public function sair(){
        unset($_SESSION['usuario_id']);
        unset($_SESSION['usuario_nome']);
        unset($_SESSION['usuario_email']);

        session_destroy();
        
        Url::redirecionar('blog/index');
    }

}
