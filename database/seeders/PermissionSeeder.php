<?php
namespace Database\Seeders;

use App\Enum\UserTypeEnum;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $platformOwnerRole = Role::where('name', 'Super Admin')->where('status', 'active')->where('is_default', true)->first();
        if(!$platformOwnerRole){
            $platformOwnerRole = Role::create(['name' => 'Super Admin', 'description' => 'Super Admin', 'status' => 'active', 'is_default' => true]);
        }
        
        
        $adminDefaultPermissions = [
            'dashboard' => [
                'view_dashboard' => 'View Dashboard',
            ],
            'customers' => [
                'view_customer' => 'View Customer',
                'create_customer' => 'Create Customer',
                'update_customer' => 'Update Customer',
                'activate_customer' => 'Activate Customer',
                'deactivate_customer' => 'Deactivate Customer',
                'delete_customer' => 'Delete Customer',
            ],
            'savings' => [
                'view_savings' => 'View Savings',
                'terminate_savings' => 'Terminate Savings',
                'fund_savings' => 'Fund Savings',
                'pause_savings' => 'Pause Savings',
                'delete_savings' => 'Delete Savings',
            ],
            // 'loan' => [
            //     'view_loan' => 'View Loan',
            //     'book_loan' => 'Book Loan',
            //     'approve_loan' => 'Approve Loan',
            //     'decline_loan' => 'Decline Loan',
            // ],
            'transaction' => [
                'view_transaction' => 'View Transaction',
            ],
            'team' => [
                'view_team' => 'View Team',
                'invite_team' => 'Invite Team',
                'edit_team' => 'Edit Team',
                'activate_team' => 'Activate Team',
                'deactivate_team' => 'Deactivate Team',
                'delete_team' => 'Delete Team',
            ],
            'role' => [
                'view_role' => 'View Role',
                'create_role' => 'Create Role',
                'edit_role' => 'Edit Role',
                'activate_role' => 'Activate Role',
                'deactivate_role' => 'Deactivate Role',
            ],
            'audit-trail' => [
                'view_audit_trail' => 'View Audit Trail',
            ],
            'settings' => [
                'view_settings' => 'View Settings',
                'edit_settings' => 'Edit Settings',
            ]
        ];

        foreach ($adminDefaultPermissions as $module => $actions) {
            foreach ($actions as $action => $description) {
                // Check if the permission already exists
                $permission = Permission::where('module', $module)
                    ->where('action', $action)
                    ->where('user_type', UserTypeEnum::ADMIN)
                    ->first();

                // Create the permission only if it doesn't exist
                if (!$permission) {
                    $permission = Permission::create([
                        'module' => $module,
                        'action' => $action,
                        'description' => $description,
                        'user_type' => UserTypeEnum::ADMIN
                    ]);
                }

                // Associate permissions with default roles
                $platformOwnerRole->permissions()->attach($permission);
            }
        }
    }
}
