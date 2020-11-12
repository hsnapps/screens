# Screens
Screens is a web application made for [Technical and Vocational Training Corporation (TVTC)](https://www.tvtc.gov.sa/) as graduation project for a group of students in the [College of Telecom & Electronics (CTE)](https://twitter.com/cte_edu?lang=he).
The app is based on Laravel framework in the backend and UIKit in the frontend, and uses either MySQL, MariaDB or SQLite database.


# Server Requirements
- [PHP](https://www.php.net/downloads.php) >= 7.2.5
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

# Tools
- [Composer](https://getcomposer.org/)
- [Git](https://git-scm.com/downloads)
- [Visual Studio Code](https://code.visualstudio.com/) *(Recommended)*

# Database
- In production environment use [MariaDB](https://mariadb.org/), [MySQL](https://dev.mysql.com/downloads/mysql/).
- In test environment use [SQLite](https://www.sqlite.org/index.html).

# Preparing
- Download and setup [Composer](https://getcomposer.org/)
- Download and setup [Git](https://git-scm.com/downloads)
- Open a command propmt **window with *Administrator* privileges**
- Clone code repository from [github](https://github.com/hsnapps/screens)
``git clone https://github.com/hsnapps/screens``
- Get inside the directory *screens*
``cd screens``
- Copy the environment file
    - In Windwos: ``copy .env.example .env``
    - In Linux ``cp .env.example .env``
- Install dependencies
``composer install``

## Testing app locally:
1. Add PHP entry to your environment variables:
    - In Windows:
    ``setx /M path "%path%;C:\path\to\php.exe"``
    Or use the step in animated picture below
    ![Example](http://screens.iamhassan.info/public/images/help.gif "Environment Exampl")
    - In linux
    ``export PATH=$PATH:/path/to/php``
    
2. Create the sqlite database file:
    - In Windows: ``copy NUL database\database.sqlite``
    - In Linux: ``touch database/database.sqlite``
3. Run the setup command:
    - ``php artisan app:setup``
4. Start the test server:
    - ``php artisan serve``
5. Open your browser and serve to [http://127.0.0.1:8000](http://127.0.0.1:8000)

## License
- The Screens app is a private app licensed under the [MIT license](https://opensource.org/licenses/MIT) and created by [Eng. Hassan Baabdullah](https://iamhassan.info) - 2020

