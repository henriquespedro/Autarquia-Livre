<?php
include __DIR__ .'/../connections.php';
/* @var $this yii\web\View */
$this->title = 'Autarquia Livre - OpenSource WebSIG';
$load_config = $connection->query('SELECT * FROM viewers ORDER BY id ASC');
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <?php
            while ($row = $load_config->fetchArray(SQLITE3_ASSOC)) {
                ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="../images/<?php echo $row['image']; ?>" alt="<?php echo $row['description']; ?>">
                        <div class="caption">
                            <h3 style="text-align: center;"><?php echo $row['description']; ?></h3>
                            <p style="text-align: justify;"><?php echo $row['comments']; ?></p>
                            <p><a href="?r=viewer&page=<?php echo $row['name']; ?>" target="_blanck" class="btn btn-info" role="button"><span class="glyphicon glyphicon-eye-open"></span> Aceder</a></p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
