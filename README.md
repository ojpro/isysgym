
# GYM Management System

Full-Stack project to manage gyms,track members' attendances and subscriptions.
## Installation

Clone the repository

```bash
  # using SSH
  git clone git@github.com:ojpro/gym-track.git

  # using HTTPS
  https://github.com/ojpro/gym-track.git

```

Setup Backend

```bash
  # go to backend folder
  cd gym-track/backend

  # install composer packages
  composer Install

  # create an .env file
  cp .env.example .env

  # generate app key
  php artisan key:generate

  # start the server
```

Setup frontend

```bash
  # go to frontend folder
  cd ../frontend

  # install npm packages
  npm install

  # or using yarn
  yarn

  # create an .env file ^^
  cp .env.example .env

  # start the project
  npm run dev

```

🚀 Now you can visit `http://localhost:3000` to set up the project & start using it.
## Notes

- You should have a **database** before entre the project installation process
- You can edit Axios BASE_URL in `frontend/.env`
- Start PHP artisan before npm server
## Running Tests

To run tests, run the following command

```bash
  cd backend
  php artisan test
```


## Authors

- [@ojpro](https://github.com/ojpro)


## License

[MIT](https://choosealicense.com/licenses/mit/)

