<?php
$senha = "123";
$hash_admin = password_hash($senha, PASSWORD_DEFAULT);
$hash_ususario = password_hash($senha, PASSWORD_DEFAULT);

echo "Hash para admin: " . $hash_admin . "<br>";
echo "Hash para usuario: " . $hash_usuario . "<br>";
echo $senha;
