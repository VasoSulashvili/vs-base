<?php

namespace VS\Base\Classes;

class VSCURL
{
    public static function post($url, $data = [])
    {

//        $curl_post_data = [
//            "reference" => $reference,
//            "status" => "Failed",
//        ];
//        $url ="'http://127.0.0.1:8000/services/update";
//        $data = json_encode($curl_post_data);

        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json'));
        $curl_response = curl_exec($ch);

        return $result = json_decode($curl_response,true);
    }

    public static function test($url)
    {
        $reference = explode(",",$request->ids);

        $curl_post_data = [
            "reference" => $reference,
            "status" => "Failed",
        ];
        $url ="'http://127.0.0.1:8000/services/update";
        $data = json_encode($curl_post_data);

        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        $curl_response = curl_exec($ch);

        $result = json_decode($curl_response,true);
    }

}
