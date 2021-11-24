DROP TABLE IF EXISTS box;
DROP TABLE IF EXISTS schedule;
DROP TABLE IF EXISTS day_schedule;
DROP TABLE IF EXISTS master;
DROP TABLE IF EXISTS work;
DROP TABLE IF EXISTS services;
DROP TABLE IF EXISTS car_category;


CREATE TABLE box(
id INTEGER PRIMARY KEY AUTOINCREMENT,
date TEXT CHECK (date==strftime('%Y-%m-%d', date)),
start_time TEXT CHECK (start_time==strftime('%H:%M:%S', start_time)),
end_time TEXT CHECK (end_time==strftime('%H:%M:%S', end_time))
);

CREATE TABLE master(
id INTEGER PRIMARY KEY AUTOINCREMENT,
surname TEXT,
name TEXT,
patronymic TEXT,
birthdate TEXT CHECK (birthdate==strftime('%Y-%m-%d', birthdate)),
box_id INTEGER,
revenue_percent REAL CHECK(revenue_percent >= 0.0 AND revenue_percent <= 100.0),
FOREIGN KEY(box_id) REFERENCES box(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE day_schedule(
id INTEGER PRIMARY KEY AUTOINCREMENT,
start_time TEXT CHECK (start_time==strftime('%H:%M:%S', start_time)),
end_time TEXT CHECK (end_time==strftime('%H:%M:%S', end_time))
);

CREATE TABLE schedule(
day_schedule_id INTEGER,
master_id INTEGER,
day_title TEXT CHECK(day_title = 'Понедельник'
    OR day_title = 'Вторник'
    OR day_title = 'Среда'
    OR day_title = 'Четверг' 
    OR day_title = 'Пятница' 
    OR day_title = 'Суббота' 
    OR day_title = 'Воскресенье'),
FOREIGN KEY(day_schedule_id) REFERENCES day_schedule(id) ON DELETE RESTRICT ON UPDATE CASCADE,
FOREIGN KEY(master_id) REFERENCES master(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE car_category(
id INTEGER PRIMARY KEY AUTOINCREMENT,
title TEXT
);

CREATE TABLE services(
id INTEGER PRIMARY KEY AUTOINCREMENT,
title TEXT,
duration REAL,
price REAL,
car_category_id INTEGER,
FOREIGN KEY(car_category_id) REFERENCES car_category(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE work(
id INTEGER PRIMARY KEY AUTOINCREMENT,
master_id INTEGER,
services_id INTEGER,
FOREIGN KEY(master_id) REFERENCES master(id) ON DELETE RESTRICT ON UPDATE CASCADE,
FOREIGN KEY(services_id) REFERENCES services(id) ON DELETE RESTRICT ON UPDATE CASCADE
);


INSERT INTO box(date, start_time, end_time) VALUES
('2021-11-20', '10:00:00', '14:00:00'),
('2021-11-20', '12:00:00', '13:00:00'),
('2021-11-17', '14:00:00', '14:30:00'),
('2021-11-17', '15:00:00', '15:30:00'),
('2021-11-17', '09:00:00', '10:00:00');


INSERT INTO master(surname, name, patronymic, birthdate, box_id, revenue_percent) VALUES
('Иванов', 'Иван', 'Иванович', '1991-05-07', 1, 20.0),
('Гнездов', 'Александр', 'Сергеевич', '1980-09-17', 2, 25.0),
('Берёзов', 'Сергей', 'Иванович', '1991-04-01', 3, 10.0),
('Листов', 'Анатолий', 'Аркадьевич', '1992-01-10', 4, 7.0),
('Ивов', 'Григорий', 'Иванович', '1977-07-07', 1, 20.0),
('Цветов', 'Сергей', 'Григорьевич', '1970-09-17', 5, 25.0),
('Краснов', 'Иван', 'Сергеевич', '1999-04-01', 3, 10.0);


INSERT INTO day_schedule(start_time, end_time) VALUES
('08:00:00', '16:00:00'),
('10:00:00', '18:00:00'),
('14:00:00', '18:00:00'),
('08:00:00', '15:00:00'),
('09:00:00', '16:00:00');


INSERT INTO schedule(day_schedule_id, master_id, day_title) VALUES
(1, 1, 'Понедельник'),
(3, 2, 'Понедельник'),
(2, 3, 'Понедельник'),
(2, 4, 'Понедельник'),
(2, 5, 'Понедельник'),
(3, 2, 'Вторник'),
(5, 3, 'Вторник'),
(6, 4, 'Вторник'),
(1, 5, 'Вторник'),
(2, 3, 'Среда'),
(3, 4, 'Среда'),
(4, 5, 'Среда'),
(6, 6, 'Среда'),
(2, 7, 'Среда'),
(3, 5, 'Четверг'),
(4, 6, 'Четверг'),
(6, 7, 'Четверг'),
(2, 1, 'Четверг'),
(2, 3, 'Пятница'),
(3, 4, 'Пятница'),
(6, 5, 'Пятница'),
(6, 7, 'Пятница'),
(5, 1, 'Пятница'),
(2, 4, 'Суббота'),
(3, 5, 'Суббота'),
(4, 6, 'Суббота'),
(5, 7, 'Суббота'),
(2, 2, 'Суббота'),
(2, 1, 'Воскресенье'),
(3, 2, 'Воскресенье'),
(4, 3, 'Воскресенье'),
(5, 6, 'Воскресенье'),
(2, 7, 'Воскресенье');


INSERT INTO car_category(title) VALUES
('Мотоцикл'),
('Легковой автомобиль'),
('Грузовой автомобиль'),
('Автобус');


INSERT INTO services(title, duration, price, car_category_id) VALUES
('Очистка дисков колес', 1, 1000, 3),
('Полная химчистка салона', 1, 2000, 2),
('Полная химчистка салона', 2, 4000, 3),
('Мойка кузова', 0.5, 1000, 1),
('Мойка кузова', 0.5, 2000, 2),
('Мойка кузова', 1, 4000, 3),
('Мойка кузова', 1, 4000, 4);


INSERT INTO work(master_id, services_id) VALUES
(2, 2),
(4, 7),
(7, 4),
(1, 5),
(6, 6),
(5, 5);


