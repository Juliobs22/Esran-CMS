<?php
require_once('./model/dto/UsuariosDto.php');
require_once('./model/UsuariosDao.php');
class UserController {
    public function __construct() {
    
    }
    public function crearUsario() {
        try {
            $usuario = new UsuariosDto(0,'usuarioPHP4', 'usuariode.php4@gmail.com', 'ChangeME1234');
            #$toArray = (array) $usuario;
            #echo json_encode($toArray);
            $usuarioDao = new UsuariosDao();
            $usuarioDao->crearUsuarios($usuario);
            $usuarioDao->close();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function getUsersList() {
        try {
            
        } catch (Exception $e) {

        }
    }
}