/*
permission scheme and example

Anonimous

Content:Sitemap: ClassID in (2), ObjectID in (1,3,17,45,46)
Search:Search: ClassID in (2), ObjectID in (1,3,17,45,46)

Admin

Class:*
Content:*
Search:*



editor

Class:List:*
Class:Edit:*
Content:Sitemap:*
Content:Delete:*
Content:Edit:*
Content:View:*
Search:*

'advanced editor'

Class:List:*
Class:Edit:*
Class:Delete:*
Content:*
Search:*



*/
drop SEQUENCE ezrole_s;
CREATE SEQUENCE ezrole_s;
drop table ezrole;
create table ezrole(
id int not null primary key DEFAULT nextval('ezrole_s'),
version int DEFAULT '0',
name varchar not null,
value char(1)
);
insert into ezrole(name, value) values('Anonimous', '');  
insert into ezrole(name, value) values('Admin', '*');
insert into ezrole(name, value) values('editor', '');
insert into ezrole(name, value) values('advanced editor','');
  

drop SEQUENCE ezuser_role_s;
CREATE SEQUENCE ezuser_role_s;
drop table ezuser_role;
create table ezuser_role(
id int not null primary key DEFAULT nextval('ezuser_role_s'),
role_id int,
contentobject_id int
);
insert into ezuser_role( role_id, contentobject_id ) values(1,49);
insert into ezuser_role( role_id, contentobject_id ) values(2,50);
insert into ezuser_role( role_id, contentobject_id ) values(3,51);
insert into ezuser_role( role_id, contentobject_id ) values(3,53);
insert into ezuser_role( role_id, contentobject_id ) values(4,53);
insert into ezuser_role( role_id, contentobject_id ) values(1,8);
insert into ezuser_role( role_id, contentobject_id ) values(1,4);
insert into ezuser_role( role_id, contentobject_id ) values(3,8);


drop SEQUENCE ezpolicy_s;
CREATE SEQUENCE ezpolicy_s;
drop table ezpolicy;
create table ezpolicy(
id int not null primary key DEFAULT nextval('ezpolicy_s'),
role_id int,
function_name varchar,
module_name varchar,
limitation char(1)
);
insert into ezpolicy(role_id,module_name,function_name,limitation) values(1, 'content', 'sitemap', '');
insert into ezpolicy(role_id,module_name,function_name,limitation) values(1, 'search' , 'search' , '');

insert into ezpolicy(role_id,module_name,function_name,limitation) values(2, '*'      , '*'      , '*' );
insert into ezpolicy(role_id,module_name,function_name,limitation) values(2, 'class'  ,  '*'     , '*');
insert into ezpolicy(role_id,module_name,function_name,limitation) values(2, 'content', '*'      , '*');
insert into ezpolicy(role_id,module_name,function_name,limitation) values(2, 'search' , '*'      , '*');

insert into ezpolicy(role_id,module_name,function_name,limitation) values(3, 'class'  , 'list'   , '*');
insert into ezpolicy(role_id,module_name,function_name,limitation) values(3, 'class'  , 'edit'   , '' );
insert into ezpolicy(role_id,module_name,function_name,limitation) values(3, 'content', 'sitemap', '*');
insert into ezpolicy(role_id,module_name,function_name,limitation) values(3, 'content', 'delete' , '*');
insert into ezpolicy(role_id,module_name,function_name,limitation) values(3, 'content', 'edit'   , '*');
insert into ezpolicy(role_id,module_name,function_name,limitation) values(3, 'content', 'view'   , '*');
insert into ezpolicy(role_id,module_name,function_name,limitation) values(3, 'search' , '*'      , '*');

insert into ezpolicy(role_id,module_name,function_name,limitation) values(4, 'content', 'sitemap', '*');
insert into ezpolicy(role_id,module_name,function_name,limitation) values(4, 'class'  , 'edit'   , '*');
insert into ezpolicy(role_id,module_name,function_name,limitation) values(4, 'search' , 'search' , '*');
insert into ezpolicy(role_id,module_name,function_name,limitation) values(4, 'content', '*'      , '*');
insert into ezpolicy(role_id,module_name,function_name,limitation) values(4, 'search' , '*'      , '*');

drop SEQUENCE ezpolicy_limitation_s;
CREATE SEQUENCE ezpolicy_limitation_s;

drop table ezpolicy_limitation;
create table ezpolicy_limitation(
id int not null primary key DEFAULT nextval('ezpolicy_limitation_s'),
policy_id int,
identifier varchar not null,
role_id int,
function_name varchar,
module_name varchar
);

insert into ezpolicy_limitation(policy_id,identifier,role_id,function_name,module_name) values(1,'ClassID', 1,  'content', 'sitemap');
insert into ezpolicy_limitation(policy_id,identifier,role_id,function_name,module_name) values(1,'ObjectID', 1,  'content', 'sitemap');
insert into ezpolicy_limitation(policy_id,identifier,role_id,function_name,module_name) values(2,'ClassID', 1, 'search', 'search');
insert into ezpolicy_limitation(policy_id,identifier,role_id,function_name,module_name) values(2,'ObjectID',1, 'search', 'search');
insert into ezpolicy_limitation(policy_id,identifier,role_id,function_name,module_name) values(8,'ClassID', 3, 'edit', 'class');


drop SEQUENCE ezpolicy_limitation_value_s;
CREATE SEQUENCE ezpolicy_limitation_value_s;
drop table ezpolicy_limitation_value;
create table ezpolicy_limitation_value(
id int not null primary key DEFAULT nextval('ezpolicy_limitation_value_s'),
limitation_id int,
value int
);

insert into ezpolicy_limitation_value(limitation_id,value) values(1,'2');
insert into ezpolicy_limitation_value(limitation_id,value) values(2,'1');
insert into ezpolicy_limitation_value(limitation_id,value) values(2,'17');
insert into ezpolicy_limitation_value(limitation_id,value) values(2,'45');
insert into ezpolicy_limitation_value(limitation_id,value) values(2,'3');
insert into ezpolicy_limitation_value(limitation_id,value) values(2,'46');
insert into ezpolicy_limitation_value(limitation_id,value) values(3,'2');

insert into ezpolicy_limitation_value(limitation_id,value) values(4,'1');
insert into ezpolicy_limitation_value(limitation_id,value) values(4,'17');
insert into ezpolicy_limitation_value(limitation_id,value) values(4,'45');
insert into ezpolicy_limitation_value(limitation_id,value) values(4,'3');
insert into ezpolicy_limitation_value(limitation_id,value) values(4,'46');
insert into ezpolicy_limitation_value(limitation_id,value) values(5,'2'); 




