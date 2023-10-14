<?php 

namespace App\Models;

use PDO;
use PDOException;
use Throwable;

class Transfer extends Model 
{
  
   
    public  function store($data)
    {
        if(!empty($data)){
            $user_id = $data['user_id'];
            $amount = $data['amount'];
            $transfer_from = $data['transfer_from'];
            $transfer_to = $data['transfer_to'];
            $type = $data['type'];
            $in_out = $data['in_out'];
            $balance = $data['balance'];
            $sql = "INSERT INTO accounts (user_id, transfer_from, transfer_to, amount, type, in_out, balance) VALUES (:user_id, :transfer_from, :transfer_to, :amount, :type, :in_out, :balance)";
            try {
                
        
                $stmt = $this->db->prepare($sql);
                // Bind parameters to the placeholders
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
                $stmt->bindParam(':transfer_from', $transfer_from, PDO::PARAM_STR);
                $stmt->bindParam(':transfer_to', $transfer_to, PDO::PARAM_STR);
                $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
                $stmt->bindParam(':type', $type, PDO::PARAM_STR);
                $stmt->bindParam(':in_out', $in_out, PDO::PARAM_STR);
                $stmt->bindParam(':balance', $balance, PDO::PARAM_STR);
            
                
                $stmt->execute();
                
                return;
            } catch (Throwable $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }


    public function getMyTransfer()
    {
        $user_id = $_SESSION['user']['id'];
        $sql = "SELECT SUM(amount) as total_transfer FROM accounts WHERE user_id = :user_id AND type = 'transfer' AND in_out = 'out' ";
        // $sql = "SELECT * FROM accounts WHERE transfer_from = :user_id OR transfer_to = :user_id AND type = 'transfer'";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();

            // Fetch the result
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
            // $transfer_from = array_map(function($x){
            //     if($x['transfer_from'] === $_SESSION['user']['id']){
            //         return $x['amount'];
            //     }
            // },$result);
            // $transfer_to = array_map(function($x){
            //     if($x['transfer_to'] === $_SESSION['user']['id']){
            //         return $x['amount'];
            //     }
            // },$result);
            // $data = [
            //     'transfer_from' => array_sum($transfer_from),
            //     'transfer_to' => array_sum($transfer_to)
            // ];
            // return $data;
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}