<?php
class GoogleMapsAPI extends persist
{
    private $apiKey = "AIzaSyDg7gWEqeFaPMQqMmCeWDpFCF7-WiBaW-w";
    private $ch;
    
    public function __construct()
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
    }
    static public function getFilename() {
        return get_called_class();
      }
    public function geocode($address)
    {
        $url = 'https://maps.googleapis.com/maps/api/geocode/json';
        
        $queryParams = [
            'address' => $address,
            'key' => $this->apiKey
        ];
        
        return $this->get($url, $queryParams);
    }
    
    public function directions($origin, $destination, $waypoints = [], $optimize = false)
{
    $url = 'https://maps.googleapis.com/maps/api/directions/json';
    
    $queryParams = [
        'origin' => $origin,
        'destination' => $destination,
        'key' => $this->apiKey
    ];

    // Adiciona waypoints se existirem
    if (!empty($waypoints) && is_array($waypoints)) {
        $waypoints = array_map(function($item) {
            return $item[0]; // Extrai a string do array interno
        }, $waypoints);
        $waypointsParam = implode('|', $waypoints);
        $queryParams['waypoints'] = $waypointsParam;}
    
    // Define a otimização de rota se necessário
    if ($optimize && !empty($waypoints)) {
        $queryParams['optimize_waypoints'] = 'true';
    }
    
    return $this->get($url, $queryParams);
}
    
    private function get($url, $queryParams = [])
    {
        if (!empty($queryParams)) {
            $url .= '?' . http_build_query($queryParams);
        }
        
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_HTTPGET, true);
        
        return $this->execute();
    }
    
    private function execute()
    {
        $response = curl_exec($this->ch);
        
        if (curl_errno($this->ch)) {
            echo 'Erro na requisição: ' . curl_error($this->ch);
            // Você pode adicionar lógica para lidar com o erro aqui
        }
        
        return $response;
    }
    
    public function close()
    {
        curl_close($this->ch);
    }

}
