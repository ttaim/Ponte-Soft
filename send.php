<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "ponte9385@gmail.com";
    $subject = "تسجيل جديد في دورة تطوير الواجهات";

    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $about = htmlspecialchars($_POST["about"]);

    $message = "الاسم: $name\n";
    $message .= "البريد الإلكتروني: $email\n";
    $message .= "رقم الهاتف: $phone\n";
    $message .= "نبذة عنه:\n$about\n";

    $headers = "From: noreply@yourdomain.com\r\n" .
               "Reply-To: $email\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "تم إرسال التسجيل بنجاح!";
    } else {
        echo "حدث خطأ أثناء الإرسال.";
    }
}
?>
