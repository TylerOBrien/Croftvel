<?php

namespace App\Http\Requests\Api\v1;

use App\Exceptions\Auth\Unauthorized;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidatesWhenResolvedTrait;

class ApiRequest extends Request implements ValidatesWhenResolved
{
    use ValidatesWhenResolvedTrait;

    protected $ability;
    protected $binding;
    protected $model;
    protected $container;
    protected $validator;

    /**
     * 
     */
    public function authorize()
    {
        if ($this->ability) {
            return $this->binding
                ? auth()->user()->can($this->ability, $this->route($this->binding))
                : auth()->user()->can($this->ability, $this->model)
            ;
        }

        return true;
    }

    /**
     * 
     */
    public function attributes()
    {
        return [];
    }

    /**
     * 
     */
    public function messages()
    {
        return [];
    }

    /**
     * 
     */
    public function rules()
    {
        return [];
    }

    /**
     * 
     */
    public function validated()
    {
        return $this->validator->validated();
    }

    /**
     * 
     */
    protected function failedAuthorization()
    {
        throw new Unauthorized(
            $this->ability,
            $this->binding
                ? $this->route($this->binding)
                : $this->model);
    }

    /**
     * 
     */
    protected function getValidatorInstance()
    {
        if ($this->validator) {
            return $this->validator;
        }

        $factory = $this->container->make(ValidationFactory::class);
        $validator = $factory->make(
            $this->all(), $this->rules(), $this->messages(), $this->attributes()
        );

        $this->setValidator($validator);

        return $this->validator;
    }

    /**
     * 
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * 
     */
    public function setValidator(Validator $validator)
    {
        $this->validator = $validator;

        return $this;
    }
}
