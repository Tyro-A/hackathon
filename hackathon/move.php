<?php
// اتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// معالجة البيانات المرسلة من النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استلام البيانات من النموذج
    $title_ar = $_POST['title_ar'];
    $title_en = $_POST['title_en'];
    $supervisor = $_POST['supervisor'];
    $description = $_POST['description'];
    $progress = $_POST['progress'];
    $adoptingAuthority = $_POST['adoptingAuthority'];
    $category_name = $_POST['category'];
    $name_1 = $_POST['name_1'];
    $name_2 = $_POST['name_2'];
    $name_3 = $_POST['name_3'];
    $name_4 = $_POST['name_4'];
    $image_1 = $_POST['image1'];
    $image_2 = $_POST['image2'];
    $image_3 = $_POST['image3'];
    $image_4 = $_POST['image4'];

    // استخدام استعلام واحد لإدخال البيانات في جداول متعددة
    $conn->autocommit(FALSE); // تعطيل التحديث التلقائي

    $success = true;
    $sql .= "INSERT INTO members (name_1, name_2, name_3, name_4) 
            VALUES ('$name_1', '$name_2', '$name_3', '$name_4');";
    // إنشاء استعلام واحد يضم جميع الإدخالات
    $sql = "INSERT INTO projects (title_ar, title_en, supervisor, description, progress, adoption_authority, members_id) 
            VALUES ('$title_ar', '$title_en', '$supervisor', '$description', $progress, '$adoptingAuthority', '');";
    $sql .= "INSERT INTO category (name) VALUES ('$category_name');";
    $sql .= "INSERT INTO images (image_1, image_2, image_3, image_4) 
            VALUES ('$image_1', '$image_2', '$image_3', '$image_4');";

            $sql .="";

    if ($conn->multi_query($sql)) {
        do {
            // استمرار التنفيذ حتى نهاية النتائج
        } while ($conn->next_result());

        echo "تمت إضافة البيانات بنجاح";
        $conn->commit(); // تأكيد التحديثات
    } else {
        $success = false;
    }

    if (!$success) {
        echo "حدثت مشكلة أثناء إضافة البيانات";
        $conn->rollback(); // التراجع عن التحديثات في حالة حدوث خطأ
    }

    $conn->autocommit(TRUE); // تفعيل التحديث التلقائي مرة أخرى
}

$conn->close();
?>
