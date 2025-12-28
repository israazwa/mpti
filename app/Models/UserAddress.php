<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_addresses';

    protected $fillable = [
        'user_id',
        'nama_penerima',
        'telepon',
        'email',
        'alamat_lengkap',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
        'kode_pos',
        'catatan',
        'is_default',
    ];
    protected function namaPenerima(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!$value)
                    return null;

                $key = hex2bin(env('ALL_ENC_KEY'));
                $nonceCipher = base64_decode($value, true);
                if (!$nonceCipher || strlen($nonceCipher) < SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES) {
                    return null; // data tidak valid
                }

                $nonce = substr($nonceCipher, 0, SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);
                $cipher = substr($nonceCipher, SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);

                return sodium_crypto_aead_xchacha20poly1305_ietf_decrypt(
                    $cipher,
                    "nama_penerima:v1", // AAD unik untuk field nama_penerima
                    $nonce,
                    $key
                );
            },
            set: function ($value) {
                if (!$value)
                    return null;

                $key = hex2bin(env('ALL_ENC_KEY'));
                $nonce = random_bytes(SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);

                $cipher = sodium_crypto_aead_xchacha20poly1305_ietf_encrypt(
                    $value,
                    "nama_penerima:v1",
                    $nonce,
                    $key
                );

                return base64_encode($nonce . $cipher);
            }
        );
    }


    protected function telepon(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!$value)
                    return null;

                $key = hex2bin(env('ALL_ENC_KEY'));
                $nonceCipher = base64_decode($value, true);
                if (!$nonceCipher || strlen($nonceCipher) < SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES) {
                    return null; // data tidak valid
                }

                $nonce = substr($nonceCipher, 0, SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);
                $cipher = substr($nonceCipher, SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);

                return sodium_crypto_aead_xchacha20poly1305_ietf_decrypt(
                    $cipher,
                    "telepon:v1", // AAD unik untuk field telepon
                    $nonce,
                    $key
                );
            },
            set: function ($value) {
                if (!$value)
                    return null;

                $key = hex2bin(env('ALL_ENC_KEY'));
                $nonce = random_bytes(SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);

                $cipher = sodium_crypto_aead_xchacha20poly1305_ietf_encrypt(
                    $value,
                    "telepon:v1",
                    $nonce,
                    $key
                );

                return base64_encode($nonce . $cipher);
            }
        );
    }


    protected function alamatLengkap(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!$value)
                    return null;

                $key = hex2bin(env('ALL_ENC_KEY'));
                $nonceCipher = base64_decode($value, true);
                if (!$nonceCipher || strlen($nonceCipher) < SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES) {
                    return null;
                }

                $nonce = substr($nonceCipher, 0, SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);
                $cipher = substr($nonceCipher, SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);

                return sodium_crypto_aead_xchacha20poly1305_ietf_decrypt(
                    $cipher,
                    "alamat_lengkap:v1",
                    $nonce,
                    $key
                );
            },
            set: function ($value) {
                if (!$value)
                    return null;

                $key = hex2bin(env('ALL_ENC_KEY'));
                $nonce = random_bytes(SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);

                $cipher = sodium_crypto_aead_xchacha20poly1305_ietf_encrypt(
                    $value,
                    "alamat_lengkap:v1",
                    $nonce,
                    $key
                );

                return base64_encode($nonce . $cipher);
            }
        );
    }



    /**
     * Relasi ke user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}