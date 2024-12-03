<?php

function sendOSCMessage($ip, $port, $address, ...$args) {
    echo "send_osc_message ip: {$ip}, port: {$port}, address: {$address}, args: ".implode(", ", $args)."\n";

    // OSCアドレスのパディング
    $address = $address . "\0";
    while (strlen($address) % 4 != 0) {
        $address .= "\0";
    }

    // タイプタグの作成
    $typeTags = ',';
    foreach ($args as $arg) {
        if (is_int($arg)) {
            $typeTags .= 'i';
        } elseif (is_float($arg)) {
            $typeTags .= 'f';
        } elseif (is_string($arg)) {
            $typeTags .= 's';
        } else {
            throw new Exception('Unsupported argument type');
        }
    }
    $typeTags .= "\0";
    while (strlen($typeTags) % 4 != 0) {
        $typeTags .= "\0";
    }

    // 引数のパディング
    $arguments = '';
    foreach ($args as $arg) {
        if (is_int($arg)) {
            $arguments .= pack('N', $arg);
        } elseif (is_float($arg)) {
            $arguments .= pack('f', $arg);
        } elseif (is_string($arg)) {
            $arg = $arg . "\0";
            while (strlen($arg) % 4 != 0) {
                $arg .= "\0";
            }
            $arguments .= $arg;
        }
    }

    // パケットの作成
    $packet = $address . $typeTags . $arguments;

    // UDPソケットの作成
    $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    if (!$socket) {
        throw new Exception('Could not create socket: ' . socket_strerror(socket_last_error()));
    }

    // パケットの送信
    if (!socket_sendto($socket, $packet, strlen($packet), 0, $ip, $port)) {
        throw new Exception('Could not send packet: ' . socket_strerror(socket_last_error()));
    }

    // ソケットを閉じる
    socket_close($socket);
}


$ip = 'osc_server';
$port = 9001;
$address = "/volume";
$value = "test osc message";

sendOSCMessage($ip, $port, $address, $value);

