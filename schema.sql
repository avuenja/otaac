CREATE TABLE otaac_posts (
    id int unsigned not null auto_increment primary key,
    title varchar(80) not null,
    body text not null,
    situation char(1) not null default 'A' comment 'A = Active, I = Inactive',
    created datetime,
    created_by int not null,
    modified datetime,
    modified_by int
);

CREATE TABLE otaac_recovery_key (
    id int unsigned not null auto_increment primary key,
    account_id INT not null,
    recovery_key CHAR(20) not null,
    created datetime
);