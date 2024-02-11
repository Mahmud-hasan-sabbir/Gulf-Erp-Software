<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Helpers\Helper;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee_code = Helper::IDGenerator(new User, 'employee_code', 5, 'GF'); /* Generate id */
        $supper_admin = User::create([
            'name'=>'SUPER-ERP',
            'email'=>'super@gmail.com',
            'contact_number'=>'01909302126',
            'employee_code'=>$employee_code,
            'password'=>bcrypt('password'),
            'status' => '1',
            'is_admin' => '1',
            'profile_photo_path'=>'fix/admin.jpg',
            'email_verified_at' => '2024-01-01',
            'mast_work_station_id' => '1',
        ]);
        $admin = User::create([
            'name'=>'Gulf-ERP',
            'email'=>'admin@gmail.com',
            'contact_number'=>'01909302126',
            'employee_code'=>$employee_code,
            'password'=>bcrypt('password'),
            'status' => '1',
            'is_admin' => '0',
            'profile_photo_path'=>'fix/admin.jpg',
            'email_verified_at' => '2024-01-01',
            'mast_work_station_id' => '2',
        ]);
        /*__________________________________________________________ */
        /*__________________________________________________________ */
        $permissions = [
            /*_____Menu Access_____*/
            ['name' => 'Super-Admin'],
            ['name' => 'Admin'],
            ['name' => 'Moderator'],
            ['name' => 'Manager'],
            ['name' => 'Supervisor'],
            ['name' => 'Employee'],
            ['name' => 'Viewer'],
            ['name' => 'Editor'],
            ['name' => 'Customer'],
            ['name' => 'Sales'],
            ['name' => 'Support'],
            ['name' => 'Developer'],
            ['name' => 'Analyst'],
            ['name' => 'Tester'],
            ['name' => 'Guest'],
            ['name' => 'Marketing'],
            ['name' => 'Finance'],
            ['name' => 'HR'],

            /*_____Menu Access_____*/
            ['name' => 'Hr access'],
            ['name' => 'Inventory access'],
            ['name' => 'Sales access'],
            ['name' => 'Warrenty access'],
            
            // HR => Employee Access
            ['name' => 'Employee access'],
            ['name' => 'Employee create'],
            ['name' => 'Employee edit'],
            ['name' => 'Employee delete'],

            // HR => Leave Access
            ['name' => 'Leave access'],
            ['name' => 'Leave create'],
            ['name' => 'Leave edit'],
            ['name' => 'Leave delete'],

            // HR => Attendance Access
            ['name' => 'Attendance access'],
            ['name' => 'Attendance create'],
            ['name' => 'Attendance edit'],
            ['name' => 'Attendance delete'],

            // HR => Salary Access
            ['name' => 'Salary access'],
            ['name' => 'Salary create'],
            ['name' => 'Salary edit'],
            ['name' => 'Salary delete'],

            // HR => Data Setting
            ['name' => 'Hr setting access'],
            ['name' => 'Inventory setting access'],
            ['name' => 'Sales setting access'],
            ['name' => 'Warrenty setting access'],
            
            // SETTING => User Access
            ['name' => 'User access'],
            ['name' => 'User create'],
            ['name' => 'User edit'],
            ['name' => 'User delete'],
            
            // SETTING => Role Access
            ['name' => 'Role access'],
            ['name' => 'Role create'],
            ['name' => 'Role edit'],
            ['name' => 'Role delete'],
        ];

        foreach ($permissions as $item) {
            Permission::create($item);
        }
        
        $supper_admin_role = Role::create(['name' => 'Super-Admin']);
        $admin_role = Role::create(['name' => 'Admin']);
        
        $supper_admin_role->givePermissionTo(Permission::all());
        $admin_role->givePermissionTo('Admin');

        $supper_admin->assignRole($supper_admin_role);
        $admin->assignRole($admin_role);
    }
}
