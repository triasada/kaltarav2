<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();
Route::group(['middleware' => ['XSS']], function () {
    Route::get('/', 'Frontend\HomeController@index')->name('home');
    Route::get('r/{id}/{slug?}', 'Frontend\PostController@show')->name('post.read')->where('id', '[0-9]+');
    Route::get('p/{id}/{slug?}', 'Frontend\PageController@show')->name('page.read')->where('id', '[0-9]+');
    Route::get('news', 'Frontend\PostController@index')->name('news');
    Route::get('announcment', 'Frontend\PostController@indexAnnouncement')->name('announcement');
    Route::get('registration', 'Frontend\HomeController@registration')->name('registration');
    Route::get('badan-usaha', 'Frontend\BusinessEntityController@index')->name('badan-usaha');
    Route::get('tenaga-kerja-konstruksi', 'Frontend\ExpertDataController@index')->name('tenaga-kerja-konstruksi');
    Route::get('asosiasi', 'Frontend\AssociationController@index')->name('asosiasi');
    Route::get('alat-berat', 'Frontend\InventoryController@showAlatBerat')->name('alat-berat');
    Route::get('bahan-dan-material', 'Frontend\InventoryController@bahanMaterial')->name('bahan-dan-material');
    Route::get('proyek', 'Frontend\HomeController@proyek')->name('proyek');
    Route::get('perguruan-tinggi', 'Frontend\HomeController@school')->name('perguruan-tinggi');
    Route::get('pencari-kerja-konstruksi', 'Frontend\HomeController@jobSeeker')->name('pencari-kerja-konstruksi');
    Route::get('oss', 'Frontend\HomeController@comingsoon')->name('oss');
    Route::get('lpjk', 'Frontend\HomeController@comingsoon')->name('lpjk');
    Route::get('sipjaki', 'Frontend\HomeController@comingsoon')->name('sipjaki');
    Route::get('comingsoon', 'Frontend\HomeController@comingsoon')->name('comingsoon');
    Route::get('gallery-video', 'Frontend\VideoController@index')->name('gallery-video');
    Route::get('gallery-video/{id}', 'Frontend\VideoController@show')->name('gallery-video-show');
    Route::resource('photo-gallery', 'Frontend\GalleryController');

    Route::get('dashboard', 'Backend\HomeController@index')->middleware('auth')->name('dashboard');
    Route::post('upload-image', 'ImageController@upload')->name('image.upload');
    Route::post('upload-image-page', 'ImageController@uploadImagePage')->name('image.upload.page');

    Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
        Route::get('profile', 'Backend\UserController@editProfile')->name('profile.edit');
        Route::put('profile/update', 'Backend\UserController@updateProfile')->name('profile.update');
        Route::get('edit-password', 'Backend\UserController@editPassword')->name('user.password.edit');
        Route::put('update-password', 'Backend\UserController@updatePassword')->name('user.password.update');
    });

    Route::resource('post', 'Backend\PostController')->middleware('auth');
    Route::resource('gallery', 'Backend\GalleryController')->middleware('auth');
    Route::resource('page', 'Backend\PageController')->middleware('auth');
    Route::resource('user', 'Backend\UserController')->middleware('auth');
    Route::get('user/{id}/edit-password', 'Backend\UserController@editPasswordAdmin')->middleware('auth')->name('user.edit-password');
    Route::post('user/{id}/update-password', 'Backend\UserController@updatePasswordAdmin')->middleware('auth')->name('user.update-password');
    Route::resource('role', 'Backend\RoleController')->middleware('auth');
    Route::get('user/{id}/approve', 'Backend\UserController@approve')->middleware('auth')->name('user.approve');
    Route::get('user/{id}/cancel-approve', 'Backend\UserController@cancelApprove')->middleware('auth')->name('user.cancel.approve');

// certification
    Route::get('certification/registration/{id}', 'Frontend\CertificationController@registration')->name('certification.registration')->where('id', '[0-9]+');
    Route::post('certification/registration/{id}/store', 'Frontend\CertificationController@registrationStore')->name('certification.registration.store')->where('id', '[0-9]+');
    Route::resource('certification', 'Backend\CertificationController')->middleware('auth');
    Route::get('certification/{id}/participant', 'Backend\CertificationParticipantController@participant')->middleware('auth')->name('certification.participants')->where('id', '[0-9]+');
    Route::get('certification/{id}/participant/excel', 'Backend\CertificationParticipantController@participantExcel')->middleware('auth')->name('certification.participants.excel')->where('id', '[0-9]+');

// training
    Route::get('training/registration/{id}', 'Frontend\TrainingController@registration')->name('training.registration')->where('id', '[0-9]+');
    Route::post('training/registration/{id}/store', 'Frontend\TrainingController@registrationStore')->name('training.registration.store')->where('id', '[0-9]+');
    Route::resource('training', 'Backend\TrainingController')->middleware('auth');
    Route::get('training/{id}/participant', 'Backend\TrainingParticipantController@participant')->middleware('auth')->name('training.participants')->where('id', '[0-9]+');
    Route::get('training/{id}/participant/excel', 'Backend\TrainingParticipantController@participantExcel')->middleware('auth')->name('training.participants.excel')->where('id', '[0-9]+');


    Route::get('association/import', 'Backend\AssociationController@import')->middleware('auth')->name('association.import');
    Route::post('association/store/import', 'Backend\AssociationController@storeImport')->middleware('auth')->name('association.store.import');
    Route::resource('association', 'Backend\AssociationController')->middleware('auth');

    Route::get('business-entity/import', 'Backend\BusinessEntityController@import')->middleware('auth')->name('business-entity.import');
    Route::post('business-entity/store/import', 'Backend\BusinessEntityController@storeImport')->middleware('auth')->name('business-entity.store.import');
    Route::resource('business-entity', 'Backend\BusinessEntityController')->middleware('auth');

    Route::get('expert-data/import', 'Backend\ExpertDataController@import')->middleware('auth')->name('expert-data.import');
    Route::post('expert-data/store/import', 'Backend\ExpertDataController@storeImport')->middleware('auth')->name('expert-data.store.import');
    Route::resource('expert-data', 'Backend\ExpertDataController')->middleware('auth');
    Route::resource('skilled-data', 'Backend\SkilledDataController')->middleware('auth');

    Route::get('web-setting', 'Backend\WebSettingController@edit')->name('web-setting.edit')->middleware('auth');
    Route::put('web-setting', 'Backend\WebSettingController@update')->name('web-setting.update')->middleware('auth');

    Route::get('inventory-equipment/import', 'Backend\EquipmentController@import')->middleware('auth')->name('inventory-equipment.import');
    Route::post('inventory-equipment/store/import', 'Backend\EquipmentController@storeImport')->middleware('auth')->name('inventory-equipment.store.import');
    Route::resource('inventory-equipment', 'Backend\EquipmentController')->middleware('auth');
    Route::get('inventory-material/import', 'Backend\MaterialController@import')->middleware('auth')->name('inventory-material.import');
    Route::post('inventory-material/store/import', 'Backend\MaterialController@storeImport')->middleware('auth')->name('inventory-material.store.import');
    Route::resource('inventory-material', 'Backend\MaterialController')->middleware('auth');
    Route::resource('link-url', 'Backend\LinkUrlController')->middleware('auth');

    Route::get('project/import', 'Backend\ProjectJobController@import')->middleware('auth')->name('project.import');
    Route::post('project/store/import', 'Backend\ProjectJobController@storeImport')->middleware('auth')->name('project.store.import');
    Route::resource('project', 'Backend\ProjectJobController')->middleware('auth');

    Route::get('school/import', 'Backend\SchoolController@import')->middleware('auth')->name('school.import');
    Route::post('school/store/import', 'Backend\SchoolController@storeImport')->middleware('auth')->name('school.store.import');
    Route::resource('school', 'Backend\SchoolController')->middleware('auth');
    Route::resource('job-seeker', 'Backend\JobSeekerController')->middleware('auth');
    Route::resource('school-major', 'Backend\SchoolMajorController')->middleware('auth');
    Route::resource('video', 'Backend\VideoController')->middleware('auth');

    //hargasatuan addon
    Route::resource('harga_satuan', 'Backend\HargaSatuanController')->middleware('auth');
    Route::get('/get-kecamatan/{kabupaten_id}','Backend\HargaSatuanController@getKecamatan')->middleware('auth');

});
