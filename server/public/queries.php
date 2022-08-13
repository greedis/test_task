<?php
/**
 * @autor  Ilya Dolgoy dolghoi.2002@gmail.com
 * @param  int $id
 * @return bool|string
 */
function getUserTransactions(int $id): bool|string
{
    $curl = curl_init();

    curl_setopt_array(
        $curl, array(
            CURLOPT_URL => 'https://user-transaction-fetch-api.herokuapp.com/transaction/user/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        )
    );

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}

/**
 * @autor  Ilya Dolgoy dolghoi.2002@gmail.com
 * @return false|string
 */
function getTheMostActiveUsers(): false|string
{
    $curl = curl_init();

    curl_setopt_array(
        $curl, array(
            CURLOPT_URL => 'https://user-transaction-fetch-api.herokuapp.com/user',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        )
    );

    $response = curl_exec($curl);

    curl_close($curl);

    $response = json_decode($response);

    $count = count($response);

    for ($i = 0; $i < $count; $i++) {
        $response2 = json_decode(getUserTransactions($response[$i]->id));
        $count2 = count($response2);
        $response[$i]->countOfTransactions = $count2;
    }
    /**
     * @autor  Ilya Dolgoy dolghoi.2002@gmail.com
     * @param object $a
     * @param object $b
     * @return int
     */
    function cmp(object $a, object $b): int
    {
        return strcmp($b->countOfTransactions, $a->countOfTransactions);
    }

    usort($response, "cmp");

    $response = array_slice($response, 0, 3);

    $response = json_encode($response);

    return $response;
}

if (isset($_POST['id'])) {
    echo getUserTransactions($_POST['id']);
}

if (isset($_POST['sort'])) {
    echo getTheMostActiveUsers();
}