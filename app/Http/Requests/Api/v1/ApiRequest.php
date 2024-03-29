<?php

namespace App\Http\Requests\Api\v1;

use App\Exceptions\Api\v1\Auth\Forbidden;
use App\Exceptions\Api\v1\Validation\InvalidRequestDefaults;
use App\Guards\Api\v1\ApiGuard;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidatesWhenResolvedTrait;

class ApiRequest extends Request implements ValidatesWhenResolved
{
    use ValidatesWhenResolvedTrait;

    /**
     * The name of the ability (e.g. index, store, destroy) the request is using.
     *
     * @var string
     */
    protected $ability;

    /**
     * The name of the bound param.
     *
     * @var string
     */
    protected $binding;

    /**
     * The fully qualified class name of the model.
     *
     * @var string
     */
    protected $model;

    /**
     * The container instance.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $container;

    /**
     * The validator instance.
     *
     * @var \Illuminate\Contracts\Validation\Validator
     */
    protected $validator;

    /**
     * Check if the currently authenticated user has been authorized to perform
     * the request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $user = ApiGuard::get()->user();
        $target = $this->binding ? $this->route($this->binding) : $this->model;

        if ($user && $this->ability) {
            return $user->can($this->ability, $target);
        }

        return true; // Either no user or no ability, meaning nothing is being done, so we can authorize.
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, mixed>
     */
    public function attributes()
    {
        return [];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [];
    }

    /**
     * Get the default values for fields that have not been provided.
     *
     * @return array<string, mixed>
     */
    public function defaults()
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [];
    }

    /**
     * @return array
     */
    public function validated()
    {
        $fields = $this->validator->validated();
        $defaults = $this->defaults() ?? [];

        if (!is_array($defaults)) {
            throw new InvalidRequestDefaults;
        }

        foreach ($defaults as $key => $value) {
            if (!isset($fields[$key])) {
                $fields[$key] = $value;
            }
        }

        return $fields;
    }

    /**
     * @return array
     */
    public function validationData()
    {
        return $this->all();
    }

    /**
     * Handle the failed request authorization.
     *
     * @return void
     *
     * @throws \App\Exceptions\Api\v1\Auth\Forbidden
     */
    protected function failedAuthorization()
    {
        throw new Forbidden(
            $this->ability,
            $this->binding
                ? $this->route($this->binding)
                : $this->model
        );
    }

    /**
     * Create the default validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Factory  $factory
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createDefaultValidator(ValidationFactory $factory)
    {
        return $factory->make(
            $this->validationData(),
            $this->container->call([ $this, 'rules' ]),
            $this->messages(),
            $this->attributes(),
        );
    }

    /**
     * Get the validator instance for the request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        if ($this->validator) {
            return $this->validator;
        }

        $factory = $this->container->make(ValidationFactory::class);

        if (method_exists($this, 'validator')) {
            $validator = $this->container->call([ $this, 'validator' ], compact('factory'));
        } else {
            $validator = $this->createDefaultValidator($factory);
        }

        if (method_exists($this, 'withValidator')) {
            $this->withValidator($validator);
        }

        $this->setValidator($validator);

        return $this->validator;
    }

    /**
     * Set the container implementation.
     *
     * @param  \Illuminate\Contracts\Container\Container  $container
     *
     * @return $this
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * Set the Validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     *
     * @return $this
     */
    public function setValidator(Validator $validator)
    {
        $this->validator = $validator;

        return $this;
    }
}
