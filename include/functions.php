<?php
function cleanQuery($mQuery)
{
    if (is_array($mQuery)) {
        $aNewQuery = array();
        foreach ($mQuery as $sKey => $sQuery) {
            $aNewQuery[$sKey] = cleanQuery($sQuery);
        }
        return $aNewQuery;
    } else {
        $sNewQuery = trim(htmlentities(trim($mQuery)));
        return $sNewQuery;
    }
}

function apiGet($service_url, $curl_get_data = array())
{
    if (!empty($curl_get_data)) {
        if (substr($service_url, -1) == '/') {
            $service_url .= '?';
        }
        $service_url .= '&' . http_build_query($curl_get_data);
    }
    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($curl, CURLOPT_HEADER, 1);

    $curl_response = curl_exec($curl);
    curl_close($curl);

    if ($curl_response === false) {
        return false;
    }

    curl_close($curl);
    return json_decode($curl_response);
}