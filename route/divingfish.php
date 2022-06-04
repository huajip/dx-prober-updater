<?php
use think\facade\Route;
Route::group('diving-fish', function () {
    Route::post('updateRecord', 'divingfish.Prober/updateRecordPageParser');
})->completeMatch();