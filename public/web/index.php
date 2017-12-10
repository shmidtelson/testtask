<?php

use MongoDB\Client;

require_once '../php/functions.php';

$client     = new Client( "mongodb://localhost:27017" );
$collection = $client->testtask->mails;

$page  = isset( $_GET['page'] ) ? (int) $_GET['page'] : 1;
$limit = 10;

$skip = ( $page - 1 ) * $limit;
$next = ( $page + 1 );
$prev = ( $page - 1 );

$queryOptions = [
	"limit" => $limit,
	"skip"  => $skip,
	"sort"  => [
		"_id" => - 1,
	],
];

$cursor     = $collection->find( [], $queryOptions );
$total      = $collection->count();
$totalPages = ceil( $total / $limit );

?>
<html>
<head>
    <title>Тестовое задание</title>
    <link rel="stylesheet"
          href="/assets/libs/bootstrap/css/bootstrap-material-design.min.css"/>
    <link rel="stylesheet" href="/assets/css/custom.css"/>
</head>
<body>
<div class="container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-md-12 ">
                <table class="table">
                    <thead class="thead-default">
                    <tr>
                        <th>_id</th>
                        <th>Дата</th>
                        <th>Email</th>
                        <th>Тема</th>
                        <th>Содержимое</th>
                        <th>Файлы</th>
                        <th>Отправлено</th>
                    </tr>
                    </thead>
                    <tbody>
					<? foreach ( $cursor as $item ) : ?>
                        <tr>
                            <th scope="row"><?= $item['_id'] ?></th>
                            <td><?= $item['created'] ?></td>
                            <td><?= $item['email'] ?></td>
                            <td><?= $item['subject'] ?></td>
                            <td><?= html_entity_decode( $item['text'] ) ?></td>
                            <td>
								<? if ( isset($item['files']) && $item['files'] != ''): ?>
                                    <ul>
										<? foreach ( $item['files'] as $it ): ?>
                                            <li><?= $it ?></li>
										<? endforeach; ?>
                                    </ul>
								<? endif; ?>
                            </td>
                            <td>
								<?= ( $item['sent'] ) ? $item['sent'] : '' ?>
                            </td>
                        </tr>
					<? endforeach; ?>
                    </tbody>
                </table>

            </div>

        </div>

        <div class="row justify-content-center">

            <nav aria-label="Page navigation" class="col-2">
                <ul class="pagination">
					<? if ( $page !== 1 ) : ?>
                        <li class="page-item <? if ( $page === 1 ) : ?>disabled<? endif; ?>">
                            <a class="page-link" href="?page=<?= $prev ?>" tabindex="-1">Назад</a>
                        </li>
                        <li class="page-item <? if ( $page >= $totalPages ) : ?>disabled<? endif; ?>">
                            <a class="page-link" href="?page=<?= $next ?>">Вперед</a>
                        </li>
					<? endif; ?>
                </ul>
            </nav>
        </div>
    </div>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.0.1/jquery-migrate.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap-material-design.min.js"></script>

<script src="/assets/js/custom.js"></script>
</body>
</html>