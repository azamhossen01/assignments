<?php 



class IncomeExpense 
{
    public $properties = [
       1 => "add income",
       2 => "add expense",
       3 => "view income",
       4 => "view expense",
       5 => "view total",
       6 => "view categories",
       7 => "refresh wallet",
       8 => "exit"
    ];

   

    private function getJsonData()
    {
        $data = file_get_contents('my_wallet.json');

        $decodedData = json_decode($data,true);

        return $decodedData;
    }
    
    public function updateWallet(string $category, int $amount, string $type)
    {
        $datasDecoded = $this->getJsonData();
        if($type === 'income'){
            $datasDecoded['income'][$category] += $amount;
            printf("\n\033[0;32mIncome added successfully.\033[0m\n");
        }elseif($type === 'expense'){
            $datasDecoded['expense'][$category] += $amount;
            printf("\n\033[0;32mExpense added successfully.\033[0m\n");
        }
        

       $json = json_encode($datasDecoded);

        file_put_contents('my_wallet.json', $json);
    }

    public function addIncome()
    {
        
        $this->showIncomeCategories();
        printf("\n");
        $category = (int) readline("Please select income category : ");
        printf("\n");
        
        while(true){
            if($category === 1 || $category === 2 || $category === 3){
                $amount = (int) readline("Enter a value : ");
                if(isset($amount)){
                    if ($category === 1) {
                        $this->updateWallet('salary',$amount,'income');
                        $this->showMenus();
                        return;
                    }elseif($category === 2){
                        $this->updateWallet('business',$amount,'income');
                        $this->showMenus();
                        return;
                    }elseif($category === 3){
                        $this->updateWallet('rent',$amount,'income');
                        $this->showMenus();
                        return;
                    }else{
                        $this->showIncomeCategories();
                        printf("\033[0;31mCategory does not match!\033[0m\n");
                        return;
                    }
                }
            }else{
                printf("\033[0;31mCategory does not match!\033[0m\n");
                $this->showMenus();
                break;
            }
            

            
        }
    }

    public function viewIncome()
    {
        $incomes = $this->getJsonData()['income'];
        $total = array_sum($incomes);
        $counter = 1;
        printf("Income details given below : \n\n");
        foreach($incomes as $key=>$value){
            if($value > 0){
                printf($counter . '. ' . $key . ' = Tk ' . number_format($value) . "\n");
        $counter++;
            }
        }
        printf("--------------------------\nTotal = Tk " . number_format($total) . "\n");
        $this->showMenus();
        return;
    }

    public function showTotal()
    {
        $data = $this->getJsonData();
        $totalIncome = array_sum($data['income']);
        $totalExpense = array_sum($data['expense']);
        $balance = $totalIncome - $totalExpense;
        printf("\033[0;33mTotal Wallet Summary.\033[0m\n\n");
        printf('Total Income  = Tk ' . number_format($totalIncome) . "\n");
        printf('Total Expense = Tk ' . number_format($totalExpense) . "\n");
        printf("\nBalance       = Tk " . number_format($balance) . "\n");
        $this->showMenus();
        return;
    }

    public function viewExpense()
    {
        $expenses = $this->getJsonData()['expense'];
        $total = array_sum($expenses);
        $counter = 1;
        printf("Expense details given below : \n\n");
        foreach($expenses as $key=>$value){
            if($value > 0){
                printf($counter . '. ' . $key . ' = Tk ' . number_format($value) . "\n");
        $counter++;
            }
        }
        printf("--------------------------\nTotal = Tk " . number_format($total) . "\n");
        $this->showMenus();
        return;
    }

    public function addExpense()
    {
        
        while(true){
            $this->showExpenseCategories();
            printf("\n");
            $category = (int) readline("Please select expense category : ");
            printf("\n");
            if($category === 1 || $category === 2 || $category === 3 || $category === 4){
                $amount = (int) readline("Enter a value : ");
            if(isset($amount)){
                if ($category === 1) {
                    $this->updateWallet('family',$amount,'expense');
                    $this->showMenus();
                    return;
                }elseif($category === 2){
                    $this->updateWallet('personal',$amount,'expense');
                    $this->showMenus();
                    return;
                }elseif($category === 3){
                    $this->updateWallet('gift',$amount,'expense');
                    $this->showMenus();
                    return;
                }elseif($category === 4){
                    $this->updateWallet('sadakah',$amount,'expense');
                    $this->showMenus();
                    return;
                }else{
                    $this->showExpenseCategories();
                    printf("Category does not match!\n");
                    return;
                }
            }
            }else{
                printf("Category does not match!\n");
                $this->showMenus();
                break;
            }
            

            
        }
    }



    public function showMenus()
    {
        printf("\n==============================================\n\n\033[0;33mWhat do you want?\033[0m\n\n");
        foreach($this->properties as $key=>$value){
            printf($key . '. ' . $value . PHP_EOL);
        }
    }

    public function showIncomeCategories()
    {
        $data = $this->getJsonData();
        $counter = 1;
        foreach($data['income'] as $key=>$category){
            printf($counter . '. ' . $key." \n");
            
            $counter++;
        }
        return;
    }
    public function showExpenseCategories()
    {
        $data = $this->getJsonData();
        $counter = 1;
        foreach($data['expense'] as $key=>$category){
            printf($counter . '. ' . $key." \n");
            
            $counter++;
        }
        return;
    }

    public function showCategories()
    {
        $data = $this->getJsonData();
        printf("\n\n\033[0;33mThis is our categories : \033[0m\n\n===============================\n\n");
        foreach($data as $key=>$incomeExpense){
            printf("\033[0;33m$key categories : \033[0m\n\n");
            $counter = 1;
            foreach($incomeExpense as $key=>$value){
                printf($counter . '. ' . $key . "\n");
                $counter++;
            }
            printf("\n");
        }
        return;
    }

    public function refreshWallet()
    {
        $data = $this->getJsonData();
        // foreach($data['income'] as $item){
        //     $data['income'][$item] = 0;
        // }
        foreach($data as $key=>$category){
            // var_dump($data[$key]);
            foreach($data[$key] as $k=>$item){
                $data[$key][$k] = 0;
            }
        }

        $json = json_encode($data);

        file_put_contents('my_wallet.json', $json);
        printf("\033[0;32mYour wallet refreshed successfully!\033[0m\n");
        $this->showMenus();
        return;
    }
}
$income_expense = new IncomeExpense();
// printf($income_expense);
$income_expense->showMenus();
while(true){
    
    printf("\n");
    $input = (int) readline("Please insert a number : ");
    printf("\n");
    if($input === 6){
         $income_expense->showCategories();
         $income_expense->showMenus();
    }elseif($input === 1){
        $income_expense->addIncome();
    }elseif($input === 2){
        $income_expense->addExpense();
    }elseif($input === 3){
        $income_expense->viewIncome();
    }elseif($input === 4){
        $income_expense->viewExpense();
    }elseif($input === 5){
        $income_expense->showTotal();
    }elseif($input === 7){
        $income_expense->refreshWallet();
    }elseif($input === 8){
        break;
    }else{
        printf("Please select valid index\n");
        $income_expense->showMenus();
    }
}

// $input = readline()