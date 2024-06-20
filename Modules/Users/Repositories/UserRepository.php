<?php

namespace Modules\Users\Repositories;

use App\Http\Repositories\BaseRepository;
use Modules\Users\Entities\User;
use Modules\Users\Repositories\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return User::class;
    }

    public function getUser()
    {
        return $this->model->select('name')->take(5)->get();
    }
    public function getUserPassword($userId)
    {
        return $this->model->where('id', $userId)->pluck('sso_id')->first();
    }

    public function getUserWithRole($role)
    {
        return $this->model->role($role)->get();
    }


    public function checkInfoTeamLead($userInfo)
    {
        $isTeamLead = $this->model->whereNotNull('current_team_id')->where('id', $userInfo->id)->first();
        if ($isTeamLead) {
            $idTeam = $isTeamLead->current_team_id;
        } else {
            $idTeam = NULL;
        }
        return $idTeam;
    }

    public function getUserById($userId)
    {
        return $this->model->where('id', $userId)->first();
    }


    public function getTotalUser()
    {
        return $this->model->select('id')->where('status', 1)->get()->count();
    }


    public function getUserByUsername($username)
    {
        return $this->model->where('username', $username)->first();
    }



}
