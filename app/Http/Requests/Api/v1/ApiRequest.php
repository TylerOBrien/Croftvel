<?php

namespace App\Http\Requests\Api\v1;

use App\Exceptions\Auth\Forbidden;

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
     * @return bool
     */
    public function authorize()
    {
        if ($this->ability) {
            return $this->binding
                ? auth()->user()->can($this->ability, request()->route($this->binding))
                : auth()->user()->can($this->ability, $this->model);
        }

        return true;
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [];
    }

    /**
     * @return array
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
        return $this->validator->validated();
    }

    /**
     * @return array
     */
    public function validationData()
    {
        return $this->all();
    }

    /**
     * @return void
     */
    protected function failedAuthorization()
    {
        throw new Forbidden(
            $this->ability,
            $this->binding
                ? $this->route($this->binding)
                : $this->model);
    }

    /**
     * 
     */
    protected function createDefaultValidator(ValidationFactory $factory)
    {
        return $factory->make(
            $this->validationData(), $this->container->call([$this, 'rules']),
            $this->messages(), $this->attributes()
        );
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

        if (method_exists($this, 'validator')) {
            $validator = $this->container->call([$this, 'validator'], compact('factory'));
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
     * @return ApiRequest
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * @return ApiRequest
     */
    public function setValidator(Validator $validator)
    {
        $this->validator = $validator;

        return $this;
    }
}
