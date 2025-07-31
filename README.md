# 📚 PHP Book Scraper & Crawler

A simple PHP web app that scrapes books from [books.toscrape.com](https://books.toscrape.com), including multiple pages and categories.

## 🔍 Features

- Select category from dropdown
- Crawls all pages of that category
- Extracts:
  - Book title
  - Price
  - Availability
  - Book link
- Exports to CSV
- Displays results in responsive Bootstrap table

## 🚀 Demo

> Run locally with XAMPP or any PHP server

1. Clone or download this repo
2. Place folder inside `htdocs/` (if using XAMPP)
3. Start Apache and visit `http://localhost/php-book-crawler/index.php`
4. Choose a category and click "Scrape"

## 📦 Requirements

- PHP 7.4+
- cURL enabled
- DOM extension (default in PHP)

## 📁 Folder Structure

php-book-crawler/
├── index.php
├── scrape.php
├── scraper/
│ └── BookScraper.php
├── exports/
│ └── books.csv




🔒 2. .gitignore

exports/books.csv
*.log

## 🔧 Technologies Used
- PHP 8+
- DOMDocument
- Simple HTML DOM Parser (προαιρετικά)
- Bootstrap (για το UI)

