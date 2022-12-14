##  ELLIPSIS DIGITAL INTERVIEW SOFTWARE


By ( Vicent Alphonce Mkota )

**_Note_**: All the Attached files are found in https://github.com/feyswall/ellipsisDigital in the **attachments** folder.

## Technologies stack

- **PHP  version 8.1^**
- **Laravel version 9.1**
- **Bootstrap 5**
- **MySQL**
- **Vanilla Javascript**
- **Git**
- **Composer**
- **Apache Server**

##  Installation
This project can be found in the github repository **[https://github.com/feyswall/ellipsisDigital](https://github.com/feyswall/ellipsisDigital)**
After cloning the repository, you should install composer by writing ``` composer install ```. This will make sure that the laravel package is installed in your
application.
Then create ``` .env ``` file in the root of your application and copy the contents of ``` .env.example ``` in ``` .env ``` file.  
After doing this Open the file and edit ``` database``` info, For example 
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ellipsisDigital
DB_USERNAME=root
DB_PASSWORD=

```

After this you should create app key by running the following command
``` php artisan key:generate``` and the key will be generated automatically in ``` .env ``` file
```angular2html
APP_KEY=base64:gTHVWjE1sZ2uIC4IwIJqGp3fe+K1H64+WeyENjtp4lM=
```

Then create your database in mysql, this depends on your mysql configurations.

After creating your database, you should start importing the default data needed by the system by running the following
command in your terminal
```angular2html
php artisan migrate
```
To create all the tables in your database, and then write
```angular2html
php artisan db:seed
```
This will as well create **5000** books  records with it, so it will take some
time to complete, please wait for 5 to 10 minutes.
This data will have a default pdf and thumbnail.
Those dummy data that will help you to start interacting with the system.



## start using the Application
The System come with one default user called ```administrator``` having email ``` admin@gmail.com ```
and default password is ``` default_password ```



## About System
System Involves two parts which are ``` API``` and ``` WEB ```. Let's look ate them one
ate time.

- **API**

In API call we have three request which are:
**http://157.245.72.226:81/api/register** With ``` POST ``` request For registering user in API. This will
register and return the user info as well as Bearer Token for Authenticating the
user. Example Response
```angular2html
{
    "user": {
        "name": "feyswal",
        "email": "feyToto@gmail.com",
        "updated_at": "2022-10-28T08:13:28.000000Z",
        "created_at": "2022-10-28T08:13:28.000000Z",
        "id": 2
    },
    "token": "1|5sTnr0u9ZgN0dIEILZyihYESJN7mF8YTp8TQViol"
}
```

If the user has an account  you can log him instead by using the following End Point
**http://157.245.72.226:81/api/login** with POST Request.
In the header make sure you specify the following
headers { Accept: Application/json }
Authentication { Bearer Token: and pass your returned user token }


Also there is end point that deals with retrieving all books with is
**http://157.245.72.226:81/api/books** with GET request
headers { Accept: Application/json }
Authentication { Bearer Token: and pass your returned user token }

The result is paginated and the pagination details are all listed.

Sample response:
```
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "book_name": "Ludie Kertzmann's Book",
            "thumbnail": "default_thumbnail.png",
            "book_url": "default_pdf.pdf"
        },
        {
            "id": 2,
            "book_name": "Roxanne Brown's Book",
            "thumbnail": "default_thumbnail.png",
            "book_url": "default_pdf.pdf"
        },
        {
            "id": 20,
            "book_name": "Luella Graham DDS's Book",
            "thumbnail": "default_thumbnail.png",
            "book_url": "default_pdf.pdf"
        }
    ],
    "first_page_url": "http://localhost:8000/api/books?page=1",
    "from": 1,
    "last_page": 250,
    "last_page_url": "http://localhost:8000/api/books?page=250",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/books?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": "http://localhost:8000/api/books?page=2",
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": "http://localhost:8000/api/books?page=2",
    "path": "http://localhost:8000/api/books",
    "per_page": 2,
    "prev_page_url": null,
    "to": 2,
    "total": 6
}


And the last one is getting Popular Books, which are books with most likes
**http://157.245.72.226:81/api/books/popular** with GET request
headers { Accept: Application/json }
Authentication { Bearer Token: and pass your returned user token }

Sample response
```angular2html
[
    {
        "book_id": 7,
        "total": 1,
        "book": {
            "id": 7,
            "book_name": "Sister Klein's Book",
            "book_url": "default_pdf.pdf",
            "thumbnail": "default_thumbnail.png"
        }
    },
    {
        "book_id": 9,
        "total": 1,
        "book": {
            "id": 9,
            "book_name": "Dr. Jovani Keeling's Book",
            "book_url": "default_pdf.pdf",
            "thumbnail": "default_thumbnail.png"
        }
    },
    {
        "book_id": 11,
        "total": 1,
        "book": {
            "id": 11,
            "book_name": "Courtney Kuhic MD's Book",
            "book_url": "default_pdf.pdf",
            "thumbnail": "default_thumbnail.png"
        }
    }
]
```


- **WEB**

In website we have two User Privilege which are Admin and Users.
Admin is pre-build in the system but a user can be registered.

While inside the system Only User With admin privilege is the one who
can create  Books.
While creating a book a user will decide if he will supply a **pdf** and **thumbnail**
if user will not add them the the default values will be used.


## System Testing 

**Feature Test** - In the sake ot time i conducted feature change in comments call alone

**test_the_book_user_index_page_rendering()** - To test if the books page display as expected

**test_the_book_admin_index_page_rendering()** - To test if the books page on admin page displays as expected

**test_the_book_fetching_from_the_api_rendering()** - To test if the books are fetched successfully from the API

**test_if_admin_can_create_books()** - Test if admin can crate books without problems

To  see this test go to the project folder and write the following command

``` php artisan  test --filter BookControllerTest ```