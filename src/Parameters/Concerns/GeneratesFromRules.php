<?php

namespace hasnhasan\LaravelSwagger\Parameters\Concerns;

trait GeneratesFromRules
{
    protected function splitRules($rules)
    {
        if (is_string($rules)) {
            return explode('|', $rules);
        } else {
            return $rules;
        }
    }

    protected function getParamType(array $paramRules)
    {
        $types = config('laravel-swagger.param_types');

        foreach ($types as $type => $typeRules) {
            foreach ($typeRules as $type) {
                if (in_array($type, $paramRules)) {
                    return $type;
                }
            }
        }

        return 'string';

    }

    protected function isParamRequired(array $paramRules)
    {
        return in_array('required', $paramRules);
    }

    protected function isArrayParameter($param)
    {
        return str_contains($param, '*');
    }

    protected function getArrayKey($param)
    {
        return current(explode('.', $param));
    }

    protected function getEnumValues(array $paramRules)
    {
        $in = $this->getInParameter($paramRules);

        if (!$in) {
            return [];
        }

        [$param, $vals] = explode(':', $in);

        return explode(',', $vals);
    }

    private function getInParameter(array $paramRules)
    {
        foreach ($paramRules as $rule) {
            if (is_string($rule) && starts_with($rule, 'in:')) {
                return $rule;
            }
        }

        return false;
    }
}