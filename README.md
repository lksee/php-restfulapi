# PHP REST API CRUD 예제
## 1. Database
### 1.1. dbcon.php 수정
> 자신의 MySQL의 접속 정보를 입력합니다.
- $host : 도메인명
- $user : 계정
- $password : 계정 비밀번호
- $db : 데이터베이스명

### 1.2. MySQL에 테이블 생성하기
```SQL
-- `customers` 테이블 생성하기
CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블의 덤프 데이터 `customers`
INSERT INTO `customers` (`name`, `email`, `phone`) 
VALUES ('이름', '이메일@email.com', '01012345678');
```