<?php

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AuditTrailController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\IndexSavingsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Team\EditTeamController;
use App\Http\Controllers\Team\IndexTeamController;
use App\Http\Controllers\Dashboard\StatsController;
use App\Http\Controllers\Roles\IndexRoleController;
use App\Http\Controllers\Team\InviteTeamController;
use App\Http\Controllers\Team\SingleTeamController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Roles\CreateRoleController;
use App\Http\Controllers\Roles\DeleteRoleController;
use App\Http\Controllers\Roles\SingleRoleController;
use App\Http\Controllers\Roles\UpdateRoleController;
use App\Http\Controllers\Team\AcceptInviteController;
use App\Http\Controllers\Team\ResendInviteController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Team\CheckInviteLinkController;
use App\Http\Controllers\Customer\IndexCustomerController;
use App\Http\Controllers\Profile\ChangePasswordController;
use App\Http\Controllers\Roles\UpdateRoleStatusController;
use App\Http\Controllers\Permissions\IndexPermissionController;
use App\Http\Controllers\Team\UpdateTeamMemberStatusController;
use App\Http\Controllers\Transaction\IndexTransactionController;
use App\Http\Controllers\Customer\ShowCustomerController;
use App\Http\Controllers\QuickSaveTransactionsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/check/business-name', [RegisterController::class, 'validateBusinessName']);
Route::post('/check/email', [RegisterController::class, 'validateEmail']);
Route::post('/check/rc-number', [RegisterController::class, 'validateRcNumber']);
Route::post('/email/verify', [VerifyEmailController::class, 'verify']);
Route::post('/email/verify/resend', [VerifyEmailController::class, 'resend']);
Route::prefix('password')->group(function () {
    Route::post('forgot', [PasswordResetController::class, 'sendResetLinkEmail']);
    Route::post('reset', [PasswordResetController::class, 'reset']);
});

Route::get('/banks', [BankController::class, 'index']);
Route::get('/banks/{bank}', [BankController::class, 'show']);
Route::post('/team-members/invite/{inviteRef}/accept', AcceptInviteController::class);
Route::get('/team-members/invite/{inviteRef}/check-link', CheckInviteLinkController::class);


Route::middleware('auth:sanctum', 'account.active')->group(function (){
    // Profile
    Route::prefix('profile')->group(function () {
        Route::post('/change-password', ChangePasswordController::class);
    });
    
    // Roles endpoint
    Route::prefix('roles')->group(function () {
        Route::get('/', IndexRoleController::class);
        Route::post('/', CreateRoleController::class);
        Route::get('/{id}', SingleRoleController::class);
        Route::post('/{id}', UpdateRoleController::class);
        Route::post('/{id}/update-status', UpdateRoleStatusController::class);
        Route::delete('/{id}', DeleteRoleController::class);  
    });
    
    // Roles endpoint
    Route::prefix('team-members')->group(function () {
        Route::get('/', IndexTeamController::class);
        Route::post('/', InviteTeamController::class);
        Route::post('/resend', ResendInviteController::class);
        Route::get('/{id}', SingleTeamController::class);
        Route::post('/{id}', EditTeamController::class);
        Route::post('/{id}/update-status', UpdateTeamMemberStatusController::class);
        Route::delete('/{id}', DeleteRoleController::class);  
    });
    
    Route::prefix('permissions')->group(function () {
        Route::get('/', IndexPermissionController::class);
    });
    
    Route::get('/audit', [AuditTrailController::class, 'index']);
    
    Route::get('user', function(){
        return new UserResource(request()->user());
    });
    
    Route::get('/states', [StateController::class, 'index']);

    
    Route::get('/dashboard/stat', StatsController::class);
    
    Route::get('/customers', IndexCustomerController::class);
    Route::get('/customers/{id}', ShowCustomerController::class);
    Route::get('/savings', IndexSavingsController::class);
    Route::get('/transactions', IndexTransactionController::class);
    Route::get('/dashboard/stats', StatsController::class);

    Route::prefix('transaction')->group(function () {
        Route::get('/', [TransactionController::class, 'index']);
        Route::get('/stat', [TransactionController::class, 'stat']);
        Route::get('/summary/stat', [TransactionController::class, 'transactionSumStat']);
        Route::get('/details/{id}', [TransactionController::class, 'show']);
        Route::post('/export', [TransactionController::class, 'exportByDateRange']);
        Route::get('/employee-id', [TransactionController::class, 'fetchTransactionsByEmployeeId']);
    });
});

Route::get('v1/quicksave/transactions', [QuickSaveTransactionsController::class, 'index']);

