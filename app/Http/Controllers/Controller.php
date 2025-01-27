<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Api\CommonLibrary\CryptographyPlugin;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private $key;

    public function __construct()
    {
        $this->key = base64_decode(env('LIBSODIUM_KEY')); // Decode the base64 key
    }

    /**
     * Encrypt the data
     *
     * @param string $data
     * @return string
     */
    public function encrypt(string $data): string
    {
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES); // Generate a random nonce
        $cipherText = sodium_crypto_secretbox($data, $nonce, $this->key); // Encrypt the data

        // Combine nonce and encrypted data, then encode as base64
        return base64_encode($nonce . $cipherText);
    }

    /**
     * Decrypt the data
     *
     * @param string $encryptedData
     * @return string|null
     */
    public function decrypt(string $encryptedData): ?string
    {
        $decodedData = base64_decode($encryptedData); // Decode base64 string
        $nonce = substr($decodedData, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES); // Extract nonce
        $cipherText = substr($decodedData, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES); // Extract encrypted data

        try {
            // Decrypt the data
            return sodium_crypto_secretbox_open($cipherText, $nonce, $this->key);
        } catch (\Exception $e) {
            return null; // Return null if decryption fails
        }
    }


  /**
    * decryption check.
    * @param  string  $string
    * @return mixed
    */
    public function decryption($string)
    {

        if(!empty($string)) {
           $cryp=new CryptographyPlugin();
           $data = $cryp->decode($string);
        //dd($data);
           $data1 = json_decode($data);
           return $data1;
        }
        return '';
    }
    /**
    * encryption check.
    * @param  string  $string
    * @return mixed
    */
    public function encryption($string)
    {
        if(!empty($string)) {
            $cryp=new CryptographyPlugin();
            $data = $cryp->encode($string);
            return $data;
        }
        return '';
    }
    /**
    * dec check.
    * @param  string  $string
    * @return mixed
    */
    public function dec($string)
    {
        if(!empty($string)) {
           
            $cryp=new CryptographyPlugin();
            $data = $cryp->decode($string);
            return $data;
        }
        return '';
    }

    /**
    * enc check.
    * @param  string  $string
    * @return mixed
    */
    public function enc($string)
    {
        if(!empty($string)) {
            $cryp=new CryptographyPlugin();
            $data = $cryp->encode($string);
            return $data;
        }
        return '';
    }
}