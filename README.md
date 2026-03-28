# Playlist Courses Platform

A **Laravel 13** application that fetches YouTube playlists and displays them as structured courses with lessons count and metadata.

---

##  Features

* Fetch YouTube playlists dynamically
* Display playlists as courses
* Show lessons count per playlist
* Clickable cards linking to YouTube
* Clean and responsive UI

---

##  Requirements

* PHP >= 8.2
* Composer
* MySQL / MariaDB
* Node.js & NPM

---

##  Setup Instructions

### 1. Clone the repository

```bash
git clone https://github.com/Ramzy-Saad/YoutubeScaperTask-PHP.git
cd your-repo
```

---

### 2. Install dependencies

```bash
composer install
npm install && npm run build
```

---

### 3. Setup environment file

```bash
cp .env.example .env
```

---

### 4. Generate app key

```bash
php artisan key:generate
```

---

### 5. Configure database

Update your `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Run migrations:

```bash
php artisan migrate
```

---

##  API Keys Configuration

This project requires the following API keys:

###  YouTube API Key

Used to fetch playlists and videos.

1. Go to: https://console.cloud.google.com/
2. Create a project
3. Enable **YouTube Data API v3**
4. Generate API Key

Add to `.env`:

```env
YOUTUBE_API_KEY=your_youtube_api_key_here
```

---

###  OpenAI API Key

Used for AI-related features.

1. Go to: https://platform.openai.com/
2. Generate API key

Add to `.env`:

```env
OPENAI_API_KEY=your_openai_api_key_here
```

---

## Running the Project

Start the development server:

```bash
php artisan serve
```

Visit:

```
http://127.0.0.1:8000
```

---

## 🔄 Fetching Playlists

Run your custom command or logic:

```bash
php artisan your:command
```

---

## Notes

* If you want to use openAi to generate title for your categories in AiService file will find generateTitles methode commented and i used simple array for fees problem


