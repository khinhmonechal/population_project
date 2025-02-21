<?php

include "db.php";

$prefecture = $_GET["prefecture"] ?? null;
$year = $_GET["year"] ?? null;

if ($prefecture && $year) {
    $sql = "SELECT * FROM prefecture_population4 where prefecture like '%$prefecture%' AND year = '$year'";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>番号</th>";
            echo "<th>県</th>";
            echo "<th>年</th>";
            echo "<th>人口</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["prefecture"] . "</td>";
                echo "<td>" . $row["year"] . "</td>";
                echo "<td>" . number_format($row["population"]) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            // Free result set
            mysqli_free_result($result);
        } else {
            echo "No records matching your query were found.";
        }
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style type="text/css">
        table {
          border-collapse: separate;
          border-spacing: 0;
          border: 1px solid #333;
          border-radius: 10px;
          overflow: hidden;
          margin-left: 80px;
          margin-top: 5px;
        }
        th, td {
          padding: 10px 25px;
          border-bottom: 1px solid #555;
        }
        th {
          background-color: #eee;
        }
        td {
          border-left: 1px solid #555;
        }
        tr:last-child th,
        tr:last-child td {
          border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>CSVファイルをアップロード</h2>

        <?php if (isset($_GET["msg"])): ?>
            <div class="alert alert-success"><?php echo $_GET["msg"]; ?></div>
        <?php endif; ?>
        <?php if (isset($_GET["error"])): ?>
            <div class="alert alert-danger"><?php echo $_GET["error"]; ?></div>
        <?php endif; ?>

        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="file" name="file" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">アップロード</button><br><br>
        </form>

        <form action="index.php" method="get">
            <select name="prefecture">
                <option value="全　国">全　国</option>
                <option value="北海道">01 北海道</option>
                <option value="青森県">02 青森県</option>
                <option value="岩手県">03 岩手県</option>
                <option value="宮城県">04 宮城県</option>
                <option value="秋田県">05 秋田県</option>
                <option value="山形県">06 山形県</option>
                <option value="福島県">07 福島県</option>
                <option value="茨城県">08 茨城県</option>
                <option value="栃木県">09 栃木県</option>
                <option value="群馬県">10 群馬県</option>
                <option value="埼玉県">11 埼玉県</option>
                <option value="千葉県">12 千葉県</option>
                <option value="東京都">13 東京都</option>
                <option value="神奈川県">14 神奈川県</option>
                <option value="新潟県">15 新潟県</option>
                <option value="富山県">16 富山県</option>
                <option value="石川県">17 石川県</option>
                <option value="福井県">18 福井県</option>
                <option value="山梨県">19 山梨県</option>
                <option value="長野県">20 長野県</option>
                <option value="岐阜県">21 岐阜県</option>
                <option value="静岡県">22 静岡県</option>
                <option value="愛知県">23 愛知県</option>
                <option value="三重県">24 三重県</option>
                <option value="滋賀県">25 滋賀県</option>
                <option value="京都府">26 京都府</option>
                <option value="大阪府">27 大阪府</option>
                <option value="兵庫県">28 兵庫県</option>
                <option value="奈良県">29 奈良県</option>
                <option value="和歌山県">30 和歌山県</option>
                <option value="鳥取県">31 鳥取県</option>
                <option value="島根県">32 島根県</option>
                <option value="岡山県">33 岡山県</option>
                <option value="広島県">34 広島県</option>
                <option value="山口県">35 山口県</option>
                <option value="徳島県">36 徳島県</option>
                <option value="香川県">37 香川県</option>
                <option value="愛媛県">38 愛媛県</option>
                <option value="高知県">39 高知県</option>
                <option value="福岡県">40 福岡県</option>
                <option value="佐賀県">41 佐賀県</option>
                <option value="長崎県">42 長崎県</option>
                <option value="熊本県">43 熊本県</option>
                <option value="大分県">44 大分県</option>
                <option value="宮崎県">45 宮崎県</option>
                <option value="鹿児島県">46 鹿児島県</option>
                <option value="沖縄県">47 沖縄県</option>
            </select>
            <select name="year">
                <option value="1935">1935</option>
                <option value="1947">1947</option>
                <option value="1950">1950</option>
                <option value="1955">1955</option>
                <option value="1960">1960</option>
                <option value="1965">1965</option>
                <option value="1970">1970</option>
                <option value="1975">1975</option>
                <option value="1980">1980</option>
                <option value="1985">1985</option>
                <option value="1990">1990</option>
                <option value="1995">1995</option>
                <option value="2000">2000</option>
                <option value="2005">2005</option>
                <option value="2010">2010</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
            </select>
            <button type="submit">人口を得る</button>
            <div id="result"></div>
        </form>
    </div>
</body>
</html>
