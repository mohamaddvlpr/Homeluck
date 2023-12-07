<?php

namespace Web\Classes;

class Validator
{

    private $request;
    private $errors = [];

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function validate($array)
    {
        foreach ($array as $field => $rules) {
            if (in_array('nullable', $rules) and !$this->request->{$field}->is_file())
                continue;
            foreach ($rules as $rule) {
                if ($rule == 'nullable')
                    continue;
                if (str_contains($rule, ':')) {
                    $rule = explode(':', $rule);
                    $ruleName = $rule[0];
                    $ruleValue = $rule[1];
                    if ($error = $this->{$ruleName}($field, $ruleValue)) {
                        $this->errors[$field] = $error;
                        break;
                    }
                } else {
                    if ($error = $this->{$rule}($field)) {
                        $this->errors[$field] = $error;
                    }
                }
            }
        }
        return $this;
    }

    public function hasErrors()
    {
        return count($this->errors) ? true : false;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    private function required($field)
    {
        if (is_null($this->request->get($field)))
            return "Please Fill $field";

        if (empty($this->request->get($field)))
            return "Please Fill $field";

        return false;
    }

    private function email($field)
    {
        if (!filter_var($this->request->{$field}, FILTER_VALIDATE_EMAIL))
            return "`$field` is Invalid Email";
    }

    private function min($field, $value)
    {
        if (strlen($this->request->{$field} < $value)) {
            return "`$field` Character Is Smaller Than $value";

            return false;
        }
    }

    private function max($field, $value)
    {
        if (strlen($this->request->{$field} < $value)) {
            return "`$field` Character Is Bigger Than $value";

            return false;
        }
    }

    public function in($field, $item)
    {
        $items = explode(',', $item);
        if (!in_array($this->request->{$field}, $items))
            return "chosen `$field` is Invalid";

        return false;
    }

    public function size($field, $size)
    {
        if ($this->request->{$field}->getSize() > $size)
            return "Your Chosen Image have very size , Please Choose `$field` than $size";

        return false;
    }

    public function type($field, $types)
    {
        $types = explode(',', $types);
        if (!in_array($this->request->{$field}->getExtension(), $types))
            return "Chosen `$field` is Invalid";

        return false;
    }

    public function file($field)
    {
        if (!$this->request->{$field} instanceof Upload)
            return "Your Choosen image is not FILE";

        return false;
    }
}
