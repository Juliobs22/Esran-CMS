<?php
class MessageAgt {
    private int $code;
    private string $message;
    private array $content;
    public function __construct($code = 0, $message = null, $content = null){
        $this->code = $code;
        $this->message = $message;
        $this->content = $content;
    }
    public function getCode(){
        return $this->code;
    }
    public function getMessage(){
        return $this->message;
    }
    public function getContent(){
        return $this->content;
    }
    public function setCode($code){
        $this->code = $code;
    }
    public function setMessage($message){
        $this->message = $message;
    }
    public function setContent($content){
        $this->content = $content;
    }
}