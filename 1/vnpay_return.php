<?php
/* Payment Notify
* IPN URL: Ghi nhận kết quả thanh toán từ VNPAY
* Các bước thực hiện:
* Kiểm tra checksum
* Tìm giao dịch trong database
* Kiểm tra số tiền giữa hai hệ thống
* Kiểm tra tình trạng của giao dịch trước khi cập nhật
* Cập nhật kết quả vào Database
* Trả kết quả ghi nhận lại cho VNPAY
*/

// require_once("./config.php");
include 'components/connect.php';

$inputData = array();
$returnData = array();
$vnp_HashSecret = "K7WMMCXE1NEAA8LVDETO4ANCWZOPASIU";

foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}

$vnp_SecureHash = $inputData['vnp_SecureHash'];
unset($inputData['vnp_SecureHash']);
ksort($inputData);
$i = 0;
$hashData = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
}

$secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
$vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
$vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
$vnp_Amount = $inputData['vnp_Amount'] / 100; // Số tiền thanh toán VNPAY phản hồi

$Status = 0; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo
$orderId = $inputData['vnp_TxnRef'];
$message;
try {
    //Check Orderid
    //Kiểm tra checksum của dữ liệu
    if ($secureHash == $vnp_SecureHash) {
        //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái củaz đơn hàng, mã đơn hàng là: $orderId
        //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
        //Giả sử: $order = mysqli_fetch_assoc($result);

        $stmt = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
        $stmt->execute([$orderId]);
        $order = $stmt->fetch();
        var_dump($order);
        if ($order != NULL) {
            if ($order["total_price"] == $vnp_Amount) //Kiểm tra số tiền thanh toán của giao dịch: giả sử số tiền
            {
                if ($order["payment_status"] == "pending") {
                    $stmtUpdate = $conn->prepare("UPDATE `orders` SET `payment_status` = 'paid' WHERE id = ?");
                    $stmtUpdate->execute([$orderId]);
                    $message = "Thanh toán thành công";
                    $returnData['RspCode'] = '00';
                    $returnData['Message'] = 'Confirm Success';
                } else {
                    $returnData['RspCode'] = '02';
                    $message = "Đơn hàng đã được thanh toán";
                    $returnData['Message'] = 'Order already confirmed';
                }
            } else {
                $returnData['RspCode'] = '04';
                $message = "Số tiền không hợp lệ";
                $returnData['Message'] = 'invalid amount';
            }
        } else {
            $returnData['RspCode'] = '01';
            $message = "Đơn hàng không tồn tại";
            $returnData['Message'] = 'Order not found';
        }
    } else {
        $returnData['RspCode'] = '97';
        $message = "Chữ ký không hợp lệ";
        $returnData['Message'] = 'Invalid signature';
    }
} catch (Exception $e) {
    $returnData['RspCode'] = '99';
    $message = "Lỗi không xác định";
    $returnData['Message'] = 'Unknow error';
}
//Trả lại VNPAY theo định dạng JSON
echo json_encode($returnData);
header("Location: /clothes/web/1/orders.php?msg=$message");
exit();