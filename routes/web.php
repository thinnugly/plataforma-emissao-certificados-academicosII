<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudanteController;
use App\Http\Controllers\CertificadoController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\Disciplina_professor;
use App\Http\Controllers\Lancar_notasController;

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

Route::get('/', function () {
    return view('auth.login');
});

//Auth::routes();
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function(){

    //auth route for administrator
    Route::group(['middleware'=>['auth', 'role:administrator']], function ()
    {
        //Estudante

        Route::resource('/administrator/estudantes', EstudanteController::class);
        Route::get('/administrator/estudantes', [App\Http\Controllers\EstudanteController::class, 'index'])->name('estudantes');
        Route::get('/administrator/estudantes/create', [App\Http\Controllers\EstudanteController::class, 'getAllToStudentCreate'])->name('create');
        Route::get('/administrator/estudantes/edit', [App\Http\Controllers\EstudanteController::class, 'getAllToStudentEdit'])->name('edit');
        Route::get('/administrator/estudantes/edit/{id}', [App\Http\Controllers\EstudanteController::class, 'edit'])->name('editStu');
        Route::get('/administrator/estudantes/show/{id}', [App\Http\Controllers\EstudanteController::class, 'show'])->name('showStu');
        Route::get('/findNaturalidadeByPais', [App\Http\Controllers\EstudanteController::class, 'findNaturalidadeByPais']);
        Route::get('/findMordaByNaturalidade', [App\Http\Controllers\EstudanteController::class, 'findMordaByNaturalidade']);
        Route::get('/findNameByEmail', [App\Http\Controllers\EstudanteController::class, 'findNameByEmail']);
        Route::delete('/administrator/estudantes/delete/{id}', [App\Http\Controllers\EstudanteController::class, 'deleteStu']);
        Route::get('/administrator', [App\Http\Controllers\EstudanteController::class, 'getAllStu'])->name('sendQtdUserD');
        Route::get('/testeTe', [App\Http\Controllers\EstudanteController::class, 'testeT'])->name('testeT');
        Route::get('/getStuQTDByTurmaName', [App\Http\Controllers\EstudanteController::class, 'getStuQTDByTurmaName']);
        Route::get('/getAllStuTurmaName', [App\Http\Controllers\EstudanteController::class, 'getAllStuTurmaName']);
        
        //Usuario

        Route::any('/administrator/usuarios', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('usuarios');
        Route::get('/administrator/usuarios/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/administrator/usuarios/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
        Route::get('/administrator/usuarios/show/{id}', [App\Http\Controllers\Auth\RegisterController::class, 'show'])->name('show');
        Route::get('/administrator/usuarios/edit/{id}', [App\Http\Controllers\Auth\RegisterController::class, 'edit'])->name('editUser');
        Route::post('/administrator/usuarios/update/{id}', [App\Http\Controllers\Auth\RegisterController::class, 'update'])->name('update');
        Route::delete('/administrator/usuarios/delete/{id}', [App\Http\Controllers\Auth\RegisterController::class, 'deleteUser']);
        Route::get('/administrator/usuarios/pesquisar', [App\Http\Controllers\Auth\RegisterController::class, 'pesquisar']);
        Route::get('/administrator/usuarios/getAll', [App\Http\Controllers\Auth\RegisterController::class, 'getAll']);
        Route::get('/getAllUsers', [App\Http\Controllers\UserController::class, 'getAllUsers']);
        Route::get('/administrator/usuarios/updateuserroles', [App\Http\Controllers\Auth\RegisterController::class, 'updateUserRoles']);
        //Route::post('/administrator/usuarios/update/{id}', [App\Http\Controllers\Auth\RegisterController::class, 'update']);

        //Professor

        Route::get('/administrator/professores', [App\Http\Controllers\ProfessorController::class, 'index'])->name('professores');
        Route::get('/administrator/professores/create', [App\Http\Controllers\ProfessorController::class, 'create'])->name('createProf');
        Route::post('/administrator/professores/register', [App\Http\Controllers\ProfessorController::class, 'store'])->name('_registarProf');
        Route::get('/administrator/professores/show/{id}', [App\Http\Controllers\ProfessorController::class, 'show'])->name('showProf');
        Route::get('/administrator/professores/edit/{id}', [App\Http\Controllers\ProfessorController::class, 'edit'])->name('editProf');
        Route::post('/administrator/professores/update/{id}', [App\Http\Controllers\ProfessorController::class, 'update'])->name('updateProf');
        Route::delete('/administrator/professores/delete/{id}', [App\Http\Controllers\ProfessorController::class, 'deleteProf']);

        //disciplina_professor
        Route::get('/administrator/disciplinas', [App\Http\Controllers\Disciplina_professorController::class, 'index'])->name('_professor');
        Route::get('/administrator/disciplinas/create', [App\Http\Controllers\Disciplina_professorController::class, 'create'])->name('_create');
        Route::get('/findSeccaoByClasse', [App\Http\Controllers\Disciplina_professorController::class, 'findSeccaoByClasse']);
        Route::get('/findTurmaBySeccao', [App\Http\Controllers\Disciplina_professorController::class, 'findTurmaBySeccao']);
        Route::get('/findDisciplinaByTurma', [App\Http\Controllers\Disciplina_professorController::class, 'findDisciplinaByTurma']);
        Route::get('/findIdByDisciplina', [App\Http\Controllers\Disciplina_professorController::class, 'findIdByDisciplina']);
        Route::get('/administrator/disciplinas/updatedisciplinastatus', [App\Http\Controllers\Disciplina_professorController::class, 'updateDisciplinaStatus']);
        Route::get('/administrator/disciplinas/updatedisciplinastatusII', [App\Http\Controllers\Disciplina_professorController::class, 'updateDisciplinaStatusII']);
        Route::post('/administrator/disciplinas/alocar', [App\Http\Controllers\Disciplina_professorController::class, 'store'])->name('_alocarDisc');
        Route::delete('/administrator/disciplinas/delete/{id}', [App\Http\Controllers\Disciplina_professorController::class, '_deleteAlocar']);
        Route::get('/administrator/disciplinas/edit/{id}', [App\Http\Controllers\Disciplina_professorController::class, 'edit'])->name('_editAloc');
        Route::post('/administrator/disciplinas/update/{id}', [App\Http\Controllers\Disciplina_professorController::class, 'update'])->name('_updateAloc');
        Route::get('/administrator/disciplinas/show/{id}', [App\Http\Controllers\Disciplina_professorController::class, 'show'])->name('_showAloc');
    });

    //auth route for office
    Route::group(['middleware'=>['auth', 'role:office']], function ()
    {
        //Secretaria

        Route::get('/office', [App\Http\Controllers\CertificadoController::class, 'getAllCert'])->name('sendCertData');
        Route::get('/office/exames', [CertificadoController::class, 'index'])->name('allCerts');
        Route::get('/office/certificados', [CertificadoController::class, 'certificados'])->name('allCertsV2');
        Route::get('/office/certificados/fetchData', [CertificadoController::class, 'fetchData']);
        Route::get('/office/certificados/getStuName', [CertificadoController::class, 'getStuName']);
        Route::get('/office/certificados/getStuSeccao', [CertificadoController::class, 'getStuSeccao']);
        Route::get('/office/certificados/getStuSeccaoByCertId', [CertificadoController::class, 'getStuSeccaoByCertId']);
        Route::post('/office/certificados/addData', [CertificadoController::class, 'addData']);
        Route::delete('/office/certificados/delete/{id}', [App\Http\Controllers\CertificadoController::class, 'deleteCert']);
        Route::get('/office/certificados/viewpdf/{id}', [App\Http\Controllers\CertificadoController::class, 'viewPDF'])->name('createStuCert');
        Route::put('/office/certificados/update/{id}', [App\Http\Controllers\CertificadoController::class, 'update']);
        Route::get('/teste', [App\Http\Controllers\CertificadoController::class, 'teste'])->name('teste');
        Route::get('/getCertQTDByJuri', [App\Http\Controllers\CertificadoController::class, 'getCertQTDByJuri']);
        Route::get('/getAllCertJuri', [App\Http\Controllers\CertificadoController::class, 'getAllCertJuri']);
        Route::get('/getAllCertJuriV2', [App\Http\Controllers\CertificadoController::class, 'getAllCertJuriV2']);
        Route::get('/getAllCertJuriV22', [App\Http\Controllers\CertificadoController::class, 'getAllCertJuriV22']);
        Route::get('/office/certificados/viewpauta/{id}', [App\Http\Controllers\CertificadoController::class, 'viewPauta'])->name('viewPauta');
        Route::get('/office/certificados/show/{id}', [App\Http\Controllers\CertificadoController::class, 'show'])->name('showCert');
        Route::get('/office/gestordeficheiros/', [App\Http\Controllers\CertificadoController::class, 'gestorFiles'])->name('filesOffice');
        
    });

    //auth route for student
    Route::group(['middleware'=>['auth', 'role:student']], function ()
    {
        //Estudante

        Route::get('/student', [App\Http\Controllers\StudentController::class, 'index']);
        Route::get('/student', [App\Http\Controllers\StudentController::class, 'getUserCertQtd'])->name('sendCertDataForUser');
        Route::get('/student/certificado', [App\Http\Controllers\StudentController::class, 'getAllForEspUser'])->name('returnViewPDF');
        Route::get('/student/certificado/viewpdf{stuname}', [App\Http\Controllers\StudentController::class, 'viewPDFStu'])->name('viewStuCert');
        // Route::get('/office/certificados', [CertificadoController::class, 'index']);
        // Route::get('/office/certificados/fetchData', [CertificadoController::class, 'fetchData']);
        // Route::get('/office/certificados/getStuName', [CertificadoController::class, 'getStuName']);
        // Route::get('/office/certificados/getStuSeccao', [CertificadoController::class, 'getStuSeccao']);
        // Route::get('/office/certificados/getStuSeccaoByCertId', [CertificadoController::class, 'getStuSeccaoByCertId']);
        // Route::post('/office/certificados/addData', [CertificadoController::class, 'addData']);
        // Route::delete('/office/certificados/delete/{id}', [App\Http\Controllers\CertificadoController::class, 'deleteCert']);
        // Route::get('/office/certificados/viewpdf/{id}', [App\Http\Controllers\CertificadoController::class, 'viewPDF']);
        // Route::put('/office/certificados/update/{id}', [App\Http\Controllers\CertificadoController::class, 'update']);
        // Route::get('/teste', [App\Http\Controllers\CertificadoController::class, 'teste'])->name('teste');
    });

    Route::group(['middleware'=>['auth', 'role:director']], function ()
    {
        //Rirector

        Route::get('/director', [App\Http\Controllers\DirectorController::class, 'index']);
        Route::get('/director/certificados', [App\Http\Controllers\DirectorController::class, 'getAllForUser'])->name('retutnall');
        Route::get('/director/certificados/viewpdf/{stuname}', [App\Http\Controllers\DirectorController::class, 'viewPDFStu'])->name('viewPDF');
        Route::get('/getAllCertJuriV3', [App\Http\Controllers\DirectorController::class, 'getAllCertJuriV3']);
        Route::get('/getAllCertJuriV33', [App\Http\Controllers\DirectorController::class, 'getAllCertJuriV33']);
        Route::get('/director/certificados/viewpdff/{id}', [App\Http\Controllers\DirectorController::class, 'viewPDFD'])->name('createStuCertD');
        Route::get('/director/certificados/downloadpdf/{id}', [App\Http\Controllers\DirectorController::class, 'downloadPDF'])->name('downloadStuCertD');
        Route::get('/director/gestordeficheiros/', [App\Http\Controllers\DirectorController::class, 'gestorFiles'])->name('files');
        Route::get('/director/gestordeficheiros/create', [App\Http\Controllers\DirectorController::class, 'create'])->name('carregarFiles');
        Route::post('/director/gestordeficheiros/store', [App\Http\Controllers\DirectorController::class, 'store'])->name('store');
        Route::delete('/director/gestordeficheiros/delete/{id}', [App\Http\Controllers\DirectorController::class, 'deleteCertAssing']);
        Route::get('/director/gestordeficheiros/edit/{id}', [App\Http\Controllers\DirectorController::class, 'edit'])->name('editCertAss');
        Route::post('/director/gestordeficheiros/update/{id}', [App\Http\Controllers\DirectorController::class, 'update'])->name('updateFiles');
        // Route::get('/office/certificados/fetchData', [CertificadoController::class, 'fetchData']);
        // Route::get('/office/certificados/getStuName', [CertificadoController::class, 'getStuName']);
        // Route::get('/office/certificados/getStuSeccao', [CertificadoController::class, 'getStuSeccao']);
        // Route::get('/office/certificados/getStuSeccaoByCertId', [CertificadoController::class, 'getStuSeccaoByCertId']);
        // Route::post('/office/certificados/addData', [CertificadoController::class, 'addData']);
        // Route::delete('/office/certificados/delete/{id}', [App\Http\Controllers\CertificadoController::class, 'deleteCert']);
        // Route::get('/office/certificados/viewpdf/{id}', [App\Http\Controllers\CertificadoController::class, 'viewPDF']);
        // Route::put('/office/certificados/update/{id}', [App\Http\Controllers\CertificadoController::class, 'update']);
        // Route::get('/teste', [App\Http\Controllers\CertificadoController::class, 'teste'])->name('teste');
    });

    Route::group(['middleware'=>['auth', 'role:professor']], function ()
    {
        //Professor
        
        Route::get('/professor', [App\Http\Controllers\Lancar_notasController::class, 'index']);
        Route::get('/professor', [App\Http\Controllers\Lancar_notasController::class, 'getProfQtdDisci']);
        /*Route::get('/director/certificados', [App\Http\Controllers\DirectorController::class, 'getAllForUser'])->name('retutnall');
        Route::get('/director/certificados/viewpdf/{stuname}', [App\Http\Controllers\DirectorController::class, 'viewPDFStu'])->name('viewPDF');
        Route::get('/getAllCertJuriV3', [App\Http\Controllers\DirectorController::class, 'getAllCertJuriV3']);
        Route::get('/getAllCertJuriV33', [App\Http\Controllers\DirectorController::class, 'getAllCertJuriV33']);
        Route::get('/director/certificados/viewpdff/{id}', [App\Http\Controllers\DirectorController::class, 'viewPDFD'])->name('createStuCertD');
        Route::get('/director/certificados/downloadpdf/{id}', [App\Http\Controllers\DirectorController::class, 'downloadPDF'])->name('downloadStuCertD');
        Route::get('/director/gestordeficheiros/', [App\Http\Controllers\DirectorController::class, 'gestorFiles'])->name('files');
        Route::get('/director/gestordeficheiros/create', [App\Http\Controllers\DirectorController::class, 'create'])->name('carregarFiles');
        Route::post('/director/gestordeficheiros/store', [App\Http\Controllers\DirectorController::class, 'store'])->name('store');
        Route::delete('/director/gestordeficheiros/delete/{id}', [App\Http\Controllers\DirectorController::class, 'deleteCertAssing']);
        Route::get('/director/gestordeficheiros/edit/{id}', [App\Http\Controllers\DirectorController::class, 'edit'])->name('editCertAss');
        Route::post('/director/gestordeficheiros/update/{id}', [App\Http\Controllers\DirectorController::class, 'update'])->name('updateFiles');
        // Route::get('/office/certificados/fetchData', [CertificadoController::class, 'fetchData']);
        // Route::get('/office/certificados/getStuName', [CertificadoController::class, 'getStuName']);
        // Route::get('/office/certificados/getStuSeccao', [CertificadoController::class, 'getStuSeccao']);
        // Route::get('/office/certificados/getStuSeccaoByCertId', [CertificadoController::class, 'getStuSeccaoByCertId']);
        // Route::post('/office/certificados/addData', [CertificadoController::class, 'addData']);
        // Route::delete('/office/certificados/delete/{id}', [App\Http\Controllers\CertificadoController::class, 'deleteCert']);
        // Route::get('/office/certificados/viewpdf/{id}', [App\Http\Controllers\CertificadoController::class, 'viewPDF']);
        // Route::put('/office/certificados/update/{id}', [App\Http\Controllers\CertificadoController::class, 'update']);
        // Route::get('/teste', [App\Http\Controllers\CertificadoController::class, 'teste'])->name('teste');*/
    });
    Route::group(['middleware'=>['auth', 'role:office_titular']], function ()
    {
        //Rirector

        Route::get('/office/titular', [App\Http\Controllers\OfficeController::class, 'index']);
        // Route::get('/director/certificados', [App\Http\Controllers\DirectorController::class, 'getAllForUser'])->name('retutnall');
        // Route::get('/director/certificados/viewpdf/{stuname}', [App\Http\Controllers\DirectorController::class, 'viewPDFStu'])->name('viewPDF');
        // // Route::get('/office/certificados/fetchData', [CertificadoController::class, 'fetchData']);
        // // Route::get('/office/certificados/getStuName', [CertificadoController::class, 'getStuName']);
        // // Route::get('/office/certificados/getStuSeccao', [CertificadoController::class, 'getStuSeccao']);
        // // Route::get('/office/certificados/getStuSeccaoByCertId', [CertificadoController::class, 'getStuSeccaoByCertId']);
        // // Route::post('/office/certificados/addData', [CertificadoController::class, 'addData']);
        // // Route::delete('/office/certificados/delete/{id}', [App\Http\Controllers\CertificadoController::class, 'deleteCert']);
        // // Route::get('/office/certificados/viewpdf/{id}', [App\Http\Controllers\CertificadoController::class, 'viewPDF']);
        // // Route::put('/office/certificados/update/{id}', [App\Http\Controllers\CertificadoController::class, 'update']);
        // // Route::get('/teste', [App\Http\Controllers\CertificadoController::class, 'teste'])->name('teste');
    });

});


