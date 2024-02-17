<?php
trait Tookit
{
    public function request($method, $url, $header, $body = null)
    {
        $ch = curl_init($url);
        if ($method == "GET") {
            //不执行
        } elseif ($method == "POST") {
            curl_setopt($ch, CURLOPT_POST, 1);
        } elseif ($method == "PUT") {
            curl_setopt($ch, CURLOPT_PUT, 1);
        } else {
            throw new Exception("Error Processing Request:Bad Method", 1);
        }
        if ($header == null) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('charset=utf-8'));
        } else {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        if ($method == "GET") {
            if ($body != null) {
                throw new Exception("Error Processing Request:Body is not needed", 1);
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
            }
        }
        curl_exec($ch);
    }

}