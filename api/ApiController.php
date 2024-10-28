<?php
class ApiController extends BaseController {
    private string $errorMessage;
    private string $requestMethod;
    private array $requestUriParams;
    public function __construct(string $requestMethod) {
        $this->requestMethod = $requestMethod;
        $this->requestUriParams = $this->getUriParams();
        $this->errorMessage = "";
    }
    
    public function getUsers () {
        $usuariosDao = new UsuariosDao();
        $usersList = $usuariosDao->getUsuaeriosList();
        return json_encode($usersList);
    }

    public function printData () {
        try {
            $data = $this->getUsers();
            $this->sendOuput($data, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
            array('Content-Type: application/json', $strErrorHeader));
        }
    }

    /**public function entradasAction() {
        try {
            $entradasDao = new EntriesDao();
            $entradasList = $entradasDao->getEntries();
            return json_encode($entradasList);
        } catch (Exception $e) {
            $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
            array('Content-Type: application/json', $strErrorHeader));
        }
    }**/
    public function usuariosAction() {
        try {
            $usuariosDao = new UsuariosDao();
            $usuariosList = json_encode(($usuariosDao->getUsuaeriosList()->getContent()));
            $this->sendOuput($usuariosList, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
        } catch (Exception $e) {
            $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), array('Content-Type: application/json', $strErrorHeader));
        }
    }
}