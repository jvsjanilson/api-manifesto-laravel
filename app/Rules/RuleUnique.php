<?php

namespace App\Rules;

use App\Models\Estado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Validation\Rule;

class RuleUnique implements Rule
{
    private $id;
    private $model;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Model $model, $id = null)
    {
        $this->model = $model;
        $this->id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($value != "")
        {
            if (is_null($this->id) )
                $reg = $this->model->where($attribute, $value)->first();
            else
                $reg = $this->model->where($attribute, $value)
                    ->where('id', '<>', $this->id)
                    ->first();

            return isset($reg) ? false : true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A :attribute já cadastrada.';
    }
}
