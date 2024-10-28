<?php
class DacManager {
    private string $type;
    private string $action;
    private object $content;
    public function __construct($type=null, $action = null, $content = null) {
        $this->type = $type;
        $this->action = $action;
        $this->content = $content;
    }
    public function getType() {
        return $this->type;
    }
    public function getAction() {
        return $this->action;
    }
    public function getContent() {
        return $this->content;
    }
    public function setType($type) {
        $this->type = $type;
    }
    public function setAction($action) {
        $this->action = $action;
    }
    public function setContent($content) {
        $this->content = $content;
    }
}