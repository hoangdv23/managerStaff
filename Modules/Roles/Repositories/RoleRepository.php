<?php

namespace Modules\Roles\Repositories;

use App\Http\Repositories\BaseRepository;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Role::class;
    }

    public function getRole()
    {
        return $this->model->select('name')->take(5)->get();
    }

    public function getRelationship($id)
    {
        return $this->model->with('permissions')->where('id', $id)->get();
    }
}
