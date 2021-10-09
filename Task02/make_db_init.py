import csv
import re
f=open('db_init.sql', 'w')
f.write("DROP TABLE IF EXISTS movies;\n")
f.write("DROP TABLE IF EXISTS ratings;\n")
f.write("DROP TABLE IF EXISTS tags;\n")
f.write("DROP TABLE IF EXISTS users;\n")
f.write('CREATE TABLE movies(\n'
   'id INTEGER PRIMARY KEY, \n'
   'title TEXT, \n'
   'year INTEGER, \n'
   'genres TEXT\n);\n')
f.write('CREATE TABLE ratings(\n'
   'id INTEGER PRIMARY KEY, \n'
   'user_id INTEGER, \n'
   'movie_id INTEGER, \n'
   'rating INTEGER, \n'
   'timestamp TEXT\n);\n')
f.write('CREATE TABLE tags(\n'
   'id INTEGER PRIMARY KEY, \n'
   'user_id INTEGER, \n'
   'movie_id INTEGER, \n'
   'tag TEXT, \n'
   'timestamp INTEGER\n);\n')
f.write('CREATE TABLE users(\n'
   'id INTEGER PRIMARY KEY, \n'
   'name TEXT, \n'
   'email TEXT, \n'
   'gender TEXT, \n'
   'register_date TEXT, \n'
   'occupation TEXT\n);\n')



f.write('\n\nINSERT INTO movies(id, title, year, genres) VALUES')
m=open('movies.csv', 'r')
reader=csv.DictReader(m)
allMovies=''
for i in reader:
   title = i['title'].replace('"', '""').replace('\'', '\'\'') # Nobody's в Nobody''s, переходы
   year= re.search(r'\(\d{4}\)', i['title'])
   year = year.group(0)[1:-1] if year is not None else 'null'
   print(year)
   allMovies+= f"({i['movieId']}, '{title}', {year}, '{i['genres']}'),\n"
f.write(f'\n{allMovies[:-2]};\n')
m.close()


f.write('\n\nINSERT INTO ratings(id, user_id, movie_id, rating, timestamp) VALUES')
r=open('ratings.csv', 'r')
allRatings=''
reader= csv.DictReader(r)#
id=1
for i in reader:
   allRatings+=f"({id}, {i['userId']}, {i['movieId']}, {i['rating']}, {i['timestamp']}),\n"
   id+=1
f.write(f'\n{allRatings[:-2]};\n')
r.close()
f.write('\n\nINSERT INTO tags(id, user_id, movie_id, tag, timestamp) VALUES')
t=open('tags.csv', 'r')
reader=csv.DictReader(t)
allTags=''
id=1
for i in reader:
   tag=i['tag'].replace('"', '""').replace('\'', '\'\'')
   allTags += f"({id}, {i['userId']}, {i['movieId']}, '{tag}', {i['timestamp']}),\n"
   id+=1
f.write(f'\n{allTags[:-2]};\n')
t.close()


f.write('\n\nINSERT INTO users(id, name, email, gender, register_date, occupation) VALUES')
u=open('users.txt', 'r')
user1=u.readlines()
allUsers=''
for i in user1:
   user1=i.replace('"', '""').replace('\'', '\'\'').rstrip().split('|')
   allUsers+=f"({user1[0]}, '{user1[1]}', '{user1[2]}', '{user1[3]}', '{user1[4]}', '{user1[5]}'),\n"
f.write(f'\n{allUsers[:-2]};')
u.close()
f.close()