# Cấu trúc cơ sở dữ liệu - Hệ thống học trực tuyến

## Tổng quan
Hệ thống được thiết kế để hỗ trợ hai mô hình học tập:
1. Khóa học tự học (self-paced)
2. Lớp học có giảng viên (instructor-led)

Cơ sở dữ liệu được tổ chức thành các nhóm chức năng:
- Quản lý người dùng
- Quản lý khóa học và lớp học
- Quản lý tài nguyên học tập
- Theo dõi tiến độ học tập
- Quản lý buổi học trực tuyến
- Kiểm tra và đánh giá
- Thanh toán và giao dịch

## Cấu trúc bảng

### 1. Nhóm quản lý người dùng

#### 1.1. `categories` - Danh mục
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID danh mục |
| name | string | Tên danh mục |
| slug | string | Slug URL |
| description | text | Mô tả danh mục |
| parent_id | bigint | ID danh mục cha (nếu có) |
| image | string | Hình ảnh danh mục |
| is_active | boolean | Trạng thái hoạt động |
| order | integer | Thứ tự hiển thị |

#### 1.2. `users` - Người dùng
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID người dùng |
| name | string | Tên người dùng |
| email | string | Email đăng nhập |
| password | string | Mật khẩu (đã mã hóa) |
| phone | string | Số điện thoại |
| avatar | string | Ảnh đại diện |
| role | string | Vai trò (admin, teacher, student) |
| status | string | Trạng thái tài khoản |
| email_verified_at | datetime | Thời điểm xác thực email |
| last_login | datetime | Lần đăng nhập gần nhất |

#### 1.3. `students` - Học viên
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID học viên |
| userId | bigint | ID liên kết với bảng users |
| studentCode | string | Mã học viên |
| fullName | string | Họ tên đầy đủ |
| dateOfBirth | date | Ngày sinh |
| gender | string | Giới tính |
| phone | string | Số điện thoại |
| address | text | Địa chỉ |
| avatar | string | Ảnh đại diện |
| bio | text | Tiểu sử |
| parent1Name, parent1Phone, parent1Email | string | Thông tin phụ huynh 1 |
| parent2Name, parent2Phone, parent2Email | string | Thông tin phụ huynh 2 |
| isActive | boolean | Trạng thái hoạt động |

#### 1.4. `employees` - Nhân viên
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID nhân viên |
| user_id | bigint | ID người dùng |
| employee_code | string | Mã nhân viên |
| position | string | Chức vụ |
| department | string | Phòng ban |
| hire_date | date | Ngày vào làm |
| status | string | Trạng thái làm việc |

### 2. Courses (Khóa học)
Bảng `courses` lưu trữ thông tin về các khóa học trong hệ thống.

| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID khóa học |
| title | string | Tên khóa học |
| slug | string | Slug URL của khóa học |
| description | text | Mô tả chi tiết |
| course_type | enum | Loại khóa học: self_paced, instructor_led, hybrid |
| course_format | enum | Hình thức: online, offline, hybrid |
| price | decimal | Giá khóa học |
| estimated_hours | integer | Số giờ học dự kiến |
| has_certificate | boolean | Có cấp chứng chỉ |
| requires_enrollment | boolean | Yêu cầu đăng ký |
| thumbnail | string | Ảnh đại diện |
| preview_video | string | Video giới thiệu |
| course_outline | json | Đề cương khóa học |
| requirements | json | Yêu cầu đầu vào |
| learning_outcomes | json | Kết quả đầu ra |
| order | integer | Thứ tự hiển thị |
| is_featured | boolean | Khóa học nổi bật |
| is_active | boolean | Trạng thái hoạt động |

### 3. Classes (Lớp học)
Bảng `classes` quản lý các lớp học cho các khóa học có giảng viên.

| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID lớp học |
| name | string | Tên lớp |
| code | string | Mã lớp |
| course_id | bigint | ID khóa học |
| teacher_id | bigint | ID giảng viên |
| class_type | enum | Loại lớp: online, offline, hybrid |
| start_date | datetime | Ngày bắt đầu |
| end_date | datetime | Ngày kết thúc |
| enrollment_deadline | date | Hạn đăng ký |
| max_students | integer | Số học viên tối đa |
| min_students | integer | Số học viên tối thiểu |
| fee | decimal | Học phí |
| current_students | integer | Số học viên hiện tại |
| status | enum | Trạng thái: pending, active, completed, cancelled |
| description | text | Mô tả lớp học |
| schedule | json | Lịch học |
| is_active | boolean | Trạng thái hoạt động |

### 4. Enrollments (Đăng ký)
Bảng `enrollments` quản lý việc đăng ký khóa học/lớp học.

| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID đăng ký |
| user_id | bigint | ID người dùng |
| course_id | bigint | ID khóa học |
| class_id | bigint | ID lớp học (nếu có) |
| enrollment_type | enum | Loại đăng ký: course, class |
| enrollment_date | datetime | Ngày đăng ký |
| expiration_date | datetime | Ngày hết hạn |
| progress_percentage | decimal | Phần trăm hoàn thành |
| last_activity_date | datetime | Ngày hoạt động gần nhất |
| completed_date | datetime | Ngày hoàn thành |
| certificate_issued | boolean | Đã cấp chứng chỉ |
| certificate_url | string | URL chứng chỉ |
| payment_status | enum | Trạng thái thanh toán: pending, paid, refunded, cancelled |
| payment_method | string | Phương thức thanh toán |
| amount_paid | decimal | Số tiền đã thanh toán |
| transaction_id | string | ID giao dịch |
| invoice_id | string | ID hóa đơn |
| discount_applied | decimal | Giảm giá áp dụng |
| status | enum | Trạng thái: active, completed, expired, suspended |
| notes | text | Ghi chú |

### 5. Nhóm tài nguyên học tập

#### 5.1. `resources` - Tài nguyên học tập 
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID tài nguyên |
| title | string | Tiêu đề |
| description | text | Mô tả |
| file_path | string | Đường dẫn file |
| file_type | string | Loại file (video, pdf, doc, etc.) |
| file_size | integer | Kích thước file |
| file_extension | string | Phần mở rộng file |
| file_url | string | URL file |
| external_url | string | URL bên ngoài |
| duration | integer | Thời lượng (cho video) |
| preview_path | string | Đường dẫn xem trước |
| resourceable_id | bigint | ID đối tượng sở hữu |
| resourceable_type | string | Loại đối tượng sở hữu |
| category | string | Danh mục tài nguyên |
| is_downloadable | boolean | Cho phép tải về |
| is_active | boolean | Trạng thái hoạt động |
| is_featured | boolean | Tài nguyên nổi bật |
| order | integer | Thứ tự hiển thị |
| resource_level | enum | Cấp độ tài nguyên |
| access_type | enum | Loại truy cập |
| original_lesson_video_id | bigint | ID video gốc |

#### 5.2. `lessons` - Bài học
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID bài học |
| courseId | bigint | ID khóa học |
| name | string | Tên bài học |
| slug | string | Slug URL |
| type | string | Loại bài học |
| description | text | Mô tả |
| orderNumber | integer | Thứ tự trong khóa học |
| isPreview | boolean | Bài học xem thử |
| totalView | integer | Tổng lượt xem |
| totalComment | integer | Tổng bình luận |

#### 5.3. `lesson_videos` - Video bài học
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID video |
| lessonId | bigint | ID bài học |
| title | string | Tiêu đề video |
| description | text | Mô tả |
| videoUrl | string | URL video |
| duration | integer | Thời lượng (giây) |
| thumbnailUrl | string | URL ảnh đại diện |
| orderNumber | integer | Thứ tự hiển thị |
| isFree | boolean | Video miễn phí |

### 6. Nhóm lịch học và buổi học

#### 6.1. `class_schedules` - Lịch học
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID lịch học |
| classId | bigint | ID lớp học |
| dayOfWeek | enum | Thứ trong tuần |
| startTime | time | Giờ bắt đầu |
| endTime | time | Giờ kết thúc |
| startDate | date | Ngày bắt đầu áp dụng |
| endDate | date | Ngày kết thúc áp dụng |
| roomNumber | string | Số phòng học |
| notes | text | Ghi chú |
| isRepeating | boolean | Lặp lại hàng tuần |
| isActive | boolean | Trạng thái hoạt động |

#### 6.2. `class_sessions` - Buổi học
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID buổi học |
| classId | bigint | ID lớp học |
| scheduleId | bigint | ID lịch học |
| online_room_id | bigint | ID phòng học online |
| sessionDate | date | Ngày học |
| startTime | time | Giờ bắt đầu |
| endTime | time | Giờ kết thúc |
| roomNumber | string | Số phòng học |
| session_type | enum | Loại buổi học (online, in_person, hybrid) |
| topic | text | Chủ đề buổi học |
| content | text | Nội dung buổi học |
| homework | text | Bài tập về nhà |
| notes | text | Ghi chú |
| status | enum | Trạng thái buổi học |

#### 6.3. `attendances` - Điểm danh
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID điểm danh |
| sessionId | bigint | ID buổi học |
| studentId | bigint | ID học viên |
| status | enum | Trạng thái điểm danh (present, absent, late) |
| checkInTime | time | Thời gian điểm danh |
| notes | text | Ghi chú |

#### 6.4. `class_student` - Mối quan hệ học viên-lớp học
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID quan hệ |
| classId | bigint | ID lớp học |
| studentId | bigint | ID học viên |
| status | string | Trạng thái tham gia |
| enrollmentDate | date | Ngày tham gia lớp |
| completionDate | date | Ngày hoàn thành lớp |
| notes | text | Ghi chú |

### 7. Nhóm học trực tuyến

#### 7.1. `online_rooms` - Phòng học trực tuyến
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID phòng học |
| room_id | string | ID phòng (từ nhà cung cấp) |
| room_type | string | Loại phòng |
| roomable_id | bigint | ID đối tượng liên kết |
| roomable_type | string | Loại đối tượng liên kết |
| title | string | Tiêu đề phòng |
| description | text | Mô tả |
| host_id | string | ID người chủ trì |
| host_email | string | Email người chủ trì |
| join_url | string | URL tham gia |
| host_url | string | URL cho host |
| password | string | Mật khẩu phòng |
| scheduled_start | datetime | Thời gian bắt đầu dự kiến |
| scheduled_end | datetime | Thời gian kết thúc dự kiến |
| duration_minutes | integer | Thời lượng (phút) |
| recurrence_pattern | json | Mẫu lặp lại |
| meeting_settings | json | Cài đặt cuộc họp |
| status | string | Trạng thái phòng |
| provider | string | Nhà cung cấp (Zoom, Meet, etc.) |
| timezone | string | Múi giờ |
| created_by | bigint | Người tạo |
| original_zoom_session_id | bigint | ID phiên zoom gốc |

#### 7.2. `online_attendance_details` - Chi tiết điểm danh trực tuyến
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID chi tiết điểm danh |
| online_room_id | bigint | ID phòng học trực tuyến |
| user_id | bigint | ID người dùng |
| join_time | datetime | Thời gian tham gia |
| leave_time | datetime | Thời gian rời đi |
| duration_minutes | integer | Thời lượng tham gia (phút) |
| participant_id | string | ID người tham gia (từ nhà cung cấp) |
| participant_name | string | Tên người tham gia |
| participant_email | string | Email người tham gia |
| attendance_status | string | Trạng thái tham gia |
| ip_address | string | Địa chỉ IP |
| device_info | json | Thông tin thiết bị |
| participation_data | json | Dữ liệu tham gia |
| notes | text | Ghi chú |
| original_attendance_detail_id | bigint | ID chi tiết điểm danh gốc |

### 8. Online Session Recordings (Bản ghi buổi học)
Bảng `online_session_recordings` lưu trữ thông tin về các bản ghi buổi học.

| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID recording |
| online_room_id | bigint | ID phòng học |
| title | string | Tiêu đề |
| description | text | Mô tả |
| recording_url | string | URL recording |
| download_url | string | URL tải về |
| duration_minutes | integer | Thời lượng (phút) |
| recorded_at | datetime | Thời gian ghi |
| recording_type | enum | Loại: cloud, local |
| file_size | string | Kích thước file |
| chapters | json | Các chương/phần |
| transcript | json | Phụ đề tự động |
| is_processed | boolean | Đã xử lý |
| requires_authentication | boolean | Yêu cầu xác thực |
| downloadable | boolean | Cho phép tải về |
| view_count | integer | Số lượt xem |
| is_active | boolean | Trạng thái hoạt động |

### 9. Recording Views (Lượt xem recording)
Bảng `recording_views` theo dõi việc xem recording của người dùng.

| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID lượt xem |
| recording_id | bigint | ID recording |
| user_id | bigint | ID người dùng |
| started_at | datetime | Thời gian bắt đầu xem |
| completed_at | datetime | Thời gian hoàn thành |
| duration_seconds | integer | Thời gian xem (giây) |
| progress_percentage | integer | Phần trăm hoàn thành |
| is_completed | boolean | Đã xem xong |
| ip_address | string | Địa chỉ IP |
| device | string | Thiết bị |
| browser | string | Trình duyệt |
| notes | text | Ghi chú |

### 10. Session Interactions (Tương tác trong buổi học)
Bảng `session_interactions` ghi lại các tương tác trong buổi học.

| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID tương tác |
| session_id | bigint | ID buổi học |
| student_id | bigint | ID học viên |
| type | enum | Loại: question, answer, chat, reaction, poll, quiz, raise_hand |
| content | text | Nội dung |
| reaction_type | string | Loại reaction |
| interaction_time | datetime | Thời gian tương tác |
| is_private | boolean | Riêng tư |
| is_highlighted | boolean | Được đánh dấu |
| is_answered | boolean | Đã được trả lời |

### 11. Session Activities (Hoạt động trong buổi học)
Bảng `session_activities` quản lý các hoạt động học tập.

| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID hoạt động |
| session_id | bigint | ID buổi học |
| title | string | Tiêu đề |
| description | text | Mô tả |
| type | enum | Loại: quiz, poll, group_work, presentation, exercise, discussion |
| content | json | Nội dung hoạt động |
| duration | integer | Thời lượng (phút) |
| start_time | datetime | Thời gian bắt đầu |
| end_time | datetime | Thời gian kết thúc |
| is_graded | boolean | Có tính điểm |
| is_mandatory | boolean | Bắt buộc |

### 12. Activity Results (Kết quả hoạt động)
Bảng `activity_results` lưu trữ kết quả của học viên.

| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID kết quả |
| activity_id | bigint | ID hoạt động |
| student_id | bigint | ID học viên |
| answers | json | Câu trả lời |
| score | decimal | Điểm số |
| max_score | decimal | Điểm tối đa |
| completion_percentage | float | Phần trăm hoàn thành |
| start_time | datetime | Thời gian bắt đầu |
| submit_time | datetime | Thời gian nộp |
| feedback | text | Phản hồi |

### 13. Learning Logs (Nhật ký học tập)
Bảng `learning_logs` theo dõi quá trình học tập tự học.

| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID log |
| user_id | bigint | ID người dùng |
| resource_id | bigint | ID tài nguyên |
| enrollment_id | bigint | ID đăng ký |
| start_time | datetime | Thời gian bắt đầu |
| last_access_time | datetime | Thời gian truy cập gần nhất |
| completion_time | datetime | Thời gian hoàn thành |
| duration_seconds | integer | Thời gian học (giây) |
| progress_percentage | decimal | Phần trăm hoàn thành |
| is_completed | boolean | Đã hoàn thành |
| times_accessed | integer | Số lần truy cập |
| interaction_data | json | Dữ liệu tương tác |
| notes | text | Ghi chú |

### 14. Nhóm kiểm tra và đánh giá

#### 14.1. `lesson_tests` - Bài kiểm tra
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID bài kiểm tra |
| lessonId | bigint | ID bài học |
| title | string | Tiêu đề |
| description | text | Mô tả |
| duration | integer | Thời gian làm bài (phút) |
| passing_score | integer | Điểm đạt |
| max_attempts | integer | Số lần thử tối đa |
| isRequired | boolean | Bắt buộc hoàn thành |
| orderNumber | integer | Thứ tự trong bài học |

#### 14.2. `question_lesson_tests` - Câu hỏi bài kiểm tra
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID câu hỏi |
| testId | bigint | ID bài kiểm tra |
| content | text | Nội dung câu hỏi |
| type | string | Loại câu hỏi |
| points | integer | Điểm |
| orderNumber | integer | Thứ tự câu hỏi |

#### 14.3. `answer_lesson_tests` - Câu trả lời bài kiểm tra
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID câu trả lời |
| questionId | bigint | ID câu hỏi |
| content | text | Nội dung câu trả lời |
| isCorrect | boolean | Là đáp án đúng |
| explanation | text | Giải thích |
| orderNumber | integer | Thứ tự câu trả lời |

#### 14.4. `final_exams` - Bài thi cuối khóa
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID bài thi |
| courseId | bigint | ID khóa học |
| title | string | Tiêu đề |
| description | text | Mô tả |
| duration | integer | Thời gian làm bài (phút) |
| passing_score | integer | Điểm đạt |
| max_attempts | integer | Số lần thử tối đa |
| is_required_for_certificate | boolean | Yêu cầu chứng chỉ |

### 15. Nhóm thanh toán và giao dịch

#### 15.1. `order_statuses` - Trạng thái đơn hàng
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID trạng thái |
| status | string | Tên trạng thái |

#### 15.2. `orders` - Đơn hàng
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID đơn hàng |
| userId | bigint | ID người dùng |
| courseId | bigint | ID khóa học |
| orderStatusId | bigint | ID trạng thái đơn hàng |
| transactionId | string | Mã giao dịch |
| paymentAmount | integer | Số tiền thanh toán |
| price | integer | Giá gốc |
| salePercentage | integer | Phần trăm giảm giá |
| voucherCode | string | Mã giảm giá |
| paymentMethod | string | Phương thức thanh toán |
| paymentDate | datetime | Thời gian thanh toán |
| note | text | Ghi chú |

#### 15.3. `vouchers` - Mã giảm giá
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID voucher |
| code | string | Mã voucher |
| description | text | Mô tả |
| discount_type | string | Loại giảm giá (% hoặc số tiền cố định) |
| discount_value | decimal | Giá trị giảm giá |
| min_order_value | decimal | Giá trị đơn hàng tối thiểu |
| max_uses | integer | Số lần sử dụng tối đa |
| used_count | integer | Số lần đã sử dụng |
| start_date | datetime | Ngày bắt đầu |
| end_date | datetime | Ngày kết thúc |
| is_active | boolean | Trạng thái hoạt động |

#### 15.4. `certificates` - Chứng chỉ
| Trường | Kiểu dữ liệu | Mô tả |
|--------|--------------|--------|
| id | bigint | ID chứng chỉ |
| userId | bigint | ID người dùng |
| courseId | bigint | ID khóa học |
| certificateNumber | string | Số chứng chỉ |
| issueDate | date | Ngày cấp |
| expiryDate | date | Ngày hết hạn |
| certificateUrl | string | URL chứng chỉ |
| certificateData | json | Dữ liệu chứng chỉ |
| status | string | Trạng thái |

## Mối quan hệ giữa các bảng

### 1. Quan hệ chính

1. User (Người dùng)
   - Có một Student (Học viên)
   - Có thể là một Employee (Nhân viên)
   - Có nhiều Enrollments (Đăng ký)
   - Có nhiều Orders (Đơn hàng)
   - Có nhiều RecordingViews (Lượt xem)
   - Có nhiều LearningLogs (Nhật ký học tập)
   - Có nhiều OnlineAttendanceDetails (Chi tiết điểm danh)

2. Course (Khóa học)
   - Thuộc về một Category (Danh mục)
   - Có nhiều Classes (Lớp học)
   - Có nhiều Lessons (Bài học)
   - Có nhiều Resources (Tài nguyên) thông qua polymorphic
   - Có nhiều Enrollments (Đăng ký)
   - Có nhiều OnlineRooms (Phòng học) thông qua polymorphic
   - Có nhiều FinalExams (Bài thi cuối khóa)

3. Class (Lớp học)
   - Thuộc về một Course (Khóa học)
   - Có một Teacher (Giảng viên) thông qua User
   - Có nhiều Students (Học viên) thông qua class_student
   - Có nhiều ClassSchedules (Lịch học)
   - Có nhiều ClassSessions (Buổi học)
   - Có nhiều OnlineRooms (Phòng học) thông qua polymorphic

4. Lesson (Bài học)
   - Thuộc về một Course (Khóa học)
   - Có nhiều LessonVideos (Video bài học)
   - Có nhiều LessonTests (Bài kiểm tra)
   - Có nhiều Resources (Tài nguyên) thông qua polymorphic
   - Có nhiều LearningLogs (Nhật ký học tập) thông qua resources

### 2. Quan hệ hệ thống học trực tuyến

1. OnlineRoom (Phòng học trực tuyến)
   - Có thể thuộc về Course hoặc Class hoặc ClassSession thông qua polymorphic (roomable)
   - Có nhiều OnlineSessionRecordings (Bản ghi)
   - Có nhiều OnlineAttendanceDetails (Chi tiết điểm danh)

2. OnlineSessionRecording (Bản ghi buổi học)
   - Thuộc về một OnlineRoom (Phòng học)
   - Có nhiều RecordingViews (Lượt xem)
   - Liên kết với original_video_record_id để chuyển đổi từ bảng cũ

3. ClassSession (Buổi học)
   - Thuộc về một Class (Lớp học)
   - Thuộc về một ClassSchedule (Lịch học)
   - Có một OnlineRoom (nếu là buổi học trực tuyến)
   - Có nhiều Attendances (Điểm danh)
   - Có nhiều SessionActivities (Hoạt động)
   - Có nhiều SessionInteractions (Tương tác)

### 3. Quan hệ theo dõi học tập

1. Resource (Tài nguyên)
   - Thuộc về một đối tượng (Course, Lesson, ClassSession) thông qua polymorphic
   - Có nhiều LearningLogs (Nhật ký học tập)
   - Liên kết với original_lesson_video_id để chuyển đổi từ bảng cũ

2. Enrollment (Đăng ký)
   - Thuộc về một User (Người dùng)
   - Thuộc về một Course (Khóa học)
   - Có thể thuộc về một Class (Lớp học)
   - Có nhiều LearningLogs (Nhật ký học tập)

3. LearningLog (Nhật ký học tập)
   - Thuộc về một User (Người dùng)
   - Thuộc về một Resource (Tài nguyên)
   - Thuộc về một Enrollment (Đăng ký)

## Các tính năng chính

### 1. Quản lý khóa học
- **Đa dạng loại khóa học**: Hỗ trợ khóa học tự học, khóa học có giảng viên và mô hình kết hợp
- **Tài nguyên phong phú**: Quản lý video, tài liệu, bài tập, bài kiểm tra
- **Quản lý tiến độ**: Theo dõi chi tiết quá trình học tập của học viên
- **Chứng chỉ số**: Tự động cấp và quản lý chứng chỉ khi hoàn thành khóa học

### 2. Quản lý lớp học
- **Lịch học linh hoạt**: Hỗ trợ lịch học cố định và lịch học tự do
- **Mô hình kết hợp**: Kết hợp học trực tuyến và học trực tiếp
- **Điểm danh tự động**: Hệ thống tự động ghi nhận thời gian tham gia học trực tuyến
- **Tương tác trong lớp**: Theo dõi các câu hỏi, phản hồi, tương tác trong lớp học

### 3. Học trực tuyến
- **Đa nền tảng**: Tích hợp với Zoom, Google Meet, Microsoft Teams
- **Quản lý phòng học**: Tạo và quản lý các phòng học trực tuyến
- **Ghi lại buổi học**: Tự động lưu trữ và quản lý bản ghi buổi học
- **Phân tích dữ liệu**: Thống kê tỷ lệ tham gia, thời gian xem, mức độ tương tác

### 4. Thanh toán và tài chính
- **Đa dạng phương thức thanh toán**: Hỗ trợ nhiều phương thức thanh toán khác nhau
- **Mã giảm giá**: Quản lý mã giảm giá theo nhiều loại (phần trăm, số tiền cố định)
- **Quản lý đơn hàng**: Theo dõi trạng thái đơn hàng từ tạo đến hoàn thành
- **Báo cáo doanh thu**: Thống kê doanh thu theo khóa học, thời gian, phương thức thanh toán

## Lưu ý về bảo mật

### 1. Bảo vệ thông tin cá nhân
- Mã hóa mật khẩu và thông tin nhạy cảm
- Kiểm soát quyền truy cập theo vai trò người dùng
- Bảo vệ thông tin học viên, đặc biệt là học viên chưa thành niên

### 2. Bảo mật nội dung
- Hạn chế quyền truy cập tài nguyên theo loại đăng ký
- Bảo vệ bản ghi buổi học và video bài giảng
- Ngăn chặn tải xuống và chia sẻ trái phép

### 3. Theo dõi hoạt động
- Ghi nhận địa chỉ IP, thiết bị, trình duyệt khi truy cập
- Lưu lịch sử đăng nhập và hoạt động của người dùng
- Phát hiện và ngăn chặn các hành vi bất thường

### 4. Sao lưu và khôi phục
- Sao lưu cơ sở dữ liệu định kỳ
- Khả năng khôi phục dữ liệu khi có sự cố
- Lưu trữ dữ liệu theo quy định pháp luật 