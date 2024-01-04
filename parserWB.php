<?php

class ParseVideoCard
{
    private $page;
    private $brands = ['AMD' => 28933, 'MSI' => 27445, 'ASUS' => 5786];
    private $user_agent = [
        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)
                         AppleWebKit/537.36 (KHTML, like Gecko)
                         Chrome/102.0.0.0 Safari/537.36',
    ];

    public function __construct($page = 1)
    {
        $this->page = $page;
    }

    public function parse($selectedBrand)
    {
        $result = [];
        $count = 1;

        while ($count <= $this->page) {
            $url = 'https://catalog.wb.ru/brands/m/catalog'
                   . '?appType=1&brand=' . $this->brands[$selectedBrand]
                   . '&curr=rub&dest=-1257786&page=' . $count
                   . '&sort=popular&xsubject=3274';

            $response = $this->make_request($url);
            $data = json_decode($response, true)['data'];

            if (empty($data['products'])) {
                break;
            }

            foreach ($data['products'] as $product) {
                $result[] = [
                    'name' => $product['name'],
                    'salePriceU' => $product['salePriceU'] / 100,
                    'brand' => $product['brand'],
                    'rating' => $product['rating'],
                ];
            }

            $count++;
        }

        return $result;
    }

    private function make_request($url)
    {
        $ch = curl_init($url);
    
        // Устанавливаем опции cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent['User-Agent']);
    
        // Выполняем запрос
        $response = curl_exec($ch);
    
        // Проверяем на наличие ошибок
        if (curl_errno($ch)) {
            echo 'cURL Error: ' . curl_error($ch);
        }

        curl_close($ch);
        return $response;
    }
}

$parser = new ParseVideoCard();
$selectedBrand = isset($_GET['brand']) ? $_GET['brand'] : 'MSI';
$result = $parser->parse($selectedBrand);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($result);
