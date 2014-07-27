
-- ----------------------------
-- Create database bookmark
-- ----------------------------
create database bookmark CHARACTER SET 'utf8';

-- ----------------------------
-- Table structure for `bookmark`
-- ----------------------------
-- DROP TABLE IF EXISTS bookmark;
CREATE TABLE bookmark (
    bookmark_id BIGINT AUTO_INCREMENT,
    user_id BIGINT NOT NULL,
    title VARCHAR(255) NOT NULL,
    url VARCHAR(100) NOT NULL,
    summary TEXT,
    classify VARCHAR(100),
    tag VARCHAR(100),
    is_public TINYINT(1) DEFAULT 1,
    create_time DATETIME NOT NULL,
    modify_time DATETIME NOT NULL,
    primary key (bookmark_id)
) DEFAULT CHARSET=utf8;
alter table bookmark AUTO_INCREMENT=1025;

insert into bookmark (user_id,title,url,summary,classify,tag,is_public) values ('123456','知乎','http://www.zhihu.com/',
'一个社会化的知识分享网站','收藏备忘','知乎，quora','1');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
CREATE TABLE user(
	user_id BIGINT AUTO_INCREMENT,
	nick VARCHAR(50) NOT NULL,
	password VARCHAR(255) NOT NULL,
	email VARCHAR(100),
	privilege TINYINT(5) DEFAULT 0,
	type TINYINT(5) DEFAULT 0,
	create_time DATETIME NOT NULL,
    modify_time DATETIME NOT NULL,
    primary key (user_id)
) DEFAULT CHARSET=utf8;
ALTER  TABLE user ADD UNIQUE (`email`);
alter table user AUTO_INCREMENT=2045;

insert into user (nick,password,email,create_time,modify_time) values('小球','123456','linqiu@gmail.com',now(),now());

-- ----------------------------
-- Table structure for `tag`
-- ----------------------------
CREATE TABLE tag(
	tag_id BIGINT AUTO_INCREMENT, 
	tag_name VARCHAR(50) NOT NULL,
	user_id BIGINT NOT NULL,
	create_time DATETIME NOT NULL,
	modify_time DATETIME NOT NULL,
	primary key (tag_id)
) DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `bookmark_tag`
-- ----------------------------
CREATE TABLE bookmark_tag(
	id BIGINT AUTO_INCREMENT, 
	bookmark_id BIGINT NOT NULL,
	tag_id BIGINT NOT NULL,
	create_time DATETIME NOT NULL,
	modify_time DATETIME NOT NULL,
	primary key (id)
) DEFAULT CHARSET=utf8;


