-- 4. DataBase
CREATE DATABASE mini_multi_board;
USE mini_multi_board;

-- 	1) users(유저) Table
--			- pk, 이메일, 비밀번호, 이름, 가입일자, 수정일자, 탈퇴일자
CREATE TABLE users(
	u_id				BIGINT UNSIGNED			PRIMARY KEY		AUTO_INCREMENT
	,u_email			VARCHAR(100)				NOT NULL
	,u_password		VARCHAR(256) BINARY		NOT NULL			
	,u_name			VARCHAR(50)					NOT NULL
	,created_at		TIMESTAMP					NOT NULL 		DEFAULT CURRENT_TIMESTAMP()
	,updated_at		TIMESTAMP					NOT NULL 		DEFAULT CURRENT_TIMESTAMP()
	,deleted_at		TIMESTAMP
);

-- 	2) boards(게시판) Table
--  		- pk, 유저pk, 게시판타입, 제목, 내용, 이미지파일, 작성일자, 수정일자, 삭제일자
CREATE TABLE boards(
	b_id				BIGINT UNSIGNED			PRIMARY KEY		AUTO_INCREMENT
	,u_id				BIGINT UNSIGNED			NOT NULL
	,bc_type			CHAR(1)						NOT NULL
	,b_title			VARCHAR(50)					NOT NULL
	,b_content		VARCHAR(200)				NOT NULL
	,b_img			VARCHAR(100)				NOT NULL
	,created_at		TIMESTAMP					NOT NULL 		DEFAULT CURRENT_TIMESTAMP()
	,updated_at		TIMESTAMP					NOT NULL 		DEFAULT CURRENT_TIMESTAMP()
	,deleted_at		TIMESTAMP
);

-- 	3) boards_category(게시판 기본 정보) Table
-- 		- pk, 게시판타입, 게시판 이름
CREATE TABLE boards_category(
	bc_id				BIGINT UNSIGNED			PRIMARY KEY		AUTO_INCREMENT
	,bc_type			CHAR(1)						NOT NULL			UNIQUE
	,bc_name			VARCHAR(20)					NOT NULL
);

-- FK 추가
ALTER TABLE boards
ADD CONSTRAINT fk_boards_u_id
FOREIGN KEY(u_id)
REFERENCES users(u_id);

ALTER TABLE boards
ADD CONSTRAINT fk_boards_bc_type
FOREIGN KEY(bc_type)
REFERENCES boards_category(bc_type);