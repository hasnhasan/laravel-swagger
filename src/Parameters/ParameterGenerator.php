<?php

namespace hasnhasan\LaravelSwagger\Parameters;

interface ParameterGenerator
{
    public function getParameters();

    public function getParamLocation();
}