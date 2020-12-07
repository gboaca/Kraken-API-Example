<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kraken API access example</title>

        <!-- CSS only -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    </head>
    <body>
        <h2 class="display-4">KRAKEN API EXAMPLE </h2>
        <a href="https://github.com/gboaca/KrakenApi" target="_blank">GitHub</a>

        <br />
        <table class="table">
            <thead class="table-info">
                <tr>
                <th scope="col">#</th>
                <th scope="col">PAIR</th>
                <th scope="col">VALUE</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    require_once 'KrakenAPIClient.php';

                // api credentials
                $key = '+EBEIXQhRxCL1m9nZ4IKVuuPL8948sNGTibZVAX0NxCURi05TeY/ipPa';
                $secret = 'jwG/IkQWCL712izv9kGYxkM9uRVUdzB0gW3liLoFcN4I3CDkIftSNlUNtzek2uPIBkLKGJ2wXImQFpm1XYhZjw==';

                // set params
                $beta = true;
                $url = 'https://api.kraken.com';
                $sslverify = true;
                $version = 0;

                $kraken = new KrakenAPI($key, $secret, $url, $version, $sslverify);


                // Query asset pairs
                    echo '<h2><br/><small class="text-muted">ASSET PAIRS</small></h2>';

                    $res = $kraken->QueryPublic('AssetPairs');
                    $pairs = $res["result"];

                    $i=0;
                    foreach ($pairs as $pair) {
                        $i++;
                        $p = $pair["altname"];
                        $res2 = $kraken->QueryPublic('Ticker', array('pair' => $p ));
                        $value = $res2["result"][$p]['c'][0];

                        if ($value){
                            echo "<tr>";
                            echo "<td>" . $i . "</td>";
                            echo "<td>" . $pair["altname"] . "</td>";
                            echo "<td>" . $value . "</td>";
                            echo "</tr>";
                            // echo "name: ". $pair["altname"] . ": " . $value;

                        }

                    }
            ?>

            </tbody>
        </table>

    </body>
</html>