<?php
  ob_start();
  session_start();
  include 'connectdb.php';
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/dropmenu.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light" >
  <a class="navbar-brand" href="#">WHY COFFEE</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="menu.php">Menu</a>
      </li>
    </ul>
    <?php
      if ( isset($_SESSION["name"]) ) {
    ?>  
    <input type="hidden" id="user" name="user" value="<?php echo $_SESSION["email"] ?>">
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown dropleft">
        <a href="#"  data-toggle="dropdown" aria-expanded="false"><img src="img/basket.png" width="25"> <span class="glyphicon glyphicon-shopping-cart"></span><span class="caret"></span></a>
        <ul class="dropdown-menu dropdown-cart" role="menu">
          <?php 
          if(!isset($_SESSION["intLine"])){
          ?>
            <center>
            <span>ไม่มีสินค้า</span>
            </center>
            <?php
              }else{
                $Total = 0;
                $SumTotal = 0;
                for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
                {
                  if($_SESSION["strProductID"][$i] != "")
                  {
                    $strSQL = "select p.id_product,p.name_product,p.cost_product,pt.name_type,c.name_category from product p 
                            inner join producttype pt on p.id_type = pt.id_type 
                            inner join category c on p.id_category = c.id_category where p.id_product = ".$_SESSION["strProductID"][$i]."";
                    $objQuery = mysqli_query($con,$strSQL);
                    $objResult = mysqli_fetch_array($objQuery);
                    $Total = $_SESSION["strQty"][$i] * $objResult["cost_product"];
                    $SumTotal = $SumTotal + $Total;
                    $_SESSION["SumTotal"] = $SumTotal;
            ?>
            <li>
              <span class="item">
                  <span class="item-left">
                      <span class="item-info">
                          <span><?php echo $objResult["name_product"];?> <?php echo $objResult["name_type"];?></span>
                          <span><?php echo $objResult["cost_product"];?> ฿ <?php echo $_SESSION["strQty"][$i];?> แก้ว <?php echo number_format($Total,2);?> ฿</span>
                      </span>
                  </span>
                  <span class="item-right">
                      <!-- <button class="btn btn-xs btn-danger pull-right"><a href="delete.php?Line=">x</button></a> -->
                      <button class="btn btn-xs btn-danger pull-right" onclick="deletes(<?php echo $i;?>)">x</button>
                  </span>
              </span>
            </li>
            <?php
                }
              }
            ?>
              <li class="divider"></li>
              <center>
                Sum Total <?php echo number_format($SumTotal,2);?>
                <li><button onclick="checkout()">Check Out</button></li>
                <input type="hidden" id="username" name="username" value="<?php echo $_SESSION["email"] ?>">
              </center>
              <?php  
              }
              ?>
            </ul>
          </li>
        </ul>
        &nbsp;&nbsp;<?php echo "เงินในกระเป๋า ".$_SESSION["topup"]." ฿";?>   
          <a class="nav-link" href="checkOrder.php?user=<?php echo $_SESSION["email"] ?>" >
            <img src="img/bell.png" width="25" >
          </a>
            <div id="demo"></div>   
              <li class="dropdown">
              <a href="#"  data-toggle="dropdown" aria-expanded="false" 
                  href="someting.php?name=<?php echo $_SESSION["name"] ?>">
                  <?php echo $_SESSION["name"] ?><span class="glyphicon glyphicon-shopping-cart">
                  </span><span class="caret"></span></a>
                  <ul class="dropdown-menu dropdown-cart" role="menu">
                  <li><a href="topup.php" >Top UP</a></li>
                  <li><a href="logout.php">Log out</a></li>
              </li>
        <?php
          } else {   
        ?>
          <a class="nav-link" href="signup.php" >Sign Up</a>
          <a class="nav-link" href="login.php">Log in</a>
        <?php
          }
        ?>
      </div>
    </nav>
  <script>
		function checkout(){ 
    var user = document.getElementById("username").value;
    $.post("checkout.php",
    {
      username: user
    },
    function(data,status){
      if(data == 1){
        swal("ชำระเงินสำเร็จแล้ว", {
          buttons: {
              catch: {
                text: "ตกลง",
                value: "done",
              },
          },
        }).then((value) => {
            switch (value) {                 
                case "done":
                location.reload();
                break;
            }
        });
      } else {
        swal("ตังไม่พอไปเติมตัง");	
      }
			});
		}
    //$(document).ready(function() เป็นคำสั่งที่ให้เมื่อเปิดหน้าเว็บมาแล้วให้ทำงานเลย
    $(document).ready(function(){
      function load_unseen_notification(){
      var user = document.getElementById("user").value;
      $.ajax({
        url:"fetchData.php",
        method:"POST",
        data:{user:user},
        success:function(data)
        { 
          if(data > 0) {
            document.getElementById("demo").innerHTML = data;
            document.getElementById("demo").style.color = "red";
          } else {
            document.getElementById("demo").innerHTML = data;
          }
        }
        });
      }
      load_unseen_notification();
      //คำสั่งให้ยิงการทำงานทุกๆกี่วินาที 
      //5000 คือ 5 วิ
      setInterval(function(){ 
        load_unseen_notification();
      }, 5000);
    });

    function deletes(line){
      $.post("delete.php",
			{
				Line: line
			},
			function(data,status){
        location.reload();
			});
    }
	</script>
</body>
</html>

<script>

</script>
