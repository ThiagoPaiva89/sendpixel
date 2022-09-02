<?php

class Sessao{

    public static function estaLogado(){
        if(isset($_SESSION['usuario_id'])){
            return true;
        }else{
            return false;
        }
    }
  
}