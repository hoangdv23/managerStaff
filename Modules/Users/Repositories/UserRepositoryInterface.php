<?php
namespace Modules\Users\Repositories;

use App\Http\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 bản ghi đầu tiên
    public function getUser();

    public function getUserWithRole($role);
    public function getUserByUsername($username);
    
    public function getUserPassword($userId);
}
