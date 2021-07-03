<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Schclass extends REST_Controller {

    function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->model('schclass_model');
        $this->load->library('form_validation');
    }

  


    public function class_post()
    {
       
        $code = $this->post('code');
        $name = $this->post('name');
        $maximum_students = $this->post('maximum_students');
        $status = $this->post('status');
        $description = $this->post('description');
        $config = [
            [
                    'field' => 'code',
                    'label' => 'code',
                    'rules' => 'required|min_length[3]|is_unique[sch_class.code]',
                    'errors' => [
                            'required' => 'Code Field is required',
                            'min_length' => 'Minimum Username length is 3 characters',
                            'alpha_dash' => 'You can only use a-z 0-9 _ . – characters for input',
                            'is_unique' => 'Code Already Exits, Use New Code',
                    ],
            ],
            [
                'field' => 'name',
                'label' => 'name',
                'rules' => 'required|min_length[3]',
                'errors' => [
                        'required' => 'NAme field is required',
                        'min_length' => 'Minimum Username length is 3 characters',
                        'alpha_dash' => 'You can only use a-z 0-9 _ . – characters for input',
                ]
            ],
                [
                    'field' => 'maximum_students',
                    'label' => 'maximum students',
                    'rules' => 'required|integer',
                    'errors' => [
                            'required' => 'Maximuim students field is required',
                            'integer' => 'Only Integer Value'                           
                    ]
                ],
                    [
                        'field' => 'status',
                        'label' => 'status',
                        'rules' => 'required',
                        'errors' => [
                                'required' => 'Status field is required',
                    ]
                ]
            
        ];
        
        $data = $this->input->get();
        
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run()==FALSE){
            $this->response($this->form_validation->error_array(), REST_Controller::HTTP_BAD_REQUEST); 
        }else{
            
        
        
        $detail = [];
        $class = array(
            'code'                  => $code,
            'name'                  => $name,
            'maximum_students'      => $maximum_students,
            'status'                => $status,
            'description'           => $description

        );
        $res = $this->schclass_model->insert_class($class);
       if($res){
         $this->set_response($res, REST_Controller::HTTP_CREATED); 
       }else{
         $this->response(false, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
       }

    }
    }


    public function class_get(){

       
        $class = $this->schclass_model->get_all_class();
       
        if($class){
            $this->set_response($class, REST_Controller::HTTP_CREATED);
        }else{
            $this->response(false, REST_Controller::HTTP_BAD_REQUEST);
        }
    }


    public function class_put($code)
    {
       
        $name = $this->put('name');
        $maximum_students = $this->put('maximum_students');
        $status = $this->put('status');
        $description = $this->put('description');
        
        
        $detail = [];
        $class = array(
            'code'                  => $code,
            'name'                  => $name,
            'maximum_students'      => $maximum_students,
            'status'                => $status,
            'description'           => $description

        );
        
        $res = $this->schclass_model->update_class($class);
       if($res){
         $this->set_response($class, REST_Controller::HTTP_CREATED); 
       }else{
         $this->response(false, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
       }

    }
    


    public function class_delete($code)
    {
        $res = $this->schclass_model->delete_class($code);
        if ($code)
        {
            $message = [
                'message' => 'Deleted the resource'
            ];
            $this->response($message, REST_Controller::HTTP_CREATED); // BAD_REQUEST (400) being the HTTP response code
        }else{
            $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST); // NO_CONTENT (204) being the HTTP response code
        }
       
        

       
    }

}
