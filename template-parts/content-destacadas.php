<?php
$pagina1 = get_field('pagina_1');
$desc1 = get_field('descripcion_1');
$css1 = get_field('class_1');
$pagina2 = get_field('pagina_2');
$desc2 = get_field('descripcion_2');
$css2 = get_field('class_2');
$pagina3 = get_field('pagina_3');
$desc3 = get_field('descripcion_3');
$css3 = get_field('class_3');

?>



<section class="paginas-destacadas">
    <div class="paginas-inner">

        <?php
        if ($pagina1) :

            // override $post
            $post = $pagina1;
            setup_postdata($post);

        ?>
            <div class="pagina <?php echo $css1; ?>">

                <h3>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h3>

                <?php if ($desc1) : ?>
                    <p><?php echo $desc1; ?></p>
                <?php else : ?>
                    <div class="excerpt"><?php the_excerpt(); ?></div>
                <?php endif; ?>

                <a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo __('Leer más', 'pemscores') . pemscores_get_svg(array('icon' => 'arrow-right', 'fallback' => true)); ?></a>
            </div>

            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
            ?>

        <?php endif; ?>

        <?php

        if ($pagina2) :

            // override $post
            $post = $pagina2;
            setup_postdata($post);

        ?>
            <div class="pagina <?php echo $css2; ?>">
                <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

                <?php if ($desc2) : ?>
                    <p><?php echo $desc2; ?></p>
                <?php else : ?>
                    <div class="excerpt"><?php the_excerpt(); ?></div>
                <?php endif; ?>

                <a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo __('Leer más', 'pemscores') . pemscores_get_svg(array('icon' => 'arrow-right', 'fallback' => true)); ?></a>
            </div>

            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
            ?>

        <?php endif; ?>

        <?php

        if ($pagina3) :

            // override $post
            $post = $pagina3;
            setup_postdata($post);

        ?>
            <div class="pagina <?php echo $css3; ?>">
                <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

                <?php if ($desc3) : ?>
                    <p><?php echo $desc3; ?></p>
                <?php else : ?>
                    <div class="excerpt"><?php the_excerpt(); ?></div>
                <?php endif; ?>

                <a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo __('Leer más', 'pemscores') . pemscores_get_svg(array('icon' => 'arrow-right', 'fallback' => true)); ?></a>
            </div>

            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
            ?>

        <?php endif; ?>
    </div>
</section><!-- .paginas-destacadas-->