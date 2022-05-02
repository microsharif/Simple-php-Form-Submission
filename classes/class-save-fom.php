<?php 


include("class-db.php");

class FormSave
{
	function __construct($db)
	{
		extract($_POST);

		if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
            $buyer_ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
            $buyer_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $buyer_ip = $_SERVER['REMOTE_ADDR'];
        }

		if(isset($_COOKIE['browser_ip']) &&  $_COOKIE['browser_ip'] === $buyer_ip){
			echo json_encode(['error' => 'You are not allowed to submit in next 24 hour']);
			setcookie('browser_ip', $buyer_ip,  1);
			return;
		}

		if( $this->amounValid($amount) && $this->buyerValid($buyer) && $this->receiptidValid($receipt_id) && $this->emailValid($buyer_email) && $this->itemsValid($items) && $this->phoneValid($phone) && $this->noteValid($note) && $this->cityValid($city) && $this->entryValid($entry_by) ){

			$hash_key = hash("sha512", $receipt_id);

	        $entry_at = date("Y-m-d");

	        if($db->insert("buyer_info","amount='$amount', buyer='$buyer', receipt_id='$receipt_id', items='$items', buyer_email='$buyer_email', buyer_ip='$buyer_ip', note='$note', city='$city', phone='$phone', hash_key='$hash_key', entry_at='$entry_at', entry_by='$entry_by'")){

	        	setcookie('browser_ip', $buyer_ip,  time()+86400);
				echo json_encode(['success' => 'success fully submitted']);	
			}else{
				echo json_encode(['error' => 'Something went wrong']);	
			}
		}else{
			echo json_encode(['error' => 'Invalid Input']);
		}


	}


	private function amounValid($amount){
		return is_numeric($amount);
	}

	private function buyerValid($buyer){
		return preg_match("/^[a-zA-Z0-9\s]*$/", $buyer);
	}

	private function receiptidValid($receipt_id){
		return preg_match("/^[a-zA-Z\s]*$/", $receipt_id);
	}

	private function emailValid($buyer_email){
		return preg_match("/\S+@\S+\.\S+/", $buyer_email);
	}

	private function itemsValid($items){
		return preg_match("/^[a-zA-Z,?\s]+$/", $items);
	}

	private function phoneValid($phone){
		return preg_match("/(^880)([0-9]{10})/", $phone);
	}

	private function noteValid($note){
		return substr_count($note, ' ') <= 29;
	}

	private function cityValid($city){
		return preg_match("/^[a-zA-Z\s]*$/", $city);
	}

	private function entryValid($entry_by){
		return is_numeric($entry_by);
	}
}

new FormSave($db);

