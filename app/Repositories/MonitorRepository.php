<?php

namespace App\Repositories;

use App\Model\Monitor;
use App\Repositories\Interfaces\MonitorRepositoryInterface;

class MonitorRepository implements MonitorRepositoryInterface
{

    public function getByProductId($id)
    {
        return Monitor::where('product_id', $id)
            ->get();
    }

    public function create(array $data)
    {
        return Monitor::create($data);
    }
}
