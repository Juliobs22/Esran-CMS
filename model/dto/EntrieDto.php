<?php
class EntrieDto {
    public $id;
    private $title;
    private $content;
    private $thumb;
    public function getTitle() { return $this->title; }
    public function getId() { return $this->id; }
    public function getContent() { return $this->content; }
    public function getThumb() { return $this->thumb; }
    public function setTitle($title) { $this->title = $title; }
    public function setThumb($thumb) { $this->thumb = $thumb; }
    public function setContent($content) { $this->content = $content; }
}