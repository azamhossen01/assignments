<?php 

declare(strict_types=1);

namespace App\Classes;

class CLIApp 
{
    public FinanceManager $financeManager;
    private const LOGIN = 1; 
    private const REGISTER = 2; 
    private const SHOW_TRANSACTION = 1;
    private const DEPOSIT = 2;
    private const WITHDRAW = 3;
    private const CURRENT_BALANCE = 4;
    private const TRANSFER_MONEY = 5;
    private const LOGOUT = 6;
    private const SHOW_ALL_TRANSACTION = 1;
    private const SHOW_SINGLE_CUSTOMER_TRANSACTION = 2;
    private const SHOW_CUSTOMER_LIST = 3;


    public function __construct()
    {
        $this->financeManager = new FinanceManager(new JsonStorage());
    }

    public static function getAuthMenu()
    {
        $options = [
            self::LOGIN => 'Login',
            self::REGISTER => 'Register'
        ];
        while(true)
        {
            foreach($options as $index=>$label)
            {
                printf("%d. %s\n",$index,$label);
            }
            $choice = intval(readline("Enter your choice: "));
            return $choice;
        }
    }

    public static function getCustomerMenu()
    {
        $options = [
            self::SHOW_TRANSACTION => 'Show my transactions',
            self::DEPOSIT => 'Deposit Money',
            self::WITHDRAW => 'Withdraw Money',
            self::CURRENT_BALANCE => 'Show current balance',
            self::TRANSFER_MONEY => 'Transfer money',
            self::LOGOUT => 'Logout'
        ];

        foreach($options as $index=>$label)
        {
            printf("%d. %s\n", $index,$label);
        }
        $choice = intval(readline("Enter your choice: "));
        return $choice;
    }

    public static function getAdminMenu()
    {
        $options = [
            self::SHOW_ALL_TRANSACTION => 'Show all customers transactions',
            self::SHOW_SINGLE_CUSTOMER_TRANSACTION => 'Show specific customer transaction',
            self::SHOW_CUSTOMER_LIST => 'Show all customers',
            self::LOGOUT => 'Logout'
        ];

        foreach($options as $index=>$label)
        {
            printf("%d. %s\n", $index,$label);
        }
        $choice = intval(readline("Enter your choice: "));
        return $choice;
    }

    public static function run()
    {
        while(2 > 1)
        {
            $auth = Auth::authenticated()['isAuthenticated'];
            $role = Auth::authenticated()['role'] ?? '';
            $email = Auth::authenticated()['email'] ?? '';
            printf("Select from the following menu: \n");
            if($auth === false){
                $choice = self::getAuthMenu();
                switch ($choice) {
                    case self::LOGIN:
                        $email = trim(readline("Enter your email: "));
                        $password = trim(readline("Enter your password: "));
                        $x = (new LoginController($email, $password))->login();
                        
                        if(isset($x['status']) === 0){
                            printf($x['msg']."\n");
                        }else{
                            printf($x['msg'] . "\n");
                        }
                        break;
                    case self::REGISTER:
                        $name = trim(readline("Enter your name: "));
                        $email = trim(readline("Enter your email: "));
                        $password = trim(readline("Enter your password: "));
                        $x = (new RegisterController($name, $email, $password))->register();
                        if(isset($x['status']) === 0){
                            printf($x['msg']);
                        }else{
                            printf($x['msg']);
                            (new JsonStorage())->createAccount($email);
                        }
                        break;
                    default:
                        printf("Invalid option.\n");
                }
            }else if($auth === true && $role === 'customer'){
                while(true){
                    $choice = self::getCustomerMenu();
                    switch ($choice) {
                        case self::SHOW_TRANSACTION: 
                            $x = (new FinanceManager())->showTransactions();
                            var_dump($x);
                            break;

                        case self::DEPOSIT: 
                            $amount = trim(readline("Deposit Amount : "));
                            $x = (new FinanceManager())->deposit($amount, $email);
                            var_dump($x);
                            break;
                        
                        case self::WITHDRAW: 
                            $amount = trim(readline("Withdraw Amount : "));
                            $x = (new FinanceManager())->withdraw($amount, $email);
                            var_dump($x);
                            break;
                        
                        case self::CURRENT_BALANCE: 
                            $current_balance = (new FinanceManager())->currentBalance();
                            // printf("Current Balance is : %d\n",$current_balance);
                            break;
                        
                        case self::TRANSFER_MONEY: 
                            $email = trim(readline("Enter email : "));
                            if((new JsonStorage())->checkFileExists($email)){
                                $amount =(float) trim(readline("Enter transfer amount : "));
                                if(is_float($amount)){
                                    $current_balance = (new FinanceManager())->currentBalance();
                                    if($amount < $current_balance){
                                        (new FinanceManager())->transferMoney($email, $amount);
                                    }
                                }else{
                                    printf("Please provide amount correctly\n");
                                    break;
                                }
                                
                            }
                            // $current_balance = (new FinanceManager())->transferMoney();
                            // printf("Current Balance is : %d\n",$current_balance);
                            break;

                            case self::LOGOUT:
                                die();
                        
                        default:
                            # code...
                            break;
                    }
                }
                
            }else if($auth === true && $role === 'admin'){
                while(true){
                    $choice = self::getAdminMenu();
                    switch ($choice) {
                        case self::SHOW_ALL_TRANSACTION: 
                            $x = (new FinanceManager())->showAllTransactions();
                            break;

                        case self::SHOW_SINGLE_CUSTOMER_TRANSACTION: 
                            $email = trim(readline("Enter email : "));
                            if((new JsonStorage())->checkFileExists($email)){
                                (new FinanceManager())->showTransactions($email);
                                
                            }else{
                                printf("Email not exists\n");
                            }
                            break;
                        
                        case self::SHOW_CUSTOMER_LIST: 
                            (new FinanceManager())->showAllCustomers();
                            break;
                        
                        case self::LOGOUT:
                            die();
                        
                        default:
                            # code...
                            break;
                    }
                }
            }
            
        }
       
    }
}