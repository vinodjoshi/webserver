<?php
// Create a socket server
$server = stream_socket_server("tcp://0.0.0.0:8080", $errno, $errstr);

if (!$server) {
    die("Error: $errstr ($errno)\n");
}

echo "Server started on http://localhost:8080\n";

while ($conn = stream_socket_accept($server)) {
    // Read the HTTP request
    $request = fread($conn, 1024);
    echo "Received request:\n$request\n";

    // Prepare an HTTP response
    $response = "HTTP/1.1 200 OK\r\n";
    $response .= "Content-Type: text/html\r\n\r\n";
    $response .= "<h1>Hello, World!</h1>";

    // Send the response
    fwrite($conn, $response);
    fclose($conn);
}

fclose($server);
?>
