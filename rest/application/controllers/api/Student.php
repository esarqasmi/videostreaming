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
class Student extends REST_Controller {

    function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->model('student_model');
        $this->load->library('form_validation');
    }

  


    public function std_post()
    {
       
        $class_code = $this->post('class_code');
        $first_name = $this->post('first_name');
        $last_name = $this->post('last_name');
        $date_of_birth = $this->post('date_of_birth'); 
        
        $config = [
            [
                    'field' => 'class_code',
                    'label' => 'class_code',
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                            'required' => 'Code Field is required',
                            'min_length' => 'Minimum Username length is 3 characters',
                            'alpha_dash' => 'You can only use a-z 0-9 _ . – characters for input',
                            'is_unique' => 'Code Already Exits, Use New Code',
                    ],
            ],
            [
                'field' => 'first_name',
                'label' => 'first_name',
                'rules' => 'required|min_length[3]',
                'errors' => [
                        'required' => 'Name field is required',
                        'min_length' => 'Minimum Username length is 3 characters',
                        'alpha_dash' => 'You can only use a-z 0-9 _ . – characters for input',
                ]
            ],
            [
                'field' => 'last_name',
                'label' => 'last_name',
                'rules' => 'required|min_length[3]',
                'errors' => [
                        'required' => 'Name field is required',
                        'min_length' => 'Minimum Username length is 3 characters',
                        'alpha_dash' => 'You can only use a-z 0-9 _ . – characters for input',
                ]
            ],
            [
                'field' => 'date_of_birth',
                'label' => 'date_of_birth',
                'rules' => 'required',
                'errors' => [
                        'required' => 'Date of birth field is required'
                        
                ]
            ]
                
                    
        
            
        ];
        
        $data = $this->input->get();
        
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run()==FALSE){
            $this->response($this->form_validation->error_array(), REST_Controller::HTTP_BAD_REQUEST); 
        }else{
            
        // first count max students 
        $max_res = $this->student_model->check_max_limit($class_code);
        // print_r($max_res);
        if(intval($max_res['maximum_students']) > intval($max_res['t_stds'])){
            $detail = [];
                $class = array(
                    'class_code'             => $class_code,
                    'first_name'                  => $first_name,
                    'last_name'      			  => $last_name,
                    'date_of_birth'               => $date_of_birth

                );
                $res = $this->student_model->insert_std($class);
            if($res){
                $this->set_response($res, REST_Controller::HTTP_CREATED); 
            }else{
                $this->response(false, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
        }else{
            $message = [
                'message' => 'Maximum 10 students allowed in a class'
            ];
            $this->response($message, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
       

    }
    }


    public function std_get(){

       
        $class = $this->student_model->get_all_students();
       
        if($class){
            $this->set_response($class, REST_Controller::HTTP_CREATED);
        }else{
            $this->response(false, REST_Controller::HTTP_BAD_REQUEST);
        }
    }


    public function std_put($code)
    {
       
        $first_name = $this->put('first_name');
        $last_name = $this->put('last_name');
        $class_code = $this->put('class_code');
        $date_of_birth = $this->put('date_of_birth'); 
    
        
        $detail = [];
        $class = array(
            'class_code'                  => $class_code,
            'first_name'                  => $first_name,
            'last_name'      => $last_name,
            'date_of_birth'                => $date_of_birth 

        );
        
        $res = $this->student_model->update_std($class);
       if($res){
         $this->set_response($class, REST_Controller::HTTP_CREATED); 
       }else{
         $this->response(false, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
       }

    }
    


    public function std_delete($id)
    {
        $res = $this->student_model->delete_std($id);
        if ($id)
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
