/*==============================================================================
*	CLASS SECURITY UNTUK PROSES encrypt, decrypt
*							2021 (c) By SCM csynoers
*              LAST UPDATE 2021/03/05
*==============================================================================*/
class Security{
    protected $key;
    public function __construct() {
        $this->key = 'S.I.N.U.R';
    }
    
    public function encrypt( $value ) {
        $key= $this->key;
        //$key previously generated safely, ie: openssl_random_pseudo_bytes
        $plaintext = $value;
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        //$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        $ciphertext = base64_encode( $iv./*$hmac.*/$ciphertext_raw );
        return $ciphertext;
    }

    public function decrypt( $value ) {
        $key= $this->key;
        $c = base64_decode($value);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        //$hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen/*+$sha2len*/);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        return $original_plaintext;
    }
}
