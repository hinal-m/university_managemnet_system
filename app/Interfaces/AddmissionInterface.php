<?php

namespace App\Interfaces;

interface AddmissionInterface
{
   public function all();

   public function store(array $data);
}
