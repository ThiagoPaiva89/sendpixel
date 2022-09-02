<?php

class Url{
    public static function redirecionar($url){
        header("Location:".Url.DIRECTORY_SEPARATOR.$url);
    }
}