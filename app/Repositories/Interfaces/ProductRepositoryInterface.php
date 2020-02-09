<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{

    public function getAll();

    public function getById($id);

    public function create(array $data);
}
