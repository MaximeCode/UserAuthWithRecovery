# App to Login / Sign Up User

This little and simple app was created to test the logic of login and subscribe.  
Also, I added a "Forgotten password" link to reset user passwords.  
It works with a code randomly generated by a PHP function that I created.  
This code is sent to the user's email, and when the user enters the code, they can change their password.

## How to use it

1. First, clone the repository:
```bash
git clone https://github.com/MaximeCode/UserAuthWithRecovery.git
```

2. Second, go to the folder and install all dependencies of the project:
```bash
cd UserAuthWithRecovery
npm install
```
3. Third, start a development server like `XAMPP`, `WAMP`, `LAMP`, or `laragon`.\
If you're using PHP's built-in server, you can run:
```bash
php -S localhost:8000
```

4. Fourth, create the database:
- Import the provided SQL file (`archivestest.sql`) into your MySQL database.

> [!WARNING]
> Be sure to create a specific user to access the database!
> Make sure to configure your database connection in the file `pdoConnection/db.php` _`Line 17`_\

Finally, open your browser and navigate to: [http://localhost:8000](http://localhost:8000)

## Features
- User login
- User sign up
- Password recovery with email verification
- Secure password storage using hashing (e.g., password_hash in PHP)

## Dependencies
- Bootstrap 5 for the frontend
- Node.js (for installing Bootstrap and other frontend dependencies)
- PHP 8.0+ for the backend
- MySQL for the database

## License
No licence, you con use this little project as you want 😊
