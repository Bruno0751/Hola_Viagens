<?php
  class Helper{

    public static function alert(string $msg){
      echo "<script>alert('$msg');</script>";
    }

    public static function log(string $dado){
      echo "<script>console.log('$dado');</script>";
    }

    /*
        CRIPTOGRAFANDO SENHAS
    */
    public static function criptografarSenhas($senhas){
      return sha1($senhas);
    }
  }
