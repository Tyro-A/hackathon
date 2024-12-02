<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>تعديل المشروع</title>
</head>
<body>
<?php
// قم بتوصيل الصفحة بقاعدة البيانات
$servername = "localhost";
$username = "اسم_المستخدم";
$password = "كلمة_المرور";
$dbname = "project";

// إنشاء اتصال
$conn = new mysqli($servername, $username, $password, $dbname);
// فحص الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // قم بتحديث البيانات بعد التعديل
    // يمكنك إدراج الكود الخاص بتحديث البيانات هنا
    echo "تم تحديث البيانات بنجاح!";
}

// استعلام لاسترجاع البيانات الحالية
$sql = "SELECT * FROM projects WHERE project_id = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
<form method="post">
    <label for="title_ar">العنوان بالعربية:</label>
    <input type="text" id="title_ar" name="title_ar" value="<?php echo $row['title_ar']; ?>">

    <label for="title_en">العنوان بالإنجليزية:</label>
    <input type="text" id="title_en" name="title_en" value="<?php echo $row['title_en']; ?>">

    <label for="supervisor">المشرف:</label>
    <input type="text" id="supervisor" name="supervisor" value="<?php echo $row['supervisor']; ?>">

    <label for="description">الوصف:</label>
    <textarea id="description" name="description"><?php echo $row['description']; ?></textarea>

    <label for="progress">التقدم:</label>
    <input type="text" id="progress" name="progress" value="<?php echo $row['progress']; ?>">

    <input type="submit" value="حفظ التغييرات">
</form>
<?php
} else {
    echo "لم يتم العثور على بيانات!";
}

$conn->close();
?>
</body>
</html>