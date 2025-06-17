<?php

// Danh sách URL hình ảnh từ nguồn miễn phí (Unsplash)
$fruit_images = [
    'apple' => 'https://images.unsplash.com/photo-1619546813926-a78fa6372cd2?w=300&q=80',
    'orange' => 'https://images.unsplash.com/photo-1582979512210-99b6a53386f9?w=300&q=80',
    'banana' => 'https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?w=300&q=80',
    'pear' => 'https://images.unsplash.com/photo-1514756331096-242fdeb70d4a?w=300&q=80'
];

// Thư mục lưu trữ
$output_dir = __DIR__ . '/../public/images/fruits/';

// Tạo thư mục nếu chưa tồn tại
if (!file_exists($output_dir)) {
    mkdir($output_dir, 0777, true);
}

// Tải và xử lý từng hình ảnh
foreach ($fruit_images as $name => $url) {
    $output_file = $output_dir . $name . '.png';

    // Tải hình ảnh
    $image_data = file_get_contents($url);
    if ($image_data === false) {
        echo "Không thể tải hình ảnh: $name\n";
        continue;
    }

    // Lưu hình ảnh
    if (file_put_contents($output_file, $image_data) === false) {
        echo "Không thể lưu hình ảnh: $name\n";
        continue;
    }

    echo "Đã tải và lưu thành công: $name.png\n";
}

echo "\nHoàn thành! Kiểm tra thư mục: " . $output_dir . "\n";
