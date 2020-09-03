<?php
    require 'navadmin.php';
    include 'connectdb.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body>
        <?php
            $sql = "select o.id_order,o.email,o.total,o.status,o.date_order,m.name from orders o 
            inner join member m on m.email = o.email order by o.status asc ,o.id_order desc";
            //asc น้อยไปมาก desc มากไปน้อย
            $result=mysqli_query($con,$sql);
        ?>
            <div class = "container">
                <br>
                    <table class = "table table-bordered">
                            <tr>
                                <th width = "20px">Order</th>
                                <th style="text-align:center" >Email</th>
                                <th style="text-align:center" >ชื่อ</th>
                                <th style="text-align:center">สินค้า</th>
                                <th style="text-align:center">เวลาสั่งซื้อ</th>
                                <th width = "150px" style="text-align:center">แจ้งเตือนลูกค้า</th>
                            </tr>
                        <tr>    
                    <?php
                        //http://php.net/manual/en/mysqli-result.fetch-array.php
                        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                            echo "<tr>";
                            echo "<td name = order style='text-align:center'>".$row['id_order']."</td>";
                            echo "<td name = email style='text-align:center'>".$row['email']."</td>";
                            echo "<td name = name style='text-align:center'>".$row['name']."</td>";
                            $sqlDetail = "select o.id_order,p.id_product,p.name_product,pt.name_type,p.cost_product,od.amount from orders_detail od 
                                    inner join orders o on o.id_order = od.id_order  
                                    inner join product p on p.id_product = od.id_product 
                                    inner join producttype pt on pt.id_type = p.id_type 
                                    where o.id_order = ".$row['id_order']."";
                            $results=mysqli_query($con,$sqlDetail);
                            echo "<td name = item>";
                            while($rows=mysqli_fetch_array($results,MYSQLI_ASSOC)){
                                echo  $rows['name_product']." ".$rows['name_type']." ".$rows['amount']." แก้ว ".$rows['cost_product']." บาท";
                                echo "</br>";
                            }
                            echo "ราคารวม ".$row['total']." บาท";
                            echo "</td>";
                            echo "<td name = name style='text-align:center'>".$row['date_order']."</td>";
                            if($row['status'] == "Success"){
                                echo "<td style='text-align:center'>Success</td>";
                            }else {
                                echo "<td style='text-align:center'><input type=submit name=post id=".$row['status']." class=btn btn-info value=".$row['status']." onclick = changeStatus(".$row['id_order'].",'Success')></td>";
                            }
                            
                        }
                    ?>
                        </tr>
                    </table>
            </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            function changeStatus(id,status){
                swal("ยืนยันการเปลี่ยนสถานะ", {
                    buttons: {
                        cancel: "ยกเลิก",
                        catch: {
                        text: "ตกลง",
                        value: "done",
                        },
                    },
                }).then((value) => {
                    switch (value) {                 
                        case "done":
                        swal("เปลี่ยนสถานะเรียบร้อย", "success");
                                
                        $.post("changeStatus.php",
                        {
                            orderId: id,
                            Status:status
                        });
                        location.reload();
                        break;
                    }
                });
            }
	    </script>   
    </body>
</html>