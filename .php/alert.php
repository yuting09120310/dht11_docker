<?php
$host = 'localhost';
$dbuser ='sa';
$dbpassword = '1qazxsw2';
$dbname = 'arduino';
$link = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
if($link){
    mysqli_query($link,'SET NAMES uff8');
    // echo "正確連接資料庫";

    $a=array("CT_SMT","CT_IQC","ct_8_storehouse","ct_dip","CT_package","CT_electronic_warehouse","CT_Test","CT_12_storehouse");

    for($i=0; $i <= count($a) -1 ; $i++){
        $sql = "SELECT * FROM `node` WHERE location='$a[$i]' ORDER BY id DESC LIMIT 0 , 1";

        // 用mysqli_query方法執行(sql語法)將結果存在變數中
        $results = mysqli_query($link,$sql);

        // while ($row = $result->fetch_assoc()) {
        //     echo $row['location'].'溫度過高，溫度'.$row['temperature'].' 異常時間'.$row['time'].'</br>';
        // }

        if($results->num_rows > 0){
            while ($row = $results->fetch_assoc()) {
                if($row['temperature'] > 30 OR $row['humidity'] > 70){
                    $headers = array(
                        'Content-Type: multipart/form-data',
                        'Authorization: Bearer mgdGLoKUQPIl5mG3ndnz1W5d3AeQ80glGityDDKowEn'
                    );
                    $message = array(
                        'message' => $row['location'].  '異常，溫度:'   .$row['temperature'].   '濕度:'. $row['humidity']   .' 異常時間'.$row['time']
                    );
                    $ch = curl_init();
                    curl_setopt($ch , CURLOPT_URL , "https://notify-api.line.me/api/notify");
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
                    $result = curl_exec($ch);
                    curl_close($ch);
                }
            }
        }
    }
}
else {
    echo "不正確連接資料庫</br>" . mysqli_connect_error();
}
?>