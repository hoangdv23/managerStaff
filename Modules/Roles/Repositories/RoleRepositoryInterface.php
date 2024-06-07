<?php

namespace Modules\Roles\Repositories;
use App\Http\Repositories\RepositoryInterface;

interface RoleRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 bản ghi đầu tiên
    public function getRole();

    public function getRelationship($id);

}

