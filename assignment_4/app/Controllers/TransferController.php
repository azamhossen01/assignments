<?php 

namespace App\Controllers;

use App\Models\User;
use App\Models\Deposit;
use App\Classes\Session;
use App\Models\Transfer;
use App\Models\Withdraw;

class TransferController extends Controller 
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
        $users = (new User())->getAllUsers();
        // $transfer = (new Transfer())->getMyTransfer()['transfer_from'];
        $transfer = 0;
        $transfer = (new Transfer())->getMyTransfer()['total_transfer'];
        return view('customer/transfer', ['users' => $users,'transfer_from' => $transfer]);
    }

    public function store()
    {
        $user_id = $_SESSION['user']['id'];
        $balance = (new Deposit())->getBalance($user_id);
        $receiverBalance = (new Deposit())->getBalance($_POST['transfer_to']);
        $data = [
            'user_id' => $user_id,
            'transfer_from' => $user_id,
            'transfer_to'=> $_POST['transfer_to'],
            'amount' => $_POST['amount'],
            'type' => 'transfer',
            'in_out' => 'out',
            'balance' => ($balance - $_POST['amount'])
        ];
        $data1 = [
            'user_id' => $_POST['transfer_to'],
            'transfer_from' => $user_id,
            'transfer_to'=> $_POST['transfer_to'],
            'amount' => $_POST['amount'],
            'type' => 'transfer',
            'in_out' => 'in',
            'balance' => ($receiverBalance + $_POST['amount'])
        ];
        
        if(($data['amount']) > $balance){
            Session::setFlashMessage('error', 'You do not have sufficent balance!!!');
            header("Location: /transfer");
            return;
        }
        $transfer = new Transfer();
        try {
            $transfer->store($data);
            $transfer->store($data1);
            Session::setFlashMessage('success', 'Transfer balance successful.');
            // Session::setFlashMessage('success', 'Transfer balance $' . $data['amount'] . ' successful.');
            header("Location: /transfer");
        } catch (\Throwable $th) {
            Session::setFlashMessage('success', $th->getMessage());
        }
    }
}