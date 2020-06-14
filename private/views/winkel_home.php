<?php $this->layout('layout') ?>

<section class="countries">
	<?php foreach ( $result['statement'] as $country ): ?>
        <div class="country">
            <h2><?php echo $country['name'] ?></h2>
						<h3><?php echo $country['continent'] ?></h3><?php//TODO: Laat hier andere gegevens van een land zien uit de "country" table?>
						<h3><?php echo $country['region'] ?>
						<h3><?php echo $country['surface_area'] ?>
				</div>
	<?php endforeach ?>
</section>
<div class="pagination">
	<?php for ( $i = 1; $i <= $result['pages']; $i ++ ): ?>
        <a href="index.php?page=<?php echo $country['code'] ?>" class="pagination__number"></a>
	<?php endfor; ?>
</div>
