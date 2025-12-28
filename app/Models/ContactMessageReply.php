<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ContactMessageReply extends Model
{
    //
    protected $fillable = ['contact_message_id', 'admin_id', 'body', 'status'];

    public function message()
    {
        return $this->belongsTo(ContactMessage::class, 'contact_message_id');
    }

    protected function body(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!$value)
                    return null;

                $hexKey = env('ALL_ENC_KEY');
                $key = hex2bin($hexKey);

                $nonceCipher = base64_decode($value, true);
                if (!$nonceCipher)
                    return null;

                if (strlen($nonceCipher) < SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES) {
                    return null; // data tidak valid
                }

                $nonce = substr($nonceCipher, 0, SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);
                $cipher = substr($nonceCipher, SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);

                return sodium_crypto_aead_xchacha20poly1305_ietf_decrypt(
                    $cipher,
                    'reply_body:v1', // AAD unik & versi
                    $nonce,
                    $key
                );
            },
            set: function ($value) {
                if (!$value)
                    return null;

                $hexKey = env('ALL_ENC_KEY');
                $key = hex2bin($hexKey);

                $nonce = random_bytes(SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);

                $cipher = sodium_crypto_aead_xchacha20poly1305_ietf_encrypt(
                    $value,
                    'reply_body:v1', // AAD harus sama saat decrypt
                    $nonce,
                    $key
                );

                return base64_encode($nonce . $cipher);
            }
        );
    }


}
