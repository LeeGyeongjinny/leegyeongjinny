CREATE DATABASE IF NOT EXISTS travels;

USE travels;

DROP TABLE IF EXISTS travel_boards;

CREATE TABLE travel_boards(
	id					BIGINT(20) 	UNSIGNED		PRIMARY KEY		AUTO_INCREMENT
	,country 		VARCHAR(50)					NOT NULL
	,city 			VARCHAR(50) 				NOT NULL
	,departure 		DATE	 						NOT NULL
	,arrival 		DATE							NOT NULL
	,companion 		VARCHAR(10)
	,title			VARCHAR(50)					NOT NULL
	,content 		VARCHAR(2000) 				NOT NULL
	,img_1			VARCHAR(600)
	,img_2			VARCHAR(600)
	,created_at	 	TIMESTAMP					NOT NULL 		DEFAULT	CURRENT_TIMESTAMP()
	,updated_at	 	TIMESTAMP					NOT NULL 		DEFAULT	CURRENT_TIMESTAMP()
	,deleted_at		TIMESTAMP
);	

DROP TABLE IF EXISTS bucket_lists;
CREATE TABLE bucket_lists(
	bkl_id				BIGINT(20) 	UNSIGNED		PRIMARY KEY		AUTO_INCREMENT
	,title				VARCHAR(50)					NOT NULL
	,bucket_content 	VARCHAR(1000) 				NOT NULL
	,country 			VARCHAR(50)					NOT NULL
	,sort 				VARCHAR(15)					NOT NULL
	,info_content 		VARCHAR(100)
	,info_img 			VARCHAR(600)
	,created_at	 		TIMESTAMP					NOT NULL 		DEFAULT	CURRENT_TIMESTAMP()
	,updated_at	 		TIMESTAMP					NOT NULL 		DEFAULT	CURRENT_TIMESTAMP()
	,deleted_at			TIMESTAMP
);

INSERT INTO travel_boards(
	country
	,city
	,departure
	,arrival
	,title
	,content	
)
VALUES
	('한국', '서울','2025-01-01', '2025-01-02', '서울 좋아', '서울 좋아용')
	,('미국', '뉴욕','2025-01-01', '2025-01-02', '뉴욕 좋아', '뉴욕 좋아용')
	,('영국', '런던','2025-01-01', '2025-01-02', '런던 좋아', '런던 좋아용')
	,('영국', '카디프','2025-01-01', '2025-01-02', '카디프 좋아', '카디프 좋아용')
	,('프랑스', '파리','2025-01-01', '2025-01-02', '파리 좋아', '파리 좋아용')
	,('벨기에', '브뤼쉘','2025-01-01', '2025-01-02', '브뤼셀 좋아', '브뤼셀 좋아용')
	,('체코', '프라하','2025-01-01', '2025-01-02', '프라하 좋아', '프라하 좋아용')
	,('이탈리아', '베네치아','2025-01-01', '2025-01-02', '베네치아 좋아', '베네치아 좋아용')
	,('이탈리아', '피렌체','2025-01-01', '2025-01-02', '피렌체 좋아', '피렌체 좋아용')
	,('이탈리아', '로마','2025-01-01', '2025-01-02', '로마 좋아', '로마 좋아용')
	,('이탈리아', '나폴리','2025-01-01', '2025-01-02', '나폴리 좋아', '나폴리 좋아용')
	,('대만', '타이베이','2025-01-01', '2025-01-02', '타이베이 좋아', '타이베이 좋아용')
	,('대만', '타이중','2025-01-01', '2025-01-02', '타이중 좋아', '타이중 좋아용')
	,('대만', '타이난','2025-01-01', '2025-01-02', '타이난 좋아', '타이난 좋아용')
	,('대만', '까오슝','2025-01-01', '2025-01-02', '까오슝 좋아', '까오슝 좋아용')
	,('중국', '상하이','2025-01-01', '2025-01-02', '상하이 좋아', '상하이 좋아용')
	,('태국', '방콕','2025-01-01', '2025-01-02', '방콕 좋아', '방콕 좋아용')
	,('일본', '도쿄','2025-01-01','2025-01-02', '도쿄 좋아', '도쿄 좋아용')
	,('일본', '오사카','2025-01-01','2025-01-02', '오사카 좋아', '오사카 좋아용')
	,('일본', '교토','2025-01-01','2025-01-02', '교토 좋아', '교토 좋아용')
	,('일본', '후쿠오카','2025-01-01','2025-01-02', '후쿠오카 좋아', '후쿠오카 좋아용')
	,('일본', '오키나와','2025-01-01','2025-01-02', '오키나와 좋아', '오키나와 좋아용')
	,('한국', '대구','2025-01-01','2025-01-02', '대구 좋아', '대구 좋아용')
	,('덴마크', '코펜하겐','2025-01-01', '2025-01-02', '코펜하겐 좋아', '코펜하겐 좋아용')
	,('베트남', '하노이','2025-01-01', '2025-01-02', '하노이 좋아', '하노이 좋아용')
	,('미국', 'LA','2025-01-01', '2025-01-02', 'LA 좋아', 'LA 좋아용')
	,('스페인', '바르셀로나','2025-01-01', '2025-01-02', '바르셀로나 좋아', '바르셀로나 좋아용')
;

INSERT INTO bucket_lists(
	title
	,bucket_content
	,country
	,sort
)
VALUES
	('올랜도 디즈니랜드', '올랜도 디즈니랜드 가고 싶다.', '미국', '관광')
	,('오로라보기', '아이슬란드 가서 오로라 보고 싶다.', '아이슬란드', '관광')
	,('에그타르트 먹기', '원조 에그타르트 먹고 싶다.', '포르투갈', '먹방')
;
INSERT INTO bucket_lists(
	title
	,bucket_content
	,country
	,sort
)
VALUES
	('콜드플레이콘서트', '콜드플레이ㅣㅣㅣㅣ간다ㅏㅏㅏㅏㅏㅏㅏ.', '한국', '체험')
	,('집가기', '배째', '한국', '기타')
	,('누워있기', '아무 것도 안하고 싶다.', '한국', '기타')
;

INSERT INTO bucket_lists(
	title
	,bucket_content
	,country
	,sort
)
VALUES
	('울랄라', '울랄라울라', '이런', '체험')
	,('안녕하슈', '배고파유', '오메', '기타')
;
