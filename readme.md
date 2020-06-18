
## Installation

- Copy env.example end rename to env.
- Add database credentials to env. file
- You can change moderator and manager email if you want. (Optional)
  You can find emails in /database/seeds/UsersTableSeeder.php  (Make sure that mail of manager and moderator is not same). 
- composer install
- php artisan key:generate
- php artisan migrate:fresh --seed

If you have issue with permissions run

sudo chmod -R 777 storage/*

## Google account

Google smtp is used for sending mails. You can login to check mail are sent. 
Go to sent tab to check sent mails.

username: aleksandarustic5@gmail.com
password: rhic8015

## LOGIN INFO

### Moderator

email: moderator@app.com
password: password

### HR Manager

email: manager@app.com
password: password
