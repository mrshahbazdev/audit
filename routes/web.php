<?php

use App\Http\Controllers\AuditController;
use App\Livewire\AuditAssessment;
use App\Models\Audit;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/docs', 'docs')->name('docs');

Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'de', 'es', 'fr', 'it', 'pt', 'nl', 'ar', 'zh', 'ja'])) {
        session()->put('locale', $locale);
    }
    return back();
})->name('language.switch');

Route::get('/dashboard', function () {
    $userId = auth()->id();
    $orgId = auth()->user()->organization_id;

    $audits = Audit::with(['organization', 'results'])
        ->where(function ($query) use ($userId, $orgId) {
            $query->where('created_by', $userId);
            if ($orgId) {
                $query->orWhere('organization_id', $orgId);
            }
        })
        ->latest()
        ->get();

    return view('dashboard', compact('audits'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Route::post('/audit/start', [AuditController::class, 'start'])->name('audit.start');
    Route::get('/audit/{audit}/assessment', AuditAssessment::class)->name('audit.assessment');
    Route::get('/audit/{audit}/results', [AuditController::class, 'results'])->name('audit.results');
    Route::delete('/audit/{audit}', [AuditController::class, 'destroy'])->name('audit.destroy');
    Route::get('/companies', \App\Livewire\Companies::class)->name('companies');
    Route::get('/templates', \App\Livewire\Templates::class)->name('templates');
    Route::get('/templates/{template}/build', \App\Livewire\TemplateBuilder::class)->name('templates.builder');
    Route::get('/audits', \App\Livewire\Audits::class)->name('audits');
    Route::get('/audit/{audit}/report', [AuditController::class, 'report'])->name('audit.report');
    Route::get('/compare', \App\Livewire\AuditCompare::class)->name('audit.compare');
    Route::get('/allocore-hub', \App\Livewire\AllocoreHub::class)->name('allocore.hub');
});

require __DIR__ . '/auth.php';
