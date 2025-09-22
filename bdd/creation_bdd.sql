create table user (
    id int primary key auto_increment,
    name varchar(50) not null,
    first_name varchar(50) not null,
    email varchar(100) not null unique,
    password varchar(255) not null,
    nbr_point int default 0
);

