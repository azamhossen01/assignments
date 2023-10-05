<?php 

declare(strict_types=1);

namespace App\Classes;

class JsonStorage implements Storage 
{
    private $dataFile = "";
    private const SUCCESS = 1;
    private const FAIL = 0;

    public function save($model,$data)
    {
        file_put_contents($this->getModelPath($model), json_encode($data, JSON_PRETTY_PRINT));
    }

    public function load($model)
    {
        // if(!file_exists('./storage/' . $model . '.json')){
        //     $this->dataFile = fopen("./storage/" . $model . ".json", "w");
        // }
        $data = [];

        if(file_exists($this->getModelPath($model))){
            $data = json_decode(file_get_contents($this->getModelPath($model)),true);
        }
        if (!is_array($data)) {
            return [];
        }
        return $data;

        // $this->dataFile = "./storage/" . $model . ".json";
        // $data = json_decode(file_get_contents($this->dataFile),true)??[];
        // return $data;
        
    }

    public function createAccount($fileName)
    {
        if(!file_exists('./storage/' . $fileName . '.json')){
            fopen('./storage/' . $fileName . '.json', "w");
            $data = [
                "deposits" => [],
                "withdraws" => [],
                "transfer" => []
            ];
            $this->save($fileName,$data);
        }
        return;
    }

    public function getFileByName($fileName) 
    {
        if(file_exists('./storage/accounts/' . $fileName . '.json')){
            return json_decode(file_get_contents('./storage/accounts/' . $fileName . '.json'), true);
        }
    }

    public function getModelPath(string $model): string
    {
        return './storage/' . $model . ".json";
    }

    public function checkFileExists(string $model): bool
    {
        if(file_exists('./storage/' . $model . '.json')){
            if(Auth::authenticated()['email'] === $model){
                printf("You can't transfer to your own account\n");
                return false;
            }
            return true;
        }else{
            printf("Email does not exists\n");
            return false;
        }
        
    }

    
}