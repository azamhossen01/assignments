<?php 

declare(strict_types=1);

namespace App\Classes;

class Option 
{
    private const LOGIN = 1; 
    private const REGISTER = 2; 
    private const TRANSACTION = 1;
    private const DEPOSIT = 2;
    private const WITHDRAW = 3;
    private const CURRENT_BALANCE = 4;
    private const TRANSFER_MONEY = 5;

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
        }
    }

    public static function getCustomerMenu()
    {
        $options = [
            self::TRANSACTION => 'Show my transactions',
            self::DEPOSIT => 'Deposit Money',
            self::WITHDRAW => 'Withdraw Money',
            self::CURRENT_BALANCE => 'Show current balance',
            self::TRANSFER_MONEY => 'Transfer money'
        ];

        foreach($options as $index=>$label)
        {
            printf("%d. %s\n", $index,$label);
        }
        $choice = intval(readline("Enter your choice: "));
    }

    public static function run()
    {
        self::getAuthMenu();
    }
}