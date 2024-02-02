<?php
$json = file_get_contents('config.json');
$configs = json_decode($json,true);

    // Construct the API endpoint for getting live videos
    $apiUrl = "https://graph.facebook.com/v19.0/{$configs['pageID']}/live_videos?access_token={$configs['accessToken']}&fields=permalink_url,title";

    // Make a GET request to the API endpoint
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);

    // Check if there are live videos
    if (!empty($data['data'])) {
        $video = $data['data'][0];
        $purl = preg_split("/\//", $video['permalink_url']);
        $output = array("latest_url" => "https://www.facebook.com/plugins/video.php?width=560&href=https%3A%2F%2Fwww.facebook.com%2F{$purl[1]}%2Fvideos%2F{$purl[3]}");
        
        
        $json_string = json_encode($output,JSON_UNESCAPED_SLASHES);

        file_put_contents("json/latest_video.json", $json_string);
        //echo $json_string;
    } else {
        echo "error getting latest video.";
    }
