<?php
class BaseModel {
    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }
}
