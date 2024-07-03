<?php namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\PegawaiModel;

class Pegawai extends BaseController
{
public function index()
{
$pegawai_model = new PegawaiModel();
$crud = new GroceryCrud();
$crud->setLanguage('Indonesian');
$crud->setTable('pegawaiv2');
$crud->columns(['nama_pegawai', 'gender', 'email', 'no_telepon', 'status']);
$crud->unsetColumns(['created_at', 'updated_at', 'deleted_at']);
$crud->displayAs(array(
'nama_pegawai' =>'Nama',
'gender' =>'L/P',
'email' =>'Email',
'no_telepon' =>'Telepon',
'status' =>'Status',
))
->unsetExport()
->unsetPrint();
$crud->setTheme('datatables');
//$crud->unsetAddFields(['created_at' , 'updated_at']);
//$crud->unsetEditFields(['created_at' , 'updated_at']);
$crud->unsetFields(['id_pegawai','created_at' , 'updated_at', 'deleted_at']);

$crud->setRule('nama_pegawai', 'nama_pegawai', 'required', ['required' => '{field} harus diisi!!!']);
$crud->setRule('gender', 'gender', 'required', ['required' => '{field} harus diisi!!!']);
$crud->setRule('status', 'status', 'required', ['required' => '{field} harus diisi!!!']); 
$crud->setRule('email', 'email', 'required', ['required' => '{field} harus diisi!!!']);
$crud->setRule('no_telepon', 'no_telepon', 'required', ['required' => '{field} harus diisi!!!']);

$crud->callbackInsert(function ($stateParameters) use ($pegawai_model) {
$pegawai_model->save($stateParameters->data);
return $stateParameters;
});

$crud->callbackDelete(function ($stateParameters) use ($pegawai_model) {
$pegawai_model->delete($stateParameters->primaryKeyValue);
return $stateParameters;
});




// $crud->unsetAdd();
// $crud->unsetEdit();
// $crud->unsetDelete();
// $crud->unsetExport();
// $crud->unsetPrint();
// $crud->setRelation('officeCode', 'offices', 'city');
// $crud->setTheme('datatables');

$output = $crud->render();

$data = [
'title' => 'Data Pegawai',
'result' => $output
];
return view('pegawai/index', $data);
}
}