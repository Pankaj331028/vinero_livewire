<?php

namespace Database\Seeders;

use Config;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsDemoSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		foreach (Config::get('constants.modules') as $key => $value) {
			foreach ($value['actions'] as $action) {
				Permission::create(['name' => $action . ' ' . $key, 'guard_name' => 'admin', 'module' => $key]);
			}
		}

	}
}
