<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Phát sinh mảng và tính toán</title>
        <link href="style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        // put your code here
        if (isset($_POST["number"])) {
            $number = $_POST["number"];
            $mang = array();
            for ($i = 0; $i < $number; $i++) {
                $mang[$i] = rand(0, 20);
            }
            print_r($mang);
        }
        ?>
        <div id="wrapper">
            <h2 style="text-align: center; color: red;">Phát sinh mảng và tính toán</h2>
            <form method="post" action="PhatSinhMang_TinhToan.php">
                <div class="row">
                    <span>Nhập số phần tử: </span><input name="number" type="text" placeholder="ex: 10" required="" value="<?php
                    if (isset($_POST["number"])) {
                        echo "$number";
                    }
                    ?>"/>
                </div>
                <div class="row">
                    <span>Mảng: </span><input name="mang" type="text" value="<?php
                    if (isset($_POST["number"])) {
                        $summang = 0;
                        foreach ($mang as $key => $value) {
                            echo "$value &nbsp;";
                            $summang = $summang + $value;
                        }
                    }
                    ?>" readonly="readonly"/>
                </div>
                <div class="row">
                    <span>GTLN: </span><input name="max" type="text" value="<?php
                    if (isset($_POST["number"])) {
                        $maxmang = max($mang);
                        echo "$maxmang";
                    }
                    ?>" readonly="readonly"/>
                </div>
                <div class="row">
                    <span>GTNN </span><input name="min" type="text" value="<?php
                    if (isset($_POST["number"])) {
                        $minmang = min($mang);
                        echo "$minmang";
                    }
                    ?>" readonly="readonly"/>
                </div>
                <div class="row">
                    <span>Tổng Mảng: </span><input name="summang" type="text" value="<?php
                    if (isset($_POST["number"])) {

                        echo "$summang";
                    }
                    ?>" readonly="readonly"/>
                </div>
                <div class="row">
                    <input style="margin-left: 120px;" type="submit" value="Phát sinh và tính"/>
                </div>
                <label>(Ghi chú: Các phần tử trong mảng sẽ có giá trị từ 0 đến 20)</label>
            </form>
        </div>
    </body>
</html>
