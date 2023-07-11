# PHP REST API CRUD 예제
## 1. 공통사항
### 1.1. Database
#### 1.1.1. dbcon.php 수정
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

### 1.3. Structure
#### 1.3.1. inc 폴더
- dbcon.php에서는 Database인 MySQL에 대한 접속 정보와 객체를 생성하는 코드 작성

#### 1.3.2. customers 폴더
- customers 테이블에 대한 처리는 customers라는 폴더 내에서 파일 생성
- function.php에서 데이터베이스에 대한 쿼리를 처리하는 함수를 작성하고 그 결과에 따른 HTTP Status Code를 분기하도록 작성.
- Create, Read, Update, Delete에 대해서 각각 파일로 분기하여 작성


## 2. Create
- HTTP Method: POST
- Path: /customers/create.php
- Body
  ```javascript
  {
      "name": "성춘향",
      "email": "email@email.com",
      "phone": "01012341234"
  }
  ```


## 3. Read
- HTTP Method: GET
- Path: /customers/read.php
- Query Params
  - id : (Optional) customers 테이블의 PK인 id를 활용하여 1개의 데이터 조회


## 4. Update
- HTTP Method: PUT
- Path: /customers/update.php
- Query Params
  - id : (Required) customers 테이블의 PK인 id를 활용하여 1개의 데이터 수정
- Body
  ```javascript
  {
      "name": "성춘향",
      "email": "email@email.com",
      "phone": "01012341234"
  }
  ```

## 5. Delete
- HTTP Method: DELETE
- Path: /customers/delete.php
- Query Params
  - id : (Required) customers 테이블의 PK인 id를 활용하여 1개의 데이터 삭제