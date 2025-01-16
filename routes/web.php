<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\IdeaPageController;
use App\Http\Controllers\OrderAdminController;
use App\Http\Controllers\ProgramePageController;
use App\Http\Controllers\RecipePageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomePageController::class, 'indexHome'])->name('indexHome');
Route::get('/recipe', [RecipePageController::class, 'indexRecipe'])->name('indexRecipe');
Route::get('/recipe/{id}', [RecipePageController::class, 'showRecipe'])->name('showRecipe');
Route::post('/recipe-rate-add/{id}', [RecipePageController::class, 'AddRate'])->name('AddRate')/*Добавление рейтинга*/;
Route::get('/search', [RecipePageController::class, 'search'])->name('search'); /*Поиск рецептов*/
Route::get('/sort-param', [RecipePageController::class, 'SortParam'])->name('sort_param'); /*Сортировка рецептов по параметрам*/
Route::get('/idea', [IdeaPageController::class, 'indexIdea'])->name('indexIdea');
Route::get('/program', [ProgramePageController::class, 'indexProgram'])->name('indexProgram');
Route::post('/program-show', [ProgramePageController::class, 'showProgram'])->name('showProgram');
Route::get('/program-show/{id}', [ProgramePageController::class, 'showOneProgram'])->name('showOneProgram');
Route::post('/form-buy-programm', [ProgramePageController::class, 'FormBuy'])->name('FormBuy'); /* Оплата заказа */
Route::post('/make-order', [ProgramePageController::class, 'MakeOrder'])->name('MakeOrder'); /* Создание заказа */
Route::resource('/programms', ProgramePageController::class);

/*Личный кабинет*/
Route::get('/account', [AccountController::class, 'index'])->name('indexAccount');
Route::post('/change-photo', [AccountController::class, 'changePhotoForm'])->name('account.changePhotoForm');
Route::post('/change-photo-user/{user}', [AccountController::class, 'changePhotoLogic'])->name('account.changePhotoLogic');
Route::post('/change-password', [AccountController::class, 'changePasswordForm'])->name('account.changePasswordForm');
Route::post('/change-password-user/{user}', [AccountController::class, 'changePasswordLogic'])->name('account.changePasswordLogic');
Route::post('/add-recipe-user', [AccountController::class, 'AddRecipeUserForm'])->name('account.AddRecipeUserForm'); /* Добавление рецепта - форма */
Route::post('/add-recipe-user/{user}', [AccountController::class, 'AddRecipeUser'])->name('account.addRecipe'); /* Добавление рецепта - логика */
Route::post('/user-show-program', [AccountController::class, 'showProgram'])->name('account.showProgram');
Route::get('/check/{id}', [CheckController::class, 'showCheck'])->name('check'); /* Просмотр чека */
Route::get('/check-user-order/{id}', [CheckController::class, 'checkOrder'])->name('account.checkOrder'); /* Получение чека */

/*Авторизация, регистрация, выход*/
Route::get('/registration', [UserController::class, 'create'])->name('registration');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/signup', [UserController::class, 'signup'])->name('signup');
Route::post('/store', [UserController::class,'store'])->name('store');
Route::get('/logout', [UserController::class,'logout'])->name('logout');

/*Избранное*/
Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite.index'); /*index*/
Route::post('/favorite', [FavoriteController::class, 'store'])->name('favorite.store'); /*store*/
Route::delete('/favorite', [FavoriteController::class, 'destroy'])->name('favorite.destroy'); /*delete*/

/*Админ-панель*/
Route::prefix('admin')->group(function () {
    /* Главная страница */
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    /* заказы */
    Route::prefix('orders')->group(function () {
        Route::get('/', [AdminController::class, 'ModerateOrder'])->name('admin.order.index');
        /* Функции с заказами */
        Route::patch('/update-status/{id}', [OrderAdminController::class, 'Update'])->name('admin.order.update'); /*Изменение статуса*/
        Route::patch('/update/{id}', [OrderAdminController::class, 'CancelUpdate'])->name('admin.order.Cancelupdate'); /*Отмена заказа*/
    });


    Route::prefix('recipe')->group(function () {
        /* рецепты */
        Route::get('/', [AdminController::class, 'ModerateRecipe'])->name('admin.recipe.index');
        /*Добавление*/
        Route::post('/store', [RecipePageController::class, 'StoreAdminRecipe'])->name('admin.recipe.store');
        /*Редактирование*/
        Route::patch('/update', [RecipePageController::class, 'UpdateAdminRecipe'])->name('admin.recipe.update');
        Route::patch('/update/ingredient', [RecipePageController::class, 'UpdateAdminRecipeIngredient'])->name('admin.recipe.ingredient.update');
        Route::patch('/update/step', [RecipePageController::class, 'UpdateAdminRecipeStep'])->name('admin.recipe.step.update');
    });

    Route::prefix('program')->group(function () {
        /*Программы*/
        Route::get('/', [AdminController::class, 'ModerateProgram'])->name('admin.program.index');
        /*Добавление*/
        Route::post('/store', [ProgramePageController::class, 'StoreAdminProgram'])->name('admin.program.store');
        /*Редактирование*/
        Route::patch('/update/{id}', [ProgramePageController::class, 'UpdateAdminProgram'])->name('admin.program.update');
    });

});
