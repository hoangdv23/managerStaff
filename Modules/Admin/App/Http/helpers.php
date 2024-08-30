<?php

use App\Enums\CommonType;
use Illuminate\Http\Client\Pool;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Customers\Entities\Customer;
use Modules\Jobs\Entities\Jobs_have_type_service;
use Modules\Customers\Entities\Customer_Type_Service;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Entities\Type_service;
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


if (!function_exists('hasTypeServices')) {
    function hasTypeServices($type_service_id,$job_id)
    {
        // dd($type_service_id,$job_id);
        $checkExist = Jobs_have_type_service::Where('type_service_id',$type_service_id)->Where('job_id',$job_id)->exists(); // đoạn này nếu check trường thì get() rồi lấy dữ liệu
        if($checkExist ){
            // $totalSum = Jobs_have_type_service::where('type_service_id', $type_service_id)->where('job_id', $job_id)
            // ->select(DB::raw('SUM(total_qc_price + total_price) as total_sum'))->value('total_sum');
            //  $formattedTotalSum = '$' . number_format($totalSum, 2);
                $amount = Jobs_have_type_service::where('type_service_id', $type_service_id)->where('job_id', $job_id)->value('amount');
             return $amount;
        }else{
            return "";
        }

    }
}

if (!function_exists('getNameCustomerByID')) { // nhớ dùng !function_exists, vì helper chạy ngoài chương trình, nhiều tiến trình gọi cùng 1 funtion sẽ lỗi
    function getNameCustomerByID($id)
    {
        $checkExist = Customer::where('id',$id)->first();
        if($checkExist ){
            return $checkExist->name;
        }else{
            return "Không tìm thấy Id Khách hàng";
        }

    }
}

if (!function_exists('getNameJobByID')) { // nhớ dùng !function_exists, vì helper chạy ngoài chương trình, nhiều tiến trình gọi cùng 1 funtion sẽ lỗi
    function getNameJobByID($id)
    {
        $checkExist = Job::where('id',$id)->first();
        if($checkExist ){
            return $checkExist->name;
        }else{
            return "Không tìm thấy Id Job";
        }

    }
}

if (!function_exists('invoiceCustomer')) {
    function invoiceCustomer($job_id)
    {
        $totalSum = Jobs_have_type_service::where('job_id', $job_id)->sum('total_price');
             $formattedTotalSum = '$' . number_format($totalSum, 2);
             return $formattedTotalSum;
    }
}

if (!function_exists('stripVN')) {

    function stripVN($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
    
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = str_replace(' ', '-', $str);
        return $str;
    }
}

if (!function_exists('colorType')) {
    function colorType($typeId)
    {
        $color = Type_service::where('id',$typeId)->value('color');
             return $color;
    }
}

if (!function_exists('typeServiceName')) {
    function typeServiceName($typeService_id)
    {
        $color = Type_service::where('id',$typeService_id)->value('name');
             return $color;
    }
}

if (!function_exists('typeServiceNameByCus')) {
    function typeServiceNameByCus($cus_id)
    {

        $listType = Customer_Type_Service::where('customer_id',$cus_id)->get('typeService_id');
        // dd($listType['typeService_id']);
        $typeServiceIds = $listType->pluck('typeService_id')->toArray();
        $typename = Type_service::whereIn('id', $typeServiceIds)->orderByDesc('id')->pluck('name', 'id')->toArray();
        // dd($typename);
        return $typename;
    }
}

