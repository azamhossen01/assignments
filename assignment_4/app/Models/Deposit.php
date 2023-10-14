<?php 

namespace App\Models;

use PDO;
use PDOException;

class Deposit extends Model 
{
  
   
    public  function store($data)
    {
        if(!empty($data)){
            $user_id = $data['user_id'];
            $amount = $data['amount'];
            $type = $data['type'];
            $in_out = "in";
            $balance = $data['balance'] + $amount;
            $sql = "INSERT INTO accounts (user_id, amount, type, in_out, balance) VALUES (:user_id, :amount, :type, :in_out, :balance)";
            try {
                $stmt = $this->db->prepare($sql);
            
                // Bind parameters to the placeholders
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
                $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
                $stmt->bindParam(':type', $type, PDO::PARAM_STR);
                $stmt->bindParam(':in_out', $in_out, PDO::PARAM_STR);
                $stmt->bindParam(':balance', $balance, PDO::PARAM_STR);
            
                $stmt->execute();
                return;
                echo "Data inserted successfully.";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function getMyDeposit()
    {
        $user_id = $_SESSION['user']['id'];
        $sql = "SELECT SUM(amount) AS total_amount FROM accounts WHERE user_id = :user_id AND type = 'deposit'";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();

            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function getBalance($user_id)
    {
        $sql = "SELECT * FROM accounts WHERE user_id = :user_id ORDER BY id DESC LIMIT 1";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();

            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result){
                return $result['balance'];
            }
            return 0;
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}