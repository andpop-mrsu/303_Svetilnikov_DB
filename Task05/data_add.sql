INSERT INTO users(name, surname, email, gender, register_date, occupation_id) VALUES
("Danila", "Svetilnikov", "danila.svetilnikov@mail.ru", "male", DATE("now"), (SELECT id FROM occupations WHERE occupations.title = "student"));
INSERT INTO users(name, surname, email, gender, register_date, occupation_id) VALUES
("Alina", "Ruzaeva", "alina.ruzaeva@mail.ru", "female", DATE("now"), (SELECT id FROM occupations WHERE occupations.title = "student"));
INSERT INTO users(name, surname, email, gender, register_date, occupation_id) VALUES
("Alexandr", "Taynov", "alexandr.taynov@mail.ru", "male", DATE("now"), (SELECT id FROM occupations WHERE occupations.title = "student"));
INSERT INTO users(name, surname, email, gender, register_date, occupation_id) VALUES
("Daria", "Rodkina", "daria.rodkina@mail.ru", "female", DATE("now"), (SELECT id FROM occupations WHERE occupations.title = "student"));
INSERT INTO users(name, surname, email, gender, register_date, occupation_id) VALUES
("Nikita", "Utkin", "nikita.utkin@mail.ru", "male", DATE("now"), (SELECT id FROM occupations WHERE occupations.title = "student"));


INSERT INTO movies(title, year) VALUES
("Devyataev", 2021);
INSERT INTO movies(title, year) VALUES
("Eternals", 2021);
INSERT INTO movies(title, year) VALUES
("Pilot", 2021);


INSERT INTO ratings(user_id, movie_id, rating, "timestamp") VALUES(
(SELECT id FROM users WHERE users.email = "danila.svetilnikov@mail.ru"), 
(SELECT id FROM movies WHERE movies.title = "Devyataev" and movies.year = 2021),
4.4, strftime('%s','now'));
INSERT INTO ratings(user_id, movie_id, rating, "timestamp") VALUES(
(SELECT id FROM users WHERE users.email = "danila.svetilnikov@mail.ru"), 
(SELECT id FROM movies WHERE movies.title = "Eternals" and movies.year = 2021),
4, strftime('%s','now'));
INSERT INTO ratings(user_id, movie_id, rating, "timestamp") VALUES(
(SELECT id FROM users WHERE users.email = "danila.svetilnikov@mail.ru"), 
(SELECT id FROM movies WHERE movies.title = "Pilot" and movies.year = 2021),
4, strftime('%s','now'));