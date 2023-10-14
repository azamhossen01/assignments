<?php 

namespace App\Controllers;

use App\Models\User;
use App\Classes\Session;
use App\Classes\Validation;
use App\Controllers\Controller;

class AdminController extends Controller 
{
    public function __construct()
    {
        if(!Session::isAuthenticated()){
            header("Location: /login");
        }
        if(Session::isAuthenticated() && $_SESSION['user']['type'] === 'customer'){
            header("Location: /");
        }
        parent::__construct();
    }

    public function home()
    {
        $customers = (new User())->getAllCustomers();
        return view('admin/customers',['customers' => $customers]);
    }

    public function customerTransactions($customer_id)
    {
        $transactions = (new User())->getMyTransactions($customer_id);
        foreach($transactions as $key=>$transfer){
            $transactions[$key]['transfer_to'] = (new User())->getUserById($transfer['transfer_to']);
            $transactions[$key]['transfer_from'] = (new User())->getUserById($transfer['transfer_from']);
            $transactions[$key]['user'] = (new User())->getUserById($transfer['user_id']);
        }
        // echo "<pre>";
        // print_r($transactions);
        // die();
        return view('admin/customer_transactions', ['transactions' => $transactions]);
    }

    public function transactions()
    {
        $transactions = (new User())->getAllTransactions();
        foreach($transactions as $key=>$transfer){
            $transactions[$key]['transfer_to'] = (new User())->getUserById($transfer['transfer_to']);
            $transactions[$key]['transfer_from'] = (new User())->getUserById($transfer['transfer_from']);
            $transactions[$key]['user'] = (new User())->getUserById($transfer['user_id']);
        }
        // echo "<pre>";
        // print_r($transactions);
        // die();
        return view('admin/transactions', ['transactions' => $transactions]);
    }

    public function addCustomer()
    {
        return view('admin/add_customer');
    }

    public function storeCustomer()
    {
        $data = $_POST;
        // echo "<pre>";
        // print_r($data);die();
        $rules = [
            'first-name' => 'required',
            'last-name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|max:12',
        ];
        $validator = new Validation($data);
        $validator->validate($rules);

        
        $errors = $validator->errors();
        
        if (!empty($errors)) {
            Session::setFlashMessage('error', $errors);
            header("Location: /add_customer");
        } else {
            $data['name'] = $data['first-name'] . ' ' . $data['last-name'];
            $user = new User($data);
            $user->create($data);
            Session::setFlashMessage('success', 'User registration successful');
            header("Location: /add_customer");
        }
    }
}