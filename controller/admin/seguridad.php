<?php
    class Seguridad{
        function Limpiar($pass){
            $password = htmlspecialchars($pass);
            $password = trim($password);
            return $password;
        }
        function encriptarP($pass)
        {
            $clean = $this->limpiar($pass);
            $cifrado = "AES-128-CTR";
            $options = 0;
            $iv_longitud = openssl_cipher_iv_length($cifrado);
            $encrypcion_iv = "1234567891011121";
            $encryption_key = "AdSi";
            $encriptado = openssl_encrypt(
                $clean,
                $cifrado,
                $encryption_key,
                $options,
                $encrypcion_iv
            );
            return $encriptado;
        }
    }
?>