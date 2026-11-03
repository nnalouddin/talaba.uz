
# 🎓 talaba.uz

Talabalar ma'lumotlarini saqlash va boshqarish uchun mo'ljallangan web-loyiha.

## 🗄️ Database

Database nomi: `talaba`

Jadval nomi: `students`

### 1. Database yaratish

```sql
CREATE DATABASE IF NOT EXISTS talaba
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE talaba;
```

### 2. Students jadvalini yaratish

```sql
CREATE TABLE students (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    lname VARCHAR(100) NOT NULL,
    fname VARCHAR(100) NOT NULL,
    patronymic VARCHAR(100) NOT NULL,
    birthdate DATE NOT NULL
);
```

### 3. Talabalarni qo'shish

```sql
INSERT INTO students
    (lname, fname, patronymic, birthdate)
VALUES
    ('Olimov', 'Olim', 'Olimovich', '1999-12-20'),
    ('Zolimov', 'Zolim', 'Zolimovich', '2000-05-15'),
    ('Aliyev', 'Ali', 'Aliyevich', '2001-03-10'),
    ('Valiyev', 'Vali', 'Valiyevich', '2000-08-22'),
    ('Karimov', 'Karim', 'Karimovich', '2002-01-12');
```

### 4. Ma'lumotlarni ko'rish

```sql
SELECT * FROM students;
```

## 📊 Database jadvali

| Ustun | Ma'lumot turi | Tavsifi |
|---|---|---|
| id | INT UNSIGNED | Talabaning unikal ID raqami |
| lname | VARCHAR(100) | Familiyasi |
| fname | VARCHAR(100) | Ismi |
| patronymic | VARCHAR(100) | Otasining ismi |
| birthdate | DATE | Tug'ilgan sanasi |

## 🛠️ Texnologiyalar

- PHP
- MySQL
- HTML5
- CSS3
- Bootstrap 5.3
- JavaScript

## 👨‍💻 Muallif

**Project:** talaba.uz
