<?php

class BookScraper {
    private string $baseUrl = "https://books.toscrape.com/";
    private array $books = [];

    public function crawlAllPages(): array {
        $page = 1;
        do {
            $url = $this->baseUrl . "catalogue/page-{$page}.html";
            echo "🔎 Σελίδα: $url<br>";
            $html = $this->getHTML($url);
            $newBooks = $this->extractBooks($html);
            if (empty($newBooks)) break;
            $this->books = array_merge($this->books, $newBooks);
            $page++;
        } while (true);

        return $this->books;
    }

    public function crawlCategory(string $categorySlug): array {
    $this->books = [];
    $page = 1;
    do {
        $url = $this->baseUrl . "catalogue/category/books/{$categorySlug}/page-{$page}.html";
        $html = $this->getHTML($url);
        $newBooks = $this->extractBooks($html);

        if (empty($newBooks)) break;

        $this->books = array_merge($this->books, $newBooks);
        $page++;
    } while (true);

    return $this->books;
    }


    private function getHTML(string $url): string {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => 'Mozilla/5.0'
        ]);
        $html = curl_exec($ch);
        curl_close($ch);
        return $html;
    }

    private function extractBooks(string $html): array {
        libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        $doc->loadHTML($html);
        $xpath = new DOMXPath($doc);

        $books = [];
        $nodes = $xpath->query("//article[contains(@class,'product_pod')]");

        foreach ($nodes as $node) {
            $titleNode = $xpath->query(".//h3/a", $node)->item(0);
            $title = $titleNode->getAttribute("title");
            $link = $titleNode->getAttribute("href");
            $fullLink = $this->baseUrl . "catalogue/" . $link;

            $price = $xpath->query(".//div[@class='product_price']/p[@class='price_color']", $node)->item(0)->textContent;
            $availability = $xpath->query(".//div[@class='product_price']/p[@class='instock availability']", $node)->item(0)->textContent;
            $availability = trim($availability);

            $books[] = [$title, $price, $availability, $fullLink];
        }

        return $books;
    }
}
