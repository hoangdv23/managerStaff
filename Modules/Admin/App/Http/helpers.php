<?php

use App\Enums\CommonType;
use Illuminate\Http\Client\Pool;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


if (!function_exists('checkHasPermission')) {
    function checkHasPermission($userInfo)
    {
        //dd(Cache::has('has_permission'));
        if (Cache::has('has_permission_' . $userInfo->id) && !empty(Cache::get('has_permission_' . $userInfo->id))) {
            //dd(1);
            // tồn tại
            $userPermission = Cache::get('has_permission_' . $userInfo->id);
        } else {
            //dd(2);
            $userPermission = $userInfo->getPermissionsViaRoles()->pluck('name')->toArray();
            Cache::put('has_permission_' . $userInfo->id, $userPermission, 6000);
        }
        //dd($userPermission);
        return $userPermission;
    }
}

if (!function_exists('has_child_permission')) {
    function has_child_permission($module, $rolePermissions)
    {
        $row = \Spatie\Permission\Models\Permission::where('module', $module)->get()->toArray();
        $listDataChild = [];
        foreach ($row as $key => $value) {
            $value['rolePermissions'] = $rolePermissions;
            $listDataChild[] = $value;
        }

        return $listDataChild;
    }
}

if (!function_exists('action_modal')) {
	function action_modal($content, $modalId, $actionModal, $flashMessage = null, $flashType = null) {
		$content->dispatch('refreshCustomerLinksTable');
		$content->dispatch('actionModalDispatch',
			[
				'modalId' => $modalId,
				'actionModal' => $actionModal,
				'flashMessage' => $flashMessage,
				'flashType' => $flashType,
			]);
	}
}

if (!function_exists('getUserInfo')) {
    function getUserInfo()
    {
        return \Auth::guard('web')->user();
    }
}

if (!function_exists('isSuperAdmin')) {
    function isSuperAdmin()
    {
        $userInfo = \Auth::guard('web')->user();
        if ($userInfo->hasRole('super-administrator')) {
            return true;
        } else {
            return false;
        }
    }
}


if (!function_exists('isSuperAdminOrIsLeader')) {
    function isSuperAdminOrIsLeader()
    {
        $userInfo = \Auth::guard('web')->user();
        if ($userInfo->hasRole('super-administrator') || !empty($userInfo->current_team_id)) {
            return true;
        } else {
            return false;
        }
    }
}

