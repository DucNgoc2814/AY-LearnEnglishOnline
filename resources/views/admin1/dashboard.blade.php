@extends('admin.layouts.master')
@section('title', 'Dashboard')
@section('content')
    <main class="flex-grow">
        <div class="flex justify-between items-center p-2 border-bottom">
            <h1 class="text-2xl font-bold">KH mục tiêu <span class="text-gray-500">(15)</span></h1>
            <div class="flex space-x-2">
                <button class="bg-blue-500 text-white px-2 py-1 rounded"><i class="fas fa-plus"></i> Tạo KH mục
                    tiêu</button>
                <button class="border border-blue-500 text-blue-500 px-2 py-1 rounded"><i class="fas fa-file-import"></i> Nhập
                    KH mục tiêu (file excel)</button>
            </div>
        </div>

        <div class="flex justify-between items-cente ms-2 mb-1">
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <button class="bg-gray-200 px-1 py-1 rounded">Bộ lọc</button>
                    <ul class="absolute hidden bg-white shadow-lg rounded mt-2">
                        <li><a class="block px-1 py-1 text-gray-800 hover:bg-gray-200" href="#">Tạo mới</a>
                        </li>
                    </ul>
                </div>
                <div class="relative w-300">
                    <input type="text" class="border border-gray-300 rounded w-full px-1 py-1 w-3xl"
                        placeholder="Tìm kiếm với: tên đầy đủ, email, điện thoại di động...">
                    <button class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500"></button>
                </div>
            </div>
            <div class="flex space-x-2">
                <button class="bg-gray-200 px-2 rounded" title="Làm mới"><i class="fas fa-sync-alt"></i></button>
                <button class="bg-gray-200 px-2 me-2 rounded" title="Tùy chọn hiển thị"><i
                        class="fas fa-th-large"></i></button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="border ps-1 py-1 border-gray-300 text-start"><input type="checkbox"></th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Họ và tên</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Điện thoại di động <i
                                class="fas fa-sort"></i></th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Hoạt động</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Email</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Ngày sinh <i class="fas fa-sort"></i>
                        </th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Trạng thái <i class="fas fa-sort"></i>
                        </th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Nguồn KH <i class="fas fa-sort"></i>
                        </th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Kênh <i class="fas fa-sort"></i>
                        </th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Mô tả nguồn</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Chiến dịch</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">MKT Agent</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Người phụ trách</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Chi nhánh</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Level</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-1 pt-1"><input type="checkbox"></td>
                        <td class="ps-1 pt-1"><a href="#" class="text-blue-500">Vũ Anh Tuấn</a></td>
                        <td class="ps-1 pt-1"> <i class="fas fa-phone text-blue-500"></i>
                            0981586907</td>
                        <td class="ps-1 pt-1"></td>
                        <td class="ps-1 pt-1">vutuan511@gmail.com</td>
                        <td class="ps-1 pt-1">06/08/2024</td>
                        <td class="ps-1 pt-1"><span class="bg-green-200 text-green-800 px-2 py-1 rounded">Mới</span>
                        </td>
                        <td class="ps-1 pt-1">Digital Marketing</td>
                        <td class="ps-1 pt-1">Direct</td>
                        <td class="ps-1 pt-1"></td>
                        <td class="ps-1 pt-1">Chiến dịch...</td>
                        <td class="ps-1 pt-1">GMA VIETNAM</td>
                        <td class="ps-1 pt-1">Level 2</td>
                        <td class="ps-1 pt-1">1</td>
                        <td class="ps-1 pt-1"><i class="fas fa-search"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
@endsection
