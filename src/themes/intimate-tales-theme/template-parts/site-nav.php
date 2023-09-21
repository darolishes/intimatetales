<?php
/**
 * This is an example of Navi used in a vanilla theme such as _'s.
 *
 * @link https://github.com/log1x/navi
 */

$navigation = new \Log1x\Navi\Navi();
$navigation->build('primary-menu');
?>

<?php if ( $navigation->isNotEmpty() ) : ?>
    <nav id="site-navigation" class="main-navigation">
        <ul id="primary-menu" class="f-header__list js-f-header__list">
            <?php foreach ( $navigation->toArray() as $item ) : ?>
                <li class="<?php echo $item->classes; ?> f-header__item <?php echo $item->active ? 'current-item' : ''; ?>">
                    <a href="<?php echo $item->url; ?>" class="f-header__link js-f-header__link js-tab-focus">
                        <?php echo $item->label; ?>
                    </a>

                    <?php if ( $item->children ) : ?>
                        <ul class="f-header__list js-f-header__list">
                            <?php foreach ( $item->children as $child ) : ?>
                                <li class="<?php echo $child->classes; ?> f-header__item <?php echo $child->active ? 'current-item' : ''; ?>">
                                    <a href="<?php echo $child->url; ?>">
                                        <?php echo $child->label; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
<?php endif; ?>