<div id="response" class="house-container  ">
	<?php while ( $houses->have_posts() ) : $houses->the_post();
		?>
        <div class="house-child">
            <a href="<?= the_permalink() ?>">
                <div>
                    <img src="<?= the_post_thumbnail_url() ?>" alt="<?= the_title() ?>"
                         style="width: 150px;">
                </div>
                <div>
                    <h3><?= the_title() ?></h3>
                    <h6><?= the_excerpt() ?></h6>
                    <div>
                        <a href="<?= the_permalink() ?>">Read more -></a>
                    </div>
                </div>
            </a>
        </div>
	<?php endwhile; ?>
</div>

