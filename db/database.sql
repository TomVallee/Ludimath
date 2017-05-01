create database if not exists ludimath character set utf8 collate utf8_unicode_ci;
use ludimath;

grant all privileges on ludimath.* to 'ludimath_user'@'localhost' identified by 'passwd';
