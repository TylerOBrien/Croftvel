<?php

namespace App\Support\Auth;

use App\Enums\Identity\IdentityType;
use App\Exceptions\Api\v1\Auth\InvalidCredentials;
use App\Models\ { Identity, Secret };

use Illuminate\Contracts\Support\{ Arrayable, Jsonable };

class Credentials implements Arrayable, Jsonable
{
    /**
     * The identity instance.
     *
     * @var \App\Models\Identity
     */
    public $identity;

    /**
     * The secret instance.
     *
     * @var \App\Models\Secret
     */
    public $secret;

    /**
     * Instantiate the helper.
     *
     * @param  \App\Models\Identity  $identity
     * @param  \App\Models\Secret  $secret
     *
     * @return void
     */
    public function __construct(Identity $identity, Secret $secret)
    {
        $this->identity = $identity;
        $this->secret = $secret;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'identity' => $this->identity,
            'secret' => $this->secret,
        ];
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     *
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * Attempts to parse the given identity and secret fields to determine the
     * correct Identity and Secret model instances to instantiate.
     *
     * @param  array  $fields  The fields containing the raw credentials data, typically from a request.
     *
     * @return Credentials
     */
    static public function fromFields(array $fields): Credentials
    {
        if (!isset($fields['identity']) ||
            !is_array($fields['identity']) ||
            !isset($fields['identity']['type']) ||
            ( !isset($fields['identity']['value']) && $fields['identity']['type'] !== IdentityType::OAuth->value ) ||
            !isset($fields['secret']) ||
            !is_array($fields['secret']) ||
            ( !isset($fields['secret']['type']) && $fields['identity']['type'] !== IdentityType::OAuth->value ) ||
            !isset($fields['secret']['value']))
        {
            throw new InvalidCredentials;
        }

        $identity = Identity::where($fields['identity'])->first();

        if (is_null($identity)) {
            throw new InvalidCredentials;
        }

        $provider = $identity->user->secrets();

        if ($identity->is_oauth) {
            $secret = $provider->where('type', IdentityType::OAuth->value)->first();
        } else {
            $secret = $provider->where('type', $fields['secret']['type'])->first();
        }

        return new Credentials($identity, $secret);
    }
}
