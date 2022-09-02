<?php
/*Responsável por tratar as Url's e torná-las amigáveis
    Cria as url's, carrega os controladores, métodos e parâmetros
    FORMATO URL - /controlador/metodo/parametros
*/

class Rota{
    //atributos da classe
    private $controlador = 'Paginas';
    private $metodo = 'index';
    private $parametros = [];

    public function __construct(){
        //se a url existir atribui a função url na variável $url
       $url = $this->url() ? $this->url() : [0];
       //checar se o controlador existe
       //ucwords - converte para maiúscula o primeiro caractere de cada palavra
       if(file_exists('../app/Controllers/'.ucwords($url[0]).'.php')){
           //caso exista, seta como controlador
           $this->controlador = ucwords($url[0]);
           //unset - destrói a variável especificada
           unset($url[0]);
       }
       //requere o controlador
       require_once '../app/Controllers/'.$this->controlador.'.php';
       //instancia o controlador
       $this->controlador = new $this->controlador;

       //checa se o método existe - 2a parte da url
       if(isset($url[1])){
           //mrthod_exists - checa se o método existe
           if(method_exists($this->controlador, $url[1])
           ){
            $this->metodo = $url[1];
            unset($url[1]);
           }
       }

       //se existir retorna um array com os valores, se não, retorna um array vazio
       //array_values - Retorna todos os valores de um array
       $this->parametros = $url ? array_values($url) : [];
       //call_user_func_array - chama uma dada função de usuário com um array de parâmetros
       call_user_func_array([$this->controlador, $this->metodo], $this->parametros);

  
    }
    //Retorna a url em um array
    private function url(){
        //o filtro FILTER_SANITIZE_URL remove todos os caracteres ilegais de uma url 
        $url = filter_input(INPUT_GET,'url',FILTER_SANITIZE_URL);
        //verifica se a url existe
        if(isset($url)){
            //trim - retira espaço no início e final de uma string
            //rtrim - retira espaço em branco (ou outros caracteres) do final de string
            $url = trim(rtrim($url,'/'));
            //explode - divide uma string em strings, retorna um array
            $url = explode('/',$url);

            return $url;
        }
    }

}