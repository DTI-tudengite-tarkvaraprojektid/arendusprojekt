# Õppenõustaja päevik
Projekt on loodud Tallinna Ülikooli Digitehnoloogiate instituudi tarkvaraarenduse projekti raames.

## Pildid
![avaleht](https://github.com/filiptaik/arendusprojekt/blob/master/pics/avaleht1.jpg)

![tudengid](https://github.com/filiptaik/arendusprojekt/blob/master/pics/tudengid.jpg)

## Eesmärk
Eesmärgiks oli luua õppenõustajale rakendus, kuhu saaks exceli tabelist sisse lugeda tudengite andmed ning tudengite profiilile kirjutada tudengite kohta märkmeid. 

## Kasutatud tehnoloogiad
* HTML
* PHP 5.6.40
* CSS
* JavaScript
* MySQL
* jQuery 3.5.1
* jQuery Tabledit
* SheetJS
* Bootstrap 4.5.0 


## Paigaldusjuhised
Leht on kättesaadav Tallinna Ülikooli serverist, et kasutada ülikooli veebipuhvrit väljaspool kooli arvutivõrku on vajalik luua tunnel lin2.tlu.ee näiteks kasutades tarkvara Putty. Lehel pääseb [siit](http://greeny.cs.tlu.ee/~filiptai/arendusprojekt/arendusprojekt/login.php)

#### Enda serverisse paigaldamiseks:
* Lae alla PHP 5.6.40
* Lae alla jQuery 3.5.1
* Lae alla jQuery Tabledit
* Lae alla SheetJS
* Lae alla Bootstrap 4.5.0
* Loo MySQL andmebaasi keskkond
* Lae alla kõik failis repositooriumist (https://github.com/filiptaik/arendusprojekt)
* Loo tabelid allpool olevate käskudega

### config.php näide:
```
<?php
	$serverHost = "******";
	$serverUsername = "*****";
	$serverPassword = "*******";
	$database = "*******";
?>
```

#### MySQL tabelite skriptid:
```
CREATE TABLE `Kasutaja` ( 
`id` INT(11) NOT NULL AUTO_INCREMENT , 
`kasutajanimi` VARCHAR(30) NOT NULL , 
`parool` VARCHAR(60) NOT NULL , 
PRIMARY KEY (`id`)
KEY `id` (`id`)
) ENGINE = InnoDB;

CREATE TABLE `Markmed` (
`id` INT(11) NOT NULL AUTO_INCREMENT , 
`Kasutajaid` INT(11) NOT NULL , 
`Opilasedid` INT(11) NOT NULL , 
`marge` VARCHAR(256) NOT NULL , 
`created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
`deleted` DATE NULL , PRIMARY KEY (`Opilasedid`)
KEY `id` (`id`)
) ENGINE = InnoDB;

CREATE TABLE `Isiklik_marge` ( 
`id` INT(11) NOT NULL AUTO_INCREMENT , 
`Kasutajaid` INT(11) NOT NULL , 
`marge` VARCHAR(2000) NOT NULL, 
PRIMARY KEY (`Kasutajaid`),
KEY `id` (`id`)
) ENGINE = InnoDB;

"CREATE TABLE Opilased (
id INT AUTO_INCREMENT,
pnimi VARCHAR(50) NOT NULL,
enimi VARCHAR(50) ,
idkood VARCHAR(50),
email VARCHAR(50),
email_kool VARCHAR(50),
opilaskood VARCHAR(50) PRIMARY KEY NOT NULL,
oppekava VARCHAR(50),
suund VARCHAR(50),
finants VARCHAR(50),
tasumata_arved VARCHAR(50),
koormus VARCHAR(50),
sem VARCHAR(50),
puhkusel VARCHAR(50),
valisoppe_sem VARCHAR(50),
etapp VARCHAR(50),
eap VARCHAR(20),
kkh_ap VARCHAR(20),
kkh_eap VARCHAR(20),
kkh_koik VARCHAR(20),
KEY `id` (`id`)
)  ENGINE=INNODB;";

```
## Litsents
[Litsents](https://github.com/filiptaik/arendusprojekt/blob/master/LICENSE.txt)
