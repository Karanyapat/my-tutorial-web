<?php
    include 'condb.php';
    $ids = $_GET['id'];
    $sql = "SELECT map FROM school WHERE sc_id='$ids'";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>map</title>
</head>
<body>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <?php if (filter_var($row['map'], FILTER_VALIDATE_URL)): ?>
                <li>
                    <a href="javascript:void(0);" onclick="openMap('<?php echo $row['map']; ?>')">
                        <?php echo $row['map']; ?>
                    </a>
                </li>
            <?php else: ?>
                <li>ไม่มี URL ที่ถูกต้อง</li>
            <?php endif; ?>
        <?php endwhile; ?>
    </ul>

    <script>
        function openMap(url) {
            window.open(url, '_blank');
        }
    </script>
</body>
</html>

