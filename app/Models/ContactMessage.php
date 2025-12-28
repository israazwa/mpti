<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kategori',
        'pesan',
    ];
    /**
     * Relasi ke tabel users
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany(ContactMessageReply::class);
    }


    protected function pesan(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!$value)
                    return null;

                $key = hex2bin(env('PESAN_ENC_KEY'));
                $nonceCipher = base64_decode($value, true);
                if (!$nonceCipher)
                    return null;

                // Pastikan panjang cukup
                if (strlen($nonceCipher) < SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES) {
                    return null; // data tidak valid
                }

                $nonce = substr($nonceCipher, 0, SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);
                $cipher = substr($nonceCipher, SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);

                return sodium_crypto_aead_xchacha20poly1305_ietf_decrypt(
                    $cipher,
                    "pesan:v1", // AAD
                    $nonce,
                    $key
                );
            },
            set: function ($value) {
                if (!$value)
                    return null;

                $key = hex2bin(env('PESAN_ENC_KEY'));
                $nonce = random_bytes(SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);

                $cipher = sodium_crypto_aead_xchacha20poly1305_ietf_encrypt(
                    $value,
                    "pesan:v1",
                    $nonce,
                    $key
                );

                return base64_encode($nonce . $cipher);
            }
        );
    }
}