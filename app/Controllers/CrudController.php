<?php
namespace App\Controllers;

use App\Models\CrudModel;
use CodeIgniter\Controller;

class CrudController extends Controller
{
    function index() {
        return view('crud_view');
    }
    function action() {
        if($this->request->getVar('action')){
            helper(['form', 'url']);
            $name_error = "";
            $email_error = "";
            $error = "no";
            $success = "no";
            $message = "";

            $error = $this->validate([
                'name'  => 'required|min_length[3]',
                'email' => 'required|valid_email'
            ]);
            if(!$error) {
                $error = "yes";
                $validation = \Config\Services::validation();
                if($validation->getError('name')) {
                    $name_error = $validation->getError('name');
                }
                if($validation->getError('email')) {
                    $email_error = $validation->getError('email');
                }
            } else {
                $success = 'yes';
                if($this->request->getVar('action') == 'Add') {
                    $crudModel = new CrudModel();
                    $crudModel->save([
                        'name' => $this->request->getVar('name'),
                        'email' => $this->request->getVar('email'),
                    ]);
                    $message = '<div class="alert alert-success">User Data Added</div>';
                }
            }

            $output = array(
                'name_error'    =>  $name_error,
                'email_error'   =>  $email_error,
                'error'         =>  $error,
                'success'       =>  $success,
                'message'       =>  $message
            );

            echo json_encode($output);
        }
    }
}
