<?php
namespace App\Models\Api\CommonLibrary;
use Illuminate\Database\Eloquent\Model;
use DB;
class CryptographyPlugin extends Model
{

    /** @phpstan-ignore-next-line */
    private $nonce;
    /** @phpstan-ignore-next-line */
    private $key;
    /** @phpstan-ignore-next-line */
    private $block_size;

    public function __construct() {
        $nonce = "c88529b087036c035be110e0fa5b6b63041ede30e2e69e90";
        $this->nonce = $nonce;
        $this->key = '89def69f0bdddc995078037539dc6ef4f0bdbdd3fa04ef2d11eea30779d72ac6';
        //$get_val = DB::table('sodium_key_nonce')->first();
       // $this->nonce = $get_val->sodium_nonce;
       // $this->key = $get_val->sodium_key;
        //$this->block_size = '64';
    }
   

  

     /**
     * 
     *
     * @param  string $str
     * 
     * @return mixed
     * 
     */
    function encode($str) {
        //print_r($this->nonce);exit;
        try {
            $message = trim($str);
            if ($message != '') {

                $nonce_decoded = sodium_hex2bin($this->nonce);
                $key_decoded = sodium_hex2bin($this->key);
                // encrypt message and combine with nonce
                $cipher = sodium_bin2hex(sodium_crypto_secretbox($message, $nonce_decoded, $key_decoded));
                // cleanup
                sodium_memzero($message);
                sodium_memzero($key_decoded);
                sodium_memzero($nonce_decoded);
                return utf8_decode(utf8_encode(rtrim($cipher)));
                //return sodium_bin2hex($cipher);
            } else {
                return "";
            }
        } catch (\Exception $e) {
            return $e->getMessage();
 
        }
    }

    /**
     * 
     *
     * @param  string $code
     * 
     * @return mixed
     * 
     */
    function decode(string $code) {
        try {
            $encrypted = trim($code);
            if (!empty($encrypted)) {
				if(ctype_xdigit($encrypted)){
					$decoded = sodium_hex2bin($encrypted);
                    /** @phpstan-ignore-next-line */
					if ($decoded === false) {
						return '';
					}
					$nonce_decoded = sodium_hex2bin($this->nonce);
					$key_decoded = sodium_hex2bin($this->key);
                   
					// decrypt it
					$message = sodium_crypto_secretbox_open($decoded, $nonce_decoded, $key_decoded);
					if ($message === false) {
						return '';
					}
					// cleanup
					sodium_memzero($decoded);
					sodium_memzero($key_decoded);
					sodium_memzero($nonce_decoded);
					return utf8_decode(utf8_encode(rtrim($message)));
				} else {
					return '';            
				}
			} else {
                return '';
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 
     *
     * @param  string $hexdata
     * 
     * @return mixed
     * 
     */
    protected function hex2bin($hexdata) {
        $bindata = '';

        for ($i = 0; $i < strlen($hexdata); $i += 2) {
            $bindata .= chr(hexdec(substr($hexdata, $i, 2)));
        }

        return $bindata;
    }

}