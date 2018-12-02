DB設計
Columm | Type | Modifiers

--------------------------
students
--------------------------
*id | integer | not null
name | varchar(32) | not null
email | varchar(255) | not null
sex | integer |
password | varchar(255) | notnull
faculty | varchar(32) |
grade | integer |

--------------------------
professors
--------------------------
*id | integer | not null
name | varchar(32) | not null
email | varchar(255) | not null
sex | integer |
password | varchar(255) | notnull

--------------------------
pids
--------------------------
*auto_id | serial
pid | integer | unique

--------------------------
classes
--------------------------
*auto_id | serial |
name | varchar(32) | not null
pname | varchar(32) | not null
content | text | not null

--------------------------
cards
--------------------------
*auto_id | serial
cid | integer | not null , 外部キー
title | varchar(32) | not null
pdate | timestamp | not null
ip | varchar(32) | not null

--------------------------
attends
--------------------------
*auto_id | serial
card_id | integer | not null , 外部キー
attend_date | timestamp | not null
ip | varchar(32) | not null
sid | integer | not null , 外部キー
comment | text |


