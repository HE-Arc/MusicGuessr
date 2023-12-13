# MusicGuessr
## Description
Musicguessr is a website hosting a quizz game where the objective is to guess the title of a song.  
The game is based on a trial and error system, where the player has to guess the title of the song by trying different
titles, and getting information about the similarity between the title he entered and the right answer.  
The songs are song from the officials spotify playlists containing the top 100 songs streamed in the world each year.  
The dataset used is available [here](https://www.kaggle.com/datasets/josephinelsy/spotify-top-hit-playlist-2010-2022).
A demo of the game is available [here](https://musicguessr.k8s.ing.he-arc.ch/).
## Development environment
### Install development tools
- Install [composer](https://getcomposer.org/download/)
- Install [npm](https://www.npmjs.com/get-npm)
- Install [xampp](https://www.apachefriends.org/fr/index.html)
- 
### Clone the repository
for SSH
```bash
git clone git@github.com:HE-Arc/MusicGuessr.git
```
for HTTPS
```bash
git clone https://github.com/HE-Arc/MusicGuessr.git
```

### Configure the environment
- Copy the `.env.example` file and rename it `.env`
- Generate a key for the application
```bash
php artisan key:generate
```
- Create a database and configure the `.env` file with the database credentials
- Run the migrations
```bash
php artisan migrate
```
- Run the seeders
```bash
php artisan db:seed
```
- Install the dependencies
```bash
composer install
npm install
```
- Compile the assets
```bash
npm run dev
```

### Run the application
- Start the apache and mysql services in xampp
- Start the application
```bash
php artisan serve
```
- Go to [localhost:8000](http://localhost:8000)
- Enjoy the game !
- To stop the application, press `Ctrl + C` in the terminal
- To stop the apache and mysql services, press `Stop` in xampp

### Run the tests
- Run the tests
```bash
php artisan test
```
