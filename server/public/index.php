<?php
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

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="css/style.css">
    <title>Users</title>
</head>
<body>
<div class="depthchart1">
    <table class="table table-success table-striped">
        <tr>
            <th>name</th>
            <th>email</th>
            <th>status</th>
            <th>id</th>
            <th><button type="submit" class="btn btn-primary sort" name="sort" value="go" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Show the most active users
                </button></th>
        </tr>
        <?php for ($i = 0; $i < $count; $i++): ?>
            <tr>
                <td><?php echo $response[$i]->name ?></td>
                <td><?php echo $response[$i]->email ?></td>
                <td><?php echo $response[$i]->status ?></td>
                <td><?php echo $response[$i]->id ?></td>
                <td>
                    <form action="queries.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $response[$i]->id ?>">
                        <button type="submit" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Transactions
                        </button>
                    </form>
                </td>
            </tr>
        <?php endfor; ?>
    </table>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
</script>
<script src="js/jquery-3.6.0.min.js"></script>
<script>
    $('form').on('submit', function (e) {
        e.preventDefault()
        $.ajax({
            url: $('form').attr('action'),
            method: $('form').attr('method'),
            dataType: 'json',
            data: $(this).serialize(),
            success: function (data) {
                let len = data.length;

                    let table_td = `<tr>
                            <th>identifier</th><th>timestamp</th><th>Price</th><th>Product name</th><th>Quantity</th>
                        </tr>`;
                    for (let i = 0; i < len; i++) {
                        table_td += `<tr>`;
                        table_td += `<td>${data[i].identifier}</td>`;
                        table_td += `<td>${data[i].timestamp}</td>`;
                        table_td += `<td>${data[i].line.price}</td>`;
                        table_td += `<td>${data[i].line.product_name}</td>`;
                        table_td += `<td>${data[i].line.quantity}</td>`;
                        table_td += `</tr>`;
                    }
                if (len === 0){
                    table_td = `<tr>This user has no transactions yet</tr>`
                }
                $(".modal-body").html(`<table class="table table-success table-striped">${table_td}</table>`);
                $(".modal-title").text(`Transactions list`);
            }
        });
    })
    $('.sort').click('submit', function (e) {
        e.preventDefault()
        let sort = $('button[name="sort"]').val();
        $.ajax({
            url: "queries.php",
            method: "post",
            dataType: 'json',
            data: {
                sort: sort
            },
            success: function (data) {
                let len = data.length;
                let table_td = `<tr>
                            <th>Name</th><th>Count of transactions</th>
                        </tr>`;
                for (let i = 0; i < len; i++) {
                    table_td += `<tr>`;
                    table_td += `<td>${data[i].name}</td>`;
                    table_td += `<td>${data[i].countOfTransactions}</td>`;
                    table_td += `</tr>`;
                }
                $(".modal-body").html(`<table class="table table-success table-striped">${table_td}</table>`);
                $(".modal-title").text(`The most active users`);
            }
        });
    })
</script>
</body>
</html>