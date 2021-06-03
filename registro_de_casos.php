<?php

include 'db.php';

class Geocoding
{
    protected $api_key;
    protected $debug;
    protected $callurl = "https://maps.googleapis.com/maps/api/geocode/json";
    function __construct($api_key, $debug = 0)
    {
        $this->api_key = $api_key;
        $this->debug = $debug;    
    }
    public function request($url, $parameters)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . "?" . http_build_query($parameters));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        return $result;
    }
    public function getAddress($latitude, $longitude)
    {
        $data = [
            'latlng' => "$latitude,$longitude",
            'key' => $this->api_key
        ];
        $addressData = $this->request($this->callurl, $data);
        return (json_decode($addressData)->results[0]->formatted_address);
    }
    public function getCoordinates($address)
    {
        $data = [
            'address' => $address,
            'key' => $this->api_key
        ];
        $addressData = $this->request($this->callurl, $data);
        if (count(json_decode($addressData)->results) == 0) {
            throw new Exception('Failed to fetch address data');
        }
        $location = json_decode($addressData)->results[0]->geometry->location;
        return [ 'latitude' => $location->lat, 'longitude' => $location->lng];
    }
}

$nombre_x = $_POST['nombre_x'];
$apellido_x = $_POST['apellido_x'];
$cedula_x = $_POST['cedula_x'];
$Sexo= $_POST['Sexo'];
$fecha_de_nacimiento = $_POST['fecha_de_nacimiento'];
$direccion_de_residencia = $_POST['direccion_de_residencia'];
$direccion_de_trabajo = $_POST['direccion_de_trabajo'];
$Resultados= $_POST['Resultados'];
$fecha_de_examen = $_POST['fecha_de_examen'];

$geocode = new Geocoding("AIzaSyCwk7dAN-AnGkyGTKiiz6loO3welaQF_wk");
$coordenadas_residencia = $geocode->getCoordinates($direccion_de_residencia);
$coordenadas_trabajo = $geocode->getCoordinates($direccion_de_trabajo);
$lat_res = $coordenadas_residencia['latitude'];
$lng_res = $coordenadas_residencia['longitude'];
$lat_tra = $coordenadas_trabajo['latitude'];
$lng_tra = $coordenadas_trabajo['longitude'];

if ($Resultados == "Positivo") {
    $Resultados = "En Tratamiento Casa";
}

$query = "INSERT INTO casos(nombre_x, apellido_x, cedula_x, Sexo, fecha_de_nacimiento, direccion_de_residencia, direccion_de_trabajo, estados, fechas_estados, lat_residencia, lng_residencia, lat_trabajo, lng_trabajo)
                    VALUES('$nombre_x', '$apellido_x', '$cedula_x', '$Sexo', '$fecha_de_nacimiento', '$direccion_de_residencia', '$direccion_de_trabajo', '$Resultados', '$fecha_de_examen', '$lat_res', '$lng_res', '$lat_tra', '$lng_tra')";

$ejecutar = mysqli_query($conexion ,$query);

if ($ejecutar) {
    include("registro_de_casos.html");

    echo "Se ha registrado el caso correctamente.";

} else {
    echo "Error";
}

?>