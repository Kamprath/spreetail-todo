<?php

namespace App;

interface ApiModelInterface
{
    /**
     * Returns an array of API-safe model data
     * @return array
     */
    public function toApi(): array;
}