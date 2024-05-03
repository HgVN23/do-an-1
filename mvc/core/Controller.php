<?php
class Controller
{
    public function model($model)
    {
        require_once "../mvc/models/" . $model . ".php";
        return new $model;
    }


    public function view($pathdir, $fileview, $data = [])
    {

        require_once "../mvc/views/" . $pathdir . "/" . $fileview . ".php";
    }
}
