<?php

use function PHPSTORM_META\type;

class MainController {
    private array $dispatcher;
    private UsuariosDao $usuariosDao;
    public function __construct(array $dispatcher = null) {
        $this->dispatcher = $dispatcher;
        /**
         * Dispatcher
         * TYPE
         * ACTION
         * CONT
         */

    }

    public function manageUser() {
        $resMessage = array();
        $this->usuariosDao = new UsuariosDao();

        switch($this->dispatcher['ACTION']) {
            case 'CREATE':
                if (isset($this->dispatcher['CONT']) ||(get_class($this->dispatcher['CONT']) == 'UsuariosDto')) {
                    $queryStat = $this->usuariosDao->crearUsuarios($this->dispatcher['CONT']);
                    if ($queryStat['CODE'] > 0) {
                        $resMessage = array(
                            'statusCode' => 404,
                            'Message' => 'Error: intentelo mas tarde',
                            'description' => 'error'
                        );
                    }
                    else {
                        $resMessage = array(
                            'statusCode' => 201,
                            'Message' => 'Usuario creado.',
                            'description' => 'ok'
                        );
                    }
                }
                else {
                    $resMessage = array(
                        'statusCode' => 400,
                        'Message' => 'El usuario no puede ser creado, verifique los datos',
                        'description' => 'Bad request'
                    );
                }
                break;
            case 'LOGIN':
                if (isset($this->dispatcher['CONT']) ||(get_class($this->dispatcher['CONT']) == 'UsuariosDto')) {
                    $queryStat = $this->usuariosDao->getUsuario($this->dispatcher['CONT']);
                    #echo $queryStat['CODE'].'CODE<br/>';
                    if ($queryStat['CODE'] > 0) {
                        $resMessage = array(
                            'statusCode' => 404,
                            'Message' => 'Not found',
                            'description' => 'error'
                        );
                    }
                    else {
                        $resMessage = array(
                            'statusCode' => 201,
                            'Message' => 'Usuario encontrado.',
                            'description' => 'ok',
                            'result' => $queryStat['CONTENT']
                        );
                    }
                } else{
                    $resMessage = array(
                        'statusCode' => 400,
                        'Message' => 'El usuario no puede ser creado, verifique los datos',
                        'description' => 'Bad request'
                    );
                }
                break;
        }
        return $resMessage;
    }
}