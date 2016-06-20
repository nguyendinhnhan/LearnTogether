<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>
            function myFunction() {
                $("#hienThi").innerHTML = "";
            }
        </script>
    </head>
    <body>
        <?php
        $conn = mysql_connect("localhost", "root", "");
        mysql_select_db("53131125", $conn);
        mysql_set_charset("UTF8", $conn);
        ?>
        <div id="wrapper">
            <h3>TRA CỨU THÔNG TIN BỘ MÔN</h3>
            <form method="get" action="Tracuu_BM.php">              
                <div class="row">
                    <span>Chọn tên bộ môn: </span>
                    <select name="boMon">
                        <option value=""> -- Chọn bộ môn -- </option>
                        <?php
                        //lấy mã hãng sữa, tên hãng sữa từ csdl
                        $sqlHang_sua = 'SELECT * FROM bomon';
                        $result = mysql_query($sqlHang_sua, $conn);

                        if (mysql_num_rows($result) <> 0) {
                            while ($row = mysql_fetch_array($result)) {
                                echo '<option value="' . $row["MaBM"] . '"';
                                //giữ biến hãng sữa lại bằng cách in selected vào option nào có value = biến hãng sữa
                                if (isset($_GET["boMon"])) {
                                    $boMon = $_GET["boMon"];
                                    if ($boMon == $row["MaBM"]) {
                                        echo 'selected = "selected"';
                                    }
                                }
                                echo '>' . $row["TenBM"] . '</option>';
                            }
                        }
                        ?> 
                    </select>
                    <input type="submit" name="submit" value="Tìm kiếm" onclick="return myFunction();">
                </div>             
            </form>

            <div id="hienThi">


                <?php
                if (isset($_GET["submit"])) {
                    $sqlTimKiem = 'SELECT * FROM giangvien gv INNER JOIN bomon bm ON gv.MaBM = bm.MaBM WHERE bm.MaBM = "' . $boMon . '"';

                    $resultTimKiem = mysql_query($sqlTimKiem, $conn);

                    $stt = 1;
                    $bg = "#eeeeee";
                    
                    if (mysql_num_rows($resultTimKiem) <> 0) {
                        echo "<br><table><tr><th>STT</th><th>Ảnh</th><th>Thông tin</th></tr>";
                        while ($rowTimKiem = mysql_fetch_array($resultTimKiem)) {
                            $bg = ($bg == "#eeeeee" ? "#ffffff" : "#eeeeee");
                            echo "<tr bgcolor='" . $bg . "'><td>$stt</td>";
                            echo '<td><img style="width: 100px;height: 100px;" src="img/' . $rowTimKiem["AnhGV"] . '" alt=""/></td>';
                            echo "<td>";
                            echo "Họ tên: " . $rowTimKiem["Ho"] . " " . $rowTimKiem["Ten"] . "</br>";
                            echo "Ngày sinh: " . $rowTimKiem["NgaySinh"] . "</br>";
                            echo "Học vị: " . $rowTimKiem["HocVi"] . "</br>";
                            echo "</td></tr>";
                            //echo "<caption>Danh sách giảng viên thuộc bộ môn: " . $rowTimKiem["TenBM"] . "</caption>";
                            

                            $stt++;
                        }
                        echo "</table>";
                    }
                    
                    $sqlTimKiem2 = 'SELECT * FROM hocphan hp INNER JOIN bomon bm ON hp.MaBM = bm.MaBM WHERE bm.MaBM = "' . $boMon . '"';

                    $resultTimKiem2 = mysql_query($sqlTimKiem2, $conn);
                    $stt = 1;
                    if (mysql_num_rows($resultTimKiem2) <> 0) {

                        while ($rowTimKiem2 = mysql_fetch_array($resultTimKiem2)) {

                            echo "<br><table><tr><th>STT</th><th>Mã môn học</th><th>Tên môn học</th><th>Số tín chỉ</th></tr>";
                            echo "<tr bgcolor='" . $bg . "'><td>$stt</td>";
                            echo "<td>" . $rowTimKiem2 ["MaHP"] . "</td>";
                            echo "<td>" . $rowTimKiem2 ["TenHP"] . "</td>";
                            echo "<td>" . $rowTimKiem2 ["SoTC"] . "</td></tr>";
                            echo "<caption>Danh sách môn học thuộc bộ môn: " . $rowTimKiem2 ["TenBM"] . "</caption>";
                            echo "</table>";
                            $stt++;
                        }
                    }
                }
                ?>          
            </div>
        </div>
    </body>
</html>
