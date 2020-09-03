<?php
require 'nav.php';
include 'connectdb.php';
?>  
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
    <style>
        table {
            font-family: "Freestyle Script";
            font-size:31px;
            border-collapse: collapse;
            width:55%;
            background:url("img/whitebroad.png");
        }
        
        th {
            border: 1px;
            text-align: left;
            padding: 8px;
        }
        td{
            text-align: center;
        }

    </style>
<body background='img/bgmenu.png'>
        <center>
        <h1><img src="img/headmenu.png"></h1>        
        <?php 
            $strSQL = "select p.id_product,p.name_product,p.cost_product,pt.name_type,c.name_category from product p 
            inner join producttype pt on p.id_type = pt.id_type 
            inner join category c on p.id_category = c.id_category order by id_product";
            $objQuery = mysqli_query($con,$strSQL);
            $type = "";
            $productname = "";
            $status = false;
            $i = 0;
            while($objResult = mysqli_fetch_array($objQuery)){
                if($type != $objResult["name_category"]){   
                    $type = $objResult["name_category"];
                    if($i > 0){
                        $status = true;
                    }
                    if($status == true){
                        $status == false;
                        ?>
                        </tr>
                        </table>
                        <?php
                    }       
        ?>
            <h2><img src="img/<?php echo $type;?>bar.png"></h2>
            <table  style="color: white;">       
        <?php
            $i = $i + 1 ;
            }
            if($productname != $objResult["name_product"]){
                $productname = $objResult["name_product"];
        ?>
        <tr>
            <th><?php echo $objResult["name_product"];?></th>
        <?php
            }
        ?>
            <td onclick="basket('<?php echo $objResult["id_product"];?>',
            '<?php echo $objResult["name_product"];?>',
            '<?php echo $objResult["name_type"];?>',
            '<?php echo $objResult["cost_product"];?>')">
            <?php echo $objResult["cost_product"];?></td>
        <?php

        }
        ?>
        </center>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            function basket(id,name,type,price){
                swal("คุณจะเพิ่ม "+name+" "+type+" ราคา "+price+" บาท ใช่ไหม?", {
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
                        swal("เพิ่มลงตะกร้า", "เรียบร้อย", "success");
                                
                        $.post("basket.php",
                        {
                            ProductID: id
                        });
                        location.reload();
                        break;
                    }
                });
            }
	    </script>   
</body>
<html>