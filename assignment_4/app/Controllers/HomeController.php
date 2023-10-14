<?php 

namespace App\Controllers;

use App\Models\User;
use App\Models\Deposit;
use App\Classes\Session;
use App\Models\Transfer;
use App\Models\Withdraw;
use App\Classes\Connection;
use App\Controllers\Controller;

class HomeController extends Controller
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

    public function home()
    {
        $user_id = $_SESSION['user']['id'];
        $balance = (new Deposit())->getBalance($user_id);
        $transactions = (new User())->getMyTransactions($user_id);
        $user = (new User())->getUserById($user_id);
        foreach($transactions as $key=>$transfer){
            $transactions[$key]['transfer_to'] = (new User())->getUserById($transfer['transfer_to']);
            $transactions[$key]['transfer_from'] = (new User())->getUserById($transfer['transfer_from']);
            $transactions[$key]['user'] = (new User())->getUserById($transfer['user_id']);
        }
        // echo "<pre>";
        // print_r($transactions);
        // die();
        
        return view('customer/dashboard',['balance' => $balance, 'transactions' => $transactions]);
    }

    public static function userBalance()
    {
        $deposit = (new Deposit())->getMyDeposit()['total_amount'] ?? 0;
        $withdraw = (new Withdraw())->getMyWithdraw()['total_amount'] ?? 0;
        $transfers = (new Transfer())->getMyTransfer();
        $transfer_to = $transfers['transfer_to'] ?? 0;
        $transfer_from = $transfers['transfer_from'] ?? 0;
        $balance = ($deposit + $transfer_to) - ($withdraw + $transfer_from);
        return $balance;
    }
}