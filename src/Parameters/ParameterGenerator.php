<?php

namespace Hasnhasan\LaravelSwagger\Parameters;

interface ParameterGenerator
{
    public function getParameters();

    public function getParamLocation();
}