How to install the application ?

1.	Ensure that the Laravel environment is configured. By installing the composer , XAMPP Apache or any type of Apache and git.

2.	Open the project's repository from the GitHub through the link: https://github.com/ibrahimalmagharee/Articles.

3.	Download the project from github or make a git clone for the project and open git cmd and put it in C:/xampp/htdocs and put this command on cmd: 
git clone https://github.com/ibrahimalmagaree/Articles.git.

4.	After the download process is completed. Git cmd should be opened, which is the correct path to the project: C:/xampp/htdocs/Articles
Execute the following steps  : 

•	Run this command on git cmd: composer install
•	Make a copy of the .env.example file and name it .env
•	Run this command on git cmd: php artisan key:generate
•	Run this command on git cmd: composer dump-autoload


5.	Open the database through the following link: http://localhost/phpmyadmin/

6.	Then click on new from the side menu to create a database and name the database in the space provided by the name of articles.

7.	Then we open the .env file and put the name of the database we created in this place: DB_DATABASE=articles

8.	Then we run this command on git cmd: php artisan migrate

9.	Then we run this command on git cmd: php artisan db:seed


How to use the application ?

1.	Then we run this command on git cmd: php artisan serve. And make sure that apache and mysql are running on xampp.

2.	Now open your browser and put the following link http://127.0.0.1:8000/

3.	After opening the link, a page will appear to display the articles. You can browse articles and view article details by clicking on it.

4.	And to enter the control panel through the following link: http://127.0.0.1:8000/admin/

5.	You can access the panel by entering the email: admin@gmail.com
And the password: admin123

6.	After entering the control panel, you can view articles, add articles, edit articles, delete articles, publish and unpublish articles by clicking on articles from the side menu.

7.	And, you can view tags, add tags, edit tags, delete tags, activate and deactivate tags by clicking on tags from the side menu.

8.	You can also log out, change profile information and change the password by clicking on the profile picture.

 



