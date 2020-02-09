<?php

namespace App\Repositories\Interfaces;

interface MonitorRepositoryInterface
{

    public function getByProductId($id);

    public function create(array $data);
}
