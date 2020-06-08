<?PHP
session_start();
include_once("dbCon.php");
$conn =connect();

$val_id=urlencode($_POST['val_id']);
$store_id=urlencode("abc5dda2f2303bc0");
$store_passwd=urlencode("abc5dda2f2303bc0@ssl");
$requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=".$val_id."&store_id=".$store_id."&store_passwd=".$store_passwd."&v=1&format=json");

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $requested_url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

$result = curl_exec($handle);

$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if($code == 200 && !( curl_errno($handle)))
{

	# TO CONVERT AS ARRAY
	# $result = json_decode($result, true);
	# $status = $result['status'];

	# TO CONVERT AS OBJECT
	$result = json_decode($result);

	# TRANSACTION INFO
	$status = $result->status;
	$tran_date = $result->tran_date;
	$tran_id = $result->tran_id;
	$val_id = $result->val_id;
	$amount = $result->amount;
	$store_amount = $result->store_amount;
	$bank_tran_id = $result->bank_tran_id;
	$card_type = $result->card_type;

	# EMI INFO
	$emi_instalment = $result->emi_instalment;
	$emi_amount = $result->emi_amount;
	$emi_description = $result->emi_description;
	$emi_issuer = $result->emi_issuer;

	# ISSUER INFO
	$card_no = $result->card_no;
	$card_issuer = $result->card_issuer;
	$card_brand = $result->card_brand;
	$card_issuer_country = $result->card_issuer_country;
	$card_issuer_country_code = $result->card_issuer_country_code;

	# API AUTHENTICATION
	$APIConnect = $result->APIConnect;
	$validated_on = $result->validated_on;
	$gw_version = $result->gw_version;
  if($status = 'VALID'){
    $user_id = $_SESSION['id'];
    $sql = "INSERT INTO `transaction_history`(`transaction_id`,`user_id`, `date`, `amount`, `card_type`)
            VALUES ('$tran_id','$user_id','$tran_date','$amount','$card_type')";
    $conn->query($sql);
    $ssql = "SELECT balance FROM account_balance WHERE user_id = '$user_id'";
    $result = $conn->query($ssql);
    $row = mysqli_fetch_assoc($result);
    $balance = $row['balance'];
    $newBalance = ($balance + $amount);
    $query = "UPDATE account_balance SET balance = '$newBalance' WHERE user_id = '$user_id' ";
    $conn->query($query);
    header('Location:balance');

}
} else {

	echo "Failed to connect with SSLCOMMERZ";
}

?>
