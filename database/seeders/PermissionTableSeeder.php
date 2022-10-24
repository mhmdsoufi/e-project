<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        $permissions = [
            'Notifications',

            'Invoices',
                'Invoices List',
                    'Add Invoice',
                    'Excel Export',
                    'Edit Invoice',
                    'Delete Invoice',
                    'Change Payment Status',
                    'archive Invoice',
                    'Print Invoice',
                'Paid Invoices',
                'UnPaid Invoices',
                'PartiallyPaid Invoices',
                'Archived Invoices',
                    'Delete Archive Invoice',
                    'Restore Invoice',

            'Add Attachment',
            'Delete Attachment',

            'Reports',
                'Invoices Report',
                'Customers Report',
            'Users',
                'Users List',
                    'Add User',
                    'Edit User',
                    'Delete User',
                'Roles List',
                    'Create Role',
                    'Show Role',
                    'Edit Role',
                    'Delete Role',
            'Settings',
                'Sections',
                    'Add Section',
                    'Edit Section',
                    'Delete Section',
                'Products',
                    'Add Product',
                    'Edit Product',
                    'Delete Product',

        ];
        foreach ($permissions as $permission) {
        Permission::create(['name' => $permission]);
        }

    }
}
