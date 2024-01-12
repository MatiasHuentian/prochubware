<?php

use App\Http\Controllers\Admin\ActivitiesRiskController;
use App\Http\Controllers\Admin\ActivitiesRisksCauseController;
use App\Http\Controllers\Admin\ActivitiesRisksConsequenceController;
use App\Http\Controllers\Admin\ActivitiesRisksImpactController;
use App\Http\Controllers\Admin\ActivitiesRisksPoliticController;
use App\Http\Controllers\Admin\ActivitiesRisksProbabilityController;
use App\Http\Controllers\Admin\AttachmentController;
use App\Http\Controllers\Admin\AttachmentsCategoryController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\DependencyController;
use App\Http\Controllers\Admin\DirectionController;
use App\Http\Controllers\Admin\GlossaryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InputController;
use App\Http\Controllers\Admin\ObejctivesGroupController;
use App\Http\Controllers\Admin\OutputController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProcessController;
use App\Http\Controllers\Admin\ProcessesActivityController;
use App\Http\Controllers\Admin\ProcessesKpiController;
use App\Http\Controllers\Admin\ProcessesStateController;
use App\Http\Controllers\Admin\ProcessesUpgradeProposalController;
use App\Http\Controllers\Admin\RisksControlController;
use App\Http\Controllers\Admin\RisksControlsFrecuencyController;
use App\Http\Controllers\Admin\RisksControlsMethodController;
use App\Http\Controllers\Admin\RisksControlsTypeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UpgradeProposalsStateController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Guest\ProcessController as GuestProcessController;
use App\Http\Controllers\Auth\UserProfileController;
use App\Http\Controllers\OwnProcessController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [OwnProcessController::class, 'index'])->name('dashboard');
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});

Route::group(['as' => 'guest.', 'middleware' => ['auth']], function () {
    Route::get('processes', [GuestProcessController::class, 'index'])->middleware('can:guest_process_index')->name('process.index');
});

// >>Versión del jetstream
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::post('users/csv', [UserController::class, 'csvStore'])->name('users.csv.store');
    Route::put('users/csv', [UserController::class, 'csvUpdate'])->name('users.csv.update');
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

    // Direction
    Route::post('directions/csv', [DirectionController::class, 'csvStore'])->name('directions.csv.store');
    Route::put('directions/csv', [DirectionController::class, 'csvUpdate'])->name('directions.csv.update');
    Route::resource('directions', DirectionController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    // Dependency
    Route::post('dependencies/csv', [DependencyController::class, 'csvStore'])->name('dependencies.csv.store');
    Route::put('dependencies/csv', [DependencyController::class, 'csvUpdate'])->name('dependencies.csv.update');
    Route::resource('dependencies', DependencyController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    // Processes State
    Route::post('processes-states/csv', [ProcessesStateController::class, 'csvStore'])->name('processes-states.csv.store');
    Route::put('processes-states/csv', [ProcessesStateController::class, 'csvUpdate'])->name('processes-states.csv.update');
    Route::resource('processes-states', ProcessesStateController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    // Upgrade Proposals State
    Route::post('upgrade-proposals-states/csv', [UpgradeProposalsStateController::class, 'csvStore'])->name('upgrade-proposals-states.csv.store');
    Route::put('upgrade-proposals-states/csv', [UpgradeProposalsStateController::class, 'csvUpdate'])->name('upgrade-proposals-states.csv.update');
    Route::resource('upgrade-proposals-states', UpgradeProposalsStateController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    // Audit Logs
    Route::resource('audit-logs', AuditLogController::class, ['except' => ['store', 'update', 'destroy', 'create', 'edit']]);

    // Attachments Category
    Route::post('attachments-categories/csv', [AttachmentsCategoryController::class, 'csvStore'])->name('attachments-categories.csv.store');
    Route::put('attachments-categories/csv', [AttachmentsCategoryController::class, 'csvUpdate'])->name('attachments-categories.csv.update');
    Route::resource('attachments-categories', AttachmentsCategoryController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    // Input
    Route::post('inputs/csv', [InputController::class, 'csvStore'])->name('inputs.csv.store');
    Route::put('inputs/csv', [InputController::class, 'csvUpdate'])->name('inputs.csv.update');
    Route::resource('inputs', InputController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    // Glossary
    Route::post('glossaries/csv', [GlossaryController::class, 'csvStore'])->name('glossaries.csv.store');
    Route::put('glossaries/csv', [GlossaryController::class, 'csvUpdate'])->name('glossaries.csv.update');
    Route::resource('glossaries', GlossaryController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    // Process
    Route::get('processes/word/{process}', [ProcessController::class, 'wordExport'])->name('processes.word.export');
    Route::get('processes/pdf/{process}', [ProcessController::class, 'pdfexport'])->name('processes.pdf.export');
    Route::post('processes/csv', [ProcessController::class, 'csvStore'])->name('processes.csv.store');
    Route::put('processes/csv', [ProcessController::class, 'csvUpdate'])->name('processes.csv.update');
    Route::resource('processes', ProcessController::class, ['except' => ['store', 'update', 'destroy']]);

    // Output
    Route::post('outputs/csv', [OutputController::class, 'csvStore'])->name('outputs.csv.store');
    Route::put('outputs/csv', [OutputController::class, 'csvUpdate'])->name('outputs.csv.update');
    Route::resource('outputs', OutputController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    // Obejctives Group
    Route::post('obejctives-groups/csv', [ObejctivesGroupController::class, 'csvStore'])->name('obejctives-groups.csv.store');
    Route::put('obejctives-groups/csv', [ObejctivesGroupController::class, 'csvUpdate'])->name('obejctives-groups.csv.update');
    Route::resource('obejctives-groups', ObejctivesGroupController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    // Risks Controls Type
    Route::post('risks-controls-types/csv', [RisksControlsTypeController::class, 'csvStore'])->name('risks-controls-types.csv.store');
    Route::put('risks-controls-types/csv', [RisksControlsTypeController::class, 'csvUpdate'])->name('risks-controls-types.csv.update');
    Route::resource('risks-controls-types', RisksControlsTypeController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    // Risks Controls Frecuency
    Route::post('risks-controls-frecuencies/csv', [RisksControlsFrecuencyController::class, 'csvStore'])->name('risks-controls-frecuencies.csv.store');
    Route::put('risks-controls-frecuencies/csv', [RisksControlsFrecuencyController::class, 'csvUpdate'])->name('risks-controls-frecuencies.csv.update');
    Route::resource('risks-controls-frecuencies', RisksControlsFrecuencyController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    // Risks Controls Method
    Route::post('risks-controls-methods/csv', [RisksControlsMethodController::class, 'csvStore'])->name('risks-controls-methods.csv.store');
    Route::put('risks-controls-methods/csv', [RisksControlsMethodController::class, 'csvUpdate'])->name('risks-controls-methods.csv.update');
    Route::resource('risks-controls-methods', RisksControlsMethodController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    // Processes Upgrade Proposal
    Route::post('processes-upgrade-proposals/csv', [ProcessesUpgradeProposalController::class, 'csvStore'])->name('processes-upgrade-proposals.csv.store');
    Route::put('processes-upgrade-proposals/csv', [ProcessesUpgradeProposalController::class, 'csvUpdate'])->name('processes-upgrade-proposals.csv.update');
    Route::resource('processes-upgrade-proposals', ProcessesUpgradeProposalController::class, ['except' => ['store', 'update', 'destroy']]);

    // Attachments
    Route::post('attachments/media', [AttachmentController::class, 'storeMedia'])->name('attachments.storeMedia');
    Route::post('attachments/csv', [AttachmentController::class, 'csvStore'])->name('attachments.csv.store');
    Route::put('attachments/csv', [AttachmentController::class, 'csvUpdate'])->name('attachments.csv.update');
    Route::resource('attachments', AttachmentController::class, ['except' => ['store', 'update', 'destroy']]);

    // Processes Activity
    Route::post('processes-activities/csv', [ProcessesActivityController::class, 'csvStore'])->name('processes-activities.csv.store');
    Route::put('processes-activities/csv', [ProcessesActivityController::class, 'csvUpdate'])->name('processes-activities.csv.update');
    Route::resource('processes-activities', ProcessesActivityController::class, ['except' => ['store', 'update', 'destroy']]);

    // Activities Risk
    Route::post('activities-risks/csv', [ActivitiesRiskController::class, 'csvStore'])->name('activities-risks.csv.store');
    Route::put('activities-risks/csv', [ActivitiesRiskController::class, 'csvUpdate'])->name('activities-risks.csv.update');
    Route::resource('activities-risks', ActivitiesRiskController::class, ['except' => ['store', 'update', 'destroy']]);

    // Activities Risks Politic
    Route::post('activities-risks-politics/csv', [ActivitiesRisksPoliticController::class, 'csvStore'])->name('activities-risks-politics.csv.store');
    Route::put('activities-risks-politics/csv', [ActivitiesRisksPoliticController::class, 'csvUpdate'])->name('activities-risks-politics.csv.update');
    Route::resource('activities-risks-politics', ActivitiesRisksPoliticController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    // Activities Risks Probability
    Route::post('activities-risks-probabilities/csv', [ActivitiesRisksProbabilityController::class, 'csvStore'])->name('activities-risks-probabilities.csv.store');
    Route::put('activities-risks-probabilities/csv', [ActivitiesRisksProbabilityController::class, 'csvUpdate'])->name('activities-risks-probabilities.csv.update');
    Route::resource('activities-risks-probabilities', ActivitiesRisksProbabilityController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    // Activities Risks Impact
    Route::post('activities-risks-impacts/csv', [ActivitiesRisksImpactController::class, 'csvStore'])->name('activities-risks-impacts.csv.store');
    Route::put('activities-risks-impacts/csv', [ActivitiesRisksImpactController::class, 'csvUpdate'])->name('activities-risks-impacts.csv.update');
    Route::resource('activities-risks-impacts', ActivitiesRisksImpactController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    // Activities Risks Cause
    Route::post('activities-risks-causes/csv', [ActivitiesRisksCauseController::class, 'csvStore'])->name('activities-risks-causes.csv.store');
    Route::put('activities-risks-causes/csv', [ActivitiesRisksCauseController::class, 'csvUpdate'])->name('activities-risks-causes.csv.update');
    Route::resource('activities-risks-causes', ActivitiesRisksCauseController::class, ['except' => ['store', 'update', 'destroy']]);

    // Activities Risks Consequences
    Route::post('activities-risks-consequences/csv', [ActivitiesRisksConsequenceController::class, 'csvStore'])->name('activities-risks-consequences.csv.store');
    Route::put('activities-risks-consequences/csv', [ActivitiesRisksConsequenceController::class, 'csvUpdate'])->name('activities-risks-consequences.csv.update');
    Route::resource('activities-risks-consequences', ActivitiesRisksConsequenceController::class, ['except' => ['store', 'update', 'destroy']]);

    // Risks Control
    Route::post('risks-controls/csv', [RisksControlController::class, 'csvStore'])->name('risks-controls.csv.store');
    Route::put('risks-controls/csv', [RisksControlController::class, 'csvUpdate'])->name('risks-controls.csv.update');
    Route::resource('risks-controls', RisksControlController::class, ['except' => ['store', 'update', 'destroy']]);

    // Processes Kpi
    Route::post('processes-kpis/csv', [ProcessesKpiController::class, 'csvStore'])->name('processes-kpis.csv.store');
    Route::put('processes-kpis/csv', [ProcessesKpiController::class, 'csvUpdate'])->name('processes-kpis.csv.update');
    Route::resource('processes-kpis', ProcessesKpiController::class, ['except' => ['store', 'update', 'destroy']]);
});

// Auth::routes(['register' => false]);
// Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
//     if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
//         Route::get('/', [UserProfileController::class, 'show'])->name('show');
//     }
// });
