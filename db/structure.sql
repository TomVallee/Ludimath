drop table if exists badge;
drop table if exists succes;
drop table if exists theme;
drop table if exists exercice;
drop table if exists user;
drop table if exists reussisucces;
drop table if exists notes;

create table badge (
    badge_id integer not null primary key auto_increment,
    badge_icone varchar(100),
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table succes (
    succes_id integer not null primary key auto_increment,
    succes_titre varchar(100),    
    foreign key (succes_badge) references badge(badge_id) on delete cascade
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table theme (
    theme_id integer not null primary key auto_increment,
    theme_titre varchar(100)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table exercice (
    exercice_id integer not null primary key auto_increment,
    exercice_nom varchar(100),
    foreign key (theme_id) references theme(theme_id) on delete cascade
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table user (
    utilisateur_id integer not null primary key auto_increment,
    utilisateur_nom varchar(100),
    utilisateur_prenom varchar(100),
    utilisateur_login varchar(100),
    utilisateur_mdp varchar(100),
    utilisateur_experience integer not null,
    foreign key (equipe_id) references equipe(equipe_id) on delete cascade
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table equipe (
    equipe_id integer not null primary key auto_increment,
    equipe_nom varchar(100)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table reussisucces (
    reussite_id integer not null primary key auto_increment,
    reussite_date date not null,
    foreign key (succes_id) references succes(succes_id) on delete cascade, 
    foreign key (utilisateur_id) references user(utilisateur_id) on delete cascade
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table notes (
    note_id integer not null primary key auto_increment,
    note_date date not null,
    foreign key (note_id) references succes(succes_id) on delete cascade, 
    foreign key (note_id) references user(utilisateur_id) on delete cascade
) engine=innodb character set utf8 collate utf8_unicode_ci;
