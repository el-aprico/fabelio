<?php

namespace App\Console\Commands;

use App\Http\Libraries\Fabelio;
use App\Repositories\Interfaces\MonitorRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Console\Command;

class PriceMonitoring extends Command
{

    private $productRepo;
    private $monitorRepo;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'price:monitor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Price Monitoring';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductRepositoryInterface $productRepo, MonitorRepositoryInterface $monitorRepo)
    {
        $this->productRepo = $productRepo;
        $this->monitorRepo = $monitorRepo;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $products = $this->productRepo->getAll();
        foreach ($products as $key => $val) {
            $res = Fabelio::returnJsonProduct($val->url);
            if ($res) {
                $args = [
                    'product_id' => $val->id,
                    'price' => $res['price'],
                ];
                $this->monitorRepo->create($args);
            }
        }
    }
}
