# talaba.uz

CREATE TABLE students (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    lname VARCHAR(100) NOT NULL,
    fname VARCHAR(100) NOT NULL,
    patronymic VARCHAR(100) NOT NULL,
    birthdate DATE NOT NULL
);

INSERT INTO students (lname, fname, patronymic, birthdate)
VALUES
('Olimov', 'Olim', 'Olimovich', '1999-12-20'),
('Zolimov', 'Zolim', 'Zolimovich', '2000-05-15'),
('Aliyev', 'Ali', 'Aliyevich', '2001-03-10'),
('Valiyev', 'Vali', 'Valiyevich', '2000-08-22'),
('Karimov', 'Karim', 'Karimovich', '2002-01-12');
