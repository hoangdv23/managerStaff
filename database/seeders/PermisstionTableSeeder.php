<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
class PermisstionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Schema::hasTable('permissions')) {
            //User Module Permission
            $check_permission = \DB::table('permissions')->where([
                'name' => 'user-index',
                'module' => 'Quản lý tài khoản',
                'guard_name' => 'web',
            ])->first();
        }
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'user-index',
                'module' => 'Quản lý tài khoản',
                'description' => 'Truy cập trang danh sách Quản lý tài khoản',
                'guard_name' => 'web',
            ]);
        }
        $check_permission = \DB::table('permissions')->where([
            'name' => 'user-create',
            'module' => 'Quản lý tài khoản',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'user-create',
                'module' => 'Quản lý tài khoản',
                'description' => 'Truy cập trang tạo Quản lý tài khoản',
                'guard_name' => 'web',
            ]);
        }

        $check_permission = \DB::table('permissions')->where([
            'name' => 'user-update',
            'module' => 'Quản lý tài khoản',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'user-update',
                'module' => 'Quản lý tài khoản',
                'description' => 'Truy cập trang chỉnh sửa Quản lý tài khoản',
                'guard_name' => 'web',
            ]);
        }

        $check_permission = \DB::table('permissions')->where([
            'name' => 'user-delete',
            'module' => 'Quản lý tài khoản',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'user-delete',
                'module' => 'Quản lý tài khoản',
                'description' => 'Truy cập trang xóa Quản lý tài khoản',
                'guard_name' => 'web',
            ]);
        }
        // Quyền truy cập
        $check_permission = \DB::table('permissions')->where([
            'name' => 'role-index',
            'module' => 'Quyền truy cập',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'role-index',
                'module' => 'Quyền truy cập',
                'description' => 'Truy cập trang danh sách Quyền truy cập',
                'guard_name' => 'web',
            ]);
        }

        $check_permission = \DB::table('permissions')->where([
            'name' => 'role-create',
            'module' => 'Quyền truy cập',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'role-create',
                'module' => 'Quyền truy cập',
                'description' => 'Truy cập trang tạo Quyền truy cập',
                'guard_name' => 'web',
            ]);
        }

        $check_permission = \DB::table('permissions')->where([
            'name' => 'role-update',
            'module' => 'Quyền truy cập',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'role-update',
                'module' => 'Quyền truy cập',
                'description' => 'Truy cập trang chỉnh sửa Quyền truy cập',
                'guard_name' => 'web',
            ]);
        }

        $check_permission = \DB::table('permissions')->where([
            'name' => 'role-delete',
            'module' => 'Quyền truy cập',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'role-delete',
                'module' => 'Quyền truy cập',
                'description' => 'Truy cập trang xóa Quyền truy cập',
                'guard_name' => 'web',
            ]);
        }
        // khách hàng
        $check_permission = \DB::table('permissions')->where([
            'name' => 'customer-index',
            'module' => 'Quản lý khách hàng',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'customer-index',
                'module' => 'Quản lý khách hàng',
                'description' => 'Truy cập trang danh sách khách hàng',
                'guard_name' => 'web',
            ]);
        }

        $check_permission = \DB::table('permissions')->where([
            'name' => 'customer-create',
            'module' => 'Quản lý khách hàng',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'customer-create',
                'module' => 'Quản lý khách hàng',
                'description' => 'Truy cập trang tạo hồ sơ khách hàng',
                'guard_name' => 'web',
            ]);
        }

        $check_permission = \DB::table('permissions')->where([
            'name' => 'customer-update',
            'module' => 'Quản lý khách hàng',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'customer-update',
                'module' => 'Quản lý khách hàng',
                'description' => 'Truy cập trang chỉnh sửa hồ sơ khách hàng',
                'guard_name' => 'web',
            ]);
        }

        $check_permission = \DB::table('permissions')->where([
            'name' => 'customer-delete',
            'module' => 'Quản lý khách hàng',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'customer-delete',
                'module' => 'Quản lý khách hàng',
                'description' => 'Truy cập trang xóa hồ sơ khách hàng',
                'guard_name' => 'web',
            ]);
        }

        $check_permission = \DB::table('permissions')->where([
            'name' => 'customer-export',
            'module' => 'Quản lý khách hàng',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'customer-export',
                'module' => 'Quản lý khách hàng',
                'description' => 'Truy cập trang xuất dữ liệu hồ sơ khách hàng',
                'guard_name' => 'web',
            ]);
        }

        

        $check_permission = \DB::table('permissions')->where([
            'name' => 'customer-setting',
            'module' => 'Quản lý khách hàng',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'customer-setting',
                'module' => 'Quản lý khách hàng',
                'description' => 'Truy cập trang cài đặt hồ sơ khách hàng',
                'guard_name' => 'web',
            ]);
        }

        //Report
        $check_permission = \DB::table('permissions')->where([
            'name' => 'report-index',
            'module' => 'Quản lý Module Báo cáo',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'report-index',
                'module' => 'Quản lý Module Báo cáo',
                'description' => 'Truy cập Module Báo cáo',
                'guard_name' => 'web',
            ]);
        }

        //quản lý công việc
        $check_permission = \DB::table('permissions')->where([
            'name' => 'job-index',
            'module' => 'Quản lý công việc',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'job-index',
                'module' => 'Quản lý công việc',
                'description' => 'Truy cập trang danh sách công việc',
                'guard_name' => 'web',
            ]);
        }

        $check_permission = \DB::table('permissions')->where([
            'name' => 'job-create',
            'module' => 'Quản lý công việc',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'job-create',
                'module' => 'Quản lý công việc',
                'description' => 'Truy cập trang tạo công việc',
                'guard_name' => 'web',
            ]);
        }

        $check_permission = \DB::table('permissions')->where([
            'name' => 'job-update',
            'module' => 'Quản lý công việc',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'job-update',
                'module' => 'Quản lý công việc',
                'description' => 'Truy cập trang chỉnh sửa công việc',
                'guard_name' => 'web',
            ]);
        }

        $check_permission = \DB::table('permissions')->where([
            'name' => 'job-delete',
            'module' => 'Quản lý công việc',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'job-delete',
                'module' => 'Quản lý công việc',
                'description' => 'Truy cập trang xóa công việc',
                'guard_name' => 'web',
            ]);
        }

        $check_permission = \DB::table('permissions')->where([
            'name' => 'job-export',
            'module' => 'Quản lý công việc',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'job-export',
                'module' => 'Quản lý công việc',
                'description' => 'Truy cập trang xuất dữ liệu công việc',
                'guard_name' => 'web',
            ]);
        }
        $check_permission = \DB::table('permissions')->where([
            'name' => 'job-editor',
            'module' => 'Quản lý công việc',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'job-editor',
                'module' => 'Quản lý công việc',
                'description' => 'Cho phép chỉnh sửa editor',
                'guard_name' => 'web',
            ]);
        }
        $check_permission = \DB::table('permissions')->where([
            'name' => 'job-QC',
            'module' => 'Quản lý công việc',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'job-QC',
                'module' => 'Quản lý công việc',
                'description' => 'Cho phép chỉnh sửa QC',
                'guard_name' => 'web',
            ]);
        }
        $check_permission = \DB::table('permissions')->where([
            'name' => 'job-process',
            'module' => 'Quản lý công việc',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'job-process',
                'module' => 'Quản lý công việc',
                'description' => 'Cho phép chỉnh sửa trạng thái Status thành PROCESS',
                'guard_name' => 'web',
            ]);
        }
        $check_permission = \DB::table('permissions')->where([
            'name' => 'job-reject',
            'module' => 'Quản lý công việc',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'job-reject',
                'module' => 'Quản lý công việc',
                'description' => 'Cho phép chỉnh sửa trạng thái Status thành REJECT',
                'guard_name' => 'web',
            ]);
        }
        $check_permission = \DB::table('permissions')->where([
            'name' => 'job-done',
            'module' => 'Quản lý công việc',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'job-done',
                'module' => 'Quản lý công việc',
                'description' => 'Cho phép chỉnh sửa trạng thái Status thành DONE',
                'guard_name' => 'web',
            ]);
        }
        $check_permission = \DB::table('permissions')->where([
            'name' => 'job-approve',
            'module' => 'Quản lý công việc',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'job-approve',
                'module' => 'Quản lý công việc',
                'description' => 'Cho phép chỉnh sửa trạng thái Status thành APPROVE',
                'guard_name' => 'web',
            ]);
        }
        $check_permission = \DB::table('permissions')->where([
            'name' => 'job-sent',
            'module' => 'Quản lý công việc',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'job-sent',
                'module' => 'Quản lý công việc',
                'description' => 'Cho phép chỉnh sửa trạng thái Status thành SENT',
                'guard_name' => 'web',
            ]);
        }
        $check_permission = \DB::table('permissions')->where([
            'name' => 'job-receive',
            'module' => 'Quản lý công việc',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'job-receive',
                'module' => 'Quản lý công việc',
                'description' => 'Cho phép click để nhận job',
                'guard_name' => 'web',
            ]);
        }
        $check_permission = \DB::table('permissions')->where([
            'name' => 'job-fixedLink',
            'module' => 'Quản lý công việc',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'job-fixedLink',
                'module' => 'Quản lý công việc',
                'description' => 'Cho phép chỉnh sửa link gốc',
                'guard_name' => 'web',
            ]);
        }
        $check_permission = \DB::table('permissions')->where([
            'name' => 'job-fixedLink',
            'module' => 'Quản lý công việc',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'job-fixedLink',
                'module' => 'Quản lý công việc',
                'description' => 'Cho phép chỉnh sửa link gốc',
                'guard_name' => 'web',
            ]);
        }
        $check_permission = \DB::table('permissions')->where([
            'name' => 'job-editedLink',
            'module' => 'Quản lý công việc',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'job-editedLink',
                'module' => 'Quản lý công việc',
                'description' => 'Cho phép Editor up link',
                'guard_name' => 'web',
            ]);
        }
        $check_permission = \DB::table('permissions')->where([
            'name' => 'job-checkedLink',
            'module' => 'Quản lý công việc',
            'guard_name' => 'web',
        ])->first();
        if (!$check_permission) {
            \DB::table('permissions')->insert([
                'name' => 'job-checkedLink',
                'module' => 'Quản lý công việc',
                'description' => 'Cho phép chỉnh sửa link Hoàn thành',
                'guard_name' => 'web',
            ]);
        }
        
    }
    
}
