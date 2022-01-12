<?php

namespace App\Interfaces;

interface CollegeCourseInterface
{
   public function all();

   public function store(array $data);

   public function update(array $data);

   public function delete(array $data);
}
