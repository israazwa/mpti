<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected function maskedEmail(): Attribute
    {
        return Attribute::make(
            get: fn() => substr($this->email, 0, 2) . '***@' . explode('@', $this->email)[1]
        );
    }

    protected function maskedPhone(): Attribute
    {
        return Attribute::make(
            get: fn() => substr($this->phone, 0, 2) . '****' . substr($this->phone, -3)
        );
    }
    //libsodium encryption
    protected function name(): Attribute
    {
        return Attribute::make(
            // Dekripsi saat diakses
            get: function ($value) {
                if (!$value)
                    return null;

                $key = hex2bin(env('NAME_ENC_KEY'));
                $nonceCipher = base64_decode($value, true);
                if (!$nonceCipher)
                    return null;

                $nonce = substr($nonceCipher, 0, SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);
                $cipher = substr($nonceCipher, SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);

                return sodium_crypto_aead_xchacha20poly1305_ietf_decrypt(
                    $cipher,
                    "name:v1", // AAD untuk versi
                    $nonce,
                    $key
                );
            },
            // Enkripsi saat diset
            set: function ($value) {
                if (!$value)
                    return null;

                $key = hex2bin(env('NAME_ENC_KEY'));
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


    protected function phone(): Attribute
    {
        return Attribute::make(
            // Dekripsi saat diakses
            get: function ($value) {
                if (!$value)
                    return null;

                $key = hex2bin(env('PHONE_ENC_KEY'));
                $nonceCipher = base64_decode($value, true);
                if (!$nonceCipher)
                    return null;

                $nonce = substr($nonceCipher, 0, SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);
                $cipher = substr($nonceCipher, SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);

                return sodium_crypto_aead_xchacha20poly1305_ietf_decrypt(
                    $cipher,
                    "phone:v1", // AAD untuk versi
                    $nonce,
                    $key
                );
            },
            // Enkripsi saat diset
            set: function ($value) {
                if (!$value)
                    return null;

                $key = hex2bin(env('PHONE_ENC_KEY'));
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
