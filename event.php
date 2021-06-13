<?php 
//index.php
$connect = mysqli_connect("localhost", "root", "", "testing");
$query = "SELECT * FROM employee ORDER BY name ASC";
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>
 <head>
  <title>How to return JSON Data from PHP Script using Ajax Jquery</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  #result {
   position: absolute;
   width: 100%;
   max-width:870px;
   cursor: pointer;
   overflow-y: auto;
   max-height: 400px;
   box-sizing: border-box;
   z-index: 1001;
  }
  .link-class:hover{
   background-color:#f1f1f1;
  }
  </style>
 </head>
 <body>
  <br /><br />
  <div class="container" style="width:900px;">
   <h2 align="center">How to return JSON Data from PHP Script using Ajax Jquery</h2>
   <h3 align="center">Search Employee Data</h3><br />   
   <div class="row">
    <div class="col-md-4">
     <select name="employee_list" id="employee_list" class="form-control">
      <option value="">Select Employee</option>
      <?php 
      while($row = mysqli_fetch_array($result))
      {
       echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
      }
      ?>
     </select>
    </div>
    <div class="col-md-4">
     <button type="button" name="search" id="search" class="btn btn-info">Search</button>
    </div>
   </div>
   <br />
   <div class="table-responsive" id="employee_details" style="display:none">
   <table class="table table-bordered">
    <tr>
     <td width="10%" align="right"><b>Name</b></td>
     <td width="90%"><span id="employee_name"></span></td>
    </tr>
    <tr>
     <td width="10%" align="right"><b>Address</b></td>
     <td width="90%"><span id="employee_address"></span></td>
    </tr>

    <tr>
     <td width="10%" align="right"><b>Gender</b></td>
     <td width="90%"><span id="employee_gender"></span></td>
    </tr>
    <tr>
     <td width="10%" align="right"><b>Designation</b></td>
     <td width="90%"><span id="employee_designation"></span></td>
    </tr>
    <tr>
     <td width="10%" align="right"><b>Age</b></td>
     <td width="90%"><span id="employee_age"></span></td>
    </tr>
   </table>
   </div>
   
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 $('#search').click(function(){
  var id= $('#employee_list').val();
  if(id != '')
  {
   $.ajax({
    url:"fetch.php",
    method:"POST",
    data:{id:id},
    dataType:"JSON",
    success:function(data)
    {
     $('#employee_details').css("display", "block");
     $('#employee_name').text(data.name);
     $('#employee_address').text(data.address);
     $('#employee_gender').text(data.gender);
     $('#employee_designation').text(data.designation);
     $('#employee_age').text(data.age);
    }
   })
  }
  else
  {
   alert("Please Select Employee");
   $('#employee_details').css("display", "none");
  }
 });
});
</script>