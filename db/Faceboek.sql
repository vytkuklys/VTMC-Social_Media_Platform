CREATE TABLE `Vartotojai` (
	`Vartotojo_id` INT NOT NULL AUTO_INCREMENT,
	`Vardas` varchar(255) NOT NULL,
	`Pavarde` varchar(255) NOT NULL,
	`Email` varchar(255) NOT NULL,
	`Slaptazodis` varchar(255) NOT NULL,
	`Nuotrauka` varchar(255) NOT NULL,
	PRIMARY KEY (`Vartotojo_id`)
);

CREATE TABLE `Pranesimai` (
	`Pranesimo_id` INT NOT NULL,
	`Autorius` INT NOT NULL,
	`Tekstas` TEXT NOT NULL,
	`Sukurimo_data` DATETIME NOT NULL,
	`Redagavimo_data` DATETIME NOT NULL,
	`Nuotrauka` varchar(255) NOT NULL,
	PRIMARY KEY (`Pranesimo_id`)
);

CREATE TABLE `Komentarai` (
	`Komentaro_id` INT NOT NULL,
	`Tekstas` TEXT NOT NULL,
	`Sukurimo_data` DATETIME NOT NULL,
	`Pranesimas` INT NOT NULL,
	`Autorius` INT NOT NULL,
	`Sukurimo_data` BINARY NOT NULL,
	PRIMARY KEY (`Komentaro_id`)
);

CREATE TABLE `Jausmazenkliai` (
	`Jausmazenklis` varchar(255) NOT NULL,
	`Jausmazenklio_id` INT NOT NULL,
	PRIMARY KEY (`Jausmazenklio_id`)
);

CREATE TABLE `Komentaru_reakcijos` (
	`Jausmazenklio_id` INT NOT NULL,
	`Komentaro_id` INT NOT NULL,
	`Vartotojas` INT NOT NULL
);

CREATE TABLE `Pranesimu_reakcijos` (
	`Jausmazenklio_id` INT NOT NULL,
	`Pranesimo_id` INT NOT NULL,
	`Vartotojas` INT NOT NULL
);

ALTER TABLE `Pranesimai` ADD CONSTRAINT `Pranesimai_fk0` FOREIGN KEY (`Autorius`) REFERENCES `Vartotojai`(`Vartotojo_id`);

ALTER TABLE `Komentarai` ADD CONSTRAINT `Komentarai_fk0` FOREIGN KEY (`Pranesimas`) REFERENCES `Pranesimai`(`Pranesimo_id`);

ALTER TABLE `Komentarai` ADD CONSTRAINT `Komentarai_fk1` FOREIGN KEY (`Autorius`) REFERENCES `Vartotojai`(`Vartotojo_id`);

ALTER TABLE `Komentaru_reakcijos` ADD CONSTRAINT `Komentaru_reakcijos_fk0` FOREIGN KEY (`Jausmazenklio_id`) REFERENCES `Jausmazenkliai`(`Jausmazenklio_id`);

ALTER TABLE `Komentaru_reakcijos` ADD CONSTRAINT `Komentaru_reakcijos_fk1` FOREIGN KEY (`Komentaro_id`) REFERENCES `Komentarai`(`Komentaro_id`);

ALTER TABLE `Komentaru_reakcijos` ADD CONSTRAINT `Komentaru_reakcijos_fk2` FOREIGN KEY (`Vartotojas`) REFERENCES `Vartotojai`(`Vartotojo_id`);

ALTER TABLE `Pranesimu_reakcijos` ADD CONSTRAINT `Pranesimu_reakcijos_fk0` FOREIGN KEY (`Jausmazenklio_id`) REFERENCES `Jausmazenkliai`(`Jausmazenklio_id`);

ALTER TABLE `Pranesimu_reakcijos` ADD CONSTRAINT `Pranesimu_reakcijos_fk1` FOREIGN KEY (`Pranesimo_id`) REFERENCES `Pranesimai`(`Pranesimo_id`);

ALTER TABLE `Pranesimu_reakcijos` ADD CONSTRAINT `Pranesimu_reakcijos_fk2` FOREIGN KEY (`Vartotojas`) REFERENCES `Vartotojai`(`Vartotojo_id`);

