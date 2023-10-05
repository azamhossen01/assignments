<?php 
$load_data = json_decode(file_get_contents('./storage/admin.json'), true) ?? [];
$data = [];
while(true)
{

    $data['name'] = trim(readline('Name : ')) ?? 'No Name';
    $data['email'] = trim(readline('Email : '));
    if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
        $data['password'] = trim(readline('Password : '));
    }
    array_push($load_data, $data);
    file_put_contents('./storage/admin.json',json_encode($load_data));
    $txt = 'Admin added successfully' . PHP_EOL;
    printf('%s',$txt);
}