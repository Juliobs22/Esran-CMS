CREATE DATABASE esrandb;

CREATE TABLE esrandb.usuarios (
    us_id TINYINT NOT NULL AUTO_INCREMENT,
    usname VARCHAR(16),
    email VARCHAR(32),
    password VARCHAR(64),
    PRIMARY KEY (us_id)
);

CREATE TABLE esrandb.admin (
    admin_id VARCHAR(6) NOT NULL,
    us_id_ad TINYINT NOT NULL,
    privileges TINYINT,
    PRIMARY KEY (admin_id),
    FOREIGN KEY (us_id_ad) REFERENCES usuarios(us_id)
);

CREATE TABLE esrandb.entries(
    en_id INT NOT NULL AUTO_INCREMENT,
    us_id_fk TINYINT NOT NULL,
    title VARCHAR(64),
    thumb VARCHAR(256),
    content JSON,
    PRIMARY KEY (en_id),
    FOREIGN KEY (us_id_fk) REFERENCES usuarios(us_id)
);

commit;