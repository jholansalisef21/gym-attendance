
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

Route::resource('members', MemberController::class);
Route::get('/', [MemberController::class, 'index'])->name('members.index');
