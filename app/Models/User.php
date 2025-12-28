<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Masked email accessor
     */
    protected function maskedEmail(): Attribute
    {
        return Attribute::make(
            get: fn() => substr($this->email, 0, 2) . '***@' . explode('@', $this->email)[1]
        );
    }

    /**
     * Masked phone accessor
     */
    protected function maskedPhone(): Attribute
    {
        return Attribute::make(
            get: fn() => substr($this->phone, 0, 2) . '****' . substr($this->phone, -3)
        );
    }

    public function messages()
    {
        return $this->hasMany(ContactMessage::class, 'user_id');
    }

    /**
     * Encrypted name accessor/mutator (libsodium)
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!$value)
                    return null;

                $key = hex2bin(env('NAME_ENC_KEY'));
                if (!$key || strlen($key) !== SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_KEYBYTES) {
                    return null; // key tidak valid
                }

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
                    "name:v1",
                    $nonce,
                    $key
                );
            },
            set: function ($value) {
                if (!$value)
                    return null;

                $key = hex2bin(env('NAME_ENC_KEY'));
                if (!$key || strlen($key) !== SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_KEYBYTES) {
                    throw new \Exception("Invalid NAME_ENC_KEY length");
                }

                $nonce = random_bytes(SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);
                $cipher = sodium_crypto_aead_xchacha20poly1305_ietf_encrypt(
                    $value,
                    "name:v1",
                    $nonce,
                    $key
                );

                return base64_encode($nonce . $cipher);
            }
        );
    }

    /**
     * Encrypted phone accessor/mutator (libsodium)
     */
    protected function phone(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!$value)
                    return null;

                $key = hex2bin(env('PHONE_ENC_KEY'));
                if (!$key || strlen($key) !== SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_KEYBYTES) {
                    return null; // key tidak valid
                }

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
                    "phone:v1",
                    $nonce,
                    $key
                );
            },
            set: function ($value) {
                if (!$value)
                    return null;

                $key = hex2bin(env('PHONE_ENC_KEY'));
                if (!$key || strlen($key) !== SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_KEYBYTES) {
                    throw new \Exception("Invalid PHONE_ENC_KEY length");
                }

                $nonce = random_bytes(SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);
                $cipher = sodium_crypto_aead_xchacha20poly1305_ietf_encrypt(
                    $value,
                    "phone:v1",
                    $nonce,
                    $key
                );

                return base64_encode($nonce . $cipher);
            }
        );
    }
}