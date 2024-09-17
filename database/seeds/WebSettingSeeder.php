<?php

use App\PermissionGroup;
use App\WebSetting;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class WebSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'twitter',
                'value' => null,
                'is_active' => 1
            ],
            [
                'name' => 'facebook',
                'value' => null,
                'is_active' => 1
            ],
            [
                'name' => 'youtube',
                'value' => null,
                'is_active' => 1
            ],
            [
                'name' => 'instagram',
                'value' => null,
                'is_active' => 1
            ],
        ];

        foreach ($data as $value) 
        {
            $webSetting = WebSetting::create($value);
        }

        $permissionGroup = PermissionGroup::create(['name' => 'Web Setting']);
        $permission = Permission::create(['permission_group_id' => $permissionGroup->id,'name' => 'edit web-setting']);
    }
}
