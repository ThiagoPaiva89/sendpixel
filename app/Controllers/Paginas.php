<?php

class Paginas extends Controller{

    public function index(){
        $dados = [
            'titulo' => 'SendPixel - Home'
        ];
        $this->view('paginas/home', $dados);
    }

    public function emconstrucao(){
        $dados = [
            'titulo' => 'SendPixel - Home'
        ];
        $this->view('paginas/emconstrucao', $dados);
    }
    
    
}