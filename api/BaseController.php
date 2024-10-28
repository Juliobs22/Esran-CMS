<?php
class BaseController {
    protected string $uri;
    protected string $method;
    protected array $uriList;
    //public function __call($method, $args){ $this->sendOutput('', array('HTTP/1.1 404 Not Found')); }

    public function getUriSegmennts(){
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        #echo $this->uri;
        $this->uriList = explode('/', $this->uri);
        return $this->uriList;
    }

    public function getUriParams(){ 
        #echo '<br/>'.$_SERVER['QUERY_STRING'];
        $query = array();
        parse_str($_SERVER['QUERY_STRING'], $query); 
        #echo '<br/>'.count($query);
        /**foreach($query as $key => $value){
            echo "<br/>$key => ".$query[$key];
        }*/
        return $query;
    }

    public function sendOuput(string $data, array $httpHeaders = array()){
        header_remove('Set-Cookie');
        if(is_array($httpHeaders) && !empty($httpHeaders)){
            foreach($httpHeaders as $key){
                header($key);
            }
        }
        print($data);
        exit;
    }

}