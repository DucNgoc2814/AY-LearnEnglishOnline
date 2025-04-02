# Cấu trúc cơ sở dữ liệu - Hệ thống học trực tuyến

## Tổng quan

Hệ thống được thiết kế để hỗ trợ hai mô hình học tập:
1. Khóa học tự học (self-paced)
2. Lớp học có giảng viên (instructor-led)

Cơ sở dữ liệu được tổ chức thành các nhóm chức năng:

1. Quản lý người dùng và phân quyền
2. Quản lý khóa học và lớp học
3. Quản lý tài nguyên học tập
4. Quản lý học tập và tiến độ
5. Quản lý kiểm tra đánh giá
6. Quản lý thanh toán
7. Quản lý nội dung và tương tác
8. Quản lý học trực tuyến

## Chi tiết các bảng

### 1. Quản lý người dùng

#### `users` - Người dùng
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID người dùng |
| name | string | Tên người dùng |
| email | string | Email đăng nhập (unique) |
| password | string | Mật khẩu (đã mã hóa) |
| phone_number | string | Số điện thoại |
| birth_date | datetime | Ngày sinh |
| auth_google_id | string | ID xác thực Google (nếu có) |
| role | enum | Vai trò: admin/user |
| role_token | string | Token xác thực vai trò |
| refresh_token | string | Token làm mới |
| deleted_at | timestamp | Thời điểm xóa mềm |
| created_at | timestamp | Thời điểm tạo |
| updated_at | timestamp | Thời điểm cập nhật |

#### `students` - Học viên
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID học viên |
| user_id | bigint | ID liên kết với bảng users |
| student_code | string | Mã học viên (unique) |
| full_name | string | Họ tên đầy đủ |
| date_of_birth | date | Ngày sinh |
| gender | enum | Giới tính: male/female/other |
| phone | string | Số điện thoại |
| address | text | Địa chỉ |
| avatar | string | Đường dẫn ảnh đại diện |
| bio | text | Tiểu sử |
| parent1_name | string | Tên phụ huynh 1 |
| parent1_relationship | enum | Quan hệ: father/mother/guardian/other |
| parent1_phone | string | SĐT phụ huynh 1 |
| parent1_email | string | Email phụ huynh 1 |
| parent1_occupation | string | Nghề nghiệp phụ huynh 1 |
| parent1_is_emergency_contact | boolean | Là người liên hệ khẩn cấp |
| parent2_name | string | Tên phụ huynh 2 |
| parent2_relationship | enum | Quan hệ: father/mother/guardian/other |
| parent2_phone | string | SĐT phụ huynh 2 |
| parent2_email | string | Email phụ huynh 2 |
| parent2_occupation | string | Nghề nghiệp phụ huynh 2 |
| parent2_is_emergency_contact | boolean | Là người liên hệ khẩn cấp |
| is_active | boolean | Trạng thái hoạt động |
| deleted_at | timestamp | Thời điểm xóa mềm |
| created_at | timestamp | Thời điểm tạo |
| updated_at | timestamp | Thời điểm cập nhật |

#### `employees` - Nhân viên
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID nhân viên |
| user_id | bigint | ID liên kết với bảng users |
| employee_code | string | Mã nhân viên (unique) |
| name | string | Tên nhân viên |
| position | string | Chức vụ |
| department | string | Phòng ban |
| email | string | Email công việc |
| phone | string | Số điện thoại |
| address | string | Địa chỉ |
| is_active | boolean | Trạng thái hoạt động |
| join_date | date | Ngày vào làm |
| resignation_date | date | Ngày nghỉ việc |
| note | text | Ghi chú |
| deleted_at | timestamp | Thời điểm xóa mềm |
| created_at | timestamp | Thời điểm tạo |
| updated_at | timestamp | Thời điểm cập nhật |

### 2. Quản lý khóa học

#### `categories` - Danh mục
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID danh mục |
| name | string | Tên danh mục (unique) |
| slug | string | Slug URL (unique) |
| description | string | Mô tả danh mục |
| deleted_at | timestamp | Thời điểm xóa mềm |
| created_at | timestamp | Thời điểm tạo |
| updated_at | timestamp | Thời điểm cập nhật |

#### `courses` - Khóa học
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID khóa học |
| category_id | bigint | ID danh mục |
| title | string | Tên khóa học |
| slug | string | Slug URL (unique) |
| description | text | Mô tả chi tiết |
| short_description | string | Mô tả ngắn |
| course_type | enum | Loại: self_paced/instructor_led/hybrid |
| course_format | enum | Hình thức: online/offline/hybrid |
| price | decimal(10,2) | Giá gốc |
| sale_price | decimal(10,2) | Giá khuyến mãi |
| estimated_hours | integer | Số giờ học dự kiến |
| has_certificate | boolean | Có cấp chứng chỉ |
| requires_enrollment | boolean | Yêu cầu đăng ký |
| thumbnail | string | Ảnh đại diện |
| preview_video | string | Video giới thiệu |
| total_students | integer | Tổng số học viên |
| rating | decimal(3,2) | Điểm đánh giá trung bình |
| total_ratings | integer | Tổng số đánh giá |
| course_outline | json | Đề cương khóa học |
| requirements | json | Yêu cầu đầu vào |
| learning_outcomes | json | Kết quả đầu ra |
| release_date | datetime | Ngày phát hành |
| order | integer | Thứ tự hiển thị |
| is_featured | boolean | Khóa học nổi bật |
| is_active | boolean | Trạng thái hoạt động |
| deleted_at | timestamp | Thời điểm xóa mềm |
| created_at | timestamp | Thời điểm tạo |
| updated_at | timestamp | Thời điểm cập nhật |

### 3. Nhóm quản lý tài nguyên học tập

##### `resources`
- Quản lý tài nguyên học tập
- Sử dụng polymorphic relationship (resourceable)
- Các trường chính:
  - title, description
  - file_path, file_type, file_size
  - access_type: free/enrolled/premium
  - is_downloadable
  - resource_level: beginner/intermediate/advanced

##### `lessons`
- Bài học trong khóa học
- Các trường chính:
  - course_id
  - name, slug
  - order_number
  - is_preview

##### `lesson_videos`
- Video bài giảng
- Các trường chính:
  - lesson_id
  - video_url
  - duration
  - is_downloadable
  - is_preview

### 4. Nhóm quản lý học tập và tiến độ

##### `enrollments`
- Đăng ký học
- Các trường chính:
  - user_id, course_id, class_id
  - enrollment_type: course/class
  - status: active/completed/expired/suspended
  - progress_percentage
  - enroll_date, expire_date
  - completion_date

##### `progress`
- Theo dõi tiến độ học tập
- Các trường chính:
  - enrollment_id, lesson_id
  - watched_time, total_time
  - status
  - last_watched_at, completed_at

##### `video_progress`
- Theo dõi tiến độ xem video
- Các trường chính:
  - user_id, video_id
  - watched_seconds, percentage
  - completed
  - last_position, last_watched_at

##### `learning_logs`
- Ghi nhận hoạt động học tập
- Sử dụng polymorphic (loggable)
- Các trường chính:
  - user_id
  - action: viewed/downloaded/completed/...
  - action_time
  - duration_seconds
  - meta_data

### 5. Nhóm quản lý kiểm tra đánh giá

##### `tests`
- Bài kiểm tra/thi
- Sử dụng polymorphic (testable)
- Các trường chính:
  - name, description
  - duration
  - min_score, max_score
  - type: lesson_test/final_exam/entrance_test/session_test

##### `questions`
- Câu hỏi trong bài kiểm tra
- Các trường chính:
  - test_id
  - type: text/image/video/audio
  - question
  - media_url
  - order_number

##### `answers`
- Câu trả lời cho câu hỏi
- Các trường chính:
  - question_id
  - answer
  - is_correct
  - explanation
  - order_number

##### `test_results`
- Kết quả bài kiểm tra
- Các trường chính:
  - test_id, user_id
  - score
  - total_questions, correct_answers
  - started_at, completed_at
  - status: in_progress/completed/timeout/abandoned

##### `test_result_details`
- Chi tiết kết quả từng câu hỏi
- Các trường chính:
  - test_result_id, question_id, answer_id
  - is_correct
  - score
  - time_spent

### 6. Nhóm quản lý thanh toán

##### `order_statuses`
- Trạng thái đơn hàng
- Các trường: name, display_name

##### `orders`
- Đơn hàng
- Các trường chính:
  - user_id, course_id
  - transaction_id
  - payment_amount, price
  - sale_percentage
  - voucher_code
  - payment_method
  - payment_date

##### `vouchers`
- Mã giảm giá
- Các trường chính:
  - code
  - sale
  - start_date, end_date
  - usage_count, max_usage
  - min_order_value
  - max_discount

### 7. Nhóm quản lý nội dung và tương tác

##### `ratings`
- Đánh giá khóa học
- Các trường chính:
  - user_id, course_id
  - rating (1-5)
  - review
  - is_verified, is_published

##### `comments`
- Bình luận
- Sử dụng polymorphic (commentable)
- Các trường chính:
  - user_id
  - content
  - parent_id (comment cha)
  - is_published
  - likes

##### `blogs`
- Bài viết blog
- Các trường chính:
  - user_id
  - title, slug
  - content, summary
  - featured_image
  - is_published
  - published_at
  - views, likes

##### `banners`
- Banner quảng cáo
- Các trường chính:
  - title
  - image_url, link_url
  - position
  - start_date, end_date
  - is_active

### 8. Nhóm quản lý học trực tuyến

##### `online_rooms`
- Phòng học trực tuyến
- Sử dụng polymorphic (roomable)
- Các trường chính:
  - room_type: course/class_session/exam/consultation
  - meeting_id
  - platform: zoom/google_meet/ms_teams
  - host_id, host_email
  - join_url, host_url
  - scheduled_start, scheduled_end
  - status: scheduled/in_progress/completed/cancelled

##### `attendances`
- Điểm danh buổi học
- Các trường chính:
  - session_id, student_id
  - status: present/absent/late/excused
  - check_in_time, check_out_time
  - duration_minutes

##### `online_attendance_details`
- Chi tiết điểm danh trực tuyến
- Các trường chính:
  - attendance_id
  - join_time, leave_time
  - duration_seconds
  - device_info, ip_address
  - camera_on, microphone_on

##### `online_session_recordings`
- Bản ghi buổi học
- Các trường chính:
  - online_room_id
  - recording_url, download_url
  - duration_minutes
  - recording_type: cloud/local
  - chapters, transcript
  - requires_authentication
  - downloadable
  - view_count

##### `recording_views`
- Lượt xem bản ghi
- Các trường chính:
  - recording_id, user_id
  - started_at, completed_at
  - duration_seconds
  - progress_percentage
  - is_completed
  - device, browser

##### `session_interactions`
- Tương tác trong buổi học
- Các trường chính:
  - session_id, student_id
  - type: question/answer/chat/reaction/poll/quiz
  - content
  - interaction_time
  - is_private, is_highlighted

##### `session_activities`
- Hoạt động trong buổi học
- Các trường chính:
  - session_id
  - type: quiz/poll/group_work/presentation/...
  - content
  - duration
  - start_time, end_time
  - is_graded, is_mandatory

##### `activity_results`
- Kết quả hoạt động
- Các trường chính:
  - activity_id, student_id
  - answers
  - score, max_score
  - completion_percentage
  - start_time, submit_time

#### `classes` - Lớp học
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID lớp học |
| name | string | Tên lớp học |
| code | string | Mã lớp học (unique) |
| course_id | bigint | ID khóa học |
| teacher_id | bigint | ID giảng viên |
| class_type | enum | Loại lớp: online/offline/hybrid |
| start_date | datetime | Ngày bắt đầu |
| end_date | datetime | Ngày kết thúc |
| enrollment_deadline | date | Hạn đăng ký |
| max_students | integer | Số học viên tối đa (default: 30) |
| min_students | integer | Số học viên tối thiểu (default: 5) |
| fee | decimal(10,2) | Học phí |
| current_students | integer | Số học viên hiện tại |
| status | enum | Trạng thái: pending/active/completed/cancelled |
| description | text | Mô tả lớp học |
| schedule | json | Lịch học |
| is_active | boolean | Trạng thái hoạt động |
| deleted_at | timestamp | Thời điểm xóa mềm |
| created_at | timestamp | Thời điểm tạo |
| updated_at | timestamp | Thời điểm cập nhật |

#### `class_schedules` - Lịch học
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID lịch học |
| class_id | bigint | ID lớp học |
| day_of_week | integer | Thứ trong tuần (1-7) |
| start_time | time | Giờ bắt đầu |
| end_time | time | Giờ kết thúc |
| room_number | string | Số phòng học |
| is_online | boolean | Là buổi học trực tuyến |
| meeting_url | string | URL phòng học trực tuyến |
| is_repeating | boolean | Lặp lại hàng tuần |
| is_active | boolean | Trạng thái hoạt động |
| start_date | date | Ngày bắt đầu áp dụng |
| end_date | date | Ngày kết thúc áp dụng |
| notes | text | Ghi chú |
| deleted_at | timestamp | Thời điểm xóa mềm |
| created_at | timestamp | Thời điểm tạo |
| updated_at | timestamp | Thời điểm cập nhật |

#### `class_sessions` - Buổi học
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID buổi học |
| class_id | bigint | ID lớp học |
| schedule_id | bigint | ID lịch học |
| resource_id | bigint | ID tài nguyên |
| session_date | date | Ngày học |
| start_time | time | Giờ bắt đầu |
| end_time | time | Giờ kết thúc |
| room_number | string | Số phòng học |
| session_type | enum | Loại: in_person/online/hybrid |
| topic | text | Chủ đề buổi học |
| content | text | Nội dung chi tiết |
| homework | text | Bài tập về nhà |
| session_materials | text | Tài liệu buổi học |
| recording_url | string | URL bản ghi buổi học |
| attendance_required | boolean | Yêu cầu điểm danh |
| notes | text | Ghi chú |
| status | enum | Trạng thái: scheduled/completed/cancelled/rescheduled |
| deleted_at | timestamp | Thời điểm xóa mềm |
| created_at | timestamp | Thời điểm tạo |
| updated_at | timestamp | Thời điểm cập nhật |

#### `resources` - Tài nguyên học tập
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID tài nguyên |
| original_lesson_video_id | bigint | ID video bài học gốc |
| resourceable_type | string | Loại đối tượng sở hữu |
| resourceable_id | bigint | ID đối tượng sở hữu |
| title | string | Tiêu đề |
| description | text | Mô tả |
| type | string | Loại tài nguyên |
| url | string | URL tài nguyên |
| file_path | string | Đường dẫn file |
| file_type | string | Loại file |
| file_extension | string | Phần mở rộng file |
| file_size | bigint | Kích thước file |
| file_url | string | URL file |
| external_url | string | URL bên ngoài |
| preview_path | string | Đường dẫn xem trước |
| category | string | Danh mục |
| resource_level | enum | Cấp độ: beginner/intermediate/advanced/all |
| access_type | enum | Quyền truy cập: free/enrolled/premium |
| is_downloadable | boolean | Cho phép tải về |
| is_featured | boolean | Tài nguyên nổi bật |
| duration | integer | Thời lượng |
| download_count | integer | Số lượt tải |
| is_public | boolean | Công khai |
| order | integer | Thứ tự hiển thị |
| is_active | boolean | Trạng thái hoạt động |
| deleted_at | timestamp | Thời điểm xóa mềm |
| created_at | timestamp | Thời điểm tạo |
| updated_at | timestamp | Thời điểm cập nhật |

#### `lessons` - Bài học
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID bài học |
| course_id | bigint | ID khóa học |
| name | string | Tên bài học |
| slug | string | Slug URL (unique) |
| description | text | Mô tả bài học |
| order_number | integer | Thứ tự trong khóa học |
| is_preview | boolean | Bài học xem thử |
| total_view | integer | Tổng số lượt xem |
| total_comment | integer | Tổng số bình luận |
| deleted_at | timestamp | Thời điểm xóa mềm |
| created_at | timestamp | Thời điểm tạo |
| updated_at | timestamp | Thời điểm cập nhật |

#### `lesson_videos` - Video bài học
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID video |
| lesson_id | bigint | ID bài học |
| name | string | Tên video (unique) |
| slug | string | Slug URL (unique) |
| video_url | string | URL video |
| duration | integer | Thời lượng (giây) |
| video_type | string | Định dạng video |
| thumbnail_url | string | URL ảnh thumbnail |
| is_downloadable | boolean | Cho phép tải về |
| is_preview | boolean | Video xem thử |
| view_count | integer | Số lượt xem |
| deleted_at | timestamp | Thời điểm xóa mềm |
| created_at | timestamp | Thời điểm tạo |
| updated_at | timestamp | Thời điểm cập nhật | 