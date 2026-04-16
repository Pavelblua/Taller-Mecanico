<?php
$password = 'admin12356';
$hash = '$2y$10$u1Q6FQ7zv6kF7h8h9kF9Uu8uGk2H7K8yYlPjYwYw9Vg1xXjXf8J6G';
if (password_verify($password, $hash)) {
    echo "Password matches";
} else {
    echo "Password does not match";
}
?>