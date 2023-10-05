<?php 
declare(strict_types=1);

namespace App\Classes;


class FinanceManager 
{

    private $storage;
    private array $account;

    public function __construct()
    {
        // $this->storage = new JsonStorage();
    }
    public function deposit($amount, $email)
    {
        $this->account = (new JsonStorage())->load($email);
        // $this->account = !empty($this->account) ? $this->account : ['deposits' => [], 'withdraws' => [], 'transfer' => []];
        $this->account['deposits'][] = $amount;
        (new JsonStorage())->save($email, $this->account);
        return;
    }

    public function withdraw($amount, $email)
    {
        $current_balance = $this->currentBalance();
        if($amount > $current_balance){
            printf("Sorry, you dont have sufficient balance to withdraw\n");
            return;
        }
        $this->account = (new JsonStorage())->load($email);
        $this->account = !empty($this->account) ? $this->account : ['deposits' => [], 'withdraws' => []];
        $this->account['withdraws'][] = $amount;
        (new JsonStorage())->save($email, $this->account);
        return;
    }

    public function currentBalance()
    {
        $email = Auth::authenticated()['email'];
        $data = (new JsonStorage())->load($email);
        $deposits = array_sum($data['deposits']??[]);
        
        $withdraws = array_sum($data['withdraws']??[]);
        
        $transfer_amount = $this->calculateTransferMoney($email) ?? 0;
        $current_balance = ($deposits + ($transfer_amount) - $withdraws);
        printf("Total Deposits           : $deposits\n");
        printf("Total Withdraws          : $withdraws\n");
        printf("Adjusted Transfer Amount : $transfer_amount\n");
        printf("Current Balance          : $current_balance\n");
        return;
    }

    public function showTransactions($model=false)
    {
        if($model){
            $model = $model;
        }else{
            $model = Auth::authenticated()['email'];
        }
        
        $data = (new JsonStorage())->load($model);
        $transfer_money = $this->calculateTransferMoney($model);
        if($data){
            printf("My Transactions : \n");
            if(count($data['deposits']) > 0 ){
                printf("Deposits : \n");
                foreach($data['deposits'] as $key => $deposit){
                    printf(($key + 1) . ". Bank...........Dr $deposit\n       Cash...........Cr $deposit\n");
                }
            }
            if(count($data['withdraws']) > 0 ){
                printf("Withdraws : \n");
                foreach($data['withdraws'] as $key => $withdraw){
                    printf(($key + 1) . ". Cash...........Dr $withdraw\n       Bank...........Cr $withdraw\n");
                }
            }
            $this->transferTransaction($model);
        }else{
            printf("No transaction occurs yet\n");
        }
        
    }

    private function transferTransaction($model)
    {
        printf("Transfer Transaction : \n");
        $data = (new JsonStorage())->load($model)['transfer'];
        if($data){
            foreach($data as $key => $account){
                foreach($account as $amount){
                    if($amount > 0){
                        printf("Bank...........Dr $amount\n       $key...........Cr $amount\n");
                    }else{
                        printf("$key...........Dr $amount\n       Bank...........Cr $amount\n");
                    }
                }
            }
        }else{
            printf("No transfer transactions\n");
        }
        return;
        
    }

    public function transferMoney($model, $amount)
    {
        $my_email = Auth::authenticated()['email'];
        //store transfer history in receiver account
        $receiver_account = (new JsonStorage())->load($model);
        if(isset($receiver_account['transfer'][$my_email])){
            $receiver_account['transfer'][$my_email][] = $amount;
        }else{
            $receiver_account['transfer'][$my_email] = [$amount];
        }
        (new JsonStorage())->save($model, $receiver_account);

        //store transfer history in sender account
        $sender_account = (new JsonStorage())->load($my_email);
        if(isset($sender_account['transfer'][$model])){
            $sender_account['transfer'][$model][] = -$amount;
        }else{
            $sender_account['transfer'][$model] = [-$amount];
        }
        (new JsonStorage())->save($my_email, $sender_account);
        printf("Transfer money successful\n");
        return;
    }

    private function calculateTransferMoney($model)
    {
        $data = (new JsonStorage())->load($model)['transfer'];
        $total = 0;
        foreach($data as $account => $amounts){
            $total += array_sum($amounts);
        }
        return $total;
    }

    public function showAllTransactions()
    {
        $customers = (new JsonStorage())->load('customers');
        foreach($customers as $key=>$customer){
            printf($customer['name'] . " Transactions : \n");
            $this->showTransactions($customer['email']);
        }
        return;
    }

    public function showAllCustomers()
    {
        $customers = (new JsonStorage())->load('customers');
        foreach($customers as $key=>$customer){
            printf("%d. Name  : %s\n   Email  : %s\n", $key+1, $customer['name'], $customer['email']);
        }
        return;
    }
}

