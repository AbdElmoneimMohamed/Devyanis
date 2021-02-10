<?php
require_once 'Repostories.php';

$repoObject = new Repostories();
//set the new filters
$repoObject->setData($_GET);
//get popular repostories
$popularRepostories = $repoObject->getPopularRepostories();
$repostories = isset($popularRepostories['items']) ? $popularRepostories['items'] : [];
//populate the pagination
$itemsNumber = $popularRepostories['total_count'];
$reminderitems = $itemsNumber % $repoObject->get_count() ;
$pagesNumbers = round($itemsNumber / $repoObject->get_count());
$pagesNumbers = $reminderitems != 0 ? ++$pagesNumbers : $pagesNumbers;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Devyanis</title>
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" style="background-color: #8080802e">
<div class="wrapper container">
    <div class="">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Popular Repositories</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-secondary ">
                    <div class="card-header">
                        <h3 class="card-title">Filter</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" >
                        <form method="GET" action="">
                            <div class="row">
                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <label> From</label>
                                        <div class="input-group date" id="reservationdatefrom" data-target-input="nearest">
                                            <input name="created" type="date" value="<?php echo $repoObject->get_created() ;?>" class="form-control datetimepicker-input">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <label>Programming Language</label>
                                        <input placeholder="Language" value="<?php echo $repoObject->get_topic() ;?>" class="form-control" name="topic" type="text">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 ">
                                    <div class="form-group" style="float: right">
                                        <a class="btn btn-secondary" href="<?php echo APP_URL ;?>">Reset</a>
                                        <button type="submit" class="btn btn-info" title="Apply">Apply</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-md-11">
                                    <h3 class="m-0 text-dark">Repositories</h3>
                                </div>
                                <div class="col-md-1" style="float:right;">
                                    <select id="count" class="form-control" name="count">
                                        <option value="10" <?php echo $repoObject->get_count() == 10 ? 'selected="selected"' : '' ?> >10</option>
                                        <option value="50" <?php echo $repoObject->get_count() == 50 ? 'selected="selected"' : '' ?>>50</option>
                                        <option value="100" <?php echo $repoObject->get_count() == 100 ? 'selected="selected"' : '' ?>>100</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($popularRepostories['message'])) {
                                    ?>
                                    <p>
                                        <?php echo $popularRepostories['message'];?>
                                    </p>
                                <?php
                                }
                                else {
                                    ?>
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Repo Name</th>
                                            <th>Forks </th>
                                            <th>Language</th>
                                            <th>Created At</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($repostories as $repo) {
                                            ?>
                                            <tr>
                                                <td><?php echo $repo["name"]; ?></td>
                                                <td><?php echo $repo["forks"]; ?></td>
                                                <td><?php echo $repo["language"]; ?></td>
                                                <td><?php echo $repo["created_at"]; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <div style="padding-top: 10px">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" style="float: left">
                                            <p>
                                                <?php
                                                $itemes = $repoObject->get_page() * $repoObject->get_count() < $itemsNumber ? $repoObject->get_page() * $repoObject->get_count() : $itemsNumber;
                                                echo $itemes . ' items from '. $itemsNumber;
                                                ?>
                                            </p>
                                        </div>
                                        <div class="col-md-6"style="float: right">
                                            <nav aria-label="..." style="float: right">
                                                <ul class="pagination">
                                                    <li class="page-item"><a class="page-link" href="javascript:addParamToURL('page', <?php echo $repoObject->get_page() -1;?>)" <?php echo $repoObject->get_page() == 1 ? 'style="pointer-events: none;"' : '';?>>  Prev </a></li>
                                                    <li class="page-item active"><a class="page-link" href="javascript:addParamToURL('page', <?php echo $repoObject->get_page() ;?>)"> <?php echo $repoObject->get_page() ;?> </a></li>
                                                    <li class="page-item"><a class=" page-link" href="javascript:addParamToURL('page', <?php echo $repoObject->get_page()+1 ;?>)"  <?php echo $repoObject->get_page() == $pagesNumbers ? 'style="pointer-events: none;"' : '';?>> Next  </a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/jquery/jquery-ui.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="assets/dist/js/adminlte.js"></script>
<script src="assets/dist/js/custom.js"></script>
</body>
</html>
