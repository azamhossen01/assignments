<?php 

namespace App\Controllers;

use App\Classes\Session;
use App\Models\Deposit;
use App\Models\Withdraw;

class WithdrawController extends Controller 
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
        $data = (new Withdraw())->getMyWithdraw();
        return view('customer/withdraw',['total_withdraw' => $data['total_amount']]);
    }

    public function store()
    {
        $user_id = $_SESSION['user']['id'];
        $balance = (new Deposit())->getBalance($user_id);
        $data = [
            'user_id' => $user_id,
            'amount' => $_POST['amount'],
            'type' => 'withdraw',
            'in_out' => 'out',
            'balance' => $balance
        ];
        if($data['amount'] > $balance){
            Session::setFlashMessage('error', 'You do not have sufficent balance!!!');
            header("Location: /withdraw");
            return;
        }
        $withdraw = new Withdraw();
        try {
            $withdraw->store($data);
            Session::setFlashMessage('success', 'Withdraw balance successful');
            header("Location: /withdraw");
        } catch (\Throwable $th) {
            Session::setFlashMessage('error', $th->getMessage());
        }
    }
}