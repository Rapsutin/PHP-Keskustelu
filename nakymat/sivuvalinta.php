
<?php


function luoSivuvalinta($tietonakymanTiedosto, $sivu, $sivuja) {
    echo "Olet sivulla {$sivu}/{$sivuja}";
    if ($sivu > 1):?>

        <a href="<?php echo $tietonakymanTiedosto ?>&sivu=<?php echo $sivu - 1; ?>">Edellinen sivu</a>

    <?php endif; ?>

    <?php if ($sivu < $sivuja): ?>

        <a href="<?php echo $tietonakymanTiedosto ?>&sivu=<?php echo $sivu + 1; ?>">Seuraava sivu</a>

    <?php endif;
} 
