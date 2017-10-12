<?php include_once 'header.php' ?>

<body>
    <p>Ez a menüpont a szimulációk indítására hivatott. A szimulációhoz használt teszt adatok a többi menüponttól eltérő szimulációs adatforrásból jönnek.
        Kérem válasszon az alábbi lehetőségek közül</p>
    <p>&nbsp;</p><p>&nbsp;</p>
    <p>Létrehoz 2 raktárat, felvesz 5 terméket, kikér 2 terméket</p>
    <button type="button" class="btn btn-primary start_simulation" data-id="1">Szimuláció indítása</button>
    <p>&nbsp;</p><p>&nbsp;</p>
    <p>Létrehoz 2 raktárat, felvesz 5 terméket, de nincs elég hely a raktárakban</p>
    <button type="button" class="btn btn-primary start_simulation" data-id="2">Szimuláció indítása</button>
    <p>&nbsp;</p><p>&nbsp;</p>
    <p>Létrehoz 2 raktárat, felvesz 5 terméket, majd kikér többet, mint amennyi elérhető</p>
    <button type="button" class="btn btn-primary start_simulation" data-id="3">Szimuláció indítása</button>
</body>
