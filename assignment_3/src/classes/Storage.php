<?php 

declare(strict_types=1);

namespace App\Classes;

interface Storage 
{

    public function save($model,$data);

    public function load($model);

}