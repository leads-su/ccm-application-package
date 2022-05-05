<?php

Route::prefix('ccm')->group(static function (): void {
    Route::name('domain.ccm.releases')->get('releases', \ConsulConfigManager\Application\Http\Controllers\Release\ReleaseListController::class);
    Route::name('domain.ccm.releases.latest')->get('latest', \ConsulConfigManager\Application\Http\Controllers\Release\ReleaseLatestController::class);
});
