<?php
class UsuariosDao extends DbManager {
    public function __construct() {
        parent::__construct();
    }
    public function crearUsuarios(UsuariosDto $usuarioDto) {
        $insert = $this->pdo->prepare("INSERT INTO USUARIOS (usname, email, password, us_type_id) VALUES (:usname, :email, :password, :us_type_id)");
        $usuarioArray = array(
            'usname' => $usuarioDto->getUsnome(),
            'email'=> $usuarioDto->getEmail(),
            'password'=> $usuarioDto->getPassword(),
            'us_type_id'=> $usuarioDto->getUserType(),
        );
        if ($insert->execute($usuarioArray)) {
            $this->pdo->commit();
            $this->resMessage = new MessageAgt(0, 'Usuario creado exitosamente');
        } else {
            $this->pdo->rollBack();
            $this->resMessage = new MessageAgt(1, 'Error en la creación del usuario');
            //throw new UsuariosException('Error de creacion de usuario revise los parametros');
        }
        return $this->resMessage;
    }

    public function updateUsuarios(string $type, UsuariosDto $usuarioDto) {
        $message = '';
        $code = 0;
       switch ($type) {
        case 'CHPASS':
            $update = $this->pdo->prepare("UPDATE USUARIOS SET password = ':password' WHERE us_id = :us_id");
            if ($update->execute(array(':us_id' => $usuarioDto->getUsId(), ':password' => $usuarioDto->getPassword()))) {
                $this->pdo->commit();
                $code = 0;
                $message = 'Contraseña actualizada exitosamente';
            } else {
                $this->pdo->rollBack();

            }
            break;
        case 'CHUSNAME':
            $update = $this->pdo->prepare("UPDATE USUARIOS SET usname = ':usname' WHERE us_id = :us_id");
            if ($update->execute(array(':us_id' => $usuarioDto->getUsId(), ':usname' => $usuarioDto->getUsnome()))) {
                $this->pdo->commit();
                $code = 0;
                $message = 'Nombre de usuario actualizado exitosamente';
            } else {
                $this->pdo->rollBack();
                $code = 1;
                $message = 'Error en la actualización del nombre de usuario';
            }
            break;
        case "CHEMAIL":
            $update = $this->pdo->prepare("UPDATE USUARIOS SET email= ':email' WHERE us_id = :us_id");
            if ($update->execute(array(':us_id' => $usuarioDto->getUsId(), ':email' => $usuarioDto->getEmail()))) {
                $this->pdo->commit();
                $code = 0;
                $message = 'Email actualizado exitosamente';
            } else {
                $this->pdo->rollBack();
                $code = 1;
                $message = 'Error en la actualización del email';
            }
            break;
        case "CHTYPE":
            $update = $this->pdo->prepare("UPDATE USUARIOS SET us_type_id = :us_type_id WHERE us_id = :us_id");
            if ($update->execute(array(':us_id' => $usuarioDto->getUsId(), ':us_type_id' => $usuarioDto->getUserType()))) {
                $this->pdo->commit();
                $code = 0;
                $message = 'Tipo de usuario actualizado exitosamente';
            } else {
                $this->pdo->rollBack();
                $code = 1;
                $message = 'Error en la actualización del tipo de usuario';
            }
            break;
       }
       return $this->resMessage;
    }
    public function deleteUsuarios(UsuariosDto $usuarioDto) {
        $delete = $this->pdo->prepare("DELETE FROM usuarios WHERE us_id = :us_id");
        if ($usuarioDto->getUserType() > -1) {
            if ($delete->execute(array(':us_id' => $usuarioDto->getUsId()))) {
                $this->pdo->commit();
                $this->resMessage = new MessageAgt(0, 'Successfully deleted');
            } else {
                $this->pdo->rollBack();
                $this->resMessage = new MessageAgt(1, 'failed to delete usuarios');
            }
        } else {
            $this->resMessage = new MessageAgt(1, 'Error: No se puede eliminar un administrador');
        }

    }
    public function getUsuaeriosList() {
        $select = $this->pdo->prepare("SELECT * FROM usuarios");
        if ($select->execute()) {
            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            $this->resMessage = new MessageAgt(0, 'Succes:  El usuario se encontro exitosamente', $result);
        } else 
            $this->resMessage = new MessageAgt(1, 'Error: The user cannot be accesed');
        
        return $this->resMessage;
    }

    public function getTypeInfo(){
        $select = $this->pdo->prepare("SELECT * FROM user_types");
        if ($select->execute()) {
            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            $this->resMessage = new MessageAgt(0, 
            'Succes: El tipo de usuario se encontro exitosamente',
            $result);
        } else {
            #throw new UsuariosException('Unexpected Error: Cannot get User Types.');
            ##return null;
            $this->resMessage = new MessageAgt(1,
            'Error: El tipo de usuario no se encontro',
            null);
        }
        return $this->resMessage; 
    }

    public function getUsuario(UsuariosDto $usuariosDto) {
        $user = $usuariosDto->getUsnome();
        $email = $usuariosDto->getEmail();
        $pass = $usuariosDto->getPassword();
        $select = $this->pdo->prepare("SELECT us_id, usname, email FROM usuarios WHERE (usname = '$user' OR email = '$email') AND password = '$pass'");
        if($select->execute()){
            $result =  $select->fetchAll(PDO::FETCH_ASSOC);
            $this->resMessage = new MessageAgt(0, 'Succes: El usuario se encontro exitosamente', $result[0]);
        } else {
            $this->resMessage = new MessageAgt(1, 'Error: El usuario no se encontro exitosamente');
        }
        return $this->resMessage;
    }

}