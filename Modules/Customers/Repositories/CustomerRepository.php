<?php

namespace Modules\Customers\Repositories;

use App\Http\Repositories\BaseRepository;
use Modules\Customers\Entities\Customer;
use Modules\Customers\Repositories\CustomerRepositoryInterface;
class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Customer::class;
    }
    public function getListCustomer(){
        $listCustomer = $this->model->where('status', 1)->get()->toArray();
        return $listCustomer;
    }

}
