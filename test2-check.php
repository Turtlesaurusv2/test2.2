<?php

include('db_conn.php'); 
$mydb = new db(); // สร้าง object ใหม่ , class db()

$conn = $mydb->connect();

$rpp =10;

echo '<div>';
$COUNT= $conn->prepare("SELECT COUNT(*)as ttt FROM invoice ");
$COUNT->execute();
$rec = $COUNT->fetch(PDO::FETCH_ASSOC);
$ttt = $rec['ttt'];

$ttp = ceil($ttt/$rpp);

$lim = $rpp-10;
for($i=1; $i<=$ttp && $i<=5; $i++)
 {
    echo "<span class='pagination_link'style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."<span>";

 }
 echo "</div>";
//รับค่า Query จากหน้า index.php 
if(isset($_POST["query"]))
{
// ค้นหาข้อมูลใน database ที่ตรงกับ input 
$q = $_POST["query"];
	
$results = $conn->prepare("SELECT * FROM invoice WHERE email LIKE '%" . $q . "%'
OR name LIKE '%".$q."%'
OR title LIKE '%".$q."%'
OR address LIKE '%".$q."%'
OR organization LIKE '%".$q."%'
OR company_format LIKE '%".$q."%'
OR branch LIKE '%".$q."%'
LIMIT 0,10;
");


}
else
{
 //ถ้าไม่ได้ input  จะแสดงข้อมูล ใน datadase
 $results = $conn->prepare("SELECT * FROM invoice  LIMIT 0,10");

}
//แสดงข้อมูล column database
$results->execute();
echo'<table  id="main">
<thead>
  <tr>
    <th>ชื่อ</th>
    <th></th>
  </tr>
</thead>    <tbody id="result">';
while($row = $results->fetch(PDO::FETCH_ASSOC))
{

     echo '<tr>' . 
    "<td >" . $row['name'] . '</td>' .
    '<td>' ."<button onclick='send(".$row['invoice_id'].");'type='button'  name='butsave' id='show' >เพิ่มเติม</button>". '</td>' .
    '</tr>'.
    '<tr id="invoiceBody'.$row['invoice_id'].'"style="display:none"><td colspan = "2" id ="invoiceBody'.$row['invoice_id'].'"></td></tr>';

} 
echo'</tbody>
</table>';

?>
