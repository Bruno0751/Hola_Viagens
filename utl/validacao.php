<?php
    session_start();
    ob_start();

    class Validacao{

        
        public static function antiXSS($input){
            return htmlspecialchars($input);
        }

        /*
        public static function validarNomeCompleto($nomeCompleto){
            $exp = "^[0-9]{0,}$";
            return preg_match($exp,$nomeCompleto);
          }
        
        public static function validandoEmail($email){
            //echo filter_var($email,FILTER_VALIDATE_EMAIL) ? "" : "<scrip>window.alert('Email Inválido');</script>";
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                $_SESSION['msg'] = "Email Válido";
            }else{        
                $_SESSION['msg'] = "Email Iválido";
            }
        }
        */
    }