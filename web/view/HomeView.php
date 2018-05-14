<?php ob_start(); ?>
<article class="Main">
    <h1>Home</h1>
    <?php
    if (!empty($tab))
    {
    ?>
    <table>
        <thead>
            <tr>
                <?php foreach ($tab[0] as $key => $value) { ?>
                    <th><?= $key ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tab as $ligne) { ?>
                <tr>
                    <?php foreach ($ligne as $val) { ?>
                        <td class="casetab">
                            <a href="/web/param/<?= $val ?>"><?= $val ?></a>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
    }
    else
    {
    ?>
        <p>Tableau vide<p>
    <?php } ?>
</article>
<?php $article = ob_get_clean(); ?>

<?php require('template/base.php'); ?>
