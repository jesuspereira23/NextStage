<?php
$data = ['name' => 'Teste', 'email' => 'teste'.rand().'@teste.com', 'password' => '12345678', 'password_confirmation' => '12345678'];
$options = [
    'http' => [
        'header'  => "Content-type: application/json\r\nAccept: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
        'ignore_errors' => true
    ]
];
$context  = stream_context_create($options);
$result = file_get_contents('http://127.0.0.1:8000/api/register', false, $context);
echo $result;
