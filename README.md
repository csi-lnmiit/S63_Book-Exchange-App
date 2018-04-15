# Libromate

### Project Description
Let’s consider a situation - in school/college library it often happens that there is no availability of certain books other than academics which a student want to read. But that same book could be available with some other person on the campus.But the problem is that we couldn’t get to know about that person who possesses it. We may call our friends for the same, but the resource may be available with some other person on campus.
In response to this problem Libromate - A Book Sharing Web Portal comes to your rescue. And yes this could also be used for Academics related books also.

### Technologies used in the project
We have used PHP for backend development and MySQL for database management.Tech used in developing front end interface are - HTML5, CSS3, Bootstrap 4 & JavaScript.

### Project Installation
* Copy all the project files to the localhost folder (/var/www/html) in your system
* Create a new user with following credentials :-
  * Username: slp
  * Password: qwerty
  * Database_name: libromate
```
CREATE USER 'slp'@'localhost' IDENTIFIED BY 'qwerty';
GRANT ALL PRIVILEGES ON libromate.* TO 'slp'@'localhost';
```
* Dump the database.sql file to the database.
```
mysql -u slp -p -h localhost libromate < database.sql;
```
* Run the project using the URL - “localhost”
