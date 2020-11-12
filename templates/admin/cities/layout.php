<div class="col-10 p-0 d-flex justify-content-between flex-wrap">
<?php foreach ($this->cities as $city) { ?>
    <?= $this->partial('templates/admin/components/common/list-item.php', [
        'title' => $city->getName(), 
        'color' => $city->findColor($city->getName()),
        'link' => $city->getId()
        ]); 
    ?>
<?php } ?>
</div>