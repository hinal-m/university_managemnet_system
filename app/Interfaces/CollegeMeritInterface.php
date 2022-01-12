<?php

namespace App\Interfaces;

interface CollegeMeritInterface
{
   public function all();

   public function store(array $data);

   public function delete(array $data);
}
