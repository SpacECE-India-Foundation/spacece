CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `balance` double(18,2) NOT NULL DEFAULT '0.00',
  `branch_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `advance_salary`
--

CREATE TABLE `advance_salary` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  `deduct_month` varchar(20) DEFAULT NULL,
  `year` varchar(20) NOT NULL,
  `reason` text CHARACTER SET utf32 COLLATE utf32_unicode_ci,
  `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid_date` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=pending,2=paid,3=rejected',
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `issued_by` varchar(200) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `branch_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `attachments`
--

CREATE TABLE `attachments` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `remarks` text NOT NULL,
  `type_id` int(11) NOT NULL,
  `uploader_id` varchar(20) NOT NULL,
  `class_id` varchar(20) DEFAULT 'unfiltered',
  `file_name` varchar(255) NOT NULL,
  `enc_name` varchar(255) NOT NULL,
  `subject_id` varchar(200) DEFAULT 'unfiltered',
  `session_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `attachments_type`
--

CREATE TABLE `attachments_type` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `award`
--

CREATE TABLE `award` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `gift_item` varchar(255) NOT NULL,
  `award_amount` decimal(18,2) NOT NULL,
  `award_reason` text NOT NULL,
  `given_date` date NOT NULL,
  `session_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  `isbn_no` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `edition` varchar(255) NOT NULL,
  `purchase_date` date NOT NULL,
  `description` text NOT NULL,
  `price` decimal(18,2) NOT NULL,
  `total_stock` varchar(20) NOT NULL,
  `issued_copies` varchar(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `book_category`
--

CREATE TABLE `book_category` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `book_issues`
--

CREATE TABLE `book_issues` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `date_of_issue` date DEFAULT NULL,
  `date_of_expiry` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `fine_amount` decimal(18,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = pending, 1 = accepted, 2 = rejected, 3 = returned',
  `issued_by` varchar(255) DEFAULT NULL,
  `return_by` int(11) DEFAULT NULL,
  `session_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `school_name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobileno` varchar(100) NOT NULL,
  `currency` varchar(100) NOT NULL,
  `symbol` varchar(25) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bulk_msg_category`
--

CREATE TABLE `bulk_msg_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT 'sms=1, email=2',
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bulk_sms_email`
--

CREATE TABLE `bulk_sms_email` (
  `id` int(11) NOT NULL,
  `campaign_name` varchar(255) DEFAULT NULL,
  `sms_gateway` varchar(55) DEFAULT '0',
  `message` text,
  `email_subject` varchar(255) DEFAULT NULL,
  `message_type` tinyint(3) DEFAULT '0' COMMENT 'sms=1, email=2',
  `recipient_type` tinyint(3) NOT NULL COMMENT 'group=1, individual=2, class=3',
  `recipients_details` longtext,
  `additional` longtext,
  `schedule_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `posting_status` tinyint(3) NOT NULL COMMENT 'schedule=1,competed=2',
  `total_thread` int(11) NOT NULL,
  `successfully_sent` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_numeric` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `custom_field`
--

CREATE TABLE `custom_field` (
  `id` int(11) NOT NULL,
  `form_to` varchar(50) DEFAULT NULL,
  `field_label` varchar(100) NOT NULL,
  `default_value` text,
  `field_type` enum('text','textarea','dropdown','date','checkbox','number','url','email') NOT NULL,
  `required` varchar(5) NOT NULL DEFAULT 'false',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `show_on_table` varchar(5) DEFAULT NULL,
  `field_order` int(11) NOT NULL,
  `bs_column` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `custom_fields_values`
--

CREATE TABLE `custom_fields_values` (
  `id` int(11) NOT NULL,
  `relid` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `email_config`
--

CREATE TABLE `email_config` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `protocol` varchar(255) NOT NULL,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_user` varchar(255) DEFAULT NULL,
  `smtp_pass` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(100) DEFAULT NULL,
  `smtp_encryption` varchar(10) DEFAULT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tags` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `tags`) VALUES
(1, 'account_registered', '{institute_name}, {name}, {login_email}, {password}, {user_role}, {login_url}'),
(2, 'forgot_password', '{institute_name}, {username}, {email}, {reset_url}'),
(3, 'change_password', '{institute_name}, {username}, {email}, {password}'),
(4, 'new_message_received', '{institute_name}, {recipient}, {message}, {message_url}'),
(5, 'payslip_generated', '{institute_name}, {username}, {month_year}, {payslip_url}'),
(6, 'award', '{institute_name}, {winner_name}, {award_name}, {gift_item}, {award_reason}, {given_date}'),
(7, 'leave_approve', '{institute_name}, {applicant_name}, {start_date}, {end_date}, {comments}'),
(8, 'leave_reject', '{institute_name}, {applicant_name}, {start_date}, {end_date}, {comments}'),
(9, 'advance_salary_approve', '{institute_name}, {applicant_name}, {deduct_motnh}, {amount}, {comments}'),
(10, 'advance_salary_reject', '{institute_name}, {applicant_name}, {deduct_motnh}, {amount}, {comments}');

-- --------------------------------------------------------

--
-- Структура таблицы `email_templates_details`
--

CREATE TABLE `email_templates_details` (
  `id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `template_body` text NOT NULL,
  `notified` tinyint(1) NOT NULL DEFAULT '1',
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `enroll`
--

CREATE TABLE `enroll` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `roll` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `branch_id` tinyint(3) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `type` text NOT NULL,
  `audition` longtext NOT NULL,
  `selected_list` longtext NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `event_types`
--

CREATE TABLE `event_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `term_id` int(11) DEFAULT NULL,
  `type_id` tinyint(4) NOT NULL COMMENT '1=mark,2=gpa,3=both',
  `session_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `remark` text NOT NULL,
  `mark_distribution` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `exam_attendance`
--

CREATE TABLE `exam_attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `status` varchar(4) DEFAULT NULL COMMENT 'P=Present, A=Absent, L=Late',
  `remark` varchar(255) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `exam_hall`
--

CREATE TABLE `exam_hall` (
  `id` int(11) NOT NULL,
  `hall_no` longtext NOT NULL,
  `seats` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `exam_mark_distribution`
--

CREATE TABLE `exam_mark_distribution` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `exam_term`
--

CREATE TABLE `exam_term` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `fees_reminder`
--

CREATE TABLE `fees_reminder` (
  `id` int(11) NOT NULL,
  `frequency` varchar(255) NOT NULL,
  `days` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `student` tinyint(3) NOT NULL,
  `guardian` tinyint(3) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `fees_type`
--

CREATE TABLE `fees_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fee_code` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `branch_id` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `fee_allocation`
--

CREATE TABLE `fee_allocation` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `fee_fine`
--

CREATE TABLE `fee_fine` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `fine_value` varchar(20) NOT NULL,
  `fine_type` varchar(20) NOT NULL,
  `fee_frequency` varchar(20) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `fee_groups`
--

CREATE TABLE `fee_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `session_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `fee_groups_details`
--

CREATE TABLE `fee_groups_details` (
  `id` int(11) NOT NULL,
  `fee_groups_id` int(11) NOT NULL,
  `fee_type_id` int(11) NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  `due_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `fee_payment_history`
--

CREATE TABLE `fee_payment_history` (
  `id` int(11) NOT NULL,
  `allocation_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `collect_by` varchar(20) DEFAULT NULL,
  `amount` decimal(18,2) NOT NULL,
  `discount` decimal(18,2) NOT NULL,
  `fine` decimal(18,2) NOT NULL,
  `pay_via` varchar(20) NOT NULL,
  `remarks` longtext NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `global_settings`
--

CREATE TABLE `global_settings` (
  `id` int(11) NOT NULL,
  `institute_name` varchar(255) NOT NULL,
  `institution_code` varchar(255) NOT NULL,
  `reg_prefix` varchar(255) NOT NULL,
  `institute_email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `mobileno` varchar(100) NOT NULL,
  `currency` varchar(100) NOT NULL,
  `currency_symbol` varchar(100) NOT NULL,
  `sms_service_provider` varchar(100) NOT NULL,
  `session_id` int(11) NOT NULL,
  `translation` varchar(100) NOT NULL,
  `footer_text` varchar(255) NOT NULL,
  `animations` varchar(100) NOT NULL,
  `timezone` varchar(100) NOT NULL,
  `date_format` varchar(100) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `facebook_url` varchar(255) NOT NULL,
  `twitter_url` varchar(255) NOT NULL,
  `linkedin_url` varchar(255) NOT NULL,
  `youtube_url` varchar(255) NOT NULL,
  `cron_secret_key` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `global_settings`
--

INSERT INTO `global_settings` (`id`, `institute_name`, `institution_code`, `reg_prefix`, `institute_email`, `address`, `mobileno`, `currency`, `currency_symbol`, `sms_service_provider`, `session_id`, `translation`, `footer_text`, `animations`, `timezone`, `date_format`, `facebook_url`, `twitter_url`, `linkedin_url`, `youtube_url`, `cron_secret_key`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'RSM-', 'on', 'ramom@example.com', '', '', 'USD', '₹', 'disabled', 3, 'english', '© 2020 Ramom School Management - Developed by RamomCoder', 'fadeInUp', 'Pacific/Midway', 'd.M.Y', 'https://www.facebook.com/username', 'https://www.twitter.com/username', 'https://www.linkedin.com/username', 'https://www.youtube.com/username', '340fe292903d1bdc2eb79298a71ebda6', '2018-10-22 15:07:49', '2020-05-31 13:06:26');

-- --------------------------------------------------------

--
-- Структура таблицы `grade`
--

CREATE TABLE `grade` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `grade_point` varchar(255) NOT NULL,
  `lower_mark` int(11) NOT NULL,
  `upper_mark` int(11) NOT NULL,
  `remark` text NOT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `hall_allocation`
--

CREATE TABLE `hall_allocation` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `hall_no` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `date_of_homework` date NOT NULL,
  `date_of_submission` date NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `sms_notification` tinyint(2) NOT NULL,
  `schedule_date` date DEFAULT NULL,
  `document` varchar(255) NOT NULL,
  `evaluation_date` date DEFAULT NULL,
  `evaluated_by` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `homework_evaluation`
--

CREATE TABLE `homework_evaluation` (
  `id` int(11) NOT NULL,
  `homework_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `remark` text NOT NULL,
  `rank` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `hostel`
--

CREATE TABLE `hostel` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `category_id` int(11) NOT NULL,
  `address` longtext NOT NULL,
  `watchman` longtext NOT NULL,
  `remarks` longtext,
  `branch_id` int(11) DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `hostel_category`
--

CREATE TABLE `hostel_category` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `description` longtext,
  `branch_id` int(11) DEFAULT NULL,
  `type` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `hostel_room`
--

CREATE TABLE `hostel_room` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `hostel_id` int(11) NOT NULL,
  `no_beds` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `bed_fee` decimal(18,2) NOT NULL,
  `remarks` longtext NOT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `word` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `english` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bengali` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `arabic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `french` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hindi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `indonesian` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `italian` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `japanese` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `korean` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dutch` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `portuguese` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thai` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `turkish` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `urdu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chinese` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `languages`
--

INSERT INTO `languages` (`id`, `word`, `english`, `bengali`, `arabic`, `french`, `hindi`, `indonesian`, `italian`, `japanese`, `korean`, `dutch`, `portuguese`, `thai`, `turkish`, `urdu`, `chinese`) VALUES
(1, 'language', 'Language', 'ভাষা', 'لغة', 'La langue', 'भाषा', 'Bahasa', 'Lingua', '言語', '언어', 'Taal', 'Língua', 'ภาษา', 'Dil', 'زبان', '语言'),
(2, 'attendance_overview', 'Attendance Overview', 'উপস্থিতি পরিদর্শন', 'نظرة عامة على الحضور', 'Aperçu de la fréquentation', 'उपस्थिति अवलोकन', 'Ikhtisar Kehadiran', 'Panoramica delle presenze', '出席の概要', '출석 개요', 'Aanwezigheid Overzicht', 'Visão geral de participação', 'ภาพรวมการเข้าร่วม', 'Seyirci Genel Bakış', 'حاضری جائزہ', '出勤概览'),
(3, 'annual_fee_summary', 'Annual Fee Summary', 'বার্ষিক ফি সংক্ষিপ্ত বিবরণ', 'ملخص الرسوم السنوية', 'Résumé des frais annuels', 'वार्षिक शुल्क सारांश', 'Ringkasan Biaya Tahunan', 'Riepilogo della tariffa annuale', '年会費サマリー', '연회비 요약', 'Annual Fee Summary', 'Resumo da taxa anual', 'สรุปค่าธรรมเนียมรายปี', 'Yıllık Ücret Özeti', 'سالانہ فیس خلاصہ', '年费摘要'),
(4, 'my_annual_attendance_overview', 'My Annual Attendance Overview', 'আমার বার্ষিক উপস্থিতি পরিদর্শন', 'حضري السنوي نظرة عامة', 'Mon assiduité annuelle', 'मेरी वार्षिक उपस्थिति अवलोकन', 'Ikhtisar Kehadiran Tahunan Saya', 'La mia panoramica sulla partecipazione annuale', '私の年次出席者の概要', '내 연간 출석 개요', 'Mijn jaarlijkse aanwezigheidsoverzicht', 'Minha visão geral de comparecimento anual', 'ภาพรวมการเข้าร่วมประชุมประจำปีของฉัน', 'Yıllık Katılıma Genel Bakış', 'میرا سالانہ حاضری جائزہ', '我的年度出勤情况概述'),
(5, 'schedule', 'Schedule', 'সময়সূচী', 'جداول', 'des horaires', 'कार्यक्रम', 'jadwal', 'orari', 'スケジュール', '일정', 'schema', 'horários', 'ตารางเวลา', 'programları', 'شیڈولز', '时间表'),
(6, 'student_admission', 'Student Admission', 'ছাত্র ভর্তি', 'قبول الطلاب', 'Admission des étudiants', 'छात्र प्रवेश', 'Penerimaan Mahasiswa', 'Ammissione degli studenti', '学生の入場', '학생 입장', 'Studenten toelating', 'Admissão de estudantes', 'การรับนักศึกษา', 'Öğrenci Kabulü', 'طالب علم داخلہ', '学生入学'),
(7, 'returned', 'Returned', 'ফেরৎ', 'عاد', 'Revenu', 'लौटा हुआ', 'Kembali', 'tornati', '戻ってきた', '반품 됨', 'teruggekeerd', 'Devolvida', 'กลับ', 'İade', 'واپسی', '回'),
(8, 'user_name', 'User Name', 'ব্যবহারকারীর নাম', 'اسم المستخدم', 'Nom d\'utilisateur', 'उपयोगकर्ता नाम', 'Nama pengguna', 'Nome utente', 'ユーザー名', '사용자 이름', 'Gebruikersnaam', 'Nome de usuário', 'ชื่อผู้ใช้', 'Kullanıcı adı', 'صارف کا نام', '用户名'),
(9, 'rejected', 'Rejected', 'প্রত্যাখ্যাত', 'مرفوض', 'Rejeté', 'अस्वीकृत', 'Ditolak', 'Respinto', '拒否された', '거부 됨', 'Verworpen', 'Rejeitado', 'ปฏิเสธ', 'Reddedilen', 'مسترد', '拒绝'),
(10, 'route_name', 'Route Name', 'রুট নাম', 'اسم المسار', 'Nom de l\'itinéraire', 'रूट नाम', 'Nama rute', 'Nome della rotta', 'ルート名', '경로 이름', 'Route Name', 'Nome da rota', 'ชื่อเส้นทาง', 'Rota Adı', 'روٹ کا نام', '路线名称'),
(11, 'route_fare', 'Route Fare', 'রুট ভাড়া', 'الطريق الأجرة', 'Tarif d\'itinéraire', 'रूट किराया', 'Tarif rute', 'Route Fare', 'ルート運賃', '노선 요금', 'Route Tarief', 'Tarifa da rota', 'ค่าโดยสารเส้นทาง', 'Yol Ücreti', 'راستے کی قسم', '路线票价'),
(12, 'edit_route', 'Edit Route', 'সম্পাদন করা রুট', 'تحرير المسار', 'Modifier la route', 'मार्ग संपादित करें', 'Edit rute', 'Modifica la rotta', '経路を編集する', '경로 편집', 'Route bewerken', 'Editar rota', 'แก้ไขเส้นทาง', 'Rotayı düzenle', 'راستے میں ترمیم کریں', '编辑路线'),
(13, 'this_value_is_required', 'This value is required.', 'এই মান প্রয়োজন', 'هذه القيمة مطلوبة', 'Cette valeur est requise', 'यह मान आवश्यक है', 'Nilai ini diperlukan', 'Questo valore è richiesto', 'この値は必須です', '이 값은 필수 항목입니다.', 'Deze waarde is vereist', 'Este valor é obrigatório', 'จำเป็นต้องใช้ค่านี้', 'Bu değer gerekli', 'یہ قیمت کی ضرورت ہے', '该值是必需的'),
(14, 'vehicle_no', 'Vehicle No', 'যানবাহন নং', 'السيارة لا', 'Numéro de véhicule', 'वाहन नंबर', 'Kendaraan No', 'N', '車両番号', '차량 번호', 'Voertuignummer', 'Veículo não', 'หมายเลขยานพาหนะ', 'Araç Hayır', 'گاڑی نمبر', '车号'),
(15, 'insurance_renewal_date', 'Insurance Renewal Date', 'বীমা নবায়ন তারিখ', 'تاريخ تجديد التأمين', 'Date de renouvellement de l&#39;assurance', 'बीमा नवीकरण तिथि', 'Tanggal perpanjangan asuransi', 'Data di rinnovo dell\'assicurazione', '保険更新日', '보험 갱신일', 'Verzekering Vernieuwingsdatum', 'Data de renovação do seguro', 'วันที่ต่ออายุการประกัน', 'Sigorta Yenileme Tarihi', 'انشورنس کی بحالی کی تاریخ', '保险续期'),
(16, 'driver_name', 'Driver Name', 'ড্রাইভারের নাম', 'اسم السائق', 'Nom du conducteur', 'चालक का नाम', 'Nama Driver', 'Nome del driver', 'ドライバ名', '드라이버 이름', 'Naam van de bestuurder', 'Nome do motorista', 'ชื่อไดร์เวอร์', 'Sürücü Adı', 'ڈرائیور کا نام', '驱动程序名称'),
(17, 'driver_license', 'Driver License', 'চালকের অনুমোদন', 'رخصة قيادة', 'Permis de conduire', 'चालक लाइसेंस', 'SIM', 'Patente di guida', '運転免許証', '운전 면허증', 'Rijbewijs', 'Carteira de motorista', 'ใบอนุญาตขับรถ', 'Ehliyet', 'ڈرائیور لائسنس', '驾照'),
(18, 'select_route', 'Select Route', 'রুট নির্বাচন করুন', 'حدد الطريق', 'Sélectionnez l\'itinéraire', 'मार्ग चुनें', 'Pilih Rute', 'Seleziona Route', 'ルートを選択', '경로 선택', 'Selecteer Route', 'Selecione a rota', 'เลือกเส้นทาง', 'Rotayı seçin', 'راستہ منتخب کریں', '选择路线'),
(19, 'edit_vehicle', 'Edit Vehicle', 'যানবাহন সম্পাদনা করুন', 'تحرير السيارة', 'Modifier le véhicule', 'वाहन संपादित करें', 'Edit Kendaraan', 'Modifica il veicolo', '車両の編集', '차량 편집', 'Bewerk voertuig', 'Editar veículo', 'แก้ไขยานพาหนะ', 'Aracı Düzenle', 'گاڑیاں ترمیم کریں', '编辑车辆'),
(20, 'add_students', 'Add Students', 'ছাত্রদের যোগ করুন', ' إضافة الطلاب', 'Ajouter des étudiants', 'छात्र जोड़ें', 'Tambahkan Siswa', 'Aggiungere gli studenti', '学生を追加する', '학생 추가', 'Voeg studenten toe', 'Adicionar alunos', 'เพิ่มนักเรียน', 'Öğrenci ekle', 'طالب علموں کو شامل کریں', '添加学生'),
(21, 'vehicle_number', 'Vehicle Number', 'যানবাহন সংখ্যা', 'عدد المركبات', 'Numéro de véhicule', 'वाहन संख्या', 'Nomor kendaraan', 'Numero di veicolo', '車両番号', '차량 번호', 'Voertuignummer', 'Número do veículo', 'หมายเลขยานพาหนะ', 'Araç Numarası', 'گاڑی نمبر', '车号'),
(22, 'select_route_first', 'Select Route First', 'রুট প্রথম নির্বাচন করুন', 'حدد الطريق أولا', 'Sélectionnez l\'itinéraire d\'abord', 'मार्ग पहले चुनें', 'Pilih Rute Pertama', 'Seleziona Route First', '最初にルートを選択', '경로 우선 선택', 'Selecteer Route First', 'Selecione a rota primeiro', 'เลือกเส้นทางแรก', 'Önce Güzergahı seçin', 'راستہ منتخب کریں', '选择路由优先'),
(23, 'transport_fee', 'Transport Fee', 'পরিবহন ফি', 'مصاريف الشحن', 'Frais de transport', 'परिवहन शुल्क', 'Biaya transportasi', 'Tassa di trasporto', '運賃', '운송비', 'Transportkosten', 'Tarifa de transporte', 'ค่าธรรมเนียมการขนส่ง', 'Taşıma ücreti', 'ٹرانسپورٹ فیس', '运费'),
(24, 'control', 'Control', 'নিয়ন্ত্রণ', 'مراقبة', 'contrôle', 'नियंत्रण', 'kontrol', 'controllo', 'コントロール', '제어', 'controle', 'ao controle', 'ควบคุม', 'kontrol', 'قابو', '控制'),
(25, 'set_students', 'Set Students', 'ছাত্রদের সেট করুন', 'تعيين الطلاب', 'Mettre les élèves', 'छात्रों को सेट करें', 'Set siswa', 'Impostare gli studenti', '生徒を設定する', '학생 배치', 'Studenten stellen', 'Definir estudantes', 'ตั้งนักเรียน', 'Öğrencileri ayarla', 'طلبا قائم کریں', '设置学生'),
(26, 'hostel_list', 'Hostel List', 'হোস্টেল তালিকা', 'قائمة نزل', 'Liste d\'auberges', 'छात्रावास सूची', 'Daftar hostel', 'Lista degli ostelli', 'ホステルリスト', '호스텔리스트', 'Hostel lijst', 'Lista de albergue', 'รายการที่พัก', 'Hostel listesi', 'ہاسٹل فہرست', '旅馆列表'),
(27, 'watchman_name', 'Watchman Name', 'ওয়াচম্যান নাম', 'اسم الحارس', 'Nom du gardien', 'वॉचमेन का नाम', 'Nama Watchman', 'Nome guardiano', 'ウォッチマン名', '경비원 이름', 'Watchman Naam', 'Nome do Vigilante', 'ชื่อผู้ดูแล', 'Bekçi adını', 'واچ مین کا نام', '守望者姓名'),
(28, 'hostel_address', 'Hostel Address', 'হোস্টেল ঠিকানা', 'عنوان الفندق', 'Adresse de l\'auberge', 'छात्रावास का पता', 'Alamat hostel', 'Indirizzo dell\'ostello', 'ホステルアドレス', '호스텔 주소', 'Hostel adres', 'Endereço do albergue', 'ที่อยู่หอพัก', 'Hostel adresi', 'ہاسٹل ایڈریس', '宿舍地址'),
(29, 'edit_hostel', 'Edit Hostel', 'হোস্টেল সম্পাদনা করুন', 'تحرير نزل', 'Modifier hostel', 'होस्टल संपादित करें', 'edit hostel', 'Modifica ostello', 'ホステルを編集', '호스텔을 편집하다', 'Wijzig hostel', 'Editar albergue', 'แก้ไขหอพัก', 'Hostel düzenlemek', 'ہاسٹلز میں ترمیم کریں', '编辑宿舍'),
(30, 'room_name', 'Room Name', 'রুমের নাম', 'اسم الغرفة', 'Nom de la salle', 'कमरे का नाम', 'Nama ruangan', 'Nome della stanza', 'ルーム名', '방 이름', 'Kamer naam', 'Nome da sala', 'ชื่อห้อง', 'Oda ismi', 'کمرہ کا نام', '房间名称'),
(31, 'no_of_beds', 'No Of Beds', 'শয্যা সংখ্যা', 'عدد الأسرة', 'Nombre de lits', 'बेड की संख्या', 'Jumlah tempat tidur', 'Numero di letti', 'ベッド数', '침대 수', 'Aantal bedden', 'Número de leitos', 'จำนวนเตียง', 'Yatak sayısı', 'بستروں کی تعداد', '床数'),
(32, 'select_hostel_first', 'Select Hostel First', 'হোস্টেল প্রথম নির্বাচন করুন', 'حدد نزل أولا', 'Sélectionnez l\'auberge en premier', 'हॉस्टल का पहला चयन करें', 'Pilih hostel dulu', 'Selezionare l\'ostello prima', '最初にホステルを選択', '호스텔을 먼저 선택하십시오.', 'Selecteer eerst hostel', 'Selecione albergue primeiro', 'เลือกโฮสเทลก่อน', 'Önce pansiyon seç', 'سب سے پہلے ہاسٹل منتخب کریں', '先选择宿舍'),
(33, 'remaining', 'Remaining', 'অবশিষ্ট', 'متبق', 'Restant', 'शेष', 'Tersisa', 'Rimanente', '残り', '남은', 'resterende', 'Restante', 'ที่เหลืออยู่', 'Kalan', 'باقی', '剩余'),
(34, 'hostel_fee', 'Hostel Fee', 'হোস্টেল ফি', 'رسوم النزل', 'Tarif de l\'auberge', 'छात्रावास शुल्क', 'Biaya hostel', 'Tariffa ostello', 'ホステル料金', '호스텔 요금', 'Hostel kosten', 'Taxa de albergue', 'ค่าหอพัก', 'Hostel ücreti', 'میزبان فیس', '宿舍费'),
(35, 'accountant_list', 'Accountant List', 'অ্যাকাউন্টেন্ট তালিকা', 'قائمة المحاسبين', 'Liste comptable', 'लेखाकार सूची', 'Daftar akuntan', 'Elenco dei contabili', '会計士リスト', '회계사 목록', 'Accountant lijst', 'Lista de contadores', 'บัญชีรายชื่อ', 'Muhasebeci listesi', 'اکاؤنٹنٹ کی فہرست', '会计清单'),
(36, 'students_fees', 'Students Fees', 'ছাত্র ফি', 'رسوم الطلاب', 'Frais d\'étudiants', 'छात्रों की फीस', 'Biaya siswa', 'Le tasse degli studenti', '学生手数料', '학생 비용', 'Studentenkosten', 'Taxas de estudantes', 'ค่าธรรมเนียมนักศึกษา', 'Öğrenci ücretleri', 'طالب علموں کی فیس', '学费'),
(37, 'fees_status', 'Fees Status', 'ফি স্থিতি', 'حالة الرسوم', 'Statut des frais', 'फीस की स्थिति', 'Status biaya', 'Status dei diritti', '手数料ステータス', '수수료 상태', 'Tarieven status', 'Status de tarifas', 'สถานะค่าธรรมเนียม', 'Ücret durumu', 'فیس کی حیثیت', '费用状况'),
(38, 'books', 'Books', 'বই', 'الكتب', 'livres', 'पुस्तकें', 'Buku', 'libri', '本', '서적', 'boeken', 'Livros', 'หนังสือ', 'kitaplar', 'کتابیں', '图书'),
(39, 'home_page', 'Home Page', 'হোম পেজ', 'الصفحة الرئيسية', 'Page d\'accueil', 'मुख पृष्ठ', 'Halaman rumah', 'Home page', 'ホームページ', '홈페이지', 'Startpagina', 'pagina inicial', 'หน้าแรก', 'Ana sayfa', 'ہوم پیج', '主页'),
(40, 'collected', 'Collected', 'সংগৃহীত', 'جمع', 'collecté', 'जुटाया हुआ', 'dikumpulkan', 'raccolto', '集めました', '모은', 'verzamelde', 'coletado', 'เก็บรวบรวม', 'toplanmış', 'جمع', '集'),
(41, 'student_mark', 'Student Mark', 'ছাত্র মার্ক', 'علامة الطالب', 'Marque étudiante', 'छात्र निशान', 'Tanda siswa', 'Marchio studente', '学生証', '학생 표', 'Studentenmerk', 'Marca estudantil', 'เครื่องหมายนักเรียน', 'Öğrenci işareti', 'طالب علم کا نشان', '学生标记'),
(42, 'select_exam_first', 'Select Exam First', 'নির্বাচন প্রথম নির্বাচন করুন', 'حدد الامتحان أولا', 'Sélectionnez l\'examen en premier', 'परीक्षा पहले चुनें', 'Pilih ujian dulu', 'Selezionare l\'esame per primo', '最初に試験を選択', '먼저 시험을 선택하십시오.', 'Selecteer eerst examen', 'Selecione o exame primeiro', 'เลือกการสอบก่อน', 'Önce sınavı seç', 'سب سے پہلے امتحان منتخب کریں', '先选择考试'),
(43, 'transport_details', 'Transport Details', 'পরিবহন বিবরণ', 'تفاصيل النقل', 'Détails de transport', 'परिवहन विवरण', 'Rincian transportasi', 'Dettagli di trasporto', '運送の詳細', '운송 세부 정보', 'Transport details', 'Detalhes do transporte', 'รายละเอียดการขนส่ง', 'Ulaşım bilgileri', 'نقل و حمل کی تفصیلات', '运输细节'),
(44, 'no_of_teacher', 'No of Teacher', 'শিক্ষকের সংখ্যা', 'لا المعلم', 'Nombre de professeurs', 'शिक्षक की संख्या', 'Tidak ada guru', 'Nemo autem magister', '先生のいいえ', '교사 수', 'Nee van leraar', 'Não professor', 'ไม่มีครู', 'Öğretmenin numarası', 'استاد کی کوئی بھی نہیں', '不是老师'),
(45, 'basic_details', 'Basic Details', 'মৌলিক বিবরণ', 'تفاصيل أساسية', 'Détails de base', 'मूल विवरण', 'Detail Dasar', 'Dettagli di base', '基本的な詳細', '기본 세부 사항', 'Basisgegevens', 'Detalhes Básicos', 'รายละเอียดพื้นฐาน', 'Temel Detaylar', 'بنیادی تفصیلات', '基本细节'),
(46, 'fee_progress', 'Fee Progress', 'ফি অগ্রগতি', 'رسوم التقدم', 'Progression des frais', 'शुल्क प्रगति', 'Kemajuan Biaya', 'Avanzamento della tassa', '料金の進捗', '요금 진행 상황', 'Progress Progress', 'Progresso de taxas', 'ความคืบหน้าค่าธรรมเนียม', 'Ücret İlerlemesi', 'فیس پیش رفت', '费用进度'),
(47, 'word', 'Word', 'শব্দ', 'كلمة', 'mot', 'शब्द', 'kata', 'parola', 'ワード', '워드', 'word', 'palavra', 'คำ', 'sözcük', 'لفظ', '字'),
(48, 'book_category', 'Book Category', 'বই বিভাগ', 'فئة الكتاب', 'Catégorie livre', 'पुस्तक श्रेणी', 'Kategori buku', 'Categoria di libri', '本カテゴリ', '도서 카테고리', 'Boek categorie', 'Categoria de livro', 'book หมวดหมู่', 'Kitap kategorisi', 'کتاب کی قسم', '书类'),
(49, 'driver_phone', 'Driver Phone', 'ড্রাইভার ফোন', 'سائق الهاتف', 'Driver Phone', 'चालक फोन', 'Driver Telepon', 'Telefono del conducente', 'ドライバーフォン', '운전자 전화 번호', 'Driver Telefoon', 'Driver Phone', 'โทรศัพท์ไดร์เวอร์', 'Sürücü Telefon', 'ڈرائیور فون', '司机电话'),
(50, 'invalid_csv_file', 'Invalid / Corrupted CSV File', 'অবৈধ / দূষিত CSV ফাইল', 'ملف كسف غير صالح / معطل', 'fichier CSV invalide / corrompu', 'अमान्य / भ्रष्ट CSV फ़ाइल', 'file CSV yang tidak benar / rusak', 'file CSV non valido / danneggiato', '無効/破損したCSVファイル', '유효하지 않은 / 손상된 CSV 파일', 'ongeldig / beschadigd CSV-bestand', 'arquivo CSV inválido / corrompido', 'ไฟล์ CSV ที่ไม่ถูกต้อง / เสียหาย', 'geçersiz / bozuk CSV dosyası', 'غلط / خراب CSV فائل', '无效/损坏的CSV文件'),
(51, 'requested_book_list', 'Requested Book List', 'অনুরোধকৃত বইয়ের তালিকা', 'طلب قائمة الكتب', 'Liste de livres demandée', 'अनुरोधित पुस्तक सूची', 'Daftar buku yang diminta', 'L\'elenco dei libri richiesti', '要求された本のリスト', '요청 된 도서 목록', 'Gevraagde boekenlijst', 'Lista de livros solicitada', 'รายการหนังสือที่ขอ', 'Talep edilen kitap listesi', 'درخواست کی کتاب کی فہرست', '要求书目录'),
(52, 'request_status', 'Request Status', 'অনুরোধ স্থিতি', 'حالة الطلب', 'Statut de demande', 'अनुरोध की स्थिति', 'Status permintaan', 'Stato di richiesta', '要求ステータス', '요청 상태', 'Status aanvragen', 'Status de solicitação', 'สถานะคำขอ', 'Istek durumu', 'درخواست کی حیثیت', '请求状态'),
(53, 'book_request', 'Book Request', 'বইয়ের অনুরোধ', 'طلب الكتاب', 'Demande de livre', 'पुस्तक अनुरोध', 'Permintaan buku', 'Richiesta di libro', '本のリクエスト', '도서 요청', 'Boekverzoek', 'Pedido de livro', 'หนังสือขอ', 'Kitap isteği', 'کتاب کی درخواست', '书籍要求'),
(54, 'logout', 'Logout', 'প্রস্থান', 'الخروج', 'Connectez - Out', 'लोग आउट', 'keluar', 'logout', 'ログアウト', '로그 아웃', 'uitloggen', 'sair', 'ออกจากระบบ', 'çıkış Yap', 'لاگ آوٹ', '登出'),
(55, 'select_payment_method', 'Select Payment Method', 'পেমেন্ট পদ্ধতি নির্বাচন করুন', 'اختار طريقة الدفع', 'Sélectionnez le mode de paiement', 'भुगतान का तरीका चुनें', 'Pilih metode pembayaran', 'scegli il metodo di pagamento', 'お支払い方法を選択', '지불 방법 선택', 'Selecteer betaalmethode', 'Selecione o método de pagamento', 'เลือกวิธีการชำระเงิน', 'ödeme türünü seçin', 'ادائیگی کا طریقہ منتخب کریں', '选择付款方式'),
(56, 'select_method', 'Select Method', 'পদ্ধতি নির্বাচন করুন', 'حدد الطريقة', 'Méthode choisie', 'विधि का चयन करें', 'Pilih metode', 'Selezionare il metodo', 'メソッドの選択', '선택 방법', 'Selecteer methode', 'Método selecionado', 'เลือกวิธี', 'Yöntemi seç', 'طریقہ منتخب کریں', '选择方法'),
(57, 'payment', 'Payment', 'প্রদান', 'دفع', 'Paiement', 'भुगतान', 'Pembayaran', 'Pagamento', '支払い', '지불', 'Betaling', 'Pagamento', 'การชำระเงิน', 'Ödeme', 'ادائیگی', '付款'),
(58, 'filter', 'Filter', 'ছাঁকনি', 'منقي', 'Filtre', 'फ़िल्टर', 'Filter', 'Filtro', 'フィルタ', '필터', 'Filter', 'Filtro', 'กรอง', 'filtre', 'فلٹر', '过滤'),
(59, 'status', 'Status', 'অবস্থা', 'الحالة', 'statut', 'स्थिति', 'Status', 'Stato', '状態', '지위', 'toestand', 'estado', 'สถานะ', 'durum', 'سٹیٹس', '状态'),
(60, 'paid', 'Paid', 'অর্থ প্রদান', 'دفع', 'Payé', 'भुगतान किया है', 'dibayar', 'Pagato', '支払われました', '유료', 'Betaald', 'Pago', 'ต้องจ่าย', 'ücretli', 'ادا کی', '付费'),
(61, 'unpaid', 'Unpaid', 'অবৈতনিক', 'غير مدفوع', 'Non payé', 'अवैतनिक', 'Tunggakan', 'non pagato', '未払い', '지불하지 않은', 'onbetaald', 'não remunerado', 'ยังไม่ได้ชำระ', 'ödenmemiş', 'بلا معاوضہ', '未付'),
(62, 'method', 'Method', 'পদ্ধতি', 'طريقة', 'la méthode', 'तरीका', 'Metode', 'metodo', '方法', '방법', 'Methode', 'Método', 'วิธี', 'Yöntem', 'طریقہ', '方法'),
(63, 'cash', 'Cash', 'নগদ', 'السيولة النقدية', 'Argent liquide', 'रोकड़', 'Kas', 'Contanti', '現金', '현금', 'geld', 'Dinheiro', 'เงินสด', 'Nakit', 'نقد', '现金'),
(64, 'check', 'Check', 'চেক', 'الاختيار', 'Vérifier', 'चेक', 'Memeriksa', 'Dai un\'occhiata', 'チェック', '검사', 'check', 'Verifica', 'ตรวจสอบ', 'Ara', 'چیک کریں', '检查'),
(65, 'card', 'Card', 'কার্ড', 'بطاقة', 'Carte', 'कार्ड', 'Kartu', 'Carta', 'カード', '카드', 'Kaart', 'Cartão', 'บัตร', 'kart', 'کارڈ', '卡'),
(66, 'payment_history', 'Payment History', 'অর্থ প্রদান ইতিহাস', 'تاريخ الدفع', 'historique de paiement', 'भुगतान इतिहास', 'Riwayat Pembayaran', 'Storico dei pagamenti', '支払歴', '지급 내역', 'Betaalgeschiedenis', 'Histórico de pagamento', 'ประวัติการชำระเงิน', 'ödeme geçmişi', 'ادائیگی کی تاریخ', '付款记录'),
(67, 'category', 'Category', 'বিভাগ', 'فئة', 'Catégorie', 'वर्ग', 'Kategori', 'Categoria', 'カテゴリー', '범주', 'Categorie', 'Categoria', 'ประเภท', 'Kategori', 'قسم', '类别'),
(68, 'book_list', 'Book List', 'পাঠ্যতালিকা', 'قائمة الكتب', 'Liste de livres', 'पुस्तक सूची', 'Daftar buku', 'Lista di libri', 'ブックリスト', '도서 목록', 'Book List', 'Lista de livros', 'รายชื่อหนังสือ', 'Kitap listesi', 'کتاب کی فہرست', '图书清单'),
(69, 'author', 'Author', 'লেখক', 'مؤلف', 'Auteur', 'लेखक', 'Penulis', 'Autore', '著者', '저자', 'Auteur', 'Autor', 'ผู้เขียน', 'Yazar', 'مصنف', '作者'),
(70, 'price', 'Price', 'মূল্য', 'السعر', 'Prix', 'मूल्य', 'Harga', 'Prezzo', '価格', '가격', 'Prijs', 'Preço', 'ราคา', 'Fiyat', 'قیمت', '价钱'),
(71, 'available', 'Available', 'সহজলভ্য', 'متاح', 'Disponible', 'उपलब्ध', 'Tersedia', 'A disposizione', '利用できます', '유효한', 'Beschikbaar', 'Disponível', 'ที่มีจำหน่าย', 'Mevcut', 'دستیاب', '可用的'),
(72, 'unavailable', 'Unavailable', 'অপ্রাপ্য', 'غير متوفره', 'Indisponible', 'अनुपलब्ध', 'tidak tersedia', 'non disponibile', '利用できません', '없는', 'Niet beschikbaar', 'Indisponível', 'ใช้งานไม่ได้', 'yok', 'دستیاب نہیں', '不可用'),
(73, 'transport_list', 'Transport List', 'পরিবহন তালিকা', 'قائمة النقل', 'Liste des transports', 'परिवहन सूची', 'Daftar transportasi', 'Lista dei trasporti', 'トランスポート一覧', '전송 목록', 'transport List', 'Lista de transportes', 'รายการขนส่ง', 'Taşıma listesi', 'ٹرانسپورٹ کی فہرست', '交通运输清单'),
(74, 'edit_transport', 'Edit Transport', 'পরিবহন সম্পাদনা', 'تحرير النقل', 'Modifier Transport', 'परिवहन संपादित करें', 'mengedit Transportasi', 'Modifica Trasporti', '編集交通', '편집 전송', 'Transport bewerken', 'Editar Transportes', 'แก้ไขขนส่ง', 'Düzenleme Ulaşım', 'ٹرانسپورٹ میں ترمیم کریں', '编辑传输'),
(75, 'hostel_name', 'Hostel Name', 'হোস্টেল নাম', 'اسم المهجع', 'Nom Dortoir', 'छात्रावास का नाम', 'Nama asrama', 'Nome dormitorio', '寮の名前', '기숙사 이름', 'slaapzaal Naam', 'Nome dormitório', 'ชื่อหอพัก', 'yatakhane Ad', 'شیناگار نام', '宿舍名称'),
(76, 'number_of_room', 'Hostel Of Room', 'রুম নম্বর', 'عدد الغرف', 'Nombre de chambres', 'कमरे की संख्या', 'Jumlah Kamar', 'Il numero di stanze', '部屋の数', '룸의 수', 'Aantal kamers', 'Número de salas', 'จำนวนห้องพัก', 'Oda Sayısı', 'کمرہ کی تعداد', '数种客房'),
(77, 'yes', 'Yes', 'হাঁ', 'نعم فعلا', 'Oui', 'हाँ', 'iya nih', 'sì', 'はい', '예', 'Ja', 'sim', 'ใช่', 'Evet', 'جی ہاں', '是'),
(78, 'no', 'No', 'না', 'لا', 'Non', 'नहीं', 'Tidak', 'No', 'いいえ', '아니', 'Nee', 'Não', 'ไม่', 'hayır', 'نہیں', '没有'),
(79, 'messages', 'Messages', 'বার্তা', 'رسائل', 'messages', 'संदेश', 'pesan', 'messaggi', 'メッセージ', '메시지', 'berichten', 'mensagens', 'ข้อความ', 'Mesajlar', 'پیغامات', '消息'),
(80, 'compose', 'Compose', 'নতুন বার্তা লিখতে', 'إرسال رسالة جديدة', 'Ecrire un nouveau message', 'नया संदेश लिखें', 'Tulis baru Pesan', 'Scrivi nuovo messaggio', '新しいメッセージを書きます', '새 메시지 쓰기', 'Schrijf New Message', 'Escrever Nova Mensagem', 'เขียนข้อความใหม่', 'Yeni Mesaj Yaz', 'نیا پیغام لکھیں', '我要留言'),
(81, 'recipient', 'Recipient', 'প্রাপক', 'مستلم', 'Bénéficiaire', 'प्राप्तकर्ता', 'Penerima', 'Destinatario', '受信者', '받는 사람', 'Ontvanger', 'beneficiário', 'ผู้รับ', 'alıcı', 'وصول کنندہ', '接受者'),
(82, 'select_a_user', 'Select A User', 'নির্বাচন একটি ব্যবহারকারী', 'تحديد مستخدم', 'Sélectionnez un utilisateur', 'चयन एक उपयोगकर्ता', 'Pilih User', 'Selezionare un utente', 'ユーザーを選択します', '사용자를 선택', 'Kies een gebruiker', 'Selecione um usuário', 'เลือกผู้ใช้', 'Bir kullanıcı seçin', 'A یوزر کریں', '选择一个用户'),
(83, 'send', 'Send', 'পাঠান', 'إرسال', 'Envoyer', 'भेजना', 'Kirim', 'Inviare', '送信', '보내다', 'sturen', 'Enviar', 'ส่ง', 'göndermek', 'حساب', '发送'),
(84, 'global_settings', 'Global Settings', 'সার্বজনীন নির্ধারণ', 'اعدادات النظام', 'Les paramètres du système', 'प्रणाली व्यवस्था', 'Pengaturan sistem', 'Impostazioni di sistema', 'システム設定', '시스템 설정', 'Systeem instellingen', 'Configurações de sistema', 'การตั้งค่าระบบ', 'Sistem ayarları', 'نظام کی ترتیبات', '系统设置'),
(85, 'currency', 'Currency', 'মুদ্রা', 'عملة', 'Devise', 'मुद्रा', 'Mata uang', 'Moneta', '通貨', '통화', 'Valuta', 'Moeda', 'เงินตรา', 'para', 'کرنسی', '货币'),
(86, 'system_email', 'System Email', 'সিস্টেম ইমেইল', 'نظام البريد الإلكتروني', 'système Email', 'प्रणाली ईमेल', 'sistem Email', 'sistema di posta elettronica', 'システムメール', 'System 전자 메일', 'System E-mail', 'sistema de E-mail', 'ระบบอีเมล', 'sistem E-posta', 'سسٹم کی ای میل', '电子邮件系统'),
(87, 'create', 'Create', 'সৃষ্টি', 'خلق', 'créer', 'सर्जन करना', 'membuat', 'creare', '作成する', '몹시 떠들어 대다', 'creëren', 'crio', 'สร้าง', 'yaratmak', 'بنانا', '创建'),
(88, 'save', 'Save', 'সংরক্ষণ করুন', 'حفظ', 'sauvegarder', 'बचाना', 'Menyimpan', 'Salvare', 'セーブ', '구하다', 'Save', 'Salvar', 'บันทึก', 'Kaydet', 'محفوظ کریں', '保存'),
(89, 'file', 'File', 'ফাইল', 'ملف', 'Fichier', 'फ़ाइल', 'Mengajukan', 'File', 'ファイル', '파일', 'file', 'Arquivo', 'ไฟล์', 'Dosya', 'فائل', '文件'),
(90, 'theme_settings', 'Theme Settings', 'থিম সেটিংস', 'إعدادات موضوع', 'Réglage des thèmes', 'विषय सेटिंग', 'Pengaturan tema', 'Impostazioni tema', 'テーマ設定', '테마 설정', 'Thema instellingen', 'Configurações de tema', 'การตั้งค่าธีม', 'Tema ayarları', 'تھیم ترتیبات', '主题设置'),
(91, 'default', 'Default', 'ডিফল্ট', 'افتراضي', 'Défaut', 'चूक', 'kegagalan', 'Predefinito', 'デフォルト', '태만', 'Standaard', 'Padrão', 'ค่าเริ่มต้น', 'Varsayılan', 'پہلے سے طے شدہ', '默认'),
(92, 'select_theme', 'Select Theme', 'থিম নির্বাচন কর', 'اختر الموضوع', 'Sélectionne un thème', 'विषय का चयन करें', 'Pilih tema', 'Seleziona il tema', 'テーマを選択', '선택 테마', 'Selecteer thema', 'Escolha um tema', 'เลือกธีม', 'seç Tema', 'تھیم منتخب کریں', '选择主题'),
(93, 'upload_logo', 'Upload Logo', 'লোগো আপলোড করুন', 'تحميل الشعار', 'Télécharger Logo', 'अपलोड लोगो', 'Upload Logo', 'Carica Logo', 'ロゴをアップロード', '업로드 로고', 'Upload Logo', 'Carregar Logo', 'อัปโหลดโลโก้', 'yükleme Logo', 'اپ لوڈ کی علامت', '上传徽标'),
(94, 'upload', 'Upload', 'আপলোড', 'تحميل', 'Télécharger', 'अपलोड', 'Upload', 'Caricare', 'アップロード', '업로드', 'Uploaden', 'Envio', 'อัปโหลด', 'yükleme', 'اپ لوڈ کریں', '上传'),
(95, 'remember', 'Remember', 'স্মরণ করা', 'تذكر', 'Rappelles toi', 'याद है', 'Ingat', 'Ricorda', '覚えている', '생각해 내다', 'Onthouden', 'Lembrar', 'จำ', 'Hatırlamak', 'یاد رکھیں', '记得'),
(96, 'not_selected', 'Not Selected', 'অনির্বাচিত', 'لم يتم اختياره', 'Non séléctionné', 'नहीं चुने गए', 'Tidak terpilih', 'Non selezionato', '選択されていません', '선택되지 않음', 'Niet geselecteerd', 'Não selecionado', 'ไม่ได้เลือก', 'Seçilmedi', 'منتخب نہیں', '未选择'),
(97, 'disabled', 'Disabled', 'অক্ষম', 'معاق', 'désactivé', 'विकलांग', 'Cacat', 'Disabilitato', '使用禁止', '장애인', 'invalide', 'Desativado', 'พิการ', 'engelli', 'معذور', '残'),
(98, 'inactive_account', 'Inactive Account', 'নিষ্ক্রিয় অ্যাকাউন্ট', 'حساب غير نشط', 'Compte inactif', 'निष्क्रिय खाता', 'Akun tidak aktif', 'Account inattivo', '非アクティブアカウント', '비활성 계정', 'Inactief account', 'Conta inativa', 'บัญชีที่ไม่ใช้งาน', 'Pasif hesap', 'غیر فعال اکاؤنٹ', '非活动帐户'),
(99, 'update_translations', 'Update Translations', 'আপডেট অনুবাদ', 'تحديث الترجمات', 'actualiser les traductions', 'अनुवाद अपडेट करें', 'update terjemahan', 'aggiornare le traduzioni', '翻訳を更新する', '번역 업데이트', 'vertalingen bijwerken', 'atualizar traduções', 'อัปเดตการแปล', 'çevirileri güncelle', 'ترجمہ اپ ڈیٹ کریں', '更新翻译'),
(100, 'language_list', 'Language List', 'নতুন ভাষাটি তালিকায় আগে', 'قائمة لغة', 'Liste des langues', 'भाषा सूची', 'Daftar bahasa', 'Elenco lingue', '言語の一覧', '언어 목록', 'taal List', 'Lista idioma', 'รายการภาษา', 'Dil listesi', 'زبان کی فہرست', '语言列表'),
(101, 'option', 'Option', 'পছন্দ', 'خيار', 'Option', 'देखिये', 'Pilihan', 'Opzione', 'オプション', '선택권', 'Keuze', 'Opção', 'ตัวเลือก', 'seçenek', 'آپشن', '选项'),
(102, 'edit_word', 'Edit Word', 'শব্দ সম্পাদনা করুন', 'تحرير الكلمة', 'modifier le mot', 'शब्द को संपादित करें', 'edit kata', 'modifica parola', '単語を編集する', '단어 편집', 'bewerk woord', 'editar palavra', 'แก้ไขคำ', 'kelimeyi düzenle', 'لفظ میں ترمیم کریں', '编辑单词'),
(103, 'update_profile', 'Update Profile', 'প্রফাইল হালনাগাদ', 'تحديث الملف', 'Mettre à jour le profil', 'प्रोफ़ाइल अपडेट करें', 'Memperbaharui profil', 'Aggiorna il profilo', 'プロフィールを更新', '프로필 업데이트', 'Profiel bijwerken', 'Atualizar perfil', 'ปรับปรุงรายละเอียดของ', 'Profili güncelle', 'اپ ڈیٹ پروفائل', '更新个人信息'),
(104, 'current_password', 'Current Password', 'বর্তমান পাসওয়ার্ড', 'كلمة السر الحالية', 'Mot de passe actuel', 'वर्तमान पासवर्ड', 'kata sandi saat ini', 'Password attuale', '現在のパスワード', '현재 비밀번호', 'huidig ​​wachtwoord', 'senha atual', 'รหัสผ่านปัจจุบัน', 'Şimdiki Şifre', 'موجودہ خفیہ لفظ', '当前密码'),
(105, 'new_password', 'New Password', 'নতুন পাসওয়ার্ড', 'كلمة السر الجديدة', 'nouveau mot de passe', 'नया पासवर्ड', 'kata sandi baru', 'nuova password', '新しいパスワード', '새 비밀번호', 'nieuw paswoord', 'Nova senha', 'รหัสผ่านใหม่', 'Yeni Şifre', 'نیا پاس ورڈ', '新密码'),
(106, 'login', 'Login', 'লগইন', 'تسجيل الدخول', 'S\'identifier', 'लॉगिन', 'Masuk', 'Accesso', 'ログイン', '로그인', 'Log in', 'Entrar', 'เข้าสู่ระบบ', 'Oturum aç', 'لاگ ان', '登录'),
(107, 'reset_password', 'Reset Password', 'পাসওয়ার্ড রিসেট করুন', 'اعادة تعيين كلمة السر', 'réinitialiser le mot de passe', 'पासवर्ड रीसेट', 'Reset password', 'Resetta la password', 'パスワードを再設定する', '암호를 재설정', 'Reset Password', 'Trocar a senha', 'รีเซ็ตรหัสผ่าน', 'Şifreyi yenile', 'پاس ورڈ ری سیٹ', '重设密码'),
(108, 'present', 'Present', 'হাজির', 'حاضر', 'Présent', 'वर्तमान', 'Menyajikan', 'Presente', '現在', '선물', 'aanwezig', 'Presente', 'นำเสนอ', 'mevcut', 'پیش', '当下'),
(109, 'absent', 'Absent', 'অনুপস্থিত', 'غائب', 'Absent', 'अनुपस्थित', 'Tidak hadir', 'Assente', 'ありません', '없는', 'Afwezig', 'Ausente', 'ไม่อยู่', 'Yok', 'غائب', '缺席'),
(110, 'update_attendance', 'Update Attendance', 'আপডেট এ্যাটেনডেন্স', 'تحديث الحضور', 'Mise à jour de présence', 'अद्यतन उपस्थिति', 'Update Kehadiran', 'Aggiornamento presenze', '出席を更新', '업데이트 출석', 'Attendance bijwerken', 'Presença atualização', 'ปรับปรุงการเข้าร่วมประชุม', 'güncelleme Seyirci', 'اپ ڈیٹ حاضری', '更新考勤'),
(111, 'undefined', 'Undefined', 'অনির্দিষ্ট', 'غير محدد', 'Indéfini', 'अपरिभाषित', 'Tidak terdefinisi', 'Non definito', '未定義', '정의되지 않은', 'onbepaald', 'Indefinido', 'ไม่ได้กำหนด', 'tanımlanmamış', 'جانچ', '未定义'),
(112, 'back', 'Back', 'পিছনে', 'الى الخلف', 'Arrière', 'वापस', 'Kembali', 'Indietro', 'バック', '뒤로', 'Terug', 'Costas', 'กลับ', 'Geri', 'واپس', '背部'),
(113, 'save_changes', 'Save Changes', 'পরিবর্তনগুলোর সংরক্ষন', 'حفظ التغيرات', 'Sauvegarder les modifications', 'परिवर्तनों को सुरक्षित करें', 'Simpan perubahan', 'Salva I Cambiamenti', '変更内容を保存', '변경 사항을 저장하다', 'Wijzigingen opslaan', 'Salvar alterações', 'บันทึกการเปลี่ยนแปลง', 'Değişiklikleri Kaydet', 'تبدیلیاں محفوظ کرو', '保存更改'),
(114, 'uploader', 'Uploader', 'আপলোডার', 'رافع', 'Uploader', 'अपलोडर', 'pengunggah', 'Uploader', 'アップローダー', '업 로더', 'Uploader', 'Uploader', 'อัพโหลด', 'Yükleyici', 'اپ لوڈر', '上传'),
(115, 'download', 'Download', 'ডাউনলোড', 'تحميل', 'Télécharger', 'डाउनलोड', 'Download', 'Scaricare', 'ダウンロード', '다운로드', 'Download', 'baixar', 'ดาวน์โหลด', 'indir', 'لوڈ', '下载'),
(116, 'remove', 'Remove', 'অপসারণ', 'إزالة', 'Retirer', 'हटाना', 'Menghapus', 'Cancella', '削除します', '없애다', 'Verwijderen', 'Remover', 'เอาออก', 'Kaldır', 'دور', '去掉'),
(117, 'print', 'Print', 'ছাপানো', 'طباعة', 'Impression', 'छाप', 'Mencetak', 'Stampare', '印刷', '인쇄', 'Afdrukken', 'Impressão', 'พิมพ์', 'baskı', 'پرنٹ', '打印'),
(118, 'select_file_type', 'Select File Type', 'নির্বাচন ফাইল টাইপ', 'حدد نوع الملف', 'Sélectionner le type de fichier', 'चुनें फ़ाइल प्रकार', 'Pilih File Type', 'Selezionare il tipo di file', 'ファイルタイプを選択します', '선택 파일 형식', 'Select File Type', 'Selecionar Tipo de Arquivo', 'เลือกประเภทไฟล์', 'Seçin Dosya Türü', 'منتخب فائل کی قسم', '选择文件类型'),
(119, 'excel', 'Excel', 'সীমা অতিক্রম করা', 'تفوق', 'Exceller', 'एक्सेल', 'Unggul', 'Eccellere', 'エクセル', '뛰어나다', 'uitmunten', 'sobressair', 'Excel', 'Excel', 'ایکسل', '高强'),
(120, 'other', 'Other', 'অন্যান্য', 'آخر', 'Autre', 'अन्य', 'Lain', 'Altro', '他の', '다른', 'anders', 'De outros', 'อื่น ๆ', 'Diğer', 'دیگر', '其他'),
(121, 'students_of_class', 'Students Of Class', 'ক্লাস ছাত্রদের', 'طلبة الدرجة', 'Les élèves de la classe', 'कक्षा के छात्र', 'Siswa Kelas', 'Gli studenti della classe', 'クラスの生徒', '클래스의 학생', 'Studenten van de klasse', 'Os alunos da classe', 'นักเรียนชั้น', 'Sınıfının Öğrenciler', 'کلاس کے طالب علموں', '学生类中'),
(122, 'marks_obtained', 'Marks Obtained', 'প্রাপ্ত নম্বর', 'العلامات التي يحصل', 'Notes obtenues', 'प्राप्तांक', 'Marks Diperoleh', 'Voti Ottenuti', '得られたマークス', '마크 획득', 'Marks verkregen', 'notas obtidas', 'ที่ได้รับเครื่องหมาย', 'Marks elde', 'مارکس حاصل', '获得商标'),
(123, 'attendance_for_class', 'Attendance For Class', 'এ্যাটেনডেন্স বর্গ জন্য', 'الحضور لفئة', 'Participation Pour la classe', 'उपस्थिति कक्षा के लिए', 'Kehadiran Untuk Kelas', 'Partecipazione Per la Classe', 'クラスの出席', '클래스에 대한 출석', 'Attendance Voor klasse', 'Presença Para a Classe', 'การเข้าร่วมประชุมสำหรับ Class', 'Sınıfı Seyirci', 'کلاس کے لئے حاضری', '考勤类'),
(124, 'receiver', 'Receiver', 'গ্রাহক', 'المتلقي', 'Récepteur', 'रिसीवर', 'Penerima', 'Ricevitore', '受信機', '리시버', 'Ontvanger', 'recebedor', 'ผู้รับ', 'alıcı', 'وصول', '接收器'),
(125, 'please_select_receiver', 'Please Select Receiver', 'দয়া করে রিসিভার নির্বাচন', 'الرجاء الإختيار استقبال', 'S\'il vous plaît Sélectionnez Receiver', 'कृपया रिसीवर का चयन करें', 'Silakan Pilih Receiver', 'Selezionare Ricevitore', 'Receiverを選択してください', '수신기를 선택하세요', 'Selecteer Receiver', 'Selecione Receiver', 'กรุณาเลือกรับสัญญาณ', 'Alıcısı Seçiniz', 'وصول براہ مہربانی منتخب کریں', '请选择接收器'),
(126, 'session_changed', 'Session Changed', 'সেশন পরিবর্তিত', 'جلسة تغيير', 'session Changed', 'सत्र बदली गई', 'sesi Berubah', 'sessione cambiato', 'セッションが変更します', '세션 변경', 'Session Changed', 'sessão Changed', 'เซสชั่นเปลี่ยน', 'Oturum Değişti', 'سیشن تبدیل کر دیا گیا', '会议改'),
(127, 'exam_marks', 'Exam Marks', 'পরীক্ষার মার্কস', 'علامات الامتحان', 'Marques d\'examen', 'परीक्षा मार्क्स', 'Marks ujian', 'Marks esame', '試験マークス', '시험 마크', 'examen Marks', 'Marcas de exame', 'Marks สอบ', 'sınav Marks', 'امتحان مارکس', '考试马克斯'),
(128, 'total_mark', 'Total Mark', 'মোট মার্ক', 'عدد الأقسام', 'total Mark', 'कुल मार्क', 'total Mark', 'Mark totale', '合計マーク', '총 마크', 'Totaal Mark', 'total de Mark', 'มาร์ครวม', 'Toplam Mark', 'کل مارک', '积分'),
(129, 'mark_obtained', 'Mark Obtained', 'মার্ক প্রাপ্ত', 'علامة حصل', 'Mark Obtenu', 'चिह्न प्राप्त', 'Mark Diperoleh', 'Mark Ottenuto', 'マーク取得', '마크 획득', 'Mark verkregen', 'Mark Obtido', 'มาร์คได้รับ', 'Mark elde', 'مارک حاصل', '标记所获得'),
(130, 'invoice/payment_list', 'Invoice / Payment List', 'ইনভয়েস / পেমেন্ট তালিকা', 'فاتورة / قائمة دفع', 'Facture / Liste de paiement', 'चालान / भुगतान सूची', 'Faktur / Daftar pembayaran', 'Fattura / Lista pagamento', '請求書/支払一覧', '송장 / 지불 목록', 'Factuur / betaling List', 'Invoice / Lista de pagamento', 'ใบแจ้งหนี้ / รายการชำระเงิน', 'Fatura / ödeme listesi', 'انوائس / ادائیگی کی فہرست', '发票/付款清单'),
(131, 'obtained_marks', 'Obtained Marks', 'প্রাপ্ত মার্কস', 'العلامات التي تم الحصول عليها', 'Les notes obtenues', 'प्राप्त अंकों', 'Marks diperoleh', 'punteggi ottenuti', '得られマークス', '획득 마크', 'verkregen Marks', 'notas obtidas', 'เครื่องหมายที่ได้รับ', 'elde edilen Marks', 'حاصل مارکس', '获得商标'),
(132, 'highest_mark', 'Highest Mark', 'সর্বোচ্চ মার্ক', 'أعلى الأقسام', 'le plus élevé Mark', 'उच्चतम निशान', 'Mark tertinggi', 'Massima Mark', '最高点', '최고 마크', 'hoogste Mark', 'maior Mark', 'มาร์คสูงสุด', 'En yüksek işaretle', 'سب سے زیادہ نشان', '最高分'),
(133, 'grade', 'Grade (GPA)', 'শ্রেণী', 'درجة', 'Qualité', 'ग्रेड', 'Kelas', 'Grado', 'グレード', '학년', 'Rang', 'Grau', 'เกรด', 'sınıf', 'گریڈ', '年级'),
(134, 'dashboard', 'Dashboard', 'ড্যাশবোর্ড', 'لوحة القيادة', 'Tableau de bord', 'डैशबोर्ड', 'Dasbor', 'Cruscotto', 'ダッシュボード', '계기반', 'Dashboard', 'painel de instrumentos', 'แผงควบคุม', 'gösterge paneli', 'ڈیش بورڈ', '仪表板'),
(135, 'student', 'Student', 'ছাত্র', 'طالب علم', 'Élève', 'छात्र', 'Mahasiswa', 'Alunno', '学生', '학생', 'Student', 'Aluna', 'นักเรียน', 'öğrenci', 'طالب علم', '学生'),
(136, 'rename', 'Rename', 'নামান্তর', 'إعادة تسمية', 'rebaptiser', 'नाम बदलने', 'ganti nama', 'rinominare', '名前を変更する', '이름 바꾸기', 'andere naam geven', 'renomear', 'ตั้งชื่อใหม่', 'adını değiştirmek', 'تبدیل کریں', '改名'),
(137, 'class', 'Class', 'শ্রেণী', 'صف مدرسي', 'Classe', 'कक्षा', 'Kelas', 'Classe', 'クラス', '수업', 'Klasse', 'Classe', 'ชั้น', 'sınıf', 'کلاس', '类'),
(138, 'teacher', 'Teacher', 'শিক্ষক', 'مدرس', 'Professeur', 'अध्यापक', 'Guru', 'Insegnante', '先生', '선생', 'Leraar', 'Professor', 'ครู', 'öğretmen', 'ٹیچر', '老师'),
(139, 'parents', 'Parents', 'মাতাপিতা', 'الآباء', 'Des parents', 'माता-पिता', 'Orangtua', 'genitori', '親', '부모님', 'Ouders', 'Pais', 'พ่อแม่', 'ebeveyn', 'والدین', '父母'),
(140, 'subject', 'Subject', 'বিষয়', 'موضوع', 'Assujettir', 'विषय', 'Subyek', 'Soggetto', 'テーマ', '제목', 'Onderwerpen', 'Sujeito', 'เรื่อง', 'konu', 'موضوع', '学科'),
(141, 'student_attendance', 'Student Attendance', 'ছাত্র উপস্থিতি', 'حضور الطالب', 'Participation des étudiants', 'छात्र उपस्थिति', 'Kehadiran siswa', 'Frequenza degli studenti', '学生の出席', '학생 출석', 'Studentenbijwonen', 'Freqüência de estudantes', 'การเข้าเรียนของนักเรียน', 'Öğrenci yurdu', 'طلبا کی حاضری', '出席学生'),
(142, 'exam_list', 'Exam List', 'পরীক্ষার তালিকা', 'قائمة الامتحان', 'Liste d\'examen', 'परीक्षा सूची', 'Daftar ujian', 'Lista esame', '試験のリスト', '시험 목록', 'examen Lijst', 'Lista de exame', 'รายการสอบ', 'sınav listesi', 'امتحان کی فہرست', '考试名单'),
(143, 'grades_range', 'Grades Range', 'গ্রেড পরিসীমা', 'مجموعة الدرجات', 'Gamme de notes', 'ग्रेड श्रेणी', 'Kisaran nilai', 'Gamma di gradi', 'グレードの範囲', '성적 범위', 'Rangen bereik', 'Escala de notas', 'ช่วงคะแนน', 'Derece aralığı', 'گریڈ کی حد', '等级范围'),
(144, 'loading', 'Loading', 'বোঝাই', 'جار التحميل', 'chargement', 'लोड हो रहा है', 'pemuatan', 'Caricamento in corso', 'ローディング', '로딩', 'bezig met laden', 'Carregando', 'โหลด', 'Yükleniyor', 'لوڈنگ', '装载'),
(145, 'library', 'Library', 'লাইব্রেরি', 'مكتبة', 'Bibliothèque', 'पुस्तकालय', 'Perpustakaan', 'Biblioteca', 'ライブラリ', '도서관', 'Bibliotheek', 'Biblioteca', 'ห้องสมุด', 'kütüphane', 'لائبریری', '图书馆'),
(146, 'hostel', 'Hostel', 'ছাত্রাবাস', 'المهجع', 'Dortoir', 'छात्रावास', 'asrama mahasiswa', 'Dormitorio', '寮', '기숙사', 'Slaapzaal', 'Dormitório', 'หอพัก', 'Yurt', 'شیناگار', '宿舍'),
(147, 'events', 'Events', 'সূচনাফলক', 'اللافتة', 'Tableau d\'affichage', 'सूचना पट्ट', 'Papan peringatan', 'Bacheca', '掲示板', '공지 사항 게시판', 'Notitiebord', 'Quadro de notícias', 'กระดานป้ายติดประกาศ', 'noticeboard', 'نوٹس بورڈ', '布告栏'),
(148, 'message', 'Message', 'বার্তা', 'الرسالة', 'Message', 'संदेश', 'Pesan', 'Messaggio', 'メッセージ', '메시지', 'Bericht', 'Mensagem', 'ข่าวสาร', 'Mesaj', 'پیغام', '信息'),
(149, 'translations', 'Translations', 'অনুবাদের', 'ترجمة', 'traductions', 'अनुवाद', 'terjemahan', 'traduzioni', '翻訳', '번역', 'vertaalwerk', 'traduções', 'แปล', 'çeviriler', 'ترجمہ', '译文'),
(150, 'account', 'Account', 'হিসাব', 'حساب', 'Compte', 'लेखा', 'Rekening', 'account', 'アカウント', '계정', 'Account', 'Conta', 'บัญชี', 'hesap', 'اکاؤنٹ', '帐户'),
(151, 'selected_session', 'Selected Session', 'নির্বাচিত সেশন', 'جلسة مختارة', 'session sélectionnée', 'चयनित सत्र', 'sesi terpilih', 'sessione selezionata', '選択されたセッション', '선택된 세션', 'geselecteerde sessie', 'sessão selecionada', 'เซสชันที่เลือก', 'seçilen oturum', 'منتخب کردہ سیشن', '选定的会话'),
(152, 'change_password', 'Change Password', 'পাসওয়ার্ড পরিবর্তন করুন', 'تغيير كلمة السر', 'Changer le mot de passe', 'पासवर्ड बदलें', 'Ganti kata sandi', 'Cambia la password', 'パスワードを変更する', '암호 변경', 'Verander wachtwoord', 'Mudar senha', 'เปลี่ยนรหัสผ่าน', 'Şifre değiştir', 'پاس ورڈ تبدیل کریں', '更改密码'),
(153, 'section', 'Section', 'অধ্যায়', 'قسم', 'Section', 'अनुभाग', 'Bagian', 'Sezione', 'セクション', '섹션', 'sectie', 'Seção', 'มาตรา', 'Bölüm', 'سیکشن', '部分'),
(154, 'edit', 'Edit', 'সম্পাদন করা', 'تحرير', 'modifier', 'संपादित करें', 'mengedit', 'Modifica', '編集', '편집하다', 'Bewerk', 'Editar', 'แก้ไข', 'Düzenleme', 'تصیح', '编辑'),
(155, 'delete', 'Delete', 'মুছে ফেলা', 'حذف', 'Effacer', 'मिटाना', 'Menghapus', 'cancellare', '削除', '지우다', 'Verwijder', 'Excluir', 'ลบ', 'silmek', 'حذف کریں', '删除'),
(156, 'cancel', 'Cancel', 'বাতিল', 'إلغاء', 'Annuler', 'रद्द करना', 'Membatalkan', 'Annulla', 'キャンセル', '취소', 'Annuleer', 'Cancelar', 'ยกเลิก', 'İptal', 'منسوخ کریں', '取消'),
(157, 'parent', 'Parent', 'মাতা', 'أصل', 'Parent', 'माता-पिता', 'Induk', 'Genitore', '親', '부모의', 'Ouder', 'parente', 'ผู้ปกครอง', 'ebeveyn', 'والدین', '亲'),
(158, 'attendance', 'Attendance', 'উপস্থিতি', 'الحضور', 'Présence', 'उपस्थिति', 'Kehadiran', 'partecipazione', '出席', '출석', 'opkomst', 'Comparecimento', 'การดูแลรักษา', 'katılım', 'حاضری', '护理'),
(159, 'addmission_form', 'Admission Form', 'ভর্তির ফর্ম', 'شكل القبول', 'Formulaire d\'admission', 'प्रवेश फार्म', 'Formulir Pendaftaran', 'Modulo di ammissione', '入学式', '입학 허가서', 'Toelatingsformulier', 'Formulário de admissão', 'แบบฟอร์มการรับสมัคร', 'Kabul Formu', 'داخلہ فارم', '入学表格'),
(160, 'name', 'Name', 'নাম', 'اسم', 'prénom', 'नाम', 'Nama', 'Nome', '名', '이름', 'Naam', 'Nome', 'ชื่อ', 'isim', 'نام', '名称'),
(161, 'select', 'Select', 'নির্বাচন করা', 'اختار', 'Sélectionner', 'चुनते हैं', 'Memilih', 'Selezionare', '選択します', '고르다', 'kiezen', 'selecionar', 'เลือก', 'seçmek', 'منتخب کریں', '选择'),
(162, 'roll', 'Roll', 'রোল', 'لفة', 'Roulent', 'रोल', 'Gulungan', 'Rotolo', 'ロール', '롤', 'Rollen', 'Rolo', 'ม้วน', 'Rulo', 'رول', '滚'),
(163, 'birthday', 'Date Of Birth', 'জন্ম তারিখ', 'تاريخ الميلاد', 'Anniversaire', 'जन्मदिन', 'Ulang tahun', 'Compleanno', 'お誕生日', '생일', 'Verjaardag', 'Aniversário', 'วันเกิด', 'Doğum günü', 'سالگرہ', '生日'),
(164, 'gender', 'Gender', 'লিঙ্গ', 'جنس', 'Le genre', 'लिंग', 'Jenis kelamin', 'Genere', '性別', '성별', 'Geslacht', 'Gênero', 'เพศ', 'Cinsiyet', 'صنف', '性别'),
(165, 'male', 'Male', 'পুরুষ', 'ذكر', 'Mâle', 'नर', 'Pria', 'Maschio', '男性', '남성', 'Mannetje', 'Masculino', 'ชาย', 'Erkek', 'مرد', '男'),
(166, 'female', 'Female', 'মহিলা', 'أنثى', 'Femelle', 'महिला', 'Wanita', 'Femmina', '女性', '여자', 'Vrouw', 'Fêmea', 'หญิง', 'Kadın', 'خواتین', '女'),
(167, 'address', 'Address', 'ঠিকানা', 'عنوان', 'Adresse', 'पता', 'Alamat', 'Indirizzo', '住所', '주소', 'Adres', 'Endereço', 'ที่อยู่', 'adres', 'ایڈریس', '地址'),
(168, 'phone', 'Phone', 'ফোন', 'هاتف', 'Téléphone', 'फ़ोन', 'Telepon', 'Telefono', '電話', '전화', 'Telefoon', 'Telefone', 'โทรศัพท์', 'Telefon', 'فون', '电话'),
(169, 'email', 'Email', 'ই-মেইল', 'البريد الإلكتروني', 'Email', 'ईमेल', 'E-mail', 'E-mail', 'Eメール', '이메일', 'E-mail', 'O email', 'อีเมล์', 'E-posta', 'دوستوں کوارسال کریں', '电子邮件'),
(170, 'password', 'Password', 'পাসওয়ার্ড', 'كلمه السر', 'Mot de passe', 'पासवर्ड', 'Kata sandi', 'parola d\'ordine', 'パスワード', '암호', 'Wachtwoord', 'Senha', 'รหัสผ่าน', 'Parola', 'پاس ورڈ', '密码'),
(171, 'transport_route', 'Transport Route', 'পরিবহন রুট', 'النقل الطريق', 'Transport Route', 'परिवहन मार्ग', 'Transportasi Route', 'Transport Route', '交通ルート', '운송 경로', 'transport Route', 'Itinerários', 'เส้นทางขนส่ง', 'Ulaştırma Rota', 'ٹرانسپورٹ روٹ', '运输路线'),
(172, 'photo', 'Photo', 'ছবি', 'صورة فوتوغرافية', 'photo', 'तस्वीर', 'Foto', 'Foto', '写真', '사진', 'Foto', 'foto', 'ภาพถ่าย', 'fotoğraf', 'تصویر', '照片'),
(173, 'select_class', 'Select Class', 'ক্লাস নির্বাচন', 'حدد فئة', 'Sélectionnez la classe', 'वर्ग का चयन', 'Pilih Kelas', 'Seleziona classe', 'クラスを選択します', '선택 클래스', 'Select Class', 'Selecionar classe', 'เลือกชั้นเรียน', 'seçin Sınıf', 'کلاس منتخب', '选择类别'),
(174, 'username_password_incorrect', 'Username Or Password Is Incorrect', 'ব্যাবহারকারীর নাম অথবা গোপন নাম্বারটি ভুল', 'اسم المستخدم أو كلمة المرور غير صحيحة', 'L\'identifiant ou le mot de passe est incorrect', 'उपयोगकर्ता नाम या पासवर्ड गलत है', 'Nama pengguna atau kata sandi salah', 'Nome utente o password non sono corretti', 'ユーザー名かパスワードが間違っています', '사용자 이름 또는 암호가 올바르지 않습니다', 'Gebruikersnaam of wachtwoord is onjuist', 'Nome de usuário ou senha está incorreta', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง', 'Kullanıcı adı veya şifre yanlış', 'صارف کا نام یا پاس ورڈ غلط ہے', '用户名或密码不正确'),
(175, 'select_section', 'Select Section', 'অনুচ্ছেদ নির্বাচন', 'حدد القسم', 'Sélectionnez Section', 'अनुभाग का चयन', 'Pilih Bagian', 'Seleziona sezione', 'セクションを選択します', '선택 섹션', 'Select Section', 'Select Section', 'เลือกส่วน', 'seç Bölüm', 'سیکشن منتخب', '选择部分'),
(176, 'options', 'Options', 'বিকল্প', 'خيارات', 'options de', 'विकल्प', 'Pilihan', 'Opzioni', 'オプション', '옵션', 'opties', 'opções', 'ตัวเลือก', 'Seçenekler', 'اختیارات', '选项'),
(177, 'mark_sheet', 'Mark Sheet', 'নাম্বার শিট', 'ورقة علامة', 'Mark Sheet', 'अंक तालिका', 'Lembar penilaian', 'Libretto universitario', 'マークシート', '마크 시트', 'Mark Sheet', 'Mark Sheet', 'มาร์คแผ่น', 'İşareti levha', 'مارک شیٹ', '标记表'),
(178, 'profile', 'Profile', 'প্রোফাইলে', 'الملف الشخصي', 'Profil', 'प्रोफाइल', 'profil', 'Profilo', 'プロフィール', '윤곽', 'Profiel', 'Perfil', 'ข้อมูลส่วนตัว', 'Profil', 'پروفائل', '轮廓'),
(179, 'select_all', 'Select All', 'সবগুলো নির্বাচন করা', 'اختر الكل', 'Sélectionner tout', 'सभी का चयन करे', 'Pilih Semua', 'Seleziona tutto', 'すべて選択', '모두 선택', 'Selecteer alles', 'Selecionar tudo', 'เลือกทั้งหมด', 'Hepsini seç', 'تمام منتخب کریں', '全选'),
(180, 'select_none', 'Select None', 'কিছুই না', 'حدد بلا', 'Ne rien sélectionner', 'किसी का चयन न करें', 'Pilih Tidak', 'Non selezionare niente', '何も選択しません', '선택 없음', 'Niets selecteren', 'Selecione nenhum', 'เลือกไม่มี', 'Hiçbir şey seçilmedi', 'کوئی بھی منتخب', '选择无'),
(181, 'average', 'Average', 'গড়', 'متوسط', 'Moyenne', 'औसत', 'rata-rata', 'Media', '平均', '평균', 'Gemiddelde', 'Média', 'เฉลี่ย', 'Ortalama', 'اوسط', '平均'),
(182, 'transfer', 'Transfer', 'হস্তান্তর', 'تحويل', 'transfert', 'स्थानांतरण', 'transfer', 'trasferimento', '転送', '이전', 'overdracht', 'transferir', 'โอน', 'aktarma', 'منتقلی', '转让'),
(183, 'edit_teacher', 'Edit Teacher', 'গুরু সম্পাদনা', 'تحرير المعلم', 'Modifier enseignant', 'शिक्षक संपादित करें', 'mengedit Guru', 'Modifica Maestro', '編集教師', '편집 교사', 'Leraar bewerken', 'Editar professor', 'แก้ไขครู', 'Düzenleme Öğretmen', 'ٹیچر ترمیم کریں', '编辑老师'),
(184, 'sex', 'Sex', 'লিঙ্গ', 'جنس', 'Sexe', 'लिंग', 'Seks', 'Sesso', 'セックス', '섹스', 'Seks', 'Sexo', 'เพศ', 'Seks', 'جنس', '性别'),
(185, 'marksheet_for', 'Marksheet For', 'মার্ক শীট', 'ورقة علامة ل', 'Marquer les feuilles pour', 'Marksheet For', 'Mark lembar untuk', 'fogli marchio per', '用マークシート', '에 대한 마크 시트', 'Mark platen voor', 'Marcar folhas para', 'แผ่นมาร์คสำหรับ', 'Mark levhalar', 'Marksheet For', '马克薄板'),
(186, 'total_marks', 'Total Marks', 'মোট মার্কস', 'مجموع الدرجات', 'total de points', 'कुल मार्क', 'total Marks', 'Marks totali', '総マークス', '총 마크', 'Totaal Marks', 'total de Marcas', 'Marks รวม', 'Toplam Marks', 'کل مارکس', '总分'),
(187, 'parent_phone', 'Parent Phone', 'পেরেন্ট ফোন', 'الأم الهاتف', 'Parent téléphone', 'माता पिता के फोन', 'induk Telepon', 'Parent Phone', '親の携帯電話', '부모 전화', 'Parent Phone', 'pais Telefone', 'ผู้ปกครองโทรศัพท์', 'Veli Telefon', 'والدین فون', '家长电话'),
(188, 'subject_author', 'Subject Author', 'বিষয় লেখক', 'الموضوع المؤلف', 'Sujet Auteur', 'विषय लेखक', 'Subjek Penulis', 'Autore del soggetto', 'テーマ作成者', '제목 작성자', 'Onderwerp Auteur', 'Assunto Autor', 'ผู้แต่งเรื่อง', 'Konu Yazar', 'موضوع مصنف', '主题作者'),
(189, 'update', 'Update', 'হালনাগাদ', 'تحديث', 'Mettre à jour', 'अपडेट', 'Memperbarui', 'Aggiornare', '更新', '최신 정보', 'Bijwerken', 'Atualizar', 'ปรับปรุง', 'Güncelleştirme', 'اپ ڈیٹ', '更新'),
(190, 'class_list', 'Class List', 'ক্লাস তালিকা', 'قائمة الطبقة', 'Liste des classes', 'कक्षा सूची', 'Daftar kelas', 'Lista Class', 'クラス一覧', '클래스 목록', 'class List', 'Lista de Classes', 'รายการระดับ', 'sınıf listesi', 'کلاس کی فہرست', '班级列表'),
(191, 'class_name', 'Class Name', 'শ্রেণির নাম', 'اسم الطبقة', 'Nom du cours', 'कक्षा का नाम', 'Nama kelas', 'Nome della classe', 'クラス名', '클래스 이름', 'Naam van de klasse', 'Nome da classe', 'ชื่อชั้น', 'Sınıf adı', 'کلاس نام', '类名'),
(192, 'name_numeric', 'Name Numeric', 'নাম সংখ্যাসূচক', 'اسم الرقمية', 'Nom numérique', 'नाम संख्यात्मक', 'nama Numeric', 'nome numerico', '名前数値', '이름 숫자', 'naam Numeriek', 'nome numérico', 'ชื่อตัวเลข', 'isim Sayısal', 'نام نمبری', '名称数字'),
(193, 'select_teacher', 'Select Teacher', 'গুরু নির্বাচন', 'حدد المعلم', 'Sélectionnez ce professeur', 'शिक्षक का चयन', 'Pilih Guru', 'Seleziona insegnante', '教師を選択', '선택 교사', 'Selecteer Teacher', 'Escolha um professor', 'เลือกครู', 'seçin Öğretmen', 'ٹیچر منتخب', '选择教师'),
(194, 'edit_class', 'Edit Class', 'ক্লাস সম্পাদনা', 'تحرير الفئة', 'Modifier la classe', 'कक्षा संपादित करें', 'mengedit Kelas', 'Modifica Class', '編集クラス', '편집 클래스', 'klasse bewerken', 'Editar Classe', 'แก้ไขชั้น', 'Düzenleme Sınıfı', 'تصیح کلاس', '编辑类'),
(195, 'section_name', 'Section Name', 'অনুচ্ছেদ নাম', 'اسم القسم', 'Nom de la section', 'अनुभाग का नाम', 'bagian Nama', 'Nome sezione', 'セクション名', '섹션 이름', 'sectie Naam', 'Nome da seção', 'ส่วนชื่อ', 'bölüm Adı', 'حصے کا نام', '部分名称'),
(196, 'add_section', 'Add Section', 'অনুচ্ছেদ যোগ', 'إضافة مقطع', 'Ajouter Section', 'धारा जोड़े', 'Tambahkan Bagian', 'Aggiungere Sezione', 'セクションを追加します。', '섹션 추가', 'Sectie toevoegen', 'Adicionar Seção', 'เพิ่มส่วน', 'Bölüm ekle', 'سیکشن کا اضافہ کریں', '添加章节'),
(197, 'subject_list', 'Subject List', 'বিষয় তালিকা', 'قائمة الموضوع', 'Liste Sujet', 'विषय सूची', 'Daftar subjek', 'soggetto List', '件名一覧', '주제 목록', 'subject List', 'Assunto Lista', 'รายการหัวเรื่อง', 'Konu listesi', 'موضوع لسٹ', '主题列表'),
(198, 'subject_name', 'Subject Name', 'বিষয় নাম', 'اسم الموضوع', 'Nom Sujet', 'विषय नाम', 'Nama subjek', 'soggetto Nome', 'サブジェクト名', '주체 이름', 'onderwerp Naam', 'Nome Assunto', 'ชื่อเรื่อง', 'Konu Adı', 'موضوع کا نام', '主题名称'),
(199, 'edit_subject', 'Edit Subject', 'বিষয় সম্পাদনা', 'تحرير الموضوع', 'Modifier Objet', 'विषय संपादित करें', 'Edit Perihal', 'Modifica oggetto', '編集件名', '편집 주제', 'Onderwerp bewerken', 'Editar assunto', 'แก้ไขเรื่อง', 'Konu Düzenle', 'موضوع میں ترمیم کریں', '编辑主题'),
(200, 'day', 'Day', 'দিন', 'يوم', 'journée', 'दिन', 'Hari', 'Giorno', '日', '일', 'Dag', 'Dia', 'วัน', 'Gün', 'ڈے', '天'),
(201, 'starting_time', 'Starting Time', 'সময় শুরু', 'ابتداء من الوقت', 'Heure de départ', 'प्रारम्भ का समय', 'Waktu mulai', 'Tempo di partenza', '起動時間', '시간 시작', 'Starttijd', 'Tempo de partida', 'เวลาเริ่มต้น', 'Başlangıç ​​zamanı', 'وقت پر شروع', '开始时间'),
(202, 'hour', 'Hour', 'ঘন্টা', 'ساعة', 'Heure', 'समय', 'Jam', 'Ora', '時間', '시간', 'Uur', 'Hora', 'ชั่วโมง', 'Saat', 'قیامت', '小时'),
(203, 'minutes', 'Minutes', 'মিনিট', 'دقيقة', 'Minutes', 'मिनट', 'Menit', 'Minuti', '分', '의사록', 'Notulen', 'Minutos', 'รายงานการประชุม', 'dakika', 'منٹس', '纪要'),
(204, 'ending_time', 'Ending Time', 'সময় শেষ', 'إنهاء الوقت', 'Fin Temps', 'अंतिम समय', 'akhir Waktu', 'Fine Tempo', '終了時刻', '시간 종료', 'Ending Time', 'Tempo Final', 'เวลาสิ้นสุด', 'Zaman Bitiş', 'وقت ختم', '结束时间'),
(205, 'select_subject', 'Select Subject', 'বিষয় নির্বাচন করুন', 'حدد الموضوع', 'Sélectionnez Objet', 'विषय का चयन', 'Pilih Jurusan', 'Selezionare Oggetto', '件名を選択', '선택 주제', 'Selecteer Onderwerp', 'Selecione Assunto', 'เลือกสาขาวิชา', 'Konu seçin', 'موضوع منتخب', '选择主题'),
(206, 'select_date', 'Select Date', 'তারিখ নির্বাচন করুন', 'حدد التاريخ', 'Sélectionnez date', 'तारीख़ चुनें', 'Pilih Tanggal', 'Selezionare Data', '日付を選択', '날짜 선택', 'Datum selecteren', 'Selecione Data', 'เลือกวันที่', 'seçin tarihi', 'تاریخ منتخب', '选择日期'),
(207, 'select_month', 'Select Month', 'মাস নির্বাচন করুন', 'اختر الشهر', 'Sélectionnez un mois', 'महीना चुनिए', 'Pilih Bulan', 'Selezionare il mese', '月を選択', '월을 선택', 'Selecteer maand', 'Selecione o mês', 'เลือกเดือน', 'Ay seç', 'مہینہ منتخب کریں', '选择月份'),
(208, 'select_year', 'Select Year', 'নির্বাচন বছর', 'اختر السنة', 'Sélectionnez Année', 'चयन वर्ष', 'pilih Tahun', 'Seleziona Anno', '年を選択', '년도 선택', 'Selecteer Jaar', 'Selecione o ano', 'เลือกปี', 'Yıl seçin', 'چھانٹیں کریں', '选择年份'),
(209, 'add_language', 'Add Language', 'ভাষা যোগ করুন', 'إضافة لغة', 'ajouter une langue', 'भाषा जोड़ें', 'tambahkan bahasa', 'aggiungere la lingua', '言語を追加する', '언어 추가', 'taal toevoegen', 'adicionar linguagem', 'เพิ่มภาษา', 'dil ekle', 'زبان شامل کریں', '添加语言'),
(210, 'exam_name', 'Exam Name', 'পরীক্ষার নাম', 'اسم الامتحان', 'Nom d\'examen', 'परीक्षा का नाम', 'ujian Nama', 'Nome esame', '試験名', '시험 이름', 'examen Naam', 'exame Nome', 'ชื่อสอบ', 'sınav Adı', 'امتحان نام', '考试名称'),
(211, 'date', 'Date', 'তারিখ', 'تاريخ', 'date', 'तारीख', 'Tanggal', 'Data', '日付', '날짜', 'Datum', 'Encontro', 'วันที่', 'tarih', 'تاریخ', '日期'),
(212, 'comment', 'Comment', 'মন্তব্য', 'التعليق', 'Commentaire', 'टिप्पणी', 'Komentar', 'Commento', 'コメント', '논평', 'Commentaar', 'Comente', 'คิดเห็น', 'Yorum', 'تبصرہ', '评论'),
(213, 'edit_exam', 'Edit Exam', 'পরীক্ষার সম্পাদনা', 'تحرير امتحان', 'Modifier examen', 'परीक्षा संपादित करें', 'mengedit Ujian', 'Modifica esame', '編集試験', '편집 시험', 'Examen bewerken', 'Editar Exame', 'แก้ไขการสอบ', 'Düzenleme Sınavı', 'امتحان میں ترمیم کریں', '编辑考试'),
(214, 'grade_list', 'Grade List', 'গ্রেড তালিকা', 'قائمة الصف', 'Liste de grade', 'ग्रेड सूची', 'Daftar kelas', 'Lista grado', 'グレード一覧', '학년 목록', 'Grade List', 'Lista Grade', 'รายการเกรด', 'sınıf listesi', 'گریڈ کی فہرست', '等级名单'),
(215, 'grade_name', 'Grade Name', 'গ্রেড নাম', 'اسم الصف', 'Nom de grade', 'ग्रेड नाम', 'Nama kelas', 'Nome grado', 'グレード名', '학년 이름', 'Grade Naam', 'Nome grau', 'ชื่อชั้นประถมศึกษา', 'Sınıf Adı', 'گریڈ نام', '牌号名称');
INSERT INTO `languages` (`id`, `word`, `english`, `bengali`, `arabic`, `french`, `hindi`, `indonesian`, `italian`, `japanese`, `korean`, `dutch`, `portuguese`, `thai`, `turkish`, `urdu`, `chinese`) VALUES
(216, 'grade_point', 'Grade Point', 'গ্রেড পয়েন্ট', 'الصف نقطة', 'grade point', 'ग्रेड बिंदु', 'Indeks Prestasi', 'Grade Point', 'グレードポイント', '학점', 'Grade Point', 'Ponto de classificação', 'เกรด', 'not', 'گریڈ نقطہ', '绩点'),
(217, 'select_exam', 'Select Exam', 'পরীক্ষার নির্বাচন', 'حدد الامتحان', 'Sélectionnez Exam', 'परीक्षा का चयन', 'Pilih Ujian', 'Selezionare esame', '試験を選択', '선택의 시험', 'Selecteer Examen', 'Select Exam', 'เลือกสอบ', 'seç Sınav', 'امتحان منتخب', '选择考试'),
(218, 'students', 'Students', 'শিক্ষার্থীরা', 'الطلاب', 'Élèves', 'छात्र', 'siswa', 'Alunni', '学生の', '재학생', 'leerlingen', 'estudantes', 'นักเรียน', 'Öğrenciler', 'طلباء', '学生们'),
(219, 'subjects', 'Subjects', 'প্রজাদের', 'المواضيع', 'Sujets', 'विषयों', 'subyek', 'Soggetti', '科目', '주제', 'vakken', 'assuntos', 'อาสาสมัคร', 'Konular', 'مضامین', '主题'),
(220, 'total', 'Total', 'মোট', 'مجموع', 'Total', 'कुल', 'Total', 'Totale', '合計', '합계', 'Totaal', 'Total', 'ทั้งหมด', 'Toplam', 'کل', '总'),
(221, 'select_academic_session', 'Select Academic Session', 'একাডেমিক সেশন নির্বাচন', 'حدد الدورة الأكاديمية', 'Séance scolaire sélectionnée', 'अकादमिक सत्र का चयन करें', 'Pilih sesi akademik', 'Selezionare sessione accademica', '学会を選択する', '학술회의 선택', 'Selecteer een academische sessie', 'Selecione a sessão acadêmica', 'เลือกเซสชันการศึกษา', 'Akademik oturumu seç', 'تعلیمی سیشن کا انتخاب کریں', '选择学术会议'),
(222, 'invoice_informations', 'Invoice Informations', 'চালান ইনফরমেশন', 'معلومات الفاتورة', 'Informations de facturation', 'चालान जानकारी', 'Informasi faktur', 'Informazioni fattura', '請求書情報', '송장 정보', 'factuur Informations', 'Informações factura', 'ข้อมูลใบแจ้งหนี้', 'fatura Bilgileri', 'انوائس کی معلومات', '发票信息'),
(223, 'title', 'Title', 'খেতাব', 'عنوان', 'Titre', 'शीर्षक', 'Judul', 'Titolo', 'タイトル', '표제', 'Titel', 'Título', 'หัวข้อ', 'başlık', 'عنوان', '标题'),
(224, 'description', 'Description', 'বিবরণ', 'وصف', 'La description', 'विवरण', 'Deskripsi', 'Descrizione', '説明', '기술', 'Beschrijving', 'Descrição', 'ลักษณะ', 'tanım', 'تفصیل', '描述'),
(225, 'payment_informations', 'Payment Informations', 'পেমেন্ট তথ্য', 'معلومات الدفع', 'Informations de paiement', 'भुगतान जानकारी', 'Informasi Pembayaran', 'Informazioni di pagamento', '支払情報', '결제 정보', 'Payment Informations', 'Informações de pagamento', 'ข้อมูลการชำระเงิน', 'Ödeme Bilgileri', 'ادائیگی کی معلومات', '付款信息'),
(226, 'view_invoice', 'View Invoice', 'দেখুন চালান', 'عرض الفاتورة', 'Voir la facture', 'चालान देखें', 'Lihat Faktur', 'Visualizza fattura', '請求書を見ます', '보기 송장', 'Bekijk Factuur', 'Ver Invoice', 'ดูใบแจ้งหนี้', 'Görünüm Fatura', 'لنک انوائس', '查看发票'),
(227, 'payment_to', 'Payment To', 'পরিশোদ করা', 'دفع ل', 'Paiement à', 'को भुगतान', 'pembayaran untuk', 'pagamento a', 'への支払い', '로 지불', 'Betaling aan', 'Pagamento para', 'การชำระเงิน', 'Için ödeme', 'کرنے کے لئے ادائیگی', '支付'),
(228, 'bill_to', 'Bill To', 'বিল করতে', 'فاتورة الى', 'Facturer', 'बिल प्राप्तकर्ता', 'Pembayaran kepada', 'Fatturare a', '請求書送付先', '빌로', 'Rekening naar', 'Projeto de lei para', 'ส่งเบิกไปที่', 'Ya fatura edilecek', 'کا بل', '记账到'),
(229, 'total_amount', 'Total Amount', 'সর্বমোট পরিমাণ', 'المبلغ الإجمالي', 'Montant total', 'कुल रकम', 'Jumlah total', 'Importo totale', '合計金額', '총액', 'Totaalbedrag', 'Valor total', 'จำนวนเงินรวม', 'Toplam tutar', 'کل رقم', '总金额'),
(230, 'paid_amount', 'Paid Amount', 'দেওয়া পরিমাণ', 'المبلغ المدفوع', 'Montant payé', 'भरी गई राशि', 'Jumlah pembayaran', 'Importo pagato', '支払金額', '지불 금액', 'Betaalde hoeveelheid', 'Quantidade paga', 'จำนวนเงินที่ชำระ', 'Ödenen miktar', 'ادا کی گئی رقم', '已付金额'),
(231, 'due', 'Due', 'দরুন', 'بسبب', 'Dû', 'देय', 'karena', 'Dovuto', '原因', '정당한', 'verschuldigd', 'Devido', 'ครบกำหนด', 'gereken', 'وجہ', '应有'),
(232, 'amount_paid', 'Amount Paid', 'পরিমাণ অর্থ প্রদান করা', 'المبلغ المدفوع', 'Le montant payé', 'राशि का भुगतान', 'Jumlah yang dibayarkan', 'Importo pagato', '払込金額', '금액 지급', 'Betaald bedrag', 'Quantia paga', 'จำนวนเงินที่จ่าย', 'Ödenen miktar', 'رقم ادا کر دی', '支付的金额'),
(233, 'payment_successfull', 'Payment has been successful', 'পেমেন্ট সফল হয়েছে', 'دفع النجاح', 'Paiement Successfull', 'भुगतान सफल', 'Successfull pembayaran', 'Successfull pagamento', '支払成功し', '결제 성공적인', 'betaling Succesvolle', 'Successfull pagamento', 'ที่ประสบความสำเร็จการชำระเงิน', 'Ödeme Başarılı', 'ادائیگی کامیاب', '支付全成'),
(234, 'add_invoice/payment', 'Add Invoice/payment', 'ইনভয়েস / পেমেন্ট যোগ', 'إضافة فاتورة / دفع', 'Ajouter Facture / paiement', 'चालान / भुगतान जोड़े', 'Tambahkan Faktur / pembayaran', 'Aggiungere fattura / pagamento', '請求書/支払いを追加', '송장 / 지불 추가', 'Voeg Factuur / betaling', 'Adicionar fatura / pagamento', 'เพิ่มใบแจ้งหนี้ / การชำระเงิน', 'Fatura / ödeme ekle', 'شامل کریں انوائس / ادائیگی', '添加发票/付款'),
(235, 'invoices', 'Invoices', 'ইনভয়েস বা চালান', 'الفواتير', 'factures', 'चालान', 'faktur', 'Fatture', '請求書', '송장', 'facturen', 'facturas', 'ใบแจ้งหนี้', 'faturalar', 'انوائس', '发票'),
(236, 'action', 'Action', 'কর্ম', 'عمل', 'action', 'कार्य', 'Tindakan', 'Azione', 'アクション', '동작', 'Actie', 'Açao', 'การกระทำ', 'Aksiyon', 'عمل', '行动'),
(237, 'required', 'Required', 'প্রয়োজনীয়', 'مطلوب', 'Obligatoire', 'अपेक्षित', 'Wajib', 'richiesto', '必須', '필수', 'nodig', 'Requeridos', 'จำเป็นต้องใช้', 'gereken', 'مطلوب', '需要'),
(238, 'info', 'Info', 'তথ্য', 'معلومات', 'Info', 'जानकारी', 'Info', 'Informazioni', 'インフォ', '정보', 'info', 'informações', 'ข้อมูล', 'Bilgi', 'انفارمیشن', '信息'),
(239, 'month', 'Month', 'মাস', '\r\nشهر', 'mois', 'महीना', 'bulan', 'mese', '月', '달', 'maand', 'mês', 'เดือน', 'ay', 'مہینہ', '月'),
(240, 'details', 'Details', 'বিস্তারিত', 'تفاصيل', 'Détails', 'विवरण', 'rincian', 'Dettagli', '詳細', '세부', 'Details', 'Detalhes', 'รายละเอียด', 'Ayrıntılar', 'تفصیلات دیکھیں', '细节'),
(241, 'new', 'New', 'নতুন', 'الجديد', 'Nouveau', 'नया', 'Baru', 'Nuovo', '新しい', '새로운', 'nieuwe', 'Novo', 'ใหม่', 'Yeni', 'نئی', '新'),
(242, 'reply_message', 'Reply Message', 'বার্তা উত্তর', 'رسالة الرد', 'Réponse au message', 'संदेश का जवाब', 'pesan balasan', 'messaggio di risposta', 'メッセージ返信', '메시지 회신', 'berichtantwoord', 'Resposta da mensagem', 'ตอบกลับข้อความ', 'Mesaj cevabı', 'پیغام کا جواب', '消息回复'),
(243, 'message_sent', 'Message Sent', 'বার্তা পাঠানো', 'تم الارسال', '', 'मैसेज बेजा गया', 'Pesan terkirim', 'Messaggio inviato', 'メッセージが送信されました', '메시지 전송 됨', 'Bericht verzonden', 'Mensagem enviada', 'ส่งข้อความ', 'Mesajı gönderildi', 'پیغام چلا گیا', '留言已发送'),
(244, 'search', 'Search', 'অনুসন্ধান', 'بحث', 'chercher', 'खोज', 'pencarian', 'ricerca', 'サーチ', '수색', 'zoeken', 'pesquisa', 'ค้นหา', 'arama', 'کی تلاش', '搜索'),
(245, 'religion', 'Religion', 'ধর্ম', 'دين', 'Religion', 'धर्म', 'Agama', 'Religione', '宗教', '종교', 'Godsdienst', 'Religião', 'ศาสนา', 'Din', 'مذہب', '宗教'),
(246, 'blood_group', 'Blood group', 'রক্তের গ্রুপ', 'فصيلة الدم', 'groupe sanguin', 'रक्त समूह', 'golongan darah', 'gruppo sanguigno', '血液型', '혈액형', 'bloedgroep', 'grupo sanguíneo', 'กรุ๊ปเลือด', 'kan grubu', 'خون کے گروپ', '血型'),
(247, 'database_backup', 'Database Backup', 'ডাটাবেজ ব্যাকআপ', 'قاعدة بيانات النسخ الاحتياطي', 'Sauvegarde de base de données', 'डाटाबेस बैकअप', 'database Backup', 'Database Backup', 'データベースバックアップ', '데이터베이스 백업', 'Database Backup', 'Backup de banco de dados', 'การสำรองฐานข้อมูล', 'Veritabanı Yedekleme', 'ڈیٹا بیس بیک اپ', '数据库备份'),
(248, 'search', 'Search', 'অনুসন্ধান', 'بحث', 'chercher', 'खोज', 'pencarian', 'ricerca', 'サーチ', '수색', 'zoeken', 'pesquisa', 'ค้นหา', 'arama', 'کی تلاش', '搜索'),
(249, 'payments_history', 'Fees Pay / Invoice', 'ফি পরিশোধ / চালান', 'رسوم الدفع / الفاتورة', 'honoraires payer / facture', 'फीस का भुगतान / चालान', 'biaya bayar / faktur', 'tasse di pagamento / fattura', '手数料/請求書', '수수료 지불 / 송장', 'honoraria betalen / facturen', 'taxas de pagamento / fatura', 'ค่าธรรมเนียมการชำระเงิน / ใบแจ้งหนี้', 'ücret ödemesi / fatura', 'فیس ادا / انوائس', '收费/发票'),
(250, 'message_restore', 'Message Restore', 'বার্তা পুনরুদ্ধার', 'استعادة الرسائل', 'Restauration de message', 'संदेश पुनर्स्थापना', 'Pesan dikembalikan', 'Messaggio di ripristino', 'メッセージの復元', '메시지 복원', 'bericht herstellen', 'Restaurar mensagem', 'กู้คืนข้อความ', 'Mesajın geri yüklenmesi', 'پیغام بحال', '留言恢复'),
(251, 'write_new_message', 'Write New Message', 'নতুন বার্তা লিখতে', 'إرسال رسالة جديدة', 'Ecrire un nouveau message', 'नया संदेश लिखें', 'Tulis baru Pesan', 'Scrivi nuovo messaggio', '新しいメッセージを書きます', '새 메시지 쓰기', 'Schrijf New Message', 'Escrever Nova Mensagem', 'เขียนข้อความใหม่', 'Yeni Mesaj Yaz', 'نیا پیغام لکھیں', '我要留言'),
(252, 'attendance_sheet', 'Attendance Sheet', 'এ্যাটেনডেন্স শীট', 'ورقة الحضور', 'Feuille de présence', 'उपस्थिति पत्रक', 'Absensi', 'Foglio presenze', '出席シート', '출석 시트', 'Presentielijst', 'Folha de Atendimento', 'แผ่นการเข้าร่วม', 'Yoklama kağıdı', 'حاضری شیٹ', '考勤表'),
(253, 'holiday', 'Holiday', 'ছুটির দিন', 'يوم الاجازة', 'Vacances', 'छुट्टी का दिन', 'Liburan', 'Vacanza', '休日', '휴일', 'Vakantie', 'Feriado', 'วันหยุด', 'Tatil', 'چھٹیوں کا', '假日'),
(254, 'exam', 'Exam', 'পরীক্ষা', 'امتحان', 'Examen', 'परीक्षा', 'Ujian', 'Esame', '試験', '시험', 'Examen', 'Exame', 'การสอบ', 'Sınav', 'امتحان', '考试'),
(255, 'successfully', 'Successfully', 'সফলভাবে', 'بنجاح', 'Avec succès', 'सफलतापूर्वक', 'Berhasil', 'Con successo', '成功', '성공적으로', 'Met succes', 'Com sucesso', 'ประสบความสำเร็จ', 'Başarıyla', 'کامیابی سے', '成功了'),
(256, 'admin', 'Admin', 'অ্যাডমিন', 'مشرف', 'Admin', 'व्यवस्थापक', 'Admin', 'Admin', '管理者', '관리자', 'beheerder', 'Admin', 'ผู้ดูแลระบบ', 'Admin', 'ایڈمن', '管理员'),
(257, 'inbox', 'Inbox', 'ইনবক্স', 'صندوق الوارد', 'Boîte de réception', 'इनबॉक्स', 'Kotak masuk', 'Posta in arrivo', '受信トレイ', '받은 편지함', 'Inbox', 'Caixa de entrada', 'กล่องจดหมาย', 'Gelen kutusu', 'ان باکس', '收件箱'),
(258, 'sent', 'Sent', 'প্রেরিত', 'أرسلت', 'Envoyé', 'भेज दिया', 'Dikirim', 'Inviato', '送信済み', '전송 됨', 'Verzonden', 'Enviei', 'ส่งแล้ว', 'Gönderildi', 'مرسلہ', '发了'),
(259, 'important', 'Important', 'গুরুত্বপূর্ণ', 'مهم', 'Important', 'जरूरी', 'Penting', 'Importante', '重要', '중대한', 'Belangrijk', 'Importante', 'สำคัญ', 'Önemli', 'اہم', '重要'),
(260, 'trash', 'Trash', 'আবর্জনা', 'قمامة، يدمر، يهدم', 'Poubelle', 'कचरा', 'Sampah', 'Spazzatura', 'ごみ', '폐물', 'Prullenbak', 'Lixo', 'ถังขยะ', 'Çöp', 'ردی کی ٹوکری', '垃圾'),
(261, 'error', 'Unsuccessful', 'ব্যার্থ', 'غير ناجحة', 'Infructueux', 'असफल', 'Gagal', 'Senza esito', '失敗', '실패', 'Mislukt', 'Mal sucedido', 'ไม่สำเร็จ', 'Başarısız', 'ناکام', '不成功'),
(262, 'sessions_list', 'Sessions List', 'সেশন তালিকা', 'قائمة الجلسات', 'Liste des sessions', 'सत्र सूची', 'Daftar Sesi', 'Elenco Sessioni', 'セッションリスト', '세션 목록', 'Sessieslijst', 'Lista de Sessões', 'รายการเซสชั่น', 'Oturumlar Listesi', 'سیشن کی فہرست', '会议列表'),
(263, 'session_settings', 'Session Settings', 'সেশন সেটিংস', 'إعدادات الجلسة', 'Paramètres de la session', 'सत्र सेटिंग', 'Pengaturan Sesi', 'Impostazioni sessione', 'セッション設定', '세션 설정', 'Sessie instellingen', 'Configurações da Sessão', 'การตั้งค่าเซสชัน', 'Oturum Ayarları', 'سیشن ترتیبات', '会话设置'),
(264, 'add_designation', 'Add Designation', 'পদবী যোগ করুন', 'إضافة تسمية', 'Ajouter une désignation', 'पदनाम जोड़ें', 'Tambahkan Penunjukan', 'Aggiungi designazione', '指定を追加する', '지정 추가', 'Aanwijzing toevoegen', 'Adicionar Designação', 'เพิ่มการกำหนด', 'İsmi Ekle', 'عہدہ شامل کریں', '添加名称'),
(265, 'users', 'Users', 'ব্যবহারকারীরা', 'المستخدمين', 'Utilisateurs', 'उपयोगकर्ता', 'Pengguna', 'utenti', 'ユーザー', '사용자', 'gebruikers', 'Comercial', 'ผู้ใช้', 'Kullanıcılar', 'صارفین', '用户'),
(266, 'librarian', 'Librarian', 'গ্রন্থাগারিক', 'أمين المكتبة', 'Bibliothécaire', 'पुस्तकालय अध्यक्ष', 'Pustakawan', 'Bibliotecario', '図書館員', '사서', 'Bibliothecaris', 'Bibliotecário', 'บรรณารักษ์', 'kütüphaneci', 'لائبریرین', '图书管理员'),
(267, 'accountant', 'Accountant', 'হিসাবরক্ষক', 'محاسب', 'Comptable', 'मुनीम', 'Akuntan', 'Contabile', '会計士', '회계사', 'Accountant', 'Contador', 'นักบัญชี', 'Muhasebeci', 'اکاؤنٹنٹ', '会计'),
(268, 'academics', 'Academics', 'বিদ্যালয় সংক্রান্ত', 'مؤسسيا', 'institutionnellement', 'संस्थागत', 'secara institusional', 'istituzionalmente', '制度的に', '제도적으로', 'institutioneel', 'institucionalmente', 'institutionally', 'kurumsal olarak', 'ادارہ', '体制'),
(269, 'employees_attendance', 'Employees Attendance', 'কর্মচারী উপস্থিতি', 'حضور الموظفين', 'Participation des employés', 'कर्मचारी उपस्थिति', 'Kehadiran karyawan', 'La presenza dei dipendenti', '従業員の出席', '직원 출석', 'Medewerkers aanwezigheid', 'Atendimento dos funcionários', 'การเข้าร่วมงานของพนักงาน', 'Çalışanlara katılım', 'ملازمین کی حاضری', '员工出勤'),
(270, 'set_exam_term', 'Set Exam Term', 'টার্ম সেট করুন', 'تعيين مدة الامتحان', 'Terminer l\'examen', 'परीक्षा अवधि सेट करें', 'Tetapkan Ujian Term', 'Impostare la durata dell&#39;esame', '試験期間を設定する', '시험 기간 설정', 'Stel examentermijn in', 'Definir Termo de Exame', 'กำหนดระยะเวลาการสอบ', 'Sınav Süresini Ayarlayın', 'امتحان کی مدت مقرر کریں', '设置考试期限'),
(271, 'set_attendance', 'Set Attendance', 'উপস্থিতি সেট করুন', 'تعيين الحضور', 'Assurer la fréquentation', 'उपस्थिति सेट करें', 'Tetapkan Kehadiran', 'Impostare la frequenza', '出席を設定する', '출석 설정', 'Set Attendance', 'Definir atendimento', 'ตั้งผู้เข้าร่วม', 'Katılımı ayarla', 'حاضری مقرر کریں', '设置考勤'),
(272, 'marks', 'Marks', 'মার্কস', 'علامات', 'Des notes', 'निशान', 'Tanda', 'votazione', 'マーク', '점수', 'Marks', 'Marcas', 'เครื่องหมาย', 'izler', 'نشانات', '分数'),
(273, 'books_category', 'Books Category', 'বই বিভাগ', 'فئة الكتاب', 'Catégorie de livres', 'पुस्तक श्रेणी', 'Kategori buku', 'Categoria di libri', 'ブックカテゴリ', '도서 카테고리', 'Boek categorie', 'Categoria de livro', 'หมวดหนังสือ', 'Kitap Kategorisi', 'کتاب کی قسم', '书类'),
(274, 'transport', 'Transport', 'পরিবহন', 'المواصلات', 'Transport', 'ट्रांसपोर्ट', 'Mengangkut', 'Trasporto', '輸送', '수송', 'Vervoer', 'Transporte', 'ขนส่ง', 'taşıma', 'نقل و حمل', '运输'),
(275, 'fees', 'Fees', 'ফি', 'رسوم', 'honoraires', 'फीस', 'Biaya', 'tasse', '手数料', '수수료', 'fees', 'honorários', 'ค่าธรรมเนียม', 'harç', 'فیس', '费用'),
(276, 'fees_allocation', 'Fees Allocation', 'ফি বরাদ্দকরণ', 'توزيع الرسوم', 'répartition des frais', 'शुल्क आवंटन', 'alokasi biaya', 'assegnazione dei diritti', '手数料の割り当て', '수수료 할당', 'verdeling van de vergoedingen', 'alocação de tarifas', 'การจัดสรรค่าธรรมเนียม', 'ücret tahsisi', 'فیس مختص', '费用分配'),
(277, 'fee_category', 'Fee Category', 'ফি বিভাগ', 'فئة الرسوم', 'Catégorie tarifaire', 'शुल्क श्रेणी', 'Kategori biaya', 'Categoria di tassa', '手数料カテゴリ', '수수료 카테고리', 'Tariefcategorie', 'Categoria de taxa', 'ประเภทค่าธรรมเนียม', 'Ücret kategorisi', 'فیس کی قسم', '费用类别'),
(278, 'report', 'Report', 'প্রতিবেদন', 'أبلغ عن', 'rapport', 'रिपोर्ट', 'melaporkan', 'rapporto', '報告する', '보고서', 'rapport', 'relatório', 'รายงาน', 'rapor', 'رپورٹ', '报告'),
(279, 'employee', 'Employee', 'কর্মচারী', 'الموظفين', 'employés', 'कर्मचारियों', 'para karyawan', 'dipendenti', '従業員', '직원', 'werknemers', 'Funcionários', 'พนักงาน', 'çalışanlar', 'ملازمین', 'ملازمین'),
(280, 'invoice', 'Invoice', 'চালান', 'فاتورة', 'facture d\'achat', 'बीजक', 'faktur', 'fattura', '請求書', '송장', 'factuur', 'fatura', 'ใบแจ้งหนี้', 'fatura', 'انوائس', '发票'),
(281, 'event_catalogue', 'Event Catalogue', 'ইভেন্ট ক্যাটালগ', 'كتالوج الأحداث', 'Catalogue des événements', 'इवेंट कैटलॉग', 'Katalog acara', 'Catalogo eventi', 'イベントカタログ', '이벤트 카탈로그', 'Event Catalogus', 'Catálogo de Eventos', 'แค็ตตาล็อกกิจกรรม', 'Etkinlik Kataloğu', 'واقعہ کی فہرست', '活动目录'),
(282, 'total_paid', 'Total Paid', 'মোট দেওয়া', 'مجموع المبالغ المدفوعة', 'Total payé', 'कुल भुगतान हो गया', 'Total Dibayar', 'Totale pagato', '支払総額', '총 지불액', 'Totaal betaald', 'Total pago', 'ทั้งหมดที่จ่าย', 'Toplam Ücretli', 'کل ادا شدہ', '总支付'),
(283, 'total_due', 'Total Due', 'মোট বাকি', 'الاجمالي المستحق', 'Total dû', 'कुल देय', 'Total Jatuh Tempo', 'Totale dovuto', '総額', '총 만기일', 'Totaal verschuldigd', 'Total Due', 'รวมครบกำหนด', 'Toplam Vade', 'کل کی وجہ سے', '总到期'),
(284, 'fees_collect', 'Fees Collect', 'ফি সংগ্রহ', 'تحصيل الرسوم', 'Frais collectés', 'फीस जमा करें', 'Biaya mengumpulkan', 'Le tasse si raccolgono', '手数料徴収', '수수료 징수', 'Vergoedingen verzamelen', 'Taxas cobradas', 'เก็บค่าธรรมเนียม', 'Ücret toplama', 'فیس جمع', '收费'),
(285, 'total_school_students_attendance', 'Total School Students Attendance', 'মোট স্কুলের ছাত্র উপস্থিতি', 'مجموع طلاب المدارس الحضور', 'Participation totale des étudiants', 'कुल विद्यालय के छात्रों की उपस्थिति', 'Total kehadiran siswa sekolah', 'La frequenza totale degli studenti delle scuole', '総学生就学', '총 학생 수강생', 'Totale schoolstudenten aanwezigheid', 'Total de frequência escolar', 'การเข้าเรียนของนักเรียนในโรงเรียนทั้งหมด', 'Toplam okul öğrencileri devam ediyor', 'کل اسکول کے طلباء حاضری', '全校学生出席'),
(286, 'overview', 'Overview', 'সংক্ষিপ্ত বিবরণ', 'نظرة عامة', 'Aperçu', 'अवलोकन', 'Ikhtisar', 'Panoramica', '概要', '개요', 'Overzicht', 'Visão geral', 'ภาพรวม', 'genel bakış', 'جائزہ', '概观'),
(287, 'currency_symbol', 'Currency Symbol', 'মুদ্রা প্রতীক', 'رمز العملة', 'symbole de la monnaie', 'मुद्रा प्रतीक', 'Simbol mata uang', 'Simbolo di valuta', '通貨記号', '통화 기호', 'symbool van munteenheid', 'Símbolo monetário', 'สัญลักษณ์สกุลเงิน', 'Para birimi sembolü', 'کرنسی علامت', '货币符号'),
(288, 'enable', 'Enable', 'সক্ষম করা', 'مكن', 'Activer', 'सक्षम करें', 'Memungkinkan', 'Abilitare', '有効にする', '사용', 'in staat stellen', 'Habilitar', 'ทำให้สามารถ', 'etkinleştirme', 'فعال', '启用'),
(289, 'disable', 'Disable', 'অক্ষম', 'تعطيل', 'Désactiver', 'अक्षम', 'Nonaktifkan', 'disattivare', '無効にする', '사용 안함', 'onbruikbaar maken', 'Desativar', 'ปิดการใช้งาน', 'Devre dışı', 'غیر فعال', '禁用'),
(290, 'payment_settings', 'Payment Settings', 'পেমেন্ট সেটিংস', 'إعدادات الدفع', 'Paramètres de paiement', 'भुगतान सेटिंग', 'Setelan Pembayaran', 'Impostazioni di pagamento', '支払い設定', '지불 설정', 'Betaalinstellingen', 'Configurações de pagamento', 'การตั้งค่าการชำระเงิน', 'Ödeme Ayarları', 'ادائیگی کی ترتیبات', '付款设置'),
(291, 'student_attendance_report', 'Student Attendance Report', 'ছাত্র উপস্থিতি রিপোর্ট', 'تقرير حضور الطالب', 'Rapport de présence étudiante', 'छात्र उपस्थिति रिपोर्ट', 'Laporan kehadiran siswa', 'Rapporto di frequenza degli studenti', '学生出席報告', '학생 출석 보고서', 'Studentenbijwoningsverslag', 'Relatório de atendimento ao aluno', 'รายงานการเข้าเรียนของนักเรียน', 'Öğrenci katılım raporu', 'طالب علم حاضری کی رپورٹ', '学生出勤报告'),
(292, 'attendance_type', 'Attendance Type', 'উপস্থিতি প্রকার', 'نوع الحضور', 'Type de présence', 'उपस्थिति प्रकार', 'Tipe kehadiran', 'Tipo di partecipazione', '出席タイプ', '출석 유형', 'Aanwezigheidstype', 'Tipo de atendimento', 'ประเภทการเข้างาน', 'Devam türü', 'حاضری کی قسم', '考勤类型'),
(293, 'late', 'Late', 'বিলম্বে', 'متأخر', 'En retard', 'देर से', 'Terlambat', 'in ritardo', '後期', '늦은', 'Laat', 'Atrasado', 'สาย', 'Geç', 'دیر', '晚了'),
(294, 'employees_attendance_report', 'Employees Attendance Report', 'কর্মচারী উপস্থিতি রিপোর্ট', 'الموظفين تقرير الحضور', 'Rapport de présence des employés', 'कर्मचारियों की उपस्थिति रिपोर्ट', 'Laporan kehadiran karyawan', 'Rapporto di presenza dei dipendenti', '従業員の出席レポート', '직원 출석 보고서', 'Medewerkers aanwezigheidsrapport', 'Relatório de comparecimento de funcionários', 'รายงานการเข้างานของพนักงาน', 'Çalışanlar katılım raporu', 'ملازمین کی حاضری کی رپورٹ', '员工出勤报告'),
(295, 'attendance_report_of', 'Attendance Report Of', 'উপস্থিতি রিপোর্ট', 'تقرير الحضور من', 'Rapport de présence de', 'उपस्थिति की रिपोर्ट', 'Laporan kehadiran', 'Relazione di partecipazione di', 'の出席報告書', '출석 보고서', 'Aanwezigheidsverslag van', 'Relatório de atendimento de', 'รายงานการเข้างานของ', 'Devam raporu', 'حاضری کی رپورٹ', '出席报告'),
(296, 'fee_paid_report', 'Fee Paid Report', 'ফি প্রদান প্রতিবেদন', 'الرسوم المدفوعة التقرير', 'Rapport payé payé', 'शुल्क भुगतान रिपोर्ट', 'Laporan biaya dibayar', 'Pagamento pagato rapporto', '報酬支払報告書', '유료 보고서', 'Betaald rapport', 'Relatório remunerado', 'รายงานค่าใช้จ่าย', 'Ücretli Ödenen Rapor', 'فیس ادا کی رپورٹ', '付费报酬'),
(297, 'invoice_no', 'Invoice No', 'চালান নং', 'رقم الفاتورة', 'Facture non', 'चालान नंबर', 'nomor faktur', 'fattura n', '請求書番号', '송장 번호', 'factuur nr', 'Factura não', 'หมายเลขใบแจ้งหนี้', 'Fatura no', 'انوائس نمبر', '发票号码'),
(298, 'payment_mode', 'Payment Mode', 'পরিশোধের মাধ্যম', 'طريقة الدفع', 'mode de paiement', 'भुगतान का प्रकार', 'Mode pembayaran', 'metodo di pagamento', '支払いモード', '지불 모드', 'betaalmethode', 'modo de pagamento', 'โหมดการชำระเงิน', 'ödeme şekli', 'ادائیگی کا طریقہ کار', '付款方式'),
(299, 'payment_type', 'Payment Type', 'পেমেন্ট টাইপ', 'نوع الدفع', 'type de paiement', 'भुगतान के प्रकार', 'tipe pembayaran', 'modalità di pagamento', '払いの種類', '지불 유형', 'betalingswijze', 'tipo de pagamento', 'ประเภทการชำระเงิน', 'ödeme türü', 'ادائیگی کی قسم', '付款方式'),
(300, 'done', 'Done', 'সম্পন্ন', 'فعله', 'terminé', 'किया हुआ', 'Selesai', 'fatto', '完了', '끝난', 'gedaan', 'feito', 'เสร็จแล้ว', 'tamam', 'کیا ہوا', '完成'),
(301, 'select_fee_category', 'Select Fee Category', 'ফি বিভাগ নির্বাচন করুন', 'حدد فئة الرسوم', 'Sélectionner la catégorie tarifaire', 'शुल्क श्रेणी का चयन करें', 'Pilih kategori biaya', 'Selezionare la categoria dei diritti', '選択料金カテゴリ', '요금 카테고리 선택', 'Selecteer de tariefcategorie', 'Categoria de taxa selecionada', 'เลือกหมวดค่าธรรมเนียม', 'Ücret kategorisini seçin', 'فیس کی قسم منتخب کریں', '选择费用类别'),
(302, 'discount', 'Discount', 'ডিসকাউন্ট', 'خصم', 'remise', 'छूट', 'diskon', 'sconto', 'ディスカウント', '할인', 'korting', 'desconto', 'ส่วนลด', 'indirim', 'ڈسکاؤنٹ', '折扣'),
(303, 'enter_discount_amount', 'Enter Discount Amount', 'ছাড়ের পরিমাণ লিখুন', 'أدخل مبلغ الخصم', 'Saisir un montant d\'escompte', 'डिस्काउंट राशि दर्ज करें', 'Masukkan jumlah diskon', 'Inserire l\'importo del sconto', '割引額を入力', '할인 금액을 입력하십시오.', 'Vul kortingsbedrag in', 'Insira valor de desconto', 'ป้อนจำนวนเงินส่วนลด', 'Indirim tutarını gir', 'ڈسکاؤنٹ رقم درج کریں', '输入折扣金额'),
(304, 'online_payment', 'Online Payment', 'দূরবর্তী অর্থ প্রদান', 'الدفع عن بعد', 'Paiement à distance', 'रिमोट भुगतान', 'Pembayaran Jarak Jauh', 'Pagamento remoto', '遠隔支払い', '원격 지불', 'Afhankelijk van de betaling', 'Pagamento Remoto', 'การชำระเงินระยะไกล', 'Uzaktan Ödeme', 'ریموٹ ادائیگی', '远程付款'),
(305, 'student_name', 'Student Name', 'শিক্ষার্থীর নাম', 'أسم الطالب', 'nom d\'étudiant', 'छात्र का नाम', 'nama siswa', 'nome dello studente', '学生の名前', '학생 이름', 'studenten naam', 'nome do aluno', 'ชื่อนักเรียน', 'Öğrenci adı', 'طالب علم کا نام', '学生姓名'),
(306, 'invoice_history', 'Invoice History', 'চালান ইতিহাস', 'تاريخ الفاتورة', 'Historique des factures', 'चालान का इतिहास', 'Riwayat faktur', 'La cronologia delle fatture', '請求書履歴', '송장 내역', 'Factuurgeschiedenis', 'Histórico de faturamento', 'ประวัติใบแจ้งหนี้', 'Fatura geçmişi', 'انوائس کی تاریخ', '发票历史记录'),
(307, 'discount_amount', 'Discount Amount', 'হ্রাসকৃত মুল্য', 'مقدار الخصم', 'Montant de l\'escompte', 'छूट राशि', 'jumlah diskon', 'totale sconto', '割引額', '할인 금액', 'korting hoeveelheid', 'Valor do desconto', 'จำนวนส่วนลด', 'indirim tutarı', 'ڈسکاؤنٹ رقم', '折扣金额'),
(308, 'invoice_list', 'Invoice List', 'চালান তালিকা', 'قائمة الفاتورة', 'Liste des factures', 'चालान सूची', 'Daftar faktur', 'Elenco delle fatture', '請求書一覧', '송장 목록', 'Factuurlijst', 'Lista de faturamento', 'รายการใบแจ้งหนี้', 'Fatura listesi', 'رسید کی فہرست', '发票清单'),
(309, 'partly_paid', 'Partly Paid', 'আংশিক পরিশোধিত', 'تدفع جزئيا', 'En partie payé', 'आंशिक रूप से भुगतान किया', 'Sebagian dibayar', 'Parzialmente pagato', '部分的に支払われた', '부분적으로 지불 된', 'Gedeeltelijk betaald', 'Parcialmente pago', 'จ่ายบางส่วน', 'Kısmen ödenmiş', 'جزوی طور پر ادا کیا', '部分支付'),
(310, 'fees_list', 'Fees List', 'ফি তালিকা', 'قائمة الرسوم', 'Liste des frais', 'शुल्क सूची', 'Daftar biaya', 'Lista dei diritti', '手数料リスト', '수수료 목록', 'Kostenlijst', 'Lista de tarifas', 'รายการค่าธรรมเนียม', 'Ücret listesi', 'فیس کی فہرست', '费用清单'),
(311, 'voucher_id', 'Voucher ID', 'ভউচার আইডি', 'معرف القسيمة', 'Id de bon', 'वाउचर आईडी', 'voucher Id', 'Voucher Id', 'バウチャーID', '쿠폰 ID', 'Voucher id', 'Id do vale', 'รหัสบัตรกำนัล', 'Kupon kimliği', 'واؤچر کی شناخت', '凭证ID'),
(312, 'transaction_date', 'Transaction Date', 'লেনদেন তারিখ', 'تاريخ الصفقة', 'transaction date', 'लेन - देन की तारीख', 'tanggal transaksi', 'Data di transazione', '取引日取引日', '거래 날짜', 'transactie datum', 'Data da transação', 'วันที่ทำรายการ', 'İşlem Tarihi', 'ٹرانزیکشن کی تاریخ', '交易日期'),
(313, 'admission_date', 'Admission Date', 'ভর্তির তারিখ', 'تاريخ القبول', 'admission date', 'प्रवेश तिथि', 'Tanggal masuk', 'data di ammissione', '入学日', '입학시기', 'toelatingsdatum', 'data de admissão', 'วันที่เข้าเรียน', 'Kabul tarihi', 'داخلہ کی تاریخ', '入学日期'),
(314, 'user_status', 'User Status', 'ব্যবহারকারীর স্থিতি', 'حالة المستخدم', 'Statut de l\'utilisateur', 'उपयोगकर्ता की स्थिति', 'User Status', 'Stato dell\'utente', 'ユーザーステータス', '사용자 상태', 'Gebruikers status', 'Status do usuário', 'สถานะผู้ใช้', 'Kullanıcı durumu', 'صارف کی حیثیت', '用户状态'),
(315, 'nationality', 'Nationality', 'জাতীয়তা', 'جنسية', 'nationalité', 'राष्ट्रीयता', 'kebangsaan', 'nazionalità', '国籍', '국적', 'nationaliteit', 'nacionalidade', 'สัญชาติ', 'milliyet', 'قومیت', '国籍'),
(316, 'register_no', 'Register No', 'রেজিস্টার নং', 'سجل رقم', 'Inscrivez-vous non', 'रजिस्टर नं', 'Daftar no', 'Registrare n', '登録番号', '등록 번호', 'Registratienummer', 'Não registre', 'ลงทะเบียนไม่', 'Kayıt yok', 'رجسٹر نمبر', '注册号'),
(317, 'first_name', 'First Name', 'প্রথম নাম', 'الاسم الاول', 'Prénom', 'पहला नाम', 'nama depan', 'nome di battesimo', 'ファーストネーム', '이름', 'Voornaam', 'primeiro nome', 'ชื่อจริง', 'İsim', 'پہلا نام', '名字'),
(318, 'last_name', 'Last Name', 'নামের শেষাংশ', 'الكنية', 'nom de famille', 'अंतिम नाम', 'nama keluarga', 'cognome', '苗字', '성', 'achternaam', 'último nome', 'นามสกุล', 'soyadı', 'آخری نام', '姓'),
(319, 'state', 'State', 'রাষ্ট্র', 'حالة', 'Etat', 'राज्य', 'negara', 'stato', '状態', '상태', 'staat', 'Estado', 'สถานะ', 'belirtmek, bildirmek', 'حالت', '州'),
(320, 'transport_vehicle_no', 'Transport Vehicle No', 'পরিবহন যানবাহন নং', 'رقم مركبة النقل', 'Véhicule de transport no', 'ट्रांसपोर्ट व्हीकल नं', 'Kendaraan Transportasi No', 'Veicolo di trasporto n', '輸送車両', '운송 차량 번호', 'Transportvoertuig Nr', 'Transport Vehicle No', 'ยานพาหนะขนส่ง', 'Taşıma Aracı No', 'ٹرانسپورٹ گاڑیاں نمبر', '运输车辆号'),
(321, 'percent', 'Percent', 'শতাংশ', 'نسبه مئويه', 'pour cent', 'प्रतिशत', 'persen', 'per cento', 'パーセント', '퍼센트', 'procent', 'por cento', 'เปอร์เซ็นต์', 'yüzde', 'فیصد', '百分'),
(322, 'average_result', 'Average Result', 'গড় ফলাফল', 'متوسط ​​النتيجة', 'Résultat moyen', 'औसत परिणाम', 'Hasil rata-rata', 'Risultato medio', '平均結果', '평균 결과', 'Gemiddeld resultaat', 'Resultado médio', 'ผลเฉลี่ย', 'Ortalama sonuç', 'اوسط نتیجہ', '平均结果'),
(323, 'student_category', 'Student Category', 'ছাত্র বিভাগ', 'طالب', 'Catégorie étudiante', 'छात्र श्रेणी', 'Kategori siswa', 'Categoria studente', '学生カテゴリ', '학생 분류', 'Studentencategorie', 'Categoria de estudante', 'หมวดหมู่นักศึกษา', 'Öğrenci kategorisi', 'طالب علم کی قسم', '学生类别'),
(324, 'category_name', 'Category Name', 'বিভাগ নাম', 'اسم التصنيف', 'Nom de catégorie', 'श्रेणी नाम', 'Nama kategori', 'Nome della categoria', '種別名', '카테고리 이름', 'categorie naam', 'Nome da Categoria', 'ชื่อหมวดหมู่', 'Kategori adı', 'زمرہ کا نام', '分类名称'),
(325, 'category_list', 'Category List', 'বিভাগ তালিকা', 'قائمة الفئات', 'Liste des catégories', 'श्रेणी सूची', 'Daftar kategori', 'Elenco categorie', 'カテゴリリスト', '카테고리 목록', 'Categorie lijst', 'Lista de categorias', 'รายการหมวดหมู่', 'Kategori listesi', 'زمرہ کی فہرست', '类别列表'),
(326, 'please_select_student_first', 'Please Select Students First', 'প্রথমে ছাত্রদের দয়া করে নির্বাচন করুন', 'يرجى اختيار الطلاب أولا', 'S\'il vous plaît sélectionner les étudiants de première', ' कृपया पहले छात्रों का चयन करें', 'Kérjük, először válassza ki a diákokat', 'Per favore seleziona gli studenti prima', '最初に生徒を選択してください', '먼저 학생을 선택하십시오.', 'Kies alsjeblieft eerst de leerlingen', 'Selecione os alunos primeiro', 'โปรดเลือกนักเรียนก่อน', 'Lütfen önce öğrencileri seç', 'سب سے پہلے طالب علموں کو منتخب کریں', '请先选择学生'),
(327, 'designation', 'Designation', 'উপাধি', 'تعيين', 'La désignation', 'पद', 'Penunjukan', 'Designazione', '指定', '지정', 'Aanwijzing', 'Designação', 'การแต่งตั้ง', 'tayin', 'عہدہ', '指定'),
(328, 'qualification', 'Qualification', 'যোগ্যতা', 'المؤهل', 'Qualification', 'योग्यता', 'Kualifikasi', 'Qualificazione', '資格', '자격', 'Kwalificatie', 'Qualificação', 'คุณสมบัติ', 'Vasıf', 'اہلیت', '合格'),
(329, 'account_deactivated', 'Account Deactivated', 'অ্যাকাউন্ট নিষ্ক্রিয়', 'تم إلغاء تنشيط الحساب', 'Compte désactivé', 'खाता निष्क्रिय', 'Akun dinonaktifkan', 'Account disattivato', 'アカウントが無効になった', '계정이 비활성화되었습니다.', 'Account gedeactiveerd', 'Conta desativada', 'ปิดใช้งานบัญชีแล้ว', 'Hesap devre dışı', 'اکاؤنٹ غیر فعال ہے', '帐户已停用'),
(330, 'account_activated', 'Account Activated', 'অ্যাকাউন্ট সক্রিয়', 'تم تنشيط الحساب', 'Compte activé', 'खाते सक्रिय', 'Akun diaktifkan', 'Account attivato', 'Account attivato', '계정 활성화 됨', 'Account geactiveerd', 'Conta ativada', 'เปิดใช้งานบัญชีแล้ว', 'Hesap etkinleştirildi', 'اکاؤنٹ چالو', '帐户已激活'),
(331, 'designation_list', 'Designation List', 'পদবী তালিকা', 'قائمة التعيين', 'Liste de désignation', 'पदनाम सूची', 'Daftar Penunjukan', 'Elenco descrizioni', '指定リスト', '지정 명부', 'Benaming', 'Lista de designação', 'รายชื่อ', 'Belirleme Listesi', 'عہدہ کی فہرست', '名单'),
(332, 'joining_date', 'Joining Date', 'যোগদান তারিখ', 'تاريخ الانضمام', 'Date d\'inscription', 'कार्यग्रहण तिथि', 'Tanggal Bergabung', 'Data di adesione', '参加日', '가입 날짜', 'Aansluitingsdatum', 'Data de ingresso', 'วันที่เข้าร่วม', 'Birleştirme Tarihi', 'تاریخ میں شمولیت', '入职日期'),
(333, 'relation', 'Relation', 'সম্পর্ক', 'علاقة', 'Relation', 'रिश्ता', 'Hubungan', 'Relazione', '関係', '관계', 'Relatie', 'Relação', 'ความสัมพันธ์', 'ilişki', 'تعلقات', '关系'),
(334, 'father_name', 'Father Name', 'বাবার নাম', 'اسم الأب', 'nom du père', 'पिता का नाम', 'nama ayah', 'nome del padre', '父の名前', '아버지의 이름', 'Vader naam', 'nome do pai', 'ชื่อบิดา', 'baba adı', 'والد کا نام', '父亲姓名'),
(335, 'librarian_list', 'Librarian List', 'গ্রন্থাগারিক তালিকা', 'قائمة أمين المكتبة', 'Liste des bibliothécaires', 'लाइब्रेरियन लिस्ट', 'Daftar Pustakawan', 'Lista bibliotecaria', '図書館員リスト', '사서 목록', 'Bibliothecarislijst', 'Lista de bibliotecários', 'รายชื่อบรรณารักษ์', 'Kütüphaneci listesi', 'لائبریری کی فہرست', '图书馆员名单'),
(336, 'class_numeric', 'Class Numeric', 'ক্লাস সাংখ্যিক', 'فئة رقمية', 'Classe Numérique', 'कक्षा संख्यात्मक', 'Kelas Numerik', 'Class Numerico', 'クラス数値', '클래스 숫자', 'Class Numeric', 'Classe Numérica', 'Class Numeric', 'Sayısal Sınıf', 'کلاس نمبر', '类数字'),
(337, 'maximum_students', 'Maximum Students', 'সর্বোচ্চ ছাত্র', 'الحد الأقصى للطلاب', 'Maximum d\'étudiants', 'अधिकतम छात्र', 'Siswa Maksimal', 'Studenti massimi', '最大生徒数', '최대 학생수', 'Maximale Studenten', 'Alunos máximos', 'นักเรียนสูงสุด', 'Maksimum Öğrenci', 'زیادہ سے زیادہ طلباء', '最大学生'),
(338, 'class_room', 'Class Room', 'ক্লাস রুমে', 'قاعة الدراسة', 'Salle de classe', 'कक्षा के कमरे', 'kelas', 'aula', 'クラスルーム', '교실', 'Klaslokaal', 'Sala de aula', 'ห้องเรียน', 'Sınıf oda', 'کلاس روم', '课室'),
(339, 'pass_mark', 'Pass Mark', 'পাশ নম্বর', 'علامة المرور', 'moyenne', 'उतीर्णांक', 'kelulusan', 'punteggio minimo', 'パスマーク', '통과 표시', 'Pass markeren', 'Marca de aprovação', 'เครื่องหมายผ่าน', 'Geçme notu', 'کامیابی کے نمبر', '合格标志'),
(340, 'exam_time', 'Exam Time (Min)', 'পরীক্ষার সময় (মিনিট)', 'وقت الامتحان', 'Temps d\'examen (min)', 'परीक्षा का समय', 'waktu ujian', 'Tempo di esame', '試験時間', '시험 시간', 'examentijd', 'hora da prova', 'เวลาสอบ', 'sınav zamanı', 'امتحان کا وقت', '考试时间'),
(341, 'time', 'Time', 'সময়', 'زمن', 'temps', 'पहर', 'waktu', 'tempo', '時間', '시각', 'tijd', 'Tempo', 'เวลา', 'zaman', 'وقت', '时间'),
(342, 'subject_code', 'Subject Code', 'বিষয় কোড', 'رمز الموضوع', 'Code du sujet', 'विषय संहिता', 'Kode subjek', 'Codice oggetto', 'テーマコード', '제목 코드', 'Vakcode', 'Código do assunto', 'รหัสหัวเรื่อง', 'Konu Kodu', 'موضوع کا کوڈ', '主题代码'),
(343, 'full_mark', 'Full Mark', 'পুরো নম্বর', 'درجة كاملة', 'Pleine marque', 'पूर्ण अंक', 'Tanda penuh', 'Full Mark', '満点', '만점', 'Full Mark', 'Nota máxima', 'เครื่องหมายเต็มรูปแบบ', 'Tam not', 'مکمل نشان', '满分'),
(344, 'subject_type', 'Subject Type', 'বিষয় প্রকার', 'نوع الموضوع', 'Type de sujet', 'विषय प्रकार', 'Tipe subjek', 'Tipo di soggetto', 'サブジェクトタイプ', '주제 유형', 'Onderwerp type', 'Tipo de assunto', 'ประเภทของเรื่อง', 'Konu türü', 'موضوع کی قسم', '主题类型'),
(345, 'date_of_publish', 'Date Of Publish', 'প্রকাশের তারিখ', 'تاريخ النشر', 'Date de publication', 'प्रकाशित की तिथि', 'Tanggal Publikasikan', 'Data di pubblicazione', '出版の日付', '게시 날짜', 'Datum van publicatie', 'Data de publicação', 'วันที่เผยแพร่', 'Yayın Tarihi', 'شائع کی تاریخ', '发布日期'),
(346, 'file_name', 'File Name', 'ফাইলের নাম', 'اسم الملف', 'Nom de fichier', 'फ़ाइल का नाम', 'Nama file', 'Nome del file', 'ファイル名', '파일 이름', 'Bestandsnaam', 'Nome do arquivo', 'ชื่อไฟล์', 'Dosya adı', 'فائل کا نام', '文件名'),
(347, 'students_list', 'Students List', 'ছাত্র তালিকা', 'قائمة الطلاب', 'Liste des étudiants', 'छात्र सूची', 'Daftar siswa', 'Lista degli studenti', '学生リスト', '학생 목록', 'Studentenlijst', 'Lista de Estudantes', 'รายชื่อนักเรียน', 'Öğrenci Listesi', 'طلباء کی فہرست', '学生名单'),
(348, 'start_date', 'Start Date', 'শুরুর তারিখ', 'تاريخ البدء', 'Date de début', 'आरंभ करने की तिथि', 'Mulai tanggal', 'Data d\'inizio', '開始日', '시작 날짜', 'Begin datum', 'Data de início', 'วันที่เริ่มต้น', 'Başlangıç ​​tarihi', 'شروع کرنے کی تاریخ', '开始日期'),
(349, 'end_date', 'End Date', 'শেষ তারিখ', 'تاريخ الانتهاء', 'End Date', 'अंतिम तिथि', 'Tanggal akhir', 'Data di fine', '終了日', '종료일', 'Einddatum', 'Data final', 'วันที่สิ้นสุด', 'Bitiş tarihi', 'آخری تاریخ', '结束日期'),
(350, 'term_name', 'Term Name', 'টার্ম নাম', 'اسم المدى', 'Nom du terme', 'शब्द का नाम', 'Nama istilah', 'Termine nome', '用語の名前', '학기명', 'Termnaam', 'Nome do termo', 'ชื่อย่อ', 'Dönem adı', 'اصطلاح نام', '术语名称'),
(351, 'grand_total', 'Grand Total', 'সর্বমোট', 'المبلغ الإجمالي', 'Grand Total', 'कुल योग', 'Total keseluruhan', 'Somma totale', '総計', '총 합계', 'Eindtotaal', 'Total geral', 'ผลรวมทั้งสิ้น', 'Genel Toplam', 'مجموعی عدد', '累计'),
(352, 'result', 'Result', 'ফল', 'نتيجة', 'Résultat', 'परिणाम', 'Hasil', 'Risultato', '結果', '결과', 'Resultaat', 'Resultado', 'ผล', 'Sonuç', 'نتیجہ', '结果'),
(353, 'books_list', 'Books List', 'বই তালিকা', 'قائمة الكتب', 'Liste des livres', 'पुस्तकें सूची', 'Daftar Buku', 'Elenco libri', '書籍一覧', '도서 목록', 'Boekenlijst', 'Lista de livros', 'รายการหนังสือ', 'Kitap Listesi', 'کتب کی فہرست', '图书列表'),
(354, 'book_isbn_no', 'Book ISBN No', 'বই ISBN নং', 'كتاب رقم إيسبن رقم', 'Livre numéro ISBN', 'पुस्तक आईएसबीएन नंबर', 'Buku ISBN no', 'Libro ISBN n', '本ISBN no', 'ISBN no book', 'Boek ISBN nr', 'ISBN do livro', 'หนังสือ ISBN no', 'Kitap ISBN no', 'کتاب ISBN نمبر', '书ISBN号'),
(355, 'total_stock', 'Total Stock', 'মোট স্টক', 'إجمالي الأسهم', 'Total Stock', 'कुल स्टॉक', 'Jumlah Saham', 'Totale azioni', '総在庫', '총 주식', 'Totaal voorraad', 'Total Stock', 'รวมสต็อค', 'Toplam Stok', 'کل اسٹاک', '总库存'),
(356, 'issued_copies', 'Issued Copies', 'ইস্যু করা কপি', 'تم إصدار نسخ', 'Copies émises', 'जारी की गई प्रतियां', 'Salinan yang Diterbitkan', 'Copie emesse', '発行されたコピー', '발행 된 사본', 'Uitgegeven kopieën', 'Cópias Emitidas', 'ออกสำเนา', 'Çıkarılan Kopyalar', 'تاریخ اشاعت شدہ', '发行副本'),
(357, 'publisher', 'Publisher', 'প্রকাশক', 'الناشر', 'éditeur', 'प्रकाशक', 'penerbit', 'editore', '出版社', '발행자', 'uitgever', 'editor', 'สำนักพิมพ์', 'Yayımcı', 'پبلیشر', '出版者'),
(358, 'books_issue', 'Books Issue', 'বই ইস্যু', 'كتاب المسألة', 'Problème de livre', 'पुस्तक अंक', 'Penerbitan buku', 'Emissione del libro', '書籍の問題', '도서 문제', 'Boekprobleem', 'Problema do livro', 'ฉบับหนังสือ', 'Kitap Numarası', 'کتاب کا مسئلہ', '图书问题'),
(359, 'user', 'User', 'ব্যবহারকারী', 'المستعمل', 'Utilisateur', 'उपयोगकर्ता', 'Pengguna', 'Utente', 'ユーザー', '사용자', 'Gebruiker', 'Do utilizador', 'ผู้ใช้งาน', 'kullanıcı', 'صارف', '用户'),
(360, 'fine', 'Fine', 'জরিমানা', 'غرامة', 'Bien', 'ठीक', 'Baik', 'Fine', 'ファイン', '벌금', 'denique', 'Bem', 'ละเอียด', 'İnce', 'ٹھیک', '精细'),
(361, 'pending', 'Pending', 'অনিষ্পন্ন', 'قيد الانتظار', 'en attendant', 'अपूर्ण', 'Tertunda', 'in attesa di', '保留中', '계류중인', 'in afwachting', 'pendente', 'อยู่ระหว่างดำเนินการ', 'kadar', 'زیر التواء', '有待'),
(362, 'return_date', 'Return Date', 'প্রত্যাবর্তন তারিখ', 'تاريخ العودة', 'date de retour', 'वापसी की तिथि', 'tanggal pengembalian', 'data di ritorno', '返却日', '반환 기일', 'retourdatum', 'data de retorno', 'วันที่กลับ', 'dönüş tarihi', 'واپسی کی تاریخ', '归期'),
(363, 'accept', 'Accept', 'গ্রহণ করা', 'قبول', 'Acceptez', 'स्वीकार करना', 'menerima', 'accettare', '受け入れる', '받아 들인다', 'accepteren', 'aceitar', 'ยอมรับ', 'kabul etmek', 'قبول کرو', '接受'),
(364, 'reject', 'Reject', 'প্রত্যাখ্যান', 'رفض', 'rejeter', 'अस्वीकार', 'menolak', 'rifiutare', '拒否する', '받지 않다', 'afwijzen', 'rejeitar', 'ปฏิเสธ', 'reddetmek', 'رد کرنا', '拒绝'),
(365, 'issued', 'Issued', 'ইস্যু করা', 'نشر', 'Publié', 'जारी किए गए', 'Dikabarkan', 'Rilasciato', '発行済み', '발행 된', 'Uitgegeven', 'Emitido', 'ออก', 'Veriliş', 'جاری کردیا گیا', '发行'),
(366, 'return', 'Return', 'প্রত্যাবর্তন', 'إرجاع', 'Revenir', 'वापसी', 'Kembali', 'Ritorno', '戻る', '반환', 'terugkeer', 'Retorna', 'กลับ', 'Dönüş', 'واپس لو', '返回'),
(367, 'renewal', 'Renewal', 'পুনরারম্ভ', 'تجديد', 'renouvellement', 'नवीकरण', 'pembaruan', 'rinnovo', '更新', '갱신', 'vernieuwing', 'renovação', 'การฟื้นฟู', 'yenileme', 'تجدید', '复兴'),
(368, 'fine_amount', 'Fine Amount', 'জরিমানা পরিমাণ', 'كمية غرامة', 'Montant fin', 'ठीक राशि', 'Jumlah denda', 'Ammontare fine', '微量', '좋은 금액', 'Fijne hoeveelheid', 'Quantidade fina', 'จำนวนเงินที่เหมาะสม', 'Ince miktar', 'جرمانے کی رقم', '罚款'),
(369, 'password_mismatch', 'Password Mismatch', 'পাসওয়ার্ড মেলেনি', 'عدم تطابق كلمة المرور', 'Incompatibilité de mot de passe', 'पासवर्ड बेमेल', 'Sandi ketidakcocokan', 'Mancata corrispondenza delle password', 'パスワードの不一致', '암호 불일치', 'Wachtwoord Mismatch', 'Incompatibilidade de senha', 'รหัสผ่านไม่ตรงกัน', 'Parola uyuşmazlığı', 'پاس ورڈ غیر مشابہ', '密码不匹配'),
(370, 'settings_updated', 'Settings Update', 'সেটিংস আপডেট করুন', 'تحديث الإعدادات', 'Mise à jour de paramètres', 'सेटिंग्स अद्यतन', 'Update pengaturan', 'Aggiornamento delle impostazioni di', '設定の更新', '설정 업데이트', 'Instellingen Update', 'Atualização de configurações', 'ปรับปรุงการตั้งค่า', 'Ayarları güncelleştirme', 'سیٹنگیں تازہ کاری کریں', '更新设置'),
(371, 'pass', 'Pass', 'পাস', 'البشري', 'passer', 'उत्तीर्ण करना', 'lulus', 'passaggio', 'パス', '패스', 'slagen voor', 'slagen voor', 'ผ่านไป', 'pas', 'پاس', '通过'),
(372, 'event_to', 'Event To', 'ইভেন্টের জন্য', 'الحدث ل', 'Événement à', 'घटना के लिए', 'Acara ke', 'Evento a', '〜へのイベント', '~에 이벤트', 'Evenement naar', 'Evento para', 'เหตุการณ์ไป', 'Olaya', 'واقعہ', '事件到'),
(373, 'all_users', 'All Users', 'সকল ব্যবহারকারী', 'جميع المستخدمين', 'tous les utilisateurs', 'सभी उपयोगकर्ताओं', 'minden felhasználó', 'tutti gli utenti', 'すべてのユーザー', '모든 사용자들', 'alle gebruikers', 'todos os usuários', 'ผู้ใช้ทั้งหมด', 'tüm kullanıcılar', 'تمام صارفین', '全部用户'),
(374, 'employees_list', 'Employees List', 'কর্মচারী তালিকা', 'قائمة الموظفين', 'Liste des employés', 'कर्मचारियों की सूची', 'Daftar karyawan', 'Elenco dei dipendenti', '従業員リスト', '직원 목록', 'Werknemers lijst', 'Lista de funcionários', 'รายชื่อพนักงาน', 'Çalışanların listesi', 'ملازمین کی فہرست', '员工名单'),
(375, 'on', 'On', 'উপর', 'على', 'sur', 'पर', 'di', 'sopra', 'に', '...에', 'op', 'em', 'บน', 'üzerinde', 'پر', '上'),
(376, 'timezone', 'Timezone', 'সময় অঞ্চল', 'وحدة زمنية', 'fuseau horaire', 'समय क्षेत्र', 'zona waktu', 'fuso orario', 'タイムゾーン', '시간대', 'tijdzone', 'fuso horário', 'เขตเวลา', 'saat dilimi', 'ٹائم زون', '时区'),
(377, 'get_result', 'Get Result', 'ফলাফল পেতে', 'الحصول على نتيجة', 'Obtenir un résultat', 'परिणाम प्राप्त करें', 'Mendapatkan hasil', 'Ottenere il risultato', '結果を得る', '결과를 얻다', 'Resultaat krijgen', 'Obter resultado', 'ได้ผลลัพธ์', 'Sonuç almak', 'نتائج حاصل کریں', '得到结果'),
(378, 'apply', 'Apply', 'প্রয়োগ করা', 'تطبيق', 'appliquer', 'लागू करें', 'menerapkan', 'applicare', '適用する', '대다', 'van toepassing zijn', 'Aplique', 'ใช้', 'uygulamak', 'لاگو کریں', '应用'),
(379, 'hrm', 'Human Resource', 'মানব সম্পদ', 'الموارد البشرية', 'ressource humaine', 'मानव संसाधन', 'sumber daya manusia', 'risorse umane', '人的資源', '인적 자원', 'menselijke hulpbronnen', 'recursos humanos', 'Hr / payroll', 'ทรัพยากรบุคคล', 'انسانی وسائل', '人力资源'),
(380, 'payroll', 'Payroll', 'বেতনের', 'كشف رواتب', 'paie', 'पेरोल', 'daftar gaji', 'libro paga', '給与計算', '급여', 'loonlijst', 'folha de pagamento', 'บัญชีเงินเดือน', 'maaş bordrosu', 'تنخواہ', '工资表'),
(381, 'salary_assign', 'Salary Assign', 'বেতন বরাদ্দ', 'مراقبة الرواتب', 'Contrôle des salaires', 'वेतन नियंत्रण', 'Kontrol gaji', 'Controllo dello stipendio', '給与管理', '급여 관리', 'Looncontrole', 'Controle salarial', 'การควบคุมเงินเดือน', 'Maaş kontrolü', 'تنخواہ کا کنٹرول', '工资控制'),
(382, 'employee_salary', 'Payment Salary', 'পেমেন্ট বেতন', 'دفع الراتب', 'Salaire de paiement', 'भुगतान वेतन', 'Gaji gaji', 'Salario del pagamento', '給与給与', '지불 급여', 'Betalingsloon', 'Salário de pagamento', 'เงินเดือน', 'Ödeme maaşı', 'ادائیگی تنخواہ', '支付工资'),
(383, 'application', 'Application', 'আবেদন', 'الوضعية', 'application', 'आवेदन', 'aplikasi', 'applicazione', '応用', '신청', 'toepassing', 'aplicação', 'ใบสมัคร', 'uygulama', 'درخواست', '应用'),
(384, 'award', 'Award', 'পুরস্কার', 'جائزة', 'prix', 'पुरस्कार', 'menghadiahkan', 'premio', '賞', '장학금', 'onderscheiding', 'Prêmio', 'รางวัล', 'ödül', 'ایوارڈ', '奖'),
(385, 'basic_salary', 'Basic Salary', 'মূল বেতন', 'راتب اساسي', 'salaire de base', 'मूल वेतन', 'gaji pokok', 'salario di base', '基本給', '기본 급여', 'basis salaris', 'salário básico', 'เงินเดือนทั่วไป', 'temel maaş', 'بنیادی تنخواہ', '基础工资'),
(386, 'employee_name', 'Employee Name', 'কর্মকর্তার নাম', 'اسم الموظف', 'Nom de l\'employé', 'कर्मचारी का नाम', 'nama karyawan', 'Nome dipendente', '従業員名', '직원 이름', 'Naam werknemer', 'nome do empregado', 'ชื่อพนักงาน', 'Çalışan Adı', 'ملازم کا نام', '员工姓名'),
(387, 'name_of_allowance', 'Name Of Allowance', 'ভাতা নাম', 'اسم البدل', 'nom de l\'allocation', 'भत्ता का नाम', 'Nama tunjangan', 'nome dell\'indennità', '手当の名', '수당 명', 'Naam van de toelage', 'Nome do subsídio', 'ชื่อเบี้ยเลี้ยง', 'Ödenek adı', 'الاؤنس کا نام', '津贴名称'),
(388, 'name_of_deductions', 'Name Of Deductions', 'কর্তনের নাম', 'اسم الاستقطاعات', 'Nom des déductions', 'कटौती का नाम', 'Nama deduksi', 'Nome delle deduzioni', '控除名', '공제 명', 'Naam van aftrek', 'Nome das deduções', 'ชื่อของการหักเงิน', 'Kesintilerin adı', 'کٹوتیوں کا نام', '扣除名称'),
(389, 'all_employees', 'All Employees', 'সমস্ত কর্মচারী', 'كل الموظفين', 'tous les employés', 'सभी कर्मचारी', 'semua pegawai', 'tutti gli impiegati', '全従業員', '모든 직원', 'alle werknemers', 'todos os empregados', 'พนักงานทั้งหมด', 'tüm çalışanlar', 'تمام ملازمین', '所有员工'),
(390, 'total_allowance', 'Total Allowance', 'মোট ভাতা', 'مجموع المخصصات', 'Allocation totale', 'कुल भत्ता', 'Total tunjangan', 'Indennità totale', '合計手当', '총 수당', 'Totale toelage', 'Subsídio total', 'เบี้ยประชุม', 'Toplam ödenek', 'مجموعی الاؤنس', '总额'),
(391, 'total_deduction', 'Total Deductions', 'মোট কর্তন', 'مجموع الخصومات', 'le total des déductions', 'कुल कटौती', 'Total deduksi', 'deduzione totale', '総控除額', '총 공제액', 'totale inhoudingen', 'deduções totais', 'การหักเงินทั้งหมด', 'Toplam kesintiler', 'کل کٹوتی', '总扣除额'),
(392, 'net_salary', 'Net Salary', 'মোট বেতন', 'صافي الراتب', 'salaire net', 'कुल वेतन', 'gaji bersih', 'Salario netto', '純給与', '순 급여', 'netto salaris', 'salário líquido', 'เงินเดือนสุทธิ', 'net maaş', 'خالص تنخواہ', '净薪水'),
(393, 'payslip', 'Payslip', 'স্লিপে', 'قسيمة الدفع', 'Payslip', 'payslip', 'Payslip', 'busta paga', 'ペイプルップ', 'Payslip', 'loonstrook', 'Pague basculante', 'payslip', 'maaş bordrosu', 'پیرسپ', '工资单'),
(394, 'days', 'Days', 'দিন', 'أيام', 'journées', 'दिन', 'Hari', 'giorni', '日々', '일', ' dagen', 'dias', 'วัน', 'günler', 'دن', '天'),
(395, 'category_name_already_used', 'Category Name Already Used', 'বিভাগের নাম ইতিমধ্যে ব্যবহৃত', 'اسم الفئة المستخدمة من قبل', 'Nom de la catégorie déjà utilisé', 'श्रेणी का नाम पहले से उपयोग किया गया', 'Nama kategori sudah digunakan', 'Nome di categoria già utilizzato', 'すでに使用されているカテゴリ名', '이미 사용 된 카테고리 이름', 'categorie naam al in gebruik', 'Nome da categoria já utilizado', 'ชื่อหมวดหมู่ที่ใช้อยู่แล้ว', 'Kategori adı zaten kullanılmış', 'قسم کا نام پہلے سے ہی استعمال کیا جاتا ہے', '类别名称已被使用'),
(396, 'leave_list', 'Leave List', 'তালিকা ছেড়ে', 'قائمة الإجازات', 'Laisser liste', 'छुट्टी सूची', 'lasciare l\'elenco', 'lasciare l\'elenco', 'リストを残す', '휴가 목록', 'Verlof lijst', 'Sair da lista', 'ออกจากรายการ', 'Izin listesi', 'چھوڑ دو', '离开列表'),
(397, 'leave_category', 'Leave Category', 'বিভাগ ছেড়ে', 'ترك الفئة', 'Laisser la catégorie', 'श्रेणी छोड़ें', 'Meninggalkan kategori', 'Lasciare la categoria', 'カテゴリーを離れる', '카테고리를 떠나다', 'Categorie achterlaten', 'Sair da categoria', 'ออกจากหมวด', 'Ayrıl kategori', 'زمرے چھوڑ دو', '离开类别'),
(398, 'applied_on', 'Applied On', 'প্রয়োগ করা', 'تطبيق على', 'appliqué sur', 'पर लागू', 'Diterapkan pada', 'Applicato', 'に適用される', '에 적용된', 'Toegepast op', 'Aplicado em', 'นำมาใช้', 'Üzerine uygulanmış', 'پر لاگو', '应用于'),
(399, 'accepted', 'Accepted', 'গৃহীত', 'قبلت', 'accepté', 'स्वीकार किए जाते हैं', 'Diterima', 'accettato', '受け入れられた', '받아 들인', 'aanvaard', 'aceitaram', 'ได้รับการยอมรับ', 'kabul edilmiş', 'قبول', '公认'),
(400, 'leave_statistics', 'Leave Statistics', 'ছুটি পরিসংখ্যান', 'وترك الإحصاءات', 'Quitter les statistiques', 'सांख्यिकी छोड़ें', 'Meninggalkan statistik', 'Lasciare le statistiche', '統計を残す', '통계를 남겨 두다', 'Laat statistieken achter', 'Deixar estatísticas', 'ออกจากสถิติ', 'Istatistiği bırak', 'اعداد و شمار چھوڑ دو', '离开统计'),
(401, 'leave_type', 'Leave Type', 'ছুটি টাইপ', 'نوع الإجازة', 'Type de permission', 'प्रकार छोड़ें', 'Tipe kiri', 'Lasciare il tipo', '離脱型', '탈퇴 유형', 'Verlaat type', 'Deixe o tipo', 'ออกจากประเภท', 'Terk türü', 'قسم چھوڑ دو', '离开类型'),
(402, 'reason', 'Reason', 'কারণ', 'السبب', 'raison', 'कारण', 'alasan', 'ragionare', '理由', '이유', 'reden', 'razão', 'เหตุผล', 'neden', 'وجہ', '原因'),
(403, 'close', 'Close', 'বন্ধ', 'أغلق', 'Fermer', 'बंद करे', 'dekat', 'vicino', '閉じる', '닫기', 'dichtbij', 'fechar', 'ปิด', 'kapat', 'بند', '关'),
(404, 'give_award', 'Give Award', 'পুরস্কার দাও', 'إعطاء الجائزة', 'Donner un prix', 'पुरस्कार दें', 'Berikan penghargaan', 'Dare un premio', '賞を与える', '상을 주다', 'Prijs geven', 'Dar prêmio', 'ให้รางวัล', 'Ödül vermek', 'ایوارڈ دینا', '给予奖励'),
(405, 'list', 'List', 'তালিকা', 'قائمة', 'liste', 'सूची', 'daftar', 'elenco', 'リスト', '명부', 'lijst', 'Lista', 'รายการ', 'liste', 'فہرست', '名单'),
(406, 'award_name', 'Award Name', 'পুরস্কারের নাম', 'اسم الجائزة', 'nom de l\'attribution', 'पुरस्कार नाम', 'Nama penghargaan', 'Nome del premio', '賞品名', '보너스 이름', 'Toekenning naam', 'Nome do prêmio', 'ชื่อรางวัล', 'Ödül adı', 'ایوارڈ کا نام', '奖名'),
(407, 'gift_item', 'Gift Item', 'উপহার আইটেম', 'هدية البند', 'Objet cadeau', 'उपहार आइटम', 'Barang hadiah', 'Elemento regalo', 'ギフトアイテム', '선물 품목', 'Geschenkartikel', 'Item de presente', 'รายการของขวัญ', 'Hediye kalemi', 'تحفہ شے', '礼品'),
(408, 'cash_price', 'Cash Price', 'নগদ মূল্য', 'سعر الصرف', 'Prix ​​en espèces', 'नकद मूल्य', 'Harga tunai', 'Prezzo in contanti', '現金価格', '현금 가격', 'Contante prijs', 'Preço em dinheiro', 'ราคาเงินสด', 'Nakit fiyatı', 'نقد قیمت', '现金价格'),
(409, 'award_reason', 'Award Reason', 'পুরস্কার কারণ', 'جائزة السبب', 'Raison de récompense', 'पुरस्कार कारण', 'Alasan penghargaan', 'Ragione del premio', '授与理由', '수상 이유', 'Prijs reden', 'Motivo de adjudicação', 'เหตุผลรางวัล', 'Ödül sebebi', 'ایوارڈ کی وجہ', '奖励理由'),
(410, 'given_date', 'Given Date', 'প্রদত্ত তারিখ', 'تاريخ معين', 'Date donnée', 'दी गई तिथि', 'Tanggal tertentu', 'Data data', '与えられた日付', '주어진 날짜', 'Gegeven datum', 'Data dada', 'วันที่ระบุ', 'Verilen tarih', 'دی گئی تاریخ', '给定日期'),
(411, 'apply_leave', 'Apply Leave', 'ছুটি প্রয়োগ করুন', 'تطبيق الإجازة', 'Postuler', 'छुट्टी लागू करें', 'Berlaku cuti', 'Applicare il permesso', '休暇を取る', '휴가를 남기다', 'Verlof verlenen', 'Aplicar licença', 'ลาออก', 'Izin başvurusu yapmak', 'چھوڑ دو', '申请休假'),
(412, 'leave_application', 'Leave Application', 'ছুটি আবেদন', 'اترك التطبيق', 'laisser l\'application', 'छुट्टी की अर्जी', 'Meninggalkan aplikasi', 'Meninggalkan aplikasi', '申請を残す', '신청을 떠나다', 'Aanvraag verlaten', 'Deixar o aplicativo', 'ออกจากโปรแกรม', 'uygulamayı terket', 'چھٹی کی درخواست', '离开应用程序'),
(413, 'allowances', 'Allowances', 'তৃপ্তি', 'البدلات', 'Allocations', 'भत्ते', 'Tunjangan', 'indennità', '手当', '참작', 'toelagen', 'Subsídios', 'ค่าเบี้ยเลี้ยง', 'ödenekleri', 'الاؤنس', '津贴'),
(414, 'add_more', 'Add More', 'আরো যোগ করো', 'أضف المزيد', 'ajouter plus', 'अधिक जोड़ें', 'Tambahkan lagi', 'aggiungere altro', 'さらに追加', '더 추가', 'Voeg meer toe', 'Adicione mais', 'เพิ่มมากขึ้น', 'daha ekle', 'مزید شامل کریں', '添加更多'),
(415, 'deductions', 'Deductions', 'কর্তন', 'الخصومات', 'Déductions', 'कटौती', 'Deduksi', 'deduzioni', '控除', '공제', 'inhoudingen', 'Deduções', 'การหักเงิน', 'kesintiler', 'کٹوتی', '扣除'),
(416, 'salary_details', 'Salary Details', 'বেতন বিবরণ', 'تفاصيل الراتب', 'Détails de salaire', 'वेतन विवरण', 'Rincian gaji', 'I dettagli delle retribuzioni', '給料の詳細', '급여 세부 정보', 'Salaris details', 'Detalhes salariais', 'รายละเอียดเงินเดือน', 'Maaş ayrıntıları', 'تنخواہ کی تفصیلات', '工资细节'),
(417, 'salary_month', 'Salary Month', 'বেতন মাস', 'راتب شهر', 'Mois de salaire', 'वेतन महीने', 'Bulan gaji', 'Mese di salario', '給料月', '월급', 'Salaris maand', 'Mês de salário', 'เดือนเงินเดือน', 'Maaş ayı', 'تنخواہ مہینہ', '工资月'),
(418, 'leave_data_update_successfully', 'Leave Data Updated Successfully', 'ছুটি ডেটা সফলভাবে আপডেট করা হয়েছে', 'ترك البيانات تحديثها بنجاح', 'Laisser les données mises à jour avec succès', 'छोड़ें डेटा सफलतापूर्वक अपडेट किया गया', 'Biarkan data berhasil diperbarui', 'Lasciare i dati aggiornati correttamente', 'データを正常に更新したままにする', '데이터가 성공적으로 업데이트 된 상태로 유지', 'Laat de gegevens succesvol doorgeven', 'Deixe os dados atualizados com sucesso', 'ปล่อยให้ข้อมูลอัปเดตเรียบร้อยแล้ว', 'Verileri başarıyla güncelledi bırak', 'اعداد و شمار کو کامیابی سے اپ ڈیٹ کر دیں', '离开数据更新成功'),
(419, 'fees_history', 'Fees History', 'ফি ইতিহাস', 'تاريخ الرسوم', 'Historique des frais', 'शुल्क इतिहास', 'Sejarah biaya', 'La storia dei costi', '手数料履歴', '수수료 내역', 'Vergoedingen geschiedenis', 'Histórico de taxas', 'ค่าธรรมเนียมประวัติ', 'Ücret geçmişi', 'فیس کی تاریخ', '收费历史');
INSERT INTO `languages` (`id`, `word`, `english`, `bengali`, `arabic`, `french`, `hindi`, `indonesian`, `italian`, `japanese`, `korean`, `dutch`, `portuguese`, `thai`, `turkish`, `urdu`, `chinese`) VALUES
(420, 'bank_name', 'Bank Name', 'ব্যাংকের নাম', 'اسم البنك', 'Nom de banque', 'बैंक का नाम', 'nama Bank', 'nome della banca', '銀行名', '은행 이름', 'banknaam', 'nome do banco', 'ชื่อธนาคาร', 'banka adı', 'بینک کا نام', '银行名'),
(421, 'branch', 'Branch', 'শাখা', 'فرع شجرة', 'branche', 'डाली', 'cabang', 'ramo', 'ブランチ', '분기', 'tak', 'ramo', 'สาขา', 'şube', 'شاخ', '科'),
(422, 'bank_address', 'Bank Address', 'ব্যাংকের ঠিকানা', 'عنوان البنك', 'adresse de la banque', 'बैंक का पता', 'Alamat bank', 'indirizzo bancario', '銀行の住所', '계좌 번호', 'bank adres', 'endereço do banco', 'ที่อยู่ธนาคาร', 'banka adresi', 'بینک کا پتہ', '银行地址'),
(423, 'ifsc_code', 'IFSC Code', 'আইএফসিসি কোড', 'رمز إفسك', 'IFSC code', 'आईएफएससी कोड', 'Kode IFSC', 'Codice IFSC', 'IFSCコード', 'IFSC 코드', 'IFSC-code', 'Código IFSC', 'รหัส IFSC', 'IFSC kodu', 'IFSC کوڈ', 'IFSC代码'),
(424, 'account_no', 'Account No', 'হিসাব নাম্বার', 'رقم الحساب', 'n ° de compte', 'खाता क्रमांक', 'No rekening', 'Conto n', 'アカウントなし', '계정 없음', 'account nummer', 'Conta não', 'หมายเลขบัญชี', 'Hesap numarası', 'اکاؤنٹ کا نمبر', '户口号码'),
(425, 'add_bank', 'Add Bank', 'ব্যাংক জুড়ুন', 'إضافة بنك', 'Ajouter une banque', 'बैंक जोड़ें', 'Tambahkan bank', ' Aggiungi la banca', '銀行を追加する', '은행 추가', 'Bank toevoegen', 'Adicionar banco', 'เพิ่มธนาคาร', 'Banka ekle', 'بینک شامل کریں', '加银行'),
(426, 'account_name', 'Account Holder', 'হিসাবের নাম', 'أسم الحساب', 'nom du compte', 'खाते का नाम', 'nama akun', 'nome utente', 'アカウント名', '계좌 이름', 'accountnaam', 'nome da conta', 'ชื่อบัญชี', 'hesap adı', 'کھاتے کا نام', '用户名'),
(427, 'database_backup_completed', 'Database Backup Completed', 'ডাটাবেস ব্যাকআপ সম্পন্ন', 'اكتمل قاعدة بيانات النسخ الاحتياطي', 'Sauvegarde de base de données terminée', 'डेटाबेस बैकअप पूर्ण', 'Backup database selesai', 'Backup del database completato', 'データベースのバックアップが完了しました', '데이터베이스 백업 완료', 'Database backup voltooid', 'Backup do banco de dados concluído', 'การสำรองฐานข้อมูลเสร็จสมบูรณ์', 'Veritabanı yedeklemesi tamamlandı', 'ڈیٹا بیک اپ مکمل', '数据库备份完成'),
(428, 'restore_database', 'Restore Database', 'ডাটাবেস পুনঃস্থাপন', 'استعادة قاعدة البيانات', 'Restaurer la base de données', 'डेटाबेस पुनर्स्थापित करें', 'restore database', 'Ripristinare il database', 'データベースの復元', '데이터베이스 복원', 'Database herstellen', 'Restaurar o banco de dados', 'เรียกคืนฐานข้อมูล', 'Veritabanı geri yükle', 'ڈیٹا بیس بحال کریں', '恢复数据库'),
(429, 'template', 'Template', 'টেমপ্লেট', 'قالب', 'modèle', 'टेम्पलेट', 'template', 'modello', 'テンプレート', '주형', 'sjabloon', 'modelo', 'แบบ', 'şablon', 'سانچے', '模板'),
(430, 'time_and_date', 'Time And Date', 'সময় এবং তারিখ', 'الوقت و التاريخ', 'heure et date', 'समय और तारीख', 'waktu dan tanggal', 'ora e data', '日時', '시간과 날짜', 'tijd en datum', 'hora e data', 'เวลาและวันที่', 'zaman ve tarih', 'وقت اور تاریخ', '时间和日期'),
(431, 'everyone', 'Everyone', 'সবাই', 'كل واحد', 'toutes les personnes', 'हर कोई', 'semua orang', 'tutti', 'みんな', '각자 모두', 'iedereen', 'todos', 'ทุกคน', 'herkes', 'سب', '大家'),
(432, 'invalid_amount', 'Invalid Amount', 'অকার্যকর পরিমাণ', 'مبلغ غير صحيح', 'montant invalide', 'अवैध राशि', 'jumlah tidak valid', 'importo non valido', '無効額', '무효 금액', 'ongeldige hoeveelheid', 'Montante inválido', 'จำนวนที่ไม่ถูกต้อง', 'geçersiz miktar', 'غلط رقم', '无效数量'),
(433, 'leaving_date_is_not_available_for_you', 'Leaving Date Is Not Available For You', 'তারিখ রেখে আপনার জন্য উপলব্ধ নয়', 'ترك التاريخ غير متاح لك', 'la date de sortie n\'est pas disponible pour vous', 'छोड़ने की तिथि आपके लिए उपलब्ध नहीं है', 'tanggal berangkat tidak tersedia untuk Anda', 'la data di partenza non è disponibile per te', 'あなたの日付を残すことはできません', '출발일을 사용할 수 없습니다.', 'vertrekdatum is niet voor u beschikbaar', 'A data de saída não está disponível para você', 'วันที่ออกเดินทางไม่สามารถใช้ได้สำหรับคุณ', 'bırakma tarihi sizin için mevcut değil', 'چھوڑنے کی تاریخ آپ کے لئے دستیاب نہیں ہے', '离开日期不适合您'),
(434, 'animations', 'Animations', 'অ্যানিমেশন', 'الرسوم المتحركة', 'animations', 'एनिमेशन', 'animasi', 'animazioni', 'アニメーション', '애니메이션', 'animaties', 'animações', 'ภาพเคลื่อนไหว', 'animasyonlar', 'متحرک تصاویر', '动画'),
(435, 'email_settings', 'Email Settings', 'ইমেল সেটিংস', 'إعدادات البريد الإلكتروني', 'Paramètres de messagerie', 'ईमेल सेटिंग्स', 'pengaturan email', 'impostazioni di posta elettronica', 'メール設定', '이메일 설정', 'Email instellingen', 'configurações de e-mail', 'การตั้งค่าอีเมล', 'e-posta ayarları', 'ای میل کی ترتیبات', '电子邮件设置'),
(436, 'deduct_month', 'Deduct Month', 'কেটে মাস', 'خصم الشهر', 'déduire le mois', 'कटौती महीने', 'deduksi bulan', 'detrarre il mese', '控除月', '달을 공제하다', 'aftrek maand', 'deduz o mês', 'หักเดือน', 'ay düşülmek', 'کٹوتی مہینے', '扣除月'),
(437, 'no_employee_available', 'No Employee Available', 'কোন কর্মচারী প্রাপ্তিসাধ্য', 'لا يتوفر موظف', 'Aucun employé disponible', 'कोई कर्मचारी उपलब्ध नहीं है', 'Tidak ada karyawan yang tersedia', 'Nessun dipendente disponibile', '従業員はいません', '직원이 없습니다', 'Geen medewerker beschikbaar', 'Nenhum funcionário disponível', 'ไม่มีพนักงาน', 'Çalışan yok', 'کوئی ملازم دستیاب نہیں ہے', '没有员工可用'),
(438, 'advance_salary_application_submitted', 'Advance Salary Application Submitted', 'অগ্রিম বেতন আবেদন জমা', 'تم تقديم طلب الراتب المتقدم', 'Demande de salaire anticipé soumise', 'अग्रिम वेतन अर्ज सबमिट किया गया', 'Aplikasi Gaji Muka Submitted', 'Applicazione anticipata salariale presentata', 'アドバンス給与申請書が提出されました', '사전 연봉 신청서가 제출되었습니다.', 'Voorschot Salarisaanvraag ingediend', 'Solicitação de Salário Avançado Enviado', 'ส่งใบสมัครล่วงหน้า', 'Maaş Başvurusu Gönderildi', 'پیشگی تنخواہ کی درخواست پیش کی گئی', '提前申请工资申请'),
(439, 'date_format', 'Date Format', 'তারিখ বিন্যাস', 'صيغة التاريخ', 'date format', 'डेटा प्रारूप', 'format tanggal', 'formato data', '日付形式', '날짜 형식', 'datumnotatie', 'Formato de data', 'รูปแบบวันที่', 'tarih formatı', 'تاریخ کی شکل', '日期格式'),
(440, 'id_card_generate', 'ID Card Generate', 'আইডি কার্ড তৈরি করুন', 'بطاقة الهوية تولد', 'Carte d\'identité générer', 'आईडी कार्ड उत्पन्न', 'KTP menghasilkan', 'La carta d\'identità genera', 'IDカード生成', 'ID 카드 생성', 'ID-kaart genereert', 'O cartão de identificação gera', 'สร้างบัตรประจำตัว', 'Kimlik kartı üret', 'شناختی کارڈ پیدا', '身份证生成'),
(441, 'issue_salary', 'Issue Salary', 'বেতন ইস্যু', 'إصدار الراتب', 'question salariale', 'मुद्दा वेतन', 'mengeluarkan gaji', 'emettere stipendio', '発行報酬', '이슈 급여', 'loon uitgeven', 'emitir salário', 'ออกเงินเดือน', 'maaş çıkarmak', 'مسئلہ تنخواہ', '发放工资'),
(442, 'advance_salary', 'Advance Salary', 'বেতন অগ্রিম', 'راتب مقدما', 'avance sur salaire', 'पूर्व वेतन', 'uang muka gaji', 'salario anticipo', '前給', '연봉', 'vooruitbetaling', 'Salário adiantado', 'เงินเดือนล่วงหน้า', 'avans maaşı', 'پیشگی تنخواہ', '提前工资'),
(443, 'logo', 'Logo', 'লোগো', 'شعار', 'logo', 'प्रतीक चिन्ह', 'logo', 'logo', 'ロゴ', '심벌 마크', 'logo', 'logo', 'เครื่องหมาย', 'logo', 'علامت (لوگو)', '商标'),
(444, 'book_request', 'Book Request', 'বই অনুরোধ', 'طلب الكتاب', 'demande de livre', 'पुस्तक अनुरोध', 'permintaan buku', 'richiesta di libro', '本のリクエスト', '도서 요청', 'boekverzoek', 'pedido de livro', 'book คำขอ', 'kitap isteği', 'کتاب کی درخواست', '书籍要求'),
(445, 'reporting', 'Reporting', 'প্রতিবেদন', 'التقارير', 'rapport', 'रिपोर्टिंग', 'pelaporan', 'segnalazione', '報告', '보고', 'rapportage', 'relatórios', 'การรายงาน', 'raporlama', 'رپورٹنگ', '报告'),
(446, 'paid_salary', 'Paid Salary', 'বেতন দেওয়া', 'الراتب المدفوع', 'salaire payé', 'भुगतान वेतन', 'gaji dibayar', 'stipendio retribuito', '給料', '급여', 'betaald salaris', 'salário pago', 'จ่ายเงินเดือน', 'ücretli maaş', 'تنخواہ تنخواہ', '有薪工资'),
(447, 'due_salary', 'Due Salary', 'বাকি বেতন', 'الراتب', 'salaire dû', 'उचित वेतन', 'karena gaji', 'salario dovuto', '支払った給料', '만기 임금', 'verschuldigd salaris', 'salário devedor', 'เงินเดือนที่ครบกำหนด', 'maaş', 'تنخواہ', '应付工资'),
(448, 'route', 'Route', 'রুট', 'طريق', 'Route', 'मार्ग', 'Rute', 'Itinerario', 'ルート', '노선', 'Route', 'Rota', 'เส้นทาง', 'rota', 'راستہ', '路线'),
(449, 'academic_details', 'Academic Details', 'একাডেমিক বিবরণ', 'التفاصيل الأكاديمية', 'détails académiques', 'अकादमिक विवरण', 'rincian akademis', 'dettagli accademici', '学問の詳細', '학업 내용', 'academische details', 'detalhes acadêmicos', 'รายละเอียดทางวิชาการ', 'akademik ayrıntılar', 'تعلیمی تفصیلات', '学术细节'),
(450, 'guardian_details', 'Guardian Details', 'অভিভাবক বিস্তারিত', 'التفاصيل الأكاديمية', 'détails académiques', 'अकादमिक विवरण', 'rincian akademis', 'dettagli accademici', '学問の詳細', '학업 내용', 'academische details', 'detalhes acadêmicos', 'รายละเอียดทางวิชาการ', 'akademik ayrıntılar', 'تعلیمی تفصیلات', '学术细节'),
(451, 'due_amount', 'Due Amount', 'বাকি টাকা', 'مبلغ مستحق', 'montant dû', 'देय राशि', 'karena jumlah', 'importo dovuto', '金額', '만기 금액', 'debita moles', 'debita moles', 'надлежащей суммы', 'ödenecek meblağ', 'باقی رقم', '到期金额'),
(452, 'fee_due_report', 'Fee Due Report', 'ফি প্রতিবেদনের রিপোর্ট', 'تقرير الرسوم المستحقة', 'rapport dû', 'शुल्क के कारण रिपोर्ट', 'laporan biaya', 'fee due report', '手数料報告書', '수수료 납부 보고서', 'vergoeding verschuldigd', 'relatório pago', 'รายงานการเสียค่าธรรมเนียม', 'due due due report', 'فیس کی اطلاع کی رپورٹ', '应收费用报告'),
(453, 'other_details', 'Other Details', 'অন্যান্য বিস্তারিত', 'تفاصيل أخرى', 'Autres détails', 'अन्य जानकारी', 'Rincian lainnya', 'altri dettagli', 'その他の情報', '기타 세부 정보', 'andere details', 'Outros detalhes', 'รายละเอียดอื่น ๆ', 'diğer detaylar', 'دیگر تفصیلات', '其他详情'),
(454, 'last_exam_report', 'Last Exam Report', 'শেষ পরীক্ষার রিপোর্ট', 'تقرير الاختبار الأخير', 'Dernier rapport d&#39;examen', 'अंतिम परीक्षा रिपोर्ट', 'Laporan Ujian Terakhir', 'Rapporto sull\'ultimo esame', '前回の試験レポート', '마지막 시험 보고서', 'Laatste examenrapport', 'Relatório do último exame', 'รายงานการสอบครั้งสุดท้าย', 'Son Sınav Raporu', 'آخری امتحان کی رپورٹ', '上次考试报告'),
(455, 'book_issued', 'Book Issued', 'বই ইস্যু করা', ' كتاب صدر', 'Livre publié', 'पुस्तक जारी की', 'Buku Diterbitkan', 'Libro emesso', '発行された本', '도서 발행', 'Uitgegeven boek', 'Livro emitido', 'หนังสือออก', 'Yayınlanan Kitap', 'کتاب جاری', '出版书籍'),
(456, 'interval_month', 'Interval 30 Days', 'অন্তর 30 দিন', 'الفاصل الزمني 30 يومًا', 'Intervalle 30 jours', 'अंतराल 30 दिन', 'Interval 30 Hari', 'Intervallo 30 giorni', '間隔30日', '간격 30 일', 'Interval 30 dagen', 'Intervalo 30 dias', 'ช่วงเวลา 30 วัน', 'Aralık 30 Gün', 'انٹرویو 30 دن', '间隔30天'),
(457, 'attachments', 'Attachments', 'সংযুক্তিসমূহ', 'مرفقات', 'Les pièces jointes', 'संलग्नक', 'Lampiran', 'allegati', '添付ファイル', '첨부 파일', 'Bijlagen', 'Anexos', 'สิ่งที่แนบมา', 'Ekler', 'منسلکات', '附件'),
(458, 'fees_payment', 'Fees Payment', 'ফি প্রদান', 'دفع الرسوم', 'Paiement des frais', 'शुल्क भुगतान', 'Pembayaran Biaya', 'Pagamento', 'お支払い', '수수료 지불', 'Vergoedingen Betaling', 'Pagamento de taxas', 'การชำระค่าธรรมเนียม', 'Ücret Ödeme', 'فیس ادائیگی', '费用付款'),
(459, 'fees_summary', 'Fees Summary', 'ফি সংক্ষিপ্ত বিবরণ', 'ملخص الرسوم', 'Résumé des frais', 'फीस सारांश', 'Ringkasan Biaya', 'Riepilogo tasse', '料金のまとめ', '요금 요약', 'Kostenoverzicht', 'Resumo de taxas', 'สรุปค่าธรรมเนียม', 'Ücret Özeti', 'فیس خلاصہ', '费用摘要'),
(460, 'total_fees', 'Total Fees', 'মোট ফি', 'الرسوم الكلية', 'Total des frais', 'कुल फीस', 'Total Biaya', 'Commissioni totali', '合計料金', '총 비용', 'Totale kosten', 'Taxas totais', 'ค่าธรรมเนียมทั้งหมด', 'Toplam ücretler', 'کل فیس', '总费用'),
(461, 'weekend_attendance_inspection', 'Weekend Attendance Inspection', 'সপ্তাহান্তে উপস্থিতি পরিদর্শন', 'فحص الحضور في عطلة نهاية الاسبوع', 'Weekend Attendance Inspection', 'सप्ताहांत उपस्थिति निरीक्षण', 'Inspeksi Kehadiran Akhir Pekan', 'Ispezione presenze weekend', '週末出席検査', '주말 출석 검사', 'Weekend-aanwezigheidsinspectie', 'Inspeção de Presença no Fim de Semana', 'การตรวจสอบการเข้าร่วมวันหยุดสุดสัปดาห์', 'Hafta Sonu Katılım Denetimi', 'اختتام ہفتہ حاضری معائنہ', '周末出勤检查'),
(462, 'book_issued_list', 'Book Issued List', 'বুক ইস্যু তালিকা', 'كتاب صدر قائمة', 'Liste des livres publiés', 'पुस्तक की सूची जारी की', 'Daftar Buku Terbitan', 'Elenco pubblicato', '書籍発行リスト', '도서 목록', 'Uitgevoerde lijst van boeken', 'Lista de livros emitidos', 'รายการหนังสือที่ออก', 'Kitap Çıkarılmış Listesi', 'کتاب جاری کی فہرست', '图书发行清单'),
(463, 'lose_your_password', 'Lose Your Password?', 'আপনার পাসওয়ার্ড হারান?', '?تفقد كلمة المرور الخاصة بك', 'Perdre votre mot de passe?', 'अपना पासवर्ड खो दें?', 'Kalah Kata Sandi Anda?', 'Perdere la tua password?', 'パスワードを忘れました?', '패스워드 분실?', 'Verlies uw wachtwoord?', 'Perca sua senha?', 'สูญเสียรหัสผ่านของคุณ?', 'Şifrenizi kaybedin?', '?اپنا پاس ورڈ کھو', '丢失密码?'),
(464, 'all_branch_dashboard', 'All Branch Dashboard', 'সমস্ত শাখা ড্যাশবোর্ড', 'كل لوحة فرع', 'Tableau de bord de toutes les branches', 'सभी शाखा डैशबोर्ड', 'Semua Dashboard Cabang', 'All Branch Dashboard', '全支店ダッシュボード', '모든 지점 대시 보드', 'Alles Branch Dashboard', 'All Branch Dashboard', 'แดชบอร์ดสาขาทั้งหมด', 'Tüm Şube Panosu', 'تمام برانچ ڈیش بورڈ', '所有分支仪表板'),
(465, 'academic_session', 'Academic Session', 'একাডেমিক সেশন', 'الدورة الأكاديمية', 'Session académique', 'शैक्षणिक सत्र', 'Sesi Akademik', 'Sessione accademica', '学術セッション', '학술 세션', 'Academische sessie', 'Sessão Acadêmica', 'วาระการศึกษา', 'Akademik Oturum', 'تعلیمی اجلاس', '学术会议'),
(466, 'all_branches', 'All Branches', 'সমস্ত শাখা', 'كل الفروع', 'Heures supplémentaires', 'सभी शाखाओं', 'Semua Cabang', 'Tutte le filiali', 'すべての枝', '모든 지점', 'Alle takken', 'Todas as filiais', 'ทุกสาขา', 'Tüm Şubeler', 'تمام شاخیں', '所有分支机构'),
(467, 'admission', 'Admission', 'ভর্তি', 'قبول', 'admission', 'दाखिला', 'penerimaan', 'ammissione', '入場', '입장', ' toelating', 'admissão', 'การรับเข้า', 'kabul', 'داخلہ', '入场'),
(468, 'create_admission', 'Create Admission', 'ভর্তি তৈরি করুন', 'إنشاء القبول', 'Créer une entrée', 'प्रवेश बनाएँ', 'Buat Penerimaan', 'Crea l\'ammissione', '入場許可を作成する', '입장 제작', 'Maak toegang', 'Criar admissão', 'สร้างการรับสมัคร', 'Giriş Oluştur', 'داخلہ بنائیں', '创建入学'),
(469, 'multiple_import', 'Multiple Import', 'একাধিক আমদানি', 'استيراد متعدد', 'Importation multiple', 'एकाधिक आयात', 'Impor Berganda', 'Importazione multipla', '複数インポート', '복수 가져 오기', 'Meerdere import', 'Múltiplo Import', 'นำเข้าหลายรายการ', 'Birden çok içe aktarma', 'ایک سے زیادہ درآمد', '多次导入'),
(470, 'student_details', 'Student Details', 'ছাত্র বিস্তারিত', 'تفاصيل الطالب', 'Détails de l\'étudiant', 'छात्र का विवरण', 'Detail Siswa', 'Dettagli dello studente', '学生の詳細', '학생 세부 사항', 'Studentendetails', 'Detalhes do aluno', 'รายละเอียดนักศึกษา', 'Öğrenci Detayları', 'طالب علم کی تفصیلات', '学生详情'),
(471, 'student_list', 'Student List', 'ছাত্র তালিকা', 'قائمة الطلاب', 'Liste des étudiants', 'छात्र सूची', 'Daftar Siswa', 'Elenco degli studenti', '学生リスト', '학생 목록', 'Studentenlijst', 'Lista de estudantes', 'รายชื่อนักศึกษา', 'Öğrenci Listesi', 'طالب علم کی فہرست', '学生名单'),
(472, 'login_deactivate', 'Login Deactivate', 'লগইন নিষ্ক্রিয় করুন', 'تسجيل الدخول', 'Login Désactiver', 'लॉगिन निष्क्रिय करें', 'Login Nonaktifkan', 'Login Disattiva', 'ログイン無効化', '로그인 비활성화', 'Inloggen Deactiveren', 'Login Desativar', 'เข้าสู่ระบบปิดการใช้งาน', 'Giriş Devre Dışı Bırak', 'لاگ ان غیر فعال', '登录停用'),
(473, 'parents_list', 'Parents List', 'পিতামাতার তালিকা', 'قائمة الوالدين', 'Liste de parents', 'माता-पिता की सूची', 'Daftar Orang Tua', 'Lista dei genitori', '親リスト', '학부모 목록', 'Ouderslijst', 'Lista de pais', 'รายการผู้ปกครอง', 'Ebeveyn Listesi', 'والدین کی فہرست', '父母名单'),
(474, 'add_parent', 'Add Parent', 'মূল যোগ করুন', 'أضف الوالد', 'Ajouter un parent', 'जनक जोड़ें', 'Tambahkan Induk', 'Aggiungi genitore', '親を追加', '부모 추가', 'Voeg ouder toe', 'Adicionar pai', 'เพิ่มผู้ปกครอง', 'Üst ekle', 'والدین شامل کریں', '添加父级'),
(475, 'employee_list', 'Employee List', 'কর্মচারী তালিকা', 'قائمة موظف', 'Liste des employés', 'कर्मचारी सूची', 'Daftar Karyawan', 'Elenco dei dipendenti', '従業員リスト', '직원 목록', 'Werknemerslijst', 'Lista de empregados', 'รายชื่อพนักงาน', 'İşçi listesi', 'ملازم کی فہرست', '员工名单'),
(476, 'add_department', 'Add Department', 'বিভাগ যোগ করুন', 'أضف قسم', 'Ajouter un département', 'विभाग जोड़ें', 'Tambahkan Departemen', 'Aggiungi dipartimento', '部署を追加', '부서 추가', 'Afdeling toevoegen', 'Adicionar Departamento', 'เพิ่มแผนก', 'Bölüm ekle', 'محکمہ شامل کریں', '添加部门'),
(477, 'add_employee', 'Add Employee', 'কর্মচারী যোগ করুন', 'إضافة موظف', 'Ajouter un employé', 'कर्मचारी जोड़ें', 'Tambahkan Karyawan', 'Aggiungi dipendente', '従業員を追加', '직원 추가', 'Voeg werknemer toe', 'Adicionar funcionário', 'เพิ่มพนักงาน', 'Çalışan ekle', 'ملازم شامل کریں', '添加员工'),
(478, 'salary_template', 'Salary Template', 'বেতন টেমপ্লেট', 'قالب الراتب', 'Modèle de salaire', 'वेतन का खाका', 'Templat Gaji', 'Modello di stipendio', '給与テンプレート', '급여 템플릿', 'Salaris sjabloon', 'Modelo de salário', 'เทมเพลตเงินเดือน', 'Maaş Şablonu', 'تنخواہ سانچہ', '薪资模板'),
(479, 'salary_payment', 'Salary Payment', 'বেতন পেমেন্ট', 'دفع المرتبات', 'Paiement du salaire', 'तनख्वाह का भुगतान', 'Pembayaran Gaji', 'Salario', '給与支払い', '급여 지불', 'Salaris betalingo', 'Pagamento de Salário', 'การจ่ายเงินเดือน', 'Maaş ödemesi', 'تنخواہ ادائیگی', '工资支付'),
(480, 'payroll_summary', 'Payroll Summary', 'বেতন সারসংক্ষেপ', 'ملخص الرواتب', 'Résumé de la paie', 'पेरोल सारांश', 'Ringkasan Penggajian', 'Riepilogo del libro paga', '給与サマリー', '급여 요약', 'Payroll-samenvatting', 'Resumo da folha de pagamento', 'สรุปเงินเดือน', 'Bordro Özeti', 'ادائیگی کا خلاصہ', '工资总结'),
(481, 'academic', 'Academic', 'বিদ্যালয় সংক্রান্ত', 'أكاديمي', 'Académique', 'अकादमिक', 'Akademik', 'Accademico', '学術', '학생', 'Academic', 'Acadêmico', 'วิชาการ', 'Akademik', 'تعلیمی', '学术的'),
(482, 'control_classes', 'Control Classes', 'নিয়ন্ত্রণ ক্লাস', 'فئات التحكم', 'Control Classes', 'नियंत्रण कक्षाएं', 'Kelas Kontrol', 'Classi di controllo', '制御クラス', '컨트롤 클래스', 'Controleklassen', 'Classes de Controle', 'คลาสควบคุม', 'Kontrol Sınıfları', 'کنٹرول کلاس', '控制类'),
(483, 'assign_class_teacher', 'Assign Class Teacher', 'ক্লাস শিক্ষক নিয়োগ\n\n', 'تعيين معلم الصف', 'Attribuer un enseignant de classe', 'कक्षा शिक्षक का कार्यभार सौंपें', 'Tugaskan Guru Kelas', 'Assegna un insegnante di classe', 'クラスの先生を割り当てる', '클래스 교사 지정', 'Ken klasleraar toe', 'Atribuir professor de turma', 'มอบหมายครูประจำชั้น', 'Sınıf Öğretmeni Ata', 'کلاس ٹیچر کو تفویض کریں', '分配班主任'),
(484, 'class_assign', 'Class Assign', 'ক্লাস বরাদ্দ', 'تعيين فئة', 'Affectation de classe', 'वर्ग निरुपित', 'Penugasan Kelas', 'Assegnazione di classe', 'クラス割り当て', '클래스 지정', 'Klasse toewijzen', 'Atribuição de classe', 'กำหนดระดับ', 'Sınıf Ataması', 'کلاس کا تعین', '班级分配'),
(485, 'assign', 'Assign', 'দায়িত্ব অর্পণ করা', 'تعيين', 'Attribuer', 'सौंपना', 'Menetapkan', 'Assegnare', '割り当てます', '양수인', 'Toewijzen', 'Atribuir', 'กำหนด', 'Atamak', 'تفویض', '分配'),
(486, 'promotion', 'Promotion', 'পদোন্নতি', 'ترقية وظيفية', 'Promotion', 'पदोन्नति', 'Promosi', 'Promozione', '昇進', '승진', 'Bevordering', 'Promoção', 'การส่งเสริม', ' tanıtım', 'فروغ', '提升'),
(487, 'attachments_book', 'Attachments Book', 'সংযুক্তি বই', 'كتاب المرفقات', 'Livre des pièces jointes', 'अटैचमेंट बुक', 'Buku Lampiran', 'Libro degli allegati', '添付ファイル', '첨부 파일 도서', 'Bijlagen Boek', 'Livro de Anexos', 'หนังสือแนบ', 'Ekler Kitabı', 'منسلک کتاب', '附件书'),
(488, 'upload_content', 'Upload Content', 'আপলোড কন্টেন্ট', 'تحميل المحتوى', 'Télécharger le contenu', 'सामग्री अपलोड करें', 'Unggah Konten', 'Carica contenuto', 'コンテンツをアップロードする', '콘텐츠 업로드', 'Upload inhoud', 'Upload de conteúdo', 'อัพโหลดเนื้อหา', 'İçerik Yükle', 'مواد اپ لوڈ کریں', '上传内容'),
(489, 'attachment_type', 'Attachment Type', 'সংযুক্তি প্রকার', 'نوع المرفق', 'Type de pièce jointe', 'आसक्ति का प्रकार', 'Jenis Lampiran', 'Tipo di allegato', 'アタッチメントタイプ', 'アタッチメントタイプ', 'Aanhangertype', 'Tipo de Anexo', 'ประเภทเอกสารแนบ', 'Ek tipi', 'منسلک کی قسم', '附件类型'),
(490, 'exam_master', 'Exam Master', 'পরীক্ষা মাস্টার', 'الامتحان ماجستير', 'Maître d\'examen', 'परीक्षा मास्टर', 'Master ujian', 'Maestro dell\'esame', '試験マスター', '시험 마스터', 'Examenmeester', 'Mestre do Exame', 'ปริญญาโทการสอบ', 'Sınav Masterı', 'امتحان ماسٹر', '考试大师'),
(491, 'exam_hall', 'Exam Hall', 'পরীক্ষা হল', 'قاعة الامتحان', 'Salle d\'examen', 'परीक्षा हॉल', 'Aula ujian', 'Exam Hall', '試験会場', '시험 홀', 'Examenzaal', 'Sala de exames', 'ห้องสอบ', 'Sınav salonu', 'امتحان ہال', '考试大厅'),
(492, 'mark_entries', 'Mark Entries', 'মার্ক এন্ট্রি', 'إدخالات مارك', 'Marquer les entrées', 'मार्क एंट्रीज', 'Tandai Entri', 'Mark Entries', 'エントリーをマーク', '마크 항목', 'Invoer markeren', 'Marcar Entradas', 'ทำเครื่องหมายรายการ', 'Mark Girdileri', 'مارک اندراج', '标记条目'),
(493, 'tabulation_sheet', 'Tabulation Sheet', 'ট্যাবলেট শীট', 'ورقة الجدولة', 'Feuille de tabulation', 'टेबुलेशन शीट', 'Lembar Tabulasi', 'Foglio di tabulazione', '集計シート', '도표화 시트', 'Tabuleringsblad', 'Folha de tabulação', 'แผ่นตาราง', 'Tablolama Sayfası', 'ٹیبلولینٹ شیٹ', '制表表'),
(494, 'supervision', 'Supervision', 'রক্ষণাবেক্ষণ', 'إشراف', 'Supervision', 'पर्यवेक्षण', 'Pengawasan', 'supervisione', '監督', '감독', 'Toezicht', 'Supervisão', 'การดูแล', 'Nezaret', 'نگرانی', '监督'),
(495, 'hostel_master', 'Hostel Master', 'হোস্টেল মাস্টার', 'نزل ماستر', 'Maître de l&#39;auberge', 'हॉस्टल मास्टर', 'Master Hostel', 'Ostello Maestro', 'ホステルマスター', '호스텔 마스터', 'Hostel Master', 'Mestre do Hostel', 'โฮสเทลมาสเตอร์', 'Hostel Master', 'ہاسٹل ماسٹر', '宿舍大师'),
(496, 'hostel_room', 'Hostel Room', 'হোস্টেল রুম', 'غرفة نزل', 'Chambre d\'auberge', 'छात्रावास का कमरा', 'Kamar Hostel', 'Camera dell\'ostello', 'ホステルルーム', '호스텔 룸', 'Hostelkamer', 'Quarto Hostel', 'ห้องโฮสเทล', 'Hostel Odası', 'ہالینڈ کا کمرہ', '宿舍间'),
(497, 'allocation_report', 'Allocation Report', 'বরাদ্দ রিপোর্ট', 'تقرير التخصيص', 'Rapport d\'allocation', 'आवंटन रिपोर्ट', 'Laporan Alokasi', 'Rapporto di assegnazione', '配分レポート', '배당 보고서', 'Toewijzingsverslag', 'Relatório de alocação', 'รายงานการจัดสรร', 'Tahsis Raporu', 'تخصیص کی رپورٹ', '分配报告'),
(498, 'route_master', 'Route Master', 'রুট মাস্টার', 'سيد الطريق', 'Route Master', 'रूट मास्टर', 'Rute Master', 'Route Master', 'ルートマスター', '루트 마스터', 'Route Master', 'Mestre da rota', 'เส้นทางการเดินทาง', 'Rota ustası', 'راستہ ماسٹر', '路线大师'),
(499, 'vehicle_master', 'Vehicle Master', 'যানবাহন মাস্টার', 'سيد السيارة', 'Véhicule maître', 'वाहन मास्टर', 'Master Kendaraan', 'Maestro del veicolo', '車両マスター', '차량 마스터', 'Voertuig Master', 'Mestre do Veículo', 'ยานพาหนะต้นแบบ', 'Araç Ustası', 'گاڑیاں ماسٹر', '车辆大师'),
(500, 'stoppage', 'Stoppage', 'বিরতি', 'إضراب', 'Arrêt', 'ठहरना', 'Penghentian', 'Arresto', '停止', '중지', 'stopzetting', 'Parada', 'การหยุด', 'peklik', 'روکنا', '停工'),
(501, 'assign_vehicle', 'Assign Vehicle', 'যানবাহন বরাদ্দ করুন', 'تخصيص مركبة', 'Assigner un véhicule', 'वाहन सौंप दें', 'Tetapkan Kendaraan', 'Assegna veicolo', '車両を割り当て', '차량 지정', 'Voertuig toewijzen', 'Atribuir Veículo', 'มอบหมายยานพาหนะ', 'Araç Ata', 'گاڑیاں تفویض کریں', '分配车辆'),
(502, 'reports', 'Reports', 'প্রতিবেদন', 'تقارير', 'Rapports', 'रिपोर्ट', 'Laporan', 'Rapporti', 'レポート', '보고서', 'rapporten', 'Relatórios', 'รายงาน', 'Raporlar', 'رپورٹیں', '报告'),
(503, 'books_entry', 'Books Entry', 'বই এন্ট্রি', 'دخول الكتب', 'Entrée de livres', 'पुस्तकें प्रवेश', 'Entri Buku', 'Ingresso dei libri', '図書エントリー', '도서 항목', 'Invoer van boeken', 'Entrada de livros', 'รายการหนังสือ', 'Kitaplar Girişi', 'کتابیں انٹری', '书籍入门'),
(504, 'event_type', 'Event Type', 'ইভেন্টের ধরণ', 'نوع الحدث', 'Event Type', 'Event Type', 'Jenis Peristiwa', 'Tipo di evento', 'イベントタイプ', '이벤트 유형', 'Type evenement', 'Tipo de evento', 'ประเภทกิจกรรม', 'Etkinlik tipi', 'واقعہ کی قسم', '事件类型'),
(505, 'add_events', 'Add Events', 'ইভেন্ট যোগ করুন', 'إضافة أحداث', 'Ajouter des événements', 'ईवेंट जोड़ें', 'Tambahkan Acara', 'Aggiungi eventi', 'イベントを追加', '이벤트 추가', 'Voeg evenementen toe', 'Adicionar eventos', 'เพิ่มกิจกรรม', 'Etkinlik ekle', 'واقعات شامل کریں', '添加活动'),
(506, 'student_accounting', 'Student Accounting', 'ছাত্র অ্যাকাউন্টিং', 'محاسبة الطلاب', 'Comptabilité des étudiants', 'छात्र लेखा', 'Akuntansi Mahasiswa', 'Contabilità degli studenti', '学生会計', '학생 회계', 'Accounting discipulus', 'Contabilidade Estudantil', 'บัญชีนักศึกษา', 'Öğrenci Muhasebesi', 'طالب علم اکاؤنٹنگ', '学生会计'),
(507, 'create_single_invoice', 'Create Single Invoice', 'একক চালান মোট রুট তৈরি করুন', 'إنشاء فاتورة واحدة', 'Créer une facture unique', 'एकल चालान बनाएँ', 'Buat Faktur Tunggal', 'Crea una singola fattura', '単一の請求書を作成する', '단일 송장 생성', 'Maak een enkele factuur', 'Criar uma única fatura', 'สร้างใบแจ้งหนี้เดียว', 'Tek Fatura Yaratın', 'سنگل انوائس بنائیں', '创建单一发票'),
(508, 'create_multi_invoice', 'Create Multi Invoice', 'মাল্টি চালান তৈরি করুন', 'إنشاء متعدد الفاتورة', 'Créer une facture multiple', 'मल्टी चालान बनाएँ', 'Buat Multi Faktur', 'Crea una fattura multipla', 'マルチインボイスを作成', '다중 송장 생성', 'Creëer meerdere facturen', 'Criar fatura múltipla', 'สร้างใบแจ้งหนี้หลายใบ', 'Çok Fatura Oluştur', 'ملٹی انوائس بنائیں', '创建多个发票'),
(509, 'summary_report', 'Summary Report', 'সারসংক্ষেপ প্রতিবেদন', 'تقرير ملخص', 'Rapport sommaire', 'संक्षिप्त रिपोर्ट', 'Rangkuman laporan', 'Relazione di sintesi', '概略報告', '요약 보고서', 'Samenvattingsverslag', 'Relatório resumido', 'รายงานสรุป', 'Özet raporu', 'سمری رپورٹ', '总结报告'),
(510, 'office_accounting', 'Office Accounting', 'অফিস একাউন্টিং', 'محاسبة المكتب', 'Comptabilité de bureau', 'कार्यालय लेखा', 'Akuntansi Kantor', 'officium Accounting', 'オフィス会計', '회계', 'Office Accounting', 'Contabilidade de Escritórios', 'สำนักงานบัญชี', 'Ofis Muhasebesi', 'آفس اکاؤنٹنگ', '办公室会计'),
(511, 'under_group', 'Under Group', 'দলের অধীনে', 'تحت المجموعة', 'Sous groupe', 'Sous groupe', 'Di bawah Grup', 'Sotto gruppo', 'グループ下', '그룹', 'Onder groep', 'Em grupo', 'ภายใต้กลุ่ม', 'Grup altında', 'گروپ کے تحت', '在集团下'),
(512, 'bank_account', 'Bank Account', 'ব্যাংক হিসাব', 'حساب البنك', 'Compte bancaire', 'बैंक खाता', 'Akun bank', 'Conto bancario', '銀行口座', '은행 계좌', 'Bankrekening', 'Conta bancária', 'บัญชีธนาคาร', 'Banka hesabı', '', 'بینک اکاؤنٹ'),
(513, 'ledger_account', 'Ledger Account', 'লেজার অ্যাকাউন্ট', 'حساب دفتر الأستاذ', 'Compte général', 'बही खाता', 'Akun Buku Besar', 'Account di contabilità generale', '元帳アカウント', '원장 계정', 'Grootboekrekening', 'Conta contábil', 'บัญชีแยกประเภท', 'Muhasebe Hesabı', 'لیجر اکاؤنٹ', '分类帐'),
(514, 'create_voucher', 'Create Voucher', 'ভাউচার তৈরি করুন', 'إنشاء قسيمة', 'Créer votre bon', 'वाउचर बनाएं', 'Buat Voucher', 'Crea un voucher', 'バウチャーを作成', '바우처 만들기', 'Maak een voucher aan', 'Criar comprovante', 'Создать ваучер', '', 'واؤچر بنائیں', '创建凭证'),
(515, 'day_book', 'Day Book', 'জাবেদা', 'كتاب اليوم', 'Livre de jour', 'डे बुक', 'Buku Harian', 'Libro del giorno', 'デイブック', '데이 북', 'Dagboek', 'Livro do dia', 'หนังสือรายวัน', ' Gün Kitabı', 'دن کی کتاب', '日记'),
(516, 'cash_book', 'Cash Book', 'নগদ বই', 'كتاب النقدية', 'Livre de caisse', 'नकद खाता', 'Buku Tunai', 'Buku Tunai', 'Buku Tunai', '현금 도서', 'Buy Books', 'Livro caixa', 'หนังสือเล่มเงินสด', 'Kasa defteri', 'نقد کتاب', '现金簿'),
(517, 'bank_book', 'Bank Book', 'ব্যাংক বই', 'كتاب البنك', 'Livret de banque', 'बैंक की किताब', 'Buku bank', 'Libro bancario', '預金通帳', '은행 통장', 'Bankboek', 'Caderneta bancária', 'สมุดบัญชีธนาคาร', 'Banka defteri', 'بینک کتاب', '存折'),
(518, 'ledger_book', 'Ledger Book', 'খতিয়ান বই', 'دفتر الأستاذ', 'Livre de grand livre', 'लेजर बुक', 'Buku Besar', 'Libro mastro', '元帳ブック', '레저 도서', 'Grootboek', 'Livro contábil', 'สมุดบัญชีแยกประเภท', 'Defter Defteri', 'لیڈر بک', 'Ledger Book'),
(519, 'trial_balance', 'Trial Balance', 'ট্রায়াল ব্যালেন্স', 'ميزان المراجعة', 'Balance d&#39;essai', 'संतुलन परीक्षण', 'Neraca saldo', 'Bilancio di verifica', '試算表', '시산표', 'Proefbalans', 'Balancete', 'งบทดลอง', 'Mizan', 'آزمائشی بیلنس', ' 试算平衡'),
(520, 'settings', 'Settings', 'স্থাপন', 'الإعدادات', 'Réglages', 'सेटिंग्स', 'Pengaturan', 'impostazioni', '設定', '설정', 'instellingen', 'Definições', 'การตั้งค่า', 'Ayarlar', 'ترتیبات', 'ترتیبات'),
(521, 'sms_settings', 'Sms Settings', 'এসএমএস সেটিংস', 'إعدادات الرسائل القصيرة', 'Paramètres Sms', 'एसएमएस सेटिंग्स', 'Pengaturan Sms', 'Sms Settings', 'SMS設定', 'SMS 설정', 'Sms Settings', 'Configurações de SMS', 'การตั้งค่า Sms', 'Sms Ayarları', 'ایس ایم ایس کی ترتیبات', '短信设置'),
(522, 'cash_book_of', 'Cash Book Of', 'ক্যাশ বুক', 'كتاب النقدية من', 'Livre de caisse de', 'की कैश बुक', 'Buku Tunai Dari', 'Libro cassa di', 'キャッシュブック', '현금 도서 중', 'Kasboek van', 'Livro De Dinheiro De', 'บัญชีเงินสดของ', 'Nakit Çek Defteri', 'کیش کی کتاب', '现金簿'),
(523, 'by_cash', 'By Cash', 'নগদে', 'نقدا', 'En espèces', 'नकद द्वारा', 'Dengan uang tunai', 'In contanti', '現金で', '현금으로', 'Contant', 'Em dinheiro', 'โดยเงินสด', 'Nakit', 'نقد کی طرف سے', '用现金'),
(524, 'by_bank', 'By Bank', 'ব্যাংক দ্বারা', 'عن طريق البنك', 'Par banque', 'बैंक द्वारा', 'Oleh Bank', 'Dalla banca', '銀行による', '은행 별', 'Per bank', 'Por banco', 'โดยธนาคาร', 'Banka Tarafından', 'بینک کی طرف سے', '由银行'),
(525, 'total_strength', 'Total Strength', 'মোট শক্তি', 'القوة الكلية', 'Force totale', 'कुल ताकत', 'Total Kekuatan', 'Forza totale', '総強度', '총 강도', 'Totale sterkte', 'Força total', 'ความแข็งแรงโดยรวม', 'Toplam gücü', 'کل طاقت', '总强度'),
(526, 'teachers', 'Teachers', 'শিক্ষক', 'معلمون', 'Enseignants', 'शिक्षकों की', 'Guru', 'Insegnanti', '先生', '교사들', 'leerkrachten', 'Professores', 'ครูผู้สอน', 'Öğretmenler', 'اساتذہ', '老师'),
(527, 'student_quantity', 'Student Quantity', 'ছাত্র পরিমাণ', 'كمية الطالب', 'Quantité d\'étudiant', 'छात्र मात्रा', 'Jumlah Mahasiswa', 'Quantità di studenti', '学生数', '학생 수', 'Student Aantal', 'Quantidade de estudantes', 'Количество учеников', 'Öğrenci Miktarı', 'طالب علم کی مقدار', '学生数量'),
(528, 'voucher', 'Voucher', 'রসিদ', 'قسيمة', 'Bon', 'वाउचर', 'Voucher', 'Voucher; tagliando', 'バウチャー', '보증인', 'bon', 'Comprovante', 'คูปอง', 'fiş', 'واؤچر', 'واؤچر'),
(529, 'total_number', 'Total Number', 'মোট সংখ্যা', 'মোট সংখ্যা', 'Nombre total', 'कुल संख्या', 'Jumlah total', 'Numero totale', '総数', '総数', 'Número total', 'Número total', 'จำนวนรวม', 'Toplam sayısı', 'کل تعداد', '总数'),
(530, 'total_route', 'Total Route', 'মোট রুট', 'الطريق الإجمالي', 'Total Route', 'कुल रूट', 'Rute Total', 'Percorso totale', 'トータルルート', '총 경로', 'Total Route', 'Total Route', 'เส้นทางทั้งหมด', 'Toplam Güzergah', 'کل روٹ', '总路线'),
(531, 'total_room', 'Total Room', 'মোট কক্ষ', 'مجموع الغرفة', 'Chambre totale', 'कुल कमरा', 'Total Kamar', 'Stanza totale', 'トータルルーム', '총 방', 'Totaal kamer', 'Quarto total', 'รวมห้องพัก', 'Toplam oda', 'کل کمرہ', '总房间'),
(532, 'amount', 'Amount', 'পরিমাণ', 'كمية', 'Montant', 'रकम', 'Jumlah', 'Jumlah', '量', '양', 'Bedrag', 'Montante', 'จำนวน', 'Miktar', 'Miktar', '量'),
(533, 'branch_dashboard', 'Branch Dashboard', 'শাখা ড্যাশবোর্ড', 'لوحة تحكم الفرع', 'Tableau de bord de branche', 'शाखा डैशबोर्ड', 'Dashboard Cabang', 'Dashboard del ramo', 'ブランチダッシュボード', '지점 대시 보드', 'Branch Dashboard', 'Painel de filiais', 'สาขาแดชบอร์ด', 'Şube Panosu', 'برانچ ڈیش بورڈ', '分支仪表板'),
(534, 'branch_list', 'Branch List', 'শাখা তালিকা', 'قائمة الفرع', 'Liste de branche', 'शाखा सूची', 'Daftar Cabang', 'Elenco delle filiali', '支店リスト', '지점 목록', 'Branchelijst', 'Lista de Filial', 'รายชื่อสาขา', 'รายชื่อสาขา', 'รายชื่อสาขา', '分行名单'),
(535, 'create_branch', 'Create Branch', 'শাখা তৈরি করুন', 'إنشاء فرع', 'Créer une branche', 'शाखा बनाएँ', 'Buat Cabang', 'Crea un ramo', 'ブランチを作成', '지점 만들기', 'Maak filiaal', 'Criar Filial', 'สร้างสาขา', 'Şube Yarat', 'برانچ بنائیں', '创建分支'),
(536, 'branch_name', 'Branch Name', 'শাখার নাম', 'اسم الفرع', 'Nom de la filiale', 'शाखा का नाम', 'Nama cabang', 'Nome del ramo', '支店名', '지점명', 'Filiaalnaam', 'Nome da Filial', 'ชื่อสาขา', 'Şube Adı', 'برانچ کا نام', '分店名称'),
(537, 'school_name', 'School Name', 'স্কুল নাম', 'اسم المدرسة', 'Nom de l&#39;école', 'विद्यालय का नाम', 'Nama sekolah', 'Nome della scuola', '学校名', '학교 이름', 'Schoolnaam', 'Nome da escola', 'ชื่อโรงเรียน', 'Okul Adı', 'سکول کا نام', '学校名称'),
(538, 'mobile_no', 'Mobile No', 'মোবাইল নাম্বার', 'رقم الموبايل', 'Mobile No', 'मोबाइल नहीं है', 'Nomor telepon seluler', 'Cellulare n', '携帯電話番号', '모바일 아니요', 'Mobiel Nee', 'Mobile No', 'หมายเลขโทรศัพท์มือถือ', 'Telefon numarası', 'موبائل نمبر', '手机号码'),
(539, 'symbol', 'Symbol', 'পরিমাণ', 'رمز', 'symbole', 'प्रतीक', 'Simbol', 'Simbolo', 'シンボル', '상징', 'Symbool', 'Símbolo', 'สัญลักษณ์', 'sembol', 'علامت', '符号'),
(540, 'city', 'City', 'শহর', 'مدينة', 'Ville', 'शहर', 'Kota', 'città', '市', '도시', 'City', 'Cidade', 'เมือง', 'şehir', 'شہر', '城市'),
(541, 'academic_year', 'Academic Year', 'একাডেমিক বছর', 'السنة الأكاديمية', 'Année académique', 'शैक्षणिक वर्ष', 'Tahun akademik', 'Anno accademico', '学年', '학년', 'Academiejaar', 'Ano acadêmico', 'ปีการศึกษา', 'Akademik yıl', 'تعلیمی سال', '学年'),
(542, 'select_branch_first', 'First Select The Branch', 'প্রথমে শাখা নির্বাচন করুন', 'أولا اختر الفرع', 'D\'abord, sélectionnez la branche', 'सबसे पहले शाखा का चयन करें', 'Pertama Pilih Cabang', 'Prima seleziona il ramo', '最初に支店を選択', '먼저 지점 선택', 'Selecteer eerst de vestiging', 'Primeiro selecione o ramo', 'ก่อนอื่นเลือกสาขา', 'İlk Şube Seç', 'سب سے پہلے برانچ منتخب کریں', '首先选择分支'),
(543, 'select_class_first', 'Select Class First', 'ক্লাস প্রথম নির্বাচন করুন', 'اختر الفئة الأولى', 'Sélectionnez la classe d&#39;abord', 'कक्षा प्रथम का चयन करें', 'Pilih Kelas Pertama', 'Seleziona prima la classe', '最初にクラスを選択', '클래스 우선 선택', 'Selecteer eerst klasse', 'Selecione a primeira classe', 'เลือก Class First', 'Önce sınıfı seç', 'سب سے پہلے منتخب کریں کلاس', '选择Class First'),
(544, 'select_country', 'Select Country', 'দেশ নির্বাচন করুন', 'حدد الدولة', 'Choisissez le pays', 'देश चुनिए', 'Pilih negara', 'Pilih negara', '国を選択', '国を選択', '国を選択', 'Selecione o pais', 'เลือกประเทศ', 'Ülke Seç', 'ملک کا انتخاب کیجئے', '选择国家'),
(545, 'mother_tongue', 'Mother Tongue', 'মাতৃভাষা', 'اللغة الأم', 'Langue maternelle', 'मातृ भाषा', 'Bahasa ibu', 'Madrelingua', '母国語', '母国語', 'Moedertaal', 'Língua nativa', 'ภาษาหลัก', 'Ana dil', 'مادری زبان', '母语'),
(546, 'caste', 'Caste', 'বর্ণ', 'الطائفة', 'Caste', 'जाति', 'Kasta', 'Casta', 'カースト', '카스트', 'Kaste', 'Casta', 'วรรณะ', 'Kast', 'ذات', '种姓'),
(547, 'present_address', 'Present Address', 'বর্তমান ঠিকানা', 'العنوان الحالي', 'Adresse actuelle', 'वर्तमान पता', 'Alamat sekarang', 'Indirizzo attuale', '現住所', '현재 주소', 'Huidig ​​adres', 'Endereço presente', 'ที่อยู่ปัจจุบัน', 'ที่อยู่ปัจจุบัน', 'موجودہ پتہ', '现在的住址'),
(548, 'permanent_address', 'Permanent Address', 'স্থায়ী ঠিকানা', 'العنوان الثابت', 'Permanent Address', 'स्थाई पता', 'alamat tetap', 'Residenza', 'Residenza', '영구 주소', 'Oratio permanent', 'Oratio permanent', 'Постоянный адрес', 'daimi Adres', 'مستقل پتہ', '永久地址'),
(549, 'profile_picture', 'Profile Picture', 'প্রোফাইল ছবি', 'الصوره الشخصيه', 'Image de profil', 'प्रोफ़ाइल फोटो', 'Gambar profil', 'Immagine del profilo', 'プロフィールの写真', '프로필 사진', 'Profielfoto', 'Foto do perfil', 'รูปประวัติ', 'Profil fotoğrafı', 'پروفائل تصویر', '个人资料图片'),
(550, 'login_details', 'Login Details', 'লগ ইন তথ্য', 'تفاصيل تسجيل الدخول', 'détails de connexion', 'लॉगइन विवरण', 'rincian masuk', 'dettagli del login', 'ログインの詳細', 'ログインの詳細', 'inloggegevens', 'detalhes de login', 'เข้าสู่ระบบรายละเอียด', 'เข้าสู่ระบบรายละเอียด', 'เข้าสู่ระบบรายละเอียด', '登录详细信息'),
(551, 'retype_password', 'Retype Password', 'পাসওয়ার্ড আবার টাইপ', 'أعد إدخال كلمة السر', 'Retaper le mot de passe', 'Retaper le mot de passe', 'Ketik ulang kata sandi', 'Ripeti password', 'Ripeti password', '암호 다시 입력', 'Geef nogmaals het wachtwoord', 'Redigite a senha', 'พิมพ์รหัสผ่านอีกครั้ง', 'Şifrenizi yeniden yazın', 'Şifrenizi yeniden yazın', '重新输入密码'),
(552, 'occupation', 'Occupation', 'পেশা', 'الاحتلال', 'Ocupación', 'व्यवसाय', 'Pendudukan', 'Occupazione', '職業', '직업', 'Bezetting', 'Ocupação', 'อาชีพ', 'Meslek', 'Meslek', '占用'),
(553, 'income', 'Income', 'আয়', 'الإيرادات', 'Ingresos', 'आय', 'Pendapatan', 'Reddito', '所得', '수입', 'Inkomen', 'Renda', 'доход', 'Gelir', 'آمدنی', '收入'),
(554, 'education', 'Education', 'শিক্ষা', 'التعليم', 'Éducation', 'शिक्षा', 'pendidikan', 'Formazione scolastica', '教育', '교육', 'Opleiding', 'Educação', 'การศึกษา', 'Eğitim', 'تعلیم', 'تعلیم'),
(555, 'first_select_the_route', 'First Select The Route', 'প্রথম রুট নির্বাচন করুন', 'أولا اختر الطريق', 'D&#39;abord sélectionnez l&#39;itinéraire', 'पहले मार्ग का चयन करें', 'Pertama Pilih Rute', 'Prima selezionare la rotta', '最初にルートを選択', '먼저 경로 선택', 'Selecteer eerst de route', 'Primeiro selecione a rota', 'ก่อนอื่นเลือกเส้นทาง', 'İlk önce Rotayı Seçin', 'پہلا راستہ منتخب کریں', '首先选择路线'),
(556, 'hostel_details', 'Hostel Details', 'হোটেল বিবরণ', 'تفاصيل النزل', 'Détails de l\'hôtel', 'छात्रावास का विवरण', 'Detail Hostel', 'Dettagli dell\'hotel', 'ホステルの詳細', '호스텔 상세 정보', 'Hostel details', 'Detalhes do Hostel', 'รายละเอียดโฮสเทล', 'Hostel Detayları', 'ہاؤس کی تفصیلات', '旅舍详情'),
(557, 'first_select_the_hostel', 'First Select The Hostel', 'প্রথম ছাত্রাবাস নির্বাচন', 'প্রথম ছাত্রাবাস নির্বাচন', 'd\'abord sélectionner l\'hôtel', 'पहले छात्रावास का चयन करें', 'pertama-tama pilih hostel', 'prima selezionare l&#39;ostello', '最初にホステルを選ぶ', '먼저 호스텔을 선택하십시오.', 'selecteer eerst het hostel', 'primeiro selecione o albergue', 'ก่อนอื่นเลือกโฮสเทล', 'önce hosteli seç', 'سب سے پہلے ہاسٹل کا انتخاب کریں', '首先选择宿舍'),
(558, 'previous_school_details', 'Previous School Details', 'পূর্ববর্তী স্কুল বিবরণ', 'تفاصيل المدرسة السابقة', 'Privilege School Détails', 'पिछला स्कूल विवरण', 'Detail Sekolah Sebelumnya', 'Dettagli della scuola precedente', '前の学校の詳細', '이전 학교 세부 사항', 'Vorige schoolgegevens', 'Detalhes da escola anterior', 'รายละเอียดโรงเรียนก่อนหน้า', 'Önceki Okul Detayları', 'Önceki Okul Detayları', '以前的学校细节'),
(559, 'book_name', 'Book Name', 'বইয়ের নাম', 'اسم الكتاب', 'Nom du livre', 'पुस्तक का नाम', 'Nama Buku', 'Nome del libro', '本の名前', '도서 이름', 'Boeknaam', 'Boeknaam', 'ชื่อหนังสือ', 'ชื่อหนังสือ', 'کتاب کا نام', '书名'),
(560, 'select_ground', 'Select Ground', 'গ্রাউন্ড নির্বাচন করুন', 'اختر الأرض', 'sélectionnez Ground', 'ग्राउंड का चयन करें', 'pilih Ground', 'seleziona Terra', 'グラウンドを選択', '접지 선택', 'selecteer Ground', 'selecione Ground', 'เลือกกราวด์', 'Zemin seç', 'گراؤنڈ منتخب کریں', '选择地面'),
(561, 'import', 'Import', 'আমদানি', 'استيراد', 'Importation', 'आयात', 'Impor', 'Importare', 'インポート', '수입', 'Importeren', 'Importar', 'นำเข้า', 'İthalat', 'درآمد کریں', '进口'),
(562, 'add_student_category', 'Add Student Category', 'ছাত্র বিভাগ যোগ করুন', 'إضافة فئة الطالب', 'Ajouter une catégorie d&#39;étudiant', 'छात्र श्रेणी जोड़ें', 'Tambahkan Kategori Siswa', 'Aggiungi categoria studente', '学生カテゴリを追加', '학생 카테고리 추가', 'Voeg categorie toe', 'Adicionar categoria de aluno', 'เพิ่มหมวดหมู่นักศึกษา', 'Öğrenci Kategorisi Ekle', 'طالب علم کا زمرہ شامل کریں', '添加学生类别'),
(563, 'id', 'Id', 'আইডি', '', 'Id', 'ईद', 'Id', 'Id', 'Id', '신분증', 'ID kaart', 'Identidade', 'Id', 'İD', 'آئی ڈی', 'ID'),
(564, 'edit_category', 'Edit Category', 'বিভাগ সম্পাদনা করুন', 'تحرير الفئة', 'Modifier la catégorie', 'श्रेणी संपादित करें', 'Edit Kategori', 'Modifica categoria', 'カテゴリを編集', '카테고리 편집', 'Categorie bewerken', 'Editar categoria', 'แก้ไขหมวดหมู่', 'Kategoriyi Düzenle', 'زمرہ میں ترمیم کریں', '编辑类别'),
(565, 'deactivate_account', 'Deactivate Account', 'অ্যাকাউন্ট নিষ্ক্রিয় করুন', 'تعطيل الحساب', 'Désactiver le compte', 'खाता निष्क्रिय करें', 'Nonaktifkan Akun', 'Disattiva Account', 'アカウントを無効化し', '계정 비활성화', 'account deactiveren', 'Desativar conta', 'ปิดใช้งานบัญชี', 'Aktif edilmemiş hesap', 'اکاؤنٹ کو غیر فعال کریں', '关闭户口'),
(566, 'all_sections', 'All Sections', 'সব বিভাগ', 'كل الأقسام', 'toutes les sections', 'सभी वर्गों', 'semua bagian', 'tutte le sezioni', '全セクション', '모든 섹션', 'alle secties', 'todas as seções', 'ทุกส่วน', 'tüm bölümler', 'تمام حصوں', '所有部分'),
(567, 'authentication_activate', 'Authentication Activate', 'প্রমাণীকরণ সক্রিয় করুন', 'تفعيل المصادقة', 'Authentification Activer', 'प्रमाणीकरण सक्रिय करें', 'Aktifkan Otentikasi', 'Autenticazione Attivare', '認証を有効にする', '인증 활성화', 'Authenticatie Activeren', 'Autenticação Ativar', 'การตรวจสอบสิทธิ์เปิดใช้งาน', 'Kimlik Doğrulama Etkinleştir', 'توثیقی چالو', '身份验证激活'),
(568, 'department', 'Department', 'বিভাগ', ' قسم، أقسام', 'département', 'विभाग', 'Departemen', 'Dipartimento', '部門', '학과', 'afdeling', 'Departamento', 'แผนก', 'Bölüm', 'شعبہ', '部门'),
(569, 'salary_grades', 'Salary Grades', 'বেতন গ্রেড', 'راتب', 'Note salariale', 'वेतन ग्रेड', 'Tingkat Gaji', 'Grado di stipendio', '給与グレード', '급여 등급', 'Salarisrang', 'Grau Salarial', 'ระดับเงินเดือน', 'Maaş notu', 'تنخواہ گریڈ', '薪资等级'),
(570, 'overtime', 'Overtime Rate (Per Hour)', 'ওভারটাইম হার (প্রতি ঘন্টা)', 'معدل العمل الإضافي (لكل ساعة)', 'taux des heures supplémentaires (à l\'heure)', 'ओवरटाइम दर (प्रति घंटे)', 'tingkat lembur (Per Jam)', 'tasso di straordinario (per ora)', '超過勤務率（1時間あたり）', '초과 근무 요율 (시간당)', 'overwerk tarief (Per uur)', 'taxa de horas extras (por hora)', 'อัตราการทำงานล่วงเวลา (ต่อชั่วโมง)', 'fazla mesai ücreti (Saat Başı)', 'اضافی شرح (فی گھنٹہ)', '加班费（每小时）'),
(571, 'salary_grade', 'Salary Grade', 'বেতন গ্রেড', 'راتب', 'Note salariale', 'वेतन ग्रेड', 'Tingkat Gaji', 'Grado di stipendio', '給与グレード', '급여 등급', 'Salarisrang', 'Grau Salarial', 'ระดับเงินเดือน', 'Maaş notu', 'تنخواہ گریڈ', '薪资等级'),
(572, 'payable_type', 'Payable Type', 'প্রদেয় প্রকার', 'نوع الدفع', 'Payable Type', 'देय प्रकार', 'Jenis Hutang', 'Tipo pagabile', '支払タイプ', '지불 유형', 'Betaalbaar type', 'Tipo pagável', 'ประเภทเจ้าหนี้', 'Ödenecek Tür', 'پائیدار قسم', '应付款式'),
(573, 'edit_type', 'Edit Type', 'টাইপ সম্পাদনা করুন', 'تحرير النوع', 'Τύπος επεξεργασίας', 'प्रकार संपादित करें', 'Edit Jenis', 'Modifica il tipo', 'タイプを編集', '유형 편집', 'Bewerk type', 'Editar tipo', 'แก้ไขประเภท', 'Türü Düzenle', 'قسم میں ترمیم کریں', '编辑类型'),
(574, 'role', 'Role', 'ভূমিকা', 'وظيفة', 'Rôle', 'भूमिका', 'Peran', 'Peran', '役割', '役割', '役割', 'Função', 'บทบาท', 'rol', 'کردار', '角色'),
(575, 'remuneration_info_for', 'Remuneration Info For', 'বেতন জন্য তথ্য', 'الأجور معلومات عن', 'Information de rémunération pour', 'पारिश्रमिक जानकारी के लिए', 'Info Remunerasi Untuk', 'Informazioni sulla remunerazione per', 'の報酬情報', '보수 정보', 'Remuneratie-info voor', 'Informações sobre Remuneração Para', 'Информация о вознаграждении за', 'Ücret Bilgisi', 'یاد دہانی کے لئے معلومات', '薪酬信息'),
(576, 'salary_paid', 'Salary Paid', 'বেতন দেওয়া', 'الراتب المدفوع', 'Salaire payé', 'वेतन भुगतान', 'Gaji Dibayar', 'Stipendio pagato', '給与を支払った', '유급 급여', 'Salaris betaald', 'Salário Pago', 'เงินเดือนจ่าย', 'Ücretli', 'تنخواہ ادا کی', '工资支付'),
(577, 'salary_unpaid', 'Salary Unpaid', 'বেতন পরিশোধ না', 'الراتب غير مدفوع', 'Salaire impayé', 'वेतन अवैतनिक', 'Gaji Tidak Dibayar', 'Salario non retribuito', '給与未払い', '무급 급여', 'Salaris onbetaald', 'Salário não remunerado', 'เงินเดือนค้างชำระ', 'Ödenmemiş Maaş', 'تنخواہ غیر حاضر', '工资未付'),
(578, 'pay_now', 'Pay Now', 'এখন পরিশোধ করুন', 'ادفع الآن', 'Payez maintenant', 'अब भुगतान करें', 'Bayar sekarang', 'Paga ora', '今払う', '지금 지불하세요', 'Nu betalen', 'Pague agora', 'จ่ายตอนนี้', 'Şimdi öde', 'اب ادا', '现在付款'),
(579, 'employee_role', 'Employee Role', 'কর্মচারী ভূমিকা', 'دور الموظف', 'Rôle de l\'employé', 'कर्मचारी की भूमिका', 'Peran Karyawan', 'Ruolo dei dipendenti', '従業員の役割', '직원 역할', 'Medewerkersrol', 'Função do Empregado', 'บทบาทของพนักงาน', 'Çalışan Rolü', 'ملازم کردار', '员工角色'),
(580, 'create_at', 'Create At', 'এ তৈরি করুন', 'خلق في', 'Créer à', 'पर बनाएँ', 'Buat Di', 'Crea At', 'で作成', '에서 생성', 'Maak At', 'Criar em', 'สร้างที่', 'At oluştur', 'بنائیں', '创建于'),
(581, 'select_employee', 'Select Employee', 'কর্মচারী নির্বাচন করুন', 'اختر الموظف', 'Sélectionnez un employé', 'कर्मचारी का चयन करें', 'Pilih Karyawan', 'Pilih Karyawan', '従業員を選択', '직원 선택', 'Aliquam selecta', 'Selecione Empregado', 'Выберите сотрудника', 'Выберите сотрудника', 'ملازم کا انتخاب کریں', '选择员工'),
(582, 'review', 'Review', 'পর্যালোচনা', 'إعادة النظر', 'revisión', 'समीक्षा', 'समीक्षा', 'Revisione', '見直し', '리뷰', 'Beoordeling', 'Reveja', 'ทบทวน', 'gözden geçirmek', 'جائزہ لیں', '评论'),
(583, 'reviewed_by', 'Reviewed By', 'দ্বারা পর্যালোচনা', 'تمت مراجعته من قبل', 'Revu par', 'द्वारा समीक्षित', 'Diperiksa oleh', 'Recensito da', 'によってレビューされた', '검토 자', 'Beoordeeld door', 'Revisados ​​pela', 'สอบทานโดย', 'Tarafından gözden geçirildi', 'کی طرف سے جائزہ لیا گیا', '评论人'),
(584, 'submitted_by', 'Submitted By', 'দ্বারা জমা দেওয়া', 'المقدمة من قبل', 'Proposé par', 'द्वारा प्रस्तुत', 'Disampaikan oleh', 'Inviato da', 'Inviato da', '에 의해 제출 된', 'Ingediend door', 'Enviado por', 'ส่งมาโดย', 'Tarafından gönderilmiştir', 'کی طرف سے پیش', '由...所提交'),
(585, 'employee_type', 'Employee Type', 'কর্মচারী টাইপ', 'نوع موظف', 'Type d\'employé', 'कर्मचारी का प्रकार', 'Jenis Karyawan', 'Tipo di dipendente', '従業員の種類', '종업원 유형', 'Werknemerstype', 'Tipo de Empregado', 'ประเภทพนักงาน', 'Çalışan tipi', 'ملازم کی قسم', '员工类型'),
(586, 'approved', 'Approved', 'অনুমোদিত', 'وافق', 'Approuvé', 'मंजूर की', 'Disetujui', 'Approvato', '承認済み', '승인 됨', 'aangenomen', 'Aprovado', 'ได้รับการอนุมัติ', 'onaylı', 'منظورشدہ', 'منظورشدہ'),
(587, 'unreviewed', 'Unreviewed', 'পর্যালোচনা না করা', 'غير مراجع', 'Non revu', 'समीक्षा नहीं की गई', 'Belum ditinjau', 'unreviewed', '未審査', '검토되지 않은', 'Niet-beoordeelde', 'Não revisado', 'ก่อนสอบทาน', 'İncelenmeyenler', 'ناظر', '未经审核'),
(588, 'creation_date', 'Creation Date', 'তৈরির তারিখ', 'تاريخ الإنشاء', 'Creation Date', 'रचना तिथि', 'Tanggal Pembuatan', 'Data di creazione', '作成日', '제작 일', 'Aanmaakdatum', 'Data de criação', 'วันที่สร้าง', 'Oluşturulma tarihi', 'بنانے کی تاریخ', 'بنانے کی تاریخ'),
(589, 'no_information_available', 'No Information Available', 'কোন তথ্য নেই', 'لا توجد معلومات متاحة', 'Pas d\'information disponible', 'कोई जानकारी उपलब्ध नहीं', 'Tidak ada informasi tersedia', 'Nessuna informazione disponibile', '情報なし', '정보 없음', 'Geen informatie beschikbaar', 'Nenhuma informação disponível', 'ไม่มีข้อมูล', 'Bilgi bulunmamaktadır', 'کوئی معلومات دستیاب نہیں ہے', '无资料'),
(590, 'continue_to_payment', 'Continue To Payment', 'পেমেন্ট অবিরত', 'مواصلة الدفع', 'Continuer au paiement', 'भुगतान जारी रखें', 'Fizetés folytatása', 'Continua a pagamento', '支払いを続ける', '계속 지불하기', 'Doorgaan naar betaling', 'Continuar para pagamento', 'ดำเนินการต่อเพื่อชำระเงิน', 'Ödeme devam', 'ادائیگی پر جاری رکھیں', '继续付款'),
(591, 'overtime_total_hour', 'Overtime Total Hour', 'ওভারটাইম মোট ঘন্টা', 'الساعة الاجمالية', 'Heures totales supplémentaires', 'ओवरटाइम कुल घंटे', 'Túlóra Teljes óra', 'Ora totale straordinario', '残業総時間', '초과 근무 시간', 'Overuren Totaal uur', 'Horas Totais de Horas Extras', 'ชั่วโมงทำงานทั้งหมด', 'Fazla Mesai Toplam Saati', 'عموما کل وقت', '加班总时数'),
(592, 'overtime_amount', 'Overtime Amount', 'ওভারটাইম পরিমাণ', 'مبلغ العمل الإضافي', 'Heures supplémentaires', 'ओवरटाइम राशि', 'Jumlah Lembur', 'Quantità Overtime', '残業金額', '초과 근무 시간', 'Overwerkbedrag', 'Overwerkbedrag', 'ปริมาณการทำงานล่วงเวลา', 'Fazla Mesai Tutarı', 'عموما رقم', '加班金额'),
(593, 'remarks', 'Remarks', 'মন্তব্য', 'تعليق', 'Remarque', 'टिप्पणी', 'Ucapan', 'Ucapan', 'Ucapan', '말', 'Opmerking', 'Opmerking', 'Opmerking', 'Opmerking', 'تبصرہ', '备注'),
(594, 'view', 'View', 'দৃশ্য', 'رأي', 'Vue', 'राय', 'Melihat', 'vista', '見る', '전망', 'Uitzicht', 'Visão', 'ดู', 'Görünüm', 'دیکھیں', '视图'),
(595, 'leave_appeal', 'Leave Appeal', 'আবেদন ছেড়ে', 'اترك الاستئناف', 'Laisser appel', 'अपील छोड़ दो', 'Tinggalkan Banding', 'Invia Appello', 'アピールを残す', '상소를 떠나다', 'Verlaat Appeal', 'Deixar recurso', 'ออกจากการอุทธรณ์', 'Temyizden Ayrılmak', 'اپیل چھوڑ دو', '离开上诉'),
(596, 'create_leave', 'Create Leave', 'ছুটি তৈরি করুন', 'خلق إجازة', 'Créer un congé', 'छुट्टी बनाएँ', 'Buat Cuti', 'Crea permesso', '休暇を作成', '떠나기 만들기', 'Maak verlof', 'Criar licença', 'สร้างการลา', 'İzin Oluştur', 'چھوڑ دو', '创造假'),
(597, 'user_role', 'User Role', 'ব্যবহারকারী ভূমিকা', 'دور المستخدم', 'Rôle de l\'utilisateur', 'उपयोगकर्ता भूमिका', 'Peran pengguna', 'Ruolo utente', 'ユーザー役割', '사용자 역할', 'Gebruikersrol', 'Papel do usuário', 'บทบาทของผู้ใช้', 'Kullanıcı rolü', 'صارف کردار', '用户角色'),
(598, 'date_of_start', 'Date Of Start', 'শুরু তারিখ', 'تاريخ البدء', 'Date de début', 'प्रारंभ की तिथि', 'Tanggal Mulai', 'Data di inizio', '開始日', '시작 날짜', 'Startdatum', 'Data de início', 'วันที่เริ่ม', 'Başlangıç ​​tarihi', 'آغاز کی تاریخ', '开始日期'),
(599, 'date_of_end', 'Date Of End', 'শেষ তারিখ', 'تاريخ النهاية', 'Date de fin', 'समाप्ति की तारीख', 'Tanggal Berakhir', 'Data della fine', '終了日', '끝 날짜', 'Datum van einde', 'Data do fim', 'วันที่สิ้นสุด', 'Bitiş Tarihi', 'اختتام کی تاریخ', '结束日期'),
(600, 'winner', 'Winner', 'বিজয়ী', 'الفائز', 'Gagnantविजेता', 'विजेता', 'Pemenang', 'Vincitore', '勝者', '우승자', 'Winnaar', 'Vencedora', 'ผู้ชนะ', 'kazanan', 'فاتح', '优胜者'),
(601, 'select_user', 'Select User', 'ব্যবহারকারী নির্বাচন করুন', 'اختر المستخدم', 'Sélectionner un utilisateur', 'उपयोगकर्ता का चयन करें', 'Pilih Pengguna', 'Seleziona utente', 'ユーザーを選択', '사용자 선택', 'selecteer gebruiker', 'Selecione o usuário', 'เลือกผู้ใช้', 'Kullanıcı seç', 'صارف کا انتخاب کریں', 'صارف کا انتخاب کریں'),
(602, 'create_class', 'Create Class', 'ক্লাস তৈরি করুন', 'خلق الطبقة', 'Créer une classe', 'क्लास बनाएं', 'Buat Kelas', 'Crea classe', 'クラスを作成', '클래스 만들기', 'Maak klasse', 'Criar classe', 'สร้างคลาส', 'Sınıf Oluştur', 'کلاس بنائیں', '创建类'),
(603, 'class_teacher_allocation', 'Class Teacher Allocation', 'ক্লাস শিক্ষক বরাদ্দ', 'تخصيص معلم الصف', 'Allocation d\'enseignant de classe', 'कक्षा शिक्षक आवंटन', 'Alokasi Guru Kelas', 'Assegnazione degli insegnanti di classe', 'クラス教師の割り当て', '수업 교사 배정', 'Klasse docent toewijzing', 'Alocação de professores de turma', 'การจัดสรรครูประจำชั้น', 'Sınıf Öğretmeni Tahsisi', 'کلاس ٹیچر مختص', '班主任分配'),
(604, 'class_teacher', 'Class Teacher', 'শ্রেণী শিক্ষক', 'معلم الصف', 'Professeur de classe', 'कक्षा अध्यापक', 'Guru kelas', 'Insegnante', 'クラスの先生', '선생님', 'Klassen leraar', 'Professor da classe', 'ครูประจำชั้น', 'Sınıf öğretmeni', 'کلاس ٹیچر', '班主任'),
(605, 'create_subject', 'Create Subject', 'বিষয় তৈরি করুন', 'خلق الموضوع', 'Créer un sujet', 'विषय बनाएँ', 'Buat Subjek', 'Crea soggetto', '件名を作成', '제목 만들기', 'Onderwerp maken', 'Criar assunto', 'สร้างหัวเรื่อง', 'Konu Oluştur', 'موضوع بنائیں', '创建主题'),
(606, 'select_multiple_subject', 'Select Multiple Subject', 'একাধিক বিষয় নির্বাচন করুন', 'حدد موضوع متعدد', 'Sélectionnez plusieurs sujets', 'एकाधिक विषय का चयन करें', 'Pilih Banyak Subjek', 'Seleziona più soggetti', '複数の件名を選択', '여러 제목 선택', 'Selecteer meerdere onderwerpen', 'Выберите несколько объектов', 'เลือกหลายวิชา', 'Birden Çok Konu Seçin', 'ایک سے زیادہ موضوع منتخب کریں', '');
INSERT INTO `languages` (`id`, `word`, `english`, `bengali`, `arabic`, `french`, `hindi`, `indonesian`, `italian`, `japanese`, `korean`, `dutch`, `portuguese`, `thai`, `turkish`, `urdu`, `chinese`) VALUES
(607, 'teacher_assign', 'Teacher Assign', 'শিক্ষক নিয়োগ', 'تعيين المعلم', 'Affectation de l&#39;enseignant', 'शिक्षक का पदभार', 'Tugas Guru', 'Insegnante', '教師アサイン', '교사 지정', 'Leraar toewijzen', 'Atribuição de professor', 'ครูมอบหมาย', 'Öğretmen Ataması', 'ٹیچر کو تفویض', '老师分配'),
(608, 'teacher_assign_list', 'Teacher Assign List', 'শিক্ষক নিয়োগ তালিকা', 'قائمة تعيين المعلم', 'Liste d\'affectation des enseignants', 'शिक्षक असाइनमेंट सूची', 'Daftar Tugas Guru', 'Lista degli insegnanti', '教師割り当てリスト', '교사 지정 목록', 'Teacher Assign List', 'Lista de Atribuições do Professor', 'Список назначенных учителей', 'Öğretmen Atama Listesi', 'ٹیچر کی فہرست کی فہرست', '教师分配清单'),
(609, 'select_department_first', 'Select Department First', 'বিভাগ প্রথম নির্বাচন করুন', 'اختر القسم أولا', 'Sélectionnez d\'abord le département', 'पहले विभाग का चयन करें', 'Pilih Departemen Pertama', 'Seleziona prima il dipartimento', '最初に部署を選択', '부서 우선 선택', 'Selecteer eerst Afdeling', 'Selecione o departamento primeiro', 'เลือกแผนกก่อน', 'Önce Bölümü Seç', 'پہلے محکمہ منتخب کریں', '选择部门优先'),
(610, 'create_book', 'Create Book', 'বই তৈরি করুন', 'انشاء كتاب', 'Créer un livre', 'पुस्तक बनाएँ', 'Buat Buku', 'Crea libro', '本を作成', '도서 만들기', 'Maak een boek', 'Criar livro', 'สร้างหนังสือ', 'Kitap Oluştur', 'کتاب بنائیں', '创建书'),
(611, 'book_title', 'Book Title', 'বইয়ের শিরোনাম', 'عنوان كتاب', 'Titre de livre', 'पुस्तक का शीर्षक', 'Könyvcím', 'Titolo del libro', '本のタイトル', '책 제목', 'Boek titel', 'Título do livro', 'ชื่อหนังสือ', 'Kitap başlığı', 'کتاب کا عنوان', '书名'),
(612, 'cover', 'Cover', 'আবরণ', 'التغطية', 'couverture', 'couverture', 'penutup', 'copertina', 'copertina', '덮개', 'deksel', 'tampa', 'ปก', 'kapak', 'کور', '覆盖'),
(613, 'edition', 'Edition', 'সংস্করণ', 'الإصدار', 'Édition', 'संस्करण', 'Edisi', 'Edizione', '版', '판', 'Editie', 'Edição', 'ฉบับ', 'Baskı', 'ایڈیشن', '版'),
(614, 'isbn_no', 'ISBN No', 'ISBN নং', 'رقم Isbn', 'Isbn No', 'इसबैन नं', 'Isbn No', 'Isbn No', 'Isbn No', 'Isbn No', 'Isbn No', 'Isbn No', 'เลขที่', 'Isbn Hayır', 'اسبین نمبر', 'Isbn No'),
(615, 'purchase_date', 'Purchase Date', 'ক্রয় তারিখ', 'تاريخ الشراء', 'date d\'achat', 'खरीद की तारीख', 'Tanggal Pembelian', 'Data di acquisto', '購入日', '구입 날짜', 'aankoopdatum', 'data de compra', 'วันที่ซื้อ', 'Satınalma tarihi', 'خریداری کی تاریخ', 'خریداری کی تاریخ'),
(616, 'cover_image', 'Cover Image', 'কভার চিত্র', 'صورة الغلاف', 'Cover Image', 'Cover Image', 'Gambar sampul', 'Immagine di copertina', '表紙画像', '표지 이미지', 'Omslagfoto', 'Imagem de capa', 'รูปภาพหน้าปก', 'Kapak resmi', 'کور تصویر', '封面图片'),
(617, 'book_issue', 'Book Issue', 'বই ইস্যু', 'كتاب القضية', 'Numéro de livre', 'पुस्तक का अंक', 'Masalah Buku', 'Numero del libro', '本の問題', '도서 문제', 'Boek kwestie', 'Edição do livro', 'ปัญหาหนังสือ', 'Kitap sayısı', 'کتاب کا مسئلہ', '书籍问题'),
(618, 'date_of_issue', 'Date Of Issue', 'প্রদান এর তারিখ', 'تاريخ المسألة', 'Date d\'Emission', 'जारी करने की तारिख', 'Tanggal pengeluaran', 'Data di emissione', '発行日', '발행일', 'Uitgavedatum', 'Data de emissão', 'วันที่ออก', 'Veriliş tarihi', 'تاریخ اجراء', '发行日期'),
(619, 'date_of_expiry', 'Date Of Expiry', 'মেয়াদ শেষ হওয়ার তারিখ', 'تاريخ انتهاء الصلاحية', 'Date d&#39;expiration', 'समाप्ति तिथि', 'Tanggal Kadaluarsa', 'Data di scadenza', '有効期限', '만료일', 'Vervaldatum', 'Data de validade', 'วันหมดอายุ', 'Son kullanma tarihi', 'خاتمے کی تاریخ', '到期日期'),
(620, 'select_category_first', 'Select Category First', 'প্রথম বিভাগ নির্বাচন করুন', 'اختر الفئة الأولى', 'Sélectionnez la catégorie d&#39;abord', 'श्रेणी पहले का चयन करें', 'Pilih Kategori Pertama', 'Seleziona prima la categoria', '最初にカテゴリーを選択', '카테고리 우선 선택', 'Selecteer eerst categorie', 'Selecione a categoria primeiro', 'เลือกหมวดหมู่ก่อน', 'Önce Kategori Seçin', 'زمرہ منتخب کریں', '选择类别第一'),
(621, 'type_name', 'Type Name', 'নাম টাইপ করুন', 'أكتب اسم', 'Nom du type', 'नाम लिखो', 'Ketik nama', 'Digita il nome', 'タイプ名', '유형 이름', 'Type Naam', 'Digite o nome', 'พิมพ์ชื่อ', 'Tip adı', 'نام کی قسم', '输入名称'),
(622, 'type_list', 'Type List', 'টাইপ তালিকা', 'اكتب قائمة', 'Liste de types', 'सूची टाइप करें', 'Daftar Jenis', 'Elenco dei tipi', 'タイプリスト', '유형 목록', 'Type lijst', 'Lista de tipos', 'รายการประเภท', 'Türü Listesi', 'قسم کی فہرست', '类型列表'),
(623, 'icon', 'Icon', 'আইকন', 'أيقونة', 'Icône', 'चिह्न', 'Ikon', 'Icona', ' アイコン', '상', 'Icoon', 'Ícone', 'ไอคอน', 'Icon', 'آئکن', '图标'),
(624, 'event_list', 'Event List', 'ঘটনা তালিকা', 'قائمة الأحداث', 'Liste des événements', 'घटना सूची', 'Daftar Acara', 'Elenco degli eventi', 'イベント一覧', '이벤트 목록', 'Evenementenlijst', 'Lista de evento', 'รายการกิจกรรม', 'Etkinlik Listesi', 'واقعہ کی فہرست', '活动列表'),
(625, 'create_event', 'Create Event', 'ইভেন্ট তৈরি করা', 'انشاء حدث', 'Créer un évènement', 'कार्यक्रम बनाएँ', 'Membuat acara', 'Crea Evento', 'イベントを作成', '이벤트 만들기', 'Creëer evenement', 'Criar Evento', 'สร้างกิจกรรม', 'Etkinlik oluşturmak', 'واقعہ بنائیں', '创建活动'),
(626, 'type', 'Type', 'ধরণ', 'نوع', 'Type', 'प्रकार', 'Mengetik', 'genere', 'タイプ', '유형', 'Type', 'Tipo', 'ชนิด', 'tip', 'ٹائپ کریں', '类型'),
(627, 'audience', 'Audience', 'শ্রোতাবৃন্দ', '', 'Audience', 'दर्शक', 'Hadirin', 'Pubblico', '観客', '청중', 'Publiek', 'Público', 'ผู้ชม', 'seyirci', 'ناظرین', '听众'),
(628, 'created_by', 'Created By', 'দ্বারা সৃষ্টি', 'صنع من قبل', 'Créé par', 'के द्वारा बनाई गई', 'Dibuat oleh', 'Creato da', 'によって作成された', '작성자', 'Gemaakt door', 'Criado por', 'สร้างโดย', 'Tarafından yaratıldı', 'بنائی گئی', '由...制作'),
(629, 'publish', 'Publish', 'প্রকাশ করা', 'نشر', 'Publier', 'प्रकाशित करना', 'Menerbitkan', 'Pubblicare', '公開する', '게시', 'Publiceren', 'Publicar', 'ประกาศ', 'Yayınla', 'شائع کریں', '发布'),
(630, 'everybody', 'Everybody', 'সবাই', 'الجميع', 'Tout le monde', 'हर', 'Semua orang', 'Tutti', 'みんな', 'みんな', 'iedereen', 'Todo o mundo', 'ทุกคน', 'herkes', 'سب', '每个人'),
(631, 'selected_class', 'Selected Class', 'নির্বাচিত ক্লাস', 'فئة مختارة', 'Classe sélectionnée', 'चयनित वर्ग', 'Kelas yang Dipilih', 'Classe selezionata', '選択したクラス', '선택된 클래스', 'Geselecteerde klasse', 'Classe Selecionada', 'คลาสที่เลือก', 'Seçilmiş Sınıf', 'منتخب کلاس', '精选班级'),
(632, 'selected_section', 'Selected Section', 'নির্বাচিত বিভাগ', 'القسم المختار', 'Sección seleccionada', 'चयनित अनुभाग', 'Bagian yang Dipilih', 'Sezione selezionata', '選択したセクション', '선택된 섹션', 'Geselecteerde sectie', 'Seção Selecionada', 'ส่วนที่เลือก', 'Seçilmiş Bölüm', 'منتخب کردہ سیکشن', '选定部分'),
(633, 'information_has_been_updated_successfully', 'Information Has Been Updated Successfully', 'তথ্য সফলভাবে আপডেট করা হয়েছে', 'تم تحديث المعلومات بنجاح', 'L\'information a été mise à jour avec succès', 'जानकारी सफलतापूर्वक अद्यतन की गई है', 'Informasi Telah Diperbarui Berhasil', 'Le informazioni sono state aggiornate con successo', '情報は正常に更新されました', '정보가 성공적으로 업데이트되었습니다.', 'Informatie is succesvol bijgewerkt', 'Informações foram atualizadas com sucesso', 'อัปเดตข้อมูลเรียบร้อยแล้ว', 'Bilgi başarıyla güncellendi', 'معلومات کامیابی سے اپ ڈیٹ کی گئی ہے', '信息已成功更新'),
(634, 'create_invoice', 'Create Invoice', 'চালান তৈরি করুন', 'إنشاء فاتورة', 'Créer une facture', 'इनवॉयस बनाएँ', 'Buat Faktur', 'Crea fattura', '請求書を作成する', '송장 생성', 'Factuur maken', 'Criar recibo', 'สร้างใบแจ้งหนี้', 'Fatura oluşturmak', 'انوائس بنائیں', '创建发票'),
(635, 'invoice_entry', 'Invoice Entry', 'চালান এন্ট্রি', 'إدخال الفاتورة', 'Entrée de facture', 'चालान प्रविष्टि', 'Entri Faktur', 'Entrata della fattura', '請求書入力', '송장 입력', 'Invoice Entry', 'Entrada de fatura', 'Entrada de fatura', 'Fatura Girişi', 'Fatura Girişi', '发票输入'),
(636, 'quick_payment', 'Quick Payment', 'দ্রুত পেমেন্ট', 'الدفع السريع', 'Paiement rapide', 'त्वरित भुगतान', 'Pembayaran cepat', 'Pagamento rapido', '迅速な支払い', '빠른 지불', 'Snelle betaling', 'Pagamento Rápido', 'ชำระเงินด่วน', 'Hızlı ödeme', 'فوری ادائیگی', '快速付款'),
(637, 'write_your_remarks', 'Write Your Remarks', 'আপনার মন্তব্য লিখুন', 'اكتب ملاحظاتك', 'Écrivez vos remarques', 'अपनी टिप्पणी लिखें', 'Tulis Komentar Anda', 'Scrivi le tue osservazioni', '備考を書く', '비고문 작성', 'Schrijf uw opmerkingen', 'Escreva suas observações', 'เขียนข้อสังเกตของคุณ', 'Düşüncelerinizi Yazın', 'اپنے ریمارکس لکھیں', '写下你的评论'),
(638, 'reset', 'Reset', 'পুন:স্থাপন করা', 'إعادة تعيين', 'Réinitialiser', 'रीसेट', 'Visszaállítás', 'Reset', 'リセット', '다시 놓기', 'Reset', 'Restabelecer', 'รีเซ็ต', 'Reset', 'ری سیٹ کریں', '重启'),
(639, 'fees_payment_history', 'Fees Payment History', 'ফি প্রদানের ইতিহাস', 'تاريخ الدفع الرسوم', 'Historial de pago de tasas', 'शुल्क भुगतान इतिहास', 'Riwayat Pembayaran Biaya', 'Storia pagamenti pagamento', 'Storia pagamenti pagamento', '수수료 지불 내역', 'Vergoeding betalingsgeschiedenis', 'Histórico de pagamento de taxas', 'ประวัติการชำระค่าธรรมเนียม', 'Ücret Ödeme Geçmişi', 'فیس ادائیگی کی تاریخ', 'فیس ادائیگی کی تاریخ'),
(640, 'fees_summary_report', 'Fees Summary Report', 'ফি সংক্ষিপ্ত বিবরণ', 'تقرير ملخص الرسوم', 'Rapport sommaire des frais', 'फीस सारांश रिपोर्ट', 'Laporan Ringkasan Biaya', 'Rapporto riepilogativo', '料金概要レポート', '수수료 요약 보고서', 'Kostenoverzicht', 'Relatório resumido de taxas', 'รายงานสรุปค่าธรรมเนียม', 'Ücret Özeti Raporu', 'Ücret Özeti Raporu', '费用摘要报告'),
(641, 'add_account_group', 'Add Account Group', 'অ্যাকাউন্ট গ্রুপ যোগ করুন', 'إضافة مجموعة حساب', 'Ajouter un groupe de compte', 'खाता समूह जोड़ें', 'Tambahkan Grup Akun', 'Aggiungi gruppo di conti', 'アカウントグループを追加', '계정 그룹 추가', 'Accountgroep toevoegen', 'Adicionar grupo de contas', 'เพิ่มกลุ่มบัญชี', 'Hesap Grubu Ekle', 'اکاؤنٹ گروپ شامل کریں', '添加帐户组'),
(642, 'account_group', 'Account Group', 'অ্যাকাউন্ট গ্রুপ', 'جماعة حساب', 'Compte de groupe', 'खाता समूह', 'Fiókcsoport', 'Fiókcsoport', 'アカウントグループ', '계정 그룹', 'Accountgroep', 'Accountgroep', 'กลุ่มบัญชี', 'กลุ่มบัญชี', 'اکاؤنٹ گروپ', '帐户组'),
(643, 'account_group_list', 'Account Group List', 'অ্যাকাউন্ট গ্রুপ তালিকা', 'قائمة مجموعة الحساب', 'Liste des groupes de comptes', 'खाता समूह सूची', 'Daftar Grup Akun', 'Elenco gruppi di account', 'アカウントグループ一覧', '계정 그룹 목록', 'Ratio Group List', 'Lista de grupos de contas', 'รายชื่อกลุ่มบัญชี', 'Hesap Grubu Listesi', 'اکاؤنٹ گروپ کی فہرست', '帐户组列表'),
(644, 'mailbox', 'Mailbox', 'ডাকবাক্স', 'صندوق بريد', 'Boites aux lettres', 'मेलबॉक्स', 'Kotak surat', 'Cassetta postale', 'メールボックス', '사서함', 'Mailbox', 'Caixa de correio', 'ตู้จดหมาย', 'Posta kutusu', 'میل باکس', '邮箱'),
(645, 'refresh_mail', 'Refresh Mail', 'মেইল রিফ্রেশ করুন', 'تحديث البريد', 'Refresh Mail', 'Refresh Mail', 'Segarkan Surat', 'Refresh Mail', 'メールを更新', '메일 새로 고침', 'Refresh Mail', 'Refresh Mail', 'รีเฟรชเมล', 'รีเฟรชเมล', 'รีเฟรชเมล', 'รีเฟรชเมล'),
(646, 'sender', 'Sender', 'প্রেরণকর্তা', 'مرسل', 'expéditeur', 'प्रेषक', 'pengirim', 'mittente', '送信者', '보내는 사람', 'verzender', 'remetente', 'ผู้ส่ง', 'gönderen', 'مرسل', '寄件人'),
(647, 'general_settings', 'General Settings', 'সাধারণ সেটিংস', 'الاعدادات العامة', ' réglages généraux', 'सामान्य सेटिंग्स', 'Pengaturan Umum', 'impostazioni generali', '一般設定', '일반 설정', 'Algemene instellingen', 'Configurações Gerais', 'การตั้งค่าทั่วไป', 'Genel Ayarlar', 'عام ترتیبات', '常规设置'),
(648, 'institute_name', 'Institute Name', 'প্রতিষ্ঠানের নাম', 'اسم المعهد', 'Nom de l\'Institut', 'संस्थान का नाम', 'nama institusi', 'Nome Istituto', '研究所名', '연구소 이름', 'naam van het instituut', 'Nome do Instituto', 'Название института', 'Kurum İsmi', 'Kurum İsmi', '学院名称'),
(649, 'institution_code', 'Institution Code', 'প্রতিষ্ঠানের কোড', 'رمز المؤسسة', 'Código Institucional', 'Código Institucional', 'Kode Institusi', 'Codice istituto', '機関コード', '기관 코드', 'Instellingscode', 'Código da Instituição', 'รหัสสถาบัน', 'Kurum Kodu', 'انسٹی ٹیوٹ کوڈ', '机构代码'),
(650, 'sms_service_provider', 'Sms Service Provider', 'এসএমএস সেবা প্রদানকারী', 'مزود خدمة الرسائل القصيرة', 'Fournisseur de service SMS', 'Fournisseur de service SMS', 'Penyedia Layanan SMS', 'Provider di servizi SMS', 'SMSサービスプロバイダー', 'SMS 서비스 공급자', 'SMS-serviceprovider', 'Provedor de serviços de SMS', 'ผู้ให้บริการ SMS', 'SMS Servis Sağlayıcısı', 'SMS سروس فراہم کنندہ', '短信服务提供商'),
(651, 'footer_text', 'Footer Text', 'পাদচরণ', 'نص التذييل', 'Pied de page texte', 'फूटर टेक्स्ट', 'Catatan kaki', 'Testo di piè di pagina', 'フッターテキスト', '꼬리말 텍스트', 'Voettekst', 'Texto de rodapé', 'ข้อความส่วนท้าย', 'Altbilgi metni', 'فوٹر متن', '页脚文本'),
(652, 'payment_control', 'Payment Control', 'পেমেন্ট কন্ট্রোল', 'نص التذييل', 'Pied de page texte', 'फूटर टेक्स्ट', 'Catatan kaki', 'Testo di piè di pagina', 'フッターテキスト', '꼬리말 텍스트', 'Voettekst', 'Texto de rodapé', 'ข้อความส่วนท้าย', 'Altbilgi metni', 'فوٹر متن', '页脚文本'),
(653, 'sms_config', 'Sms Config', 'এসএমএস কনফিগ', 'تكوين الرسائل القصيرة', 'Sms Config', 'एसएमएस कॉन्फ़िगर करें', 'Konfigurasi Sms', 'Config. Sms', 'SMS構成', 'Sms Config', 'Sms Config', 'Sms Config', 'Sms Config', 'Sms yapılandırma', 'ایس ایم ایس ترتیب', '短信配置'),
(654, 'sms_triggers', 'Sms Triggers', 'এসএমএস ট্রিগার', 'الرسائل القصيرة المشغلات', 'Déclencheurs de sms', 'एसएमएस ट्रिगर', 'Pemicu Sms', 'Sms Triggers', 'SMSトリガー', 'SMS 트리거', 'Sms Triggers', 'Sms Triggers', 'Sms Triggers', 'Sms Tetikleyicileri', 'ایس ایم ایس ٹرگر', '短信触发器'),
(655, 'authentication_token', 'Authentication Token', 'প্রমাণীকরণ টোকেন', 'رمز المصادقة', 'Jeton d\'authentification', 'प्रमाणीकरण टोकन', 'Token Otentikasi', 'Token di autenticazione', '認証トークン', '인증 토큰', '인증 토큰', 'Token de Autenticação', 'โทเค็นการรับรองความถูกต้อง', 'Kimlik Doğrulama Simgesi', 'Kimlik Doğrulama Simgesi', '身份验证令牌'),
(656, 'sender_number', 'Sender Number', 'প্রেরক সংখ্যা', 'رقم المرسل', 'Numéro d\'expéditeur', 'भेजने वाला नंबर', 'Feladó száma', 'Numero mittente', '送信者番号', '발신자 번호', 'Afzender nummer', 'Número do remetente', 'หมายเลขผู้ส่ง', 'Gönderenin Numarası', 'Gönderenin Numarası', '发件人编号'),
(657, 'username', 'Username', 'ব্যবহারকারীর নাম', 'اسم المستخدم', 'Nom d\'utilisateur', 'उपयोगकर्ता नाम', 'Nama pengguna', 'Nome utente', 'ユーザー名', '사용자 이름', 'Gebruikersnaam', 'Nome de usuário', 'имя пользователя', 'Kullanıcı adı', 'صارف کا نام', 'صارف کا نام'),
(658, 'api_key', 'Api Key', 'مفتاح API', 'API-Schlüssel', 'Clé API', 'एपीआई कुंजी', 'Api kulcs', 'Api kulcs', 'Api kulcs', 'API 키', 'Chave API', 'Chave API', 'คีย์ Api', 'Api Anahtarı', 'اےپی کی کلی', 'Api Key'),
(659, 'authkey', 'Authkey', 'প্রমাণীকরণ কী', 'مفتاح المصادقة', 'Clé d\'authentification', 'प्रमाणन कुंजी', 'Authkey', 'Chiave d\'autenticazione', '認証キー', 'Authkey', 'Inlogcode', 'Chave de autenticação', 'Authkey', 'authkey', 'authkey', '授权键'),
(660, 'sender_id', 'Sender Id', 'প্রেরকের আইডি', 'إرسال معرف', 'Identifiant de l\'expéditeur', 'ईद भेजना', 'Mengirim Id', 'Invio Id', '送信ID', '발신자 ID', 'ID verzenden', 'ID de envio', 'ส่งรหัส', 'ส่งรหัส', 'شناخت بھیج رہا ہے', '发送ID'),
(661, 'sender_name', 'Sender Name', 'প্রেরক নাম', 'اسم المرسل', 'Nom de l\'expéditeur', 'भेजने वाले का नाम', 'Küldő neve', 'Küldő neve', '送信者名', '발신자 이름', 'Naam afzender', 'Nome do remetente', 'ชื่อผู้ส่ง', 'Gönderenin adı', 'Gönderenin adı', 'Gönderenin adı'),
(662, 'hash_key', 'Hash Key', 'হ্যাশ কী', 'مفتاح التجزئة', 'Touche dièse', 'हैश कुंजी', 'Kunci Hash', 'Tasto cancelletto', 'Tasto cancelletto', 'Tasto cancelletto', 'Hash sleutel', 'Chave de hash', 'รหัสแฮช', 'รหัสแฮช', 'รหัสแฮช', 'รหัสแฮช'),
(663, 'notify_enable', 'Notify Enable', 'অবহিত সক্রিয় করুন', 'أبلغ عن تمكين', 'Notifier Activer', 'सक्षम करें सूचित करें', 'Beritahu Mengaktifkan', 'Notifica Abilita', '有効にする', '알림 사용', 'Melding inschakelen', 'Notificar Ativar', 'แจ้งเตือนการเปิดใช้งาน', 'Etkinleştir bildir', 'مطلع کریں فعال کریں', '通知启用'),
(664, 'exam_attendance', 'Exam Attendance', 'পরীক্ষা উপস্থিতি', 'حضور الامتحان', 'Présence à l\'examen', 'परीक्षा में उपस्थिति', 'Kehadiran ujian', 'Partecipazione agli esami', '試験受講', '시험 출석', 'Examen Aanwezigheid', 'Participação no exame', 'Sınava Devam', 'Sınava Devam', 'امتحان حاضری', 'امتحان حاضری'),
(665, 'exam_results', 'Exam Results', 'পরীক্ষার ফলাফল', 'نتائج الامتحانات', 'Résultats d\'examen', 'परीक्षा के परिणाम', 'Hasil ujian', 'Risultati degli esami', '試験結果', '시험 결과', 'Examenresultaten', 'Resultados dos exames', 'ผลสอบ', 'Sınav sonuçları', 'امتحانی نتائج', '考试成绩'),
(666, 'email_config', 'Email Config', 'ইমেইল কনফিগ', 'تكوين البريد الإلكتروني', 'Config email', 'ईमेल कॉन्फ़िगरेशन', 'Konfigurasi email', 'Email config', 'メール設定', '이메일 구성', 'Configuração de email', 'Конфигурация электронной почты', 'กำหนดค่าอีเมล', 'E-posta yapılandırması', 'ای میل ترتیب', '电子邮件配置'),
(667, 'email_triggers', 'Email Triggers', 'ইমেল ট্রিগার', 'البريد الإلكتروني المشغلات', 'Déclencheurs de courrier électronique', 'ईमेल ट्रिगर', 'Pemicu Email', 'Email Trigger', '電子メールトリガ', '이메일 트리거', 'E-mail Triggers', 'Gatilhos de email', 'ทริกเกอร์อีเมล', 'E-posta Tetikleyicileri', 'ای میل ٹرگر', '电子邮件触发器'),
(668, 'account_registered', 'Account Registered', 'অ্যাকাউন্ট নিবন্ধিত', 'حساب مسجل', 'Compte enregistré', 'खाता पंजीकृत', 'Akun Terdaftar', 'Account registrato', 'アカウント登録', '계정 등록', 'Account geregistreerd', 'Conta registrada', 'ลงทะเบียนบัญชี', 'Hesap Kayıtlı', 'اکاؤنٹ رجسٹرڈ', '帐户已注册'),
(669, 'forgot_password', 'Forgot Password', 'পাসওয়ার্ড ভুলে গেছেন', 'هل نسيت كلمة المرور', 'Mot de passe oublié', 'पासवर्ड भूल गए', 'Lupa kata sandi', 'Ha dimenticato la password', 'パスワードをお忘れですか', '비밀번호를 잊으 셨나요', 'Wachtwoord vergeten', 'Esqueceu a senha', 'ลืมรหัสผ่าน', 'Parolanızı mı unuttunuz', 'پاسورڈ بھول گے', '忘记密码'),
(670, 'new_message_received', 'New Message Received', 'নতুন বার্তা প্রাপ্ত', 'رسالة جديدة مستلمة', 'Nouveau message reçu', 'नया संदेश प्राप्त हुआ', 'Pesan Baru Diterima', 'Nuovo messaggio ricevuto', '受信した新しいメッセージ', '받은 새 메시지', 'Nieuw bericht ontvangen', 'Nova mensagem recebida', 'ได้รับข้อความใหม่', 'Yeni Mesaj Alındı', 'نیا پیغام موصول ہوا', '收到新消息'),
(671, 'payslip_generated', 'Payslip Generated', 'বেতন স্লিপ তৈরি', 'دفع الانزلاق ولدت', 'Bulletin de paie généré', 'जेनरेट किया गया', 'Payslip Dihasilkan', 'Busta paga generata', 'ペイスリップ生成', '생성 된 Payslip', 'Loonstaten gegenereerd', 'Folha de pagamento gerada', 'สร้างสลิปเงินเดือน', 'Maaş bordrosu', 'پیسلیپ پیدا', '工資單生成'),
(672, 'leave_approve', 'Leave Approve', 'অনুমোদন ছেড়ে দিন', 'اترك الموافقة', 'Laisser approuver', 'मंजूर छोड़ो', 'Tinggalkan Menyetujui', 'Lasciare approvare', '承認する', '승인을 남겨주세요.', 'Laat goedkeuren', 'Deixar de aprovar', 'ออกจากอนุมัติ', 'Onaylamadan Ayrıl', 'اجازت دیں چھوڑ دو', '离开批准'),
(673, 'leave_reject', 'Leave Reject', 'প্রত্যাখ্যান ছেড়ে দিন', 'اترك الرفض', 'Laisser rejeter', 'रिजेक्ट छोड़ दें', 'Tinggalkan Tolak', 'Lasciare rifiutare', '拒否を残す', '거절하기', 'Laat afwijzen', 'Deixe Rejeitar', 'ปล่อยให้ปฏิเสธ', 'Reddetmeyi Bırak', 'ردعمل چھوڑ دو', '请拒绝'),
(674, 'advance_salary_approve', 'Advance Salary Approve', 'অগ্রিম বেতন অনুমোদন', 'راتب مقدما', 'Avance Salaire Approuver', 'अग्रिम वेतन स्वीकृत', 'Setujui Gaji Lanjutan', 'Advance Salary Approve', '前払い承認', '선임 급여 승인', 'Voorschot Salaris Goedkeuren', 'Salário Adiantado Aprovar', 'อนุมัติเงินเดือนล่วงหน้า', 'Peşin Maaş Onayı', 'ایڈوانس تنخواہ منظور', '提前薪资审批'),
(675, 'advance_salary_reject', 'Advance Salary Reject', 'অগ্রিম বেতন প্রত্যাখ্যান', 'الرفع المسبق الرفض', 'Avance salaire rejeter', 'अग्रिम वेतन अस्वीकार', 'Tolak Gaji Muka', 'Advance Salary Reject', '前払い拒否', '선고 거부', 'Voorschot Salaris Weigeren', 'Avanço Salarial Rejeitar', 'การปฏิเสธเงินเดือนล่วงหน้า', 'Peşin Maaş Reddi', 'ایڈوانس تنخواہ رد', '提前退休金'),
(676, 'add_session', 'Add Session', 'সেশন যোগ করুন', 'إضافة جلسة', 'Ajouter une session', 'सत्र जोड़ें', 'Tambahkan Sesi', 'Aggiungi sessione', 'セッションを追加', '세션 추가', 'Voeg sessie toe', 'Adicionar Sessão', 'เพิ่มเซสชัน', 'Oturum ekle', 'سیشن شامل کریں', '添加会话'),
(677, 'session', 'Session', 'সেশন', 'جلسة', 'Session', 'अधिवेशन', 'Sidang', 'Sessione', 'セッション', '세션', 'Sessie', 'Sessão', 'เซสชั่น', 'Oturum, toplantı, celse', 'اجلاس', '会议'),
(678, 'created_at', 'Created At', 'এ নির্মিত', 'Hergestellt inأنشئت في', 'Créé à', 'पर बनाया गया', 'Dibuat di', 'Creato a', '作成日', '작성 시간', 'Gemaakt bij', 'Criado em', 'สร้างเมื่อ', 'At oluşturuldu', 'میں پیدا', '创建于'),
(679, 'sessions', 'Sessions', 'সেশন', 'جلسات', 'Sessions', 'सत्र', 'Sesi', 'sessioni', 'セッション', '세션 수', 'Sessions', 'Sessões', 'การประชุม', 'Oturumlar', 'سیشن', '会议'),
(680, 'flag', 'Flag', 'পতাকা', 'علم', 'Drapeau', 'झंडा', 'Bendera', 'Bandiera', '旗', '깃발', 'Vlag', 'Bandeira', 'ธง', 'bayrak', 'پرچم', '旗'),
(681, 'stats', 'Stats', 'পরিসংখ্যান', 'احصائيات', 'Statistiques', 'आँकड़े', 'Statistik', 'Statistiche', '統計', '통계', 'Stats', 'Estatísticas', 'สถิติ', 'İstatistikleri', 'اعداد و شمار统计', '统计'),
(682, 'updated_at', 'Updated At', 'এ আপডেট', 'تم التحديث في', 'Mis à jour à', 'अपडेट किया गया', 'Diperbarui pada', 'Aggiornato a', 'で更新', '에서 업데이트 됨', 'Bijgewerkt op', 'Atualizado em', 'อัปเดตเมื่อ', 'Güncelleme Tarihi', 'اپ ڈیٹ', '更新时间'),
(683, 'flag_icon', 'Flag Icon', 'পতাকা আইকন', 'أيقونة العلم', 'Icône de drapeau', 'ध्वज चिह्न', 'Ikon Tandai', 'Icona della bandiera', '旗のアイコン', '국기 아이콘', 'Vlagpictogram', 'Ícone de bandeira', 'ไอคอนธง', 'Bayrak Simgesi', 'پرچم آئکن', '国旗图标'),
(684, 'password_restoration', 'Password Restoration', 'পাসওয়ার্ড পুনরুদ্ধার', 'استعادة كلمة المرور', 'Restauration du mot de passe', 'पासवर्ड बहाली', 'Pemulihan Kata Sandi', 'Ripristino della password', 'パスワード復元', '비밀번호 복원', 'Wachtwoordherstel', 'Restauração de Senha', 'กู้คืนรหัสผ่าน', 'Şifre Yenileme', 'پاس ورڈ کی بحالی', '密码恢复'),
(685, 'forgot', 'Forgot', 'ভুলে গেছেন', 'نسيت', 'Oublié', 'भूल गया', 'Lupa', 'dimenticato', '忘れた', '분실', 'vergeten', 'Esqueci', 'ลืม', 'Unuttun', 'بھول', '忘记'),
(686, 'back_to_login', 'Back To Login', 'প্রবেশ করতে পেছান', 'العودة إلى تسجيل الدخول', 'Retour connexion', 'लॉगिन पर वापस जाएं', 'Kembali untuk masuk', 'Torna al login', 'ログインに戻る', '로그인으로 돌아 가기', 'Terug naar Inloggen', 'Volte ao login', 'กลับไปเข้าสู่ระบบ', 'Girişe Geri Dön', 'لاگ ان کرنے کے لئے واپس', '回到登入'),
(687, 'database_list', 'Database List', 'ডাটাবেস তালিকা', 'قائمة قاعدة البيانات', 'Liste de base de données', 'डेटाबेस सूची', 'Daftar Basis Data', 'Elenco Database', 'データベース一覧', '데이터베이스 목록', 'Database lijst', 'Lista de bancos de dados', 'รายการฐานข้อมูล', 'Veritabanı Listesi', 'ڈیٹا بیس کی فہرست', '数据库列表'),
(688, 'create_backup', 'Create Backup', 'ব্যাকআপ তৈরি', 'انشئ نسخة احتياطية', 'Créer une sauvegarde', 'बैकअप बनाना', 'Membuat backup', 'Creare il backup', 'バックアップを作成する', '백업 생성', 'Een backup maken', 'Criar backup', 'สร้างการสำรองข้อมูล', 'Yedekleme Oluştur', 'بیک اپ بنائیں', '创建备份'),
(689, 'backup', 'Backup', 'ব্যাকআপ', 'دعم', 'Sauvegarde', 'बैकअप', 'Cadangkan', 'Backup', 'バックアップ', '지원', 'backup', 'Cópia de segurança', 'การสำรองข้อมูล', 'yedek', 'بیک اپ', '备用'),
(690, 'backup_size', 'Backup Size', 'ব্যাকআপ আকার', 'حجم النسخ الاحتياطي', 'Taille de la sauvegarde', 'बैकअप आकार', 'Ukuran Cadangan', 'Dimensione di backup', 'バックアップサイズ', '백업 크기', 'Back-upgrootte', 'Tamanho do backup', 'ขนาดสำรอง', 'Yedek boyutu', 'بیک اپ سائز', '备份大小'),
(691, 'file_upload', 'File Upload', 'ফাইল আপলোড করুন', 'تحميل الملف', 'Téléchargement de fichiers', 'फाइल अपलोड', 'File Upload', 'File Upload', 'ファイルアップロード', '파일 업로드', 'Bestand upload', 'Upload de arquivo', 'อัปโหลดไฟล์', 'Dosya yükleme', 'فائل اپ لوڈ کریں', '上传文件'),
(692, 'parents_details', 'Parents Details', 'পিতামাতার বিস্তারিত', 'تفاصيل الوالدين', 'Détails parents', 'माता-पिता का विवरण', 'Rincian Orang Tua', 'Dettagli dei genitori', '両親の詳細', '학부모 세부 정보', 'Ouders details', 'Detalhes dos pais', 'รายละเอียดผู้ปกครอง', 'Ebeveyn Detayları', 'والدین کی تفصیلات', '父母详情'),
(693, 'social_links', 'Social Links', 'সামাজিক লিঙ্ক', 'روابط اجتماعية', 'Liens sociaux', 'सामाजिक लिंक', 'Tautan Sosial', 'Collegamenti sociali', 'ソーシャルリンク', '소셜 링크', 'Social Links', 'Social Links', 'ลิงค์โซเชียล', 'Sosyal link', 'سماجی روابط', '社交链接'),
(694, 'create_hostel', 'Create Hostel', 'হোস্টেল তৈরি করুন', 'إنشاء نزل', 'Créer une auberge', 'हॉस्टल बनाएं', 'Buat Hostel', 'Creare un ostello', 'ホステルを作成する', '호스텔 만들기', 'Maak een hostel', 'Criar Hostel', 'สร้างโฮสเทล', 'Hostel Yarat', 'ہالسٹ بنائیں', '创建旅馆'),
(695, 'allocation_list', 'Allocation List', 'বরাদ্দ তালিকা', 'قائمة التخصيص', 'Allocation List', 'आवंटन सूची', 'Daftar Alokasi', 'Elenco di assegnazioni', '配分リスト', '할당 목록', 'Toewijzingslijst', 'Lista de alocação', 'รายการการจัดสรร', 'Tahsis Listesi', 'الاؤنس کی فہرست', '分配清单'),
(696, 'payslip_history', 'Payslip History', 'বেতন স্লিপ ইতিহাস', 'دفع سجل الانزلاق', 'Histoire du bulletin de salaire', 'Payslip History', 'Sejarah Payslip', 'Storia di busta paga', '給与明細の歴史', '페이 슬립 역사', 'Salaris geschiedenis', 'Histórico de holerite', 'ประวัติสลิปเงินเดือน', 'Maaş Geçmişi', 'پیسلوپ تاریخ', '支付歷史'),
(697, 'my_attendance_overview', 'My Attendance Overview', 'আমার উপস্থিতি সংক্ষিপ্ত বিবরণ', 'بلدي نظرة عامة على الحضور', 'Mon assiduité', 'मेरी उपस्थिति अवलोकन', 'Ikhtisar Kehadiran Saya', 'Panoramica sulla mia presenze', '私の出席概要', '내 출석 개요', 'Mijn aanwezigheidsoverzicht', 'Minha visão geral de participação', 'ภาพรวมการเข้าร่วมของฉัน', 'Katılıma Genel Bakış', 'میرا حاضری جائزہ', '我的出勤概况'),
(698, 'total_present', 'Total Present', 'মোট উপস্থিত', 'المجموع الحالي', 'Total présent', 'कुल वर्तमान', 'Total Hadir', 'Presente totale', '合計プレゼント', '총 현재', 'Totaal aanwezig', 'Total Present', 'รวมปัจจุบัน', 'Toplam hediye', 'کل موجودہ', '总现在'),
(699, 'total_absent', 'Total Absent', 'মোট অনুপস্থিত', 'مجموع الغائبين', 'Total Absent', 'कुल अनुपस्थित', 'Total Absen', 'Total Absen', '全欠席', '총 부재수', 'Totaal afwezig', 'Total ausente', 'ขาดทั้งหมด', 'Toplam Yok', 'کل مطلق', '完全缺席'),
(700, 'total_late', 'Total Late', 'মোট দেরী', 'مجموع في وقت متأخر', 'Total en retard', 'कुल देर', 'Total Terlambat', 'Totale ritardo', '合計遅れ', '총 지연', 'Totaal te laat', 'Total Late', 'รวมล่าช้า', 'Toplam Geç', 'کل دیر', '总晚了'),
(701, 'class_teacher_list', 'Class Teacher List', 'ক্লাস শিক্ষক তালিকা', 'قائمة معلم الصف', 'Liste des professeurs de classe', 'कक्षा शिक्षक सूची', 'Daftar Guru Kelas', 'Elenco degli insegnanti di classe', 'クラス教師リスト', '수업 교사 목록', 'Klasse Docentenlijst', 'Lista de professores de turma', 'รายชื่อครูประจำชั้น', 'Sınıf Öğretmeni Listesi', 'کلاس ٹیچر کی فہرست', '班级老师名单'),
(702, 'section_control', 'Section Control', 'বিভাগ নিয়ন্ত্রণ', 'السيطرة على القسم', 'Section Control', 'अनुभाग नियंत्रण', 'Kontrol Bagian', 'Controllo di sezione', 'セクション管理', '섹션 컨트롤', 'Section Control', 'Controle de Seção', 'การควบคุมส่วน', 'Bölüm Kontrolü', 'سیکشن کنٹرول', '部分控制'),
(703, 'capacity ', 'Capacity ', 'ধারণক্ষমতা', 'سعة', 'Capacité', 'क्षमता', 'Kapasitas', 'Capacità', '容量', '생산 능력', 'Capaciteit', 'Capacidade', 'ความจุ', 'Kapasite', 'صلاحیت', '容量'),
(704, 'request', 'Request', 'অনুরোধ', 'طلب', 'demande', 'निवेदन', 'permintaan', 'richiesta', '要求', '의뢰', 'verzoek', 'pedido', 'ขอร้อง', 'istek', 'درخواست', '请求'),
(705, 'salary_year', 'Salary Year', 'বেতন বছর', 'سنة الراتب', 'Année de salaire', 'वेतन वर्ष', 'Tahun Gaji', 'Stipendio', '給与年', '연봉 연도', 'Salarisjaar', 'Ano Salarial', 'เงินเดือนปี', 'Maaş Yılı', 'تنخواہ سال', '薪资年'),
(706, 'create_attachments', 'Create Attachments', 'সংযুক্তি তৈরি করুন', 'إنشاء المرفقات', 'Créer des pièces jointes', 'अनुलग्नक बनाएँ', 'Buat Lampiran', 'Crea allegati', '添付ファイルを作成する', '첨부 파일 만들기', 'Bijlagen creëren', 'Criar anexos', 'สร้างไฟล์แนบ', 'Ekler Oluştur', 'منسلکات تخلیق کریں', '创建附件'),
(707, 'publish_date', 'Publish Date', 'প্রকাশের তারিখ', 'تاريخ النشر', 'Publish Date', 'प्रकाशित तिथि', 'Tanggal Terbit', 'Data di pubblicazione', '公開日', '게시 날짜', 'Publiceer datum', 'Data de publicação', 'วันที่เผยแพร่', 'Yayın tarihi', 'تاریخ شائع کریں', '发布日期'),
(708, 'attachment_file', 'Attachment File', 'সংযুক্তি ফাইল', 'ملف مرفق', 'Fichier joint', 'अनुलग्नक फ़ाइल', 'File Lampiran', 'Attachment File', '添付ファイル', '첨부 파일', 'Bijlage', 'Ficheiro em anexo', 'ไฟล์แนบ', 'Ek dosya', 'منسلک فائل', '附件文件'),
(709, 'age', 'Age', 'বয়স', 'عمر', 'Âge', 'आयु', 'Usia', 'Età', 'Age', '나이', 'Leeftijd', 'Era', 'อายุ', 'Yaş', 'عمر', '年龄'),
(710, 'student_profile', 'Student Profile', 'ছাত্র প্রোফাইল', 'الملف الشخصي للطالب', 'Profil étudiant', 'छात्र प्रोफाइल', 'Profil Siswa', 'Profilo dello studente', '学生プロフィール', '학생 프로필', 'Studentenprofiel', 'Perfil do Aluno', 'ประวัตินักศึกษา', 'Öğrenci profili', 'طالب علم کی پروفائل', '学生档案'),
(711, 'authentication', 'Authentication', 'প্রমাণীকরণ', 'المصادقة', 'authentification', 'प्रमाणीकरण', 'otentikasi', 'autenticazione', '認証', '입증', 'authenticatie', 'autenticação', 'การรับรอง', 'kimlik doğrulama', 'تصدیق', '认证'),
(712, 'parent_information', 'Parent Information', 'পিতামাতার তথ্য', 'معلومات الوالدين', 'Parent Information', 'जनक जानकारी', 'Informasi Induk', 'Informazioni sui genitori', '親情報', '학부모 정보', '학부모 정보', '학부모 정보', 'ข้อมูลผู้ปกครอง', 'Ebeveyn Bilgisi', 'والدین کی معلومات', '家长信息'),
(713, 'full_marks', 'Full Marks', 'পূর্ণ নম্বর', 'علامات كاملة', 'La totalité des points', 'पूरे अंक', 'Penuh dengan tanda', 'Pieni voti', 'フルマーク', '만점', 'Volle cijfers', 'Marcas Completas', 'คะแนนเต็ม', 'Tam işaretleri', 'پورے نمبر', '满分'),
(714, 'passing_marks', 'Passing Marks', 'পাশ নম্বর', 'علامات النجاح', 'Marques de passage', 'पासिंग मार्क्स', 'Passing Marks', 'Passando Marks', '合格マーク', '통과 표시', 'Markeringen doorgeven', 'Marcas de passagem', 'ผ่านเครื่องหมาย', 'Geçen işaretleri', 'پاسنگ مارکس', '传递标记'),
(715, 'highest_marks', 'Highest Marks', 'সর্বোচ্চ মার্ক', 'أعلى العلامات', 'Plus hautes marques', 'सबसे ऊँचे निशान', 'Nilai Tertinggi', 'I voti più alti', '最高点', '최고 점수', 'Hoogste cijfers', 'Marcas mais altas', 'เครื่องหมายสูงสุด', 'En Yüksek İşaretler', 'سب سے زیادہ نشانیاں', '最高分'),
(716, 'unknown', 'Unknown', 'অজানা', 'غير معروف', 'Inconnu', 'अनजान', 'Tidak dikenal', 'Sconosciuto', '道の', '알 수 없는', 'Onbekend', 'Desconhecido', 'ไม่ทราบ', 'Bilinmeyen', 'نامعلوم', '未知'),
(717, 'unpublish', 'Unpublish', 'অপ্রকাশিত', 'إلغاء النشر', 'Annuler la publication', 'अप्रकाशित', 'Batalkan publikasi', 'Non pubblicato', '未公開', '게시 취소', 'Publicatie ongedaan maken', 'Cancelar publicação', 'ยกเลิกการเผยแพร่', 'Yayından Kaldır', 'غیر اشاعت شدہ', '取消发布'),
(718, 'login_authentication_deactivate', 'Login Authentication Deactivate', 'লগইন অনুমোদন নিষ্ক্রিয় করুন', 'دخول المصادقة إلغاء تنشيط', 'Désactiver l\'authentification de connexion', 'लॉगिन प्रमाणीकरण निष्क्रिय करें', 'Otentikasi Login Nonaktifkan', 'Autenticazione di accesso Disattiva', 'ログイン認証を無効にする', '로그인 인증 비활성화', 'Aanmelding Authenticatie Deactiveren', 'Autenticação de login Desativar', 'การรับรองความถูกต้องเข้าสู่ระบบปิดการใช้งาน', 'Giriş Doğrulama Devre Dışı Bırak', 'لاگ ان کی تصدیق غیر فعال', '登录验证取消激活'),
(719, 'employee_profile', 'Employee Profile', 'কর্মচারী প্রোফাইল', 'ملف تعريف الموظف', 'profil de l\'employé', 'कर्मचारी प्रोफ़ाइल', 'Profil Karyawan', 'Profilo del dipendente', '従業員プロフィール', '직원 프로필', 'Werknemersprofiel', 'Perfil do funcionário', 'รายละเอียดพนักงาน', 'İşçi profili', 'ملازم کی پروفائل', '员工档案'),
(720, 'employee_details', 'Employee Details', 'কর্মচারী বিবরণ', 'تفاصيل الموظف', 'Détails de l\'employé', 'कर्मचारी विवरण', 'Detail Karyawan', 'Dettagli del dipendente', '従業員の詳細', '직원 세부 정보', 'Werknemersdetails', 'Detalhes do funcionário', 'รายละเอียดพนักงาน', 'Çalışan bilgileri', 'ملازم کی تفصیلات', '员工详细信息'),
(721, 'salary_transaction', 'Salary Transaction', 'বেতন লেনদেন', 'معاملة الراتب', 'Transaction salariale', 'वेतन का लेन-देन', 'Transaksi Gaji', 'Transazione di stipendio', '給与取引', '급여 거래', 'Salaristransactie', 'Transação Salarial', 'การทำธุรกรรมเงินเดือน', 'Maaş İşlemi', 'تنخواہ ٹرانزیکشن', '薪酬交易'),
(722, 'documents', 'Documents', 'কাগজপত্র', 'مستندات', 'Documents', 'दस्तावेज़', 'Dokumen', 'Documenti', '書類', '서류', 'documenten', 'Documentos', 'เอกสาร', 'evraklar', 'دستاویزات', '文件'),
(723, 'actions', 'Actions', 'ক্রিয়াকলাপ', 'أفعال', 'actes', 'क्रिया', 'Tindakan', 'Azioni', '行動', '행위', 'acties', 'Ações', 'การปฏิบัติ', 'Eylemler', 'ایکشنز', '操作'),
(724, 'activity', 'Activity', 'কার্যকলাপ', 'نشاط', 'Activité', 'गतिविधि', 'Aktivitas', 'Attività', 'アクティビティ', '활동', 'Activiteit', 'Atividade', 'กิจกรรม', 'Aktivite', 'سرگرمی', '活动'),
(725, 'department_list', 'Department List', 'বিভাগ তালিকা', 'قائمة الإدارات', 'Liste des départements', 'विभाग की सूची', 'Daftar Departemen', 'Lista del dipartimento', '学部リスト', '부서 목록', 'Afdelingslijst', 'Lista de Departamentos', 'รายชื่อกรม', 'Bölüm Listesi', 'ڈپارٹمنٹ کی فہرست', '部门名单'),
(726, 'manage_employee_salary', 'Manage Employee Salary', 'কর্মচারী বেতন পরিচালনা করুন', 'إدارة راتب الموظف', 'Gérer le salaire des employés', 'कर्मचारी वेतन का प्रबंधन करें', 'Kelola Gaji Karyawan', 'Gestire lo stipendio dei dipendenti', '従業員給与の管理', '직원 급여 관리', 'Beheer salarissen van werknemers', 'Gerenciar Salário de Funcionário', 'จัดการเงินเดือนพนักงาน', 'Çalışan Maaşını Yönet', 'ملازم تنخواہ کا نظم کریں', '管理员工薪酬'),
(727, 'the_configuration_has_been_updated', 'The Configuration Has Been Updated', 'কনফিগারেশন আপডেট করা হয়েছে', 'تم تحديث التكوين', 'La configuration a été mise à jour', 'कॉन्फ़िगरेशन अद्यतन किया गया है', 'Konfigurasi Telah Diperbarui', 'La configurazione è stata aggiornata', '設定が更新されました', '구성이 업데이트되었습니다.', 'De configuratie is bijgewerkt', 'A configuração foi atualizada', 'อัปเดตการกำหนดค่าแล้ว', 'Yapılandırma Güncellenmiştir', 'ترتیب تازہ کاری کی گئی ہے', '配置已更新'),
(728, 'add', 'Add', 'যোগ', 'إضافة', 'Ajouter', 'जोड़ना', 'Menambahkan', 'Inserisci', '追加する', '더하다', 'Toevoegen', 'Adicionar', 'เพิ่ม', 'Eklemek', 'شامل کریں', '加'),
(729, 'create_exam', 'Create Exam', 'পরীক্ষা তৈরি করুন', 'إنشاء اختبار', 'Créer un examen', 'परीक्षा बनाएँ', 'Buat Ujian', 'Crea un esame', '試験を作成', '시험 만들기', 'Maak examen', 'Criar um exame', 'สร้างการสอบ', 'Sınav Oluştur', 'امتحان بنائیں', '创建考试'),
(730, 'term', 'Term', 'মেয়াদ', 'مصطلح', 'terme', 'अवधि', 'istilah', 'termine', '期間', '기간', 'termijn', 'prazo', 'วาระ', 'terim', 'اصطلاح', '术语'),
(731, 'add_term', 'Add Term', 'টার্ম যোগ করুন', 'إضافة مصطلح', 'Ajouter un terme', 'शब्द जोड़ें', 'Tambahkan Istilah', 'Aggiungi termine', '用語を追加', '용어 추가', 'Term toevoegen', 'Adicionar termo', 'เพิ่มคำ', 'Terim ekle', 'ٹرم شامل کریں', '添加术语'),
(732, 'create_grade', 'Create Grade', 'গ্রেড তৈরি করুন', 'خلق الصف', 'Créer une note', 'ग्रेड बनाएँ', 'Buat Grade', 'Crea un voto', '成績を作成', '학년 만들기', 'Maak cijfer', 'Criar nota', 'สร้างเกรด', 'Not Yarat', 'گریڈ بنائیں', '创建成绩'),
(733, 'mark_starting', 'Mark Starting', 'চিহ্নিত শুরু', 'علامة البداية', 'Marquer à partir', 'मार्क स्टार्टिंग', 'Tandai Mulai', 'Mark Starting', '開始マーク', '마크 시작', 'Begin markeren', 'Mark Starting', 'ทำเครื่องหมายเริ่มต้น', 'Mark Başlangıç', 'مارک شروع کرنا', '标记开始'),
(734, 'mark_until', 'Mark Until', 'পর্যন্ত চিহ্নিত করুন', 'مارك حتى', 'Merkitse kunnes', 'तक मार्क करें', 'Tandai Sampai', 'Mark Until', 'までマークする', '마크까지', 'Markeren tot', 'Marcar até', 'ทำเครื่องหมายจนถึง', 'Kadar İşaretle', 'تک نشان زد کریں', '马克直到'),
(735, 'room_list', 'Room List', 'কক্ষ তালিকা', 'قائمة غرفة', 'Liste des chambres', 'कक्ष सूची', 'Daftar Kamar', 'Elenco delle stanze', '部屋リスト', '방 목록', 'Kamerlijst', 'Room List', 'รายชื่อห้อง', 'Oda listesi', 'کمرہ کی فہرست', '房间清单'),
(736, 'room', 'Room', 'কক্ষ', 'مجال', 'pièce', 'कक्ष', 'kamar', 'camera', 'ルーム', '방', 'kamer', 'sala', 'ห้อง', 'oda', 'کمرے', '房间'),
(737, 'route_list', 'Route List', 'রুট তালিকা', 'قائمة الطريق', 'Liste des itinéraires', 'मार्ग सूची', 'Daftar Rute', 'Elenco dei percorsi', 'ルートリスト', '노선 목록', 'Routelijst', 'Lista de rotas', 'รายการเส้นทาง', 'Rota Listesi', 'راستے کی فہرست', '路线清单'),
(738, 'create_route', 'Create Route', 'রুট তৈরি করুন', 'انشاء الطريق', 'Créer un itinéraire', 'रूट बनाएं', 'Buat Rute', 'Crea rotta', 'ルートを作成', '경로 만들기', 'Maak route', 'Criar rota', 'สร้างเส้นทาง', 'Rota Oluştur', 'روٹ بنائیں', '创建路线'),
(739, 'vehicle_list', 'Vehicle List', 'যানবাহন তালিকা', 'قائمة المركبات', 'Liste de véhicules', 'वाहन सूची', 'Daftar Kendaraan', 'Lista dei veicoli', '車両リスト', '차량 목록', 'Voertuig lijst', 'Lista de veículos', 'รายการยานพาหนะ', 'Araç listesi', 'گاڑی کی فہرست', '车辆清单'),
(740, 'create_vehicle', 'Create Vehicle', 'যানবাহন তৈরি করুন', 'إنشاء مركبة', 'Créer un véhicule', 'वाहन बनाएँ', 'Buat Kendaraan', 'Crea veicolo', '車両を作成する', '차량 만들기', 'Maak een voertuig', 'Criar veículo', 'สร้างยานพาหนะ', 'Araç Oluştur', 'گاڑیاں بنائیں', '创建车辆'),
(741, 'stoppage_list', 'Stoppage List', 'স্টপ পেজ তালিকা', 'قائمة Stoppage', 'Liste d\'arrêt', 'ठहराव सूची', 'Daftar Penghentian', 'Lista di arresto', '停止リスト', '정지 목록', 'Stoplijst', 'Lista de Paradas', 'รายการหยุด', 'Durdurma Listesi', 'سٹاپ فہرست', '停工清单'),
(742, 'create_stoppage', 'Create Stoppage', 'বিরতি তৈরি করুন', 'انشاء stoppage', 'Créer un arrêt', 'ठहराव पैदा करो', 'Buat penghentian', 'Crea arresto', '停止を作成する', '파업 생성', 'Maak een stoppagina', 'Criar parada', 'สร้างการหยุด', 'Durdurma oluştur', 'سٹاپ بنائیں', '创建停工'),
(743, 'stop_time', 'Stop Time', 'বন্ধ সময়', 'وقف الوقت', 'temps d\'arrêt', 'रुकने का समय', 'Hentikan waktu', 'tempo di stop', '停止時間', '정지 시간', 'stoptijd', 'pare o tempo', 'หยุดเวลา', 'durma zamanı', 'وقت بند کرو', '停止时间'),
(744, 'employee_attendance', 'Employee Attendance', 'কর্মচারী উপস্থিতি', 'حضور الموظف', 'Présence des employés', 'कर्मचारी की उपस्थिति', 'Kehadiran Karyawan', 'Partecipazione dei dipendenti', '従業員の出席', '직원 출석', 'Aanwezigheid van werknemers', 'Atendimento ao Empregado', 'พนักงานเข้าร่วม', 'Çalışan Seyirci', 'ملازمت کی حاضری', '员工出勤'),
(745, 'attendance_report', 'Attendance Report', 'উপস্থিতি রিপোর্ট', 'تقرير الحضور', 'Rapport de présence', 'उपस्थिति विवरण', 'Laporan kehadiran', 'Rapporto di partecipazione', '出席レポート', '출석 보고서', 'Aanwezigheidsrapport', 'Relatório de presenças', 'รายงานการเข้าร่วมประชุม', 'Seyirci Raporu', 'حاضری کی رپورٹ', '出勤报告'),
(746, 'opening_balance', 'Opening Balance', 'ব্যালেন্স খোলা', 'الرصيد الافتتاحي', 'Solde d\'ouverture', 'प्रारंभिक शेष', 'Saldo awal', 'Saldo di apertura', '期首残高', '기초 잔액', 'Beginsaldo', 'Saldo inicial', 'ยอดคงเหลือต้นงวด', 'Açılış bilançosu', 'کھولنے کے بیلنس', '期初余额'),
(747, 'add_opening_balance', 'Add Opening Balance', 'উদ্বোধন ব্যালেন্স যোগ করুন', 'إضافة رصيد الافتتاح', 'ajouter un solde d\'ouverture', 'ओपनिंग बैलेंस जोड़ें', 'tambahkan Saldo pembukaan', 'aggiungi saldo di apertura', '期首残高を追加', '개시 잔액을 추가하십시오.', 'voeg openingssaldo toe', 'adicionar equilíbrio de abertura', 'เพิ่มยอดคงเหลือเปิด', 'açılış bakiyesi ekle', 'کھولنے والی بیلنس شامل کریں', '添加期初余额'),
(748, 'credit', 'Credit', 'ধার', 'ائتمان', 'crédit', 'श्रेय', 'kredit', 'credito', 'クレジット', '신용', 'credit', 'crédito', 'เครดิต', 'kredi', 'کریڈٹ', '信用'),
(749, 'debit', 'Debit', 'খরচ', 'مدين', 'débit', 'नामे', 'debit', 'addebito', '借方', '차변', 'debiteren', 'débito', 'หักบัญชี', 'borç', 'ڈیبٹ', '借方'),
(750, 'opening_balance_list', 'Opening Balance List', 'খোলার ভারসাম্য তালিকা', 'قائمة الرصيد الافتتاحي', 'liste des soldes d\'ouverture', 'संतुलन सूची खोलना', 'membuka daftar saldo', 'elenco di bilancio di apertura', '期首残高リスト', '기초 잔액리스트', 'openingsbalanslijst', 'lista de balanços de abertura', 'รายการสมดุลการเปิด', 'bakiye listesini açma', 'افتتاحی توازن کی فہرست', '期初余额清单'),
(751, 'voucher_list', 'Voucher List', 'ভাউচার তালিকা', 'قائمة القسائم', 'Liste des bons', 'वाउचर सूची', 'Daftar Voucher', 'Lista dei buoni', 'バウチャーリスト', '바우처 목록', 'Voucher lijst', 'Lista de Vouchers', 'รายการบัตรกำนัล', 'Kupon Listesi', 'واؤچر کی فہرست', '优惠券清单'),
(752, 'voucher_head', 'Voucher Head', 'ভাউচার হেড', 'رئيس قسيمة', 'Chef de bon', 'वाउचर प्रमुख', 'Kepala Voucher', 'Voucher Testa', 'バウチャーヘッド', '바우처 헤드', 'Bonhoofd', 'Cabeça de comprovante', 'หัวหน้าบัตรกำนัล', 'Kupon Başkanı', 'واؤچر ہیڈ', '凭证头'),
(753, 'payment_method', 'Payment Method', 'মূল্যপরিশোধ পদ্ধতি', 'طريقة الدفع او السداد', 'Mode de paiement', 'भुगतान का तरीका', 'Metode pembayaran', 'Metodo di pagamento', '支払方法', '지불 방법', 'Betalingsmiddel', 'Método de pagamento', 'วิธีการชำระเงิน', 'Ödeme şekli', 'ادائیگی کا طریقہ', '付款方法'),
(754, 'credit_ledger_account', 'Credit Ledger Account', 'ক্রেডিট লেজার অ্যাকাউন্ট', 'حساب دفتر الأستاذ', 'Compte de crédit', 'क्रेडिट लेजर खाता', 'Akun Buku Besar Kredit', 'Conto del conto di credito', 'クレジット元帳アカウント', '크레딧 원장 계정', 'Credit Ledger-account', 'Conta contábil de crédito', 'บัญชีแยกประเภทเครดิต', 'Kredi Muhasebe Hesabı', 'کریڈٹ لیڈر اکاؤنٹ', '信用分类帐'),
(755, 'debit_ledger_account', 'Debit Ledger Account', 'ডেবিট লেজার অ্যাকাউন্ট', 'حساب دفتر الأستاذ المدين', 'Compte général débiteur', 'डेबिट लेजर खाता', 'Debit Ledger Account', 'Conto del conto di addebito', '借方元帳アカウント', '차변원 원장 계정', 'Debet Grootboekrekening', 'Conta do razão de débito', 'เดบิตบัญชีแยกประเภท', 'Borç Muhasebe Hesabı', 'ڈیبٹ لیڈر اکاؤنٹ', '借记帐户'),
(756, 'voucher_no', 'Voucher No', 'ভাউচার নং', 'رقم القسيمة', 'N ° de bon', 'वाउचर संख्या', 'Voucher No.', 'Voucher n', 'バウチャー番号', '바우처 번호', 'Coupon nr', 'Voucher No', 'หมายเลขคูปอง', 'Fiş numarası', 'واؤچر نمبر', '凭证号码'),
(757, 'balance', 'Balance', 'ভারসাম্য', 'توازن', 'équilibre', 'संतुलन', 'keseimbangan', 'equilibrio', 'バランス', '균형', 'balans', 'equilibrar', 'สมดุล', 'denge', 'بقیہ', '平衡'),
(758, 'event_details', 'Event Details', 'ঘটনার বিবরন', 'تفاصيل الحدث', 'Détails de l\'évènement', 'घटना की जानकारी', 'detail acara', 'dettagli dell\'evento', 'イベントの詳細', '일정 세부 정보', 'Evenementdetails', 'detalhes do evento', 'รายละเอียดกิจกรรม', 'รายละเอียดกิจกรรม', 'واقعہ کی تفصیلات', '活动详情'),
(759, 'welcome_to', 'Welcome To', 'স্বাগতম', 'مرحبا بك في', 'Bienvenue à', 'में स्वागत', 'Selamat Datang di', 'Benvenuto a', 'へようこそ', '에 오신 것을 환영합니다', 'Welkom bij', 'Bem-vindo ao', 'ยินดีต้อนรับสู่', 'Hoşgeldiniz', 'خوش آمدید', '欢迎来到'),
(760, 'report_card', 'Report Card', 'রিপোর্ট কার্ড', 'بطاقة تقرير', 'Bulletin scolaire', 'रिपोर्ट कार्ड', 'Kartu Laporan', 'Report Card', '報告カード', '성적표', 'Rapport', 'Boletim', 'บัตรรายงาน', 'Karne', 'رپورٹ کارڈ', '报告卡'),
(761, 'online_pay', 'Online Pay', 'অনলাইন দিতে', 'قدم عبر الإنترنت', 'Donner en ligne', 'ऑनलाइन दें', 'Adjon online', 'Dare online', 'オンラインで贈る', '온라인 제공', 'Geef online', 'Dar online', 'ให้ออนไลน์', 'Çevrimiçi ver', 'آن لائن دے دو', '在线提供'),
(762, 'annual_fees_summary', 'Annual Fees Summary', 'বার্ষিক ফি সংক্ষিপ্ত বিবরণ', 'ملخص الرسوم السنوية', 'Résumé des frais annuels', 'वार्षिक शुल्क सारांश', 'Ringkasan Biaya Tahunan', 'Riepilogo tariffe annuali', '年会費サマリー', '연회비 요약', 'Jaarlijks kostenoverzicht', 'Resumo das Taxas Anuais', 'สรุปค่าธรรมเนียมรายปี', 'Yıllık Ücret Özeti', 'سالانہ فیس خلاصہ', '年度费用摘要'),
(763, 'my_children', 'My Children', 'আমার শিশু', 'أطفالي', 'Mes enfants', 'मेरे बच्चे', 'Anak-anak saya', 'I miei figli', '私の子供たち', '아이들', 'Mijn kinderen', 'Minhas crianças', 'ลูก ๆ ของฉัน', 'Benim çocuklarım', 'میری اولاد', '我的孩子们'),
(764, 'assigned', 'Assigned', 'বরাদ্দ', 'تعيين', 'Attribué', 'निरुपित', 'Ditugaskan', 'Assegnato', '割り当て済み', '배정 된', 'toegewezen', 'Atribuído', 'ที่ได้รับมอบหมาย', 'atanan', 'تفویض', '分配'),
(765, 'confirm_password', 'Confirm Password', 'পাসওয়ার্ড নিশ্চিত করুন', 'تأكيد كلمة المرور', 'Confirmez le mot de passe', 'पासवर्ड की पुष्टि कीजिये', 'konfirmasi sandi', 'conferma password', 'パスワードを認証する', '비밀번호 확인', 'bevestig wachtwoord', 'Confirme a Senha', 'ยืนยันรหัสผ่าน', 'Şifreyi Onayla', 'پاس ورڈ کی توثیق کریں', '确认密码'),
(766, 'searching_results', 'Searching Results', 'অনুসন্ধান ফলাফল', 'نتائج البحث', 'Résultats de recherche', 'खोज परिणाम', 'Hasil Pencarian', 'Ricerca dei risultati', '検索結果', '검색 결과', 'Resultaten zoeken', 'Pesquisando Resultados', 'ผลการค้นหา', 'Arama sonuçları', 'تلاش کے نتائج', '搜索结果'),
(767, 'information_has_been_saved_successfully', 'Information Has Been Saved Successfully', 'তথ্য সফলভাবে সংরক্ষিত হয়েছে', 'تم حفظ المعلومات بنجاح', 'L\'information a été sauvegardée avec succès', 'जानकारी सफलतापूर्वक बच गई है', 'Informasi Telah Berhasil Disimpan', 'Le informazioni sono state salvate con successo', '情報は正常に保存されました', '정보가 성공적으로 저장되었습니다.', 'Informatie is succesvol opgeslagen', 'Informações foram salvas com sucesso', 'ข้อมูลถูกบันทึกเรียบร้อยแล้ว', 'Bilgi başarıyla kaydedildi', 'معلومات کامیابی سے محفوظ ہوگئی ہے', '信息已成功保存'),
(768, 'information_deleted', 'The information has been successfully deleted', 'তথ্য সফলভাবে মুছে ফেলা হয়েছে', 'تم حذف المعلومات بنجاح', 'L\'information a été supprimée avec succès', 'जानकारी सफलतापूर्वक हटा दी गई है', 'Informasi telah berhasil dihapus', 'Le informazioni sono state cancellate con successo', '情報は正常に削除されました', '정보가 성공적으로 삭제되었습니다.', 'De informatie is succesvol verwijderd', 'A informação foi apagada com sucesso', 'ลบข้อมูลสำเร็จแล้ว', 'Bilgi başarıyla silindi', 'معلومات کامیابی سے ختم ہوگئی ہے', '该信息已成功删除'),
(769, 'deleted_note', '*Note : This data will be permanently deleted', '* দ্রষ্টব্য: এই তথ্য স্থায়ীভাবে মুছে ফেলা হবে', '* ملاحظة: سيتم حذف هذه البيانات نهائيًا', '* Remarque: ces données seront définitivement supprimées.', '* नोट: यह डेटा स्थायी रूप से हटा दिया जाएगा', '* Catatan: Data ini akan dihapus secara permanen', '* Nota: questi dati saranno eliminati in modo permanente', '*注：このデータは完全に削除されます', '* 참고 :이 데이터는 영구적으로 삭제됩니다.', '* Opmerking: deze gegevens worden permanent verwijderd', '* Nota: Estes dados serão permanentemente excluídos', '* หมายเหตุ: ข้อมูลนี้จะถูกลบอย่างถาวร', '* Not: Bu veri kalıcı olarak silinecek', '* نوٹ: یہ ڈیٹا مستقل طور پر ختم ہوجائے گا', '*注意：此数据将被永久删除'),
(770, 'are_you_sure', 'Are You Sure?', 'তুমি কি নিশ্চিত?', 'هل أنت واثق؟', 'Êtes-vous sûr?', 'क्या आपको यकीन है?', 'Apakah Anda Yakin?', 'Sei sicuro?', '本気ですか？', '확실해?', 'Weet je het zeker?', 'Você tem certeza?', 'คุณแน่ใจไหม?', 'Emin misiniz?', 'کیا تمہیں یقین ہے؟', '你确定吗？'),
(771, 'delete_this_information', 'Do You Want To Delete This Information?', 'আপনি এই তথ্য মুছে ফেলতে চান?', 'هل تريد حذف هذه المعلومات؟', 'Voulez-vous supprimer cette information?', 'क्या आप इस जानकारी को हटाना चाहते हैं?', 'Apakah Anda Ingin Menghapus Informasi Ini?', 'Vuoi eliminare queste informazioni?', 'この情報を削除しますか？', '이 정보를 삭제 하시겠습니까?', 'Wilt u deze informatie verwijderen?', 'Você deseja excluir esta informação?', 'คุณต้องการลบข้อมูลนี้หรือไม่?', 'Bu Bilgiyi Silmek İstiyor musunuz?', 'کیا آپ اس معلومات کو حذف کرنا چاہتے ہیں؟', '你想删除这些信息吗？'),
(772, 'yes_continue', 'Yes, Continue', 'হ্যাঁ, চালিয়ে যান', 'نعم ، تابع', 'Oui, continue', 'हां, जारी रखें', 'Ya, Lanjutkan', 'Sì, continua', 'はい、続けます', '예, 계속하십시오.', 'Ja, doorgaan', 'Sim, continuar', 'ใช่ดำเนินการต่อ', 'Evet devam et', 'جی ہاں، جاری رکھیں', '是的，继续'),
(773, 'deleted', 'Deleted', 'মোছা', 'تم الحذف', 'supprimé', 'हटाए गए', 'dihapus', 'cancellato', '削除しました', '삭제 된', 'verwijderde', 'deletado', 'ลบ', 'silindi', 'حذف کر دیا گیا', '删除'),
(774, 'collect', 'Collect', 'সংগ্রহ করা', 'تجميع', 'Collecte', 'एकत्र', 'Mengumpulkan', 'Raccogliere', '集める', '수집', 'Verzamelen', 'Recolher', 'เก็บ', 'Toplamak', 'جمع', '搜集'),
(775, 'school_setting', 'School Setting', 'স্কুল সেটিং', 'إعداد المدرسة', 'Milieu scolaire', 'स्कूल की स्थापना', 'Pengaturan sekolah', 'Impostazione della scuola', '学校の設定', '학교 환경 설정', 'School instelling', 'Escola, armando', 'สภาพแวดล้อมของโรงเรียน', 'Okul ayarı', 'سکول کی ترتیب', '学校环境'),
(776, 'set', 'Set', 'স্থাপন করা', 'جلس', 'ensemble', 'सेट', 'set', 'impostato', 'セット', '세트', 'reeks', 'conjunto', 'ชุด', 'set', 'سیٹ کریں', '组'),
(777, 'quick_view', 'Quick View', 'তারাতারি দেখা', 'نظرة سريعة', 'Aperçu rapide', 'जल्दी देखो', 'Lihat sekilas', 'Un\'occhiata', 'クイックビュー', '퀵뷰', 'Snelle kijk', 'Olhada rápida', 'มุมมองด่วน', 'Hızlı Görünüm', 'فوری ملاحظہ کریں', '快速浏览'),
(778, 'due_fees_invoice', 'Due Fees Invoice', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(779, 'my_application', 'My Application', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(780, 'manage_application', 'Manage Application', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(781, 'leave', 'Leave', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(782, 'live_class_rooms', 'Live Class Rooms', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(783, 'homework', 'Homework', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(784, 'evaluation_report', 'Evaluation Report', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(785, 'exam_term', 'Exam Term', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(786, 'distribution', 'Distribution', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(787, 'exam_setup', 'Exam Setup', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(788, 'sms', 'Sms', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(789, 'fees_type', 'Fees Type', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(790, 'fees_group', 'Fees Group', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(791, 'fine_setup', 'Fine Setup', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(792, 'fees_reminder', 'Fees Reminder', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(793, 'new_deposit', 'New Deposit', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(794, 'new_expense', 'New Expense', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(795, 'all_transactions', 'All Transactions', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(796, 'head', 'Head', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(797, 'fees_reports', 'Fees Reports', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(798, 'fees_report', 'Fees Report', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(799, 'receipts_report', 'Receipts Report', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(800, 'due_fees_report', 'Due Fees Report', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(801, 'fine_report', 'Fine Report', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(802, 'financial_reports', 'Financial Reports', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(803, 'statement', 'Statement', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(804, 'repots', 'Repots', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(805, 'expense', 'Expense', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(806, 'transitions', 'Transitions', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(807, 'sheet', 'Sheet', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(808, 'income_vs_expense', 'Income Vs Expense', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(809, 'attendance_reports', 'Attendance Reports', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(810, 'examination', 'Examination', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(811, 'school_settings', 'School Settings', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(812, 'role_permission', 'Role Permission', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(813, 'cron_job', 'Cron Job', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `languages` (`id`, `word`, `english`, `bengali`, `arabic`, `french`, `hindi`, `indonesian`, `italian`, `japanese`, `korean`, `dutch`, `portuguese`, `thai`, `turkish`, `urdu`, `chinese`) VALUES
(814, 'custom_field', 'Custom Field', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(815, 'enter_valid_email', 'Enter Valid Email', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(816, 'lessons', 'Lessons', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(817, 'live_class', 'Live Class', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(818, 'sl', 'Sl', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(819, 'meeting_id', 'Meeting Id', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(820, 'start_time', 'Start Time', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(821, 'end_time', 'End Time', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(822, 'zoom_meeting_id', 'Zoom Meeting Id', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(823, 'zoom_meeting_password', 'Zoom Meeting Password', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(824, 'time_slot', 'Time Slot', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(825, 'send_notification_sms', 'Send Notification Sms', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(826, 'host', 'Host', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(827, 'school', 'School', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(828, 'accounting_links', 'Accounting Links', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(829, 'applicant', 'Applicant', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(830, 'apply_date', 'Apply Date', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(831, 'add_leave', 'Add Leave', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(832, 'leave_date', 'Leave Date', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(833, 'attachment', 'Attachment', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(834, 'comments', 'Comments', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(835, 'staff_id', 'Staff Id', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(836, 'income_vs_expense_of', 'Income Vs Expense Of', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(837, 'designation_name', 'Designation Name', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(838, 'already_taken', 'This %s already exists.', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(839, 'department_name', 'Department Name', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(840, 'date_of_birth', 'Date Of Birth', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(841, 'bulk_delete', 'Bulk Delete', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(842, 'guardian_name', 'Guardian Name', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(843, 'fees_progress', 'Fees Progress', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(844, 'evaluate', 'Evaluate', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(845, 'date_of_homework', 'Date Of Homework', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(846, 'date_of_submission', 'Date Of Submission', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(847, 'student_fees_report', 'Student Fees Report', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(848, 'student_fees_reports', 'Student Fees Reports', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(849, 'due_date', 'Due Date', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(850, 'payment_date', 'Payment Date', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(851, 'payment_via', 'Payment Via', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(852, 'generate', 'Generate', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(853, 'print_date', 'Print Date', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(854, 'bulk_sms_and_email', 'Bulk Sms And Email', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(855, 'campaign_type', 'Campaign Type', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(856, 'both', 'Both', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(857, 'regular', 'Regular', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(858, 'Scheduled', 'Scheduled', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(859, 'campaign', 'Campaign', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(860, 'campaign_name', 'Campaign Name', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(861, 'sms_gateway', 'Sms Gateway', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(862, 'recipients_type', 'Recipients Type', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(863, 'recipients_count', 'Recipients Count', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(864, 'body', 'Body', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(865, 'guardian_already_exist', 'Guardian Already Exist', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(866, 'guardian', 'Guardian', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(867, 'mother_name', 'Mother Name', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(868, 'bank_details', 'Bank Details', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(869, 'skipped_bank_details', 'Skipped Bank Details', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(870, 'bank', 'Bank', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(871, 'holder_name', 'Holder Name', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(872, 'bank_branch', 'Bank Branch', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(873, 'custom_field_for', 'Custom Field For', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(874, 'label', 'Label', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(875, 'order', 'Order', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(876, 'online_admission', 'Online Admission', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(877, 'field_label', 'Field Label', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(878, 'field_type', 'Field Type', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(879, 'default_value', 'Default Value', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(880, 'checked', 'Checked', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(881, 'unchecked', 'Unchecked', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(882, 'roll_number', 'Roll Number', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(883, 'add_rows', 'Add Rows', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(884, 'salary', 'Salary', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(885, 'basic', 'Basic', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(886, 'allowance', 'Allowance', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(887, 'deduction', 'Deduction', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(888, 'net', 'Net', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(889, 'activated_sms_gateway', 'Activated Sms Gateway', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(890, 'account_sid', 'Account Sid', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(891, 'roles', 'Roles', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(892, 'system_role', 'System Role', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(893, 'permission', 'Permission', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(894, 'edit_session', 'Edit Session', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(895, 'transactions', 'Transactions', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(896, 'default_account', 'Default Account', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(897, 'deposit', 'Deposit', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(898, 'acccount', 'Acccount', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(899, 'role_permission_for', 'Role Permission For', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(900, 'feature', 'Feature', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(901, 'access_denied', 'Access Denied', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(902, 'time_start', 'Time Start', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(903, 'time_end', 'Time End', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(904, 'month_of_salary', 'Month Of Salary', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(905, 'add_documents', 'Add Documents', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(906, 'document_type', 'Document Type', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(907, 'document', 'Document', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(908, 'document_title', 'Document Title', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(909, 'document_category', 'Document Category', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(910, 'exam_result', 'Exam Result', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(911, 'my_annual_fee_summary', 'My Annual Fee Summary', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(912, 'book_manage', 'Book Manage', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(913, 'add_leave_category', 'Add Leave Category', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(914, 'edit_leave_category', 'Edit Leave Category', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(915, 'staff_role', 'Staff Role', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(916, 'edit_assign', 'Edit Assign', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(917, 'view_report', 'View Report', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(918, 'rank_out_of_5', 'Rank Out Of 5', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(919, 'hall_no', 'Hall No', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(920, 'no_of_seats', 'No Of Seats', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(921, 'mark_distribution', 'Mark Distribution', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(922, 'exam_type', 'Exam Type', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(923, 'marks_and_grade', 'Marks And Grade', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(924, 'min_percentage', 'Min Percentage', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(925, 'max_percentage', 'Max Percentage', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(926, 'cost_per_bed', 'Cost Per Bed', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(927, 'add_category', 'Add Category', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(928, 'category_for', 'Category For', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(929, 'start_place', 'Start Place', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(930, 'stop_place', 'Stop Place', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(931, 'vehicle', 'Vehicle', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(932, 'select_multiple_vehicle', 'Select Multiple Vehicle', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(933, 'book_details', 'Book Details', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(934, 'issued_by', 'Issued By', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(935, 'return_by', 'Return By', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(936, 'group', 'Group', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(937, 'individual', 'Individual', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(938, 'recipients', 'Recipients', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(939, 'group_name', 'Group Name', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(940, 'fee_code', 'Fee Code', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(941, 'fine_type', 'Fine Type', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(942, 'fine_value', 'Fine Value', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(943, 'late_fee_frequency', 'Late Fee Frequency', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(944, 'fixed_amount', 'Fixed Amount', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(945, 'fixed', 'Fixed', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(946, 'daily', 'Daily', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(947, 'weekly', 'Weekly', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(948, 'monthly', 'Monthly', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(949, 'annually', 'Annually', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(950, 'first_select_the_group', 'First Select The Group', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(951, 'percentage', 'Percentage', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(952, 'value', 'Value', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(953, 'fee_group', 'Fee Group', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(954, 'due_invoice', 'Due Invoice', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(955, 'reminder', 'Reminder', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(956, 'frequency', 'Frequency', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(957, 'notify', 'Notify', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(958, 'before', 'Before', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(959, 'after', 'After', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(960, 'number', 'Number', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(961, 'ref_no', 'Ref No', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(962, 'pay_via', 'Pay Via', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(963, 'ref', 'Ref', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(964, 'dr', 'Dr', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(965, 'cr', 'Cr', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(966, 'edit_book', 'Edit Book', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(967, 'leaves', 'Leaves', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(968, 'leave_request', 'Leave Request', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(969, 'this_file_type_is_not_allowed', 'This File Type Is Not Allowed', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(970, 'error_reading_the_file', 'Error Reading The File', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(971, 'staff', 'Staff', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(972, 'waiting', 'Waiting', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(973, 'live', 'Live', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(974, 'by', 'By', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(975, 'host_live_class', 'Host Live Class', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(976, 'join_live_class', 'Join Live Class', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(977, 'system_logo', 'System Logo', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(978, 'text_logo', 'Text Logo', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(979, 'printing_logo', 'Printing Logo', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(980, 'expired', 'Expired', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `language_list`
--

CREATE TABLE `language_list` (
  `id` int(11) NOT NULL,
  `name` varchar(600) NOT NULL,
  `lang_field` varchar(600) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `language_list`
--

INSERT INTO `language_list` (`id`, `name`, `lang_field`, `status`, `created_at`, `updated_at`) VALUES
(1, 'English', 'english', 1, '2018-11-15 17:36:31', '2020-04-18 20:05:12'),
(2, 'Bengali', 'bengali', 1, '2018-11-15 17:36:31', '2018-12-04 15:41:50'),
(3, 'Arabic', 'arabic', 1, '2018-11-15 17:36:31', '2019-01-20 03:04:53'),
(4, 'French', 'french', 1, '2018-11-15 17:36:31', '2019-01-20 03:04:55'),
(5, 'Hindi', 'hindi', 1, '2018-11-15 17:36:31', '2019-01-20 03:00:10'),
(6, 'Indonesian', 'indonesian', 1, '2018-11-15 17:36:31', '2019-01-20 03:00:12'),
(7, 'Italian', 'italian', 1, '2018-11-15 17:36:31', '2019-01-20 03:00:14'),
(8, 'Japanese', 'japanese', 1, '2018-11-15 17:36:31', '2019-01-20 03:00:15'),
(9, 'Korean', 'korean', 1, '2018-11-15 17:36:31', '2019-01-20 03:00:17'),
(10, 'Dutch', 'dutch', 1, '2018-11-15 17:36:31', '2019-01-20 03:00:19'),
(11, 'Portuguese', 'portuguese', 1, '2018-11-15 17:36:31', '2019-01-20 03:00:20'),
(12, 'Thai', 'thai', 1, '2018-11-15 17:36:31', '2019-01-20 03:00:22'),
(13, 'Turkish', 'turkish', 1, '2018-11-15 17:36:31', '2019-01-20 03:00:25'),
(14, 'Urdu', 'urdu', 1, '2018-11-15 17:36:31', '2019-01-20 03:00:28'),
(15, 'Chinese', 'chinese', 1, '2018-11-15 17:36:31', '2019-03-29 02:44:39');

-- --------------------------------------------------------

--
-- Структура таблицы `leave_application`
--

CREATE TABLE `leave_application` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `category_id` int(2) NOT NULL,
  `reason` longtext CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `leave_days` varchar(20) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '1=pending,2=accepted 3=rejected',
  `apply_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `approved_by` int(11) NOT NULL,
  `orig_file_name` varchar(255) NOT NULL,
  `enc_file_name` varchar(255) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `leave_category`
--

CREATE TABLE `leave_category` (
  `id` int(2) NOT NULL,
  `name` longtext CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `role_id` tinyint(1) NOT NULL,
  `days` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `live_class`
--

CREATE TABLE `live_class` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `meeting_id` varchar(255) NOT NULL,
  `meeting_password` varchar(255) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` varchar(11) NOT NULL,
  `remarks` text NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `live_class_config`
--

CREATE TABLE `live_class_config` (
  `id` int(11) NOT NULL,
  `zoom_api_key` varchar(255) DEFAULT NULL,
  `zoom_api_secret` varchar(255) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `login_credential`
--

CREATE TABLE `login_credential` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` tinyint(2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1(active) 0(deactivate)',
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `login_credential`
--

INSERT INTO `login_credential` (`id`, `user_id`, `username`, `password`, `role`, `active`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin@admin.com', '$2y$10$A2Q8iSy0IXmkzayG31JXpu4D1b3mKy3tHQ.VOAf2mGrtESV8GI.mK', 1, 1, NULL, '2020-05-31 13:06:26', '2020-05-31 13:06:26');

-- --------------------------------------------------------

--
-- Структура таблицы `mark`
--

CREATE TABLE `mark` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `mark` text,
  `absent` varchar(4) DEFAULT NULL,
  `session_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `body` longtext NOT NULL,
  `subject` varchar(255) NOT NULL,
  `file_name` text,
  `enc_name` text,
  `trash_sent` tinyint(1) NOT NULL,
  `trash_inbox` int(11) NOT NULL,
  `fav_inbox` tinyint(1) NOT NULL,
  `fav_sent` tinyint(1) NOT NULL,
  `reciever` varchar(100) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `read_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 unread 1 read',
  `reply_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 unread 1 read',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `message_reply`
--

CREATE TABLE `message_reply` (
  `id` int(11) UNSIGNED NOT NULL,
  `message_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `file_name` text NOT NULL,
  `enc_name` text NOT NULL,
  `identity` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `parent`
--

CREATE TABLE `parent` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `relation` varchar(255) NOT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `occupation` varchar(100) NOT NULL,
  `income` varchar(100) NOT NULL,
  `education` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobileno` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0(active) 1(deactivate)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `payment_config`
--

CREATE TABLE `payment_config` (
  `id` int(11) NOT NULL,
  `paypal_username` varchar(255) DEFAULT NULL,
  `paypal_password` varchar(255) DEFAULT NULL,
  `paypal_signature` varchar(255) DEFAULT NULL,
  `paypal_email` varchar(255) DEFAULT NULL,
  `paypal_sandbox` tinyint(4) DEFAULT NULL,
  `paypal_status` tinyint(4) DEFAULT NULL,
  `stripe_secret` varchar(255) DEFAULT NULL,
  `stripe_demo` varchar(255) DEFAULT NULL,
  `stripe_status` tinyint(4) DEFAULT NULL,
  `payumoney_key` varchar(255) DEFAULT NULL,
  `payumoney_salt` varchar(255) DEFAULT NULL,
  `payumoney_demo` tinyint(4) DEFAULT NULL,
  `payumoney_status` tinyint(4) DEFAULT NULL,
  `paystack_secret_key` varchar(255) NOT NULL,
  `paystack_status` tinyint(4) NOT NULL,
  `razorpay_key_id` varchar(255) NOT NULL,
  `razorpay_key_secret` varchar(255) NOT NULL,
  `razorpay_demo` tinyint(4) NOT NULL,
  `razorpay_status` tinyint(4) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `payment_salary_stipend`
--

CREATE TABLE `payment_salary_stipend` (
  `id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `amount` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `payment_types`
--

CREATE TABLE `payment_types` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `branch_id` int(11) NOT NULL DEFAULT '0',
  `timestamp` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `payment_types`
--

INSERT INTO `payment_types` (`id`, `name`, `branch_id`, `timestamp`) VALUES
(1, 'Cash', 0, '2019-07-27 18:12:21'),
(2, 'Card', 0, '2019-07-27 18:12:31'),
(3, 'Cheque', 0, '2019-12-21 10:07:59'),
(4, 'Bank Transfer', 0, '2019-12-21 10:08:36'),
(5, 'Other', 0, '2019-12-21 10:08:45'),
(6, 'Paypal', 0, '2019-12-21 10:08:45'),
(7, 'Stripe', 0, '2019-12-21 10:08:45'),
(8, 'PayUmoney', 0, '2019-12-21 10:08:45'),
(9, 'Paystack', 0, '2019-12-21 10:08:45'),
(10, 'Razorpay', 0, '2019-12-21 10:08:45');

-- --------------------------------------------------------

--
-- Структура таблицы `payslip`
--

CREATE TABLE `payslip` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `month` varchar(200) DEFAULT NULL,
  `year` varchar(20) NOT NULL,
  `basic_salary` decimal(18,2) NOT NULL,
  `total_allowance` decimal(18,2) NOT NULL,
  `total_deduction` decimal(18,2) NOT NULL,
  `net_salary` decimal(18,2) NOT NULL,
  `bill_no` varchar(25) NOT NULL,
  `remarks` text NOT NULL,
  `pay_via` tinyint(1) NOT NULL,
  `hash` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid_by` varchar(200) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `payslip_details`
--

CREATE TABLE `payslip_details` (
  `id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  `type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `prefix` varchar(100) NOT NULL,
  `show_view` tinyint(1) DEFAULT '1',
  `show_add` tinyint(1) DEFAULT '1',
  `show_edit` tinyint(1) DEFAULT '1',
  `show_delete` tinyint(1) DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `permission`
--

INSERT INTO `permission` (`id`, `module_id`, `name`, `prefix`, `show_view`, `show_add`, `show_edit`, `show_delete`, `created_at`) VALUES
(1, 2, 'Student', 'student', 1, 1, 1, 1, '2020-01-22 17:45:47'),
(2, 2, 'Multiple Import', 'multiple_import', 0, 1, 0, 0, '2020-01-22 17:45:47'),
(3, 2, 'Student Category', 'student_category', 1, 1, 1, 1, '2020-01-22 17:45:47'),
(4, 2, 'Student Id Card', 'student_id_card', 1, 0, 0, 0, '2020-01-22 17:45:47'),
(5, 2, 'Disable Authentication', 'student_disable_authentication', 1, 1, 0, 0, '2020-01-22 17:45:47'),
(6, 4, 'Employee', 'employee', 1, 1, 1, 1, '2020-01-22 17:55:19'),
(7, 3, 'Parent', 'parent', 1, 1, 1, 1, '2020-01-22 19:24:05'),
(8, 3, 'Disable Authentication', 'parent_disable_authentication', 1, 1, 0, 0, '2020-01-22 20:22:21'),
(9, 4, 'Department', 'department', 1, 1, 1, 1, '2020-01-22 23:41:39'),
(10, 4, 'Designation', 'designation', 1, 1, 1, 1, '2020-01-22 23:41:39'),
(11, 4, 'Disable Authentication', 'employee_disable_authentication', 1, 1, 0, 0, '2020-01-22 23:41:39'),
(12, 5, 'Salary Template', 'salary_template', 1, 1, 1, 1, '2020-01-23 11:13:57'),
(13, 5, 'Salary Assign', 'salary_assign', 1, 1, 0, 0, '2020-01-23 11:14:05'),
(14, 5, 'Salary Payment', 'salary_payment', 1, 1, 0, 0, '2020-01-24 12:45:40'),
(15, 5, 'Salary Summary Report', 'salary_summary_report', 1, 0, 0, 0, '2020-03-14 23:09:17'),
(16, 5, 'Advance Salary', 'advance_salary', 1, 1, 1, 1, '2020-01-29 00:23:39'),
(17, 5, 'Advance Salary Manage', 'advance_salary_manage', 1, 1, 1, 1, '2020-01-25 10:57:12'),
(18, 5, 'Advance Salary Request', 'advance_salary_request', 1, 1, 0, 1, '2020-01-28 23:49:58'),
(19, 5, 'Leave Category', 'leave_category', 1, 1, 1, 1, '2020-01-29 08:46:23'),
(20, 5, 'Leave Request', 'leave_request', 1, 1, 1, 1, '2020-01-30 18:06:33'),
(21, 5, 'Leave Manage', 'leave_manage', 1, 1, 1, 1, '2020-01-29 13:27:15'),
(22, 5, 'Award', 'award', 1, 1, 1, 1, '2020-02-01 00:49:11'),
(23, 6, 'Classes', 'classes', 1, 1, 1, 1, '2020-02-02 00:10:00'),
(24, 6, 'Section', 'section', 1, 1, 1, 1, '2020-02-02 03:06:44'),
(25, 6, 'Assign Class Teacher', 'assign_class_teacher', 1, 1, 1, 1, '2020-02-02 13:09:22'),
(26, 6, 'Subject', 'subject', 1, 1, 1, 1, '2020-02-03 10:32:39'),
(27, 6, 'Subject Class Assign ', 'subject_class_assign', 1, 1, 1, 1, '2020-02-03 23:43:19'),
(28, 6, 'Subject Teacher Assign', 'subject_teacher_assign', 1, 1, 0, 1, '2020-02-04 01:05:11'),
(29, 6, 'Class Timetable', 'class_timetable', 1, 1, 1, 1, '2020-02-04 11:50:37'),
(30, 2, 'Student Promotion', 'student_promotion', 1, 1, 0, 0, '2020-02-06 00:20:30'),
(31, 8, 'Attachments', 'attachments', 1, 1, 1, 1, '2020-02-06 23:59:43'),
(32, 7, 'Homework', 'homework', 1, 1, 1, 1, '2020-02-07 11:40:08'),
(33, 8, 'Attachment Type', 'attachment_type', 1, 1, 1, 1, '2020-02-07 13:16:28'),
(34, 9, 'Exam', 'exam', 1, 1, 1, 1, '2020-02-07 15:59:29'),
(35, 9, 'Exam Term', 'exam_term', 1, 1, 1, 1, '2020-02-07 18:09:28'),
(36, 9, 'Exam Hall', 'exam_hall', 1, 1, 1, 1, '2020-02-07 20:31:04'),
(37, 9, 'Exam Timetable', 'exam_timetable', 1, 1, 0, 1, '2020-02-08 23:04:31'),
(38, 9, 'Exam Mark', 'exam_mark', 1, 1, 1, 1, '2020-02-10 18:53:41'),
(39, 9, 'Exam Grade', 'exam_grade', 1, 1, 1, 1, '2020-02-10 23:29:16'),
(40, 10, 'Hostel', 'hostel', 1, 1, 1, 1, '2020-02-11 10:41:36'),
(41, 10, 'Hostel Category', 'hostel_category', 1, 1, 1, 1, '2020-02-11 13:52:31'),
(42, 10, 'Hostel Room', 'hostel_room', 1, 1, 1, 1, '2020-02-11 17:50:09'),
(43, 10, 'Hostel Allocation', 'hostel_allocation', 1, 0, 0, 1, '2020-02-11 19:06:15'),
(44, 11, 'Transport Route', 'transport_route', 1, 1, 1, 1, '2020-02-12 11:26:19'),
(45, 11, 'Transport Vehicle', 'transport_vehicle', 1, 1, 1, 1, '2020-02-12 11:57:30'),
(46, 11, 'Transport Stoppage', 'transport_stoppage', 1, 1, 1, 1, '2020-02-12 12:49:20'),
(47, 11, 'Transport Assign', 'transport_assign', 1, 1, 1, 1, '2020-02-12 15:55:21'),
(48, 11, 'Transport Allocation', 'transport_allocation', 1, 0, 0, 1, '2020-02-13 01:33:05'),
(49, 12, 'Student Attendance', 'student_attendance', 0, 1, 0, 0, '2020-02-13 11:25:53'),
(50, 12, 'Employee Attendance', 'employee_attendance', 0, 1, 0, 0, '2020-02-13 16:04:16'),
(51, 12, 'Exam Attendance', 'exam_attendance', 0, 1, 0, 0, '2020-02-13 17:08:14'),
(52, 12, 'Student Attendance Report', 'student_attendance_report', 1, 0, 0, 0, '2020-02-14 01:20:56'),
(53, 12, 'Employee Attendance Report', 'employee_attendance_report', 1, 0, 0, 0, '2020-02-14 12:08:53'),
(54, 12, 'Exam Attendance Report', 'exam_attendance_report', 1, 0, 0, 0, '2020-02-14 12:21:40'),
(55, 13, 'Book', 'book', 1, 1, 1, 1, '2020-02-14 12:40:42'),
(56, 13, 'Book Category', 'book_category', 1, 1, 1, 1, '2020-02-15 10:11:41'),
(57, 13, 'Book Manage', 'book_manage', 1, 1, 0, 1, '2020-02-15 17:13:24'),
(58, 13, 'Book Request', 'book_request', 1, 1, 0, 1, '2020-02-17 12:45:19'),
(59, 14, 'Event', 'event', 1, 1, 1, 1, '2020-02-18 00:02:15'),
(60, 14, 'Event Type', 'event_type', 1, 1, 1, 1, '2020-02-18 10:40:33'),
(61, 15, 'Sendsmsmail', 'sendsmsmail', 1, 1, 0, 1, '2020-02-22 13:19:57'),
(62, 15, 'Sendsmsmail Template', 'sendsmsmail_template', 1, 1, 1, 1, '2020-02-22 16:14:57'),
(63, 17, 'Account', 'account', 1, 1, 1, 1, '2020-02-25 15:34:43'),
(64, 17, 'Deposit', 'deposit', 1, 1, 1, 1, '2020-02-25 18:56:11'),
(65, 17, 'Expense', 'expense', 1, 1, 1, 1, '2020-02-26 12:35:57'),
(66, 17, 'All Transactions', 'all_transactions', 1, 0, 0, 0, '2020-02-26 19:35:05'),
(67, 17, 'Voucher Head', 'voucher_head', 1, 1, 1, 1, '2020-02-25 16:50:56'),
(68, 17, 'Accounting Reports', 'accounting_reports', 1, 1, 1, 1, '2020-02-25 19:36:24'),
(69, 16, 'Fees Type', 'fees_type', 1, 1, 1, 1, '2020-02-27 16:11:03'),
(70, 16, 'Fees Group', 'fees_group', 1, 1, 1, 1, '2020-02-26 11:49:09'),
(71, 16, 'Fees Fine Setup', 'fees_fine_setup', 1, 1, 1, 1, '2020-03-05 08:59:27'),
(72, 16, 'Fees Allocation', 'fees_allocation', 1, 1, 1, 1, '2020-03-01 19:47:43'),
(73, 16, 'Collect Fees', 'collect_fees', 0, 1, 0, 0, '2020-03-15 10:23:58'),
(74, 16, 'Fees Reminder', 'fees_reminder', 1, 1, 1, 1, '2020-03-15 10:29:58'),
(75, 16, 'Due Invoice', 'due_invoice', 1, 0, 0, 0, '2020-03-15 10:33:36'),
(76, 16, 'Invoice', 'invoice', 1, 0, 0, 1, '2020-03-15 10:38:06'),
(77, 9, 'Mark Distribution', 'mark_distribution', 1, 1, 1, 1, '2020-03-19 19:02:54'),
(78, 9, 'Report Card', 'report_card', 1, 0, 0, 0, '2020-03-20 18:20:28'),
(79, 9, 'Tabulation Sheet', 'tabulation_sheet', 1, 0, 0, 0, '2020-03-21 13:12:38'),
(80, 15, 'Sendsmsmail Reports', 'sendsmsmail_reports', 1, 0, 0, 0, '2020-03-21 23:02:02'),
(81, 18, 'Global Settings', 'global_settings', 1, 0, 1, 0, '2020-03-22 11:05:41'),
(82, 18, 'Payment Settings', 'payment_settings', 1, 1, 0, 0, '2020-03-22 11:08:57'),
(83, 18, 'Sms Settings', 'sms_settings', 1, 1, 1, 1, '2020-03-22 11:08:57'),
(84, 18, 'Email Settings', 'email_settings', 1, 1, 1, 1, '2020-03-22 11:10:39'),
(85, 18, 'Translations', 'translations', 1, 1, 1, 1, '2020-03-22 11:18:33'),
(86, 18, 'Backup', 'backup', 1, 1, 1, 1, '2020-03-22 13:09:33'),
(87, 18, 'Backup Restore', 'backup_restore', 0, 1, 0, 0, '2020-03-22 13:09:34'),
(88, 7, 'Homework Evaluate', 'homework_evaluate', 1, 1, 0, 0, '2020-03-28 10:20:29'),
(89, 7, 'Evaluation Report', 'evaluation_report', 1, 0, 0, 0, '2020-03-28 15:56:04'),
(90, 18, 'School Settings', 'school_settings', 1, 0, 1, 0, '2020-03-30 23:36:37'),
(91, 1, 'Monthly Income Vs Expense Pie Chart', 'monthly_income_vs_expense_chart', 1, 0, 0, 0, '2020-03-31 12:15:31'),
(92, 1, 'Annual Student Fees Summary Chart', 'annual_student_fees_summary_chart', 1, 0, 0, 0, '2020-03-31 12:15:31'),
(93, 1, 'Employee Count Widget', 'employee_count_widget', 1, 0, 0, 0, '2020-03-31 12:31:56'),
(94, 1, 'Student Count Widget', 'student_count_widget', 1, 0, 0, 0, '2020-03-31 12:31:56'),
(95, 1, 'Parent Count Widget', 'parent_count_widget', 1, 0, 0, 0, '2020-03-31 12:31:56'),
(96, 1, 'Teacher Count Widget', 'teacher_count_widget', 1, 0, 0, 0, '2020-03-31 12:31:56'),
(97, 1, 'Student Quantity Pie Chart', 'student_quantity_pie_chart', 1, 0, 0, 0, '2020-03-31 13:14:07'),
(98, 1, 'Weekend Attendance Inspection Chart', 'weekend_attendance_inspection_chart', 1, 0, 0, 0, '2020-03-31 13:14:07'),
(99, 1, 'Admission Count Widget', 'admission_count_widget', 1, 0, 0, 0, '2020-03-31 13:22:05'),
(100, 1, 'Voucher Count Widget', 'voucher_count_widget', 1, 0, 0, 0, '2020-03-31 13:22:05'),
(101, 1, 'Transport Count Widget', 'transport_count_widget', 1, 0, 0, 0, '2020-03-31 13:22:05'),
(102, 1, 'Hostel Count Widget', 'hostel_count_widget', 1, 0, 0, 0, '2020-03-31 13:22:05'),
(103, 18, 'Accounting Links', 'accounting_links', 1, 0, 1, 0, '2020-03-31 15:46:30'),
(104, 16, 'Fees Reports', 'fees_reports', 1, 0, 0, 0, '2020-04-01 21:52:19'),
(105, 18, 'Cron Job', 'cron_job', 1, 0, 1, 0, '2020-03-31 15:46:30'),
(106, 18, 'Custom Field', 'custom_field', 1, 1, 1, 1, '2020-03-31 15:46:30'),
(107, 5, 'Leave Reports', 'leave_reports', 1, 0, 0, 0, '2020-03-31 15:46:30'),
(108, 18, 'Live Class Config', 'live_class_config', 1, 0, 1, 0, '2020-03-31 15:46:30'),
(109, 19, 'Live Class', 'live_class', 1, 1, 1, 1, '2020-03-31 15:46:30');

-- --------------------------------------------------------

--
-- Структура таблицы `permission_modules`
--

CREATE TABLE `permission_modules` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `prefix` varchar(50) NOT NULL,
  `system` tinyint(1) NOT NULL,
  `sorted` tinyint(10) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `permission_modules`
--

INSERT INTO `permission_modules` (`id`, `name`, `prefix`, `system`, `sorted`, `created_at`) VALUES
(1, 'Dashboard', 'dashboard', 1, 1, '2019-05-27 04:23:00'),
(2, 'Student', 'student', 1, 1, '2019-05-27 04:23:00'),
(3, 'Parents', 'parents', 1, 2, '2019-05-27 04:23:00'),
(4, 'Employee', 'employee', 1, 3, '2019-05-27 04:23:00'),
(5, 'Human Resource', 'human_resource', 1, 4, '2019-05-27 04:23:00'),
(6, 'Academic', 'academic', 1, 5, '2019-05-27 04:23:00'),
(7, 'Homework', 'homework', 1, 7, '2019-05-27 04:23:00'),
(8, 'Attachments Book', 'attachments_book', 1, 8, '2019-05-27 04:23:00'),
(9, 'Exam Master', 'exam_master', 1, 9, '2019-05-27 04:23:00'),
(10, 'Hostel', 'hostel', 1, 10, '2019-05-27 04:23:00'),
(11, 'Transport', 'transport', 1, 11, '2019-05-27 04:23:00'),
(12, 'Attendance', 'attendance', 1, 12, '2019-05-27 04:23:00'),
(13, 'Library', 'library', 1, 13, '2019-05-27 04:23:00'),
(14, 'Events', 'events', 1, 14, '2019-05-27 04:23:00'),
(15, 'Bulk Sms And Email', 'bulk_sms_and_email', 1, 15, '2019-05-27 04:23:00'),
(16, 'Student Accounting', 'student_accounting', 1, 16, '2019-05-27 04:23:00'),
(17, 'Office Accounting', 'office_accounting', 1, 17, '2019-05-27 04:23:00'),
(18, 'Settings', 'settings', 1, 18, '2019-05-27 04:23:00'),
(19, 'Live Class', 'live_class', 1, 6, '2019-05-27 04:23:00');

-- --------------------------------------------------------

--
-- Структура таблицы `reset_password`
--

CREATE TABLE `reset_password` (
  `key` longtext NOT NULL,
  `username` varchar(100) NOT NULL,
  `login_credential_id` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `rm_sessions`
--

CREATE TABLE `rm_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rm_sessions`
--

INSERT INTO `rm_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('el3ibj2rga989smvnfhmrtj4t2pm6av8', '127.0.0.1', 1590930667, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303933303338313b);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `is_system` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `prefix`, `is_system`) VALUES
(1, 'Super Admin', 'superadmin', '1'),
(2, 'Admin', 'admin', '1'),
(3, 'Teacher', 'teacher', '1'),
(4, 'Accountant', 'accountant', '1'),
(5, 'Librarian', 'librarian', '1'),
(6, 'Parent', 'parent', '1'),
(7, 'Student', 'student', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `salary_template`
--

CREATE TABLE `salary_template` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `basic_salary` decimal(18,2) NOT NULL,
  `overtime_salary` varchar(100) NOT NULL DEFAULT '0',
  `branch_id` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `salary_template_details`
--

CREATE TABLE `salary_template_details` (
  `id` int(11) NOT NULL,
  `salary_template_id` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `type` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `schoolyear`
--

CREATE TABLE `schoolyear` (
  `id` int(11) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `schoolyear`
--

INSERT INTO `schoolyear` (`id`, `school_year`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '2019-2020', 1, '2020-02-26 01:35:41', '2020-02-26 16:54:49'),
(3, '2020-2021', 1, '2020-02-26 01:35:41', '2020-02-26 01:35:41'),
(4, '2021-2022', 1, '2020-02-26 01:35:41', '2020-02-26 01:35:41'),
(5, '2022-2023', 1, '2020-02-26 01:35:41', '2020-02-26 01:35:41'),
(6, '2023-2024', 1, '2020-02-26 01:35:41', '2020-02-26 01:35:41'),
(7, '2024-2025', 1, '2020-02-26 01:35:41', '2020-02-26 01:20:04'),
(9, '2025-2026', 1, '2020-02-26 13:00:10', '2020-02-26 13:00:24');

-- --------------------------------------------------------

--
-- Структура таблицы `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `capacity` varchar(20) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sections_allocation`
--

CREATE TABLE `sections_allocation` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sms_api`
--

CREATE TABLE `sms_api` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sms_api`
--

INSERT INTO `sms_api` (`id`, `name`) VALUES
(1, 'twilio'),
(2, 'clickatell'),
(3, 'msg91'),
(4, 'bulksms'),
(5, 'textlocal');

-- --------------------------------------------------------

--
-- Структура таблицы `sms_credential`
--

CREATE TABLE `sms_credential` (
  `id` int(11) NOT NULL,
  `sms_api_id` int(11) NOT NULL,
  `field_one` varchar(300) NOT NULL,
  `field_two` varchar(300) NOT NULL,
  `field_three` varchar(300) NOT NULL,
  `field_four` varchar(300) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sms_template`
--

CREATE TABLE `sms_template` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tags` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sms_template`
--

INSERT INTO `sms_template` (`id`, `name`, `tags`) VALUES
(1, 'admission', '{name}, {class}, {section}, {admission_date}, {roll}, {register_no}'),
(2, 'fee_collection', '{name}, {class}, {section}, {admission_date}, {roll}, {register_no}, {paid_amount}, {paid_date} '),
(3, 'attendance', '{name}, {class}, {section}, {admission_date}, {roll}, {register_no}'),
(4, 'exam_attendance', '{name}, {class}, {section}, {admission_date}, {roll}, {register_no}, {exam_name}, {term_name}, {subject}'),
(5, 'exam_results', '{name}, {class}, {section}, {admission_date}, {roll}, {register_no}, {exam_name}, {term_name}, {subject}, {marks}'),
(6, 'homework', '{name}, {class}, {section}, {admission_date}, {roll}, {register_no}, {subject}, {date_of_homework}, {date_of_submission}'),
(7, 'live_class', '{name}, {class}, {section}, {admission_date}, {roll}, {register_no}, {date_of_live_class}, {start_time}, {end_time}, {host_by}');

-- --------------------------------------------------------

--
-- Структура таблицы `sms_template_details`
--

CREATE TABLE `sms_template_details` (
  `id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `notify_student` tinyint(3) NOT NULL DEFAULT '1',
  `notify_parent` tinyint(3) NOT NULL DEFAULT '1',
  `template_body` longtext NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` int(11) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `designation` int(11) NOT NULL,
  `joining_date` varchar(100) NOT NULL,
  `birthday` varchar(100) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `blood_group` varchar(20) NOT NULL,
  `present_address` text NOT NULL,
  `permanent_address` text NOT NULL,
  `mobileno` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `salary_template_id` int(11) DEFAULT '0',
  `branch_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `staff`
--

INSERT INTO `staff` (`id`, `staff_id`, `name`, `department`, `qualification`, `designation`, `joining_date`, `birthday`, `sex`, `religion`, `blood_group`, `present_address`, `permanent_address`, `mobileno`, `email`, `salary_template_id`, `branch_id`, `photo`, `facebook_url`, `linkedin_url`, `twitter_url`, `created_at`, `updated_at`, `hash`) VALUES
(1, '3597c7f', 'admin', 0, '', 0, '2020-05-31', '', '', '', '', '', '', '', 'admin@admin.com', 0, NULL, NULL, NULL, NULL, NULL, '2020-05-31 13:06:26', '2020-05-31 13:06:26', '');

-- --------------------------------------------------------

--
-- Структура таблицы `staff_attendance`
--

CREATE TABLE `staff_attendance` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `status` varchar(11) DEFAULT NULL COMMENT 'P=Present, A=Absent, H=Holiday, L=Late',
  `remark` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `staff_bank_account`
--

CREATE TABLE `staff_bank_account` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `holder_name` varchar(255) NOT NULL,
  `bank_branch` varchar(255) NOT NULL,
  `bank_address` varchar(255) NOT NULL,
  `ifsc_code` varchar(200) NOT NULL,
  `account_no` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `staff_department`
--

CREATE TABLE `staff_department` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `staff_designation`
--

CREATE TABLE `staff_designation` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `staff_documents`
--

CREATE TABLE `staff_documents` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` varchar(20) NOT NULL,
  `remarks` text NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `enc_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `staff_privileges`
--

CREATE TABLE `staff_privileges` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `is_add` tinyint(1) NOT NULL,
  `is_edit` tinyint(1) NOT NULL,
  `is_view` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `staff_privileges`
--

INSERT INTO `staff_privileges` (`id`, `role_id`, `permission_id`, `is_add`, `is_edit`, `is_view`, `is_delete`) VALUES
(1, 3, 1, 1, 1, 1, 1),
(2, 3, 2, 0, 0, 0, 0),
(3, 3, 3, 1, 1, 1, 1),
(4, 3, 4, 0, 0, 1, 0),
(5, 3, 5, 0, 0, 0, 0),
(6, 3, 30, 0, 0, 0, 0),
(7, 3, 7, 0, 0, 0, 0),
(8, 3, 8, 0, 0, 0, 0),
(9, 3, 6, 0, 0, 1, 0),
(10, 3, 9, 0, 0, 0, 0),
(11, 3, 10, 0, 0, 0, 0),
(12, 3, 11, 0, 0, 0, 0),
(13, 3, 12, 0, 0, 0, 0),
(14, 3, 13, 0, 0, 0, 0),
(15, 3, 14, 0, 0, 1, 0),
(16, 3, 15, 0, 0, 1, 0),
(17, 3, 16, 0, 0, 0, 0),
(18, 3, 17, 0, 0, 0, 0),
(20, 3, 19, 0, 0, 0, 0),
(21, 3, 20, 1, 1, 1, 1),
(22, 3, 21, 0, 0, 0, 0),
(23, 3, 22, 0, 0, 1, 0),
(24, 3, 23, 0, 0, 1, 0),
(25, 3, 24, 0, 0, 1, 0),
(26, 3, 25, 0, 0, 1, 0),
(27, 3, 26, 0, 0, 1, 0),
(28, 3, 27, 0, 0, 1, 0),
(29, 3, 28, 0, 0, 1, 0),
(30, 3, 29, 0, 0, 1, 0),
(31, 3, 32, 1, 1, 1, 1),
(32, 3, 31, 1, 1, 1, 1),
(33, 3, 33, 1, 1, 1, 1),
(34, 3, 34, 1, 1, 1, 1),
(35, 3, 35, 1, 1, 1, 1),
(36, 3, 36, 1, 1, 1, 1),
(37, 3, 37, 0, 0, 0, 0),
(38, 3, 38, 1, 1, 1, 1),
(39, 3, 39, 1, 1, 1, 1),
(40, 3, 77, 1, 1, 1, 1),
(41, 3, 78, 0, 0, 1, 0),
(42, 3, 79, 0, 0, 0, 0),
(43, 3, 40, 0, 0, 0, 0),
(44, 3, 41, 0, 0, 0, 0),
(45, 3, 42, 0, 0, 0, 0),
(46, 3, 43, 0, 0, 0, 0),
(47, 3, 44, 0, 0, 0, 0),
(48, 3, 45, 0, 0, 0, 0),
(49, 3, 46, 0, 0, 0, 0),
(50, 3, 47, 0, 0, 0, 0),
(51, 3, 48, 0, 0, 0, 0),
(52, 3, 49, 1, 0, 0, 0),
(53, 3, 50, 0, 0, 0, 0),
(54, 3, 51, 0, 0, 0, 0),
(55, 3, 52, 0, 0, 0, 0),
(56, 3, 53, 0, 0, 0, 0),
(57, 3, 54, 0, 0, 0, 0),
(58, 3, 55, 0, 0, 1, 0),
(59, 3, 56, 0, 0, 0, 0),
(60, 3, 57, 0, 0, 0, 0),
(61, 3, 58, 1, 0, 1, 1),
(62, 3, 59, 0, 0, 1, 0),
(63, 3, 60, 0, 0, 0, 0),
(64, 3, 61, 0, 0, 0, 0),
(65, 3, 62, 0, 0, 0, 0),
(66, 3, 80, 0, 0, 0, 0),
(67, 3, 69, 0, 0, 0, 0),
(68, 3, 70, 0, 0, 0, 0),
(69, 3, 71, 0, 0, 0, 0),
(70, 3, 72, 0, 0, 0, 0),
(71, 3, 73, 0, 0, 0, 0),
(72, 3, 74, 0, 0, 0, 0),
(73, 3, 75, 0, 0, 0, 0),
(74, 3, 76, 0, 0, 0, 0),
(75, 3, 63, 0, 0, 0, 0),
(76, 3, 64, 0, 0, 0, 0),
(77, 3, 65, 0, 0, 0, 0),
(78, 3, 66, 0, 0, 0, 0),
(79, 3, 67, 0, 0, 0, 0),
(80, 3, 68, 0, 0, 0, 0),
(81, 3, 81, 0, 0, 0, 0),
(82, 3, 82, 0, 0, 0, 0),
(83, 3, 83, 0, 0, 0, 0),
(84, 3, 84, 0, 0, 0, 0),
(85, 3, 85, 0, 0, 0, 0),
(86, 3, 86, 0, 0, 0, 0),
(87, 3, 87, 0, 0, 0, 0),
(88, 2, 1, 1, 1, 1, 1),
(89, 2, 2, 1, 0, 0, 0),
(90, 2, 3, 1, 1, 1, 1),
(91, 2, 4, 0, 0, 1, 0),
(92, 2, 5, 1, 0, 1, 0),
(93, 2, 30, 1, 0, 1, 0),
(94, 2, 7, 1, 1, 1, 1),
(95, 2, 8, 1, 0, 1, 0),
(96, 2, 6, 1, 1, 1, 1),
(97, 2, 9, 1, 1, 1, 1),
(98, 2, 10, 1, 1, 1, 1),
(99, 2, 11, 1, 0, 1, 0),
(100, 2, 12, 1, 1, 1, 1),
(101, 2, 13, 1, 0, 1, 0),
(102, 2, 14, 1, 0, 1, 0),
(103, 2, 15, 0, 0, 1, 0),
(104, 2, 16, 1, 1, 1, 1),
(105, 2, 17, 1, 1, 1, 1),
(107, 2, 19, 1, 1, 1, 1),
(108, 2, 20, 1, 1, 1, 1),
(109, 2, 21, 1, 1, 1, 1),
(110, 2, 22, 1, 1, 1, 1),
(111, 2, 23, 1, 1, 1, 1),
(112, 2, 24, 1, 1, 1, 1),
(113, 2, 25, 1, 1, 1, 1),
(114, 2, 26, 1, 1, 1, 1),
(115, 2, 27, 1, 1, 1, 1),
(116, 2, 28, 1, 0, 1, 1),
(117, 2, 29, 1, 1, 1, 1),
(118, 2, 32, 1, 1, 1, 1),
(119, 2, 31, 1, 1, 1, 1),
(120, 2, 33, 1, 1, 1, 1),
(121, 2, 34, 1, 1, 1, 1),
(122, 2, 35, 1, 1, 1, 1),
(123, 2, 36, 1, 1, 1, 1),
(124, 2, 37, 1, 0, 1, 1),
(125, 2, 38, 1, 1, 1, 1),
(126, 2, 39, 1, 1, 1, 1),
(127, 2, 77, 1, 1, 1, 1),
(128, 2, 78, 0, 0, 1, 0),
(129, 2, 79, 0, 0, 1, 0),
(130, 2, 40, 1, 1, 1, 1),
(131, 2, 41, 1, 1, 1, 1),
(132, 2, 42, 1, 1, 1, 1),
(133, 2, 43, 0, 0, 1, 1),
(134, 2, 44, 1, 1, 1, 1),
(135, 2, 45, 1, 1, 1, 1),
(136, 2, 46, 1, 1, 1, 1),
(137, 2, 47, 1, 1, 1, 1),
(138, 2, 48, 0, 0, 1, 1),
(139, 2, 49, 1, 0, 0, 0),
(140, 2, 50, 1, 0, 0, 0),
(141, 2, 51, 1, 0, 0, 0),
(142, 2, 52, 0, 0, 1, 0),
(143, 2, 53, 0, 0, 1, 0),
(144, 2, 54, 0, 0, 1, 0),
(145, 2, 55, 1, 1, 1, 1),
(146, 2, 56, 1, 1, 1, 1),
(147, 2, 57, 1, 0, 1, 1),
(148, 2, 58, 1, 0, 1, 1),
(149, 2, 59, 1, 1, 1, 1),
(150, 2, 60, 1, 1, 1, 1),
(151, 2, 61, 1, 0, 1, 1),
(152, 2, 62, 1, 1, 1, 1),
(153, 2, 80, 0, 0, 1, 0),
(154, 2, 69, 1, 1, 1, 1),
(155, 2, 70, 1, 1, 1, 1),
(156, 2, 71, 1, 1, 1, 1),
(157, 2, 72, 1, 1, 1, 1),
(158, 2, 73, 1, 0, 0, 0),
(159, 2, 74, 1, 1, 1, 1),
(160, 2, 75, 0, 0, 1, 0),
(161, 2, 76, 0, 0, 1, 1),
(162, 2, 63, 1, 1, 1, 1),
(163, 2, 64, 1, 1, 1, 1),
(164, 2, 65, 1, 1, 1, 1),
(165, 2, 66, 0, 0, 1, 0),
(166, 2, 67, 1, 1, 1, 1),
(167, 2, 68, 1, 1, 1, 1),
(168, 2, 81, 0, 0, 0, 0),
(169, 2, 82, 1, 0, 1, 0),
(170, 2, 83, 1, 1, 1, 1),
(171, 2, 84, 1, 1, 1, 1),
(172, 2, 85, 1, 1, 1, 1),
(173, 2, 86, 0, 0, 0, 0),
(174, 2, 87, 0, 0, 0, 0),
(175, 7, 1, 0, 0, 0, 0),
(176, 7, 2, 0, 0, 0, 0),
(177, 7, 3, 0, 0, 0, 0),
(178, 7, 4, 0, 0, 0, 0),
(179, 7, 5, 0, 0, 0, 0),
(180, 7, 30, 0, 0, 0, 0),
(181, 7, 7, 0, 0, 0, 0),
(182, 7, 8, 0, 0, 0, 0),
(183, 7, 6, 0, 0, 0, 0),
(184, 7, 9, 0, 0, 0, 0),
(185, 7, 10, 0, 0, 0, 0),
(186, 7, 11, 0, 0, 0, 0),
(187, 7, 12, 0, 0, 0, 0),
(188, 7, 13, 0, 0, 0, 0),
(189, 7, 14, 0, 0, 0, 0),
(190, 7, 15, 0, 0, 0, 0),
(191, 7, 16, 0, 0, 0, 0),
(192, 7, 17, 0, 0, 0, 0),
(194, 7, 19, 0, 0, 0, 0),
(195, 7, 20, 0, 0, 0, 0),
(196, 7, 21, 0, 0, 0, 0),
(197, 7, 22, 0, 0, 0, 0),
(198, 7, 23, 0, 0, 0, 0),
(199, 7, 24, 0, 0, 0, 0),
(200, 7, 25, 0, 0, 0, 0),
(201, 7, 26, 0, 0, 1, 0),
(202, 7, 27, 0, 0, 0, 0),
(203, 7, 28, 0, 0, 0, 0),
(204, 7, 29, 0, 0, 1, 0),
(205, 7, 32, 0, 0, 0, 0),
(206, 7, 31, 0, 0, 0, 0),
(207, 7, 33, 0, 0, 0, 0),
(208, 7, 34, 0, 0, 0, 0),
(209, 7, 35, 0, 0, 0, 0),
(210, 7, 36, 0, 0, 0, 0),
(211, 7, 37, 0, 0, 0, 0),
(212, 7, 38, 0, 0, 0, 0),
(213, 7, 39, 0, 0, 0, 0),
(214, 7, 77, 0, 0, 0, 0),
(215, 7, 78, 0, 0, 0, 0),
(216, 7, 79, 0, 0, 0, 0),
(217, 7, 40, 0, 0, 0, 0),
(218, 7, 41, 0, 0, 0, 0),
(219, 7, 42, 0, 0, 0, 0),
(220, 7, 43, 0, 0, 0, 0),
(221, 7, 44, 0, 0, 0, 0),
(222, 7, 45, 0, 0, 0, 0),
(223, 7, 46, 0, 0, 0, 0),
(224, 7, 47, 0, 0, 0, 0),
(225, 7, 48, 0, 0, 0, 0),
(226, 7, 49, 0, 0, 0, 0),
(227, 7, 50, 0, 0, 0, 0),
(228, 7, 51, 0, 0, 0, 0),
(229, 7, 52, 0, 0, 0, 0),
(230, 7, 53, 0, 0, 0, 0),
(231, 7, 54, 0, 0, 0, 0),
(232, 7, 55, 0, 0, 0, 0),
(233, 7, 56, 0, 0, 0, 0),
(234, 7, 57, 0, 0, 0, 0),
(235, 7, 58, 0, 0, 0, 0),
(236, 7, 59, 0, 0, 0, 0),
(237, 7, 60, 0, 0, 0, 0),
(238, 7, 61, 0, 0, 0, 0),
(239, 7, 62, 0, 0, 0, 0),
(240, 7, 80, 0, 0, 0, 0),
(241, 7, 69, 0, 0, 0, 0),
(242, 7, 70, 0, 0, 0, 0),
(243, 7, 71, 0, 0, 0, 0),
(244, 7, 72, 0, 0, 0, 0),
(245, 7, 73, 0, 0, 0, 0),
(246, 7, 74, 0, 0, 0, 0),
(247, 7, 75, 0, 0, 0, 0),
(248, 7, 76, 0, 0, 0, 0),
(249, 7, 63, 0, 0, 0, 0),
(250, 7, 64, 0, 0, 0, 0),
(251, 7, 65, 0, 0, 0, 0),
(252, 7, 66, 0, 0, 0, 0),
(253, 7, 67, 0, 0, 0, 0),
(254, 7, 68, 0, 0, 0, 0),
(255, 7, 81, 0, 0, 0, 0),
(256, 7, 82, 0, 0, 0, 0),
(257, 7, 83, 0, 0, 0, 0),
(258, 7, 84, 0, 0, 0, 0),
(259, 7, 85, 0, 0, 0, 0),
(260, 7, 86, 0, 0, 0, 0),
(261, 7, 87, 0, 0, 0, 0),
(262, 88, 88, 1, 1, 1, 1),
(263, 88, 88, 1, 1, 1, 1),
(264, 89, 89, 1, 1, 1, 1),
(265, 90, 90, 1, 1, 1, 1),
(266, 2, 88, 1, 0, 1, 0),
(267, 2, 89, 0, 0, 1, 0),
(268, 90, 90, 1, 1, 1, 1),
(269, 2, 90, 0, 0, 1, 0),
(270, 91, 91, 1, 1, 1, 1),
(271, 92, 92, 1, 1, 1, 1),
(272, 2, 91, 0, 0, 1, 0),
(273, 2, 92, 0, 0, 1, 0),
(274, 93, 93, 1, 1, 1, 1),
(275, 94, 94, 1, 1, 1, 1),
(276, 95, 95, 1, 1, 1, 1),
(277, 96, 96, 1, 1, 1, 1),
(278, 2, 93, 0, 0, 1, 0),
(279, 2, 94, 0, 0, 1, 0),
(280, 2, 95, 0, 0, 1, 0),
(281, 2, 96, 0, 0, 1, 0),
(282, 97, 97, 1, 1, 1, 1),
(283, 98, 98, 1, 1, 1, 1),
(284, 2, 97, 0, 0, 1, 0),
(285, 2, 98, 0, 0, 1, 0),
(286, 99, 99, 1, 1, 1, 1),
(287, 100, 100, 1, 1, 1, 1),
(288, 101, 101, 1, 1, 1, 1),
(289, 102, 102, 1, 1, 1, 1),
(290, 2, 99, 0, 0, 1, 0),
(291, 2, 100, 0, 0, 1, 0),
(292, 2, 101, 0, 0, 1, 0),
(293, 2, 102, 0, 0, 1, 0),
(294, 103, 103, 1, 1, 1, 1),
(295, 2, 103, 0, 1, 1, 0),
(296, 3, 91, 0, 0, 0, 0),
(297, 3, 92, 0, 0, 0, 0),
(298, 3, 93, 0, 0, 1, 0),
(299, 3, 94, 0, 0, 1, 0),
(300, 3, 95, 0, 0, 1, 0),
(301, 3, 96, 0, 0, 1, 0),
(302, 3, 97, 0, 0, 1, 0),
(303, 3, 98, 0, 0, 1, 0),
(304, 3, 99, 0, 0, 0, 0),
(305, 3, 100, 0, 0, 0, 0),
(306, 3, 101, 0, 0, 0, 0),
(307, 3, 102, 0, 0, 0, 0),
(308, 3, 88, 0, 0, 0, 0),
(309, 3, 89, 0, 0, 0, 0),
(310, 3, 90, 0, 0, 0, 0),
(311, 3, 103, 0, 0, 0, 0),
(312, 4, 91, 0, 0, 1, 0),
(313, 4, 92, 0, 0, 1, 0),
(314, 4, 93, 0, 0, 0, 0),
(315, 4, 94, 0, 0, 0, 0),
(316, 4, 95, 0, 0, 0, 0),
(317, 4, 96, 0, 0, 0, 0),
(318, 4, 97, 0, 0, 0, 0),
(319, 4, 98, 0, 0, 0, 0),
(320, 4, 99, 0, 0, 0, 0),
(321, 4, 100, 0, 0, 0, 0),
(322, 4, 101, 0, 0, 0, 0),
(323, 4, 102, 0, 0, 0, 0),
(324, 4, 1, 0, 0, 0, 0),
(325, 4, 2, 0, 0, 0, 0),
(326, 4, 3, 0, 0, 0, 0),
(327, 4, 4, 0, 0, 0, 0),
(328, 4, 5, 0, 0, 0, 0),
(329, 4, 30, 0, 0, 0, 0),
(330, 4, 7, 0, 0, 0, 0),
(331, 4, 8, 0, 0, 0, 0),
(332, 4, 6, 0, 0, 0, 0),
(333, 4, 9, 0, 0, 0, 0),
(334, 4, 10, 0, 0, 0, 0),
(335, 4, 11, 0, 0, 0, 0),
(336, 4, 12, 1, 1, 1, 1),
(337, 4, 13, 1, 0, 1, 0),
(338, 4, 14, 1, 0, 1, 0),
(339, 4, 15, 0, 0, 1, 0),
(340, 4, 16, 1, 1, 1, 1),
(341, 4, 17, 1, 1, 1, 1),
(343, 4, 19, 1, 1, 1, 1),
(344, 4, 20, 1, 1, 1, 1),
(345, 4, 21, 1, 1, 1, 1),
(346, 4, 22, 1, 1, 1, 1),
(347, 4, 23, 0, 0, 0, 0),
(348, 4, 24, 0, 0, 0, 0),
(349, 4, 25, 0, 0, 0, 0),
(350, 4, 26, 0, 0, 0, 0),
(351, 4, 27, 0, 0, 0, 0),
(352, 4, 28, 0, 0, 0, 0),
(353, 4, 29, 0, 0, 0, 0),
(354, 4, 32, 0, 0, 0, 0),
(355, 4, 88, 0, 0, 0, 0),
(356, 4, 89, 0, 0, 0, 0),
(357, 4, 31, 0, 0, 0, 0),
(358, 4, 33, 0, 0, 0, 0),
(359, 4, 34, 0, 0, 0, 0),
(360, 4, 35, 0, 0, 0, 0),
(361, 4, 36, 0, 0, 0, 0),
(362, 4, 37, 0, 0, 0, 0),
(363, 4, 38, 0, 0, 0, 0),
(364, 4, 39, 0, 0, 0, 0),
(365, 4, 77, 0, 0, 0, 0),
(366, 4, 78, 0, 0, 0, 0),
(367, 4, 79, 0, 0, 0, 0),
(368, 4, 40, 0, 0, 0, 0),
(369, 4, 41, 0, 0, 0, 0),
(370, 4, 42, 0, 0, 0, 0),
(371, 4, 43, 0, 0, 0, 0),
(372, 4, 44, 0, 0, 0, 0),
(373, 4, 45, 0, 0, 0, 0),
(374, 4, 46, 0, 0, 0, 0),
(375, 4, 47, 0, 0, 0, 0),
(376, 4, 48, 0, 0, 0, 0),
(377, 4, 49, 0, 0, 0, 0),
(378, 4, 50, 0, 0, 0, 0),
(379, 4, 51, 0, 0, 0, 0),
(380, 4, 52, 0, 0, 0, 0),
(381, 4, 53, 0, 0, 0, 0),
(382, 4, 54, 0, 0, 0, 0),
(383, 4, 55, 0, 0, 1, 0),
(384, 4, 56, 0, 0, 0, 0),
(385, 4, 57, 0, 0, 0, 0),
(386, 4, 58, 1, 0, 1, 0),
(387, 4, 59, 0, 0, 0, 0),
(388, 4, 60, 0, 0, 0, 0),
(389, 4, 61, 0, 0, 0, 0),
(390, 4, 62, 0, 0, 0, 0),
(391, 4, 80, 0, 0, 0, 0),
(392, 4, 69, 1, 1, 1, 1),
(393, 4, 70, 1, 1, 1, 1),
(394, 4, 71, 1, 1, 1, 1),
(395, 4, 72, 1, 1, 1, 1),
(396, 4, 73, 1, 0, 0, 0),
(397, 4, 74, 1, 1, 1, 1),
(398, 4, 75, 0, 0, 1, 0),
(399, 4, 76, 0, 0, 1, 0),
(400, 4, 63, 1, 1, 1, 1),
(401, 4, 64, 1, 1, 1, 1),
(402, 4, 65, 1, 1, 1, 1),
(403, 4, 66, 0, 0, 1, 0),
(404, 4, 67, 1, 1, 1, 1),
(405, 4, 68, 1, 1, 1, 1),
(406, 4, 81, 0, 0, 0, 0),
(407, 4, 82, 0, 0, 0, 0),
(408, 4, 83, 0, 0, 0, 0),
(409, 4, 84, 0, 0, 0, 0),
(410, 4, 85, 0, 0, 0, 0),
(411, 4, 86, 0, 0, 0, 0),
(412, 4, 87, 0, 0, 0, 0),
(413, 4, 90, 0, 0, 0, 0),
(414, 4, 103, 0, 0, 0, 0),
(415, 5, 91, 0, 0, 0, 0),
(416, 5, 92, 0, 0, 0, 0),
(417, 5, 93, 0, 0, 1, 0),
(418, 5, 94, 0, 0, 1, 0),
(419, 5, 95, 0, 0, 0, 0),
(420, 5, 96, 0, 0, 0, 0),
(421, 5, 97, 0, 0, 0, 0),
(422, 5, 98, 0, 0, 0, 0),
(423, 5, 99, 0, 0, 0, 0),
(424, 5, 100, 0, 0, 0, 0),
(425, 5, 101, 0, 0, 0, 0),
(426, 5, 102, 0, 0, 0, 0),
(427, 5, 1, 0, 0, 1, 0),
(428, 5, 2, 0, 0, 0, 0),
(429, 5, 3, 0, 0, 0, 0),
(430, 5, 4, 0, 0, 0, 0),
(431, 5, 5, 0, 0, 0, 0),
(432, 5, 30, 0, 0, 0, 0),
(433, 5, 7, 0, 0, 0, 0),
(434, 5, 8, 0, 0, 0, 0),
(435, 5, 6, 0, 0, 1, 0),
(436, 5, 9, 0, 0, 0, 0),
(437, 5, 10, 0, 0, 0, 0),
(438, 5, 11, 0, 0, 0, 0),
(439, 5, 12, 0, 0, 0, 0),
(440, 5, 13, 0, 0, 0, 0),
(441, 5, 14, 0, 0, 0, 0),
(442, 5, 15, 0, 0, 0, 0),
(443, 5, 16, 0, 0, 0, 0),
(444, 5, 17, 0, 0, 0, 0),
(446, 5, 19, 0, 0, 0, 0),
(447, 5, 20, 1, 1, 1, 1),
(448, 5, 21, 0, 0, 0, 0),
(449, 5, 22, 0, 0, 0, 0),
(450, 5, 23, 0, 0, 0, 0),
(451, 5, 24, 0, 0, 0, 0),
(452, 5, 25, 0, 0, 0, 0),
(453, 5, 26, 0, 0, 0, 0),
(454, 5, 27, 0, 0, 0, 0),
(455, 5, 28, 0, 0, 0, 0),
(456, 5, 29, 0, 0, 0, 0),
(457, 5, 32, 0, 0, 0, 0),
(458, 5, 88, 0, 0, 0, 0),
(459, 5, 89, 0, 0, 0, 0),
(460, 5, 31, 0, 0, 0, 0),
(461, 5, 33, 0, 0, 0, 0),
(462, 5, 34, 0, 0, 0, 0),
(463, 5, 35, 0, 0, 0, 0),
(464, 5, 36, 0, 0, 0, 0),
(465, 5, 37, 0, 0, 0, 0),
(466, 5, 38, 0, 0, 0, 0),
(467, 5, 39, 0, 0, 0, 0),
(468, 5, 77, 0, 0, 0, 0),
(469, 5, 78, 0, 0, 0, 0),
(470, 5, 79, 0, 0, 0, 0),
(471, 5, 40, 0, 0, 0, 0),
(472, 5, 41, 0, 0, 0, 0),
(473, 5, 42, 0, 0, 0, 0),
(474, 5, 43, 0, 0, 0, 0),
(475, 5, 44, 0, 0, 0, 0),
(476, 5, 45, 0, 0, 0, 0),
(477, 5, 46, 0, 0, 0, 0),
(478, 5, 47, 0, 0, 0, 0),
(479, 5, 48, 0, 0, 0, 0),
(480, 5, 49, 0, 0, 0, 0),
(481, 5, 50, 0, 0, 0, 0),
(482, 5, 51, 0, 0, 0, 0),
(483, 5, 52, 0, 0, 0, 0),
(484, 5, 53, 0, 0, 0, 0),
(485, 5, 54, 0, 0, 0, 0),
(486, 5, 55, 1, 1, 1, 1),
(487, 5, 56, 1, 1, 1, 1),
(488, 5, 57, 1, 0, 1, 1),
(489, 5, 58, 1, 0, 1, 1),
(490, 5, 59, 0, 0, 0, 0),
(491, 5, 60, 0, 0, 0, 0),
(492, 5, 61, 0, 0, 0, 0),
(493, 5, 62, 0, 0, 0, 0),
(494, 5, 80, 0, 0, 0, 0),
(495, 5, 69, 0, 0, 0, 0),
(496, 5, 70, 0, 0, 0, 0),
(497, 5, 71, 0, 0, 0, 0),
(498, 5, 72, 0, 0, 0, 0),
(499, 5, 73, 0, 0, 0, 0),
(500, 5, 74, 0, 0, 0, 0),
(501, 5, 75, 0, 0, 0, 0),
(502, 5, 76, 0, 0, 0, 0),
(503, 5, 63, 0, 0, 0, 0),
(504, 5, 64, 0, 0, 0, 0),
(505, 5, 65, 0, 0, 0, 0),
(506, 5, 66, 0, 0, 0, 0),
(507, 5, 67, 0, 0, 0, 0),
(508, 5, 68, 0, 0, 0, 0),
(509, 5, 81, 0, 0, 0, 0),
(510, 5, 82, 0, 0, 0, 0),
(511, 5, 83, 0, 0, 0, 0),
(512, 5, 84, 0, 0, 0, 0),
(513, 5, 85, 0, 0, 0, 0),
(514, 5, 86, 0, 0, 0, 0),
(515, 5, 87, 0, 0, 0, 0),
(516, 5, 90, 0, 0, 0, 0),
(517, 5, 103, 0, 0, 0, 0),
(518, 104, 104, 1, 1, 1, 1),
(519, 2, 104, 0, 0, 1, 0),
(520, 4, 104, 0, 0, 1, 0),
(521, 2, 18, 0, 0, 0, 0),
(522, 2, 105, 0, 1, 1, 0),
(523, 2, 106, 1, 1, 1, 1),
(524, 2, 107, 0, 0, 0, 0),
(525, 2, 109, 1, 1, 1, 1),
(526, 2, 108, 0, 1, 1, 0),
(527, 3, 18, 0, 0, 0, 0),
(528, 3, 107, 0, 0, 0, 0),
(529, 3, 109, 1, 1, 1, 1),
(530, 3, 104, 0, 0, 0, 0),
(531, 3, 105, 0, 0, 0, 0),
(532, 3, 106, 0, 0, 0, 0),
(533, 3, 108, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `register_no` varchar(100) NOT NULL,
  `admission_date` varchar(100) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `birthday` varchar(100) DEFAULT NULL,
  `religion` varchar(100) NOT NULL,
  `caste` varchar(100) NOT NULL,
  `blood_group` varchar(100) NOT NULL,
  `mother_tongue` varchar(100) DEFAULT NULL,
  `current_address` text,
  `permanent_address` text,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `mobileno` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL DEFAULT '0',
  `vehicle_id` int(11) NOT NULL DEFAULT '0',
  `hostel_id` int(11) NOT NULL DEFAULT '0',
  `room_id` int(11) NOT NULL DEFAULT '0',
  `previous_details` text NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `student_attendance`
--

CREATE TABLE `student_attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(4) DEFAULT NULL COMMENT 'P=Present, A=Absent, H=Holiday, L=Late',
  `remark` text,
  `branch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `student_category`
--

CREATE TABLE `student_category` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `student_documents`
--

CREATE TABLE `student_documents` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `remarks` text NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `enc_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject_code` varchar(200) NOT NULL,
  `subject_type` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `subject_author` varchar(255) NOT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `subject_assign`
--

CREATE TABLE `subject_assign` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` longtext NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `teacher_allocation`
--

CREATE TABLE `teacher_allocation` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `teacher_note`
--

CREATE TABLE `teacher_note` (
  `id` int(11) NOT NULL,
  `title` longtext NOT NULL,
  `description` longtext NOT NULL,
  `file_name` longtext NOT NULL,
  `enc_name` longtext NOT NULL,
  `type_id` int(11) NOT NULL,
  `class_id` longtext NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `theme_settings`
--

CREATE TABLE `theme_settings` (
  `id` int(11) NOT NULL,
  `border_mode` varchar(200) NOT NULL,
  `dark_skin` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `theme_settings`
--

INSERT INTO `theme_settings` (`id`, `border_mode`, `dark_skin`, `created_at`, `updated_at`) VALUES
(1, 'true', 'false', '2018-10-23 22:59:38', '2020-05-02 14:18:35');

-- --------------------------------------------------------

--
-- Структура таблицы `timetable_class`
--

CREATE TABLE `timetable_class` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `break` varchar(11) DEFAULT 'false',
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_room` varchar(100) DEFAULT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `day` varchar(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `timetable_exam`
--

CREATE TABLE `timetable_exam` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `time_start` varchar(20) NOT NULL,
  `time_end` varchar(20) NOT NULL,
  `mark_distribution` text NOT NULL,
  `hall_id` int(11) NOT NULL,
  `exam_date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `account_id` varchar(20) NOT NULL,
  `voucher_head_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `dr` decimal(18,2) NOT NULL DEFAULT '0.00',
  `cr` decimal(18,2) NOT NULL DEFAULT '0.00',
  `bal` decimal(18,2) NOT NULL DEFAULT '0.00',
  `date` date NOT NULL,
  `pay_via` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `attachments` varchar(255) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `system` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `transactions_links`
--

CREATE TABLE `transactions_links` (
  `id` int(11) NOT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `deposit` tinyint(3) DEFAULT NULL,
  `expense` tinyint(3) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `transport_assign`
--

CREATE TABLE `transport_assign` (
  `id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `stoppage_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `transport_route`
--

CREATE TABLE `transport_route` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `start_place` longtext NOT NULL,
  `remarks` longtext NOT NULL,
  `stop_place` longtext NOT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `transport_stoppage`
--

CREATE TABLE `transport_stoppage` (
  `id` int(11) NOT NULL,
  `stop_position` varchar(255) NOT NULL,
  `stop_time` time NOT NULL,
  `route_fare` decimal(18,2) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `transport_vehicle`
--

CREATE TABLE `transport_vehicle` (
  `id` int(11) NOT NULL,
  `vehicle_no` longtext NOT NULL,
  `capacity` longtext NOT NULL,
  `insurance_renewal` longtext NOT NULL,
  `driver_name` longtext NOT NULL,
  `driver_phone` longtext NOT NULL,
  `driver_license` longtext NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `voucher_head`
--

CREATE TABLE `voucher_head` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `system` tinyint(1) DEFAULT '0',
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `advance_salary`
--
ALTER TABLE `advance_salary`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `attachments_type`
--
ALTER TABLE `attachments_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `award`
--
ALTER TABLE `award`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `book_issues`
--
ALTER TABLE `book_issues`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bulk_msg_category`
--
ALTER TABLE `bulk_msg_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bulk_sms_email`
--
ALTER TABLE `bulk_sms_email`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `custom_field`
--
ALTER TABLE `custom_field`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `custom_fields_values`
--
ALTER TABLE `custom_fields_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relid` (`relid`),
  ADD KEY `fieldid` (`field_id`);

--
-- Индексы таблицы `email_config`
--
ALTER TABLE `email_config`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `email_templates_details`
--
ALTER TABLE `email_templates_details`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `event_types`
--
ALTER TABLE `event_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `exam_attendance`
--
ALTER TABLE `exam_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `exam_hall`
--
ALTER TABLE `exam_hall`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `exam_mark_distribution`
--
ALTER TABLE `exam_mark_distribution`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `exam_term`
--
ALTER TABLE `exam_term`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `fees_reminder`
--
ALTER TABLE `fees_reminder`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `fees_type`
--
ALTER TABLE `fees_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `fee_allocation`
--
ALTER TABLE `fee_allocation`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `fee_fine`
--
ALTER TABLE `fee_fine`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `fee_groups`
--
ALTER TABLE `fee_groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `fee_groups_details`
--
ALTER TABLE `fee_groups_details`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `fee_payment_history`
--
ALTER TABLE `fee_payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `global_settings`
--
ALTER TABLE `global_settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `hall_allocation`
--
ALTER TABLE `hall_allocation`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `homework_evaluation`
--
ALTER TABLE `homework_evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `hostel`
--
ALTER TABLE `hostel`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `hostel_category`
--
ALTER TABLE `hostel_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `hostel_room`
--
ALTER TABLE `hostel_room`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `language_list`
--
ALTER TABLE `language_list`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `leave_application`
--
ALTER TABLE `leave_application`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `leave_category`
--
ALTER TABLE `leave_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `live_class`
--
ALTER TABLE `live_class`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `live_class_config`
--
ALTER TABLE `live_class_config`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `login_credential`
--
ALTER TABLE `login_credential`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mark`
--
ALTER TABLE `mark`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message_reply`
--
ALTER TABLE `message_reply`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `payment_config`
--
ALTER TABLE `payment_config`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `payment_salary_stipend`
--
ALTER TABLE `payment_salary_stipend`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `payslip`
--
ALTER TABLE `payslip`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `payslip_details`
--
ALTER TABLE `payslip_details`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `permission_modules`
--
ALTER TABLE `permission_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `rm_sessions`
--
ALTER TABLE `rm_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `salary_template`
--
ALTER TABLE `salary_template`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `salary_template_details`
--
ALTER TABLE `salary_template_details`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `schoolyear`
--
ALTER TABLE `schoolyear`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sections_allocation`
--
ALTER TABLE `sections_allocation`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sms_api`
--
ALTER TABLE `sms_api`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sms_credential`
--
ALTER TABLE `sms_credential`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sms_template`
--
ALTER TABLE `sms_template`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sms_template_details`
--
ALTER TABLE `sms_template_details`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `staff_attendance`
--
ALTER TABLE `staff_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `staff_bank_account`
--
ALTER TABLE `staff_bank_account`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `staff_department`
--
ALTER TABLE `staff_department`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `staff_designation`
--
ALTER TABLE `staff_designation`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `staff_documents`
--
ALTER TABLE `staff_documents`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `staff_privileges`
--
ALTER TABLE `staff_privileges`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `student_category`
--
ALTER TABLE `student_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `student_documents`
--
ALTER TABLE `student_documents`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subject_assign`
--
ALTER TABLE `subject_assign`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `teacher_allocation`
--
ALTER TABLE `teacher_allocation`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `teacher_note`
--
ALTER TABLE `teacher_note`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `theme_settings`
--
ALTER TABLE `theme_settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `timetable_class`
--
ALTER TABLE `timetable_class`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `timetable_exam`
--
ALTER TABLE `timetable_exam`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `transactions_links`
--
ALTER TABLE `transactions_links`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `transport_assign`
--
ALTER TABLE `transport_assign`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `transport_route`
--
ALTER TABLE `transport_route`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `transport_stoppage`
--
ALTER TABLE `transport_stoppage`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `transport_vehicle`
--
ALTER TABLE `transport_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `voucher_head`
--
ALTER TABLE `voucher_head`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `advance_salary`
--
ALTER TABLE `advance_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `attachments_type`
--
ALTER TABLE `attachments_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `award`
--
ALTER TABLE `award`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `book_category`
--
ALTER TABLE `book_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `book_issues`
--
ALTER TABLE `book_issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bulk_msg_category`
--
ALTER TABLE `bulk_msg_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bulk_sms_email`
--
ALTER TABLE `bulk_sms_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `custom_field`
--
ALTER TABLE `custom_field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `custom_fields_values`
--
ALTER TABLE `custom_fields_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `email_config`
--
ALTER TABLE `email_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `email_templates_details`
--
ALTER TABLE `email_templates_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `enroll`
--
ALTER TABLE `enroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `event_types`
--
ALTER TABLE `event_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `exam_attendance`
--
ALTER TABLE `exam_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `exam_hall`
--
ALTER TABLE `exam_hall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `exam_mark_distribution`
--
ALTER TABLE `exam_mark_distribution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `exam_term`
--
ALTER TABLE `exam_term`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `fees_reminder`
--
ALTER TABLE `fees_reminder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `fees_type`
--
ALTER TABLE `fees_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `fee_allocation`
--
ALTER TABLE `fee_allocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `fee_fine`
--
ALTER TABLE `fee_fine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `fee_groups`
--
ALTER TABLE `fee_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `fee_groups_details`
--
ALTER TABLE `fee_groups_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `fee_payment_history`
--
ALTER TABLE `fee_payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `global_settings`
--
ALTER TABLE `global_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `hall_allocation`
--
ALTER TABLE `hall_allocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `homework_evaluation`
--
ALTER TABLE `homework_evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `hostel`
--
ALTER TABLE `hostel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `hostel_category`
--
ALTER TABLE `hostel_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `hostel_room`
--
ALTER TABLE `hostel_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=981;

--
-- AUTO_INCREMENT для таблицы `language_list`
--
ALTER TABLE `language_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `leave_application`
--
ALTER TABLE `leave_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `leave_category`
--
ALTER TABLE `leave_category`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `live_class`
--
ALTER TABLE `live_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `live_class_config`
--
ALTER TABLE `live_class_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `login_credential`
--
ALTER TABLE `login_credential`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `mark`
--
ALTER TABLE `mark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `message_reply`
--
ALTER TABLE `message_reply`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `parent`
--
ALTER TABLE `parent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `payment_config`
--
ALTER TABLE `payment_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `payment_salary_stipend`
--
ALTER TABLE `payment_salary_stipend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `payslip`
--
ALTER TABLE `payslip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `payslip_details`
--
ALTER TABLE `payslip_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT для таблицы `permission_modules`
--
ALTER TABLE `permission_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `salary_template`
--
ALTER TABLE `salary_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `salary_template_details`
--
ALTER TABLE `salary_template_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `schoolyear`
--
ALTER TABLE `schoolyear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sections_allocation`
--
ALTER TABLE `sections_allocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sms_api`
--
ALTER TABLE `sms_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `sms_credential`
--
ALTER TABLE `sms_credential`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sms_template`
--
ALTER TABLE `sms_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `sms_template_details`
--
ALTER TABLE `sms_template_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `staff_attendance`
--
ALTER TABLE `staff_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `staff_bank_account`
--
ALTER TABLE `staff_bank_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `staff_department`
--
ALTER TABLE `staff_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `staff_designation`
--
ALTER TABLE `staff_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `staff_documents`
--
ALTER TABLE `staff_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `staff_privileges`
--
ALTER TABLE `staff_privileges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=534;

--
-- AUTO_INCREMENT для таблицы `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `student_category`
--
ALTER TABLE `student_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `student_documents`
--
ALTER TABLE `student_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `subject_assign`
--
ALTER TABLE `subject_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `teacher_allocation`
--
ALTER TABLE `teacher_allocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `teacher_note`
--
ALTER TABLE `teacher_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `theme_settings`
--
ALTER TABLE `theme_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `timetable_class`
--
ALTER TABLE `timetable_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `timetable_exam`
--
ALTER TABLE `timetable_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `transactions_links`
--
ALTER TABLE `transactions_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `transport_assign`
--
ALTER TABLE `transport_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `transport_route`
--
ALTER TABLE `transport_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `transport_stoppage`
--
ALTER TABLE `transport_stoppage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `transport_vehicle`
--
ALTER TABLE `transport_vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `voucher_head`
--
ALTER TABLE `voucher_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
