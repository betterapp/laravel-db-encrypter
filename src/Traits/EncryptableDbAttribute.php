<?php

namespace betterapp\LaravelDbEncrypter\Traits;

use Exception;
use Illuminate\Support\Facades\Crypt;

/**
 * Trait EncryptableDbAttribute
 * @package betterApp\LaravelDbEncrypter\Traits
 */
trait EncryptableDbAttribute
{
    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (!in_array($key, $this->encryptable) || is_null($value) || $value === '') {
            return $value;
        }

        return $this->decrypt($value);
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        if (is_null($value) || !in_array($key, $this->encryptable)) {
            return parent::setAttribute($key, $value);
        }

        $value = $this->encrypt($value);

        return parent::setAttribute($key, $value);
    }

    /**
     * @return array
     */
    public function attributesToArray(): array
    {
        $attributes = parent::attributesToArray();

        if (empty($attributes)) {
            return $attributes;
        }

        foreach ($attributes as $key => $value) {
            if (!in_array($key, $this->encryptable) || is_null($value) || $value === '') {
                continue;
            }

            $attributes[$key] = $this->decrypt($value);
        }

        return $attributes;
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    private function encrypt($value): string
    {
        try {
            $value = Crypt::encrypt($value);
        } catch (Exception $e) {}

        return $value;
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    private function decrypt($value)
    {
        try {
            $value = Crypt::decrypt($value);
        } catch (Exception $e) {}

        return $value;
    }
}
