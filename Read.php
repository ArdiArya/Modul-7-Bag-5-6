<?php

session_start();

if(!(isset($_SESSION['User'])))
{
    header("location: ../Login/Form-Login.php");
}

include '../connect.php';

$query = "SELECT * FROM Dosen";
$result = mysqli_query($connect, $query);
$num = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>
    <form action="Search.php" method="get">
        <input type="search" name="cari" placeholder="Masukkan Pencarian....">
        <input type="submit" value="cari">
    </form>
    <table border='1'>
    <h2>Data Dosen</h2>
    <tr>
        <th>No.</th>
        <th>Nama Dosen</th>
        <th>Telepon</th>
        <th>Aksi</th>
        <th>Delete</th>
    </tr>

    <?php
        if($num > 0)
        {
            $no = 1;
            while($data = mysqli_fetch_assoc($result))
            {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $data['nama_dosen'] . "</td>";
                echo "<td>" . $data['telp'] . "</td>";
                echo "<td><a href='Form-Update.php?ID=" . $data['ID'] . "'>Edit</a> | ";
                echo "<td><a href='Delete.php?ID=" . $data['ID'] . "'onclick='return confirm(\"Apakah Anda Yakin Ingin Menghapus Data ?\")' >Hapus</a></td>";              
                echo "</tr>";
                $no++;
            }
        }
        else
        {
            echo "<td colspan='3'> Tidak Ada Data</td>";
        }
    ?>

    </table>
    <br>
    <a href=" ../Login/Logout.php"><button>Logout</button></a>
</body>
</html>