<!DOCTYPE html>
<html lang="en">
<head>
<style>
div {
  height: 50px;
  width: 50%;
  margin: auto;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {background-color: #f2f2f2;}

</style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootpag/1.0.4/jquery.bootpag.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>test2</title>
<?php

include('db_conn.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()

?>

<script type="text/javascript">
$(document).ready(function(){

load_data();

function load_data(query)
{
  var tod = {query};
 $.ajax({
  url:"test2-check.php",
  method:"POST",
  data:{query:query},
  success:function(data)
  {
   $('#result').html(data);
  }

 });
 $(document).on('click', '.pagination_link', function(){
           var page = $(this).attr("id");
           load_data(page);
           
});

}

$('#search_text').keyup(function(){
 var search = $(this).val();
 if(search != '')
 {
  load_data(search);
 }
 else
 {
  load_data();
 }
});
});


</script>
</head>
<body>
</br>

<div class="w3-container " >
<input class="w3-input w3-border" type="text" name="search_text" id="search_text" placeholder="Search " />
</div>
<br>



<script>
function send(id){

    var x = document.getElementById("invoiceBody"+id);
       // ajax
    $.ajax({
      url: "getinv.php",
      type: "POST",
			data: 'id='+id,
			success:function(data){
      if (x.style.display === "none") {
      x.style.display = "block";
      $("#invoiceBody"+id).html(data)
      } else {
      x.style.display = "none";
      }

    }
  });
                
}
</script>

<div class="table-responsive" id="result"></div>



</body>
</html>