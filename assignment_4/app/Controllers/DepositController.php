<?php 

namespace App\Controllers;

use App\Models\User;
use App\Models\Deposit;
use App\Classes\Session;

class DepositController extends Controller 
{

    public function __construct()
    {
        if(!Session::isAuthenticated()){
            header("Location: /login");
        }
        if(Session::isAuthenticated() && $_SESSION['user']['type'] === 'admin'){
            header("Location: /admin-dashboard");
        }
        parent::__construct();
    }

    public function index()
    {
        $data = (new Deposit())->getMyDeposit();
        
        return view('customer/deposit',['total_deposit' => $data['total_amount']]);
    }

    public function store()
    {
        $user_id = $_SESSION['user']['id'];
        $balance = (new Deposit())->getBalance($user_id);
        $data = [
            'user_id' => $user_id,
            'amount' => $_POST['amount'],
            'type' => 'deposit',
            'in_out' => 'in',
            'balance' => $balance
        ];
        $deposit = new Deposit();
        try {
            $deposit->store($data);
            Session::setFlashMessage('success', 'Deposit balance successful.');
            header("Location: /deposit");
        } catch (\Throwable $th) {
            Session::setFlashMessage('error', $th->getMessage());
        }
       
    }
}