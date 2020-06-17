# Õppenõustaja päevik
Projekt on loodud Tallinna Ülikooli Digitehnoloogiate instituudi tarkvaraarenduse projekti raames.

## Pildid

## Eesmärk
Õppenõustaja päevik võimaldab õppenõustajal teha tudengi kohta märkmeid ja saada tudengite kohta ülevaadet.

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

## Projekti meeskond
* Filip Taik
* Hannele Pruunlep
* Roos-Marie Lunden

## Paigaldusjuhised

#### MySQL tabelite skriptid:
```
CREATE TABLE `Kasutaja` ( 
`id` INT(11) NOT NULL AUTO_INCREMENT , 
`kasutajanimi` VARCHAR(30) NOT NULL , 
`parool` VARCHAR(60) NOT NULL , 
PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `Markmed` (
`id` INT(11) NOT NULL AUTO_INCREMENT , 
`Kasutajaid` INT(11) NOT NULL , 
`Opilasedid` INT(11) NOT NULL , 
`marge` VARCHAR(256) NOT NULL , 
`created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
`deleted` DATE NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `Silt` ( 
`id` INT(11) NOT NULL AUTO_INCREMENT , 
`nimi` VARCHAR(50) NOT NULL, 
`varv` VARCHAR(7) NOT NULL, 
PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `Isiklik_marge` ( 
`id` INT(11) NOT NULL AUTO_INCREMENT , 
`Kasutajaid` INT(11) NOT NULL , 
`marge` VARCHAR(2000) NOT NULL, 
PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `Op_silt` ( 
`id` INT(11) NOT NULL AUTO_INCREMENT , 
`Kasutajaid` INT(11) NOT NULL , 
`Siltid` INT(11) NOT NULL, 
`Opilasedid` INT(11) NOT NULL, 
PRIMARY KEY (`id`)) ENGINE = InnoDB;


```
## Litsents
